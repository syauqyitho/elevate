<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_detail extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_user'); 
        $this->load->model('model_level'); 
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        check_session();
        role_tech();
    }

    public function add() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            $user_id = $this->session->user_id;
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format("Y-m-d_H:i:s");
            // configuration for file upload
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
                } else {
                    $tech_img = $this->upload->data();
                }

                $activity = array(
                    'activity_status_id' => $this->input->post('activity_status'),
                );

                $activity_detail = array(
                    'activity_tech_id' => $user_id,
                    'action_description' => $this->input->post('action_description'),
                    'level_id' => $this->input->post('level'),
                    'analyze' => $this->input->post('analyze'),
                    'troubleshooting' => $this->input->post('troubleshooting'),
                    'reason' => $this->input->post('reason'),
                    'img' => $tech_img['file_name'],
                    'created_at' => $created_at
                ); 
                
                // var_dump($id, $activity, $activity_detail);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_activity_detail->tech_add($id, $activity, $activity_detail);
                redirect('tech/activity/edit/'.$id);
            } else {
                $activity = array(
                    'activity_status_id' => $this->input->post('activity_status'),
                );

                $activity_detail = array(
                    'activity_tech_id' => $user_id,
                    'action_description' => $this->input->post('action_description'),
                    'level_id' => $this->input->post('level'),
                    'analyze' => $this->input->post('analyze'),
                    'troubleshooting' => $this->input->post('troubleshooting'),
                    'reason' => $this->input->post('reason'),
                    'created_at' => $created_at
                ); 
                
                // var_dump($id, $activity, $activity_detail);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_activity_detail->tech_add($id, $activity, $activity_detail);
                redirect('tech/activity/edit/'.$id);
            }
        } else {
            $id = $this->uri->segment(4);
            $data['activity_details'] = $this->model_activity_detail->activity_detail($id)->row_array();
            $data['levels'] = $this->model_level->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('tech.activity.add', $data);
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            $user_id = $this->session->user_id;
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            // configuration for file upload
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
                } else {
                    $tech_img = $this->upload->data();
                }

                $activity = array(
                    'activity_status_id' => $this->input->post('activity_status'),
                );

                $activity_detail = array(
                    'activity_tech_id' => $user_id,
                    'action_description' => $this->input->post('action_description'),
                    'level_id' => $this->input->post('level'),
                    'analyze' => $this->input->post('analyze'),
                    'troubleshooting' => $this->input->post('troubleshooting'),
                    'reason' => $this->input->post('reason'),
                    'img' => $tech_img['file_name'],
                ); 
                
                // var_dump($id, $activity, $activity_detail);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_activity_detail->tech_update($id, $activity, $activity_detail);
                redirect('tech/activity/');
            } else {
                $activity = array(
                    'activity_status_id' => $this->input->post('activity_status'),
                );

                $activity_detail = array(
                    'activity_tech_id' => $user_id,
                    'action_description' => $this->input->post('action_description'),
                    'level_id' => $this->input->post('level'),
                    'analyze' => $this->input->post('analyze'),
                    'troubleshooting' => $this->input->post('troubleshooting'),
                    'reason' => $this->input->post('reason'),
                ); 
                
                // var_dump($id, $activity, $activity_detail);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_activity_detail->tech_update($id, $activity, $activity_detail);
                redirect('tech/activity/');
            }
        } else {
            $id = $this->uri->segment(4);
            $data['activity_details'] = $this->model_activity_detail->activity_edit($id)->row_array();
            $data['users'] = $this->model_user->index()->result();
            $data['levels'] = $this->model_level->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('tech.activity.edit', $data);
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity_detail->delete($id);
        
        redirect('tech/activity/');
    }
}