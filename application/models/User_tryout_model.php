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

    public function insertUserTryoutMultiSlug($data, $tryouts)
{
    foreach ($tryouts as $tryout) {
        $tableName = $this->table . $tryout['slug'];

        $result = $this->db->insert($tableName, $data);

        if (!$result) {
            return false; // kalau ada tabel gagal, hentikan
        }
    }

    return true; // semua tabel berhasil
}


    public function getAll($slug, $select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table . $slug)->result_array();
    }
    public function getByTryoutIdWithTransaction($slug,$user_id)
    {
        $user_tryout_table = $this->table . $slug;
        $this->db->select('
        ' . $user_tryout_table . '.id,
        tr.transaction_status,
        tr.snap_token, tr.expiry_time
        
    ');
        $this->db->from($user_tryout_table);
        $this->db->join('transactions tr', $user_tryout_table . '.transaction_id = tr.id', 'left');

        $this->db->where($user_tryout_table . '.user_id', $user_id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get($count, $key, $slug, $select = '*', $user = null)
    {
        $table = $this->table . $slug;
        $this->db->select($select);

        // Ambil semua kolom dari tabel
        $fields = $this->db->list_fields($table);

        // Default kondisi
        $where = [];

        if (isset($key['user_id'])) {
            // Kalau tabel punya kolom user_id
            if (in_array('user_id', $fields)) {
                $where['user_id'] = $key['user_id'];
            }
            // Kalau gak ada user_id tapi ada email dan user object dikirim
            else if (in_array('email', $fields) && isset($user->email)) {
                $where['email'] = $user->email;
            }
            // Kalau gak ada dua-duanya, return kosong
            else {
                return [];
            }
        } else {
            $where = $key; // kalau pakai key lain
        }

        // Tambahkan order_by untuk memastikan urutan terbaru duluan
        if ($count === 'one') {
            // Deteksi apakah tabel punya kolom id
            if (in_array('id', $fields)) {
                $this->db->order_by('id', 'DESC');
            } elseif (in_array('created_at', $fields)) {
                $this->db->order_by('created_at', 'DESC');
            }
            $this->db->limit(1);
            $result = $this->db->get_where($table, $where);
            return $result->row_array();
        } else if ($count === 'many') {
            $result = $this->db->get_where($table, $where);
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function update($data, $key, $slug)
    {
        $this->db->set($data);
        $this->db->where($key);
        $result = $this->db->update($this->table . $slug);
        return ($result == true) ? true : false;
    }

    public function updateLastRow($data, $key, $slug)
    {
        $this->db->set($data);
        $this->db->where($key);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
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
            `user_id` int(11) NOT NULL,
            `transaction_id` int(11) DEFAULT NULL,
            `token` int(11) DEFAULT NULL,
            `status` int(11) DEFAULT 0,
            `freemium` int(11) DEFAULT 0,
            `bukti` varchar(256) DEFAULT NULL,
            `refferal` varchar(256) DEFAULT NULL,
            `twk` int(11) DEFAULT NULL,
            `tiu` int(11) DEFAULT NULL,
            `tkp` int(11) DEFAULT NULL,
            `total` int(11) DEFAULT NULL,
            `pengerjaan` int(11) DEFAULT 1,
             PRIMARY KEY (`id`),
             CONSTRAINT `fk_user_tryout_user_{$slug}` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
             CONSTRAINT `fk_user_tryout_transaction_{$slug}` FOREIGN KEY (`transaction_id`) REFERENCES `transactions`(`id`) ON DELETE CASCADE
             
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

        // Cek apakah kolom 'user_id' ada di tabel
        $checkColumn = $this->db->query("SHOW COLUMNS FROM user_tryout_{$slug} LIKE 'user_id'");
        $useUserId = $checkColumn->num_rows() > 0;

        if ($useUserId) {
            $joinField = 'user_id';
            $onClause = 'u.id = ut.user_id';
        } else {
            $joinField = 'email';
            $onClause = 'u.email = ut.email';
        }

        $query = "
    SELECT u.*, ut.*
    FROM user AS u
    JOIN (
        SELECT t1.*
        FROM user_tryout_{$slug} t1
        JOIN (
            SELECT {$joinField}, MIN(id) AS min_id
            FROM user_tryout_{$slug}
            GROUP BY {$joinField}
        ) t2 ON t1.{$joinField} = t2.{$joinField} AND t1.id = t2.min_id
    ) ut ON {$onClause}
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
