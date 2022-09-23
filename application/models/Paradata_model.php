<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paradata_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user_paradata_';
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

    public function getForPagination($key, $rows, $start, $slug)
    {
        return $this->db->get_where($this->table . $slug, $key, $rows, $start)->result_array();
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
        $tabel_user_paradata = $this->table . $slug;
        $sql_tabel_user_paradata = "CREATE TABLE `$tabel_user_paradata` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) DEFAULT NULL,
            `email` varchar(256) DEFAULT NULL,
            `nomor` int(11) NOT NULL,
            `riwayat` char(1) NOT NULL,
            `created_at` int(15) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_user_paradata);
    }
}