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
        $this->slice->view('admin.activity.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg'
            ));
            // wrong time location
            $created_at = mdate('%Y-%m-%d %H:%i:%s', now());


            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                // var_dump($error);
                // exit;
                
                redirect('admin/activity/index');
            } else {
                $img = $this->upload->data();
                $activity = array(
                    'activity_status_id' => 1,
                    'img' => $img['file_name']
                );

                $activity_detail = array(
                    'activity_category_id' => $this->input->post('activity_category'),
                    'constrain_category_id' => $this->input->post('constrain_category'),
                    'constrain' => $this->input->post('constrain'),
                    'constrain_description' => $this->input->post('constrain_description'),
                    'action_description' => $this->input->post('action_description'),
                    'created_at' => $created_at
                );
                // var_dump($activity, $activity_detail);
                // exit;

                $this->model_activity->add($activity, $activity_detail);
                redirect('admin/activity/index');
            }
        } else {
            $data['activities'] = $this->model_activity_category->index()->result();
            $data['constrains'] = $this->model_constrain_category->index()->result();
            $this->slice->view('admin.activity.add', $data);
        }
    }
    
    public function detail() {
        $id = $this->uri->segment(4);
        $data['activities'] = $this->model_activity_detail->detail($id)->row_array();
        // $data['activities'] = $this->model_activity_category->index()->result();
        // $data['constrains'] = $this->model_constrain_category->index()->result();
        // $data['activity'] = $this->model_activity->detail($id)->row_array();
        // print_r($data);
        // exit;

        $this->slice->view('admin.activity.detail', $data);
    }
    
    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity->delete($id);
        
        redirect('admin/activity/index');
    }
}