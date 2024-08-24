<?php

class Model_activity_detail extends CI_Model {

    public function detail($id) {
        $params = array('activity_detail_id' => $id);
        return $this->db->get_where('activity_detail', $params);
    }

    public function activity_detail($id) {
        $query = "SELECT
                    a.activity_id,
                    a.activity_status_id,
                    ad.user_id,
                    ad.level_id
                FROM
                    activity a
                    LEFT JOIN activity_detail ad ON a.activity_id = ad.activity_id
                WHERE a.activity_id=".$id;

        return $this->db->query($query);
    }

    public function list_detail($id) {
        $query = "SELECT
                    ad.activity_detail_id,
                    lvl.level_name,
                    ad.created_at,
                    u.name
                FROM
                    activity_detail ad
                    LEFT JOIN user u ON ad.user_id = u.user_id
                    LEFT JOIN level lvl ON ad.level_id = lvl.level_id
                WHERE ad.activity_id=".$id;
        return $this->db->query($query);
    }
    
    public function tech_add($id, $activity, $activity_detail) {
        $this->db->trans_start();
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $activity);
        $activity_detail['activity_id'] = $id;
        $this->db->insert('activity_detail', $activity_detail);
        $this->db->trans_complete();
    }
    
    public function activity_edit($id) {
        $query = "SELECT
                    ad.activity_id,
                    ad.activity_detail_id,
                    ad.level_id,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.action_description,
                    ad.reason,
                    ad.img,
                    ad.created_at,
                    ad.user_id,
                    a.activity_status_id
                FROM
                    activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                WHERE ad.activity_detail_id=".$id;
        
        return $this->db->query($query);
    }
    
    public function tech_update($id, $activity, $activity_detail) {
        $this->db->trans_start();
        $ad_id = array('activity_detail_id' => $id);
        $activity_detail_id = $this->db->get_where('activity_detail', $a_id)->row_array();
        $a_id = $activity_detail_id['activity_id'];
        $this->db->where('activity_detail_id', $id);
        $this->db->update('activity_detail', $activity_detail);
        $this->db->where('activity_id', $a_id);
        $this->db->update('activity', $activity);
        $this->db->trans_complete();
    }
    
    public function delete($id) {
        $this->db->where('activity_detail_id', $id);
        $this->db->delete('activity_detail');
    }
}