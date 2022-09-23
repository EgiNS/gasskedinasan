<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_menu_model extends CI_Model
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user_sub_menu';
    }

    public function insert($data)
    {
        $result = $this->db->insert($this->table, $data);
        return ($result == true) ? true : false;
    }

    public function getAll($select = '*')
    {
        $this->db->select($select);
        $this->db->order_by('menu_id', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    public function getAllForSubmenuManagement()
    {
        $query = "SELECT `$this->table`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `$this->table`.`menu_id` = `user_menu`.`id` WHERE `$this->table`.`menu_id` != 5";

        $data = $this->db->query($query)->result_array();
        return $data;
    }

    public function getForSidebar($menu_id, $role_id, $select = '*')
    {
        $this->db->select($select);
        $this->db->join('user_access_sub_menu', 'user_access_sub_menu.sub_menu_id = ' . $this->table . '.id');
        $this->db->where('user_access_sub_menu.role_id', $role_id);
        $this->db->where([$this->table . '.menu_id' => $menu_id, $this->table . '.menu_id !=' => 5, $this->table . '.is_active' => 1]);
        $this->db->order_by('sub_menu_id', 'ASC');
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
        return ($result == true) ? true : false;
    }
}