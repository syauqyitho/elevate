<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
    }

    public function index() {
        $id = $this->session->user_id;
        $data['activities'] = $this->model_activity->history($id);
        $this->slice->view('activity.history', $data);
    }
}