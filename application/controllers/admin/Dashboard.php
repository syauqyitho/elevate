<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_dashboard');
        check_session();
        role_admin();
    }
    
    public function index() {
        // $data['activities'] = $this->model_dashboard->get_activity()->result();
        // $this->slice->view('tech.dashboard.tech', $data); 
        $this->slice->view('layouts.welcome');
    }
}