<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity_category');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['activity_categories'] = $this->model_activity_category->index()->result();
        
        return $this->slice->view('admin.activity_category.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $data = array(
                'activity_category_name' => $this->input->post('activity_category_name')
            );
            
            $this->model_activity_category->add($data);
            redirect('admin/activity_category/index');
        } else {
            return $this->slice->view('admin.activity_category.add');
        }
        
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $data = array(
                'activity_category_name' => $this->input->post('activity_category_name')
            );
            
            $id = $this->uri->segment(4);
            $this->model_activity_category->update($id, $data);
            redirect('admin/activity_category/index');
        } else {
            $id = $this->uri->segment(4);
            $data['activity_categories'] = $this->model_activity_category->edit($id)->row_array();
            
            return $this->slice->view('admin.activity_category.edit', $data);
        }
        
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity_category->delete($id);
        
        redirect('admin/activity_category/index');
    }
}