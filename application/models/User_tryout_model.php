<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_tryout_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user_tryout_';
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

    public function createTableSKD($slug)
    {
        $tabel_user_tryout = $this->table . $slug;
        $sql_tabel_user_tryout = "CREATE TABLE `$tabel_user_tryout` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(256) NOT NULL,
            `token` int(11) DEFAULT NULL,
            `status` int(11) DEFAULT 0,
            `freemium` int(11) DEFAULT 0,
            `bukti` varchar(256) DEFAULT NULL,
            `refferal` varchar(256) DEFAULT NULL,
            `twk` int(11) DEFAULT NULL,
            `tiu` int(11) DEFAULT NULL,
            `tkp` int(11) DEFAULT NULL,
            `total` int(11) DEFAULT NULL,
             PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_user_tryout);
    }

    public function createTablenonSKD($slug)
    {
        $tabel_user_tryout = $this->table . $slug;
        $sql_tabel_user_tryout = "CREATE TABLE `$tabel_user_tryout` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(256) NOT NULL,
            `token` int(11) DEFAULT NULL,
            `status` int(11) DEFAULT 0,
            `freemium` int(11) DEFAULT 0,
            `bukti` varchar(256) DEFAULT NULL,
            `refferal` varchar(256) DEFAULT NULL,
            `nilai` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB";

        $this->db->query($sql_tabel_user_tryout);
    }

    public function getRankingSKD($slug)
    {
        // $query = "SELECT * FROM `user_tryout` JOIN `user` ON `user_tryout`.`email` = `user`.`email` ORDER BY `user_tryout`.`total` DESC, `user_tryout`.`tkp` DESC, `user_tryout`.`tiu` DESC, `user_tryout`.`twk` DESC;";

        $query = "
            SELECT u.*, ut.*
        FROM user AS u
        JOIN (
            SELECT t1.*
            FROM user_tryout_{$slug} t1
            JOIN (
                SELECT email, MIN(id) AS min_id
                FROM user_tryout_{$slug}
                GROUP BY email
            ) t2 ON t1.email = t2.email AND t1.id = t2.min_id
        ) ut ON u.email = ut.email
        ORDER BY ut.total DESC, ut.tkp DESC, ut.tiu DESC, ut.twk DESC;
        ";

        return $this->db->query($query)->result_array();
    }

    public function getRankingnonSKD($slug, $select = '*')
    {
        $query = $this->db->query("
            SELECT ut.*, u.*
            FROM (
                SELECT * FROM {$this->table}{$slug} ut1
                WHERE id IN (
                    SELECT MIN(id) FROM {$this->table}{$slug}
                    WHERE nilai IS NOT NULL
                    GROUP BY email
                )
            ) ut
            JOIN user u ON u.email = ut.email
            ORDER BY ut.nilai DESC
        ");
        return $query->result_array();

    }

    public function getRankingnonSKDAdmin($slug, $select = '*')
    {
        $slug_table = 'user_tryout_' . $slug;

        $subquery = "
            SELECT MIN(id) AS min_id
            FROM {$slug_table}
            GROUP BY email
        ";

        $this->db->select('user.*, ut.*');
        $this->db->from('user');
        $this->db->join("({$slug_table} ut)", "user.email = ut.email");
        $this->db->where("ut.id IN ({$subquery})");
        $this->db->order_by('ut.nilai', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getPersentaseStatusUser($slug)
    {
        if ($slug != 'not-available') {
            $value = array();
            $total = $this->getNumRows(['id >' => 0], $slug);

            if ($total != 0) {
                $belum_memulai = $this->getNumRows(['status' => 0], $slug) / $total * 100;
                $proses = $this->getNumRows(['status' => 1], $slug) / $total * 100;
                $selesai = $this->getNumRows(['status' => 2], $slug) / $total * 100;

                array_push($value, ['belum_memulai' => round($belum_memulai, 2), 'proses' => round($proses, 2), 'selesai' => round($selesai, 2)]);

                return $value;
            } else return false;
        } else return false;
    }
}