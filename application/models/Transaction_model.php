<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'transactions';
    }

    public function insert($data)
    {
           $result = $this->db->insert($this->table, $data);
            if ($result) {
        return $this->db->insert_id();
    } else {
        return false; 
    }

    }
    public function updateByOrderId($orderId, $data){
        $this->db->where('order_id',$orderId);
        $result = $this->db->update($this->table, $data);
        return ($result) ? true : false;
    }
}
