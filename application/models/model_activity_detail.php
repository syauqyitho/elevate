<?php

class Model_activity_detail extends CI_Model {

    public function detail($id) {
        $query = "SELECT
                    ad.activity_detail_id,
                    ad.activity_id,
                    ad.level_id,
                    ad.action_description,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.img,
                    ad.created_at,
                    ad.updated_at,
                    ad.reason,
                    act.user_id
                FROM
                    activity_detail ad
                    LEFT JOIN activity_tech act ON ad.activity_tech_id = act.activity_tech_id
                WHERE ad.activity_detail_id=".$id;

        return $this->db->query($query);
    }

    public function activity_detail($id) {
        $query = "SELECT
                    a.activity_id,
                    a.activity_status_id,
                    ad.activity_tech_id,
                    ad.level_id,
                    act.user_id
                FROM
                    activity a
                    LEFT JOIN activity_detail ad ON a.activity_id = ad.activity_id
                    -- this is temporary solution should be change later.
                    LEFT JOIN activity_tech act ON ad.activity_tech_id = act.activity_tech_id
                WHERE a.activity_id=".$id;

        return $this->db->query($query);
    }

    public function list_detail($id) {
        $query = "SELECT
                    ad.activity_detail_id,
                    ad.action_description,
                    lvl.level_name,
                    ad.created_at,
                    u.name
                FROM
                    activity_detail ad
                    LEFT JOIN activity_tech act ON ad.activity_tech_id = act.activity_tech_id
                    LEFT JOIN user u ON act.user_id = u.user_id
                    LEFT JOIN level lvl ON ad.level_id = lvl.level_id
                WHERE ad.activity_id=".$id;
        return $this->db->query($query);
    }
    
    public function tech_add($id, $activity, $activity_detail) {
        $this->db->trans_start();
        $user_id = $activity_detail['activity_tech_id'];
        /* By using ? placeholders in the query and passing the values as an array to the query() method, 
         * we can ensure that the values are properly escaped and injected into the query,
         * preventing SQL injection attacks.
        */
        $activity_tech_query = "SELECT
                        act.activity_tech_id
                    FROM
                        activity_tech act
                        LEFT JOIN activity a ON act.activity_id = a.activity_id
                    WHERE
                        act.user_id=? AND act.activity_id=?";

        $query = $this->db->query($activity_tech_query, array($user_id, $id));
        $result = $query->row_array();
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $activity);
        $activity_detail['activity_id'] = $id;
        $activity_detail['activity_tech_id'] = $result['activity_tech_id'];
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
                    act.user_id,
                    a.activity_status_id
                FROM
                    activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                    LEFT JOIN activity_tech act ON ad.activity_tech_id = act.activity_tech_id
                WHERE
                    ad.activity_detail_id=".$id;
        
        return $this->db->query($query);
    }
    
    public function tech_update($id, $activity, $activity_detail) {
        // Start transaction
        $this->db->trans_start();

        // Fetch activity details
        $this->db->where('activity_detail_id', $id);
        $activity_details = $this->db->get('activity_detail')->row_array();

        if (!$activity_details) {
            // Rollback transaction if no details found
            $this->db->trans_rollback();
            throw new Exception("Activity details not found.");
        }

        $activity_id = $activity_details['activity_id'];
        $user_id = $activity_detail['activity_tech_id'];

        // Query to get activity_tech_id
        $activity_tech_query = "SELECT act.activity_tech_id
                                FROM activity_tech act
                                LEFT JOIN activity a ON act.activity_id = a.activity_id
                                WHERE act.user_id = ? AND act.activity_id = ?";

        $query = $this->db->query($activity_tech_query, array($user_id, $activity_id));
        $result = $query->row_array();

        if ($result) {
            $activity_detail['activity_tech_id'] = $result['activity_tech_id'];
        } else {
            // Handle the case when no matching activity_tech_id is found
            $this->db->trans_rollback();
            throw new Exception("No matching activity_tech_id found.");
        }

        // Update activity_detail
        $this->db->where('activity_detail_id', $id);
        $this->db->update('activity_detail', $activity_detail);

        // Update activity
        $this->db->where('activity_id', $activity_id);
        $this->db->update('activity', $activity);

        // Complete transaction
        $this->db->trans_complete();

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            throw new Exception("Transaction failed.");
        }
    }

    
    // Not used anymore may clean it up later
    // public function tech_update($id, $activity, $activity_detail) {
    //     $this->db->trans_start();
    //     $activity_detail_id = array('activity_detail_id' => $id);
    //     $activity_details = $this->db->get_where('activity_detail', $activity_detail_id['activity_detail_id'])->row_array();
    //     $activity_id = $activity_details['activity_id'];
    //     $user_id = $activity_detail['activity_tech_id'];
    //     $activity_tech_query = "SELECT
    //                     act.activity_tech_id
    //                 FROM
    //                     activity_tech act
    //                     LEFT JOIN activity a ON act.activity_id = a.activity_id
    //                 WHERE
    //                     act.user_id=? AND act.activity_id=?";

    //     $query = $this->db->query($activity_tech_query, array($user_id, $activity_id));
    //     $result = $query->row_array();
    //     $activity_detail['activity_tech_id'] = $result['activity_tech_id'];
    //     $this->db->where('activity_detail_id', $id);
    //     $this->db->update('activity_detail', $activity_detail);
    //     $this->db->where('activity_id', $activity_id);
    //     $this->db->update('activity', $activity);
    //     $this->db->trans_complete();
    // }
    
    public function delete($id) {
        $this->db->where('activity_detail_id', $id);
        $this->db->delete('activity_detail');
    }
}