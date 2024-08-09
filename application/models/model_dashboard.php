<?php

class Model_dashboard extends CI_Model {
    public function get_activity() {
        $query = "SELECT
                    ac.activity_id,
                    ad.created_at,
                    ad.constrain,
                    st.activity_status_name as status 
                  FROM activity ac
                  LEFT JOIN activity_detail ad on ad.activity_id = ac.activity_id
                  LEFT JOIN activity_status st on st.activity_status_id = ac.activity_status_id
                  LIMIT 5";
                  
        return $this->db->query($query);
    }
}