<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->index()->result();
        $this->slice->view('activity.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            // $this->load->library('upload', $config);
            // $config['upload_path']          = './uploads/';
            // $config['allowed_types']        = 'gif|jpg|png|jpeg';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            // config for upload library 
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg'
            ));
            $created_at = mdate('%Y-%m-%d %H:%i:%s', now());


            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                // var_dump($error);
                // exit;
                
                redirect('activity/index');
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
                redirect('activity/index');
            }
        } else {
            $data['activities'] = $this->model_activity_category->index()->result();
            $data['constrains'] = $this->model_constrain_category->index()->result();
            $this->slice->view('activity.add', $data);
        }
    }
}