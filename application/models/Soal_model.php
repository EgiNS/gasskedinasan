<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'soal_';
    }

    public function insert($data, $slug)
    {
        $result = $this->db->insert($this->table . $slug, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($slug, $select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table . $slug)->result_array();
    }

    public function get($count, $key, $slug, $select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('id', 'ASC');
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

    public function getForPagination($key, $rows, $start, $slug)
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->get_where($this->table . $slug, $key, $rows, $start)->result_array();
    }

    public function createTableSKD($slug)
    {
        $tabel_soal = $this->table . $slug;
        $sql_tabel_soal = "CREATE TABLE `$tabel_soal` (
            `pk` int(11) NOT NULL AUTO_INCREMENT,
            `id` int(11) NOT NULL,
            `tipe_soal` int(11) NOT NULL,
            `text_soal` text DEFAULT NULL,
            `gambar_soal` varchar(1024) DEFAULT NULL,
            `text_a` varchar(1024) DEFAULT NULL,
            `text_b` varchar(1024) DEFAULT NULL,
            `text_c` varchar(1024) DEFAULT NULL,
            `text_d` varchar(1024) DEFAULT NULL,
            `text_e` varchar(1024) DEFAULT NULL,
            `gambar_a` varchar(1024) DEFAULT NULL,
            `gambar_b` varchar(1024) DEFAULT NULL,
            `gambar_c` varchar(1024) DEFAULT NULL,
            `gambar_d` varchar(1024) DEFAULT NULL,
            `gambar_e` varchar(1024) DEFAULT NULL,
            `gambar_pembahasan` varchar(1024) DEFAULT NULL,
            `pembahasan` text DEFAULT NULL,
            `token` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`pk`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_soal);
    }

    public function createTablenonSKD($slug)
    {
        $tabel_soal = $this->table . $slug;
        $sql_tabel_soal = "CREATE TABLE `$tabel_soal` (
            `pk` int(11) NOT NULL AUTO_INCREMENT,
            `id` int(11) NOT NULL,
            `text_soal` text DEFAULT NULL,
            `gambar_soal` varchar(1024) DEFAULT NULL,
            `text_a` varchar(1024) DEFAULT NULL,
            `text_b` varchar(1024) DEFAULT NULL,
            `text_c` varchar(1024) DEFAULT NULL,
            `text_d` varchar(1024) DEFAULT NULL,
            `text_e` varchar(1024) DEFAULT NULL,
            `gambar_a` varchar(1024) DEFAULT NULL,
            `gambar_b` varchar(1024) DEFAULT NULL,
            `gambar_c` varchar(1024) DEFAULT NULL,
            `gambar_d` varchar(1024) DEFAULT NULL,
            `gambar_e` varchar(1024) DEFAULT NULL,
            `gambar_pembahasan` varchar(1024) DEFAULT NULL,
            `pembahasan` text DEFAULT NULL,
            `token` varchar(256) DEFAULT NULL,
            PRIMARY KEY (`pk`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_soal);
    }


    public function getAllTipeSoal()
    {
        return $this->db->get('tipe_soal')->result_array();
    }
}