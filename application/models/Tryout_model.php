<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tryout_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'tryout';
    }

    public function insert($data)
    {
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table)->result_array();
    }

    public function getAllOrderByIdDesc($key, $select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get_where($this->table, $key);
        return $result->result_array();
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

    public function dropTryoutSKD($slug)
    {
        $sql = 'DROP TABLE soal_' . $slug . ', ' . 'jawaban_' . $slug . ', ' . 'kunci_tkp_' . $slug . ', ' . 'user_paradata_' . $slug . ', ' . 'user_tryout_' . $slug . ', ' . 'ragu_ragu_' . $slug;

        $this->db->query($sql);
    }

    public function dropTryoutnonSKD($slug)
    {
        $sql = 'DROP TABLE soal_' . $slug . ', ' . 'jawaban_' . $slug . ', ' . 'user_paradata_' . $slug . ', ' . 'user_tryout_' . $slug . ', ' . 'ragu_ragu_' . $slug . ', ' . 'bobot_nilai_tiap_soal_' . $slug;
        $this->db->query($sql);
    }
}