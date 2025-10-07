<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbel extends CI_Controller
{
    protected $loginUser, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Latsol_model', 'latsol');
        // $this->load->model('Soal_model', 'soal');

        $this->load->helper(array('url','download'));
        $this->loginUser = $this->user->getLoginUser();
        // $this->tipeSoal = $this->soal->getAllTipeSoal();
        $this->sidebarMenu = 'Bimbel';
    }

    public function bimbelskd()
    {
        $parent_title = getSubmenuTitleById(14)['title'];
        submenu_access(14);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $alljenis = [
            [
                'title' => 'Tes Wawasan Kebangsaan (TWK)',
                'kat' => 1
            ],
            [
                'title' => 'Tes Intelegensia Umum (TIU)',
                'kat' => 2
            ],
            [
                'title' => 'Tes Karakteristik Pribadi (TKP)',
                'kat' => 3
            ]
        ];

        $user = $this->loginUser;
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'alljenis' => $alljenis
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('bimbel/card', $data);
        $this->load->view('templates/user_footer');
    }

    public function downloadmateri($filename)
    {
        force_download('./assets/file/materi/' . $filename, NULL);
    }

    public function kategori($kat) {
        $parent_title = getSubmenuTitleById(14)['title'];
        submenu_access(11);
        
        if ($kat == 1) {
            $title2 = 'TWK';
            $href = 'bimbel/bimbelskd';
        } else if ($kat ==2) {
            $title2 = 'TIU';
            $href = 'bimbel/bimbelskd';
        } else if ($kat ==3) {
            $title2 = 'TKP';
            $href = 'bimbel/bimbelskd';
        } 

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => $href
            ], 
            [
                'title' => $title2,
                'href' => 'active'
            ]
        ];

        $user = $this->loginUser;
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
        ];

        $all_tryout = $this->latsol->get('many', ['jenis'=>$kat, 'hidden'=>0]);
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
        $this->load->view('bimbel/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function bimbelmtk()
    {
        $parent_title = getSubmenuTitleById(18)['title'];
        submenu_access(18);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $user = $this->loginUser;
        $jenis = 'mtk';
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'jenis' => $jenis,
        ];

        $all_tryout = $this->latsol->get('many', ['jenis'=>4, 'hidden'=>0]);
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
        $this->load->view('bimbel/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tryout() {
        $parent_title = getSubmenuTitleById(19)['title'];
        submenu_access(19);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $user = $this->loginUser;
        if ($user['role_id'] == 3 || $user['role_id'] == 7) {
            $tryout = $this->tryout->get('many', ['tipe_tryout'=>'SKD','hidden'=>0, 'for_bimbel'=>1]);
        } else if ($user['role_id'] == 4  || $user['role_id'] == 6) {
            $tryout = $this->tryout->get('many', ['tipe_tryout'=>'nonSKD','hidden'=>0, 'for_bimbel'=>1]);
        } else if ($user['role_id'] == 5) {
            $tryout = $this->tryout->get('many', ['hidden'=>0, 'for_bimbel'=>1]);
        } else if ($user['role_id'] == 8) {
            $tryout = $this->tryout->get('many', ['hidden'=>0, 'for_bimbel'=>2]);
        }
        
        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout,
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('bimbel/tryout', $tryout);
        $this->load->view('templates/user_footer');
    }

    public function detailtryout($slug)
    {
        $parent_title = getSubmenuTitleById(19)['title'];
        submenu_access(19);
        $user = $this->loginUser;
        $tryout = $this->tryout->get('one', ['slug'=>$slug]);

        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'bimbel/tryout'
            ],
            [
                'title' => $tryout['name'],
                'href' => 'active'
            ]
        ];

        $mytryout = $this->user_tryout->get('one', ['email' => $user['email']], $tryout['slug']);

        $data = [
            'title' => $parent_title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $user,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $parent_title,
            'tryout' => $tryout,
            'mytryout' => $mytryout
        ];


        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('bimbel/detailtryout', $data);
        $this->load->view('templates/user_footer');
    }
}