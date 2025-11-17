<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_model $user
 * @property Role_model $role
 * @property Jawaban_model $jawaban
 * @property Kunci_tkp_model $kunci_tkp
 * @property Bobot_nilai_tiap_soal_model $bobot_nilai_tiap_soal
 * @property Bobot_nilai_model $bobot_nilai
 * @property CI_Loader $load
 * @property Pendaftar_to_model $pendaftar_to
 * @property Access_menu_model $access_menu
 * @property Access_sub_menu_model $access_sub_menu
 * @property User_tryout_model $user_tryout
 * @property CI_Form_validation $form_validation
 * @property Tryout_model $tryout
 * @property CI_Input $input
 * @property Latsol_model $latsol
 * @property CI_Session $session
 * @property Menu_model $menu
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 * @property Paket_to_model $paket_to
 * @property Kode_settings_model $kode_settings
 * @property Midtrans_payment_model $midtrans_payment
 * @property Tryout_paket_to_model $tryout_paket_to
 * @property Event_model $event
 * @property Tryout_event_model $tryout_event
 */
class Admin extends CI_Controller
{
    protected $loginUser, $tipeSoal, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();

        // Load helper database connection
        // $this->load->helper('db');
        $this->ensure_db_connection();

        is_logged_in();

        // ⚠️ JANGAN load model di constructor!
        // ⚠️ JANGAN set property shared di constructor!

        date_default_timezone_set('Asia/Jakarta');

