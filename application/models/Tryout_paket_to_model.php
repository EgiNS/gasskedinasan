<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tryout_paket_to_model extends CI_Model {

    protected $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tryout_paket_to';
    }

    public function insert($data)
    {
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }
}