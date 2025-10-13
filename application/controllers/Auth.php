<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    protected $loginUser;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'user');
        $this->load->model('Token_model', 'token');
        $this->load->model('Paket_to_model', 'paket_to');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('Token_settings_model', 'token_settings');
        $this->load->model('Email_settings_model', 'email_settings');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->loginUser = $this->user->getLoginUser();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'User Login';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi success
            $this->_login();
        }

        $this->goToDefaultPage();
    }

    public function registration()
    {
        $email_settings = $this->email_settings->get('one', ['id' => 1]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('no_wa', 'No. WA', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $no_wa =  $this->input->post('no_wa', true);
            $password = $this->input->post('password1');

            //siapkan token
            $random = random_bytes(32);

            //terjemahkan token
            $token = base64_encode($random);

            //tabel di database
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // kirim email ke user yang baru registrasi
            if ($token_settings['account_activation'] == 1) {
                $is_active = 0;

                if ($email_settings['mail_transport_type'] == 'smtp')
                    $this->_smtpMail($token, 'verify');
                else if ($email_settings['mail_transport_type'] == 'php')
                    $this->_phpMail($token, 'verify');

                $this->token->insert($user_token);

                $message = '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please check your email for activate your account.</div>';
            } else {
                $is_active = 1;
                $message = '<div class="alert alert-success" role="alert">Selamat! Akun Anda telah berhasil didaftarkan. Silakan Login.</div>';
            }

            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'no_wa' => htmlspecialchars($no_wa),
                'image' => 'default.jpg',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => $is_active
            ];

            $this->user->insert($data);

            $this->session->set_flashdata('message', $message);
            redirect('auth');
        }
    }
    
    public function registerto()
    {
        $email_settings = $this->email_settings->get('one', ['id' => 1]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('no_wa', 'No. WA', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('error', '<ul>' . $errors . '</ul>');
            var_dump($this->session->flashdata('error'));
            redirect(base_url());
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $no_wa =  $this->input->post('no_wa', true);
            $password = $this->input->post('password1');

            //siapkan token
            $random = random_bytes(32);

            //terjemahkan token
            $token = base64_encode($random);

            //tabel di database
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // kirim email ke user yang baru registrasi
            if ($token_settings['account_activation'] == 1) {
                $is_active = 0;

                if ($email_settings['mail_transport_type'] == 'smtp')
                    $this->_smtpMail($token, 'verify');
                else if ($email_settings['mail_transport_type'] == 'php')
                    $this->_phpMail($token, 'verify');

                $this->token->insert($user_token);

                $message = '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please check your email for activate your account.</div>';
            } else {
                $is_active = 1;
                $message = '<div class="alert alert-success" role="alert">Selamat! Anda telah berhasil terdaftar. Silakan Login dengan email dan password yang telah kamu daftarkan untuk mengakses try out. <br><br> Jangan lupa gabung grup belajar melalui menu my tryout setelah melakukan login. </div>';

            }

            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'no_wa' => htmlspecialchars($no_wa),
                'image' => 'default.jpg',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => $is_active
            ];

            $this->user->insert($data);

            //ubah ini sesuai
            $slug = $this->input->post('slug');

            $user_tryout = $this->user_tryout->get('one', ['email' => htmlspecialchars($email)], $slug);
            if ($user_tryout)
                $this->session->set_flashdata('error', "Anda sudah terdaftar pada tryout ini");
            else {
                $data = [
                    'email' => htmlspecialchars($email),
                    'token' => 11111,
                    'status' => 0
                ];
                $this->user_tryout->insert($data, $slug);
                $this->session->set_flashdata('success', "melakukan pendaftaran pada tryout ini");
            }

            $this->session->set_flashdata('message', $message);
            redirect('auth');
        }
    }
    
    public function registerfreemium()
    {
        $email_settings = $this->email_settings->get('one', ['id' => 1]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('no_wa', 'No. WA', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('error', '<ul>' . $errors . '</ul>');
            var_dump($this->session->flashdata('error'));
            redirect(base_url());
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $no_wa =  $this->input->post('no_wa', true);
            $password = $this->input->post('password1');

            //siapkan token
            $random = random_bytes(32);

            //terjemahkan token
            $token = base64_encode($random);

            //tabel di database
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // kirim email ke user yang baru registrasi
            if ($token_settings['account_activation'] == 1) {
                $is_active = 0;

                if ($email_settings['mail_transport_type'] == 'smtp')
                    $this->_smtpMail($token, 'verify');
                else if ($email_settings['mail_transport_type'] == 'php')
                    $this->_phpMail($token, 'verify');

                $this->token->insert($user_token);

                $message = '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please check your email for activate your account.</div>';
            } else {
                $is_active = 1;
                
                $slug = $this->input->post('slug');
                $tryout = $this->tryout->get('one', ['slug' => $slug]);
                
                $message = '<div class="alert alert-success" role="alert">
                    Selamat! Anda telah berhasil terdaftar. Silakan Login dengan email dan password yang telah kamu daftarkan untuk mengakses try out. <br><br> 
                    Jangan lupa gabung grup belajar melalui menu my tryout setelah melakukan login. 
                </div>';
            }

            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'no_wa' => htmlspecialchars($no_wa),
                'image' => 'default.jpg',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => $is_active
            ];

            $this->user->insert($data);

            $user_tryout = $this->user_tryout->get('one', ['email' => htmlspecialchars($email)], $slug);
            if ($user_tryout)
                $this->session->set_flashdata('error', "Anda sudah terdaftar pada tryout ini");
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
                    redirect()->back();
                }  

                $data = [
                    'email' => htmlspecialchars($email),
                    'token' => 11111,
                    'status' => 100,
                    'freemium' => 1,
                    'bukti' => $imagePath
                ];
                
                $kode_refferal = $this->input->post('kode_refferal');
                $tryout = $this->tryout->get('one', ['slug' => $slug]);
    
                if ($kode_refferal) {
                    $kode_refferal_valid = json_decode($tryout['kode_refferal'], true);
                    $is_valid = false;
    
                    if (in_array($kode_refferal, $kode_refferal_valid)) {
                        $is_valid = true;
                    }
    
                    if ($is_valid) {
                        $data['refferal'] = $kode_refferal;
                    }
                }

                $this->user_tryout->insert($data, $slug);
                $this->session->set_flashdata('success', "melakukan pendaftaran pada tryout ini");
            }

            $this->session->set_flashdata('message', $message);
            redirect('auth');
        }
    }
    
    public function registerpaketto()
    {
        $email_settings = $this->email_settings->get('one', ['id' => 1]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('no_wa', 'No. WA', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $errors = validation_errors('<li>', '</li>');
            $this->session->set_flashdata('error', '<ul>' . $errors . '</ul>');
            var_dump($this->session->flashdata('error'));
            redirect(base_url());
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $no_wa =  $this->input->post('no_wa', true);
            $password = $this->input->post('password1');

            //siapkan token
            $random = random_bytes(32);

            //terjemahkan token
            $token = base64_encode($random);

            //tabel di database
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // kirim email ke user yang baru registrasi
            if ($token_settings['account_activation'] == 1) {
                $is_active = 0;

                if ($email_settings['mail_transport_type'] == 'smtp')
                    $this->_smtpMail($token, 'verify');
                else if ($email_settings['mail_transport_type'] == 'php')
                    $this->_phpMail($token, 'verify');

                $this->token->insert($user_token);

                $message = '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please check your email for activate your account.</div>';
            } else {
                $is_active = 1;
                
                $slug = $this->input->post('slug');
                $tryout = $this->tryout->get('one', ['slug' => $slug]);
                
                $message = '<div class="alert alert-success" role="alert">
                    Selamat! Anda telah berhasil terdaftar. Silakan Login dengan email dan password yang telah kamu daftarkan untuk mengakses try out. <br><br> 
                    Jangan lupa gabung grup belajar melalui menu my tryout setelah melakukan login. 
                </div>';
            }

            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'no_wa' => htmlspecialchars($no_wa),
                'image' => 'default.jpg',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => $is_active
            ];

            $this->user->insert($data);

            $slug = 'fast_mtk_stis';
        
            $user_tryout = $this->paket_to->get('one', ['email' => $email], $slug);
            if ($user_tryout)
                $this->session->set_flashdata('error', "Anda sudah terdaftar pada paket tryout ini");
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
                    redirect()->back();
                }  

                $data = [
                    'email' => htmlspecialchars($email),
                    'status' => 1,
                    'bukti' => $imagePath
                ];

                $this->paket_to->insert_pendaftar($data, 'fast_mtk_stis');
                $this->session->set_flashdata('success', "melakukan pendaftaran pada paket tryout ini");
            }

            $this->session->set_flashdata('message', $message);
            redirect('auth');
        }
    }

    private function _phpMail($token, $type)
    {
        $this->load->model('Company_settings_model', 'company_settings');

        $company_settings = $this->company_settings->get('one', ['id' => 1]);
        $email_settings = $this->email_settings->get('one', ['id' => 1]);

        $mailto = $this->input->post('email');
        $logo = base_url() . 'assets/img/logo/' . $company_settings['logo'];

        if ($type == 'verify') {
            // Subject
            $subject = 'Account Verification';

            $link = base_url() . 'auth/verify?email=' . $this->input->post('email', true) . '&token=' . urlencode($token);

            //Ambil file pesan email html
            $message = file_get_contents(base_url('assets/email/account_verification.html'));

            //Ubah nama
            $message = str_replace('name-of-registration', $this->input->post('name'), $message);
        } else if ($type == 'forgot') {
            // Subject
            $subject = 'Reset Password';

            $link = base_url() . 'auth/resetpassword?email=' . $this->input->post('email', true) . '&token=' . urlencode($token);

            //Ambil file pesan email html
            $message = file_get_contents(base_url('assets/email/PasswordReset.html'));
        }

        //Ubah href
        $message = str_replace('url-button-for-execute-action', $link, $message);

        //Ubah logo
        $message = str_replace('logo-image', $logo, $message);

        // Ubah deskripsi expired
        $message = str_replace('token-time-limit', $this->_expireddescription($type), $message);

        // To send HTML mail, the Content-type header must be set
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: " . $email_settings['email_sender_name'] . ' <' . $email_settings['email_sender_address'] . '>' . "\r\n";
        $headers .= "Reply-To: " . $company_settings['email'] . "\r\n";
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

    private function _smtpMail($token, $type)
    {
        $this->load->model('Company_settings_model', 'company_settings');

        $company_settings = $this->company_settings->get('one', ['id' => 1]);

        $email_settings = $this->email_settings->get('one', ['id' => 1]);
        if ($email_settings['encryption'] == 'none') {
            $encryption = null;
        } else {
            $encryption = $email_settings['encryption'];
        }

        $config = [
            'protocol' => $email_settings['mail_transport_type'],
            'smtp_host' => $email_settings['hostname'],
            'smtp_crypto' => $encryption,
            'smtp_user' => $email_settings['email_sender_address'],
            'smtp_pass' => $email_settings['password'],
            'smtp_port' => $email_settings['port_number'],
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        //sangat penting untuk error
        $this->email->initialize($config);

        $this->email->from($email_settings['email_sender_address'], $email_settings['email_sender_name']);
        $this->email->to($this->input->post('email'));

        $logo = base_url('assets/img/logo/' . $company_settings['logo']);

        // log_message('debug', 'BISAA');

        if ($type == 'verify') {
            $subject = 'Account Verification';

            $link = base_url() . 'auth/verify?email=' . $this->input->post('email', true) . '&token=' . urlencode($token);
            //Ambil file pesan email html
            $message = file_get_contents(base_url('assets/email/account_verification.html'));

            //Ubah nama
            $message = str_replace('name-of-registration', $this->input->post('name'), $message);
        } else if ($type == 'forgot') {
            // log_message('debug', 'MASOKKKK');
            $subject = 'Reset Password';

            $link = base_url() . 'auth/resetpassword?email=' . $this->input->post('email', true) . '&token=' . urlencode($token);

            //Ambil file pesan email html
            $message = file_get_contents(base_url('assets/email/PasswordReset.html'));

            // log_message('debug', 'DAPATTT');
        }

        //Ubah href
        $message = str_replace('url-button-for-execute-action', $link, $message);

        //Ubah logo
        $message = str_replace('logo-image', $logo, $message);

        // Ubah deskripsi expired
        $message = str_replace('token-time-limit', $this->_expireddescription($type), $message);

        //SUBJECT DAN ISI EMAIL
        $this->email->subject($subject);
        $this->email->message($message);

        // KIRIM EMAIL
        if ($this->email->send()) {
            log_message('debug', 'Terkirim');
            return true;
        } else {
            log_message('debug', $this->email->print_debugger());
            die;
        }
    }

    private function _expireddescription($type)
    {
        $token_settings = $this->token_settings->get('one', ['id' => 1]);
        if ($type == 'verify') {
            if ($token_settings['time_limit_activation'] != 0)
                if ($token_settings['time_limit_activation'] == 1)
                    $expired_desc = 'This link is valid for one use only. Expires in 1 hour.';
                else
                    $expired_desc = 'This link is valid for one use only. Expires in ' . $token_settings['time_limit_activation'] . ' hours.';
            else
                $expired_desc = '';
        } else if ($type == 'forgot') {
            if ($token_settings['time_limit_reset_password'] != 0)
                if ($token_settings['time_limit_reset_password'] == 1)
                    $expired_desc = 'This link is valid for one use only. Expires in 1 hour.';
                else
                    $expired_desc = 'This link is valid for one use only. Expires in ' . $token_settings['time_limit_reset_password'] . ' hours.';
            else
                $expired_desc = '';
        }
        return $expired_desc;
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->user->get('one', ['email' => $email]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($user) {
            $user_token = $this->token->get('one', ['token' => $token]);

            //cek kesamaan token
            if ($user_token) {
                if ($token_settings['time_limit_activation'] != 0) {
                    if (time() - $user_token['date_created'] < (60 * 60 * $token_settings['time_limit_activation'])) {
                        $this->user->update(['is_active' => 1], ['email' => $email]);

                        $this->token->delete(['email' => $email]);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login!</div>');
                        redirect('auth');
                    } else {

                        $this->user->delete(['email' => $email]);
                        $this->token->delete(['email' => $email]);

                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                        redirect('auth');
                    }
                } else {
                    $this->user->update(['is_active' => 1], ['email' => $email]);

                    $this->token->delete(['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token invalid.</div>');
                redirect('auth');
            }
        } else {

            //email salah atau ngasal
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->user->get('one', ['email' => $email]);
        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    // $this->user_tryout->update(['ip' => $_SERVER['REMOTE_ADDR']], ['email' => $email], 'focus_matematika_stis_series_1');

                    //jika benar
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 8) {
                        redirect('bimbel/tryout');
                    } else {
                        redirect('tryout/paketto');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    $this->session->set_flashdata('auth_email', $user['email']);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                $this->session->set_flashdata('auth_email', $user['email']);
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            $this->session->set_flashdata('auth_email', $user['email']);
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You has been logged out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->model('Company_settings_model', 'company_settings');
        $company = $this->company_settings->get('one', ['id' => 1]);

        $data = [
            'company' => $company
        ];

        $this->load->view('access-denied', $data);
    }

    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1)
            redirect('admin');
        else if ($this->session->userdata('role_id') == 2)
            redirect('user');
    }


    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);

            $user = $this->user->get('one', [
                'email' => $email,
                'is_active' => 1
            ]);


            if ($user) {
                $random = random_bytes(32);

                //terjemahkan token, karakter aneh menjadi numerik dan karakter yang bisa dikenali
                $token = base64_encode($random);

                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $email_settings = $this->email_settings->get('one', ['id' => 1]);

                $this->token->insert($user_token);

                if ($email_settings['mail_transport_type'] == 'smtp')
                    $this->_smtpMail($token, 'forgot');
                else if ($email_settings['mail_transport_type'] == 'php')
                    $this->_phpMail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
            } else
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');

            redirect('auth/changepassword');
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->user->get('one', ['email' => $email]);
        $token_settings = $this->token_settings->get('one', ['id' => 1]);

        if ($user) {
            $user_token = $this->token->get('one', ['token' => $token]);

            if ($user_token) {
                if ($token_settings['time_limit_reset_password'] != 0) {
                    if (time() - $user_token['date_created'] < (60 * 60 * $token_settings['time_limit_reset_password'])) {
                        $this->session->set_userdata('reset_email', $email);
                        $this->changePassword();
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Token invalid.</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
                redirect('auth');
            }
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email'))
            redirect('auth');

        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change_password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1', true), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->user->update(['password' => $password], ['email' => $email]);

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}