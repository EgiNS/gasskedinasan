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
        $shows = $this->db
            ->select('
                s.id AS show_id,
                s.keterangan AS show_keterangan,
                s.to_id,
                t.id AS tryout_id,
                t.name,
                t.gambar
            ')
            ->from('show_to_landingpage s')
            ->join('tryout t', 't.id = s.to_id')
            ->order_by('s.id', 'DESC')
            ->get()
            ->result();
        
        $role = check_role();
        $data = [
            'shows' => $shows,
            'role' => $role,
        ];
        
        $this->load->view('landingpage/index', $data);
    }
}
