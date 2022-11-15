<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Latsol_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'latsol';
    }

    public function getAll($select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table)->result_array();
    }

    public function insert($data)
    {
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
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

    public function getskd($select = '*')
    {
        $this->db->select($select);
        return $this->db->where('jenis <', 4);
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

    public function joinMateri()
    {
        $this->db->select('*');
        $this->db->from('latsol');
        $this->db->join('bimbel','bimbel.slug = latsol.slug');      
        $result = $this->db->get();
        return $result;
    }
}