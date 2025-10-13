<?php

function is_logged_in()
{
    $ci = get_instance();

    //ambil fitur session yang ada di objek CI
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        load_model('Role_model', 'role');
        $role = $ci->role->get('one', ['id' => $role_id]);

        // CEK ROLE
        if (!$role) {
            $ci->session->unset_userdata('email');
            $ci->session->unset_userdata('role_id');
            $ci->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Administrator has deleted your role, please login again!</div>');
            redirect('auth');
        } else {
            $ci->db->like('menu', $menu);
            $queryMenu = $ci->db->get('user_menu')->row_array();

            $menu_id = $queryMenu['id'];

            $userAccess = $ci->db->get_where(
                'user_access_menu',
                [
                    'role_id' => $role_id,
                    'menu_id' => $menu_id
                ]
            );

            if ($userAccess->num_rows() < 1) {
                redirect('auth/blocked');
            }
        }
    }
}

function check_access_menu($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked";
    }
}

function check_access_sub_menu($role_id, $sub_menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('sub_menu_id', $sub_menu_id);
    $result = $ci->db->get('user_access_sub_menu');

    if ($result->num_rows() > 0) {
        return "checked";
    }
}

function submenu_access($sub_menu_id)
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');


    $userAccess = $ci->db->get_where(
        'user_access_sub_menu',
        [
            'role_id' => $role_id,
            'sub_menu_id' => $sub_menu_id
        ]
    );

    if ($userAccess->num_rows() < 1) {
        redirect('auth/blocked');
    }
}

function sidebarmenu($select)
{
    $ci = get_instance();

    $role_id = $ci->session->userdata('role_id');
    load_model('Menu_model', 'menu');
    return $ci->menu->getForSidebar($role_id, $select);
}

function sidebarsubmenu($menu_id)
{
    $ci = get_instance();

    $role_id = $ci->session->userdata('role_id');
    load_model('Sub_menu_model', 'sub_menu');
    return $ci->sub_menu->getForSidebar($menu_id, $role_id);
}

function company()
{
    $ci = get_instance();

    load_model('Company_settings_model', 'company_settings');
    return $ci->company_settings->get('one', ['id' => 1]);
}

function getSubmenuTitleById($id)
{
    $ci = get_instance();

    load_model('Sub_menu_model', 'sub_menu');
    return $ci->sub_menu->get('one', ['id' => $id], array('id', 'title'));
}

function error_message_file_input($key)
{
    $ci = get_instance();
    $flashdata = $ci->session->flashdata($key);

    if (!empty($flashdata)) {
        $message = '<div class="alert alert-danger alert-dismissible fade show col-sm-12 mt-2" role="alert">' . $flashdata . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        return $message;
    }
}

function form_error_message($key)
{
    $message = form_error($key, '<div class="alert alert-danger alert-dismissible fade show col-sm-12 mt-2" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

    return $message;
}

function form_error_user($key)
{
    $message = form_error($key, '<div class="alert alert-danger alert-dismissible fade show col-sm-12 mt-2" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

    return $message;
}

function breadcumb($breadcumb_item)
{
    $breadcumb = '';
    foreach ($breadcumb_item as $key => $value) {
        if ($value['href'] == 'active')
            // JIKA SUDAH DIAKHIR
            if ($key == count($breadcumb_item) - 1)
                $breadcumb .= '<li class="breadcrumb-item" aria-current="page">' . $value['title'] . '</li>';
            else
                $breadcumb .= '<li class="breadcrumb-item">' . $value['title'] . '</li>';
        else
            // $breadcumb = '<li class="breadcrumb-item font-weight-bold font-italic"><a class="link-bci black-text text-uppercase" href="' . base_url($value['href']) . '"><span class="mr-2">' . $value['title'] . '</span></a><i class="fafa fa fa-caret-right mr-1 mr-md-0" aria-hidden="true"></i></li>';
            $breadcumb .= '<li class="breadcrumb-item"><a href="' . base_url($value['href']) . '">' . $value['title'] . '</a></li>';
    }
    return $breadcumb;
}

function destroysession()
{
    $session_array = array('success', 'error', 'error_gbr_soal', 'error_gbr_a', 'error_gbr_b', 'error_gbr_c', 'error_gbr_d', 'error_gbr_e', 'error_gbr_pembahasan', 'error_upload_pembahasan');

    foreach ($session_array as $sa) {
        if (isset($_SESSION[$sa]))
            unset($_SESSION[$sa]);
    }
}

function load_model($model, $alias)
{
    $ci = get_instance();
    return $ci->load->model($model, $alias);
}

function create_slug($string) {
    $string = strtolower($string);
    $string = str_replace(' ', '_', $string);
    $string = preg_replace('/[^a-z0-9_]/', '', $string);
    return $string;
} 