<?php

class User_model extends CI_Model
{
    protected $table;
    private $column_order = ['user.name', 'user.email', 'user_role.role', 'user.is_active', 'user.created_at'];
    private $column_search = ['user.name', 'user.email', 'user_role.role'];
    private $order = ['user.created_at' => 'desc'];
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    public function insert($data)
    {
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($select = '*')
    {
        $this->db->select($select);
        return $this->db->get($this->table)->result_array();
    }

      public function getAllJoinRole($select = '*', $limit = null, $start = null, $search = null, $order_column = null, $order_dir = 'asc')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->join('user_role', 'user_role.id = user.role_id', 'left');

        // 🔍 Search global
        if (!empty($search)) {
            $this->db->group_start();
            foreach ($this->column_search as $col) {
                $this->db->or_like($col, $search);
            }
            $this->db->group_end();
        }

        // 🧭 Ordering
        if (!empty($order_column) && isset($this->column_order[$order_column])) {
            $this->db->order_by($this->column_order[$order_column], $order_dir);
        } else {
            $this->db->order_by(key($this->order), current($this->order));
        }

        // 📄 Pagination
        if ($limit != -1 && $limit !== null) {
            $this->db->limit($limit, $start);
        }

        return $this->db->get()->result();
    }

    public function count_filtered($search = null)
    {
        $this->db->from($this->table);
        $this->db->join('user_role', 'user_role.id = user.role_id', 'left');

        if (!empty($search)) {
            $this->db->group_start();
            foreach ($this->column_search as $col) {
                $this->db->or_like($col, $search);
            }
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
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
        // var_dump($result); exit;
        return ($result == true) ? true : false;
    }

    // public function delete_user($id) {
    //     $this->db->where('id', $id);
    //     $this->db->delete('user');
    // }

    public function getNumRows($data)
    {
        $this->db->where($data);
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }

    public function getLoginUser()
    {
        $this->db->where(['email' => $this->session->userdata('email')]);
        return $this->db->get($this->table)->row();
    }
}