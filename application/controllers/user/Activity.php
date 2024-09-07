<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user'); 
        $this->load->model('model_urgency'); 
        $this->load->model('model_activity');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_tech');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        $this->load->library('slice');
        check_session();
        role_user();
    }
    
    public function index() {
        $id = $this->session->user_id;
        $data['activities'] = $this->model_activity->index($id)->result();
        $this->slice->view('activity.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $user_id = $this->session->user_id;
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format('Y-m-d H:i:s');
            /* becareful with file_name format
             * aloowed symbols
             * Undrescore _
             * Dots .
             * Hyphens -
             */
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $dt->format('Y-m-d_His')
            ));
            
            if ($_FILES['img']['name'] !== '') {
                if (!$this->upload->do_upload('img')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    exit;
                    
                    redirect('user/activity/index');
                } else {
                    $img = $this->upload->data();
                }

                $data = array(
                    'activity_status_id' => 1,
                    'user_id' => $user_id,
                    'activity_category_id' => $this->input->post('activity_category'),
                    'constrain_category_id' => $this->input->post('constrain_category'),
                    'urgency_id' => $this->input->post('urgency'),
                    'constrain' => $this->input->post('constrain'),
                    'constrain_description' => $this->input->post('constrain_description'),
                    'img' => $img['file_name'],
                    'created_at' => $created_at
                );

                // var_dump($data);
                // exit;
                $this->model_activity->add($data);
                redirect('user/activity/index');
            } else {
                $data = array(
                    'activity_status_id' => 1,
                    'user_id' => $user_id,
                    'activity_category_id' => $this->input->post('activity_category'),
                    'constrain_category_id' => $this->input->post('constrain_category'),
                    'urgency_id' => $this->input->post('urgency'),
                    'constrain' => $this->input->post('constrain'),
                    'constrain_description' => $this->input->post('constrain_description'),
                    'created_at' => $created_at
                );

                // var_dump($data);
                // exit;
                $this->model_activity->add($data);
                redirect('user/activity/index');
            }
        } else {
            $data['activities'] = $this->model_activity_category->index()->result();
            $data['constrains'] = $this->model_constrain_category->index()->result();
            $data['urgencies'] = $this->model_urgency->index()->result();
            $this->slice->view('activity.add', $data);
        }
    }

    public function edit() {
        if (isset($_POST['submit'])) {
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format('Y-m-d H:i:s');
            /* becareful with file_name format
             * aloowed symbols
             * Undrescore _
             * Dots .
             * Hyphens -
             */
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $dt->format('Y-m-d_His')
            ));
            
            if ($_FILES['img']['name'] !== '') {
                if (!$this->upload->do_upload('img')) {
                    $errors = $this->upload->display_errors();
                    var_dump($errors);
                    exit;
                    
                    redirect('user/activity/index');
                } else {
                    $img = $this->upload->data();

                    $data = array(
                        'activity_category_id' => $this->input->post('activity_category'),
                        'constrain_category_id' => $this->input->post('constrain_category'),
                        'urgency_id' => $this->input->post('urgency'),
                        'constrain' => $this->input->post('constrain'),
                        'constrain_description' => $this->input->post('constrain_description'),
                        'img' => $img['file_name']
                    );

                    // var_dump($activity);
                    // exit;
                    $id = $this->uri->segment(4);
                    $this->model_activity->update($id, $data);
                    redirect('user/activity/index');
                }
            } else {
                $data = array(
                    'activity_category_id' => $this->input->post('activity_category'),
                    'constrain_category_id' => $this->input->post('constrain_category'),
                    'urgency_id' => $this->input->post('urgency'),
                    'constrain' => $this->input->post('constrain'),

                    'constrain_description' => $this->input->post('constrain_description'),
                );

                // var_dump($data);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_activity->update($id, $data);
                redirect('user/activity/index');
            }
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity->detail($id)->row_array();
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $data['list_tech'] = $this->model_activity_tech->index($id)->result();
            $data['users'] = $this->model_user->index()->result();
            $data['urgencies'] = $this->model_urgency->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            $data['activity_categories'] = $this->model_activity_category->index()->result();
            $data['constrain_categories'] = $this->model_constrain_category->index()->result();
            $this->slice->view('activity.edit', $data);
        }
    }
    
    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity->delete($id);
        
        redirect('user/activity/index');
    }

    // public function history() {
    //     $id = $this->session->user_id;
    //     $data['activities'] = $this->model_activity->user_activity_history($id)->result();
    //     $this->slice->view('activity.history', $data);
    // }
    
    public function history() {
        if (isset($_POST['submit'])) {
            $id = $this->session->user_id;
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $raw_data = $this->model_activity->user_activity_history_period($id, $start_date, $end_date);
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
            $this->slice->view('activity.history', $data);
        } else {
            $id = $this->session->user_id;
            // Fetch the data from the model 
            $raw_data = $this->model_activity->user_activity_history($id);
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

            // var_dump($data);
            // exit();

            $data['activity_grouped'] = $activities;
            $this->slice->view('activity.history', $data);
        }
    }
}
