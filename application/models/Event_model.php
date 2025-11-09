<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends CI_Model
{
    protected $table;
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'events'; // Using plural form to match schema
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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

    public function get($type, $where = null, $select = '*')
    {
        $this->db->select($select);
        if ($where) {
            $this->db->where($where);
        }
        
        if ($type == 'one') {
            return $this->db->get($this->table)->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }

    public function update($data, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }

    public function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete($this->table);
    }

    public function getNumRows($where = null)
    {
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get all events with their associated tryouts
     */
    public function getAllWithTryouts()
    {
        // First get all events
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $events = $this->db->get($this->table)->result_array();
        
        // Then get tryouts for each event
        foreach ($events as &$event) {
            $this->db->select('tryout.id, tryout.name, tryout.slug, tryout.status');
            $this->db->from('events_tryout');
            $this->db->join('tryout', 'tryout.id = events_tryout.tryout_id', 'left');
            $this->db->where('events_tryout.event_id', $event['id']);
            $tryouts = $this->db->get()->result_array();
            
            $event['tryouts'] = $tryouts;
        }
        
        return $events;
    }

    /**
     * Generate unique slug from name
     */
    public function generateSlug($name)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        $original_slug = $slug;
        $counter = 1;
        
        // Check if slug exists and modify if necessary
        while ($this->slugExists($slug)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Check if slug exists
     */
    private function slugExists($slug)
    {
        $this->db->where('slug', $slug);
        return $this->db->count_all_results($this->table) > 0;
    }
}