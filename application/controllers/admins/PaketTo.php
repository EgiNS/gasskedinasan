<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Paket_to_model $paket_to
 * @property Tryout_model $tryout
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_DB_query_builder $db
 * @property Tryout_paket_to_model $tryout_paket_to
 * @property Pendaftar_to_model $pendaftar_to
 * @property Transaction_model $transaction
 * @property User_tryout_model $user_tryout
 */

class PaketTo extends CI_Controller
{
    protected  $sidebarMenu, $loginUser;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('slug');
        // Load necessary models, libraries, etc.
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('Tryout_paket_to_model', 'tryout_paket_to');
        $this->load->model('Pendaftar_to_model', 'pendaftar_to');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('User_tryout_model', 'user_tryout');
        is_logged_in();
    }


    public function index()
    {
        $parent_title = getSubmenuTitleById(22)['title'];
        submenu_access(22);

        $paket_to = $this->paket_to->getAll();

        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'paket_to' => $paket_to,
            'tryout_available' => $this->tryout->getAll(),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/paketto/index', $data);
        $this->load->view('templates/user_footer');
    }
    public function tambahpaket()
    {

        $this->form_validation->set_rules('nama', 'Nama Tryout', 'required',[
            'required' => 'Nama paket TO wajib diisi.'
        ]);
        $this->form_validation->set_rules('paket_to_ids[]', 'Paket TO', 'required',[
            'required' => 'Paket TO wajib dipilih.'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required',[
            'required' => 'Keterangan wajib diisi.'
        ]   );
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
            'numeric' => 'Hanya boleh diisi angka.',
            'required' => 'Harga wajib diisi.'
        ]);
        $this->form_validation->set_rules('harga_diskon', 'Harga Diskon', 'required|numeric', [
            'numeric' => 'Hanya boleh diisi angka.',
            'required' => 'Harga diskon wajib diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            $parent_title = getSubmenuTitleById(22)['title'];
            submenu_access(22);

            $data = [
                'title' => $parent_title,
                'user' => $this->loginUser,
                'sidebar_menu' => $this->sidebarMenu,
                'parent_submenu' => $parent_title,
                'paket_to' => $this->paket_to->getAll(),
                'tryout_available' => $this->tryout->getAll(),
            ];
            // redirect('admin/paket-to');
            //     // return;
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/paketto/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            // Konfigurasi upload
            $config['upload_path'] = './assets/img/';  // Folder untuk menyimpan gambar
            $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
            $config['max_size'] = 2048;  // Maksimal ukuran file (2MB)
            $config['file_name'] = time();  // Nama file unik (timestamp)

            $this->load->library('upload', $config);

            // Load konfigurasi upload
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                // Upload gagal
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('foto', $error);
                redirect('admin/paket-to');
                return;
            }

            // Jika upload berhasil, ambil informasi file yang di-upload
            $uploadData = $this->upload->data();
            $this->db->trans_start();
            
            try {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'slug'=> generateSlug($this->input->post('nama'), $this->db, 'paket_to'),
                    'foto' => $uploadData['file_name'],
                    'harga' => $this->input->post('harga'),
                    'harga_diskon' => $this->input->post('harga_diskon'),
                    'keterangan' => $this->input->post('keterangan'),
                ];
                $this->paket_to->insert($data);
                $paket_to_id = $this->db->insert_id();
                
                $tryout_ids = $this->input->post('paket_to_ids');
                foreach ($tryout_ids as $tryout_id) {
                    $data_tryout_paket = [
                        'paket_to_id' => $paket_to_id,
                        'tryout_id' => $tryout_id,
                    ];
                    $this->tryout_paket_to->insert($data_tryout_paket);
                }
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    // Rollback otomatis kalau error
                    throw new Exception('Transaksi gagal.');
                }
                $this->session->set_flashdata('success', 'Menambahkan Tryout Baru');
                redirect('admin/paket-to');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                if (file_exists('./assets/img/' . $uploadData['file_name'])) {
                    unlink('./assets/img/' . $uploadData['file_name']);
                }
                log_message('error', 'Gagal menambah paket TO: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Gagal menambahkan tryout. Silakan coba lagi.');
                redirect('admin/paket-to');
            }
        }
    }
    public function detail($slug)
    {
        

        $this->load->model('Pendaftar_to_model', 'pendaftar_to');
        $submenu_parent = 22;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $pendaftar = $this->pendaftar_to->get_all_by_packet_to_id($slug);
        $packet_to = $this->paket_to->get('one', ['slug' => $slug]);
        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'paket_to' => $packet_to,
            'pendaftar' => $pendaftar,
        ];
        
        $data['page_scripts'] = [
            "$(document).ready(function () {
                $('#tabelwoi').DataTable();
            });"
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/paketto/detail', $data);
        $this->load->view('templates/user_footer');
    }

    public function show_packet($slug){
        $packet_to = $this->paket_to->get('one', ['slug' => $slug]);
         if ($packet_to['hidden'] == 0) {
            $this->paket_to->update(['hidden' => 1], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Menyembunyikan Paket Tryout');
        } else if ($packet_to['hidden'] == 1) {
            $this->paket_to->update(['hidden' => 0], ['slug' => $slug]);
            $this->session->set_flashdata('success', 'Menampilkan Paket Tryout');
        }
        redirect('admin/paket-to/' . $slug);
    }


    public function delete_participant($pendaftar_packet_id){
        try {
            // Start transaction
            $this->db->trans_begin();
            
            // Get pendaftar data first to get paket_to_id, user_id, transaction_id
            $pendaftar = $this->pendaftar_to->get('one', ['id' => $pendaftar_packet_id]);
            
            if (!$pendaftar) {
                throw new Exception('Data pendaftar tidak ditemukan');
            }
            
            // Get paket_to data to get slug and tryouts list
            $paket_to = $this->paket_to->get('one', ['id' => $pendaftar['paket_to_id']]);
            
            if (!$paket_to) {
                throw new Exception('Data paket tryout tidak ditemukan');
            }
            
            // Get tryouts data for this paket
            $paket_with_tryouts = $this->paket_to->getBySlugWithTryouts($paket_to['slug']);
            
            $user_id = $pendaftar['user_id'];
            $transaction_id = $pendaftar['transaction_id'];
            $paket_to_id = $pendaftar['paket_to_id'];
            
            // 1. Delete from user_tryout tables for each tryout with source_type = 'paket_to' and source_id = paket_to_id
            if (!empty($paket_with_tryouts['tryouts'])) {
                foreach ($paket_with_tryouts['tryouts'] as $tryout) {
                    $tryout_slug = $tryout['slug'];
                    
                    // Check if table exists first
                    if (!$this->db->table_exists('user_tryout_' . $tryout_slug)) {
                        continue;
                    }
                    
                    // Delete from user_tryout_{slug} table where user_id, source_type='paket_to', source_id=paket_to_id
                    $this->db->where([
                        'user_id' => $user_id,
                        'source_type' => 'paket_to'
                    ]);
                    
                    // Add condition for source_id if column exists (some tables might have source_id column)
                    if ($this->db->field_exists('source_id', 'user_tryout_' . $tryout_slug)) {
                        $this->db->where('source_id', $paket_to_id);
                    }
                    
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
            $this->db->where('id', $pendaftar_packet_id);
            $deleted_pendaftar = $this->db->delete('pendaftar_paket_to');
            
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
            
            $this->session->set_flashdata('success', 'Berhasil menghapus peserta paket tryout beserta data terkait');
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            
            $this->session->set_flashdata('error', 'Gagal menghapus peserta: ' . $e->getMessage());
            log_message('error', 'Delete participant error: ' . $e->getMessage());
        }
        
        // Redirect back to paket detail or participant list
        redirect('admin/paket-to/');
    }
}
