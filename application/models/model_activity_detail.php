<?php

class Model_activity_detail extends CI_Model {
    // public function detail($id) {
    //     $params = array('activity_id' => $id);
        
    //     return $this->db->get_where('activity_detail', $params);
    // }
    public function detail($id) {
        $query = "SELECT
                    ad.activity_detail_id,
                    ad.activity_id,
                    ad.constrain_description,
                    ad.action_description,
                    ad.img AS tech_img,
                    ad.level,
                    ad.urgency,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.created_at,
                    ad.updated_at,
                    a.constrain,
                    a.activity_category_id,
                    a.constrain_category_id,
                    a.img AS user_img,
                    ast.activity_status_name,
                    u.name AS user_name,
                    us.name AS tech_name
                FROM
                    activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                    LEFT JOIN activity_status ast ON a.activity_status_id = ast.activity_status_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN user us ON ad.user_id = us.user_id
                WHERE ad.activity_id=".$id;

        return $this->db->query($query);
    }

    public function tech_detail($id) {
        $query = "SELECT
                    a.activity_id,
                    ad.activity_detail_id,
                    us.`name` AS tech_name,
                    ac.activity_category_name as activity_category,
                    cc.constrain_category_name as constrain_category,
                    u.`name` AS user_name,
                    ast.activity_status_name as status,
                    a.img as user_img,
                    ad.img as tech_img,
                    u.email,
                    ad.constrain,
                    ad.constrain_description,
                    ad.action_description,
                    ad.analyze,
                    ad.troubleshooting,
                    ad.created_at,
                    ad.updated_at
                FROM activity_detail ad
                    LEFT JOIN activity a ON ad.activity_id = a.activity_id
                    LEFT JOIN activity_category ac ON ad.activity_category_id = ac.activity_category_id
                    LEFT JOIN constrain_category cc ON ad.constrain_category_id = cc.constrain_category_id
                    LEFT JOIN activity_status ast ON a.activity_status_id = ast.activity_status_id
                    LEFT JOIN USER u ON a.user_id = u.user_id
                    LEFT JOIN USER us ON ad.user_id = us.user_id
                WHERE a.activity_id = $id";

        return $this->db->query($query);
    }
}