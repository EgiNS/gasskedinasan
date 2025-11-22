<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Event_pendaftar_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'events_pendaftar';
    }
        public function get($count, $key, $select = '*')
    {
        $this->db->select($select);
        $result = $this->db->get_where($this->table, $key);
        if ($count === 'many')
            return $result->result_array();
        else if ($count === 'one')
            return $result->row_array();
        else
            return false;
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return  $this->db->insert_id();
    }

    public function getByEventId($event_id, $user_id)
    {
        $this->db->select('id,status');
        $this->db->from($this->table);
        $this->db->where('events_pendaftar.event_id', $event_id);
        $this->db->where('events_pendaftar.user_id', $user_id);
        return $this->db->get()->row_array();
    } 

    public function getByEventIdWithTransaction($event_id, $user_id)
    {
        $this->db->select('events_pendaftar.id, transactions.transaction_status, transactions.snap_token, transactions.expiry_time');
        $this->db->from($this->table);
        $this->db->join('transactions', 'transactions.id = events_pendaftar.transaction_id', 'left');
        $this->db->where('events_pendaftar.event_id', $event_id);
        $this->db->where('events_pendaftar.user_id', $user_id);
        return $this->db->get()->row_array();
    }

    public function getNumEventParticipantWithSuccessTransaction($event_id)
    {
        $this->db->from($this->table);
        $this->db->join('transactions', 'transactions.id = events_pendaftar.transaction_id', 'left');
        $this->db->where('events_pendaftar.event_id', $event_id);
        $this->db->where('transactions.transaction_status', 'settlement');
        return $this->db->count_all_results();
    }
    public function update($data, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }

    public function get_all_by_event_slug($slug){
        $this->db->select($this->table . '.*, events.name as nama_event,events.hidden, events.slug , events.harga ,user.name as username, user.email, user.no_wa, transactions.gross_amount as jumlah_bayar, SUM(transactions.gross_amount) as total_pendapatan, transactions.updated_at as waktu_pembayaran');
    $this->db->from($this->table);
    $this->db->join('events', 'events.id = ' . $this->table . '.event_id', 'left');
    $this->db->join('user', 'user.id = ' . $this->table . '.user_id', 'left');
    $this->db->join('transactions','transactions.id = ' . $this->table . '.transaction_id','left');
    $this->db->where('transactions.transaction_status', 'settlement');
    $this->db->where('events.slug', $slug);
    $this->db->group_by($this->table . '.id');
    $query = $this->db->get();
    return $query->result();
    }
}