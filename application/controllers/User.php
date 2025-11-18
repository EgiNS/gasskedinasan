<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** 
* @property  CI_Loader $load
* @property  CI_Form_validation $form_validation
* @property  CI_Input $input
* @property  User_model $user
* @property  CI_Upload $upload
* @property  CI_Session $session    
*/
class User extends CI_Controller
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
        $this->sidebarMenu = 'User';
    }

    public function index()
    {
        $title = 'My Profile';
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
            'parent_submenu' => $title
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function dashboard()
    {
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('User_tryout_model', 'user_tryout');
        $title = 'Dashboard';

        $user = $this->loginUser;

        $all_tryout = $this->tryout->get('many', ['for_bimbel' => 0]);
        $tryout = [];
        $mytryout = [];
        $tryout_names = [];
        $tryout_scores = [];
        

        foreach ($all_tryout as $to) {
            if ($to['tipe_tryout'] == 'SKD') {
                $user_tryout = $this->user_tryout->get('one', ['user_id' => $user->id], $to['slug'], '*', $user);
                if (isset($user_tryout['total']) && $user_tryout['total'] !== null) {
                    array_push($tryout, $to);
                    array_push($mytryout, $user_tryout);
                    array_push($tryout_names, $to['name']);
                    array_push($tryout_scores, $user_tryout['total']);
                }
            }
        }

        if (!empty($mytryout)) {
            $jumlah_tryout = count($mytryout);
            $rata_rata = round(array_sum($tryout_scores) / $jumlah_tryout);
            $tertinggi = max($tryout_scores);
            $terendah  = min($tryout_scores);
        } else {
            $jumlah_tryout = 0;
            $rata_rata = 0;
            $tertinggi = 0;
            $terendah = 0;
        }
        
        $last_score = $tryout_scores[count($tryout_scores) - 1] ?? null;
        $prev_score = $tryout_scores[count($tryout_scores) - 2] ?? null; 

        $message = '';
        $alert_class = 'alert-secondary';
        $icon = 'ti ti-info-circle';

        if ($prev_score !== null) {
            if ($last_score > $prev_score) {
                $diff = $last_score - $prev_score;
                $alert_class = 'alert-success';
                $icon = 'ti ti-trending-up';
                $message = "Nilai kamu naik <b>{$diff} poin</b> dari TO sebelumnya 🚀 <span class='fw-semibold'>Keren! Tancap Gass terus yaa 🔥 OTW Kedinasan Impian!</span>";
            } elseif ($last_score < $prev_score) {
                $diff = $prev_score - $last_score;
                $alert_class = 'alert-danger';
                $icon = 'ti ti-trending-down';
                $message = "Wah nilai kamu turun <b>{$diff} poin</b> dari TO sebelumnya 😔 <span class='fw-semibold'>Jangan patah semangat! Yok Gass Terusss 💪</span>";
            } else {
                $alert_class = 'alert-warning';
                $icon = 'ti ti-minus';
                $message = "Nilai kamu masih <b>stabil</b> nih ⚖️ <span class='fw-semibold'>Pertahankan performamu, Gass Terus Menuju Target!</span>";
            }
        } else {
            $alert_class = 'alert-info';
            $icon = 'ti ti-info-circle';
            $message = "Baru mulai nih! 🌟 <span class='fw-semibold'>Yok ikuti Tryout berikutnya buat lihat progresmu!</span>";
        }

        $data = [
            'title' => $title,
            'user' => $this->loginUser,
            'sidebar_menu' => $this->sidebarMenu,
            'parent_submenu' => $title,
            'tryout' => $tryout,
            'mytryout' => $mytryout,
            'tryout_names' => $tryout_names,
            'tryout_scores' => $tryout_scores,
            'alert_class' => $alert_class,
            'icon' => $icon,
            'message' => $message,
            'jumlah_tryout' => $jumlah_tryout,
            'rata_rata' => $rata_rata,
            'tertinggi' => $tertinggi,
            'terendah' => $terendah,
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/user_footer');
    }

    public function editprofile()
    {
        $parent_title = getSubmenuTitleById(6)['title'];
        submenu_access(6);

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
            'parent_submenu' => $parent_title
        ];
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('no_wa', 'WhatsApp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('templates/user_footer');
        } else {
            $name = htmlspecialchars($this->input->post('name', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $no_wa = htmlspecialchars($this->input->post('no_wa'));

            //cek jika ada gambar yang akan di-upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    //cari nama gambar lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->user->update(['image' => $new_image], ['email' => $email]);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if (substr($no_wa, 0, 1) == '0') {
                $no_wa = '62' . substr($no_wa, 1, strlen($no_wa));
            }

            $this->user->update([
                'name' => $name,
                'no_wa' => $no_wa
            ], ['email' => $email]);

            $this->session->set_flashdata('success', 'Update Profil');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $parent_title = getSubmenuTitleById(7)['title'];
        submenu_access(7);

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
            'parent_submenu' => $parent_title
        ];

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/user_footer');
        } else {
            $current_password = $this->input->post('current_password', true);
            $new_password = $this->input->post('new_password1', true);

            //cek apakah current password sama dengan yang di database
            if (!password_verify($current_password, $data['user']->password)) {
                $this->session->set_flashdata('error', 'Wrong current password!');
                redirect('user/changepassword');
            } else {
                //cek apakah current password sama dengan new password
                if ($current_password == $new_password) {

                    $this->session->set_flashdata('error', 'New password cannot be the same as current password!');
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $id = $data['user']->id;

                    $this->user->update(['password' => $password_hash], ['id' => $id]);

                    $this->session->set_flashdata('success', 'Mengubah Password!');
                    redirect('user/changepassword');
                }
            }
        }
    }
}