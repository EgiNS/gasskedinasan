<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tryout extends CI_Controller
{
    protected $loginUser, $tipeSoal, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Soal_model', 'soal');
        $this->load->model('Latsol_model', 'latsol');

        $this->loginUser = $this->user->getLoginUser();
        $this->tipeSoal = $this->soal->getAllTipeSoal();
        $this->sidebarMenu = 'Tryout';
    }

    public function index()
    {
        $parent_title = getSubmenuTitleById(10)['title'];
        submenu_access(10);

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
            'tryout' => $this->tryout->getAllOrderByIdDesc(['hidden' => 0])
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail($slug)
    {
        $submenu_parent = 10;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $title = $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'tryout'
            ],
            [
                'title' => $title,
                'href' => 'active'
            ]
        ];

        $this->load->model('Midtrans_payment_model', 'midtrans_payment');
        $this->load->model('Jawaban_model', 'jawaban');

        $user = $this->loginUser;
        $soal_starting_three = null;
        $soal_starting_three = $this->soal->get('many', ['id >= ' => 1, 'id <= ' => 3], $slug);

        $data = [
            'title' => 'Detail ' . $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout,
            'slug' => $slug,
            'user_tryout' => $this->user_tryout->get('one', ['email' => $user['email']], $slug),
            'soal_nomor_satu' => $this->soal->get('one', ['id' => 1], $slug),
            'payment_fail' => $this->midtrans_payment->get('one', ['email' => $user['email'], 'status_code' => 201, 'tryout' => $slug]),
            'payment_success' => $this->midtrans_payment->get('one', ['email' => $user['email'], 'status_code' => 200, 'tryout' => $slug]),
            'soal_starting_three' => $soal_starting_three
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/detail', $data);
        $this->load->view('templates/user_footer');

        $jawaban_user = $this->jawaban->get('one', ['email' => $user['email']], $slug);

        if ($jawaban_user)
            if ($jawaban_user['waktu_mulai'] != null && $jawaban_user['waktu_selesai'] == null)
                redirect('exam/question/' . $data['soal_nomor_satu']['token'] . '?tryout=' . $slug);
    }

    public function nilai($slug)
    {
        $latsol = substr($slug,0,6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
            $submenu_parent = 11;
            $href = 'tryout/mytryout';
        } else {
            $jenis = 'latsol';
            $submenu_parent = 14;
            $href = 'bimbel/bimbelskd';
        }
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $tryout = $this->$jenis->get('one', ['slug' => $slug], array('name', 'tipe_tryout'));
        $title = 'Nilai - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => $href
            ],
            [
                'title' => $tryout['name'],
                'href' => 'active'
            ],
            [
                'title' => 'Nilai',
                'href' => 'active'
            ]
        ];

        $email = $this->session->userdata('email');
        $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'nilai' => $user_tryout,
            'tryout' => $tryout
        ];

        $soal_pertama = $this->soal->get('one', ['id' => 1], $slug);

        $this->_checkaccesstotryout($user_tryout['status'], $soal_pertama['token'], $slug);


        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/nilai', $data);
        $this->load->view('templates/user_footer');
    }

    public function ranking($slug)
    {
        $submenu_parent = 11;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $tryout = $this->tryout->get('one', ['slug' => $slug], array('name', 'tipe_tryout'));
        $title = 'Ranking - ' . $tryout['name'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'tryout/mytryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'active'
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

        $soal_pertama = $this->soal->get('one', ['id' => 1], $slug);

        $user_tryout = $this->user_tryout->get('one', ['email' => $data['user']['email']], $slug);

        $this->_checkaccesstotryout($user_tryout['status'], $soal_pertama['token'], $slug);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/ranking', $data);
        $this->load->view('templates/user_footer');
    }

    public function pembahasan($slug)
    {
        $submenu_parent = 11;
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
                'href' => 'active'
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

        $email = $this->session->userdata('email');

        $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);
        $soal_pertama = $this->soal->get('one', ['id' => 1], $slug);

        $this->_checkaccesstotryout($user_tryout['status'], $soal_pertama['token'], $slug);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/pembahasan', $data);
        $this->load->view('templates/user_footer');
    }

    public function answeranalysis($slug)
    {
        $latsol = substr($slug,0,6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
            $submenu_parent = 11;
            $href = 'tryout/mytryout';
        } else {
            $jenis = 'latsol';
            $submenu_parent = 14;
            $href = 'bimbel/bimbelskd';
        }

        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);
        $token = $this->input->get('soal');
        $soal = $this->soal->get('one', ['token' => $token], $slug);

        $title = 'Answer Analysis - ' . $tryout['name'] . ' - No. ' . $soal['id'];

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => $href
            ],
            [
                'title' => $tryout['name'],
                'href' => 'active'
            ],
            [
                'title' => 'Answer Analysis',
                'href' => 'active'
            ],
            [
                'title' =>  'No. ' . $soal['id'],
                'href' => 'active'
            ]
        ];

        $this->load->model('Kunci_tkp_model', 'kunci_tkp');
        $this->load->model('Bobot_nilai_tiap_soal_model', 'bobot_nilai_tiap_soal');
        $this->load->model('Bobot_nilai_model', 'bobot_nilai');
        $this->load->model('Jawaban_model', 'jawaban');

        $email = $this->session->userdata('email');
        $email_kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'slug' => $slug,
            'soal' => $soal,
            'tipe_soal' => $this->tipeSoal,
            'soal_lengkap' => $this->soal->getAll($slug),
            'jawaban' => $this->jawaban->get('one', ['email' => $email], $slug),
            'tryout' => $tryout
        ];

        if ($tryout['tipe_tryout'] == 'SKD') {
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


        $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);
        $soal_pertama = $this->soal->get('one', ['id' => 1], $slug);

        $this->_checkaccesstotryout($user_tryout['status'], $soal_pertama['token'], $slug);

        if (empty($soal))
            redirect('tryout/answeranalysis/' . $slug . '?soal=' . $soal_pertama['token']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/answeranalysis', $data);
        $this->load->view('templates/user_footer');
    }

    public function mypayment()
    {
        $parent_title = getSubmenuTitleById(12)['title'];
        submenu_access(12);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $this->load->model('Midtrans_payment_model', 'midtrans_payment');

        $user = $this->loginUser;
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'my_payment' => $this->midtrans_payment->get('many', [
                'email' => $user['email'],
                'status_code !=' => 204
            ])
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/mypayment', $data);
        $this->load->view('templates/user_footer');
    }

    public function mytryout()
    {
        $parent_title = getSubmenuTitleById(11)['title'];
        submenu_access(11);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $user = $this->loginUser;
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title
        ];

        $all_tryout = $this->tryout->getAll();
        $tryout = [];
        $mytryout = [];

        foreach ($all_tryout as $to) {
            $user_tryout = $this->user_tryout->get('one', ['email' => $user['email']], $to['slug']);
            if ($user_tryout) {
                array_push($tryout, $to);
                array_push($mytryout, $user_tryout);
            }
        }

        $data['tryout'] = $tryout;
        $data['mytryout'] = $mytryout;

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/mytryout', $data);
        $this->load->view('templates/user_footer');
    }

    public function canceltransaction()
    {
        $this->load->model('Midtrans_payment_model', 'midtrans_payment');

        $order_id = $this->input->post('order_id');
        $order = $this->midtrans_payment->get('one', ['order_id' => $order_id]);

        if ($order['status_code'] == 200)
            $this->session->set_flashdata('error', 'Sudah dilakukan pembayaran pada transaksi ini');
        else if ($order['status_code'] == 202)
            $this->session->set_flashdata('error', 'Transaksi ini sudah kadaluarsa');
        else if ($order['status_code'] == 201) {
            $now = date("Y-m-d H:i:s O", time());

            $data = [
                'status_code' => 203,
                'updated_at' => $now
            ];

            $this->midtrans_payment->update($data, ['order_id' => $order_id]);
            $this->session->set_flashdata('success', "Membatalkan transaksi. <br><span style='color: red;'>Peringatan: Jangan melakukan pembayaran pada transaksi yang sudah dibatalkan</span>");
        }
    }

    public function free($slug)
    {
        $email = $this->input->post('email');
        $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);
        if ($user_tryout)
            $this->session->set_flashdata('error', "Anda sudah terdaftar pada tryout ini");
        else {
            $data = [
                'email' => $email,
                'token' => $this->_randtoken(),
                'status' => 0
            ];
            $this->user_tryout->insert($data, $slug);
            $this->session->set_flashdata('success', "melakukan pendaftaran pada tryout ini");
        }
    }

    // public function pembayaranmanual()
    // {
    //     $slug = $this->input->post('slug');
    //     $email = $this->input->post('email');

    //     // $now = date("Y-m-d H:i:s O", time());

    //     $data = [
    //         'email' => $email,
    //         'order_id' => rand(),
    //         'tryout' => $slug,
    //         'status_code' => 204 //status ongoing
    //     ];

    //     $this->midtrans_payment->insert($data);


    //     // $data = [
    //     //     'email' => $email,
    //     //     'token' => $this->_randtoken(),
    //     //     'status' => 0
    //     // ];

    //     // $this->user_tryout->insert($data, $slug);
    // }

    private function _checkaccesstotryout($status, $token_soal_pertama, $slug)
    {
        $latsol = substr($slug,0,6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);

        $page = $this->uri->segment(2);
        if ($page != 'pembahasan' || $page != 'ranking') {
            if ($status == 0) {
                $this->session->set_flashdata('error', 'Anda Belum Memulai Tryout');
                if ($jenis == 'tryout') {
                    redirect('tryout/mytryout');
                } else {
                    if ($tryout['jenis']==4) {
                        redirect('bimbel/bimbelmtk');
                    } else {
                        redirect('bimbel/kategori/' . $tryout['jenis']);
                    }
                }
            } else if ($status == 1)
                redirect('exam/question/' . $token_soal_pertama . '?tryout=' . $slug);
        }
    }

    private function _randtoken()
    {
        $token = rand(111111, 999999);
        return $token;
    }
}