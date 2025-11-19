<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property Midtrans $midtrans
 * @property User_model $user
 * @property Soal_model $soal
 * @property Tryout_model $tryout
 * @property User_tryout_model $user_tryout
 * @property Paket_to_model $paket_to
 * @property CI_Session $session
 * @property Jawaban_model $jawaban
 * @property Latsol_model $latsol
 * @property Kunci_tkp_model $kunci_tkp
 * @property Bobot_nilai_tiap_soal_model $bobot_nilai_tiap_soal
 * @property Bobot_nilai_model $bobot_nilai
 * @property Transaction_model $transaction
 * @property Event_model $event
 * @property Event_pendaftar_model $event_pendaftar
 * @property CI_DB_query_builder $db
 * 
 */
class Tryout extends CI_Controller
{
    protected $loginUser, $tipeSoal, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Soal_model', 'soal');
        $this->load->model('Latsol_model', 'latsol');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->library('midtrans/Midtrans', 'midtrans');
        $params = array('server_key' => server_key(), 'production' => is_production());
        $this->midtrans->config($params);
        $this->loginUser = $this->user->getLoginUser();
        $this->tipeSoal = $this->soal->getAllTipeSoal();
        $this->sidebarMenu = 'Tryout';
    }


    public function index()
    {
        $this->load->model('Event_model', 'event');
        $parent_title = getSubmenuTitleById(10)['title'];
        submenu_access(10);


        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];
        $paket_to = $this->paket_to->getAll();



        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'paket_to' => $paket_to,
            'events' => $this->event->getAll(),
            'tryout_skd' => $this->tryout->get('many', ['tipe_tryout' => 'SKD', 'hidden' => 0, 'for_bimbel' => 0]),
            'tryout_mtk' => $this->tryout->get('many', ['tipe_tryout' => 'nonSKD', 'hidden' => 0, 'for_bimbel' => 0]),
        ];

        $this->user->update(['last_login_at' => date('Y-m-d H:i:s')], ['email' => $this->loginUser->email]);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/beli_ilmu/index', $data);
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
        $pendaftar = $this->user_tryout->getByTryoutIdWithTransaction($slug, $user->id);
        $payment_status = '';
        if ($pendaftar['transaction_status'] == 'settlement') {
            $payment_status = 'settlement';

        } else if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            $payment_status = 'pending';
        } else {
            $payment_status = 'expired';
        }
        
        $data = [
            'title' => 'Detail ' . $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout,
            'slug' => $slug,
            // 'soal_nomor_satu' => $this->soal->get('one', ['id' => 1], $slug),
            'soal_starting_three' => $soal_starting_three,
            'payment_status'=> $payment_status
          
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/detail/index', $data);
        $this->load->view('tryout/detail/index', $data);
        $this->load->view('templates/user_footer');

        $jawaban_user = $this->jawaban->get('one', ['email' => $user->email], $slug);

        if ($jawaban_user)
            if ($jawaban_user['waktu_mulai'] != null && $jawaban_user['waktu_selesai'] == null)
                redirect('exam/question/' . $data['soal_nomor_satu']['token'] . '?tryout=' . $slug);
    }


    public function nilai($slug)
    {
        $latsol = substr($slug, 0, 6);

        if ($latsol != 'latsol') {
            $jenis = 'tryout';
            $tryout = $this->$jenis->get('one', ['slug' => $slug], array('name', 'tipe_tryout', 'for_bimbel'));
            if ($tryout['for_bimbel'] == 1) {
                $submenu_parent = 19;
                $href = 'bimbel/tryout/' . $slug;
            } else {
                $submenu_parent = 11;
                $href = 'tryout/mytryout';
            }
        } else {
            $jenis = 'latsol';
            $tryout = $this->$jenis->get('one', ['slug' => $slug], array('name', 'tipe_tryout', 'jenis'));
            if ($tryout['jenis'] == 4) {
                $submenu_parent = 18;
                $href = 'bimbel/bimbelmtk';
            } else {
                $submenu_parent = 14;
                $href = 'bimbel/bimbelskd';
            }
        }

        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

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
        $user_id = $this->session->userdata('id');

        if ($this->db->field_exists('user_id', 'user_tryout_' . $slug)) {
            $pengerjaan = $this->user_tryout->getNumRows(['user_id' => $user_id], $slug);
    
            $user_tryout = $this->user_tryout->get('one', ['user_id' => $user_id, 'pengerjaan' => $pengerjaan], $slug);
            $all_nilai = $this->user_tryout->get('many', ['user_id' => $user_id], $slug);
        } else {
            $pengerjaan = $this->user_tryout->getNumRows(['email' => $email], $slug);
    
            $user_tryout = $this->user_tryout->get('one', ['email' => $email, 'pengerjaan' => $pengerjaan], $slug);
            $all_nilai = $this->user_tryout->get('many', ['email' => $email], $slug);
        }

        // var_dump($all_nilai);
        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'nilai' => $user_tryout,
            'riwayat' => $all_nilai,
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
        $tryout = $this->tryout->get('one', ['slug' => $slug], array('name', 'tipe_tryout', 'for_bimbel'));
        if ($tryout['for_bimbel'] == 1) {
            $submenu_parent = 19;
            $href = 'bimbel/tryout/' . $slug;
        } else {
            $submenu_parent = 11;
            $href = 'tryout/mytryout';
        }
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        //$tryout = $this->tryout->get('one', ['slug' => $slug], array('name', 'tipe_tryout'));
        $title = 'Ranking - ' . $tryout['name'];

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

        $user_id = $this->session->userdata('id');

        if (isset($data['user_tryout'][0]['transaction_id'])) {
            $user_tryout = $this->user_tryout->get('one', ['user_id' => $user_id], $slug);
        } else {
            $user_tryout = $this->user_tryout->get('one', ['email' => $data['user']->email], $slug);
        }

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
        $latsol = substr($slug, 0, 6);

        if ($latsol != 'latsol') {
            $tryout = $this->tryout->get('one', ['slug' => $slug]);
            if ($tryout['for_bimbel'] == 1) {
                $submenu_parent = 19;
                $href = 'bimbel/tryout/' . $slug;
            } else {
                $submenu_parent = 11;
                $href = 'tryout/mytryout';
            }
        } else {
            $tryout = $this->latsol->get('one', ['slug' => $slug]);
            if ($tryout['jenis'] == 4) {
                $submenu_parent = 18;
                $href = 'bimbel/bimbelmtk';
            } else {
                $submenu_parent = 14;
                $href = 'bimbel/bimbelskd';
            }
        }

        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);

        $token = $this->input->get('soal');
        $soal = $this->soal->get('one', ['token' => $token], $slug);

        $title = $tryout['name'] . ' - No. ' . $soal['id'];

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
        $user_id = $this->session->userdata('id');
        $email_kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';

        $last = $this->jawaban->getLastRow(['email' => $email], $slug);
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
            'jawaban' => $this->jawaban->get('one', ['id' => $last['id']], $slug),
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


        if ($this->db->field_exists('user_id', 'user_tryout_' . $slug)) {
            $user_tryout = $this->user_tryout->get('one', ['user_id' => $user_id], $slug);
        } else {
            $user_tryout = $this->user_tryout->get('one', ['email' => $email], $slug);
        }

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

        $all_tryout = $this->tryout->get('many', ['for_bimbel' => 0]);
        $tryout = [];
        $mytryout = [];


        foreach ($all_tryout as $to) {
            $user_tryout = $this->user_tryout->get('one', ['user_id' => $user->id], $to['slug'], '*', $user);
            if ($user_tryout) {
                array_push($tryout, $to);
                array_push($mytryout, $user_tryout);
            }
        }

        $data['tryout'] = $tryout;
        $data['mytryout'] = $mytryout;
        
        $this->user->update(['last_login_at' => date('Y-m-d H:i:s')], ['email' => $this->loginUser->email]);

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
        $user = $this->loginUser;
        $user_tryout = $this->user_tryout->get('one', ['user_id' => $user->id], $slug);
        if ($user_tryout)
            $this->session->set_flashdata('error', "Anda sudah terdaftar pada tryout ini");
        else {
            $data = [
                'user_id' => $user->id,
                'token' => 11111,
                'status' => 0
            ];
            $this->user_tryout->insert($data, $slug);
            $this->session->set_flashdata('success', "melakukan pendaftaran pada tryout ini");
        }
    }

    public function freemium()
    {

        $user = $this->loginUser;
        $id = $this->input->post('id');
        $order_id = 'TO-' . $id . '-USR-' . $user->id . '-' . time();
        $kode_refferal = $this->input->post('kode_refferal');
        $tryout = $this->tryout->get('one', ['id' => $id]);
        $pendaftar = $this->user_tryout->getByTryoutIdWithTransaction($tryout['slug'], $user->id);
        if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] > date('Y-m-d H:i:s')) {
            print_r($pendaftar['snap_token']);
            exit;
            echo $pendaftar['snap_token'];
            return;
        }
        // Ubah string JSON jadi array PHP
        $kode_refferal_list = json_decode($tryout['kode_refferal'], true);

        // Jika decode gagal (misal null), fallback ke array kosong
        if (!is_array($kode_refferal_list)) {
            $kode_refferal_list = [];
        }

        $gross_amount = in_array($kode_refferal, $kode_refferal_list)
            ? (int)$tryout['harga_diskon']
            : (int)$tryout['harga'];

        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        );

        $item1_details = array(
            'price' => $gross_amount,
            'quantity' => 1,
            'name' => $tryout['name']
        );

        $item_details = array($item1_details);

        $customer_details = array(
            'first_name'    => $user->name,
            'email'         => $user->email,
            'phone'         => $user->no_wa
        );

        $credit_card = array(
            'secure' => true,
            'save_card' => true
        );

        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", time()),
            'unit' => 'hour',
            'duration'  => 2
        );
        $data = [
            'user_id' => $user->id,
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_time'   => date('Y-m-d H:i:s'),
            'transaction_status' => 'pending'
        ];
        try {
            
            $this->db->trans_begin();
            $transaction_id = $this->transaction->insert($data);
            if ($pendaftar['transaction_status'] == 'pending' && $pendaftar['expiry_time'] <= date('Y-m-d H:i:s')) {
                $this->user_tryout->update(
                    ['transaction_id'=> $transaction_id ],
                    ['id'=> $pendaftar['id'] ],
                    $tryout['slug']
                );
            } else {

                        $this->user_tryout->insert([
            'token' => 11111,
            'status' => 0,
            'freemium' => 1,
            'user_id' => $user->id,
            'transaction_id' => $transaction_id
        ], $tryout['slug']);

            }

            $params = array(
                'transaction_details' => $transaction_details,
                'item_details'       => $item_details,
                'customer_details'   => $customer_details,
                'credit_card'        => $credit_card,
                'expiry'             => $custom_expiry
            );

            $snapToken = $this->midtrans->getSnapToken($params);
            $this->transaction->updateByOrderId(
                $order_id,
                ['snap_token' => $snapToken, 'expiry_time' => date("Y-m-d H:i:s", time() + (2 * 60 * 60))]
            );
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception("Gagal menyimpan transaksi atau pendaftar.");
            } else {
                $this->db->trans_commit();
            }
            echo $snapToken;
        } catch (\Throwable $th) {
            $this->db->trans_rollback();
            log_message('error', 'Gagal buat transaksi: ' . $th->getMessage());
            throw $th;
        }


    }

    public function upgradefreemium()
    {
        $order_id = 'ORDER-' . uniqid();
        $id = $this->input->post('id');
        $user = $this->loginUser;
        $tryout = $this->tryout->get('one', ['id' => $id]);
        $kode_refferal = $this->input->post('kode_refferal');
        $kode_refferal_list = json_decode($tryout['kode_refferal'], true);
        $gross_amount = in_array($kode_refferal, $kode_refferal_list)
            ? (int)$tryout['harga_diskon']
            : (int)$tryout['harga'];

        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
        );

        $item1_details = array(
            'price' => $gross_amount,
            'quantity' => 1,
            'name' => $tryout['name']
        );


        $item_details = array($item1_details);
        $customer_details = array(
            'first_name'    => $user->name,
            'email'         => $user->email,
            'phone'         => $user->no_wa
        );
        $credit_card = array(
            'secure' => true,
            'save_card' => true
        );

        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", time()),
            'unit' => 'day',
            'duration'  => 1
        );
        $data = [
            'user_id' => $user->id,
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_time'   => date('Y-m-d H:i:s'),
            'transaction_status' => 'pending'
        ];
        $transaction_id = $this->transaction->insert($data);
        $this->user_tryout->update(
            [
                'freemium' => 0,
                'transaction_id' => $transaction_id
            ],
            ['user_id' => $user->id],
            $tryout['slug']
        );
        $params = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        $snapToken = $this->midtrans->getSnapToken($params);
        $this->transaction->updateByOrderId(
            $order_id,
            ['snap_token' => $snapToken, 'expiry_time' => date("Y-m-d H:i:s", time() + (24 * 60 * 60))]
        );
        echo $snapToken;
    }
    public function paketto()
    {
        $parent_title = getSubmenuTitleById(21)['title'];
        submenu_access(21);


        $paket_to = $this->paket_to->getAll();


        foreach ($paket_to as &$paket) {
            //     // Buat nama tabel pendaftar berdasarkan nama paket
            $this->db->where('paket_to_id', $paket['id']);
            $query = $this->db->get('pendaftar_to');
            if ($query->num_rows() > 0) {
                $paket['status'] = '2';
            } else {
                $paket['status'] = 'not_registered';
            }
        }
        unset($paket);
        $data = [
            'title' => $parent_title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'paket_to' => $paket_to
        ];
        // print_r($data["paket_to"]);
        // exit;

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/paketto', $data);
        $this->load->view('templates/user_footer');
    }

    public function daftar_paket_to()
    {
        $nama_to = $this->input->post('nama');

        //slug
        $nama_to = strtolower($nama_to);
        $nama_to = str_replace(' ', '_', $nama_to);

        if (is_null($this->loginUser['no_wa']) || empty($this->loginUser['no_wa'])) {
            // Jika no_wa NULL, kirimkan response failed
            echo json_encode(['status' => 'failed', 'message' => 'Harap lengkapi nomor WhatsApp terlebih dahulu melalui menu Edit Profile.']);
            return;
        }

        $data = [
            'email' => $this->loginUser['email'],
        ];

        $this->paket_to->insert_pendaftar($data, $nama_to);

        // Berikan response dalam bentuk JSON (untuk AJAX)
        echo json_encode(['status' => 'success']);
    }

    public function daftar_bukti_paket()
    {
        $email = $this->loginUser['email'];
        $slug = 'fast_mtk_stis';

        $user_tryout = $this->paket_to->get('one', ['email' => $email], $slug);
        if ($user_tryout['status'] == 2)
            $this->session->set_flashdata('error', "Anda sudah terdaftar pada paket ini");
        else {
            $config['upload_path'] = './assets/img/';  // Folder untuk menyimpan gambar
            $config['allowed_types'] = 'jpg|jpeg|png';  // Tipe file yang diizinkan
            $config['max_size'] = 2048;  // Maksimal ukuran file (2MB)
            $config['file_name'] = time();  // Nama file unik (timestamp)

            $this->load->library('upload', $config);

            // Load konfigurasi upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('bukti')) {
                // Jika upload berhasil, ambil informasi file yang di-upload
                $uploadData = $this->upload->data();

                // Dapatkan path file yang di-upload
                $imagePath = $uploadData['file_name'];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('tryout/paketto');
            }

            $data = [
                'bukti' => $imagePath,
                'status' => 1,
            ];
        }

        $this->paket_to->update($data, ['email' => $email], $slug);
        $this->session->set_flashdata('success', "melakukan pembayaran pada paket TO ini");
        redirect('tryout/paketto/');
    }

    private function _checkaccesstotryout($status, $token_soal_pertama, $slug)
    {
        $latsol = substr($slug, 0, 6);
        if ($latsol != 'latsol') {
            $jenis = 'tryout';
        } else {
            $jenis = 'latsol';
        }

        $tryout = $this->$jenis->get('one', ['slug' => $slug]);

        $page = $this->uri->segment(2);
        if ($page != 'pembahasan' || $page != 'ranking') {
            if ($status == 0 || $status == 100) {
                $this->session->set_flashdata('error', 'Anda Belum Memulai Tryout');
                if ($jenis == 'tryout') {
                    if ($tryout['for_bimbel'] == 1) {
                        redirect('bimbel/detailtryout/' . $tryout['slug']);
                    } else {
                        redirect('tryout/mytryout');
                    }
                } else {
                    if ($tryout['jenis'] == 4) {
                        redirect('bimbel/bimbelmtk');
                    } else {
                        redirect('bimbel/kategori/' . $tryout['jenis']);
                    }
                }
            } else if ($status == 1)
                redirect('exam/question/' . $token_soal_pertama . '?tryout=' . $slug);
        }
    }

    public function detail_paket_to( $id )
    {

        $submenu_parent = 10;
        $parent_title = getSubmenuTitleById($submenu_parent)['title'];
        submenu_access($submenu_parent);
        $title = $id;
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
        $data = [
            'title' => 'Detail Paket TO ' . $title,
            'breadcrumb_item' => $breadcrumb_item,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('tryout/beli_ilmu/paket_to/detail', $data);
        $this->load->view('templates/user_footer');
    }

   



}