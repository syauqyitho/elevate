<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->helper('generate_pdf');
        $this->load->model('model_user');
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
    }

    public function user() {
        if (isset($_POST['submit'])) {
            $id = $this->input->post('name');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->admin_user_role_report($id, $start_date, $end_date);
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }
            
            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_user_role_list();
            // $data['tech_roles'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.user', $data);
        } else {
            // Fetch the data from the model 
            $raw_data = $this->model_activity->admin_user_role_report();
            // Prepare an array to group details by activity_id
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }

            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_user_role_list();
            // $data['tech_roles'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.user', $data);
        }
    }

    public function tech() {
        if (isset($_POST['submit'])) {
            $id = $this->input->post('name');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->admin_tech_role_report($id, $start_date, $end_date);
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }
            
            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.tech', $data);
        } else {
            // Fetch the data from the model 
            $raw_data = $this->model_activity->admin_tech_role_report();
            // Prepare an array to group details by activity_id
            $activities = [];

            // Group details by jasa_id
            foreach ($raw_data as $row) {
                $activity_id = $row['activity_id'];

                // Initialize activity if not already present
                if (!isset($activities[$activity_id])) {
                    $activities[$activity_id] = [
                        'user_name' => $row['user_name'],
                        'status' => $row['status'],
                        'activity_category' => $row['activity_category'],
                        'constrain_category' => $row['constrain_category'],
                        'urgency' => $row['urgency'],
                        'constrain' => $row['constrain'],
                        'constrain_description' => $row['constrain_description'],
                        'created_at' => $row['created_at'],
                        'details' => [] // Initialize details array
                    ];
                }
                
                // Check if detail already exists before adding
                $detail_exists = false;
                foreach ($activities[$activity_id]['details'] as $existing_detail) {
                    if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                        $detail_exists = true;
                        break;
                    }
                }

                // Add the detail to the activity if it doesn't already exist
                if (!$detail_exists) {
                    $activities[$activity_id]['details'][] = [
                        'activity_detail_id' => $row['activity_detail_id'],
                        'tech_name' => $row['tech_name'],
                        'activity_tech_id' => $row['activity_tech_id'],
                        'action_description' => $row['action_description'],
                        'level' => $row['level'],
                        'analyze' => $row['analyze'],
                        'troubleshooting' => $row['troubleshooting'],
                        'reason' => $row['reason']
                    ];
                }
            }

            $data['activity_grouped'] = $activities;
            $data['users'] = $this->model_user->fetch_technician_role_list();
            // var_dump($data);
            // exit();
            $this->slice->view('admin.report.tech', $data);
        }
    }

    public function excel() {
        header("Content-Type=application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=filename.xls");
        $data['reports'] = $this->model_transaction->report()->result();
        $this->load->view('transaction/excel', $data);
    }

    public function user_pdf() {
        // $id = $this->input->post('name');
        // Fetch the data from the model 
        $raw_data = $this->model_activity->admin_user_role_report();
        // Prepare an array to group details by activity_id
        $activities = [];

        // Group details by jasa_id
        foreach ($raw_data as $row) {
            $activity_id = $row['activity_id'];

            // Initialize activity if not already present
            if (!isset($activities[$activity_id])) {
                $activities[$activity_id] = [
                    'user_name' => $row['user_name'],
                    'status' => $row['status'],
                    'activity_category' => $row['activity_category'],
                    'constrain_category' => $row['constrain_category'],
                    'urgency' => $row['urgency'],
                    'constrain' => $row['constrain'],
                    'constrain_description' => $row['constrain_description'],
                    'created_at' => $row['created_at'],
                    'details' => [] // Initialize details array
                ];
            }
            
            // Check if detail already exists before adding
            $detail_exists = false;
            foreach ($activities[$activity_id]['details'] as $existing_detail) {
                if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                    $detail_exists = true;
                    break;
                }
            }

            // Add the detail to the activity if it doesn't already exist
            if (!$detail_exists) {
                $activities[$activity_id]['details'][] = [
                    'activity_detail_id' => $row['activity_detail_id'],
                    'tech_name' => $row['tech_name'],
                    'activity_tech_id' => $row['activity_tech_id'],
                    'action_description' => $row['action_description'],
                    'level' => $row['level'],
                    'analyze' => $row['analyze'],
                    'troubleshooting' => $row['troubleshooting'],
                    'reason' => $row['reason']
                ];
            }
        }

        $data['activity_grouped'] = $activities;

        // var_dump($data);
        // exit();
        $html = $this->load->view('report/pdf', $data, true);
        generate_pdf($html, 'laporan_jasa_user', 'A4', 'landscape');
    }

    public function tech_pdf() {
        // $id = $this->input->post('name');
        // Fetch the data from the model 
        $raw_data = $this->model_activity->admin_tech_role_report();
        // Prepare an array to group details by activity_id
        $activities = [];

        // Group details by jasa_id
        foreach ($raw_data as $row) {
            $activity_id = $row['activity_id'];

            // Initialize activity if not already present
            if (!isset($activities[$activity_id])) {
                $activities[$activity_id] = [
                    'user_name' => $row['user_name'],
                    'status' => $row['status'],
                    'activity_category' => $row['activity_category'],
                    'constrain_category' => $row['constrain_category'],
                    'urgency' => $row['urgency'],
                    'constrain' => $row['constrain'],
                    'constrain_description' => $row['constrain_description'],
                    'created_at' => $row['created_at'],
                    'details' => [] // Initialize details array
                ];
            }
            
            // Check if detail already exists before adding
            $detail_exists = false;
            foreach ($activities[$activity_id]['details'] as $existing_detail) {
                if ($existing_detail['activity_detail_id'] == $row['activity_detail_id']) {
                    $detail_exists = true;
                    break;
                }
            }

            // Add the detail to the activity if it doesn't already exist
            if (!$detail_exists) {
                $activities[$activity_id]['details'][] = [
                    'activity_detail_id' => $row['activity_detail_id'],
                    'tech_name' => $row['tech_name'],
                    'activity_tech_id' => $row['activity_tech_id'],
                    'action_description' => $row['action_description'],
                    'level' => $row['level'],
                    'analyze' => $row['analyze'],
                    'troubleshooting' => $row['troubleshooting'],
                    'reason' => $row['reason']
                ];
            }
        }

        $data['activity_grouped'] = $activities;

        // var_dump($data);
        // exit();
        $html = $this->load->view('report/pdf', $data, true);
        generate_pdf($html, 'laporan_jasa_technician', 'A4', 'landscape');
    }
}
