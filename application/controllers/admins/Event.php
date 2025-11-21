<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Event_model $event
 * @property Tryout_model $tryout
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
}