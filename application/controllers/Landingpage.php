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
        $slug = 'to_akbar_skd_8_hots';
        $slug_2 = 'focus_matematika_stis_series_2';
        
        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $tryout_2 = $this->tryout->get('one', ['slug' => $slug_2]);

        $data = ['tryout'=>$tryout];
        $data_2 = ['tryout_2'=>$tryout_2];
        
        $role = check_role();
        $data = [
            'tryout' => $tryout,
            'role' => $role,
            'tryout_2' => $tryout_2
        ];
        
        $this->load->view('landingpage/index', $data);
    }
}
