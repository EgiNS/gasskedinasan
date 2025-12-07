<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landingpage extends CI_Controller
{
 public function __construct()
    {
        parent::__construct();

        $this->load->model('Tryout_model', 'tryout');
    }

    public function index()
    {
        $show = $this->db->get('show_to_landingpage')->row();

        // Cek jika datanya ada
        if ($show) {
            // Ambil data tryout berdasarkan to_id
            $tryout = $this->tryout->get('one', ['id' => $show->to_id]);
        } else {
            $tryout = null;
        }
        
        $role = check_role();
        $data = [
            'show' => $show,
            'tryout' => $tryout,
            'role' => $role,
        ];
        
        $this->load->view('landingpage/index', $data);
    }
    public function refund_policy()
    {
        $this->load->view('landingpage/refund-policy/index');
    }
}
