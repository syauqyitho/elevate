<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->index()->result();
        $this->slice->view('activity.index', $data);
    }
    
    public function add() {
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

            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('user/activity/index');
            } else {
                $img = $this->upload->data();
            }

            $activity = array(
                'activity_status_id' => 1,
                'user_id' => 1,
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'),
                'img' => $img['file_name']
            );

            $activity_detail = array(
                'constrain_description' => $this->input->post('constrain_description'),
                'action_description' => $this->input->post('action_description'),
                'created_at' => $created_at
            );
            // var_dump($activity, $activity_detail);
            // exit;

            $this->model_activity->add($activity, $activity_detail);
            redirect('user/activity/index');
        } else {
            $data['activities'] = $this->model_activity_category->index()->result();
            $data['constrains'] = $this->model_constrain_category->index()->result();
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

            if (!$this->upload->do_upload('user_img')) {
                $errors = $this->upload->display_errors();
                var_dump($errors);
                exit;
                
                redirect('user/activity/index');
            } else {
                $img = $this->upload->data();
            }

            $activity = array(
                // 'activity_status_id' => 1,
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'),
                'img' => $img['file_name']
            );

            $activity_detail = array(
                'constrain_description' => $this->input->post('constrain_description'),
                'action_description' => $this->input->post('action_description'),
                // 'created_at' => $created_at
            );
            // var_dump($activity, $activity_detail);
            // exit;

            $id = $this->uri->segment(4);
            $this->model_activity->update($id, $activity, $activity_detail);
            redirect('user/activity/index');
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity_detail->detail($id)->row_array();
            $data['activity_categories'] = $this->model_activity_category->index()->result();
            $data['constrain_categories'] = $this->model_constrain_category->index()->result();
            $this->slice->view('activity.detail', $data);
        }
    }
    
    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity->delete($id);
        
        redirect('user/activity/index');
    }
}