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
    
    public function add() {
        if (isset($_POST['submit'])) {
            $status = $this->input->post('status');
            $data = array(
                 'enterprise_status_name' => $status
            );

            $this->model_enterprise_status->add($data);

            redirect('admin/enterprise_status/index');
        } else {
            $this->slice->view('admin.enterprise_status.add'); 
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            $status = $this->input->post('status');
            $data = array(
                'enterprise_status_name' => $status
            );

            $this->model_enterprise_status->update($id, $data);
            redirect('admin/enterprise_status');
        } else {
            $id = $this->uri->segment(4);
            $data['enterprise_status'] = $this->model_enterprise_status->edit($id)->row_array();
            
            $this->slice->view('admin/enterprise_status/edit', $data);
        }
        
    }
    
    public function delete($id) {
        $id = $this->uri->segment(4);
        $this->model_enterprise_status->delete($id);
        
        redirect('admin/enterprise_status');
    }
}