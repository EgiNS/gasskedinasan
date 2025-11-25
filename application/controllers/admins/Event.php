<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Event_model $event
 * @property Tryout_model $tryout
 * @property CI_Session $session
 * @property Event_pendaftar_model $event_pendaftar
 * @property CI_DB_query_builder $db
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 */
class Event extends CI_Controller{

    protected  $sidebarMenu, $loginUser;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('slug');
        $this->load->library('form_validation');
        $this->load->library('upload');
     
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

            $this->session->set_flashdata('success', 'Menampilkan Event');
        } else if ($event['hidden'] == 1) {
            $this->event->update(['hidden' => 0], ['slug' => $slug]);
            $this->session->set_flashdata('success', 'Menyembunyikan Event');
        }
        redirect('admin/event');
    }

    public function get_event_data($id)
    {
        $event = $this->event->getByIdWithTryouts($id);
        
        if ($event) {
            echo json_encode(['status' => 'success', 'data' => $event]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Event tidak ditemukan']);
        }
    }

    public function get_available_tryouts()
    {
        $tryouts = $this->tryout->getAll();
        echo json_encode(['status' => 'success', 'data' => $tryouts]);
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Nama Event', 'required', [
            'required' => 'Nama event wajib diisi.'
        ]);
        $this->form_validation->set_rules('paket_to_ids[]', 'Tryout', 'required', [
            'required' => 'Minimal pilih satu tryout.'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
            'required' => 'Keterangan wajib diisi.'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
            'numeric' => 'Hanya boleh diisi angka.',
            'required' => 'Harga wajib diisi.'
        ]);
        $this->form_validation->set_rules('group_link', 'Link Grup', 'required|valid_url', [
            'valid_url' => 'Link grup harus berupa URL yang valid.',
            'required' => 'Link grup wajib diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Data tidak valid: ' . validation_errors());
            redirect('admin/event');
            return;
        }

        // Get current event data
        $current_event = $this->event->get('one', ['id' => $id]);
        if (!$current_event) {
            $this->session->set_flashdata('error', 'Event tidak ditemukan.');
            redirect('admin/event');
            return;
        }

        $gambar_name = $current_event['gambar']; // Keep current photo by default

        // Handle photo upload if new photo is provided
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $config['upload_path'] = './assets/img/events/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = time();

            // Create directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                $uploadData = $this->upload->data();
                
                // Delete old photo if exists and different from default
                if ($current_event['gambar'] && file_exists('./assets/img/' . $current_event['gambar'])) {
                    unlink('./assets/img/' . $current_event['gambar']);
                }
                
                $gambar_name = 'events/' . $uploadData['file_name'];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/event');
                return;
            }
        }

        $this->db->trans_start();

        try {
            // Update event data
            $data = [
                'name' => $this->input->post('name'),
                'slug' => generateSlug($this->input->post('name'), $this->db, 'events', $id),
                'gambar' => $gambar_name,
                'harga' => $this->input->post('harga'),
                'group_link' => $this->input->post('group_link'),
                'keterangan' => $this->input->post('keterangan'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->event->update($data, ['id' => $id]);

            // Delete existing tryout relationships
            $this->db->where('event_id', $id);
            $this->db->delete('events_tryout');

            // Insert new tryout relationships
            $tryout_ids = $this->input->post('paket_to_ids');
            foreach ($tryout_ids as $tryout_id) {
                $data_tryout_event = [
                    'event_id' => $id,
                    'tryout_id' => $tryout_id,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('events_tryout', $data_tryout_event);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaksi gagal.');
            }

            $this->session->set_flashdata('success', 'Event berhasil diperbarui');
            redirect('admin/event');

        } catch (Exception $e) {
            $this->db->trans_rollback();
            
            // Delete uploaded file if transaction failed
            if (isset($uploadData) && file_exists('./assets/img/' . $uploadData['file_name'])) {
                unlink('./assets/img/' . $uploadData['file_name']);
            }
            
            log_message('error', 'Gagal update event: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Gagal memperbarui event. Silakan coba lagi.');
            redirect('admin/event');
        }
    }

    public function delete($id)
    {
        // Handle AJAX request
        if ($this->input->method() === 'post') {
            // Get event data first
            $event = $this->event->get('one', ['id' => $id]);
            if (!$event) {
                $this->session->set_flashdata('error', 'Event tidak ditemukan.');
                echo json_encode(['status' => 'error', 'message' => 'Event tidak ditemukan.']);
                return;
            }

            // Check if event has participants with settlement status
            $this->db->select('COUNT(*) as count');
            $this->db->from('events_pendaftar');
            $this->db->join('transactions', 'transactions.id = events_pendaftar.transaction_id', 'left');
            $this->db->where('events_pendaftar.event_id', $id);
            $this->db->where('transactions.transaction_status', 'settlement');
            $settlement_count = $this->db->get()->row()->count;

            if ($settlement_count > 0) {
                $this->session->set_flashdata('error', 'Tidak dapat menghapus event yang masih memiliki peserta terdaftar. Total peserta terdaftar: ' . $settlement_count);
                echo json_encode(['status' => 'error', 'message' => 'Tidak dapat menghapus event yang masih memiliki peserta terdaftar. Total peserta terdaftar: ' . $settlement_count]);
                return;
            }

            $this->db->trans_start();

            try {
                // 1. Delete tryout relationships
                $this->db->where('event_id', $id);
                $this->db->delete('events_tryout');

                // 2. Delete photo file if exists
                if (!empty($event['gambar']) && file_exists('./assets/img/' . $event['gambar'])) {
                    unlink('./assets/img/' . $event['gambar']);
                }

                // 3. Delete event record
                $this->db->where('id', $id);
                $this->db->delete('events');

                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    throw new Exception('Transaksi gagal.');
                }

                $success_message = 'Event berhasil dihapus';
                $this->session->set_flashdata('success', $success_message);
                echo json_encode(['status' => 'success', 'message' => $success_message]);

            } catch (Exception $e) {
                $this->db->trans_rollback();
                log_message('error', 'Gagal hapus event: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Gagal menghapus event. Silakan coba lagi.');
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus event.']);
            }
        } else {
            // Direct access (not AJAX), redirect to main page
            redirect('admin/event');
        }
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
                        'source_id' => $event['id']
                    
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