<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_branch extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_company_branch');
        $this->load->model('model_group_of_entity');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['company_branches'] = $this->model_company_branch->index()->result();

        return $this->slice->view('admin.company_branch.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $data = array(
                'group_of_entity_id' => $this->input->post('group_of_entity'),
                'branch_name' => $this->input->post('branch_name'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address')
            );
            
            $this->model_company_branch->add($data);
            redirect('admin/company_branch/index');
        } else {
            $data['company_branches'] = $this->model_company_branch->index()->result();
            $data['group_of_entities'] = $this->model_group_of_entity->index()->result();

            return $this->slice->view('admin.company_branch.add', $data);
        }
        
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $data = array(
                'group_of_entity_id' => $this->input->post('group_of_entity'),
                'branch_name' => $this->input->post('branch_name'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address')
            );
            // var_dump($data);
            // exit;
            
            $id = $this->uri->segment(4);
            $this->model_company_branch->update($id, $data);
            redirect('admin/company_branch/index');
        } else {
            $id = $this->uri->segment(4);
            $data['company_branches'] = $this->model_company_branch->edit($id)->row_array();
            $data['group_of_entities'] = $this->model_group_of_entity->index()->result();

            return $this->slice->view('admin.company_branch.edit', $data);
        }
        
    }
    
    public function delete($id) {
        $id = $this->uri->segment(4);
        $this->model_company_branch->delete($id);
        
        redirect('admin/company_branch/index');
    }
}