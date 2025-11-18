<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jawaban_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'jawaban_';
    }

    public function insert($data, $slug)
    {
        $result = $this->db->insert($this->table . $slug, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($slug, $select = '*')
    {
        $table = $this->table . $slug;

        if (is_array($select)) {
          $select = implode(', ', array_map(function($s) {
    return "t1.$s";
}, $select));

        }

        $sql = "SELECT $select
                FROM $table AS t1
                JOIN (
                    SELECT email, MAX(id) AS max_id
                    FROM $table
                    GROUP BY email
                ) AS t2 ON t1.email = t2.email AND t1.id = t2.max_id";

        return $this->db->query($sql)->result_array();
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

    public function getNumRowsUnique($data, $slug)
    {
        $this->db->where($data);
        $this->db->select('email');
        $this->db->distinct();
        $result = $this->db->get($this->table . $slug);
        return $result->num_rows();
    }

    public function getLastRow($key, $slug) {
        $this->db->select('id');
        $this->db->from($this->table . $slug);
        $this->db->where($key); // bisa pakai filter tambahan jika perlu
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function createTable($slug, $jumlah_soal)
    {
        $tabel_jawaban = $this->table . $slug;

        //FOR KOLOM BERD. JUMLAH SOAL (110)
        $string_jawaban = '';
        for ($i = 1; $i <= $jumlah_soal; $i++) {
            $string_jawaban .= "`$i` char(1) DEFAULT NULL,";
        }

        $sql_tabel_jawaban = "CREATE TABLE `$tabel_jawaban` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(128) NOT NULL,
            `waktu_mulai` int(11) DEFAULT NULL,
            `waktu_selesai` int(11) DEFAULT NULL,
            $string_jawaban
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_jawaban);

        $kunci_jawaban = 'kunci_jawaban_' . $slug . '@gmail.com';
        $this->insert(['email' => $kunci_jawaban], $slug);
    }
}