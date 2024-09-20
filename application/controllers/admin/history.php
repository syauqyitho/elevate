<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_activity');
        $this->load->library('slice');
        $this->load->helper('check_session_helper');
    }

    public function index() {
        $data['activities'] = $this->model_activity->admin_history();
        $this->slice->view('admin.activity.history', $data);
    }
}