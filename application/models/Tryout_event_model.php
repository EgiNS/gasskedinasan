<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tryout_event_model extends CI_Model
{
    protected $table;
    
    public function __construct()
    {
        parent::__construct();
        $this->table = 'events_tryout'; // Using the correct table name from schema
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
     * Get tryouts for a specific event
     */
    public function getTryoutsByEvent($event_id)
    {
        $this->db->select('tryout.id, tryout.name, tryout.slug, tryout.status');
        $this->db->from($this->table);
        $this->db->join('tryout', 'tryout.id = events_tryout.tryout_id', 'left');
        $this->db->where('events_tryout.event_id', $event_id);
        return $this->db->get()->result_array();
    }

    /**
     * Get events for a specific tryout
     */
    public function getEventsByTryout($tryout_id)
    {
        $this->db->select('events.id, events.name, events.gambar, events.harga, events.group_link');
        $this->db->from($this->table);
        $this->db->join('events', 'events.id = events_tryout.event_id', 'left');
        $this->db->where('events_tryout.tryout_id', $tryout_id);
        return $this->db->get()->result_array();
    }

    /**
     * Check if event-tryout relationship exists
     */
    public function relationshipExists($event_id, $tryout_id)
    {
        $this->db->where([
            'event_id' => $event_id,
            'tryout_id' => $tryout_id
        ]);
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Delete all tryouts for an event
     */
    public function deleteByEvent($event_id)
    {
        $this->db->where('event_id', $event_id);
        return $this->db->delete($this->table);
    }

    /**
     * Delete all events for a tryout
     */
    public function deleteByTryout($tryout_id)
    {
        $this->db->where('tryout_id', $tryout_id);
        return $this->db->delete($this->table);
    }

    /**
     * Get count of tryouts in an event
     */
    public function getTryoutCount($event_id)
    {
        $this->db->where('event_id', $event_id);
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get count of events for a tryout
     */
    public function getEventCount($tryout_id)
    {
        $this->db->where('tryout_id', $tryout_id);
        return $this->db->count_all_results($this->table);
    }
}