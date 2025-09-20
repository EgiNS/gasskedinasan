<?php

class User_model extends CI_Model
{
    protected $table;
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

    public function getAllJoinRole($select = '*')
    {
        $this->db->select($select);
        $this->db->join('user_role', 'user_role.id = ' . $this->table . '.role_id');
        return $this->db->get($this->table)->result_array();
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
        return $this->db->get($this->table)->row_array();
    }
}