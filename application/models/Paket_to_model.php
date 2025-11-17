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
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

public function getBySlugWithTryouts($slug)
{
    $this->db->select('
        paket_to.id,
        paket_to.nama,
        paket_to.slug,
        paket_to.harga,
        paket_to.foto,
        paket_to.keterangan,
        tryout_paket_to.tryout_id,
        tryout_paket_to.paket_to_id,
        tryout.name AS tryout_name,
        tryout.keterangan AS tryout_keterangan,
        tryout.gambar AS tryout_gambar,
        tryout.slug AS tryout_slug,
        tryout.tipe_tryout AS tipe_tryout,
        tryout.jumlah_soal AS jumlah_soal,
        tryout.lama_pengerjaan AS lama_pengerjaan,
    ');
    $this->db->from('paket_to');
    $this->db->join('tryout_paket_to', 'tryout_paket_to.paket_to_id = paket_to.id', 'left');
    $this->db->join('tryout', 'tryout.id = tryout_paket_to.tryout_id', 'left');
    $this->db->where('paket_to.slug', $slug);

    $this->db->order_by('paket_to.id', 'DESC');

    $rows = $this->db->get()->result_array();

    if (empty($rows)) {
        return null;
    }

    // Since we're looking by slug (unique), we expect only one paket
    $paket = [
        'id' => $rows[0]['id'],
        'nama' => $rows[0]['nama'],
        'harga' => $rows[0]['harga'],
        'slug' => $rows[0]['slug'],
        'foto' => $rows[0]['foto'],
        'keterangan' => $rows[0]['keterangan'],
        'tryouts' => [],
    ];

    // Add all tryouts to this single paket
    foreach ($rows as $row) {
        if (!empty($row['tryout_id'])) {
            $paket['tryouts'][] = [
                'tryout_id' => $row['tryout_id'],
                'paket_to_id' => $row['paket_to_id'],
                'name' => $row['tryout_name'],
                'keterangan' => $row['tryout_keterangan'],
                'slug' => $row['tryout_slug'],
                'tipe_tryout' => $row['tipe_tryout'],
                'jumlah_soal' => $row['jumlah_soal'],
                'lama_pengerjaan' => $row['lama_pengerjaan'],
                'gambar' => $row['tryout_gambar']
            ];
        }
    }

    return $paket;
}
public function getAllWithTryouts()
{
    $this->db->select('
        paket_to.id,
        paket_to.nama,
        paket_to.harga,
        paket_to.foto,
        paket_to.keterangan,
        tryout_paket_to.tryout_id,
        tryout_paket_to.paket_to_id,
        tryout.name AS tryout_name,
    ');
    $this->db->from('paket_to');
    $this->db->join('tryout_paket_to', 'tryout_paket_to.paket_to_id = paket_to.id', 'left');
    $this->db->join('tryout', 'tryout.id = tryout_paket_to.tryout_id', 'left');
    $this->db->order_by('paket_to.id', 'DESC');

    $rows = $this->db->get()->result_array();

    // Gabungkan tryouts per paket
    $grouped = [];
    foreach ($rows as $row) {
        $id = $row['id'];
        if (!isset($grouped[$id])) {
            $grouped[$id] = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'harga' => $row['harga'],
                'foto' => $row['foto'],
                'keterangan' => $row['keterangan'],
                'tryouts' => [],
            ];
        }

        if (!empty($row['tryout_id'])) {
            $grouped[$id]['tryouts'][] = [
                'tryout_id' => $row['tryout_id'],
                'paket_to_id' => $row['paket_to_id'],
                'name' => $row['tryout_name'],
                
                
            ];
        }
    }

    return array_values($grouped);
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
