<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pendaftar_to_model extends CI_Model{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'pendaftar_to';
    }

    public function insert($data){
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }
public function get_all_by_packet_to_id($id){
    $this->db->select($this->table . '.*, paket_to.nama as nama_to, user.name as username, transactions.transaction_status as status');
    $this->db->from($this->table);
    $this->db->join('paket_to', 'paket_to.id = ' . $this->table . '.paket_to_id', 'left');
    $this->db->join('user', 'user.id = ' . $this->table . '.user_id', 'left');
    $this->db->join('transactions','transactions.id = ' . $this->table . '.transaction_id','left');
    $this->db->where($this->table . '.paket_to_id', $id);
    $query = $this->db->get();
    return $query->result();
}

}