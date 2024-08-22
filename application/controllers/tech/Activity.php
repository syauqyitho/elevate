<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        $this->load->model('model_user'); 
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->tech_index()->result();
        $this->slice->view('tech.activity.index', $data);
    }

    public function history() {
        $data['activities'] = $this->model_activity->tech_history()->result();
        $this->slice->view('tech.activity.history', $data);
    }
    
    public function take() {
       $id = $this->uri->segment(4);
       $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
       $created_at = $dt->format("Y-m-d_H:i:s");
       $activities = array(
           'activity_status_id' => 2
       );
       
       $activity_details = array(
           'user_id' => 2,
           'created_at' => $created_at
       );
       
       $this->model_activity->tech_take($id, $activities, $activity_details);
       redirect('tech/activity/history');
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
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
            
            $id = $this->uri->segment(4);
            // var_dump($id, $activity, $activity_detail);
            // exit;
            $this->model_activity->tech_update($id, $activity, $activity_detail);
            redirect('tech/activity/index');
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity->detail($id)->row_array();
            $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
            $data['activity_categories'] = $this->model_activity_category->index()->result();
            $data['constrain_categories'] = $this->model_constrain_category->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            $data['users'] = $this->model_user->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('tech.activity.detail', $data);
        }
    }
}