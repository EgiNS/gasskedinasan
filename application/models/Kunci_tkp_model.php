<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunci_tkp_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'kunci_tkp_';
    }

    public function insert($data, $slug)
    {
        $result = $this->db->insert($this->table . $slug, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($slug, $select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table . $slug)->result_array();
    }

    public function get($count, $key, $slug, $select = '*')
    {
        $this->db->select($select);
        $result = $this->db->get_where($this->table . $slug, $key);
        if ($count === 'many')
            return $result->result_array();
        else if ($count === 'one')
            return $result->row_array();
        else
            return false;
    }

    public function update($data, $key, $slug)
    {
        $this->db->set($data);
        $this->db->where($key);
        $result = $this->db->update($this->table . $slug);
        return ($result == true) ? true : false;
    }

    public function delete($key, $slug)
    {
        $result = $this->db->delete($this->table . $slug, $key);
        return ($result == true) ? true : false;
    }

    public function getNumRows($data, $slug)
    {
        $this->db->where($data);
        $result = $this->db->get($this->table . $slug);
        return $result->num_rows();
    }

    public function createTable($slug)
    {
        $tabel_kunci_tkp = $this->table . $slug;

        //FOR KOLOM KUNCI TKP
        $string_kunci_tkp = '';
        for ($i = 66; $i <= 110; $i++) {
            $string_kunci_tkp .= "`$i` int(11) DEFAULT NULL,";
        }
        $sql_tabel_kunci_tkp = "CREATE TABLE `$tabel_kunci_tkp` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `pilihan` char(1) NOT NULL,
            $string_kunci_tkp
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_kunci_tkp);
    }
}