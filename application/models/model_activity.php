<?php

class Model_activity extends CI_Model {
    public function index() {
        // return $this->db->get('activity');
        $query = '
            select 
                ac.activity_id,
                ad.created_at,
                ad.constrain,
                st.activity_status_name as status 
            from activity ac
            left join activity_detail ad on ad.activity_id = ac.activity_id
            left join activity_status st on st.activity_status_id = ac.activity_status_id';
        return $this->db->query($query);
    }   
}
