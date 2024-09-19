<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user'); 
        $this->load->model('model_activity');
        $this->load->model('model_urgency');
        $this->load->model('model_activity_tech'); 
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        $this->load->library('slice');
        $this->load->helper('check_session_helper');
        check_session();
        role_tech();
    }
    
    public function index() {
        $id = $this->session->user_id;
        $data['activities'] = $this->model_activity->tech_ticket_inqueue()->result();
        $data['histories'] = $this->model_activity->technician_ticket_list($id)->result();
        $this->slice->view('tech.activity.index', $data);
    }
    
    public function take($id) {
       $user_id = $this->session->user_id;
       $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
       $created_at = $dt->format("Y-m-d_H:i:s");
       $activities = array(
           'activity_status_id' => 2
       );
       
       $activity_details = array(
           'activity_tech_id' => $user_id,
       );
       
       $this->model_activity->tech_take($id, $activities, $activity_details);
       redirect('activity/tech');
    }
    
    public function show($id) {
        $data['activities'] = $this->model_activity->detail($id)->row_array();
        $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
        $data['list_tech'] = $this->model_activity_tech->index($id)->result();
        $data['users'] = $this->model_user->index()->result();
        $data['urgencies'] = $this->model_urgency->index()->result();
        $data['activity_status'] = $this->model_activity_status->index()->result();
        $data['activity_categories'] = $this->model_activity_category->index()->result();
        $data['constrain_categories'] = $this->model_constrain_category->index()->result();
        // var_dump($data);
        // exit;

        return $this->slice->view('tech.activity.show', $data);
    }
    
    public function update($id) {
        $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
        $created_at = $dt->format("Y-m-d_H:i:s");
        // configuration for file upload
        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|jpeg',
            'file_name' => $dt->format('Ymd_His')
        ));
        
        // handle tech_img
        if (!$this->upload->do_upload('tech_img')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
            exit;
        } else {
            $tech_img = $this->upload->data();
        }

        $activity = array(
            'activity_status_id' => $this->input->post('activity_status'),
        );

        $activity_detail = array(
            'action_description' => $this->input->post('action_description'),
            'level' => $this->input->post('level'),
            'urgency' => $this->input->post('urgency'),
            'analyze' => $this->input->post('analyze'),
            'troubleshooting' => $this->input->post('troubleshooting'),
            'reason' => $this->input->post('reason'),
            'img' => $tech_img['file_name']
        ); 
        
        // var_dump($id, $activity, $activity_detail);
        // exit;
        $this->model_activity->tech_update($id, $activity, $activity_detail);
        redirect('activity/tech');
    }

    public function report() {
        if (isset($_POST['submit'])) {
            $id = $this->session->user_id;
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->tech_activity_report_period($id, $start_date, $end_date);
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
            
            // var_dump($data);
            // exit();
            $data['activity_grouped'] = $activities;
            $this->slice->view('tech.activity.report', $data);
        } else {
            $id = $this->session->user_id;
            // Fetch the data from the model 
            $raw_data = $this->model_activity->tech_activity_report($id);
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


            // // Iterate through the services and their details
            // foreach ($services as $jasaId => $service) {
            //     echo "<h2>Service Name: " . htmlspecialchars($service['service_name']) . "</h2>";
            //     echo "<p>Service Description: " . htmlspecialchars($service['service_description']) . "</p>";
            //     echo "<h3>Details:</h3>";
            //     echo "<ul>";
            //     foreach ($service['details'] as $detail) {
            //         echo "<li>" . htmlspecialchars($detail) . "</li>";
            //     }
            //     echo "</ul>";
            // }


            $data['activity_grouped'] = $activities;
            // var_dump($id);
            // exit();
            $this->slice->view('tech.activity.report', $data);
        }
    }
}