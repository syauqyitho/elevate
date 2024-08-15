<?php

class Model_activity extends CI_Model {
    public function index() {
        // return $this->db->get('activity');
        $query = "SELECT 
                a.activity_id,
                ad.created_at,
                a.constrain,
                st.activity_status_name AS status 
            FROM activity a
            LEFT JOIN activity_detail ad ON ad.activity_id = a.activity_id
            LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id";

        return $this->db->query($query);
    } 
    
    public function add($activity, $activity_detail) {
       $this->db->trans_start();  // to prevent collision data when multiple data inserted at the same time
       $this->db->insert('activity', $activity);
       $activity_detail['activity_id'] = $this->db->insert_id();
       $this->db->insert('activity_detail', $activity_detail);
       $this->db->trans_complete();
    }
    
    public function detail($id) {
        $params = array('activity_id' => $id);
        
        return $this->db->get_where('activity', $params);
    }

    public function tech_index() {
        $query = "SELECT 
                    ac.activity_id,
                    ad.created_at,
                    ad.constrain,
                    st.activity_status_name as status 
                  FROM activity ac
                  LEFT JOIN activity_detail ad on ad.activity_id = ac.activity_id
                  LEFT JOIN activity_status st on st.activity_status_id = ac.activity_status_id
                  WHERE ac.activity_status_id = 1";

        return $this->db->query($query);
    } 
    
    public function delete($id) {
        $this->db->where('activity_id', $id);
        $this->db->delete('activity');
    }
}
