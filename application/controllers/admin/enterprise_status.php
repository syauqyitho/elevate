<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enterprise_status extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_enterprise_status');
        check_session();
        role_admin();
    }

    public function index() {
        $data['enterprise_status'] = $this->model_enterprise_status->index()->result();
        $this->slice->view('admin.enterprise_status.index', $data);
    }
    
    public function create() {
        $this->slice->view('admin.enterprise_status.create'); 
    }
    
    public function store() {
        $status = $this->input->post('status');
        $data = array(
             'enterprise_status_name' => $status
        );

        $this->model_enterprise_status->add($data);
        redirect('enterprise/status/admin');
    }
    
    public function show($id) {
        $data['enterprise_status'] = $this->model_enterprise_status->edit($id)->row_array();
        
        $this->slice->view('admin.enterprise_status.show', $data);
    }
    
    public function update($id) {
        $status = $this->input->post('status');
        $data = array(
            'enterprise_status_name' => $status
        );

        $this->model_enterprise_status->update($id, $data);
        redirect('enterprise/status/admin');
    }
    
    public function delete($id) {
        $this->model_enterprise_status->delete($id);
        
        redirect('enterprise/status/admin');
    }
}