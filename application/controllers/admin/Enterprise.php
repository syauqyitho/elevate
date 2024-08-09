<?php


class Enterprise extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
    }
    public function index() {
        $this->slice->view('enterprise.index');
    }
    
    public function add() {
       $this->slice->view('enterprise.add'); 
    }
    
    function save() {
        if (isset($_POST['submit'])) {
        $this->load->model('enterprise');     
        $enterprise_name = $this->input->post('enterprise_name');
        $status = $this->input->post('status');
        $data = array(
             'enterprise_name' => $enterprise_name,
             'status' => $status
        );

        $this->enterprise->add($data);
        redirect('enterprise/index');
        }
    }
}