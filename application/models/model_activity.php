<?php

class Model_activity extends CI_Model {
    public function index() {
        $query = "SELECT 
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status 
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id";

        return $this->db->query($query);
    } 
    
    public function add($data) {
        // to prevent collision data when multiple data inserted at the same time
        // $this->db->trans_start();
        // $this->db->insert('activity', $activity);
        // $activity_detail['activity_id'] = $this->db->insert_id();
        // $this->db->insert('activity_detail', $activity_detail);
        // $this->db->trans_complete();
        $this->db->insert('activity', $data);
    }
    
    public function update($id, $data) {
        // $this->db->trans_start();
        // $a_id = array('activity_id' => $id);
        // $activity_detail_id = $this->db->get_where('activity_detail', $a_id)->row_array();
        // $ad_id = $activity_detail_id['activity_detail_id'];
        // $this->db->where('activity_id', $id);
        // $this->db->update('activity', $activity);
        // $this->db->where('activity_detail_id', $ad_id);
        // $this->db->update('activity_detail', $activity_detail);
        // $this->db->trans_complete();
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $data);
    }
    
    public function delete($id) {
        $this->db->where('activity_id', $id);
        $this->db->delete('activity');
    }
    
    public function detail($id) {
        $query = "SELECT
                    a.activity_id,
                    a.constrain,
                    a.activity_category_id,
                    a.constrain_category_id,
                    a.constrain_description,
                    a.created_at,
                    a.img AS user_img,
                    a.activity_status_id,
                    u.NAME AS user_name
                FROM
                    activity a
                    LEFT JOIN activity_status ast ON a.activity_status_id = ast.activity_status_id
                    LEFT JOIN USER u ON a.user_id = u.user_id
                WHERE a.activity_id=".$id;

        return $this->db->query($query);
    }
    
    // public function admin_index() {
    //     $query = "SELECT 
    //             a.activity_id,
    //             u.name AS user_name,
    //             st.activity_status_name AS status,
    //             a.img
    //         FROM
    //             activity a
    //             LEFT JOIN activity_status st ON st.activity_status_id = ac.activity_status_i
    //             LEFT JOIN user u ON a.user_id = u.user_id";

    //     return $this->db->query($query);
    // }
    
    // public function admin_edit($id) {
    //     $query = "SELECT
    //                 ad.activity_id,
    //                 ad.activity_detail_id,
    //                 ad.user_id AS tech_name,
    //                 ad.constrain_description,
    //                 ad.action_description,
    //                 ad.level,
    //                 ad.urgency,
    //                 ad.analyze,
    //                 ad.troubleshooting,
    //                 ad.img AS tech_img,
    //                 ad.created_at,
    //                 ad.updated_at,
    //                 a.activity_category_id,
    //                 a.constrain_category_id,
    //                 a.constrain,
    //                 a.user_id AS user_name,
    //                 a.activity_status_id,
    //                 a.img AS user_img,
    //                 u.phone_number,
    //                 u.department,
    //                 cb.address
    //             FROM
    //                 activity_detail ad
    //                 LEFT JOIN activity a ON ad.activity_id = a.activity_id
    //                 LEFT JOIN user u ON a.user_id = u.user_id
    //                 LEFT JOIN company_branch cb ON u.company_branch_id = cb.company_branch_id
    //                 WHERE a.activity_id=".$id;
        
    //     return $this->db->query($query);
    // }
    
    public function tech_index() {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status 
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                WHERE a.activity_status_id = 1";

        return $this->db->query($query);
    } 

    public function tech_history() {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status 
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                WHERE NOT a.activity_status_id = 1
                ORDER BY a.activity_id";

        return $this->db->query($query);
    } 
    
    public function tech_take($id, $activities, $activity_details) {
        $this->db->trans_start();
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $activities);
        $activity_details['activity_id'] = $id;
        $this->db->insert('activity_detail', $activity_details);
        $this->db->trans_complete();
    }
     
    public function tech_detail($id) {
        $query = "SELECT
                    ad.activity_id,
                    ad.user_id AS tech_name,
                    ad.action_description,
                    ad.level,
                    ad.urgency,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.img AS tech_img,
                    ad.reason,
                    ad.updated_at,
                    a.activity_category_id,
                    a.constrain_category_id,
                    a.constrain,
                    a.constrain_description,
                    a.user_id AS user_name,
                    a.activity_status_id,
                    a.img AS user_img,
                    a.created_at,
                    u.phone_number,
                    u.department,
                    cb.address
                FROM
                    activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN company_branch cb ON u.company_branch_id = cb.company_branch_id
                    WHERE a.activity_id=".$id;
        
        return $this->db->query($query);
    }
    
    public function tech_update($id, $activity, $activity_detail) {
       // to prevent collision data when multiple data inserted at the same time
       $this->db->trans_start();
       $a_id = array('activity_id' => $id);
       $activity_detail_id = $this->db->get_where('activity_detail', $a_id)->row_array();
       $ad_id = $activity_detail_id['activity_detail_id'];
       $this->db->where('activity_id', $id);
       $this->db->update('activity', $activity);
       $this->db->where('activity_detail_id', $ad_id);
       $this->db->update('activity_detail', $activity_detail);
       $this->db->trans_complete();
    }
   
    public function admin_index() {
        $query = "SELECT 
                a.activity_id,
                u.name AS user_name,
                st.activity_status_name AS status,
                a.img
            FROM
                activity a
                LEFT JOIN activity_status st ON st.activity_status_id = ac.activity_status_i
                LEFT JOIN user u ON a.user_id = u.user_id";

        return $this->db->query($query);
    }
    
    public function admin_edit($id) {
        $query = "SELECT
                    ad.activity_id,
                    ad.user_id AS tech_name,
                    ad.constrain_description,
                    ad.action_description,
                    ad.level,
                    ad.urgency,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.img AS tech_img,
                    ad.created_at,
                    ad.updated_at,
                    a.activity_category_id,
                    a.constrain_category_id,
                    a.constrain,
                    a.user_id AS user_name,
                    a.activity_status_id,
                    a.img AS user_img,
                    u.phone_number,
                    u.department,
                    cb.address
                FROM
                    activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN company_branch cb ON u.company_branch_id = cb.company_branch_id
                    WHERE a.activity_id=".$id;
        
        return $this->db->query($query);
    }
    
    public function admin_update($id, $activity, $activity_detail, $user, $company_branch) {
       // to prevent collision data when multiple data inserted at the same time
       $this->db->trans_start();
       $a_id = array('activity_id' => $id);
       $activity_detail_id = $this->db->get_where('activity_detail', $a_id)->row_array();
       $ad_id = $activity_detail_id['activity_detail_id'];
       $user_id = $activity['user_id'];
       $u_id = array('user_id' => $user_id);
       $company_branch_id = $this->db->get_where('user', $u_id)->row_array();
       $cb_id = $company_branch_id['company_branch_id'];
       $this->db->where('activity_id', $id);
       $this->db->update('activity', $activity);
       $this->db->where('activity_detail_id', $ad_id);
       $this->db->update('activity_detail', $activity_detail);
       $this->db->where('user_id', $user_id);
       $this->db->update('user', $user);
       $this->db->where('company_branch_id', $cb_id);
       $this->db->update('company_branch', $company_branch);
       $this->db->trans_complete();
    }
}
