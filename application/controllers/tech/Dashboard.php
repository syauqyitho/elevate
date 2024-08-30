<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_dashboard');
        check_session();
        role_tech();
    }
    
    public function index() {
        $data['activities'] = $this->model_dashboard->get_activity()->result();
        $this->slice->view('tech.dashboard.tech', $data); 
    }
    
    public function dash() {
        $user_id = $this->session->user_id;
        $data['on_queue'] = $this->model_dashboard->tech_activity_entry()->result();
        $data['done'] = $this->model_dashboard->tech_activity_done($user_id)->result();
        $this->slice->view('tech.dashboard.index', $data);
    }
}