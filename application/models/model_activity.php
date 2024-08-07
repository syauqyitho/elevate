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
    
    public function add($activity, $activity_detail) {
       $this->db->trans_start();  // to prevent collision data when multiple data inserted at the same time
       $this->db->insert('activity', $activity);
       $activity_detail['activity_id'] = $this->db->insert_id();
       $this->db->insert('activity_detail', $activity_detail);
       $this->db->trans_complete();
    }
}
