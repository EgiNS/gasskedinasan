<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pendaftar_to_model extends CI_Model{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'pendaftar_paket_to';
    }

    public function insert($data){
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }
public function get_all_by_packet_to_id($slug){
    $this->db->select($this->table . '.*, paket_to.nama as nama_paket,paket_to.hidden, paket_to.slug , paket_to.harga ,user.name as username, user.email, user.no_wa, transactions.gross_amount as jumlah_bayar, SUM(transactions.gross_amount) as total_pendapatan, transactions.updated_at as waktu_pembayaran');
    $this->db->from($this->table);
    $this->db->join('paket_to', 'paket_to.id = ' . $this->table . '.paket_to_id', 'left');
    $this->db->join('user', 'user.id = ' . $this->table . '.user_id', 'left');
    $this->db->join('transactions','transactions.id = ' . $this->table . '.transaction_id','left');
    $this->db->where('transactions.transaction_status', 'settlement');
    $this->db->where('paket_to.slug', $slug);
    $this->db->group_by($this->table . '.id');
    $query = $this->db->get();
    return $query->result();
}

public function getByPacketToIdWithTransaction($paket_to_id, $user_id)
    {
        $this->db->select('pendaftar_paket_to.id, transactions.transaction_status, transactions.snap_token, transactions.expiry_time');
        $this->db->from($this->table);
        $this->db->join('transactions', 'transactions.id = pendaftar_paket_to.transaction_id', 'left');
        $this->db->where('pendaftar_paket_to.paket_to_id', $paket_to_id);
        $this->db->where('pendaftar_paket_to.user_id', $user_id);
        return $this->db->get()->row_array();
    }

    public function getNumPaketParticipantWithSuccessTransaction($paket_to_id)
    {
        $this->db->from($this->table);
        $this->db->join('transactions', 'transactions.id = pendaftar_paket_to.transaction_id', 'left');
        $this->db->where('pendaftar_paket_to.paket_to_id', $paket_to_id);
        $this->db->where('transactions.transaction_status', 'settlement');
        return $this->db->count_all_results();
    }
    public function update($data, $where){
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }
    
}