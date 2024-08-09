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
        $data['activities'] = $this->model_activity->tech_index()->result();
        $this->slice->view('tech.activity.index', $data);
    }
}