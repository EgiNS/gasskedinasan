<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
  *  @property  CI_Form_validation  $form_validation
 * @property CI_Upload  $upload
 * @property  Repop_tinymce_model  $repop_tinymce
 * @property Paradata_model $paradata
 * @property Ragu_ragu_model $ragu_ragu
 * @property Kode_settings_model $kode_settings

*/
class Tryout extends CI_Controller {
    protected $loginUser, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('Repop_tinymce_model', 'repop_tinymce');
        $this->load->model('Paradata_model', 'paradata');
        $this->load->model('Ragu_ragu_model', 'ragu_ragu');
        $this->load->model('Jawaban_model', 'jawaban');
        $this->load->model('Soal_model', 'soal');
        $this->load->model('Kunci_tkp_model', 'kunci_tkp');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Bobot_nilai_tiap_soal_model', 'bobot_nilai_tiap_soal');
        $this->load->model('Bobot_nilai_model', 'bobot_nilai');
        $this->load->model('User_model', 'user');
    }
    public function index()
    {
        
        $parent_title = getSubmenuTitleById(3)['title'];
        submenu_access(3);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout_skd' => $this->tryout->get('many', ['tipe_tryout' => 'SKD']),
            'tryout_mtk' => $this->tryout->get('many', ['tipe_tryout' => 'nonSKD']),
        ];

        $this->form_validation->set_rules('tryout', 'Tryout Name', 'required',[
            'required' => 'Nama tryout wajib diisi.'
                ]);
        $this->form_validation->set_rules('tipe_tryout', 'Tipe Tryout', 'required',[
            'required' => 'Tipe tryout wajib diisi.'
        ]);
        $berbayar = htmlspecialchars($this->input->post('berbayar'));
        $for_bimbel = htmlspecialchars($this->input->post('for_bimbel'));
        $freemium = htmlspecialchars($this->input->post('freemium'));

        if ($berbayar == 1)
            $this->form_validation->set_rules('harga', 'Harga', 'required|integer');

        $tipe_tryout = $this->input->post('tipe_tryout');
        $lama_pengerjaan = $this->input->post('lama_pengerjaan');
        $link = $this->input->post('link');
        $link_premium = $this->input->post('link_pre$link_premium');

        if ($this->input->post('refferal') == 1) {
            $raw_input = $this->input->post('kode_refferal');

            // 1. Bersihkan tag HTML dan ambil baris per kode
            $cleaned = strip_tags($raw_input, "<p>"); // biarkan <p> untuk sementara
            preg_match_all('/<p[^>]*>(.*?)<\/p>/', $cleaned, $matches);

            $kode_array = array_filter(array_map('trim', $matches[1])); // Ambil isi dalam <p>, trim spasi

            // 2. Ubah ke JSON jika mau disimpan dalam satu field
            $kode_json = json_encode($kode_array);
        }

        if ($tipe_tryout == 'nonSKD') {
            $this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required|numeric',[
                'numeric' => 'Jumlah soal harus berupa angka.',
                'required' => 'Jumlah soal wajib diisi.'
            ]);
            $this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required|numeric',[
                'numeric' => 'Lama pengerjaan harus berupa angka.',
                'required' => 'Lama pengerjaan wajib diisi.'
            ]);

            $jumlah_soal = $this->input->post('jumlah_soal');
        } else if ($tipe_tryout == 'SKD')
            $jumlah_soal = 110;

        if ($this->form_validation->run() == false) {
            $this->_tinymcerepop(['ket_tryout']);

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/tryout/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->load->model('Paradata_model', 'paradata');
            $this->load->model('Ragu_ragu_model', 'ragu_ragu');

            $tryout_name = htmlspecialchars($this->input->post('tryout'));

            //SLUG
            $slug = str_replace(' ', '_', strtolower($tryout_name));
            $tryout_by_slug = $this->tryout->get('one', ['slug' => $slug]);
            $tryout_by_name = $this->tryout->get('one', ['name' => $tryout_name]);
            if ($tryout_by_slug) {
                $this->session->set_flashdata('error', 'Tidak dapat menggunakan nama ujian tersebut');
                redirect('admin/tryout');
            } else if ($tryout_by_name) {
                $this->session->set_flashdata('error', 'Tryout sudah ada');
                redirect('admin/tryout');
            } else {
                $desc = $this->input->post('ket_tryout');
                $harga = htmlspecialchars($this->input->post('harga'));

                $config['upload_path'] = './assets/img/';  // Folder untuk menyimpan gambar
                $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
                $config['max_size'] = 2048;  // Maksimal ukuran file (2MB)
                $config['file_name'] = time();  // Nama file unik (timestamp)

                $this->load->library('upload', $config);

                // Load konfigurasi upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    // Jika upload berhasil, ambil informasi file yang di-upload
                    $uploadData = $this->upload->data();

                    // Dapatkan path file yang di-upload
                    $imagePath = $uploadData['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/tryout');
                }

                $data = [
                    'name' => $tryout_name,
                    'slug' => $slug,
                    'keterangan' => $desc,
                    'tipe_tryout' => $tipe_tryout,
                    'jumlah_soal' => $jumlah_soal,
                    'lama_pengerjaan' => $lama_pengerjaan,
                    'harga' => $harga,
                    'hidden' => 1,
                    'paid' => $berbayar,
                    'for_bimbel' => $for_bimbel,
                    'freemium' => $freemium,
                    'gambar' => $imagePath,
                    'link' => $link,
                    'link_premium' => $link_premium
                ];

                if ($this->input->post('refferal') == 1) {
                    $data['kode_refferal'] = $kode_json;
                    $data['harga_diskon'] = $this->input->post('diskon');
                }

                //INSERT TRYOUT
                $this->tryout->insert($data);

                //CREATE TABLE
                //PARADATA
                $this->paradata->createTable($slug);

                //RAGU-RAGU
                $this->ragu_ragu->createTable($slug, $jumlah_soal);

                //TABEL JAWABAN
                $this->jawaban->createTable($slug, $jumlah_soal);

                if ($tipe_tryout == 'SKD') {
                    //TABEL SOAL
                    $this->soal->createTableSKD($slug);

                    //TABEL KUNCI TKP
                    $this->kunci_tkp->createTable($slug);

                    //TABEL USER TRYOUT
                    $this->user_tryout->createTableSKD($slug);

                    $pilihan = ['A', 'B', 'C', 'D', 'E'];
                    foreach ($pilihan as $p)
                        $this->kunci_tkp->insert(['pilihan' => $p], $slug);

                        $user_3 = $this->user->get('many', ['role_id' => 3]);
                        $user_5 = $this->user->get('many', ['role_id' => 5]);

                        foreach ($user_3 as $u) {
                            $data = [
                                'user_id' => $u['id'],
                                'token' => 11111,
                                'status' => 0,
                                'freemium' => 1,
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }

                        foreach ($user_5 as $u) {
                            $data = [
                                'user_id' => $u['id'],
                                'token' => 11111,
                                'status' => 0,
                                'freemium' => 1
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }
                } else {
                    //TABEL SOAL
                    $this->soal->createTablenonSKD($slug);

                    //TABEL USER TRYOUT
                    $this->user_tryout->createTablenonSKD($slug);

                    //TABEL BOBOT NILAI TIAP SOAL
                    $this->bobot_nilai_tiap_soal->createTable($jumlah_soal, $slug);

                    $pilihan = ['A', 'B', 'C', 'D', 'E'];
                    foreach ($pilihan as $p)
                        $this->bobot_nilai_tiap_soal->insert(['pilihan' => $p], $slug);

                    // INSERT BOBOT NILAI
                    $jawaban = ['benar', 'salah'];
                    foreach ($jawaban as $j) {
                        $data = [
                            'jawaban' => $j,
                            'bobot' => null,
                            'tryout' => $slug,
                            'status' => 0
                        ];

                        $this->bobot_nilai->insert($data);
                    }

                        $user_4 = $this->user->get('many', ['role_id' => 4]);
                        $user_6 = $this->user->get('many', ['role_id' => 6]);

                        foreach ($user_4 as $u) {
                            $data = [
                                'email' => $u['email'],
                                'token' => 11111,
                                'status' => 0
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }

                        foreach ($user_6 as $u) {
                            $data = [
                                'email' => $u['email'],
                                'token' => 11111,
                                'status' => 0
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }

                    if ($for_bimbel == 2) {
                        $user_8 = $this->user->get('many', ['role_id' => 8]);

                        foreach ($user_8 as $u) {
                            $data = [
                                'email' => $u['email'],
                                'token' => 11111,
                                'status' => 0
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }
                    }
                }

                if ($for_bimbel == 1) {
                    $user_5 = $this->user->get('many', ['role_id' => 5]);

                    foreach ($user_5 as $u) {
                        $data = [
                            'email' => $u['email'],
                            'token' => 11111,
                            'status' => 0
                        ];

                        $this->user_tryout->insert($data, $slug);
                    }
                }

                $this->session->set_flashdata('success', 'Menambahkan Tryout Baru');
                redirect('admin/tryout');
            }
        }
    }
    
    public function detailtryout($slug)
    {
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Kode_settings_model', 'kode_settings');
                

        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $title = $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        if ($tryout['tipe_tryout'] == 'SKD') {
            $user_tryout = $this->user_tryout->getRankingSKD($slug);
        } else {
            $user_tryout = $this->user_tryout->getRankingnonSKDAdmin($slug);
        }

        if (count($user_tryout) == 0) {
            $persentase = 0;
        } else {
            $persentase = $this->jawaban->getNumRowsUnique(['waktu_selesai !=' => null], $slug) / count($user_tryout) * 100;
            $persentase = round($persentase, 2);
        }

        $user = $this->loginUser;

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout,
            'all_user' => $user_tryout,
            'jawaban' => $this->jawaban->getAll($slug, array('email', 'waktu_mulai', 'waktu_selesai')),
            'jumlah_soal' => $this->soal->getNumRows(['id >' => 0], $slug),
            'persentase_selesai' => $persentase,
            'slug' => $slug,
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode'],
            'show' => $this->db->where('to_id', $tryout['id'])->get('show_to_landingpage')->row(),
            'pendapatan' => $this->user_tryout->getPendapatan($slug),
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/tryout/detail', $data);
        $this->load->view('templates/user_footer');
    }

    private function _tinymcerepop($tinymce_content, $row_edit = null)
    {
        foreach ($tinymce_content as $tc) {
            $data = (empty($row_edit) ? $this->input->post($tc) : ($row_edit[$tc] ?? null));
            $value = $this->repop_tinymce->get('one', ['name' => $tc]);
            if ($value)
                $this->repop_tinymce->update(['value' => $data], ['name' => $tc]);
            else
                $this->repop_tinymce->insert(['name' => $tc, 'value' => $data]);
        }

        return true;
    }
}