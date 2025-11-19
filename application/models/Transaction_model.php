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
        return $result;
    }
    public function selectById($id){
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

public function getAll($select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table)->result_array();
    }

    public function get($count, $key, $select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get_where($this->table, $key);
        if ($count === 'many')
            return $result->result_array();
        else if ($count === 'one')
            return $result->row_array();
        else
            return false;
    }

    public function update($data, $key)
    {
        $this->db->set($data);
        $this->db->where($key);
        $result = $this->db->update($this->table);
        return ($result == true) ? true : false;
    }

    public function delete($key)
    {
        $result = $this->db->delete($this->table, $key);
        return ($result == true) ? true : false;
    }

    public function getNumRows($data)
    {
        $this->db->where($data);
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }

    public function getPendapatan($slug)
    {
        $user_paid = $this->get('many', ['tryout' => $slug, 'status_code' => 200], array('gross_amount'));

        $pendapatan = 0;
        foreach ($user_paid as $up)
            $pendapatan += (int)($up['gross_amount']);

        return $pendapatan;
    }

    public function getAllPendapatan()
    {
        $user_paid = $this->get('many', ['status_code' => 200], array('gross_amount'));

        $pendapatan = 0;
        foreach ($user_paid as $up)
            $pendapatan += (int)($up['gross_amount']);

        return $pendapatan;
    }

    public function getPendapatanTimeSeries()
    {
        $month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        $pendapatanarray = [];

        $time = [
            0 => [
                "no" => "01",
                "month" => "Jan"
            ],
            1 => [
                "no" => "02",
                "month" => "Feb"
            ],
            2 => [
                "no" => "03",
                "month" => "Mar"
            ],
            3 => [
                "no" => "04",
                "month" => "Apr"
            ],
            4 => [
                "no" => "05",
                "month" => "May"
            ],
            5 => [
                "no" => "06",
                "month" => "Jun"
            ],
            6 => [
                "no" => "07",
                "month" => "Jul"
            ],
            7 => [
                "no" => "08",
                "month" => "Aug"
            ],
            8 => [
                "no" => "09",
                "month" => "Sep"
            ],
            9 => [
                "no" => "10",
                "month" => "Oct"
            ],
            10 => [
                "no" => "11",
                "month" => "Nov"
            ],
            11 => [
                "no" => "12",
                "month" => "Dec"
            ]
        ];

        $stop = (string)date('M');
        for ($i = 0; $i < array_search($stop, $month); $i++) {
            $like = (string)date('Y') . "-" . $time[$i]['no'] . "-";
            $payment = $this->getPaymentbyTime(['status_code' => 200], ['updated_at' => $like], array('gross_amount'));

            $total = 0;
            foreach ($payment as $pm)
                $total += (int)$pm['gross_amount'];

            array_push($pendapatanarray, $total);
        }

        return $pendapatanarray;
    }

    private function getPaymentbyTime($key, $like, $select = '*')
    {
        $this->db->select($select);
        $this->db->like($like, 'after');
        $result = $this->db->get_where($this->table, $key)->result_array();
        return $result;
    }
}
