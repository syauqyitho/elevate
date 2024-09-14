<?php

class Model_activity extends CI_Model {
    public function index($id) {
        $query = "SELECT 
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status 
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                WHERE a.user_id=".$id;

        return $this->db->query($query);
    } 
    
    public function add($data) {
        $this->db->insert('activity', $data);
    }
    
    public function detail($id) {
        $query = "SELECT
                    a.activity_id,
                    a.user_id,
                    a.activity_status_id,
                    a.constrain_category_id,
                    a.activity_category_id,
                    a.urgency_id,
                    a.constrain,
                    a.constrain_description,
                    a.img,
                    a.created_at,
                    u.department,
                    cb.branch_name,
                    cb.address
                FROM
                    activity a
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN company_branch cb ON u.company_branch_id = cb.company_branch_id
                WHERE a.activity_id=".$id;

        return $this->db->query($query);
    }
    
    public function update($id, $data) {
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $data);
    }
    
    public function delete($id) {
        $this->db->where('activity_id', $id);
        $this->db->delete('activity');
    }

    public function history($id) {
        $this->db->select('
            a.activity_id,
            a.constrain,
            a.created_at,
            ast.activity_status_name AS status,
            u.name
        ');
        $this->db->from('activity a');
        $this->db->join('activity_status ast', 'a.activity_status_id = ast.activity_status_id', 'left');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->where('a.activity_status_id', 4);
        $this->db->where('u.user_id', $id);
        $this->db->order_by('a.activity_id');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    // public function user_datatable($id = null, $start_date = null, $end_date = null) {
        
    // }
 
    public function user_report($id, $start_date = null, $end_date = null) {
        // if user provide date range
        if ($start_date) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }
        
        if ($end_date) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }

        $this->db->select('
            a.activity_id,
            u.name AS user_name,
            st.activity_status_name AS status,
            ac.activity_category_name AS activity_category,
            cc.constrain_category_name AS constrain_category,
            ug.urgency_name AS urgency,
            a.constrain,
            a.constrain_description,
            a.created_at,
            atc.activity_tech_id,
            ut.name AS tech_name,
            ad.activity_detail_id,
            lvl.level_name AS level,
            ad.action_description,
            ad.analyze,
            ad.troubleshooting,
            ad.reason
        ');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
        $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
        $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
        $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
        $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
        $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
        $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
        $this->db->join('activity_detail adt', 'atc.activity_tech_id = adt.activity_tech_id', 'left');
        $this->db->join('level lvl', 'ad.level_id = lvl.level_id', 'left');
        $this->db->where('a.user_id', $id);
        
        // if user provide date range
        if ($start_date) {
            $this->db->where('a.created_at >=', $start_date);
        }

        if ($end_date) {
            $this->db->where('a.created_at <=', $end_date);
        }

        $this->db->order_by('a.activity_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function user_activity_history_period($id, $start_date, $end_date) {
    //     $start_date = date('Y-m-d', strtotime($start_date));
    //     $end_date = date('Y-m-d', strtotime($end_date));
        
    //     $this->db->select('
    //         a.activity_id,
    //         u.name AS user_name,
    //         st.activity_status_name AS status,
    //         ac.activity_category_name AS activity_category,
    //         cc.constrain_category_name AS constrain_category,
    //         ug.urgency_name AS urgency,
    //         a.constrain,
    //         a.constrain_description,
    //         a.created_at,
    //         atc.activity_tech_id,
    //         ut.name AS tech_name,
    //         ad.activity_detail_id,
    //         lvl.level_name,
    //         ad.action_description,
    //         ad.analyze,
    //         ad.troubleshooting,
    //         ad.reason
    //     ');
    //     $this->db->from('activity a');
    //     $this->db->join('user u', 'a.user_id = u.user_id', 'left');
    //     $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
    //     $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
    //     $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
    //     $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
    //     $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
    //     $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
    //     $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
    //     $this->db->join('activity_detail adt', 'atc.activity_tech_id = adt.activity_tech_id', 'left');
    //     $this->db->where('a.user_id', $id);
    //     $this->db->where('a.created_at >=', $start_date);
    //     $this->db->where('a.created_at <=', $end_date);
    //     $this->db->order_by('a.activity_id');
        
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function tech_index() {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN activity_tech atc ON a.activity_id = atc.activity_id
                WHERE
                    a.activity_status_id=1";

        return $this->db->query($query);
    } 
    
    public function tech_ticket_inqueue() {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                    LEFT JOIN activity_tech atc ON a.activity_id = atc.activity_id
                WHERE
                    a.activity_status_id=1";

        return $this->db->query($query);
    } 

    public function technician_ticket_list($id) {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                    LEFT JOIN activity_tech atc ON a.activity_id = atc.activity_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                WHERE NOT
                    a.activity_status_id = 1 AND atc.user_id=".$id." ORDER BY a.activity_id";

        return $this->db->query($query);
    } 
 
    public function tech_history($id) {
        $query = "SELECT
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
                    LEFT JOIN activity_tech atc ON a.activity_id = atc.activity_id
                    LEFT JOIN user u ON a.user_id = u.user_id
                WHERE
                    a.activity_status_id = 4 AND atc.user_id=".$id." ORDER BY a.activity_id";

        return $this->db->query($query);
    }

    public function tech_take($id, $activities, $activity_details) {
        $this->db->trans_start();

        // update activity
        $this->db->where('activity_id', $id);
        $this->db->update('activity', $activities);

        // insert activity_tech
        $user_id = $activity_details['activity_tech_id'];
        $activity_tech = array('user_id' => $user_id, 'activity_id' => $id);
        $this->db->insert('activity_tech', $activity_tech);
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
 
    public function tech_activity_report($id) {
        $this->db->select('
            a.activity_id,
            u.name AS user_name,
            st.activity_status_name AS status,
            ac.activity_category_name AS activity_category,
            cc.constrain_category_name AS constrain_category,
            ug.urgency_name AS urgency,
            a.constrain,
            a.constrain_description,
            a.created_at,
            atc.activity_tech_id,
            ut.name AS tech_name,
            ad.activity_detail_id,
            lvl.level_name AS level,
            ad.action_description,
            ad.analyze,
            ad.troubleshooting,
            ad.reason
        ');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
        $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
        $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
        $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
        $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
        $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
        $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
        $this->db->join('activity_detail adt', 'atc.activity_tech_id = adt.activity_tech_id', 'left');
        $this->db->join('level lvl', 'ad.level_id = lvl.level_id', 'left');
        $this->db->where('atc.user_id', $id);
        $this->db->order_by('a.activity_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
 
    public function tech_activity_report_period($id, $start_date, $end_date) {
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));

        $this->db->select('
            a.activity_id,
            u.name AS user_name,
            st.activity_status_name AS status,
            ac.activity_category_name AS activity_category,
            cc.constrain_category_name AS constrain_category,
            ug.urgency_name AS urgency,
            a.constrain,
            a.constrain_description,
            a.created_at,
            atc.activity_tech_id,
            ut.name AS tech_name,
            ad.activity_detail_id,
            lvl.level_name AS level,
            ad.action_description,
            ad.analyze,
            ad.troubleshooting,
            ad.reason
        ');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
        $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
        $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
        $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
        $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
        $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
        $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
        $this->db->join('activity_detail adt', 'atc.activity_tech_id = adt.activity_tech_id', 'left');
        $this->db->join('level lvl', 'ad.level_id = lvl.level_id', 'left');
        $this->db->where('atc.user_id', $id);
        $this->db->where('a.created_at >=', $start_date);
        $this->db->where('a.created_at <=', $end_date);
        $this->db->order_by('a.activity_id');
        
        $query = $this->db->get();
        return $query->result_array();
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

    public function admin_index() {
        $query = "SELECT 
                    a.activity_id,
                    a.created_at,
                    a.constrain,
                    st.activity_status_name AS status,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_status st ON st.activity_status_id = a.activity_status_id
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

    public function admin_user_role_report($id = null, $start_date = null, $end_date = null) {
        // Set default date range if not provided
        $start_date = $start_date ? date('Y-m-d H:i:s', strtotime($start_date)) : date('Y-m-d 00:00:00');
        $end_date = $end_date ? date('Y-m-d H:i:s', strtotime($end_date)) : date('Y-m-d 23:59:59');

        // Build the query
        $this->db->select('
            a.activity_id,
            u.name AS user_name,
            st.activity_status_name AS status,
            ac.activity_category_name AS activity_category,
            cc.constrain_category_name AS constrain_category,
            ug.urgency_name AS urgency,
            a.constrain,
            a.constrain_description,
            a.created_at,
            atc.activity_tech_id,
            ut.name AS tech_name,
            ad.activity_detail_id,
            lvl.level_name AS level,
            ad.action_description,
            ad.analyze,
            ad.troubleshooting,
            ad.reason
        ');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
        $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
        $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
        $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
        $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
        $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
        $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
        $this->db->join('level lvl', 'ad.level_id = lvl.level_id', 'left');

        // Apply filters
        if ($id === null) {
            // If no user ID is provided, filter by role ID (assuming role_id = 1 for this example)
            $this->db->where('u.role_id', 1); // Assuming role_id = 1
        } else {
            $this->db->where('a.user_id', (int)$id); // Ensuring $id is an integer
        }
        $this->db->where('a.created_at >=', $start_date);
        $this->db->where('a.created_at <=', $end_date);

        // Order by activity_id
        $this->db->order_by('a.activity_id');

        // Execute query
        $query = $this->db->get();
        
        // Check for errors
        if (!$query) {
            log_message('error', 'Database query failed: ' . $this->db->error()['message']);
            return [];
        }

        return $query->result_array(); // Changed to result_array for better readability
    }

    public function admin_tech_role_report($id = null, $start_date = null, $end_date = null) {
        // Set default date range if not provided
        $start_date = $start_date ? date('Y-m-d H:i:s', strtotime($start_date)) : date('Y-m-d 00:00:00');
        $end_date = $end_date ? date('Y-m-d H:i:s', strtotime($end_date)) : date('Y-m-d 23:59:59');

        // Build the query
        $this->db->select('
            a.activity_id,
            u.name AS user_name,
            st.activity_status_name AS status,
            ac.activity_category_name AS activity_category,
            cc.constrain_category_name AS constrain_category,
            ug.urgency_name AS urgency,
            a.constrain,
            a.constrain_description,
            a.created_at,
            atc.activity_tech_id,
            ut.name AS tech_name,
            ad.activity_detail_id,
            lvl.level_name AS level,
            ad.action_description,
            ad.analyze,
            ad.troubleshooting,
            ad.reason
        ');
        $this->db->from('activity a');
        $this->db->join('user u', 'a.user_id = u.user_id', 'left');
        $this->db->join('activity_status st', 'a.activity_status_id = st.activity_status_id', 'left');
        $this->db->join('activity_category ac', 'a.activity_category_id = ac.activity_category_id', 'left');
        $this->db->join('constrain_category cc', 'a.constrain_category_id = cc.constrain_category_id', 'left');
        $this->db->join('urgency ug', 'a.urgency_id = ug.urgency_id', 'left');
        $this->db->join('activity_tech atc', 'a.activity_id = atc.activity_id', 'left');
        $this->db->join('user ut', 'atc.user_id = ut.user_id', 'left');
        $this->db->join('activity_detail ad', 'a.activity_id = ad.activity_id', 'left');
        $this->db->join('level lvl', 'ad.level_id = lvl.level_id', 'left');

        // Apply filters
        if ($id === null) {
            // If no user ID is provided, filter by role ID (assuming role_id = 1 for this example)
            $this->db->where('u.role_id', 2); // Assuming role_id = 1
        } else {
            $this->db->where('atc.user_id', (int)$id); // Ensuring $id is an integer
        }
        $this->db->where('a.created_at >=', $start_date);
        $this->db->where('a.created_at <=', $end_date);

        // Order by activity_id
        $this->db->order_by('a.activity_id');

        // Execute query
        $query = $this->db->get();
        
        // Check for errors
        if (!$query) {
            log_message('error', 'Database query failed: ' . $this->db->error()['message']);
            return [];
        }

        return $query->result_array(); // Changed to result_array for better readability
    }
}
