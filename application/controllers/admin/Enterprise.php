<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enterprise extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_enterprise');
        $this->load->model('model_enterprise_status');
        check_session();
        role_admin();
    }

    public function index() {
        $data['enterprises'] = $this->model_enterprise->index()->result();
        $this->slice->view('admin.enterprise.index', $data);
    }
    
    public function create() {
        $data['enterprise_status'] = $this->model_enterprise_status->index()->result();
        // var_dump($data);
        // exit;

        $this->slice->view('admin.enterprise.create', $data); 
    }
    
    public function store() {
        $enterprise_name = $this->input->post('enterprise_name');
        $status = $this->input->post('status');
        $data = array(
             'enterprise_name' => $enterprise_name,
             'enterprise_status_id' => $status
        );

        $this->model_enterprise->add($data);
        redirect('enterprise/admin');
    }

    public function show($id) {
        $data['enterprise_status'] = $this->model_enterprise_status->index()->result();
        $data['enterprises'] = $this->model_enterprise->edit($id)->row_array();
        // var_dump($data);
        // exit;
        
        $this->slice->view('admin.enterprise.show', $data);
    }
    
    public function update($id) {
        $enterprise_name = $this->input->post('enterprise_name');
        $status = $this->input->post('status');
        $data = array(
            'enterprise_name' => $enterprise_name,
            'enterprise_status_id' => $status
        );

        $this->model_enterprise->update($id, $data);
        redirect('admin/enterprise');
    }
    
    public function delete($id) {
        $this->model_enterprise->delete($id);
        
        redirect('enterprise/admin');
    }
}