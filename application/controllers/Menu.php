<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    protected $loginUser, $sidebarMenu;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Sub_menu_model', 'sub_menu');
        $this->load->model('Access_menu_model', 'access_menu');
        $this->load->model('Access_sub_menu_model', 'access_sub_menu');
        $this->loginUser = $this->user->getLoginUser();
        $this->sidebarMenu = 'Menu';
    }

    public function index()
    {
        $parent_title = getSubmenuTitleById(8)['title'];
        submenu_access(8);

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
            'menu' => $this->menu->getAllRoleAccess()
        ];

        $this->form_validation->set_rules('menu', 'Menu', 'required|is_unique[user_menu.menu]', [
            'is_unique' => 'Tidak dapat menggunakan nama menu tersebut.'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $menu = $this->input->post('menu');
            $this->menu->insert(['menu' => $menu]);

            $this->session->set_flashdata('success', 'Menambahkan Menu');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $parent_title = getSubmenuTitleById(9)['title'];
        submenu_access(9);

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
            'sub_menu' => $this->sub_menu->getAllForSubmenuManagement(),
            'menu' => $this->menu->getAll()
        ];

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/user_footer');
        } else {
            $title = htmlspecialchars($this->input->post('title'));
            $menu_id = htmlspecialchars($this->input->post('menu_id'));
            $url = htmlspecialchars($this->input->post('url'));
            $icon = htmlspecialchars($this->input->post('icon'));
            $is_active = $this->input->post('is_active');

            if (str_contains($icon, 'fa-fw') == false)
                $icon = $icon . ' fa-fw';

            $data = [
                'title' => $title,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];
            $this->sub_menu->insert($data);
            $this->session->set_flashdata('success', 'Menambahkan Submenu');
            redirect('menu/submenu');
        }
    }

    public function hapusmenu()
    {
        $id = $this->input->post('dataPost');

        if ($id >= 1 && $id <= 5)
            $this->session->set_flashdata('error', 'Tidak dapat menghapus menu karena menu ini merupakan menu dasar yang wajib ada');
        else {
            $submenu = $this->sub_menu->get('many', ['menu_id' => $id], array('id'));

            foreach ($submenu as $sm)
                $this->access_sub_menu->delete(['sub_menu_id' => $sm['id']]);

            $this->menu->delete(['id' => $id]);
            $this->access_menu->delete(['menu_id' => $id]);
            $this->session->set_flashdata('success', 'Menghapus Menu');
        }
    }

    public function hapussubmenu()
    {
        $id = $this->input->post('dataPost');

        if ($id >= 1 && $id <= 13)
            $this->session->set_flashdata('error', 'Tidak dapat menghapus submenu karena submenu ini merupakan submenu dasar yang wajib ada');
        else {
            $this->sub_menu->delete(['id' => $id]);
            $this->access_sub_menu->delete(['sub_menu_id' => $id]);
            $this->session->set_flashdata('success', 'Menghapus Submenu');
        }
    }

    public function updatemenu($id)
    {
        $parent_title = getSubmenuTitleById(8)['title'];
        submenu_access(8);
        $title = $parent_title;
        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $title,
            'menu' => $this->menu->getAllRoleAccess()
        ];

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $menu = $this->menu->get('one', ['id' => $id]);
            $menu_update = $this->input->post('menu');

            if ($menu['menu'] == $menu_update)
                $this->session->set_flashdata('error', 'Menu tidak mengalami perubahan');
            else {
                $menu = $this->menu->get('one', ['menu' => $menu_update]);
                if ($menu)
                    $this->session->set_flashdata('error', 'Tidak dapat menggunakan nama menu tersebut');
                else {
                    $this->menu->update(['menu' => $menu_update], ['id' => $id]);
                    $this->session->set_flashdata('success', 'Mengubah Menu');
                }
            }
            redirect('menu');
        }
    }

    public function updatesubmenu($id)
    {
        $parent_title = getSubmenuTitleById(9)['title'];
        submenu_access(9);
        $title = $parent_title;
        $breadcrumb_item = [
            [
                'title' => $parent_title,
                'href' => 'active'
            ]
        ];

        $data = [
            'title' => $title,
            'breadcrumb_item' => $breadcrumb_item,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $title,
            'sub_menu' => $this->sub_menu->getAllForSubmenuManagement(),
            'menu' => $this->menu->getAll()
        ];

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/user_footer');
        } else {
            $title = htmlspecialchars($this->input->post('title'));
            $icon = htmlspecialchars($this->input->post('icon'));
            $is_active = $this->input->post('is_active');

            if (str_contains($icon, 'fa-fw') == false)
                $icon = $icon . ' fa-fw';

            $data = [
                'title' => $title,
                'icon' => $icon,
                'is_active' => $is_active
            ];

            $this->sub_menu->update($data, ['id' => $id]);
            $this->session->set_flashdata('success', 'Mengubah Submenu');
            redirect('menu/submenu');
        }
    }

    public function getupdatemenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->menu->get('one', ['id' => $id]));
    }

    public function getupdatesubmenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->sub_menu->get('one', ['id' => $id]));
    }
}