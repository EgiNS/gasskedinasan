<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket_to_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'paket_to';
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return  $this->db->insert_id();
    }

    public function insert_pendaftar($data, $slug)
    {
        $result = $this->db->insert('pendaftar_' . $slug, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table)->result_array();
    }

    public function getAllOrderByIdDesc($select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    public function getAllPendaftar($slug)
    {
        $this->db->select("*");
        return $this->db->get('pendaftar_' . $slug)->result_array();
    }

    public function createPendaftar($slug)
    {
        $tabel_pendaftar = 'pendaftar_' . $slug;
        $sql_tabel_pendaftar = "CREATE TABLE `$tabel_pendaftar` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `nama` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
            `email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
            `no_wa` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
            `bukti` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
            `created_at` DATETIME NOT NULL DEFAULT current_timestamp(),
            `status` INT(11) NOT NULL DEFAULT '0',
            
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_pendaftar);
    }
}