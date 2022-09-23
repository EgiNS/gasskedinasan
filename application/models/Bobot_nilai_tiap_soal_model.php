<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bobot_nilai_tiap_soal_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'bobot_nilai_tiap_soal_';
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

    public function createTable($jumlah_soal, $slug)
    {
        $tabel_bobot_nilai = $this->table . $slug;

        $string_bobot_nilai = '';
        for ($i = 1; $i <= $jumlah_soal; $i++) {
            $string_bobot_nilai .= "`$i` DECIMAL(10,2) DEFAULT NULL,";
        }
        $sql_tabel_bobot_nilai = "CREATE TABLE `$tabel_bobot_nilai` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `pilihan` char(1) NOT NULL,
            $string_bobot_nilai
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_bobot_nilai);
    }
}