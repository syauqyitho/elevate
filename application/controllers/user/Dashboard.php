<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_dashboard');
        check_session();
        role_user();
    }
    
    public function index() {
        $user_id = $this->session->user_id;
        $data['activities'] = $this->model_dashboard->user_activity($user_id)->result();
        $this->slice->view('dashboard.user', $data); 
    }
}