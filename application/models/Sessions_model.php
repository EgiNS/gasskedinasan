<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sessions_model extends CI_Model
{
    public function countActiveSessions($userId, $idleLimit)
    {
        $now = time();

        return $this->db
            ->where('user_id', $userId)
            ->where('revoked_at IS NULL', null, false)
            ->where('last_activity_ts >=', $now - $idleLimit)
            ->count_all_results('user_sessions');
    }

    public function revokeIdleSessions($userId, $idleLimit)
    {
        $now = time();

        $this->db
            ->set('revoked_at', date('Y-m-d H:i:s'))
            ->where('user_id', $userId)
            ->where('revoked_at IS NULL', null, false)
            ->where('last_activity_ts <', $now - $idleLimit)
            ->update('user_sessions');
    }

    public function create($data)
    {
        return $this->db->insert('user_sessions', $data);
    }

    public function getByToken($token)
    {
        return $this->db->where('session_token', $token)
            ->where('revoked_at IS NULL', null, false)
            ->get('user_sessions')
            ->row();
    }

    public function revoke($token)
    {
        return $this->db->where('session_token', $token)
            ->update('user_sessions', [
                'revoked_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function touch($sessionId)
    {
        $this->db->where('id', $sessionId)
                ->update('user_sessions', [
                    'last_activity_ts' => time()
                ]);
    }
}
