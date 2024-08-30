<?php

class Model_dashboard extends CI_Model {
    public function user_activity($id) {
        $query = "SELECT
                    a.activity_id,
                    a.constrain,
                    st.activity_status_name as status 
                FROM
                    activity a
                    LEFT JOIN activity_status st on st.activity_status_id = a.activity_status_id
                WHERE
                    a.user_id=".$id." LIMIT 5";
                  
        return $this->db->query($query);
    }
    
    public function get_activity() {
        $query = "SELECT DISTINCT
                    a.activity_id,
                    a.constrain,
                    st.activity_status_name AS status
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                LIMIT 5";

        return $this->db->query($query);
    }
    
    public function tech_activity_entry() {
        $query = "SELECT DISTINCT
                    a.activity_id,
                    a.constrain,
                    st.activity_status_name AS status
                FROM
                    activity a
                    LEFT JOIN activity_status st ON a.activity_status_id = st.activity_status_id
                    LEFT JOIN activity_detail ad ON a.activity_id = ad.activity_id
                WHERE
                    a.activity_status_id = 1
                LIMIT 5";
        
        return $this->db->query($query);
    }
    
    public function tech_activity_done($id) {
        $query = "SELECT DISTINCT
                    a.activity_id,
                    a.constrain,
                    st.activity_status_name AS status
                FROM
                    activity a
                    LEFT JOIN activity_status st ON a.activity_status_id = st.activity_status_id
                    LEFT JOIN activity_detail ad ON a.activity_id = ad.activity_id
                WHERE
                    a.activity_status_id = 4
                    AND ad.user_id=".$id." LIMIT 5";
        
        return $this->db->query($query);
    }
}