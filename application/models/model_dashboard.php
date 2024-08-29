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
}