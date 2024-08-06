<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->index()->result();
        $this->slice->view('activity.index', $data);
    }
}