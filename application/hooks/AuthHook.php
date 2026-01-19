<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthHook
{
    protected $CI;
    protected $idleLimit = 3600; // 1 jam (detik)

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Sessions_model');
        $this->CI->load->library('session');
    }

    public function check()
    {
        $token = $this->CI->session->userdata('session_token');
        if (!$token) {
            return;
        }

        // ❌ Jangan update activity di halaman auth
        $controller = $this->CI->router->fetch_class();
        if ($controller === 'auth') {
            return;
        }

        $session = $this->CI->Sessions_model->getByToken($token);
        if (!$session) {
            $this->CI->session->sess_destroy();
            redirect('auth');
        }

        // ✅ hanya sentuh kalau session memang aktif
        $this->CI->Sessions_model->touch($session->id);
    }
}
