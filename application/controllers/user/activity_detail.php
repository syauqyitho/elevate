<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_detail extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_user');
        $this->load->model('model_level');
        $this->load->model('model_activity_detail');
        check_session();
        role_user();
    }
    
    public function detail() {
        $id = $this->uri->segment(4);
        $data['activity_details'] = $this->model_activity_detail->detail($id)->row_array();
        $data['levels'] = $this->model_level->index()->result();
        $data['users'] = $this->model_user->index()->result();
        
        $this->slice->view('activity.detail', $data);
    }
}