<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_activity');
        $this->load->library('slice');
        $this->load->helper('check_session_helper');
        check_session();
        role_tech();
    }

    public function index() {
        $id = $this->session->user_id;
        $data['activities'] = $this->model_activity->tech_history($id)->result();
        $this->slice->view('tech.activity.history', $data);
    }
}