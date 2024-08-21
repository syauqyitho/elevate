<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_detail extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity_detail');
        $this->load->model('model_user');
    }
    
    public function detail() {
        $id = $this->uri->segment(4);
        $data['activity_details'] = $this->model_activity_detail->detail($id)->row_array();
        $data['users'] = $this->model_user->index()->result();
        
        $this->slice->view('activity.detail', $data);
    }
}