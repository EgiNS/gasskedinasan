<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Event_model $event
 * @property Tryout_model $tryout
 * @property CI_Session $session
 * @property Event_pendaftar_model $event_pendaftar
 */
class Event extends CI_Controller{

    protected  $sidebarMenu, $loginUser;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('slug');
     
        $this->load->model('Event_model', 'event');
        $this->load->model('Tryout_model', 'tryout');
        is_logged_in();
    }

    public function event(){
        $parent_title = getSubmenuTitleById(1)['title'];
        submenu_access(1);

        
        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'tryout_available' => $this->tryout->getAll(),
            'events' => $this->event-> getAll(),        
            'parent_submenu' => $parent_title,
        ];
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/event/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail($slug){
        $this->load->model('Event_pendaftar_model','event_pendaftar');
        $submenu_parent = 22;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $pendaftar = $this->event_pendaftar->get_all_by_event_slug($slug);
        $event = $this->event->getBySlugWithTryouts($slug);
        
        $data = [ 
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'event' => $event,
            'pendaftar'=> $pendaftar
        ];
                $data['page_scripts'] = [
            "$(document).ready(function () {
                $('#tabelwoi').DataTable();
            });"
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/event/detail', $data);
        $this->load->view('templates/user_footer');
    }

    public function show_packet($slug){
        $event = $this->event->get('one', ['slug' => $slug]);
         if ($event['hidden'] == 0) {
            $this->event->update(['hidden' => 1], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Menyembunyikan Event');
        } else if ($event['hidden'] == 1) {
            $this->event->update(['hidden' => 0], ['slug' => $slug]);
            $this->session->set_flashdata('success', 'Menampilkan Event ');
        }
        redirect('admin/event');
    }

    public function delete_participant($pendaftar_event_id){
        $this->load->model('Event_pendaftar_model','event_pendaftar');
        try {
            // Start transaction
            $this->db->trans_begin();
            
            // Get pendaftar data first to get paket_to_id, user_id, transaction_id
            $pendaftar = $this->event_pendaftar->get('one', ['id' => $pendaftar_event_id]);
            
            if (!$pendaftar) {
                throw new Exception('Data pendaftar tidak ditemukan');
            }
            
            // Get paket_to data to get slug and tryouts list
            $event = $this->event->get('one', ['id' => $pendaftar['event_id']]);
            
            if (!$event) {
                throw new Exception('Data paket tryout tidak ditemukan');
            }
            
            // Get tryouts data for this paket
            $event_with_tryouts = $this->event->getBySlugWithTryouts($event['slug']);
            
            $user_id = $pendaftar['user_id'];
            $transaction_id = $pendaftar['transaction_id'];

            
            // 1. Delete from user_tryout tables for each tryout with source_type = 'event' and source_id = event_id
            if (!empty($event_with_tryouts['tryouts'])) {
                foreach ($event_with_tryouts['tryouts'] as $tryout) {
                    $tryout_slug = $tryout['slug'];
                    
                    // Check if table exists first
                    if (!$this->db->table_exists('user_tryout_' . $tryout_slug)) {
                        continue;
                    }
                    
                    // Delete from user_tryout_{slug} table where user_id, source_type='event', source_id=event_id
                    $this->db->where([
                        'user_id' => $user_id,
                        'source_type' => 'event',
                    
                    ]);
                    
                    // // Add condition for source_id if column exists (some tables might have source_id column)
                    // if ($this->db->field_exists('source_id', 'user_tryout_' . $tryout_slug)) {
                    //     $this->db->where('source_id', $event_id);
                    // }
                    
                    // Add transaction_id condition if provided
                    if ($transaction_id) {
                        $this->db->where('transaction_id', $transaction_id);
                    }
                    
                    $deleted = $this->db->delete('user_tryout_' . $tryout_slug);
                    
                    if (!$deleted) {
                        throw new Exception('Gagal menghapus data user tryout untuk ' . $tryout_slug);
                    }
                }
            }
            
            // 2. Delete from pendaftar_paket_to table first (because of foreign key constraint)
            $this->db->where('id', $pendaftar_event_id);
            $deleted_pendaftar = $this->db->delete('events_pendaftar');
            
            if (!$deleted_pendaftar) {
                throw new Exception('Gagal menghapus data pendaftar');
            }
            
            // 3. Delete from transactions table (after removing foreign key references)
            if ($transaction_id) {
                $this->db->where('id', $transaction_id);
                $deleted_transaction = $this->db->delete('transactions');
                
                if (!$deleted_transaction) {
                    throw new Exception('Gagal menghapus data transaksi');
                }
            }
            
            // Commit transaction if all operations successful
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaksi gagal');
            }
            
            $this->db->trans_commit();
            
            $this->session->set_flashdata('success', 'Berhasil menghapus peserta event beserta data terkait');
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            
            $this->session->set_flashdata('error', 'Gagal menghapus peserta: ' . $e->getMessage());
            log_message('error', 'Delete participant error: ' . $e->getMessage());
        }
        
        // Redirect back to paket detail or participant list
        redirect('admin/event/');
    }
}