        log_message('debug', '🔄 Constructor completed - No shared state');
    }

    function ensure_db_connection()
    {
        $ci = &get_instance();

        if (!$ci->db->conn_id) {
            $ci->db->reconnect();
            return;
        }

        $result = @$ci->db->simple_query('SELECT 1');
        if (!$result) {
            $ci->db->reconnect();
        }
    }

    public function index()
    {
        $this->_loadRequiredModels();
        $this->load->model('Midtrans_payment_model', 'midtrans_payment');

        $parent_title = getSubmenuTitleById(1)['title'];
        submenu_access(1);
        $title = $parent_title;

        $breadcrumb_item = [
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        $tryout_count = $this->tryout->getNumRows(['id >' => 0]);
        $all_tryout = $this->tryout->getAll();

        $total_peserta = 0;
        $total_soal = 0;

        foreach ($all_tryout as $at) {
            $user_count = $this->user_tryout->getNumRows(['id >' => 0], $at['slug']);
            $total_peserta += $user_count;

            $total_soal += $at['jumlah_soal'];
        }

        $tryout = $this->tryout->getAllOrderByIdDesc(['status' => 1]);

        if ($tryout) {
            if (empty($tryout[0])) {
                $tryout = $this->tryout->getAllOrderByIdDesc(['status' => 2]);
                if (empty($tryout[0])) {
                    $slug = 'not-available';
                    $tryout_available = 'not-available';
                } else {
                    $slug = $tryout[0]['slug'];
                    $tryout_available = $tryout[0];
                }
            } else {
                $slug = $tryout[0]['slug'];
                $tryout_available = $tryout[0];
            }
        } else {
            $slug = 'not-available';
            $tryout_available = 'not-available';
        }

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'jumlah_tryout' => $tryout_count,
            'total_pendapatan' => $this->midtrans_payment->getAllPendapatan(),
            'total_peserta' => $total_peserta,
            'total_soal' => $total_soal,
            'pendapatantimeseries' => $this->midtrans_payment->getPendapatanTimeSeries(),
            'persentasestatususer' => $this->user_tryout->getPersentaseStatusUser($slug),
            'tryout' => $tryout_available,
            'all_tryout' => $all_tryout
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function role()
    {
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');
        $this->load->model('Access_menu_model', 'access_menu');
        $this->load->model('Access_sub_menu_model', 'access_sub_menu');

        $parent_title = getSubmenuTitleById(2)['title'];
        submenu_access(2);

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
            'role' => $this->role->getAll(),
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/user_footer');
        } else {
            $role = $this->input->post('role');
            $this->role->insert(['role' => $role]);

            $role_id = $this->role->get('one', ['role' => $role], array('id'))['id'];

            // INSERT ACCESS PADA MENU USER DAN MENU EXAM
            $this->access_menu->insert(['role_id' => $role_id, 'menu_id' => 2]);
            $this->access_menu->insert(['role_id' => $role_id, 'menu_id' => 5]);
            $this->access_sub_menu->insert(['role_id' => $role_id, 'sub_menu_id' => 6]);
            $this->access_sub_menu->insert(['role_id' => $role_id, 'sub_menu_id' => 7]);
            $this->access_sub_menu->insert(['role_id' => $role_id, 'sub_menu_id' => 13]);

            $this->session->set_flashdata('success', 'Menambahkan Role Baru');
            redirect('admin/role');
        }
    }

    public function getUserData()
    {
        $this->load->model('User_model', 'user');
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $search = $this->input->post('search')['value'] ?? '';
        $order_column = $this->input->post('order')[0]['column'] ?? null;
        $order_dir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $list = $this->user->getAllJoinRole(
            'user.id, user.name, user.email, user.is_active, user.created_at,user.updated_at ,user_role.role',
            $length,
            $start,
            $search,
            $order_column,
            $order_dir
        );
        $data = [];
        $no = $start;
        foreach ($list as $u) {
            $no++;
            $data[] = [
                'no' => $no,
                'name' => $u->name,
                'email' => $u->email,
                'role' => $u->role,
                'is_active' => $u->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Not yet</span>',
                'created_at' => date('d M Y H:i', strtotime($u->created_at)),
                'updated_at' => date('d M Y H:i', strtotime($u->updated_at)),
                'action' => '
            <a href="' . base_url('admin/viewupdaterole/' . $u->id) . '" class="btn btn-sm bg-primary text-white">Update role</a>
            <button type="button" class="btn btn-sm bg-danger btn-delete-user text-white" data-id="' . $u->id . '">Hapus user</button>
        '
            ];
        }


        $output = [
            "draw" => $draw,
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered($search),
            "data" => $data,
        ];

        echo json_encode($output);
    }

    public function roleaccess($role_id)
    {
        $this->_loadRequiredModels();
        $submenu_parent = 2;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $role = $this->role->get('one', ['id' => $role_id]);
        $title = 'Role Access - ' . $role['role'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/role'
            ],
            [
                'title' => $role['role'],
                'href' => 'active'
            ]
        ];

        $this->load->model('Menu_model', 'menu');
        $this->load->model('Sub_menu_model', 'sub_menu');

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'role' => $role,
            'menu' => $this->menu->getAll(),
            'submenu' => $this->sub_menu->getAll()
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/user_footer');
    }

    //MENU CHANGE ACCESS
    public function menuchangeaccess()
    {
        $this->_loadRequiredModels();
        $this->load->model('Sub_menu_model', 'sub_menu');
        $this->load->model('Access_menu_model', 'access_menu');
        $this->load->model('Access_sub_menu_model', 'access_sub_menu');

        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->access_menu->getNumRows($data);
        $sub_menu = $this->sub_menu->get('many', ['menu_id' => $menu_id]);

        if ($result < 1) {
            $this->access_menu->insert($data);
            foreach ($sub_menu as $sm) {
                $this->access_sub_menu->insert([
                    'role_id' => $role_id,
                    'sub_menu_id' => $sm['id']
                ]);
            }
        } else {
            $this->access_menu->delete($data);
            foreach ($sub_menu as $sm) {
                $this->access_sub_menu->delete([
                    'role_id' => $role_id,
                    'sub_menu_id' => $sm['id']
                ]);
            }
        }

        $this->session->set_flashdata('success', 'Mengubah Akses Menu');
    }

    //SUBMENU CHANGE ACCESS
    public function submenuchangeaccess()
    {
        $this->_loadRequiredModels();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Access_menu_model', 'access_menu');
        $this->load->model('Access_sub_menu_model', 'access_sub_menu');

        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');
        $sub_menu_id = $this->input->post('subMenuId');

        $data = [
            'role_id' => $role_id,
            'sub_menu_id' => $sub_menu_id
        ];
        $user_menu = $this->menu->get('one', ['id' => $menu_id]);
        $menu_access = $this->access_menu->get('one', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        $result = $this->access_sub_menu->getNumRows($data);

        if ($menu_access) {
            if ($result < 1) {
                $this->access_sub_menu->insert($data);
            } else {
                $this->access_sub_menu->delete($data);
            }

            $this->session->set_flashdata('success', 'Mengubah Akses Submenu');
        } else {
            $this->session->set_flashdata('error', 'Akses Menu <b>' . $user_menu['menu'] . '</b> Belum Diaktifkan.<br>Silakan Aktifkan Akses Menu <b>' . $user_menu['menu'] . '</b> Terlebih Dahulu');
        }
    }

    public function updaterole($id)
    {
        $this->_loadRequiredModels();
        $parent_title = getSubmenuTitleById(2)['title'];

        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'role' => $this->role->getAll(),
        ];

        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/user_footer');
        } else {
            $role = $this->input->post('role');
            $this->role->update(['role' => $role], ['id' => $id]);

            $this->session->set_flashdata('success', 'Mengubah Role');
            redirect('admin/role');
        }
    }

    public function getupdaterole()
    {
        $this->_loadRequiredModels();
        $id = $this->input->post('id');
        $getrole = $this->role->get('one', ['id' => $id]);

        echo json_encode($getrole);
    }
    public function updateuserrole()
    {
        $this->_loadRequiredModels();
        $email = $this->input->post('email');
        $role_id = $this->input->post('role_id');

        print_r($email, $role_id);

        $user = $this->user->get('one', ['email' => $email]);

        if ($user['role_id'] == $role_id)
            $this->session->set_flashdata('error', 'Role tidak mengalami perubahan');
        else {
            $now = date("Y-m-d H:i:s", time());
            $data = [
                'role_id' => $role_id,
                'updated_at' => $now
            ];

            $this->user->update($data, ['email' => $email]);

            if ($role_id == 3) {
                $latsol_twk = $this->latsol->get('many', ['jenis' => 1]);
                foreach ($latsol_twk as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }

                $latsol_tiu = $this->latsol->get('many', ['jenis' => 2]);
                foreach ($latsol_tiu as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }

                $latsol_tkp = $this->latsol->get('many', ['jenis' => 3]);
                foreach ($latsol_tkp as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }

                $to_skd = $this->tryout->get('many', ['for_bimbel' => 1, 'tipe_tryout' => 'SKD']);
                foreach ($to_skd as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            } else if ($role_id == 4) {
                $latsol_mtk = $this->latsol->get('many', ['jenis' => 4]);
                foreach ($latsol_mtk as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }

                $to_mtk = $this->tryout->get('many', ['for_bimbel' => 1, 'tipe_tryout' => 'nonSKD']);
                foreach ($to_mtk as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            } else if ($role_id == 5) {
                $latsol = $this->latsol->getAll();
                foreach ($latsol as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }

                $to_bimbel = $this->tryout->get('many', ['for_bimbel' => 1]);
                foreach ($to_bimbel as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            } else if ($role_id == 6) {
                $to_mtk = $this->tryout->get('many', ['for_bimbel' => 1, 'tipe_tryout' => 'nonSKD']);
                foreach ($to_mtk as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            } else if ($role_id == 7) {
                $to_skd = $this->tryout->get('many', ['for_bimbel' => 1, 'tipe_tryout' => 'SKD']);
                foreach ($to_skd as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            } else if ($role_id == 8) {
                $man_ic = $this->tryout->get('many', ['for_bimbel' => 2, 'tipe_tryout' => 'nonSKD']);
                foreach ($man_ic as $l) {
                    $data_user = [
                        'email' => $email,
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data_user, $l['slug']);
                }
            }

            $this->session->set_flashdata('success', 'Mengubah Role User ' . $user['name']);
        }
        redirect('admin/role');
    }

    public function getupdateuserrole()
    {
        $this->_loadRequiredModels();
        $id = $this->input->post('id');
        $user = $this->user->get('one', ['id' => $id]);

        echo json_encode($user);
    }

    public function viewupdaterole($id)
    {
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');
        $this->load->model('Access_menu_model', 'access_menu');
        $this->load->model('Access_sub_menu_model', 'access_sub_menu');

        $parent_title = getSubmenuTitleById(2)['title'];
        submenu_access(2);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/role'
            ],
            [
                'title' => 'update role',
                'href' => 'active'
            ]
        ];

        $user = $this->user->get('one', ['id' => $id]);
        $name = $user['name'];
        $email = $user['email'];
        $role = $user['role_id'];
        $all_role = $this->role->getAll();

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'all_role' => $all_role,
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/viewupdaterole', $data);
        $this->load->view('templates/user_footer');
    }

    public function hapusrole()
    {
        $this->_loadRequiredModels();
        $id = $this->input->post('dataPost');

        if ($id >= 1 && $id <= 2)
            $this->session->set_flashdata('error', 'Tidak dapat menghapus role karena role ini merupakan role dasar yang wajib ada');
        else {
            $this->load->model('Access_menu_model', 'access_menu');
            $this->load->model('Access_sub_menu_model', 'access_sub_menu');

            $id = $this->input->post('dataPost');

            $this->access_menu->delete(['role_id' => $id]);
            $this->access_sub_menu->delete(['role_id' => $id]);

            // UPDATE ROLE ID USER KE ROLE MEMBER
            $now = date("Y-m-d H:i:s", time());
            $this->user->update(['role_id' => 2, 'updated_at' => $now], ['role_id' => $id]);
            $this->role->delete(['id' => $id]);

            $this->session->set_flashdata('success', 'Menghapus Role. User dengan role tersebut dikembalikan ke role member');
        }
    }

    public function hapususer($id)
    {
        $this->_loadRequiredModels();
        $this->user->delete(['id' => $id]);

        $this->session->set_flashdata('success', 'Menghapus User');
        redirect('admin/role');
    }

    public function hapuspeserta($id, $slug)
    {
        $this->_loadRequiredModels();
        $this->user_tryout->delete(['id' => $id], $slug);

        $this->session->set_flashdata('success', 'Menghapus Peserta');
        redirect('admin/approval/' . $slug);
    }

    public function approvepeserta($id, $slug)
    {
        $this->_loadRequiredModels();
        $this->user_tryout->update(['status' => 0], ['id' => $id], $slug);

        $this->session->set_flashdata('success', 'Approve Peserta');
        redirect('admin/approval/' . $slug);
    }

    private function _maintainDbConnection()
    {
        if (!$this->db->conn_id) {
            $this->db->reconnect();
            return;
        }

        // Coba query sederhana, jika error maka reconnect
        $result = @$this->db->simple_query('SELECT 1');
        if (!$result) {
            $this->db->reconnect();
        }
    }

    public function tambahsoal($slug)
    {
        // 🚀 ISOLATE: Setiap request load model sendiri-sendiri
        $this->_loadRequiredModels();

        // 🚀 ISOLATE: Setiap request punya data sendiri
        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $latsol = substr($slug, 0, 6);
        $jenis = ($latsol != 'latsol') ? 'tryout' : 'latsol';

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $title = 'Tambah Soal ' . $tryout['name'];

        // 🚀 ISOLATE: Hitung count untuk request ini saja
        $count_soal = $this->soal->getNumRows(['id >' => 0], $slug);
        $display_number = $count_soal + 1;

        // Validasi jumlah soal maksimum
        if ($count_soal == (int)$tryout['jumlah_soal']) {
            $this->session->set_flashdata('error', 'Tidak dapat menambahkan soal baru karena jumlah soal tryout sudah lengkap');
            redirect('admin/soal' . $jenis . '/' . $slug);
        }

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Soal',
                'href' => 'admin/soaltryout/' . $tryout['slug']
            ],
            [
                'title' => 'Tambah',
                'href' => 'active'
            ],
            [
                'title' => 'No. ' . $display_number,
                'href' => 'active'
            ]
        ];

        log_message('debug', 'AMANN SOAL ' . $display_number . ' 1 - ' . date('H:i:s'));

        // Prepare data untuk view
        $data = $this->_prepareViewData($title, $breadcrumb_item, $tryout, $slug, $parent_title, $display_number);

        log_message('debug', 'SET DATA SELESAI SOAL ' . $display_number . ' - ' . date('H:i:s'));

        $tinymce_content = ['text_soal', 'pembahasan', 'text_a', 'text_b', 'text_c', 'text_d', 'text_e'];
        // 🚀 PROSES: Pisahkan GET dan POST secara jelas
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->_handlePostRequest($slug, $tryout, $data, $display_number);
        } else {
            $this->_handleGetRequest($data, $tinymce_content);
        }
    }

    private function _loadRequiredModels()
    {
        // 🚀 Load model hanya untuk request ini
        static $loaded = false;

        if (!$loaded) {
            $this->load->model('User_model', 'user');
            $this->load->model('Role_model', 'role');
            $this->load->model('Jawaban_model', 'jawaban');
            $this->load->model('Kunci_tkp_model', 'kunci_tkp');
            $this->load->model('Bobot_nilai_tiap_soal_model', 'bobot_nilai_tiap_soal');
            $this->load->model('Bobot_nilai_model', 'bobot_nilai');
            $this->load->model('Soal_model', 'soal');
            $this->load->model('Tryout_model', 'tryout');
            $this->load->model('Latsol_model', 'latsol');
            $this->load->model('User_tryout_model', 'user_tryout');
            $this->load->model('Repop_tinymce_model', 'repop_tinymce');

            $this->loginUser = $this->user->getLoginUser();
            $this->sidebarMenu = 'Admin';
            $this->tipeSoal = $this->soal->getAllTipeSoal();

            $loaded = true;
            log_message('debug', '📚 Models loaded for this request');
        }
    }

    private function _handleGetRequest($data, $tinymce_content)
    {
        // 🚀 Hanya untuk menampilkan form
        log_message('debug', '📄 GET Request - Displaying form');

        $this->_tinymcerepop($tinymce_content);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/tambahsoal', $data);
        $this->load->view('templates/user_footer');
    }

    private function _handlePostRequest($slug, $tryout, $data, $display_number)
    {
        // 🚀 Hanya untuk proses submission
        log_message('debug', '📨 POST Request - Processing submission for soal: ' . $display_number);

        // Setup validation rules
        $this->_setupValidationRules($tryout, $display_number);

        log_message('debug', 'AMANN 2 SOAL ' . $display_number . ' - ' . date('H:i:s'));

        $tinymce_content = ['text_soal', 'pembahasan', 'text_a', 'text_b', 'text_c', 'text_d', 'text_e'];

        if ($this->form_validation->run() == false) {
            // Validation failed - show form dengan error
            log_message('debug', '❌ Validation failed for soal: ' . $display_number);
            $this->_showFormWithErrors($data, $tinymce_content);
        } else {
            // Validation success - process data
            log_message('debug', '✅ Validation passed for soal: ' . $display_number);
            $this->_processSubmission($slug, $tryout, $tinymce_content, $display_number);
        }
    }

    private function _processSubmission($slug, $tryout, $tinymce_content, $expected_number)
    {
        // 🚀 FORCE fresh database connection
        $this->db->reconnect();

        // 🚀 START TRANSACTION dengan isolation
        $this->db->trans_start();
        $this->db->query("SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE");

        try {
            log_message('debug', '🟢 TRANSACTION START for expected number: ' . $expected_number);

            // 🚀 ATOMIC: Verify and get actual number
            $current_count = $this->soal->getNumRows(['id >' => 0], $slug);
            $actual_number = $current_count + 1;

            // 🚀 VERIFY: Pastikan number masih sesuai
            if ($actual_number != $expected_number) {
                throw new Exception("Number mismatch! Expected: {$expected_number}, Actual: {$actual_number}. Soal mungkin sudah ditambahkan oleh request lain.");
            }

            log_message('debug', '🔢 Verified number: ' . $actual_number);

            // 🚀 PROSES penyimpanan dengan $actual_number
            $this->_saveSoalData($slug, $tryout, $actual_number, $tinymce_content);

            // 🚀 COMMIT transaction
            $this->db->trans_commit();

            log_message('debug', '✅ TRANSACTION COMMITTED - Soal: ' . $actual_number);
            log_message('debug', 'AMANN 8 SOAL ' . $actual_number);

            $this->session->set_flashdata('success', 'Soal nomor ' . $actual_number . ' berhasil disimpan!');
            redirect('admin/tambahsoal/' . $slug);
        } catch (Exception $e) {
            // 🚀 ROLLBACK jika error
            $this->db->trans_rollback();
            log_message('error', '❌ TRANSACTION FAILED: ' . $e->getMessage());

            $this->_tinymcerepop($tinymce_content);
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('admin/tambahsoal/' . $slug);
        }
    }

    private function _setupValidationRules($tryout, $display_number)
    {
        $start_time = microtime(true);
        if (!$this->input->post('cek_soal', true))
            $this->form_validation->set_rules('text_soal', 'Teks Soal', 'required|trim', [
                'required' => 'Teks soal wajib diisi.'
            ]);
        $end_time = microtime(true);
        log_message('debug', 'VALIDASI TEXT_SOAL SOAL ' . $display_number . ': ' . round(($end_time - $start_time) * 1000, 2) . ' ms - ' . date('H:i:s'));

        // VALIDASI 2: Pilihan Jawaban
        $start_time = microtime(true);
        if ($this->input->post('cek_pilihan', true) == '1') {
            $this->form_validation->set_rules('text_a', 'Pilihan A', 'required|trim', [
                'required' => 'Pilihan A wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_b', 'Pilihan B', 'required|trim', [
                'required' => 'Pilihan B wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_c', 'Pilihan C', 'required|trim', [
                'required' => 'Pilihan C wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_d', 'Pilihan D', 'trim');
            $this->form_validation->set_rules('text_e', 'Pilihan E', 'trim');
        }
        $end_time = microtime(true);
        log_message('debug', 'VALIDASI PILIHAN SOAL ' . $display_number . ': ' . round(($end_time - $start_time) * 1000, 2) . ' ms - ' . date('H:i:s'));

        // VALIDASI 3: Tipe Tryout SKD
        $start_time = microtime(true);
        if ($tryout['tipe_tryout'] == 'SKD') {
            $this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'greater_than[0]', [
                'greater_than' => 'Tipe soal wajib diisi.'
            ]);

            if ($this->input->post('tipe_soal') != 3)
                $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'alpha', [
                    'alpha' => 'Kunci jawaban wajib diisi.'
                ]);
            else {
                $this->form_validation->set_rules('nilai_a', 'Nilai A', 'greater_than[0]', [
                    'greater_than' => 'Nilai A wajib diisi.'
                ]);
                $this->form_validation->set_rules('nilai_b', 'Nilai B', 'greater_than[0]', [
                    'greater_than' => 'Nilai B wajib diisi.'
                ]);
                $this->form_validation->set_rules('nilai_c', 'Nilai C', 'greater_than[0]', [
                    'greater_than' => 'Nilai C wajib diisi.'
                ]);
                $this->form_validation->set_rules('nilai_d', 'Nilai D', 'greater_than[0]', [
                    'greater_than' => 'Nilai D wajib diisi.'
                ]);
                $this->form_validation->set_rules('nilai_e', 'Nilai E', 'greater_than[0]', [
                    'greater_than' => 'Nilai E wajib diisi.'
                ]);
            }
        } else if ($tryout['tipe_tryout'] == 'nonSKD') {
            if (!$this->input->post('cek_kunci'))
                $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'alpha', [
                    'alpha' => 'Kunci jawaban wajib diisi.'
                ]);
        }
        $end_time = microtime(true);
        log_message('debug', 'VALIDASI TIPETRYOUT SOAL ' . $display_number . ': ' . round(($end_time - $start_time) * 1000, 2) . ' ms - ' . date('H:i:s'));
    }

    private function _saveSoalData($slug, $tryout, $actual_number, $tinymce_content)
    {
        //INISIASI VARIABEL
        $gambar_a = null;
        $gambar_b = null;
        $gambar_c = null;
        $gambar_d = null;
        $gambar_e = null;
        $text_a = null;
        $text_b = null;
        $text_c = null;
        $text_d = null;
        $text_e = null;
        $gambar_pembahasan = null;

        //CONFIQ GAMBAR
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '1024';
        $config['upload_path'] = './assets/img/soal/';
        $this->load->library('upload', $config);

        if ($tryout['tipe_tryout'] == 'SKD')
            //TIPE SOAL
            $tipe_soal = $this->input->post('tipe_soal', true);

        //KUNCI JAWABAN
        $kunci_jawaban = $this->input->post('kunci_jawaban', true);

        // var_dump($this->upload->do_upload('gambar_pembahasan'));
        // var_dump($this->upload->do_upload('gambar_a'));
        // var_dump($this->upload->do_upload('gambar_b'));die;

        //PEMBAHASAN GAMBAR
        if ($this->input->post('cek_pembahasan', true)) {
            if ($this->upload->do_upload('gambar_pembahasan'))
                $gambar_pembahasan = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error_gbr_pembahasan', $error);
                redirect('admin/tambahsoal/' . $slug);
            }
        }

        //PEMBAHASAN TEKS
        $pembahasan = $this->input->post('pembahasan', true);

        $email_kunci_twk_tiu = 'kunci_jawaban_' . $slug . '@gmail.com';

        log_message('debug', 'AMANN 3');

        if ($tryout['tipe_tryout'] == 'SKD') {
            // $this->_maintainDbConnection();
            //UNTUK NGECEK APAKAH JUMLAH SOAL PADA TIAP PAKET SOAL SUDAH PENUH
            $jumlah_soal_twk = $this->soal->getNumRows(['tipe_soal' => 1], $slug);
            $jumlah_soal_tiu = $this->soal->getNumRows(['tipe_soal' => 2], $slug);
            $jumlah_soal_tkp = $this->soal->getNumRows(['tipe_soal' => 3], $slug);


            if ($tipe_soal == 1) {
                if ($jumlah_soal_twk == 30) {
                    $this->_tinymcerepop($tinymce_content);

                    $this->session->set_flashdata('error', 'Maaf, jumlah soal TWK sudah 30 soal');
                    redirect('admin/tambahsoal/' . $slug);
                } else {
                    $nomor = $jumlah_soal_twk + 1;
                    $token = 'twk-' . $this->grs();
                }
            } else if ($tipe_soal == 2) {
                if ($jumlah_soal_tiu == 35) {
                    $this->_tinymcerepop($tinymce_content);

                    $this->session->set_flashdata('error', 'Maaf, jumlah soal TIU sudah 35 soal');
                    redirect('admin/tambahsoal/' . $slug);
                } else {
                    $nomor = $jumlah_soal_tiu + 31;
                    $token = 'tiu-' . $this->grs();
                }
            } else {
                if ($jumlah_soal_tkp == 45) {
                    $this->_tinymcerepop($tinymce_content);

                    $this->session->set_flashdata('error', 'Maaf, jumlah soal TKP sudah 45 soal');
                    redirect('admin/tambahsoal/' . $slug);
                } else {
                    $nomor = $jumlah_soal_tkp + 66;
                    $token = 'tkp-' . $this->grs();
                }
            }

            //INSERT KUNCI JAWABAN
            if ($tipe_soal != 3)
                $this->jawaban->update(
                    [
                        '`' . $nomor . '`' => $kunci_jawaban
                    ],
                    [
                        'email' => $email_kunci_twk_tiu
                    ],
                    $slug
                );
            else {
                $A = $this->input->post('nilai_a');
                $B = $this->input->post('nilai_b');
                $C = $this->input->post('nilai_c');
                $D = $this->input->post('nilai_d');
                $E = $this->input->post('nilai_e');

                $nilai = [$A, $B, $C, $D, $E];
                $pilihan = ['A', 'B', 'C', 'D', 'E'];

                for ($i = 0; $i <= 4; $i++) {
                    $n = $nilai[$i];
                    $p = $pilihan[$i];
                    $this->kunci_tkp->update(
                        [
                            '`' . $nomor . '`' => $n
                        ],
                        [
                            'pilihan' => $p
                        ],
                        $slug
                    );
                }
            }
        } else if ($tryout['tipe_tryout'] == 'nonSKD') {
            // $this->_maintainDbConnection();
            $jumlah_soal = $this->soal->getNumRows(['id >' => 0], $slug);
            if ($jumlah_soal == $tryout['jumlah_soal']) {
                $this->_tinymcerepop($tinymce_content);

                $this->session->set_flashdata('error', 'Maaf, jumlah soal sudah maksimum');
                redirect('admin/tambahsoal/' . $slug);
            } else {
                $token = $this->grs(20);
                $nomor = $jumlah_soal + 1;
            }

            if ($this->input->post('cek_kunci'))
                $kunci_jawaban = 'Z';

            $this->jawaban->update(
                [
                    '`' . $nomor . '`' => $kunci_jawaban
                ],
                [
                    'email' => $email_kunci_twk_tiu
                ],
                $slug
            );

            log_message('debug', 'AMANN 4');
        }

        //----SOAL DAN PILIHAN JAWABAN DALAM BENTUK GAMBAR----
        if ($this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '2') {
            // $this->_maintainDbConnection();

            $text_soal = $this->input->post('text_soal', true);

            // GAMBAR SOAL WAJIB DI SINI
            if ($this->upload->do_upload('gambar_soal'))
                $gambar_soal = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_soal', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // A WAJIB
            if ($this->upload->do_upload('gambar_a'))
                $gambar_a = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_a', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // B WAJIB
            if ($this->upload->do_upload('gambar_b'))
                $gambar_b = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_b', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // C WAJIB
            if ($this->upload->do_upload('gambar_c'))
                $gambar_c = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_c', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // D TIDAK WAJIB
            if ($this->upload->do_upload('gambar_d'))
                $gambar_d = $this->upload->data("file_name");
            else if (empty($_FILES['gambar_d']['name'])) {
                //
            } else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_d', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // E TIDAK WAJIB
            if ($this->upload->do_upload('gambar_e'))
                $gambar_e = $this->upload->data("file_name");
            else if (empty($_FILES['gambar_e']['name'])) {
                //
            } else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_e', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            log_message('debug', 'AMANN 5');

            if ($tryout['tipe_tryout'] == 'SKD')
                $data = [
                    'id' => $nomor,
                    'tipe_soal' => $tipe_soal,
                    'text_soal' => $text_soal,
                    'gambar_soal' => $gambar_soal,
                    'gambar_a' => $gambar_a,
                    'gambar_b' => $gambar_b,
                    'gambar_c' => $gambar_c,
                    'gambar_d' => $gambar_d,
                    'gambar_e' => $gambar_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            else if ($tryout['tipe_tryout'] == 'nonSKD')
                $data = [
                    'id' => $nomor,
                    'text_soal' => $text_soal,
                    'gambar_soal' => $gambar_soal,
                    'gambar_a' => $gambar_a,
                    'gambar_b' => $gambar_b,
                    'gambar_c' => $gambar_c,
                    'gambar_d' => $gambar_d,
                    'gambar_e' => $gambar_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            $this->soal->insert($data, $slug);
        }


        //----SOAL DALAM BENTUK GAMBAR DAN PILIHAN DALAM BENTUK TEKS----
        else if ($this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '1') {
            // $this->_maintainDbConnection();

            $text_soal = $this->input->post('text_soal', true);

            // GAMBAR WAJIB DI SINI
            if ($this->upload->do_upload('gambar_soal'))
                $gambar_soal = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_soal', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            if ($this->input->post('text_a', true))
                $text_a = $this->input->post('text_a', true);

            if ($this->input->post('text_b', true))
                $text_b = $this->input->post('text_b', true);

            if ($this->input->post('text_c', true))
                $text_c = $this->input->post('text_c', true);

            if ($this->input->post('text_d', true))
                $text_d = $this->input->post('text_d', true);

            if ($this->input->post('text_e', true))
                $text_e = $this->input->post('text_e', true);

            log_message('debug', 'AMANN 6');

            if ($tryout['tipe_tryout'] == 'SKD')
                $data = [
                    'id' => $nomor,
                    'tipe_soal' => $tipe_soal,
                    'text_soal' => $text_soal,
                    'gambar_soal' => $gambar_soal,
                    'text_a' => $text_a,
                    'text_b' => $text_b,
                    'text_c' => $text_c,
                    'text_d' => $text_d,
                    'text_e' => $text_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            else if ($tryout['tipe_tryout'] == 'nonSKD')
                $data = [
                    'id' => $nomor,
                    'text_soal' => $text_soal,
                    'gambar_soal' => $gambar_soal,
                    'text_a' => $text_a,
                    'text_b' => $text_b,
                    'text_c' => $text_c,
                    'text_d' => $text_d,
                    'text_e' => $text_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            $this->soal->insert($data, $slug);
        }

        //----SOAL DALAM BENTUK TEKS DAN PILIHAN JAWABAN DALAM BENTUK GAMBAR----
        else if (!$this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '2') {
            // $this->_maintainDbConnection();


            $text_soal = $this->input->post('text_soal', true);

            // A WAJIB
            if ($this->upload->do_upload('gambar_a'))
                $gambar_a = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_a', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // B WAJIB
            if ($this->upload->do_upload('gambar_b'))
                $gambar_b = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_b', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // C WAJIB
            if ($this->upload->do_upload('gambar_c'))
                $gambar_c = $this->upload->data('file_name');
            else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_c', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // D TIDAK WAJIB
            if ($this->upload->do_upload('gambar_d'))
                $gambar_d = $this->upload->data("file_name");
            else if (empty($_FILES['gambar_d']['name'])) {
                //
            } else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_d', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            // E TIDAK WAJIB
            if ($this->upload->do_upload('gambar_e'))
                $gambar_e = $this->upload->data("file_name");
            else if (empty($_FILES['gambar_e']['name'])) {
                //
            } else {
                $this->_tinymcerepop($tinymce_content);

                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Something wrong');
                $this->session->set_flashdata('error_gbr_e', $error);
                redirect('admin/tambahsoal/' . $slug);
            }

            log_message('debug', 'AMANN 7');

            if ($tryout['tipe_tryout'] == 'SKD')
                $data = [
                    'id' => $nomor,
                    'tipe_soal' => $tipe_soal,
                    'text_soal' => $text_soal,
                    'gambar_a' => $gambar_a,
                    'gambar_b' => $gambar_b,
                    'gambar_c' => $gambar_c,
                    'gambar_d' => $gambar_d,
                    'gambar_e' => $gambar_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            else if ($tryout['tipe_tryout'] == 'nonSKD')
                $data = [
                    'id' => $nomor,
                    'text_soal' => $text_soal,
                    'gambar_a' => $gambar_a,
                    'gambar_b' => $gambar_b,
                    'gambar_c' => $gambar_c,
                    'gambar_d' => $gambar_d,
                    'gambar_e' => $gambar_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            $this->soal->insert($data, $slug);
        }


        //----SOAL DAN PILIHAN JAWABAN DALAM BENTUK TEKS----
        else if (!$this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '1') {
            // $this->_maintainDbConnection();


            $text_soal = $this->input->post('text_soal', true);

            if ($this->input->post('text_a', true))
                $text_a = $this->input->post('text_a', true);

            if ($this->input->post('text_b', true))
                $text_b = $this->input->post('text_b', true);

            if ($this->input->post('text_c', true))
                $text_c = $this->input->post('text_c', true);

            if ($this->input->post('text_d', true))
                $text_d = $this->input->post('text_d', true);

            if ($this->input->post('text_e', true))
                $text_e = $this->input->post('text_e', true);

            // log_message('debug', 'AMANN 8 SOAL ' . $next_number);

            if ($tryout['tipe_tryout'] == 'SKD')
                $data = [
                    'id' => $nomor,
                    'tipe_soal' => $tipe_soal,
                    'text_soal' => $text_soal,
                    'text_a' => $text_a,
                    'text_b' => $text_b,
                    'text_c' => $text_c,
                    'text_d' => $text_d,
                    'text_e' => $text_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            else if ($tryout['tipe_tryout'] == 'nonSKD')
                $data = [
                    'id' => $nomor,
                    'text_soal' => $text_soal,
                    'text_a' => $text_a,
                    'text_b' => $text_b,
                    'text_c' => $text_c,
                    'text_d' => $text_d,
                    'text_e' => $text_e,
                    'gambar_pembahasan' => $gambar_pembahasan,
                    'pembahasan' => $pembahasan,
                    'token' => $token
                ];
            $this->soal->insert($data, $slug);
        }
    }

    private function _prepareViewData($title, $breadcrumb_item, $tryout, $slug, $parent_title, $display_number)
    {
        $base_data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tipe_soal' => $this->tipeSoal,
            'tryout' => $tryout,
            'display_number' => $display_number
        ];

        if ($tryout['tipe_tryout'] == 'nonSKD') {
            $base_data['bobot_nilai'] = $this->bobot_nilai->get('one', ['tryout' => $slug]);
            $base_data['bobot_nilai_tiap_soal'] = $this->bobot_nilai_tiap_soal->get('one', ['id' => 1], $slug);
        } else {
            $base_data['bobot_nilai'] = $this->bobot_nilai->get('one', ['tryout' => $slug]);
        }

        return $base_data;
    }

    private function _showFormWithErrors($data, $tinymce_content)
    {
        $this->_tinymcerepop($tinymce_content);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/tambahsoal', $data);
        $this->load->view('templates/user_footer');
    }

    //-----EDIT SOAL-----
    public function editsoal($token_edit)
    {
        $this->_loadRequiredModels();
        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $slug = $this->input->get('tryout');
        $soal = $this->soal->get('one', ['token' => $token_edit], $slug);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $title = 'Edit No. ' . $soal['id'] . ' ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Soal',
                'href' => 'admin/soaltryout/' . $tryout['slug']
            ],
            [
                'title' => 'Edit',
                'href' => 'active'
            ],
            [
                'title' => 'No. ' . $soal['id'],
                'href' => 'active'
            ]
        ];

        $email_kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';

        if ($tryout['status'] == 1) {
            $this->session->set_flashdata('error', 'Tidak dapat mengubah soal karena Tryout sudah di-release');
            redirect('admin/soaltryout/' . $slug);
        }
        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tipe_soal' => $this->tipeSoal,
            'soal' => $soal,
            'kunci_jawaban' => $this->jawaban->get('one', ['email' => $email_kunci_jawaban], $slug),
            'page' => $this->input->get('per_page'),
            'tryout' => $tryout,
            'bobot_nilai' => $this->bobot_nilai->get('one', ['tryout' => $slug])
        ];

        if (!$this->input->post('cek_soal', true))
            $this->form_validation->set_rules('text_soal', 'Teks Soal', 'required|trim', [
                'required' => 'Teks soal wajib diisi.'
            ]);

        if ($this->input->post('cek_pilihan', true) == '1') {
            $this->form_validation->set_rules('text_a', 'Pilihan A', 'required|trim', [
                'required' => 'Pilihan A wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_b', 'Pilihan B', 'required|trim', [
                'required' => 'Pilihan B wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_c', 'Pilihan C', 'required|trim', [
                'required' => 'Pilihan C wajib diisi.'
            ]);
            $this->form_validation->set_rules('text_d', 'Pilihan D', 'trim');
            $this->form_validation->set_rules('text_e', 'Pilihan E', 'trim');
        }

        if ($tryout['tipe_tryout'] == 'SKD') {
            $data['kunci_tkp_a'] = $this->kunci_tkp->get('one', ['pilihan' => 'A'], $slug);
            $data['kunci_tkp_b'] = $this->kunci_tkp->get('one', ['pilihan' => 'B'], $slug);
            $data['kunci_tkp_c'] = $this->kunci_tkp->get('one', ['pilihan' => 'C'], $slug);
            $data['kunci_tkp_d'] = $this->kunci_tkp->get('one', ['pilihan' => 'D'], $slug);
            $data['kunci_tkp_e'] = $this->kunci_tkp->get('one', ['pilihan' => 'E'], $slug);

            $this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'greater_than[0]', [
                'greater_than' => 'Tipe Soal must be required'
            ]);

            if ($this->input->post('tipe_soal') != 3)
                $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'alpha', [
                    'alpha' => 'Kunci jawaban harus diisi.'
                ]);
            else {
                $this->form_validation->set_rules('nilai_a', 'Nilai A', 'greater_than[0]', [
                    'greater_than' => 'Nilai A harus diisi.'
                ]);
                $this->form_validation->set_rules('nilai_b', 'Nilai B', 'greater_than[0]', [
                    'greater_than' => 'Nilai B harus diisi.'
                ]);
                $this->form_validation->set_rules('nilai_c', 'Nilai C', 'greater_than[0]', [
                    'greater_than' => 'Nilai C harus diisi.'
                ]);
                $this->form_validation->set_rules('nilai_d', 'Nilai D', 'greater_than[0]', [
                    'greater_than' => 'Nilai D harus diisi.'
                ]);
                $this->form_validation->set_rules('nilai_e', 'Nilai E', 'greater_than[0]', [
                    'greater_than' => 'Nilai E harus diisi.'
                ]);
            }
        } else if ($tryout['tipe_tryout'] == 'nonSKD')
            if (!$this->input->post('cek_kunci'))
                $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'alpha', [
                    'alpha' => 'Kunci jawaban wajib diisi.'
                ]);

        //NOMOR PAGINATION
        $page = $this->input->post('page');


        $tinymce_content = ['text_soal', 'pembahasan', 'text_a', 'text_b', 'text_c', 'text_d', 'text_e'];
        if ($this->form_validation->run() == false) {
            $submit = $this->input->post('edit_submit');
            if ($submit != null)
                $this->_tinymcerepop($tinymce_content);
            else
                $this->_tinymcerepop($tinymce_content, $soal);

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/editsoal', $data);
            $this->load->view('templates/user_footer');
        } else {
            $soal = $data['soal'];

            //INISIASI VARIABEL
            $path_gambar_soal = FCPATH . 'assets/img/soal/';
            $gambar_soal = $soal['gambar_soal'];
            $gambar_a = $soal['gambar_a'];
            $gambar_b = $soal['gambar_b'];
            $gambar_c = $soal['gambar_c'];
            $gambar_d = $soal['gambar_d'];
            $gambar_e = $soal['gambar_e'];
            $text_a =  $soal['text_a'];
            $text_b =  $soal['text_b'];
            $text_c =  $soal['text_c'];
            $text_d =  $soal['text_d'];
            $text_e =  $soal['text_e'];
            // $pembahasan = $soal['pembahasan'];
            $gambar_pembahasan = $soal['gambar_pembahasan'];

            //CONFIQ GAMBAR
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/soal/';
            $this->load->library('upload', $config);

            if ($tryout['tipe_tryout'] == 'SKD')
                //TIPE SOAL
                $tipe_soal = $this->input->post('tipe_soal', true);

            //KUNCI JAWABAN
            $kunci_jawaban = $this->input->post('kunci_jawaban', true);

            //PEMBAHASAN GAMBAR
            if ($this->input->post('cek_pembahasan', true)) {
                // var_dump($gambar_pembahasan);die;
                if ($this->upload->do_upload('gambar_pembahasan')) {
                    if (!empty($gambar_pembahasan)) {
                        if (file_exists($path_gambar_soal . $gambar_pembahasan))
                            unlink($path_gambar_soal . $gambar_pembahasan);
                    }
                    $gambar_pembahasan = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_pembahasan']['name'])) {
                    if (empty($gambar_pembahasan)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_pembahasan', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_pembahasan', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }
            } else {
                if (!empty($gambar_pembahasan)) {
                    if (file_exists($path_gambar_soal . $gambar_pembahasan))
                        unlink($path_gambar_soal . $gambar_pembahasan);

                    $gambar_pembahasan = null;
                }
            }

            //PEMBAHASAN TEKS
            $pembahasan = $this->input->post('pembahasan', true);

            //NOMOR SOAL
            $nomor = $this->input->post('id_soal', true);

            if ($tryout['tipe_tryout'] == 'SKD') {
                //UNTUK NGECEK APAKAH JUMLAH SOAL PADA TIAP PAKET SOAL SUDAH PENUH
                $jumlah_soal_twk = $this->soal->getNumRows(['tipe_soal' => 1], $slug);
                $jumlah_soal_tiu = $this->soal->getNumRows(['tipe_soal' => 2], $slug);
                $jumlah_soal_tkp = $this->soal->getNumRows(['tipe_soal' => 3], $slug);

                //JIKA PAKET SOAL BERUBAH
                if ($tipe_soal != $soal['tipe_soal']) {
                    if ($tipe_soal == 1) {
                        if ($jumlah_soal_twk == 30) {
                            $this->_tinymcerepop($tinymce_content);

                            $this->session->set_flashdata('error', 'Maaf, jumlah soal TWK sudah 30 soal');
                            redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                        } else {
                            $token = 'twk-' . $this->grs();
                            $nomor = $jumlah_soal_twk + 1;
                        }
                    } else if ($tipe_soal == 2) {
                        if ($jumlah_soal_tiu == 35) {
                            $this->_tinymcerepop($tinymce_content);

                            $this->session->set_flashdata('error', 'Maaf, jumlah soal TIU sudah 35 soal');
                            redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                        } else {
                            $token = 'tiu-' . $this->grs();
                            $nomor = $jumlah_soal_tiu + 1;
                        }
                    } else {
                        if ($jumlah_soal_tkp == 45) {
                            $this->_tinymcerepop($tinymce_content);

                            $this->session->set_flashdata('error', 'Maaf, jumlah soal TKP sudah 45 soal');
                            redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                        } else {
                            $token = 'tkp-' . $this->grs();
                            $nomor = $jumlah_soal_tkp + 1;
                        }
                    }

                    // $this->hapussoal($token_edit, $slug);

                    // $this->soal->update([
                    //     'id' => $nomor + 1,
                    //     'token' => $token
                    // ], [
                    //     'pk' => $soal['pk']
                    // ], $slug);
                } else
                    $token = $token_edit;

                //INSERT KUNCI JAWABAN
                if ($tipe_soal != 3)
                    $this->jawaban->update(
                        [
                            '`' . $nomor . '`' => $kunci_jawaban
                        ],
                        [
                            'email' => $email_kunci_jawaban
                        ],
                        $slug
                    );
                else {
                    $A = $this->input->post('nilai_a');
                    $B = $this->input->post('nilai_b');
                    $C = $this->input->post('nilai_c');
                    $D = $this->input->post('nilai_d');
                    $E = $this->input->post('nilai_e');

                    $nilai = [$A, $B, $C, $D, $E];
                    $pilihan = ['A', 'B', 'C', 'D', 'E'];

                    for ($i = 0; $i <= 4; $i++) {
                        $n = $nilai[$i];
                        $p = $pilihan[$i];
                        $this->kunci_tkp->update(
                            [
                                '`' . $nomor . '`' => $n
                            ],
                            [
                                'pilihan' => $p
                            ],
                            $slug
                        );
                    }
                }
            } else if ($tryout['tipe_tryout'] == 'nonSKD') {

                if ($this->input->post('cek_kunci'))
                    $kunci_jawaban = 'Z';

                $this->jawaban->update(
                    [
                        '`' . $nomor . '`' => $kunci_jawaban
                    ],
                    [
                        'email' => $email_kunci_jawaban
                    ],
                    $slug
                );

                $token = $token_edit;
            }

            // $query_drop = "ALTER TABLE `soal` DROP `id`";
            // $query_make = "ALTER TABLE `soal` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";


            //----SOAL DAN PILIHAN JAWABAN DALAM BENTUK GAMBAR----
            if ($this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '2') {

                $text_soal = $this->input->post('text_soal', true);

                // GAMBAR SOAL
                if ($this->upload->do_upload('gambar_soal')) {
                    if (!empty($gambar_soal)) {
                        if (file_exists($path_gambar_soal . $gambar_soal))
                            unlink($path_gambar_soal . $gambar_soal);
                    }

                    $gambar_soal = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_soal']['name'])) {
                    if (empty($gambar_soal)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_soal', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_soal', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                // GAMBAR PILIHAN A
                if ($this->upload->do_upload('gambar_a')) {
                    if (!empty($gambar_a)) {
                        if (file_exists($path_gambar_soal . $gambar_a))
                            unlink($path_gambar_soal . $gambar_a);
                    }

                    $gambar_a = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_a']['name'])) {
                    if (empty($gambar_a)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_a', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_a', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                // GAMBAR PILIHAN B
                if ($this->upload->do_upload('gambar_b')) {
                    if (!empty($gambar_b)) {
                        if (file_exists($path_gambar_soal . $gambar_b))
                            unlink($path_gambar_soal . $gambar_b);
                    }

                    $gambar_b = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_b']['name'])) {
                    if (empty($gambar_b)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_b', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_b', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                // GAMBAR PILIHAN C
                if ($this->upload->do_upload('gambar_c')) {
                    if (!empty($gambar_c)) {
                        if (file_exists($path_gambar_soal . $gambar_c))
                            unlink($path_gambar_soal . $gambar_c);
                    }

                    $gambar_c = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_c']['name'])) {
                    if (empty($gambar_c)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_c', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_c', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                // GAMBAR PILIHAN D
                if ($this->upload->do_upload('gambar_d')) {
                    if (!empty($gambar_d)) {
                        if (file_exists($path_gambar_soal . $gambar_d))
                            unlink($path_gambar_soal . $gambar_d);
                    }

                    $gambar_d = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_d']['name']))
                    $gambar_d = $gambar_d;
                else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_d', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                // GAMBAR PILIHAN E
                if ($this->upload->do_upload('gambar_e')) {
                    if (!empty($gambar_e)) {
                        if (file_exists($path_gambar_soal . $gambar_e))
                            unlink($path_gambar_soal . $gambar_e);
                    }

                    $gambar_e = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_e']['name']))
                    $gambar_e = $gambar_e;
                else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_e', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                }

                if ($tryout['tipe_tryout'] == 'SKD') {
                    $data = [
                        'id' => $nomor,
                        'tipe_soal' => $tipe_soal,
                        'gambar_soal' => $gambar_soal,
                        'text_soal' => $text_soal,
                        'gambar_a' => $gambar_a,
                        'gambar_b' => $gambar_b,
                        'gambar_c' => $gambar_c,
                        'gambar_d' => $gambar_d,
                        'gambar_e' => $gambar_e,
                        'text_a' => null,
                        'text_b' => null,
                        'text_c' => null,
                        'text_d' => null,
                        'text_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    if ($tipe_soal != $soal['tipe_soal']) {
                        $this->soal->insert($data, $slug);
                        $this->hapussoal($token_edit, $slug);
                    } else
                        $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                    $data = [
                        'id' => $nomor,
                        'gambar_soal' => $gambar_soal,
                        'text_soal' => $text_soal,
                        'gambar_a' => $gambar_a,
                        'gambar_b' => $gambar_b,
                        'gambar_c' => $gambar_c,
                        'gambar_d' => $gambar_d,
                        'gambar_e' => $gambar_e,
                        'text_a' => null,
                        'text_b' => null,
                        'text_c' => null,
                        'text_d' => null,
                        'text_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                }
            }


            //----SOAL DALAM BENTUK GAMBAR DAN PILIHAN DALAM BENTUK TEKS----
            else if ($this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '1') {

                $text_soal = $this->input->post('text_soal', true);

                // GAMBAR SOAL
                if ($this->upload->do_upload('gambar_soal')) {
                    if (!empty($gambar_soal)) {
                        if (file_exists($path_gambar_soal . $gambar_soal))
                            unlink($path_gambar_soal . $gambar_soal);
                    }

                    $gambar_soal = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_soal']['name'])) {
                    if (empty($gambar_soal)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_soal', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_soal', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                if ($this->input->post('text_a', true))
                    $text_a = $this->input->post('text_a', true);

                if ($this->input->post('text_b', true))
                    $text_b = $this->input->post('text_b', true);

                if ($this->input->post('text_c', true))
                    $text_c = $this->input->post('text_c', true);

                if ($this->input->post('text_d', true))
                    $text_d = $this->input->post('text_d', true);

                if ($this->input->post('text_e', true))
                    $text_e = $this->input->post('text_e', true);

                if (!empty($gambar_a)) {
                    $gambar_jawaban = [];
                    array_push($gambar_a, $gambar_b, $gambar_c, $gambar_d, $gambar_e);

                    foreach ($gambar_jawaban as $gj) {
                        if (!empty($gambar_gj)) {
                            if (file_exists($path_gambar_soal . $gj))
                                unlink($path_gambar_soal . $gj);
                        }
                    }
                }

                if ($tryout['tipe_tryout'] == 'SKD') {
                    $data = [
                        'id' => $nomor,
                        'tipe_soal' => $tipe_soal,
                        'gambar_soal' => $gambar_soal,
                        'text_soal' => $text_soal,
                        'gambar_a' => null,
                        'gambar_b' => null,
                        'gambar_c' => null,
                        'gambar_d' => null,
                        'gambar_e' => null,
                        'text_a' => $text_a,
                        'text_b' => $text_b,
                        'text_c' => $text_c,
                        'text_d' => $text_d,
                        'text_e' => $text_e,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    if ($tipe_soal != $soal['tipe_soal']) {
                        $this->soal->insert($data, $slug);
                        $this->hapussoal($token_edit, $slug);
                    } else
                        $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                    $data = [
                        'id' => $nomor,
                        'gambar_soal' => $gambar_soal,
                        'text_soal' => $text_soal,
                        'gambar_a' => null,
                        'gambar_b' => null,
                        'gambar_c' => null,
                        'gambar_d' => null,
                        'gambar_e' => null,
                        'text_a' => $text_a,
                        'text_b' => $text_b,
                        'text_c' => $text_c,
                        'text_d' => $text_d,
                        'text_e' => $text_e,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                }
            }

            //----SOAL DALAM BENTUK TEKS DAN PILIHAN JAWABAN DALAM BENTUK GAMBAR----
            else if (!$this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '2') {

                $text_soal = $this->input->post('text_soal', true);

                // GAMBAR PILIHAN A
                if ($this->upload->do_upload('gambar_a')) {
                    if (!empty($gambar_a)) {
                        if (file_exists($path_gambar_soal . $gambar_a))
                            unlink($path_gambar_soal . $gambar_a);
                    }

                    $gambar_a = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_a']['name'])) {
                    if (empty($gambar_a)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_a', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_a', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                // GAMBAR PILIHAN B
                if ($this->upload->do_upload('gambar_b')) {
                    if (!empty($gambar_b)) {
                        if (file_exists($path_gambar_soal . $gambar_b))
                            unlink($path_gambar_soal . $gambar_b);
                    }

                    $gambar_b = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_b']['name'])) {
                    if (empty($gambar_b)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_b', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_b', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                // GAMBAR PILIHAN C
                if ($this->upload->do_upload('gambar_c')) {
                    if (!empty($gambar_c)) {
                        if (file_exists($path_gambar_soal . $gambar_c))
                            unlink($path_gambar_soal . $gambar_c);
                    }

                    $gambar_c = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_c']['name'])) {
                    if (empty($gambar_c)) {
                        $this->_tinymcerepop($tinymce_content);

                        $this->session->set_flashdata('error', 'Something wrong');
                        $this->session->set_flashdata('error_gbr_c', 'You did not select a file to upload.');
                        redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug . '&page=' . $page);
                    }
                } else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_c', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                // GAMBAR PILIHAN D
                if ($this->upload->do_upload('gambar_d')) {
                    if (!empty($gambar_d)) {
                        if (file_exists($path_gambar_soal . $gambar_d))
                            unlink($path_gambar_soal . $gambar_d);
                    }

                    $gambar_d = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_d']['name']))
                    $gambar_d = $gambar_d;
                else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_d', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                // GAMBAR PILIHAN E
                if ($this->upload->do_upload('gambar_e')) {
                    if (!empty($gambar_e)) {
                        if (file_exists($path_gambar_soal . $gambar_e))
                            unlink($path_gambar_soal . $gambar_e);
                    }

                    $gambar_e = $this->upload->data('file_name');
                } else if (empty($_FILES['gambar_e']['name']))
                    $gambar_e = $gambar_e;
                else {
                    $this->_tinymcerepop($tinymce_content);

                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Something wrong');
                    $this->session->set_flashdata('error_gbr_e', $error);
                    redirect('admin/editsoal/' . $token_edit . '?tryout=' . $slug);
                }

                // HAPUS GAMBAR DARI STORAGE JIKA SEBELUMNYA SOAL YANG DIEDIT MENGGUNAKAN GAMBAR
                if (!empty($gambar_soal))
                    if (file_exists($path_gambar_soal . $gambar_soal))
                        unlink($path_gambar_soal . $gambar_soal);

                if ($tryout['tipe_tryout'] == 'SKD') {
                    $data = [
                        'id' => $nomor,
                        'tipe_soal' => $tipe_soal,
                        'text_soal' => $text_soal,
                        'gambar_soal' => null,
                        'gambar_a' => $gambar_a,
                        'gambar_b' => $gambar_b,
                        'gambar_c' => $gambar_c,
                        'gambar_d' => $gambar_d,
                        'gambar_e' => $gambar_e,
                        'text_a' => null,
                        'text_b' => null,
                        'text_c' => null,
                        'text_d' => null,
                        'text_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    if ($tipe_soal != $soal['tipe_soal']) {
                        $this->soal->insert($data, $slug);
                        $this->hapussoal($token_edit, $slug);
                    } else
                        $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                    $data = [
                        'id' => $nomor,
                        'text_soal' => $text_soal,
                        'gambar_soal' => null,
                        'gambar_a' => $gambar_a,
                        'gambar_b' => $gambar_b,
                        'gambar_c' => $gambar_c,
                        'gambar_d' => $gambar_d,
                        'gambar_e' => $gambar_e,
                        'text_a' => null,
                        'text_b' => null,
                        'text_c' => null,
                        'text_d' => null,
                        'text_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                }
            }


            //----SOAL DAN PILIHAN JAWABAN DALAM BENTUK TEKS----
            else if (!$this->input->post('cek_soal', true) && $this->input->post('cek_pilihan', true) == '1') {

                $text_soal = $this->input->post('text_soal', true);

                if ($this->input->post('text_a', true))
                    $text_a = $this->input->post('text_a', true);

                if ($this->input->post('text_b', true))
                    $text_b = $this->input->post('text_b', true);

                if ($this->input->post('text_c', true))
                    $text_c = $this->input->post('text_c', true);

                if ($this->input->post('text_d', true))
                    $text_d = $this->input->post('text_d', true);

                if ($this->input->post('text_e', true))
                    $text_e = $this->input->post('text_e', true);

                // HAPUS GAMBAR DARI STORAGE JIKA SEBELUMNYA SOAL YANG DIEDIT MENGGUNAKAN GAMBAR
                if (!empty($gambar_soal))
                    if (file_exists($path_gambar_soal . $gambar_soal))
                        unlink($path_gambar_soal . $gambar_soal);

                if (!empty($gambar_a)) {
                    $gambar_jawaban = [];
                    array_push($gambar_a, $gambar_b, $gambar_c, $gambar_d, $gambar_e);

                    foreach ($gambar_jawaban as $gj) {
                        if (file_exists($path_gambar_soal . $gj))
                            unlink($path_gambar_soal . $gj);
                    }
                }

                if ($tryout['tipe_tryout'] == 'SKD') {
                    $data = [
                        'id' => $nomor,
                        'tipe_soal' => $tipe_soal,
                        'gambar_soal' => null,
                        'text_soal' => $text_soal,
                        'text_a' => $text_a,
                        'text_b' => $text_b,
                        'text_c' => $text_c,
                        'text_d' => $text_d,
                        'text_e' => $text_e,
                        'gambar_a' => null,
                        'gambar_b' => null,
                        'gambar_c' => null,
                        'gambar_d' => null,
                        'gambar_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    if ($tipe_soal != $soal['tipe_soal']) {
                        $this->soal->insert($data, $slug);
                        $this->hapussoal($token_edit, $slug);
                    } else
                        $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                    $data = [
                        'id' => $nomor,
                        'gambar_soal' => null,
                        'text_soal' => $text_soal,
                        'text_a' => $text_a,
                        'text_b' => $text_b,
                        'text_c' => $text_c,
                        'text_d' => $text_d,
                        'text_e' => $text_e,
                        'gambar_a' => null,
                        'gambar_b' => null,
                        'gambar_c' => null,
                        'gambar_d' => null,
                        'gambar_e' => null,
                        'gambar_pembahasan' => $gambar_pembahasan,
                        'pembahasan' => $pembahasan,
                        'token' => $token
                    ];

                    $this->soal->update($data, ['pk' => $soal['pk']], $slug);
                }
            }

            $this->session->set_flashdata('success', 'Mengubah Soal');
            redirect('admin/soaltryout/' . $slug . '?per_page=' . $page);
        }
    }

    public function detailsoal($token)
    {
        $this->_loadRequiredModels();
        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $slug = $this->input->get('tryout');
        $email_kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';
        $soal = $this->soal->get('one', ['token' => $token], $slug);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $title = 'No. ' . $soal['id'] . ' ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Soal',
                'href' => 'admin/soaltryout/' . $tryout['slug']
            ],
            [
                'title' => 'Detail',
                'href' => 'active'
            ],
            [
                'title' => 'No. ' . $soal['id'],
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'soal' => $soal,
            'tryout' => $tryout
        ];

        if ($tryout['tipe_tryout'] == 'SKD') {
            $data['tipe_soal'] = $this->tipeSoal;
            $data['kunci_twk_tiu'] = $this->jawaban->get('one', ['email' => $email_kunci_jawaban], $slug);
            $data['kunci_tkp_a'] = $this->kunci_tkp->get('one', ['pilihan' => 'A'], $slug);
            $data['kunci_tkp_b'] = $this->kunci_tkp->get('one', ['pilihan' => 'B'], $slug);
            $data['kunci_tkp_c'] = $this->kunci_tkp->get('one', ['pilihan' => 'C'], $slug);
            $data['kunci_tkp_d'] = $this->kunci_tkp->get('one', ['pilihan' => 'D'], $slug);
            $data['kunci_tkp_e'] = $this->kunci_tkp->get('one', ['pilihan' => 'E'], $slug);
        } else if ($tryout['tipe_tryout'] == 'nonSKD') {

            $data['kunci_jawaban'] = $this->jawaban->get('one', ['email' => $email_kunci_jawaban], $slug);
            $bobot_nilai = null;
            $bobot_nilai = $this->bobot_nilai->get('many', ['status' => 1, 'tryout' => $slug]);
            $data['bobot_nilai'] = $bobot_nilai;
            $data['bobot_nilai_a'] = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'A'], $slug);

            if ($data['bobot_nilai_a'][1] != null) {
                $data['bobot_nilai_b'] = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'B'], $slug);
                $data['bobot_nilai_c'] = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'C'], $slug);
                $data['bobot_nilai_d'] = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'D'], $slug);
                $data['bobot_nilai_e'] = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'E'], $slug);
            }
        }

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/detailsoal', $data);
        $this->load->view('templates/user_footer');
    }

    public function hapussoal($token, $slug = null)
    {
        $this->_loadRequiredModels();
        if ($slug)
            $slug = $slug;
        else // Hapus soal dari halaman soal
            $slug = $this->input->post('dataPost');

        $tryout = $this->tryout->get('one', ['slug' => $slug]);

        if ($tryout['status'] == 1)
            $this->session->set_flashdata('error', 'Tidak dapat menghapus soal karena Tryout sudah di-release');
        else {

            $email_kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';

            //SISTEM BARU NI BOSS
            $soal = $this->soal->get('one', ['token' => $token], $slug);

            if ($tryout['tipe_tryout'] == 'SKD')
                //AMBIL SOAL PADA PAKET TERSEBUT SETELAH SOAL YANG AKAN DIHAPUS
                $soal_after = $this->soal->get(
                    'many',
                    [
                        'tipe_soal' => $soal['tipe_soal'],
                        'id >' => $soal['id']
                    ],
                    $slug
                );
            else if ($tryout['tipe_tryout'] == 'nonSKD')
                //AMBIL SOAL SETELAH SOAL YANG AKAN DIHAPUS
                $soal_after = $this->soal->get(
                    'many',
                    ['id >' => $soal['id']],
                    $slug
                );

            // MASUKKAN TOKEN SETIAP SOAL TADI KE DALAM ARRAY
            $array_token = [];
            for ($i = 0; $i < count($soal_after); $i++) {
                array_push($array_token, $soal_after[$i]['token']);
            }

            //UPDATE ID/NOMOR SOAL
            for ($i = 0; $i < count($soal_after); $i++) {
                $token_shift = array_shift($array_token);

                $this->soal->update(['id' => $i + $soal['id']], ['token' => $token_shift], $slug);
            }
            if ($tryout['tipe_tryout'] == 'SKD') {
                if ($soal['tipe_soal'] == 1)
                    $angka_dependen = 0;
                else if ($soal['tipe_soal'] == 2)
                    $angka_dependen = 30;
                else if ($soal['tipe_soal'] == 3)
                    $angka_dependen = 65;

                $jumlah_soal = $this->soal->getNumRows(['tipe_soal' => $soal['tipe_soal']], $slug);

                $array_kunjaw_after = [];
                $angka_fix = $jumlah_soal + $angka_dependen;

                // UPDATE KUNCI
                if ($soal['tipe_soal'] == 1 || $soal['tipe_soal'] == 2) {
                    $kunci_jawaban = $this->jawaban->get('one', ['email' => $email_kunci_jawaban], $slug);

                    for ($i = $soal['id'] + 1; $i <= $angka_fix; $i++)
                        array_push($array_kunjaw_after, $kunci_jawaban[$i]);

                    for ($i = $soal['id']; $i < $angka_fix; $i++) {
                        $kunjaw_shift = array_shift($array_kunjaw_after);
                        $this->jawaban->update(
                            [
                                '`' . $i . '`' => $kunjaw_shift
                            ],
                            [
                                'email' => $email_kunci_jawaban
                            ],
                            $slug
                        );
                    }

                    $this->jawaban->update(
                        [
                            '`' . $i . '`' => null
                        ],
                        [
                            'email' => $email_kunci_jawaban
                        ],
                        $slug
                    );
                } else if ($soal['tipe_soal'] == 3) {
                    $options = ['A', 'B', 'C', 'D', 'E'];

                    foreach ($options as $option) {
                        $kunjaw = $this->kunci_tkp->get('one', ['pilihan' => $option], $slug);

                        for ($i = $soal['id'] + 1; $i <= $angka_fix; $i++)
                            array_push($array_kunjaw_after, $kunjaw[$i]);

                        for ($i = $soal['id']; $i < $angka_fix; $i++) {
                            $kunjaw_shift = array_shift($array_kunjaw_after);
                            $this->kunci_tkp->update(
                                [
                                    '`' . $i . '`' => $kunjaw_shift
                                ],
                                [
                                    'pilihan' => $option
                                ],
                                $slug
                            );
                        }

                        $this->kunci_tkp->update(
                            [
                                '`' . $i . '`' => null
                            ],
                            [
                                'pilihan' => $option
                            ],
                            $slug
                        );
                    }
                }
            } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                $jumlah_soal = $this->soal->getNumRows(['id >' => 0], $slug);

                $array_kunjaw_after = [];
                // $angka_fix = $jumlah_soal;

                // UPDATE KUNCI
                $kunci_jawaban = $this->jawaban->get('one', ['email' => $email_kunci_jawaban], $slug);

                for ($i = $soal['id'] + 1; $i <= $jumlah_soal; $i++)
                    array_push($array_kunjaw_after, $kunci_jawaban[$i]);

                for ($i = $soal['id']; $i < $jumlah_soal; $i++) {
                    $kunjaw_shift = array_shift($array_kunjaw_after);
                    $this->jawaban->update(
                        [
                            '`' . $i . '`' => $kunjaw_shift
                        ],
                        [
                            'email' => $email_kunci_jawaban
                        ],
                        $slug
                    );
                }

                $this->jawaban->update(
                    [
                        '`' . $i . '`' => null
                    ],
                    [
                        'email' => $email_kunci_jawaban
                    ],
                    $slug
                );

                // UNTUK SOAL DENGAN BOBOT NILAI
                $options = ['A', 'B', 'C', 'D', 'E'];
                foreach ($options as $option) {
                    $kunjaw = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => $option], $slug);

                    for ($i = $soal['id'] + 1; $i <= $jumlah_soal; $i++)
                        array_push($array_kunjaw_after, $kunjaw[$i]);

                    for ($i = $soal['id']; $i < $jumlah_soal; $i++) {
                        $kunjaw_shift = array_shift($array_kunjaw_after);
                        $this->bobot_nilai_tiap_soal->update(
                            [
                                '`' . $i . '`' => $kunjaw_shift
                            ],
                            [
                                'pilihan' => $option
                            ],
                            $slug
                        );
                    }

                    $this->bobot_nilai_tiap_soal->update(
                        [
                            '`' . $i . '`' => null
                        ],
                        [
                            'pilihan' => $option
                        ],
                        $slug
                    );
                }
            }

            $path_gambar_soal = FCPATH . 'assets/img/soal/';
            // HAPUS FILE GAMBAR PADA FOLDER
            if ($soal['gambar_soal']) {
                if (file_exists($path_gambar_soal . $soal['gambar_soal']))
                    unlink($path_gambar_soal . $soal['gambar_soal']);
            }
            if ($soal['gambar_a']) {
                if (file_exists($path_gambar_soal . $soal['gambar_a']))
                    unlink($path_gambar_soal . $soal['gambar_a']);
            }
            if ($soal['gambar_b']) {
                if (file_exists($path_gambar_soal . $soal['gambar_b']))
                    unlink($path_gambar_soal . $soal['gambar_b']);
            }
            if ($soal['gambar_c']) {
                if (file_exists($path_gambar_soal . $soal['gambar_c']))
                    unlink($path_gambar_soal . $soal['gambar_c']);
            }
            if ($soal['gambar_d']) {
                if (file_exists($path_gambar_soal . $soal['gambar_d']))
                    unlink($path_gambar_soal . $soal['gambar_d']);
            }
            if ($soal['gambar_e']) {
                if (file_exists($path_gambar_soal . $soal['gambar_e']))
                    unlink($path_gambar_soal . $soal['gambar_e']);
            }
            if ($soal['gambar_pembahasan']) {
                if (file_exists($path_gambar_soal . $soal['gambar_pembahasan']))
                    unlink($path_gambar_soal . $soal['gambar_pembahasan']);
            }

            // HAPUS SOAL
            $this->soal->delete(['token' => $token], $slug);

            $this->session->set_flashdata('success', 'Menghapus Soal');
        }
    }

    public function userparadata($slug)
    {
        $this->_loadRequiredModels();
        $id = $this->input->get('id');
        // User Tryout
        $user_tryout = $this->user_tryout->get('one', ['id' => $id], $slug);
        $user = $this->user->get('one', ['email' => $user_tryout['email']]);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
            $submenu_parent = 3;
            $href1 = 'admin/tryout';
            $href2 = 'admin/detailtryout/';
        } else {
            $jenis = 'latsol';
            $submenu_parent = 15;
            $href1 = 'admin/bimbel';
            $href2 = 'admin/detaillatsol/';
        }
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $title = 'Paradata ' . $user['name'] . ' - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => $href1
            ],
            [
                'title' => $tryout['name'],
                'href' => $href2 . $tryout['slug']
            ],
            [
                'title' => 'Paradata',
                'href' => 'active'
            ],
            [
                'title' => $user['name'],
                'href' => 'active'
            ]
        ];

        $this->load->model('Paradata_model', 'paradata');

        // <------- PAGINATION ------->
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/userparadata/' . $slug . '?id=' . $id;

        //HITUNG JUMLAH PARADATA - SEDIKIT TRIKI
        //MENGHITUNG JUMLAH BARIS PARADATA USER BERSANGKUTAN
        $config['total_rows'] = $this->paradata->getNumRows(['email' => $user_tryout['email']], $slug);

        //JUMLAH PARADATA YANG AKAN DITAMPILKAN PER HALAMAN
        $config['per_page'] = 25;

        //URL MENGGUNAKAN GET
        $config['page_query_string'] = true;

        //JUMLAH NOMOR DISAMPING NOMOR ACTIVE
        $config['num_links'] = 5;

        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        //UNTUK HALAMAN YANG SEDANG AKTIF
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';


        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        //SETIAP NOMOR YANG TIDAK AKTIF ADA CLASS INI
        $config['attributes'] = array('class' => 'page-link');

        //INISIALISASI PAGINATION
        $this->pagination->initialize($config);

        //AMBIL NILAI PADA URL DENGAN METHOD GET 
        $data['start'] = $this->input->get('per_page');


        // ====================================

        //RESULT_ARRAY DAN ROW_ARRAY DIPERHATIKAN
        $userparadata = $this->paradata->getForPagination(['email' => $user_tryout['email']], $config['per_page'], $data['start'], $slug);

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'paradata' => $userparadata,
            'jawaban' => $this->jawaban->get('one', ['email' => $user['email']], $slug),
            'tryout' => $tryout
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/userparadata', $data);
        $this->load->view('templates/user_footer');
    }

    public function nilaipeserta($slug)
    {
        $this->_loadRequiredModels();
        $id = $this->input->get('id');

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
            $submenu_parent = 3;
            $href1 = 'admin/tryout';
            $href2 = 'admin/detailtryout/';
        } else {
            $jenis = 'latsol';
            $submenu_parent = 15;
            $href1 = 'admin/bimbel';
            $href2 = 'admin/detaillatsol/';
        }
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        // User Tryout
        $user_tryout = $this->user_tryout->get('one', ['id' => $id], $slug);
        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $user = $this->user->get('one', ['email' => $user_tryout['email']]);

        $title = 'Nilai ' . $user['name'] . ' - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => $href1
            ],
            [
                'title' => $tryout['name'],
                'href' => $href2 . $tryout['slug']
            ],
            [
                'title' => 'Nilai',
                'href' => 'active'
            ],
            [
                'title' => $user['name'],
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'nilai' => $user_tryout,
            'tryout' => $tryout
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/nilaipeserta', $data);
        $this->load->view('templates/user_footer');
    }

    public function generatetoken($slug)
    {
        $this->_loadRequiredModels();
        $no_token =  $this->_randtoken();
        $email = $this->input->post('email');

        $this->user_tryout->update(['token' => $no_token], ['email' => $email], $slug);

        $this->session->set_flashdata('success', 'Generate token');
    }

    public function tryout()
    {
        $this->_loadRequiredModels();
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

        $this->form_validation->set_rules('tryout', 'Tryout Name', 'required');
        $this->form_validation->set_rules('tipe_tryout', 'Tipe Tryout', 'required');
        $berbayar = htmlspecialchars($this->input->post('berbayar'));
        $for_bimbel = htmlspecialchars($this->input->post('for_bimbel'));
        $freemium = htmlspecialchars($this->input->post('freemium'));

        if ($berbayar == 1)
            $this->form_validation->set_rules('harga', 'Harga', 'required|integer');

        $tipe_tryout = $this->input->post('tipe_tryout');
        $lama_pengerjaan = $this->input->post('lama_pengerjaan');

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
            $this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required|numeric');
            $this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required|numeric');

            $jumlah_soal = $this->input->post('jumlah_soal');
        } else if ($tipe_tryout == 'SKD')
            $jumlah_soal = 110;

        if ($this->form_validation->run() == false) {
            $this->_tinymcerepop(['ket_tryout']);

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/tryout', $data);
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

                    if ($for_bimbel == 1) {
                        $user_3 = $this->user->get('many', ['role_id' => 3]);
                        $user_7 = $this->user->get('many', ['role_id' => 7]);

                        foreach ($user_3 as $u) {
                            $data = [
                                'email' => $u['email'],
                                'token' => 11111,
                                'status' => 0
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }

                        foreach ($user_7 as $u) {
                            $data = [
                                'email' => $u['email'],
                                'token' => 11111,
                                'status' => 0
                            ];

                            $this->user_tryout->insert($data, $slug);
                        }
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

                    if ($for_bimbel == 1) {
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
                    } else if ($for_bimbel == 2) {
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
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');
        // $this->load->model('Midtrans_payment_model', 'midtrans_payment');

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
            $persentase = $this->jawaban->getNumRows(['waktu_selesai !=' => null], $slug) / count($user_tryout) * 100;
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
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        if ($tryout['kode_refferal']) {
            $ref = $this->user_tryout->get('many', ['refferal !=' => null], $slug);
            $non_ref = $this->user_tryout->get('many', ['refferal' => null], $slug);

            $data['pendapatan'] = (count($non_ref) * $tryout['harga']) + (count($ref) * $tryout['harga_diskon']);
        } elseif ($tryout['paid'] == 1) {
            $data['pendapatan'] = count($user_tryout) * $tryout['harga'];
        }

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/detailtryout', $data);
        $this->load->view('templates/user_footer');
    }

    public function rankingtryout($slug)
    {
        $this->_loadRequiredModels();
        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $tryout = $this->tryout->get('one', ['slug' => $slug], array('name', 'tipe_tryout', 'slug'));
        $title = 'Ranking - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Ranking',
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout
        ];

        if ($tryout['tipe_tryout'] == 'SKD')
            $user_tryout = $this->user_tryout->getRankingSKD($slug);
        else if ($tryout['tipe_tryout'] == 'nonSKD')
            $user_tryout = $this->user_tryout->getRankingnonSKD($slug, array('user.name', 'nilai', 'user.email'));

        $data['user_tryout'] = $user_tryout;

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/rankingtryout', $data);
        $this->load->view('templates/user_footer');
    }

    public function pembahasantryout($slug)
    {
        $this->_loadRequiredModels();
        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $title = 'Pembahasan - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'tryout/mytryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Pembahasan',
                'href' => 'active'
            ]
        ];


        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout
        ];

        $this->form_validation->set_rules('upload_pembahasan', 'File Pembahasan', 'is_unique[tryout.pembahasan]', [
            'is_unique' => 'Tidak boleh sama.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/pembahasantryout', $data);
            $this->load->view('templates/user_footer');
        } else {
            //CONFIQ GAMBAR
            $config['allowed_types'] = 'pdf';
            $config['max_size']     = '20480'; //20MB
            $config['upload_path'] = './assets/file/';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('upload_pembahasan')) {
                $upload_pembahasan = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error_upload_pembahasan', $error);
                redirect('admin/pembahasantryout/' . $slug);
            }

            $this->tryout->update(['pembahasan' => $upload_pembahasan], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Mengunggah Pembahasan');
            redirect('admin/pembahasantryout/' . $slug);
        }
    }

    public function soaltryout($slug)
    {
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');

        $submenu_parent = 3;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $title = 'Soal ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detailtryout/' . $tryout['slug']
            ],
            [
                'title' => 'Soal',
                'href' => 'active'
            ]
        ];

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/soaltryout/' . $slug);

        //HITUNG JUMLAH SOAL
        $config['total_rows'] = $this->soal->getNumRows(['id !=' => null], $slug);

        //JUMLAH SOAL YANG AKAN DITAMPILKAN PER HALAMAN
        $config['per_page'] = 20;

        //URL MENGGUNAKAN GET
        $config['page_query_string'] = true;

        //JUMLAH NOMOR DISAMPING NOMOR ACTIVE
        $config['num_links'] = 10;

        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        //UNTUK HALAMAN YANG SEDANG AKTIF
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';


        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        //SETIAP NOMOR YANG TIDAK AKTIF ADA CLASS INI
        $config['attributes'] = array('class' => 'page-link');

        //INISIALISASI PAGINATION
        $this->pagination->initialize($config);

        //AMBIL NILAI PADA URL DENGAN METHOD GET 
        $data['start'] = $this->input->get('per_page');


        $tryout = $this->tryout->get('one', ['slug' => $slug]);

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'soal' => $this->soal->getForPagination(['id !=' => null], $config['per_page'], $data['start'], $slug),
            'tryout' => $tryout,
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        $pilihan = ['A', 'B', 'C', 'D', 'E'];

        if ($tryout['tipe_tryout'] == 'nonSKD') {
            $bobot_nilai = null;
            $bobot_nilai = $this->bobot_nilai->get('many', ['status' => 1, 'tryout' => $slug]);

            $data['bobot_nilai'] = $bobot_nilai;
            $data['bobot_nilai_tiap_soal'] = $this->bobot_nilai_tiap_soal->getAll($slug);
        }

        $checkbox = $this->input->post('kustombobottiapsoal');
        if ($checkbox) {
            for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
                for ($j = 0; $j < count($pilihan); $j++) {
                    $this->form_validation->set_rules($i . $pilihan[$j], 'no. ' . $i . ' ' . $pilihan[$j], 'required|trim|numeric');
                }
            }
        } else {
            $this->form_validation->set_rules('bobotbenar', 'Bobot Jawaban Benar', 'required|trim|numeric');
            $this->form_validation->set_rules('bobotsalah', 'Bobot Jawaban Salah', 'required|trim|numeric');
        }

        $page = $this->input->get('page');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/soaltryout', $data);
            $this->load->view('templates/user_footer');
        } else {
            if ($checkbox) {
                for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {

                    // AMBIL BOBOT NILAI SOAL KE-I
                    $A = $this->input->post($i . 'A');
                    $B = $this->input->post($i . 'B');
                    $C = $this->input->post($i . 'C');
                    $D = $this->input->post($i . 'D');
                    $E = $this->input->post($i . 'E');

                    $nilai = [$A, $B, $C, $D, $E];
                    $pilihan = ['A', 'B', 'C', 'D', 'E'];

                    // UPDATE PILIHAN
                    for ($j = 0; $j <= 4; $j++) {
                        $n = $nilai[$j];
                        $p = $pilihan[$j];
                        $this->bobot_nilai_tiap_soal->update(
                            [
                                '`' . $i . '`' => $n
                            ],
                            [
                                'pilihan' => $p
                            ],
                            $slug
                        );
                    }
                }

                $this->bobot_nilai->update(['bobot' => null, 'status' => 0], ['tryout' => $slug]);
            } else {
                // CEK KUNCI
                $kunci_jawaban = $this->jawaban->get('one', ['email' => 'kunci_jawaban_' . $slug . '@gmail.com'], $slug);
                $stop = false;
                $soal = [];
                for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
                    if ($kunci_jawaban[$i] == 'Z') {
                        $stop = true;
                        array_push($soal, $i);
                    }
                }

                if ($stop == true) {
                    foreach ($soal as $s)
                        $message = $s . ', ';
                    $this->session->set_flashdata('error', 'Soal nomor ' . $message . 'merupakan soal yang kunci jawabannya belum diinputkan. Silakan input kunci jawaban pada soal-soal tersebut pada menu Edit Soal');
                    redirect('admin/soaltryout/' . $slug . '?per_page=' . $page);
                } else {
                    $bobot_benar = $this->input->post('bobotbenar');
                    $bobot_salah = $this->input->post('bobotsalah');

                    $now = date("Y-m-d H:i:s O", time());

                    $data = [
                        'bobot' => $bobot_benar,
                        'status' => 1,
                        'updated_at' => $now
                    ];

                    $this->bobot_nilai->update($data, ['jawaban' => 'benar', 'tryout' => $tryout['slug']]);

                    $data = [
                        'bobot' => $bobot_salah,
                        'status' => 1,
                        'updated_at' => $now
                    ];

                    $this->bobot_nilai->update($data, ['jawaban' => 'salah', 'tryout' => $tryout['slug']]);

                    for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {

                        $A = null;
                        $B = null;
                        $C = null;
                        $D = null;
                        $E = null;

                        $nilai = [$A, $B, $C, $D, $E];
                        $pilihan = ['A', 'B', 'C', 'D', 'E'];

                        // UPDATE PILIHAN
                        for ($j = 0; $j <= 4; $j++) {
                            $n = $nilai[$j];
                            $p = $pilihan[$j];
                            $this->bobot_nilai_tiap_soal->update(
                                [
                                    '`' . $i . '`' => $n
                                ],
                                [
                                    'pilihan' => $p
                                ],
                                $slug
                            );
                        }
                    }
                }
            }

            $this->session->set_flashdata('success', 'Update Bobot Nilai ' . $tryout['name']);
            redirect('admin/soaltryout/' . $slug . '?per_page=' . $page);
        }
    }

    public function generatedummysoal($slug)
    {
        $this->_loadRequiredModels();
        $sub_menu_parent = 3;
        submenu_access($sub_menu_parent);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);

        $kunci_jawaban = ['A', 'B', 'C', 'D', 'E'];
        $email_kunci_twk_tiu = 'kunci_jawaban_' . $slug . '@gmail.com';
        // $kunci = $this->jawaban->get('one', ['email' => $email_kunci_twk_tiu], $slug);
        // if (!$kunci)
        //     $this->jawaban->insert(['email' => $email_kunci_twk_tiu], $slug);
        for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
            $soal = $this->soal->get('one', ['id' => $i], $slug);
            if (!$soal) {
                if ($tryout['tipe_tryout'] == 'SKD') {
                    if ($i <= 30) {
                        $tipe_soal = 1;
                        $token = 'twk-' . $this->grs();
                    } else if ($i > 30 && $i <= 65) {
                        $tipe_soal = 2;
                        $token = 'tiu-' . $this->grs();
                    } else {
                        $tipe_soal = 3;
                        $token = 'tkp-' . $this->grs();
                    }
                    $data = [
                        'id' => $i,
                        'tipe_soal' => $tipe_soal,
                        'text_soal' => '<p>' . $this->generate_loremipsum->shortParagraph() . '</p>',
                        'text_a' => $this->generate_loremipsum->shortSentence(),
                        'text_b' => $this->generate_loremipsum->shortSentence(),
                        'text_c' => $this->generate_loremipsum->shortSentence(),
                        'text_d' => $this->generate_loremipsum->shortSentence(),
                        'text_e' => $this->generate_loremipsum->shortSentence(),
                        'pembahasan' => $this->generate_loremipsum->mediumParagraph(),
                        'token' => $token
                    ];

                    if ($tipe_soal != 3) {
                        $this->jawaban->update(
                            [
                                '`' . $i . '`' => $kunci_jawaban[rand(0, 4)]
                            ],
                            [
                                'email' => $email_kunci_twk_tiu
                            ],
                            $slug
                        );
                    } else {
                        $array_nilai = [1, 2, 3, 4, 5];
                        $A = $array_nilai[rand(0, 4)];
                        $B = $array_nilai[rand(0, 4)];
                        $C = $array_nilai[rand(0, 4)];
                        $D = $array_nilai[rand(0, 4)];
                        $E = $array_nilai[rand(0, 4)];

                        $nilai = [$A, $B, $C, $D, $E];
                        $pilihan = ['A', 'B', 'C', 'D', 'E'];

                        for ($j = 0; $j <= 4; $j++) {
                            $n = $nilai[$j];
                            $p = $pilihan[$j];
                            $this->kunci_tkp->update(
                                [
                                    '`' . $i . '`' => $n
                                ],
                                [
                                    'pilihan' => $p
                                ],
                                $slug
                            );
                        }
                    }
                } else if ($tryout['tipe_tryout'] == 'nonSKD') {
                    $token = $this->grs(20);

                    $data = [
                        'id' => $i,
                        'text_soal' => '<p>' . $this->generate_loremipsum->shortParagraph() . '</p>',
                        'text_a' => $this->generate_loremipsum->shortSentence(),
                        'text_b' => $this->generate_loremipsum->shortSentence(),
                        'text_c' => $this->generate_loremipsum->shortSentence(),
                        'text_d' => $this->generate_loremipsum->shortSentence(),
                        'text_e' => $this->generate_loremipsum->shortSentence(),
                        'pembahasan' => $this->generate_loremipsum->mediumParagraph(),
                        'token' => $token
                    ];

                    $this->jawaban->update(
                        [
                            '`' . $i . '`' => $kunci_jawaban[rand(0, 4)]
                        ],
                        [
                            'email' => $email_kunci_twk_tiu
                        ],
                        $slug
                    );
                }
                $this->soal->insert($data, $slug);
            }
        }
        $page = $this->input->get('page');
        $this->session->set_flashdata('success', 'Generate Dummy Soal Tryout ' . $tryout['name']);
        redirect('admin/soal' . $jenis . '/' . $slug . '?per_page=' . $page);
    }

    public function paymentlist()
    {
        $this->_loadRequiredModels();
        $this->load->model('Midtrans_payment_model', 'midtrans_payment');

        $parent_title = getSubmenuTitleById(4)['title'];
        submenu_access(4);
        $title = $parent_title;

        $breadcrumb_item = [
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'payment_list' => $this->midtrans_payment->get('many', ['status_code !=' => 204])
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/paymentlist', $data);
        $this->load->view('templates/user_footer');
    }

    public function settings()
    {
        $this->_loadRequiredModels();
        $parent_title = getSubmenuTitleById(5)['title'];
        submenu_access(5);

        $title = $parent_title;

        $breadcrumb_item = [
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        $this->load->model('Midtrans_settings_model', 'midtrans_settings');
        $this->load->model('Email_settings_model', 'email_settings');
        $this->load->model('Company_settings_model', 'company_settings');
        $this->load->model('Token_settings_model', 'token_settings');
        $this->load->model('Kode_settings_model', 'kode_settings');

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'company' => $this->company_settings->get('one', ['id' => 1]),
            'token' => $this->token_settings->get('one', ['id' => 1]),
            'email' => $this->email_settings->get('one', ['id' => 1]),
            'midtrans' => $this->midtrans_settings->get('one', ['is_active' => 1]),
            'kode' => $this->kode_settings->get('one', ['id' => 1])
        ];
        $tab = $this->input->post('tab');

        $save_company = $this->input->post('company-save');
        $save_token = $this->input->post('token-save');
        $save_email = $this->input->post('email-save');
        $save_and_test_email = $this->input->post('email-save-and-test');
        $save_midtrans = $this->input->post('midtrans-save');
        $save_kode = $this->input->post('kode-save');

        if (isset($save_company)) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
        } else if (isset($save_token)) {
            $this->form_validation->set_rules('time_limit_for_activation', 'Time Limit For Activation', 'required');
            $this->form_validation->set_rules('time_limit_for_reset_password', 'Time Limit For Reset Password', 'required');

            $time_limit_activation = $this->input->post('time_limit_for_activation');
            $time_limit_reset_password = $this->input->post('time_limit_for_reset_password');

            if ($time_limit_activation == 1) {
                $this->form_validation->set_rules('time_limit_activation', 'Time Limit Activation', 'required|integer|greater_than[0]|trim');
                $time_limit_activation = $this->input->post('time_limit_activation');
            }

            if ($time_limit_reset_password == 1) {
                $this->form_validation->set_rules('time_limit_reset_password', 'Time Limit Reset Password', 'required|integer|greater_than[0]|trim');
                $time_limit_reset_password = $this->input->post('time_limit_reset_password');
            }
        } else if (isset($save_email) || isset($save_and_test_email)) {
            $this->form_validation->set_rules('email_sender_address', 'Email Sender Address', 'required|valid_email|trim');
            $this->form_validation->set_rules('email_sender_name', 'Email Sender Name', 'required|trim');
            $this->form_validation->set_rules('mail_transport_type', 'Mail Transport Type', 'required|trim');
            $mail_transport_type = $this->input->post('mail_transport_type');

            if ($mail_transport_type == 'smtp') {
                $this->form_validation->set_rules('hostname', 'Hostname', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('port_number', 'Port Number', 'required|integer');
                $this->form_validation->set_rules('encryption', 'Encryption', 'required');
            }
        } else if (isset($save_midtrans)) {
            $this->form_validation->set_rules('client_key', 'Client Key', 'required|trim');
            $this->form_validation->set_rules('server_key', 'Server Key', 'required|trim');
        } else if (isset($save_kode))
            $this->form_validation->set_rules('kode', 'Kode', 'required|min_length[3]|max_length[256]|trim|is_unique[kode_settings.kode]', [
                'is_unique' => "Kode tidak mengalami perubahan"
            ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/settings', $data);
            $this->load->view('templates/user_footer');
        } else {
            if (isset($save_company)) {
                $company_name = $this->input->post('name', true);
                $company_email = $this->input->post('email', true);
                $company_address = $this->input->post('address', true);

                $company = $this->company_settings->get('one', ['id' => 1]);
                $path = FCPATH . 'assets/img/logo/';
                //cek jika ada gambar yang akan di-upload
                $logo_image = $company['logo'];
                $icon_image = $company['icon_for_browser'];

                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '1024';
                $config['upload_path'] = './assets/img/logo/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {
                    if (file_exists($path . $logo_image))
                        unlink($path . $logo_image);

                    $logo_image = $this->upload->data('file_name');
                } else if (empty($_FILES['logo']['name'])) {
                    $logo_image = $logo_image;
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/settings');
                }

                if ($this->upload->do_upload('icon_for_browser')) {
                    if (file_exists($path . $icon_image))
                        unlink($path . $icon_image);

                    $icon_image = $this->upload->data('file_name');
                } else if (empty($_FILES['icon_for_browser']['name'])) {
                    $icon_image = $icon_image;
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/settings');
                }

                $data = [
                    'name' => $company_name,
                    'email' => $company_email,
                    'address' => $company_address,
                    'logo' => $logo_image,
                    'icon_for_browser' => $icon_image
                ];

                $this->company_settings->update($data, ['id' => 1]);

                $this->session->set_flashdata('success', 'Update Pengaturan Company');
                // redirect('admin/settings');
            } else if (isset($save_token)) {
                $account_activation = $this->input->post('account_activation');

                $data = [
                    'account_activation' => $account_activation,
                    'time_limit_activation' => $time_limit_activation,
                    'time_limit_reset_password' => $time_limit_reset_password
                ];

                $this->token_settings->update($data, ['id' => 1]);

                $this->session->set_flashdata('success', 'Update Pengaturan Token');
                // redirect('admin/email_settings');
            } else if (isset($save_email) || isset($save_and_test_email)) {
                $email_sender_address = $this->input->post('email_sender_address');
                $email_sender_name = $this->input->post('email_sender_name');

                if ($mail_transport_type == 'php') {
                    $data = [
                        'email_sender_address' => $email_sender_address,
                        'email_sender_name' => $email_sender_name,
                        'mail_transport_type' => $mail_transport_type
                    ];
                } else {
                    $hostname = $this->input->post('hostname');
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $port_number = $this->input->post('port_number');
                    $encryption = $this->input->post('encryption');

                    $data = [
                        'email_sender_address' => $email_sender_address,
                        'email_sender_name' => $email_sender_name,
                        'mail_transport_type' => $mail_transport_type,
                        'hostname' => $hostname,
                        'username' => $username,
                        'password' => $password,
                        'port_number' => $port_number,
                        'encryption' => $encryption
                    ];
                }

                $this->email_settings->update($data, ['id' => 1]);

                // $save_button = $this->input->post('save-and-test');

                $message = 'Update Pengaturan Email';
                if (isset($save_and_test_email)) {
                    $this->_testingemailsender($mail_transport_type);
                    $message .= '. Silakan cek email anda';
                }

                $this->session->set_flashdata('success', $message);
            } else if (isset($save_midtrans)) {
                $environment = $this->input->post('environment');
                $client_key = $this->input->post('client_key');
                $server_key = $this->input->post('server_key');

                // CURRENT TIME
                $current_timestamp = date("Y-m-d H:i:s O", time());

                $data = [
                    'is_active' => 0,
                    'updated_at' => $current_timestamp
                ];

                $this->midtrans_settings->update($data, ['environment !=' => $environment]);

                $data = [
                    'is_active' => 1,
                    'client_key' => $client_key,
                    'server_key' => $server_key,
                    'updated_at' => $current_timestamp
                ];

                $this->midtrans_settings->update($data, ['environment' => $environment]);
                $this->session->set_flashdata('success', 'Update Pengaturan Midtrans');
            } else if (isset($save_kode)) {
                $kode = $this->input->post('kode');
                $now = date("Y-m-d H:i:s", time());

                $data = [
                    'kode' => $kode,
                    'updated_at' => $now
                ];

                $this->kode_settings->update($data, ['id' => 1]);
                $this->session->set_flashdata('success', 'Update Pengaturan Kode');
            }
            redirect('admin/settings?tab=' . $tab);
        }
    }

    public function hidetryout($slug)
    {
        $this->_loadRequiredModels();
        $sub_menu_parent = 3;
        submenu_access($sub_menu_parent);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);

        if ($tryout['hidden'] == 0) {
            $this->$jenis->update(['hidden' => 1], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Menyembunyikan Tryout');
        } else if ($tryout['hidden'] == 1) {
            $this->$jenis->update(['hidden' => 0], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Menampilkan Tryout');
        }
        redirect('admin/detail' . $jenis . '/' . $slug);
    }

    public function hapustryout()
    {
        $this->_loadRequiredModels();
        $id = $this->input->post('id');

        $tryout = $this->tryout->get('one', ['id' => $id]);
        $slug = $tryout['slug'];

        $soal = $this->soal->getAll($slug);
        $path_gambar_soal = FCPATH . 'assets/img/soal/';

        foreach ($soal as $s) {

            // HAPUS FILE GAMBAR PADA FOLDER
            if ($s['gambar_soal'] != null)
                if (file_exists($path_gambar_soal . $s['gambar_soal']))
                    unlink($path_gambar_soal . $s['gambar_soal']);

            if ($s['gambar_a'] != null) {
                if (file_exists($path_gambar_soal . $s['gambar_a']))
                    unlink($path_gambar_soal . $s['gambar_a']);
                if (file_exists($path_gambar_soal . $s['gambar_b']))
                    unlink($path_gambar_soal . $s['gambar_b']);
                if (file_exists($path_gambar_soal . $s['gambar_c']))
                    unlink($path_gambar_soal . $s['gambar_c']);
                if (file_exists($path_gambar_soal . $s['gambar_d']))
                    unlink($path_gambar_soal . $s['gambar_d']);
                if (file_exists($path_gambar_soal . $s['gambar_e']))
                    unlink($path_gambar_soal . $s['gambar_e']);
            }

            if ($s['gambar_pembahasan'] != null)
                if (file_exists($path_gambar_soal . $s['gambar_pembahasan']))
                    unlink($path_gambar_soal . $s['gambar_pembahasan']);
        }

        // HAPUS FILE PEMBAHASAN
        if ($tryout['pembahasan'] != null)
            if (file_exists(FCPATH . 'assets/file/' . $tryout['pembahasan']))
                unlink(FCPATH . 'assets/file/' . $tryout['pembahasan']);

        if ($tryout['tipe_tryout'] == 'SKD')
            $this->tryout->dropTryoutSKD($slug);
        else
            $this->tryout->dropTryoutnonSKD($slug);

        $this->tryout->delete(['id' => $id]);
        $this->bobot_nilai->delete(['tryout' => $slug]);

        $this->session->set_flashdata('success', 'Menghapus Tryout');
    }

    public function hapuslatsol()
    {
        $this->_loadRequiredModels();
        $id = $this->input->post('id');

        $latsol = $this->latsol->get('one', ['id' => $id]);
        $slug = $latsol['slug'];

        $soal = $this->soal->getAll($slug);
        $path_gambar_soal = FCPATH . 'assets/img/soal/';

        foreach ($soal as $s) {

            // HAPUS FILE GAMBAR PADA FOLDER
            if ($s['gambar_soal'] != null)
                if (file_exists($path_gambar_soal . $s['gambar_soal']))
                    unlink($path_gambar_soal . $s['gambar_soal']);

            if ($s['gambar_a'] != null) {
                if (file_exists($path_gambar_soal . $s['gambar_a']))
                    unlink($path_gambar_soal . $s['gambar_a']);
                if (file_exists($path_gambar_soal . $s['gambar_b']))
                    unlink($path_gambar_soal . $s['gambar_b']);
                if (file_exists($path_gambar_soal . $s['gambar_c']))
                    unlink($path_gambar_soal . $s['gambar_c']);
                if (file_exists($path_gambar_soal . $s['gambar_d']))
                    unlink($path_gambar_soal . $s['gambar_d']);
                if (file_exists($path_gambar_soal . $s['gambar_e']))
                    unlink($path_gambar_soal . $s['gambar_e']);
            }

            if ($s['gambar_pembahasan'] != null)
                if (file_exists($path_gambar_soal . $s['gambar_pembahasan']))
                    unlink($path_gambar_soal . $s['gambar_pembahasan']);
        }

        // HAPUS FILE PEMBAHASAN
        if ($latsol['materi'] != null)
            if (file_exists(FCPATH . 'assets/file/' . $latsol['materi']))
                unlink(FCPATH . 'assets/file/' . $latsol['materi']);


        $this->latsol->dropTryoutnonSKD($slug);

        $this->latsol->delete(['id' => $id]);
        $this->bobot_nilai->delete(['tryout' => $slug]);

        $this->session->set_flashdata('success', 'Menghapus Tryout');
    }

    public function hapuspembahasantryout($id)
    {
        $this->_loadRequiredModels();
        $tryout = $this->tryout->get('one', ['id' => $id]);

        // SET NULL PEMBAHASAN
        $this->tryout->update(['pembahasan' => null], ['id' => $id]);

        if (file_exists(FCPATH . 'assets/file/' . $tryout['pembahasan']))
            unlink(FCPATH . 'assets/file/' . $tryout['pembahasan']);

        $this->session->set_flashdata('success', 'Menghapus Pembahasan');
    }

    public function updatetryout($id)
    {
        $this->_loadRequiredModels();
        $tryout = $this->tryout->get('one', ['id' => $id]);
        $keterangan = $this->input->post('ket_tryout');
        $lama_pengerjaan = $this->input->post('lama_pengerjaan');
        $berbayar = $this->input->post('berbayar');
        $harga = $this->input->post('harga');
        $now = date("Y-m-d H:i:s", time());

        $success = true;
        $paid = 0;
        if ($tryout['tipe_tryout'] == 'nonSKD') {
            if ($berbayar) {
                $paid = 1;
                if ($harga == '') {
                    $success = false;
                    $this->session->set_flashdata('error', 'Harga wajib diisi');
                    redirect('admin/detailtryout/' . $tryout['slug']);
                }
            } else if ($lama_pengerjaan == '') {
                $success = false;
                $this->session->set_flashdata('error', 'Lama pengerjaan wajib diisi');
                redirect('admin/detailtryout/' . $tryout['slug']);
            }
        } else if ($tryout['tipe_tryout'] == 'SKD') {
            if ($berbayar) {
                $paid = 1;
                if ($harga == '') {
                    $success = false;
                    $this->session->set_flashdata('error', 'Harga wajib diisi');
                    redirect('admin/detailtryout/' . $tryout['slug']);
                }
            } else if ($lama_pengerjaan == '') {
                $success = false;
                $this->session->set_flashdata('error', 'Lama pengerjaan wajib diisi');
                redirect('admin/detailtryout/' . $tryout['slug']);
            }
        }

        if ($this->input->post('refferal') == '1') {
            $raw_input = $this->input->post('kode_refferal_edit');

            // 1. Bersihkan tag HTML dan ambil baris per kode
            $cleaned = strip_tags($raw_input, "<p>"); // biarkan <p> untuk sementara
            preg_match_all('/<p[^>]*>(.*?)<\/p>/', $cleaned, $matches);

            $kode_array = array_filter(array_map('trim', $matches[1])); // Ambil isi dalam <p>, trim spasi

            // 2. Ubah ke JSON jika mau disimpan dalam satu field
            $kode_json = json_encode($kode_array);
        }


        if (!$berbayar)
            $harga = null;


        if ($success == true) {
            $data = [
                'keterangan' => $keterangan,
                'lama_pengerjaan' => $lama_pengerjaan,
                'paid' => $paid,
                'harga' => $harga,
                'updated_at' => $now
            ];

            if ($this->input->post('refferal') == 1) {
                $data['kode_refferal'] = $kode_json;
                $data['harga_diskon'] = $this->input->post('diskon');
            }

            $this->tryout->update($data, ['id' => $id]);
            $this->session->set_flashdata('success', 'Mengubah Tryout');
            redirect('admin/detailtryout/' . $tryout['slug']);
        }
    }

    public function releasetryout($slug)
    {
        $this->_loadRequiredModels();
        $sub_menu_parent = 3;
        submenu_access($sub_menu_parent);

        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }
        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $soal_tryout = $this->soal->getNumRows(['id >' => 0], $slug);

        if ($soal_tryout == $tryout['jumlah_soal']) {
            if ($tryout['tipe_tryout'] == 'nonSKD') {
                $bobot_nilai = $this->bobot_nilai->get('many', ['tryout' => $slug]);
                $bobot_nilai_A = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'A'], $slug);

                if ($bobot_nilai[0]['status'] == 0 && $bobot_nilai_A[1] == null) {
                    $this->session->set_flashdata('error', 'Gagal melakukan release Tryout Anda belum menetapkan bobot nilai pada soal tryout ini, silakan tetapkan bobot nilai pada menu Soal Tryout');
                    redirect('admin/detail' . $jenis  . '/' . $slug);
                } else if ($bobot_nilai[0]['status'] == 1) {
                    $kunci_jawaban = $this->jawaban->get('one', ['email' => 'kunci_jawaban_' . $slug . '@gmail.com'], $slug);
                    $stop = false;
                    $soal = [];
                    for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
                        if ($kunci_jawaban[$i] == 'Z' || $kunci_jawaban[$i] == null) {
                            $stop = true;
                            array_push($soal, $i);
                        }
                    }

                    if ($stop == true) {
                        foreach ($soal as $s)
                            $message = $s . ', ';
                        $this->session->set_flashdata('error', 'Soal nomor ' . $message . 'merupakan soal yang kunci jawabannya belum diinputkan. Silakan input kunci jawaban pada soal-soal tersebut pada menu Edit Soal');
                        redirect('admin/detail' . $jenis  . '/' . $slug);
                    } else {
                        if ($tryout['status'] == 0) {
                            $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                            $this->session->set_flashdata('success', 'Melakukan release tryout. Peserta sudah bisa memulai pengerjaan tryout');
                            redirect('admin/detail' . $jenis  . '/' . $slug);
                        } else if ($tryout['status'] == 1) {
                            $this->$jenis->update(['status' => 2], ['slug' => $slug]);
                            $this->session->set_flashdata('success', 'Menarik kembali tryout. Peserta tidak bisa memulai pengerjaan tryout');
                            redirect('admin/detail' . $jenis  . '/' . $slug);
                        } else if ($tryout['status'] == 2) {
                            $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                            $this->session->set_flashdata('success', 'Melakukan release kembali Tryout. Peserta sudah bisa memulai pengerjaan tryout');
                            redirect('admin/detail' . $jenis  . '/' . $slug);
                        }
                    }
                } else {
                    if ($tryout['status'] == 0) {
                        $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                        $this->session->set_flashdata('success', 'Melakukan release tryout. Peserta sudah bisa memulai pengerjaan tryout');
                        redirect('admin/detail' . $jenis  . '/' . $slug);
                    } else if ($tryout['status'] == 1) {
                        $this->$jenis->update(['status' => 2], ['slug' => $slug]);
                        $this->session->set_flashdata('success', 'Menarik kembali tryout. Peserta tidak bisa memulai pengerjaan tryout');
                        redirect('admin/detail' . $jenis  . '/' . $slug);
                    } else if ($tryout['status'] == 2) {
                        $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                        $this->session->set_flashdata('success', 'Melakukan release kembali Tryout. Peserta sudah bisa memulai pengerjaan tryout');
                        redirect('admin/detail' . $jenis  . '/' . $slug);
                    }
                }
            } else if ($tryout['tipe_tryout'] == 'SKD') {
                if ($tryout['status'] == 0) {
                    $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                    $this->session->set_flashdata('success', 'Melakukan release tryout. Peserta sudah bisa memulai pengerjaan tryout');
                    redirect('admin/detail' . $jenis  . '/' . $slug);
                } else if ($tryout['status'] == 1) {
                    $this->$jenis->update(['status' => 2], ['slug' => $slug]);
                    $this->session->set_flashdata('success', 'Menarik kembali tryout. Peserta tidak bisa memulai pengerjaan tryout');
                    redirect('admin/detail' . $jenis  . '/' . $slug);
                } else if ($tryout['status'] == 2) {
                    $this->$jenis->update(['status' => 1], ['slug' => $slug]);
                    $this->session->set_flashdata('success', 'Melakukan release kembali Tryout. Peserta sudah bisa memulai pengerjaan tryout');
                    redirect('admin/detail' . $jenis  . '/' . $slug);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal melakukan release Tryout. Jumlah soal belum lengkap, silakan lengkapi soal tryout terlebih dahulu untuk melakukan release pada tryout');
            redirect('admin/detail' . $jenis  . '/' . $slug);
        }
    }

    public function getsoal()
    {
        $this->_loadRequiredModels();
        $nomor = $this->input->post('nomor');
        $slug = $this->input->post('slug');
        $soal = $this->soal->get('one', ['id' => $nomor], $slug);

        if ($soal)
            echo json_encode($soal);
        else echo false;
    }

    public function gettinymcevalue()
    {
        $this->_loadRequiredModels();
        $name = $this->input->post("name");
        $this->load->model('Repop_tinymce_model', 'repop_tinymce');
        $all = $this->repop_tinymce->get('one', ['name' => $name]);
        if ($all)
            echo json_encode($all);
        else echo false;
    }

    public function getpersentasestatus()
    {
        $this->_loadRequiredModels();
        $slug = $this->input->post("slug");
        $count_user_tryout = $this->user_tryout->getNumRows(['id >' => 0], $slug);

        if ($count_user_tryout != 0) {
            $persentase = $this->user_tryout->getPersentaseStatusUser($slug);

            if ($persentase)
                echo json_encode($persentase);
            else echo false;
        } else if ($count_user_tryout == 0)
            echo json_encode(['status' => 0]);
    }

    public function bimbelskd()
    {
        $this->_loadRequiredModels();
        $parent_title = getSubmenuTitleById(15)['title'];
        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/bimbelskd'
            ]
        ];

        $all_materi = $this->latsol->get('many', ['jenis <' => 4]);

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'user' => $this->loginUser,
            'all_materi' => $all_materi
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/bimbel', $data);
        $this->load->view('templates/user_footer');
    }

    public function bimbelmtk()
    {
        $this->_loadRequiredModels();
        $parent_title = getSubmenuTitleById(17)['title'];
        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/bimbelmtk'
            ]
        ];

        $all_materi = $this->latsol->get('many', ['jenis' => 4]);

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'user' => $this->loginUser,
            'all_materi' => $all_materi
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/bimbel', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambahlatsol()
    {
        $this->_loadRequiredModels();
        $jenis = $this->input->post('jenis');
        if ($jenis == 4) {
            $all_latsol = $this->latsol->get('many', ['jenis' => 4]);
            $num = 17;
            $link = 'mtk';
        } else {
            $all_latsol = $this->latsol->getAll();
            $num = 15;
            $link = 'skd';
        }

        $parent_title = getSubmenuTitleById($num)['title'];
        //submenu_acces($num);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/bimbel' . $link
            ],
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];


        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'user' => $this->loginUser,
            'all_materi' => $all_latsol
        ];

        $jenis = $this->input->post('jenis');
        $judul = $this->input->post('judul');
        $slug = 'latsol_' . str_replace(' ', '_', strtolower($judul));
        $jumlah_soal = $this->input->post('jumlah_soal');
        $lama_pengerjaan = $this->input->post('lama_pengerjaan');

        $this->form_validation->set_rules('jenis', 'Jenis Materi', 'required');
        $this->form_validation->set_rules('judul', 'Judul Materi', 'required|is_unique[latsol.name]', [
            'is_unique' => 'Tidak boleh sama.'
        ]);
        $this->form_validation->set_rules('upload_materi', 'File Materi', 'is_unique[latsol.materi]', [
            'is_unique' => 'Tidak boleh sama.'
        ]);
        $this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', 'required|numeric');
        $this->form_validation->set_rules('lama_pengerjaan', 'Lama Pengerjaan', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/bimbel', $data);
            $this->load->view('templates/user_footer');
        } else {
            //CONFIQ FILE 
            $config['allowed_types'] = 'pdf';
            $config['max_size']     = '20480'; //20MB
            $config['upload_path'] = './assets/file/materi/';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('upload_materi')) {
                $upload_materi = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/bimbel' . $link);
            }

            $data = [
                'jenis' => $jenis,
                'name' => $judul,
                'slug' => $slug,
                'materi' => $upload_materi,
                'tipe_tryout' => 'nonSKD',
                'jumlah_soal' => $jumlah_soal,
                'lama_pengerjaan' => $lama_pengerjaan
            ];

            $this->latsol->insert($data, ['slug' => $slug]);

            $this->load->model('Paradata_model', 'paradata');
            $this->load->model('Ragu_ragu_model', 'ragu_ragu');

            //CREATE TABLE
            //PARADATA
            $this->paradata->createTable($slug);

            //RAGU-RAGU
            $this->ragu_ragu->createTable($slug, $jumlah_soal);

            //TABEL JAWABAN
            $this->jawaban->createTable($slug, $jumlah_soal);

            //TABEL SOAL
            $this->soal->createTablenonSKD($slug);

            //TABEL USER TRYOUT
            $this->user_tryout->createTablenonSKD($slug);

            //INSERT PESERTA ROLE BIMBEL
            if ($jenis != 4) {
                $user_3 = $this->user->get('many', ['role_id' => 3]);

                foreach ($user_3 as $u) {
                    $data = [
                        'email' => $u['email'],
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data, $slug);
                }
            } else if ($jenis == 4) {
                $user_4 = $this->user->get('many', ['role_id' => 4]);

                foreach ($user_4 as $u) {
                    $data = [
                        'email' => $u['email'],
                        'token' => 11111,
                        'status' => 0
                    ];

                    $this->user_tryout->insert($data, $slug);
                }
            }

            $user_5 = $this->user->get('many', ['role_id' => 5]);
            $user_6 = $this->user->get('many', ['role_id' => 6]);

            foreach ($user_5 as $u) {
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

            $this->session->set_flashdata('success', 'Mengunggah materi dan membuat latihan soal');
            redirect('admin/bimbel' . $link);
        }
    }

    public function detaillatsol($slug)
    {
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');

        $latsol = $this->latsol->get('one', ['slug' => $slug]);
        if ($latsol['jenis'] == 4) {
            $jenis = 'mtk';
            $submenu_parent = 17;
        } else {
            $jenis = 'skd';
            $submenu_parent = 15;
        }

        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $title = $latsol['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/bimbel' . $jenis
            ],
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        $user_latsol = $this->user_tryout->getAll($slug);
        if (count($user_latsol) == 0) {
            $persentase = 0;
        } else {
            $persentase = $this->jawaban->getNumRows(['waktu_selesai !=' => null], $slug) / count($user_latsol) * 100;
            $persentase = round($persentase, 2);
        }

        $user = $this->loginUser;

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'latsol' => $latsol,
            'all_user' => $user_latsol,
            'jawaban' => $this->jawaban->getAll($slug, array('email', 'waktu_mulai', 'waktu_selesai')),
            'jumlah_soal' => $this->soal->getNumRows(['id >' => 0], $slug),
            'persentase_selesai' => $persentase,
            'slug' => $slug,
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/detaillatsol', $data);
        $this->load->view('templates/user_footer');
    }

    public function soallatsol($slug)
    {
        $this->_loadRequiredModels();
        $this->load->model('Kode_settings_model', 'kode_settings');

        $tryout = $this->latsol->get('one', ['slug' => $slug]);
        if ($tryout['jenis'] == 4) {
            $jenis = 'mtk';
            $submenu_parent = 17;
        } else {
            $jenis = 'skd';
            $submenu_parent = 15;
        }

        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $title = 'Soal ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'admin/bimbel' . $jenis
            ],
            [
                'title' => $tryout['name'],
                'href' => 'admin/detaillatsol/' . $tryout['slug']
            ],
            [
                'title' => 'Soal',
                'href' => 'active'
            ]
        ];

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/soallatsol/' . $slug);

        //HITUNG JUMLAH SOAL
        $config['total_rows'] = $this->soal->getNumRows(['id !=' => null], $slug);

        //JUMLAH SOAL YANG AKAN DITAMPILKAN PER HALAMAN
        $config['per_page'] = 20;

        //URL MENGGUNAKAN GET
        $config['page_query_string'] = true;

        //JUMLAH NOMOR DISAMPING NOMOR ACTIVE
        $config['num_links'] = 10;

        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        //UNTUK HALAMAN YANG SEDANG AKTIF
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';


        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        //SETIAP NOMOR YANG TIDAK AKTIF ADA CLASS INI
        $config['attributes'] = array('class' => 'page-link');

        //INISIALISASI PAGINATION
        $this->pagination->initialize($config);

        //AMBIL NILAI PADA URL DENGAN METHOD GET 
        $data['start'] = $this->input->get('per_page');

        $tryout = $this->latsol->get('one', ['slug' => $slug]);

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'soal' => $this->soal->getForPagination(['id !=' => null], $config['per_page'], $data['start'], $slug),
            'tryout' => $tryout,
            'kode' => $this->kode_settings->get('one', ['id' => 1], array('kode'))['kode']
        ];

        $pilihan = ['A', 'B', 'C', 'D', 'E'];

        $bobot_nilai = null;
        $bobot_nilai = $this->bobot_nilai->get('many', ['status' => 1, 'tryout' => $slug]);

        $data['bobot_nilai'] = $bobot_nilai;
        $data['bobot_nilai_tiap_soal'] = $this->bobot_nilai_tiap_soal->getAll($slug);

        $checkbox = $this->input->post('kustombobottiapsoal');
        if ($checkbox) {
            for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
                for ($j = 0; $j < count($pilihan); $j++) {
                    $this->form_validation->set_rules($i . $pilihan[$j], 'no. ' . $i . ' ' . $pilihan[$j], 'required|trim|numeric');
                }
            }
        } else {
            $this->form_validation->set_rules('bobotbenar', 'Bobot Jawaban Benar', 'required|trim|numeric');
            $this->form_validation->set_rules('bobotsalah', 'Bobot Jawaban Salah', 'required|trim|numeric');
        }

        $page = $this->input->get('page');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/soallatsol', $data);
            $this->load->view('templates/user_footer');
        } else {
            if ($checkbox) {
                for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {

                    // AMBIL BOBOT NILAI SOAL KE-I
                    $A = $this->input->post($i . 'A');
                    $B = $this->input->post($i . 'B');
                    $C = $this->input->post($i . 'C');
                    $D = $this->input->post($i . 'D');
                    $E = $this->input->post($i . 'E');

                    $nilai = [$A, $B, $C, $D, $E];
                    $pilihan = ['A', 'B', 'C', 'D', 'E'];

                    // UPDATE PILIHAN
                    for ($j = 0; $j <= 4; $j++) {
                        $n = $nilai[$j];
                        $p = $pilihan[$j];
                        $this->bobot_nilai_tiap_soal->update(
                            [
                                '`' . $i . '`' => $n
                            ],
                            [
                                'pilihan' => $p
                            ],
                            $slug
                        );
                    }
                }

                $this->bobot_nilai->update(['bobot' => null, 'status' => 0], ['tryout' => $slug]);
            } else {
                // CEK KUNCI
                $kunci_jawaban = $this->jawaban->get('one', ['email' => 'kunci_jawaban_' . $slug . '@gmail.com'], $slug);
                $stop = false;
                $soal = [];
                for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {
                    if ($kunci_jawaban[$i] == 'Z') {
                        $stop = true;
                        array_push($soal, $i);
                    }
                }

                if ($stop == true) {
                    foreach ($soal as $s)
                        $message = $s . ', ';
                    $this->session->set_flashdata('error', 'Soal nomor ' . $message . 'merupakan soal yang kunci jawabannya belum diinputkan. Silakan input kunci jawaban pada soal-soal tersebut pada menu Edit Soal');
                    redirect('admin/soallatsol/' . $slug . '?per_page=' . $page);
                } else {
                    $bobot_benar = $this->input->post('bobotbenar');
                    $bobot_salah = $this->input->post('bobotsalah');

                    $now = date("Y-m-d H:i:s O", time());

                    $data = [
                        'bobot' => $bobot_benar,
                        'status' => 1,
                        'updated_at' => $now
                    ];

                    $this->bobot_nilai->update($data, ['jawaban' => 'benar', 'tryout' => $tryout['slug']]);

                    $data = [
                        'bobot' => $bobot_salah,
                        'status' => 1,
                        'updated_at' => $now
                    ];

                    $this->bobot_nilai->update($data, ['jawaban' => 'salah', 'tryout' => $tryout['slug']]);

                    for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) {

                        $A = null;
                        $B = null;
                        $C = null;
                        $D = null;
                        $E = null;

                        $nilai = [$A, $B, $C, $D, $E];
                        $pilihan = ['A', 'B', 'C', 'D', 'E'];

                        // UPDATE PILIHAN
                        for ($j = 0; $j <= 4; $j++) {
                            $n = $nilai[$j];
                            $p = $pilihan[$j];
                            $this->bobot_nilai_tiap_soal->update(
                                [
                                    '`' . $i . '`' => $n
                                ],
                                [
                                    'pilihan' => $p
                                ],
                                $slug
                            );
                        }
                    }
                }
            }

            $this->session->set_flashdata('success', 'Update Bobot Nilai ' . $tryout['name']);
            redirect('admin/soallatsol/' . $slug . '?per_page=' . $page);
        }
    }

    public function updatemateri($slug)
    {
        $this->_loadRequiredModels();
        $latsol = $this->latsol->get('one', ['slug' => $slug]);

        $this->latsol->update(['materi' => null], ['id' => $id]);
        if (file_exists(FCPATH . 'assets/file/materi/' . $latsol['materi']))
            unlink(FCPATH . 'assets/file/materi/' . $latsol['materi']);

        $this->form_validation->set_rules('upload_materi', 'File Materi', 'is_unique[latsol.materi]', [
            'is_unique' => 'Tidak boleh sama.'
        ]);

        if ($this->form_validation->run() == false) {
            redirect('admin/detaillatsol/' . $slug);
        } else {
            //CONFIQ FILE 
            $config['allowed_types'] = 'pdf';
            $config['max_size']     = '20480'; //20MB
            $config['upload_path'] = './assets/file/materi/';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('update_materi')) {
                $update_materi = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/detaillatsol/' . $slug);
            }

            $this->latsol->update(['materi' => $update_materi], ['slug' => $slug]);

            $this->session->set_flashdata('success', 'Mengupdate Materi');
            redirect('admin/detaillatsol/' . $slug);
        }
    }

    public function hapusmateri($id)
    {
        $this->_loadRequiredModels();
        $latsol = $this->latsol->get('one', ['id' => $id]);

        // SET NULL PEMBAHASAN
        $this->latsol->update(['materi' => null], ['id' => $id]);

        if (file_exists(FCPATH . 'assets/file/materi/' . $latsol['materi']))
            unlink(FCPATH . 'assets/file/materi/' . $latsol['materi']);

        $this->session->set_flashdata('success', 'Menghapus Materi');
    }

    public function downloadmateri($filename)
    {
        force_download('./assets/file/materi/' . $filename, NULL);
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

    private function _phpMailTesting($email)
    {
        $this->_loadRequiredModels();
        $this->load->model('Company_settings_model', 'company_settings');
        $this->load->model('Email_settings_model', 'email_settings');

        $company = $this->company_settings->get('one', ['id' => 1]);
        $email_settings = $this->email_settings->get('one', ['id' => 1]);

        $mailto = $email;

        // Subject
        $subject = 'PHP Email Sender Testing';

        //Ambil file pesan email html
        $message = file_get_contents(base_url('assets/email/EmailSenderTesting.html'));

        $copyright = 'Copyright ' . date('Y') . ' ' . $company['name'];

        //Ubah copyright
        $message = str_replace('copyright-company', $copyright, $message);

        // To send HTML mail, the Content-type header must be set
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: " . $email_settings['email_sender_name'] . ' <' . $email_settings['email_sender_address'] . '>' . "\r\n";
        $headers .= "Reply-To: " . $company['email'] . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $headers .= "X-Priority: 1" . "\r\n";

        // Mail it
        if (mail($mailto, $subject, $message, $headers)) {
            return true;
        } else {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            die;
        }
    }

    private function _smtpMailTesting($email)
    {
        $this->_loadRequiredModels();
        $this->load->model('Email_settings_model', 'email_settings');
        $this->load->model('Company_settings_model', 'company_settings');

        $company = $this->company_settings->get('one', ['id' => 1]);

        $email = $this->email_settings->get('one', ['id' => 1]);
        if ($email['encryption'] == 'none') {
            $encryption = null;
        } else {
            $encryption = $email['encryption'];
        }

        $config = [
            'protocol' => $email['mail_transport_type'],
            'smtp_host' => $email['hostname'],
            'smtp_crypto' => $encryption,
            'smtp_user' => $email['email_sender_address'],
            'smtp_pass' => $email['password'],
            'smtp_port' => $email['port_number'],
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        //sangat penting untuk error
        $this->email->initialize($config);

        $this->email->from($email['email_sender_address'], $email['email_sender_name']);
        $this->email->to($email);

        //Ambil file pesan email html
        $message = file_get_contents(base_url('assets/email/EmailSenderTesting.html'));

        $copyright = 'Copyright ' . date('Y') . ' ' . $company['name'];

        //Ubah copyright
        $message = str_replace('copyright-company', $copyright, $message);


        $this->email->subject('SMTP Email Sender Testing');
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function inputpeserta($slug)
    {
        $this->_loadRequiredModels();
        $this->load->model('Midtrans_payment_model', 'midtrans_payment');
        $email = $this->input->post('emailpeserta');
        $tryout = $this->tryout->get('one', ['slug' => $slug]);

        $now = date("Y-m-d H:i:s", time());

        $user = $this->user->get('one', ['email' => $email]);
        $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);
        if ($email == '' || $email == null)
            $this->session->set_flashdata('error', 'Email wajib diisi');
        else if (!$user)
            $this->session->set_flashdata('error', 'Peserta belum melakukan registrasi');
        else if ($user_tryout)
            $this->session->set_flashdata('error', 'Peserta sudah ada');
        else {
            $data = [
                'email' => $email,
                'order_id' => rand(),
                'tryout' => $slug,
                'gross_amount' => $tryout['harga'],
                'transaction_time' => $now,
                'payment_type' => '-',
                'status_code' => 200 //status ongoing
            ];

            $this->midtrans_payment->insert($data);

            $data = [
                'email' => $email,
                'token' => $this->_randtoken(),
                'status' => 0
            ];

            $this->user_tryout->insert($data, $slug);

            $this->session->set_flashdata('success', 'Menginput Peserta');
        }
        redirect('admin/detailtryout/' . $slug);
    }

    public function pendaftar()
    {
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('Tryout_model', 'tryout');
        $parent_title = getSubmenuTitleById(22)['title'];
        submenu_access(22);

        $paket_to = $this->paket_to->getAll();
        // print_r($paket_to);
        // exit;
        
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

    public function detailpendaftar($id)
    {

        $this->load->model('Pendaftar_to_model', 'pendaftar_to');
        $submenu_parent = 22;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);



        $pendaftar = $this->pendaftar_to->get_all_by_packet_to_id($id);

        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
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
        $this->load->view('admin/pendaftar', $data);
        $this->load->view('templates/user_footer');
    }

    public function ubah_status_pendaftar()
    {
        $this->_loadRequiredModels();
        // Ambil data dari request POST
        $id_pendaftar = $this->input->post('id_pendaftar');
        $status = $this->input->post('status');
        $nama_to = $this->input->post('nama_to');
        $email = $this->input->post('email');

        // Buat nama tabel dinamis berdasarkan nama paket TO
        $table_name = 'pendaftar_' . $nama_to;

        // Lakukan update status
        $this->db->where('id', $id_pendaftar);
        $updated = $this->db->update($table_name, ['status' => $status]);

        if ($status == 2) {
            $data_user = [
                'email'  => $email,
                'token'  => 11111,
                'status' => 0,
                'freemium' => 1,
            ];

            // Loop dari 1 sampai 8
            for ($i = 1; $i <= 4; $i++) {
                $slug = 'to_matematika_stis_eksklusif_' . $i; // nama tabel/slug

                $this->user_tryout->insert($data_user, $slug);
            }

            $this->user_tryout->insert($data_user, 'focus_matematika_stis_series_1');
            $this->user_tryout->insert($data_user, 'focus_matematika_stis_series_2');
        }

        if ($updated) {
            echo json_encode('success');
        } else {
            echo json_encode('failed');
        }
    }

    public function tambahpaket()
    {
        $this->_loadRequiredModels();
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('Tryout_paket_to_model', 'tryout_paket_to');
        $this->form_validation->set_rules('nama', 'Nama Tryout', 'required');
        $this->form_validation->set_rules('paket_to_ids[]', 'Paket TO', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
            'numeric' => 'Hanya boleh diisi angka.'
        ]);

        if ($this->form_validation->run() == false) {
            $parent_title = getSubmenuTitleById(22)['title'];
            submenu_access(22);

            $data = [
                'title' => $parent_title,
                'user' => $this->loginUser,
                'sidebar_menu' => $this->sidebarMenu,
                'parent_submenu' => $parent_title,
                'paket_to' => $this->paket_to->getAllOrderByIdDesc(),
            ];

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/paketto', $data);
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
                redirect('admin/pendaftar');
                return;
            }

            // Jika upload berhasil, ambil informasi file yang di-upload
            $uploadData = $this->upload->data();
            $this->db->trans_start();
            try {
                $data = [
                'nama' => $this->input->post('nama'),
                'foto' => $uploadData['file_name'],
                'harga' => $this->input->post('harga'),
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
        redirect('admin/pendaftar');
            } catch (Exception $e) {
                $this->db->trans_rollback();
        if (file_exists('./assets/img/' . $uploadData['file_name'])) {
            unlink('./assets/img/' . $uploadData['file_name']);
        }
        log_message('error', 'Gagal menambah paket TO: ' . $e->getMessage());
        $this->session->set_flashdata('error', 'Gagal menambahkan tryout. Silakan coba lagi.');
        redirect('admin/pendaftar');
            }
        }
    }

    public function toggle_freemium()
    {
        $this->_loadRequiredModels();
        // Pastikan ini hanya dapat diakses melalui AJAX
        if ($this->input->is_ajax_request()) {
            // Ambil data dari request
            $email = $this->input->post('email');
            $toName = $this->input->post('toName');
            $freemium = $this->input->post('freemium');

            // Update database
            $this->db->where('email', $email);
            $update = $this->db->update('user_tryout_' . $toName, ['freemium' => $freemium]);

            if ($update) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        } else {
            show_404();
        }
    }

    public function approval()
    {
        $this->_loadRequiredModels();
        $parent_title = getSubmenuTitleById(23)['title'];
        submenu_access(23);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $all_to = $this->tryout->getAll();

        $user_100_all = [];

        foreach ($all_to as $to) {
            $user_100 = $this->user_tryout->get('many', ['status' => 100], $to['slug']);
            $user_100_all[$to['slug']] = $user_100; // simpan berdasarkan slug
        }

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'user_100_all' => $user_100_all
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/approval', $data);
        $this->load->view('templates/user_footer');
    }

    private function _testingemailsender($mail_transport_type)
    {
        $user = $this->loginUser;
        if ($mail_transport_type == 'smtp')
            $this->_smtpMailTesting($user['email']);
        else if ($mail_transport_type == 'php')
            $this->_phpMailTesting($user['email']);
    }

    public function getupdatetryout()
    {
        $this->_loadRequiredModels();
        echo json_encode($this->tryout->get('one', ['id' => $_POST['id']]));
    }

    private function _randtoken()
    {
        $token = rand(111111, 999999);
        return $token;
    }

    private function grs($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function event(){
        $this->_loadRequiredModels();
        $this->load->model('Event_model', 'event');
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
    public function tambahevent()
    {
        $this->_loadRequiredModels();
        $this->load->model('Event_model', 'event');
        $this->load->model('Tryout_event_model', 'tryout_event'); // Updated to use events_tryout table

        // Set validation rules to match database schema
        $this->form_validation->set_rules('name', 'Nama Event', 'required',['required' => 'Nama Event harus diisi.']); // Changed from 'nama' to 'name'
        $this->form_validation->set_rules('paket_to_ids[]', 'Tryout', 'required', ['required' => 'Paket Tryout harus dipilih.']);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', ['required' => 'Keterangan harus diisi.']);
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
            'numeric' => 'Harga hanya boleh diisi angka.',
            'required' => 'Harga harus diisi.'
        ]);
        $this->form_validation->set_rules('group_link', 'Link Grup', 'required|valid_url', [
            'valid_url' => 'Link grup harus berupa URL yang valid.',
            'required' => 'Link grup harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            // If validation fails, set flashdata and redirect back to keep modal state
            $this->session->set_flashdata('validation_errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->input->post());
            $this->session->set_flashdata('show_modal', true);
            redirect('admin/event');
            return;
        } else {
            // Configure file upload for event image (using 'gambar' field)
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

            if (!$this->upload->do_upload('gambar')) { // Changed from 'foto' to 'gambar'
                // Upload failed - set specific error message
                $error = $this->upload->display_errors('', '');
                $this->session->set_flashdata('gambar', $error);
                $this->session->set_flashdata('form_data', $this->input->post());
                $this->session->set_flashdata('show_modal', true);
                redirect('admin/event');
                return;
            }

            // If upload successful, get file information
            $uploadData = $this->upload->data();
            
            // Start database transaction
            $this->db->trans_start();
            
            try {
                // Generate unique slug from name
                $name = $this->input->post('name'); // Changed from 'nama' to 'name'
                $slug = $this->event->generateSlug($name);
                
                // Insert event data with correct field names
                $event_data = [
                    'name' => $name, // Using 'name' field
                    'slug' => $slug, // Adding required slug field
                    'gambar' => 'events/' . $uploadData['file_name'], // Using 'gambar' field
                    'harga' => $this->input->post('harga'),
                    'group_link' => $this->input->post('group_link'), // Using 'group_link' field
                    'keterangan' => $this->input->post('keterangan'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $event_id = $this->event->insert($event_data);
                
                // Insert tryout-event relationships in events_tryout table
                $tryout_ids = $this->input->post('paket_to_ids');
                foreach ($tryout_ids as $tryout_id) {
                    $tryout_event_data = [
                        'event_id' => $event_id,
                        'tryout_id' => $tryout_id,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $this->tryout_event->insert($tryout_event_data);
                }
                
                // Complete transaction
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception('Transaksi database gagal.');
                }
                
                $this->session->set_flashdata('success', 'Event baru berhasil ditambahkan');
                redirect('admin/event');
                
            } catch (Exception $e) {
                // Rollback transaction
                $this->db->trans_rollback();
                
                // Delete uploaded file if exists
                if (file_exists('./assets/img/events/' . $uploadData['file_name'])) {
                    unlink('./assets/img/events/' . $uploadData['file_name']);
                }
                
                log_message('error', 'Gagal menambah event: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Gagal menambahkan event. Silakan coba lagi.');
                redirect('admin/event');
            }
        }
    }
}
