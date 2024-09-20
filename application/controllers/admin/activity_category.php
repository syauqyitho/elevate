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
    
    public function create() {
        return $this->slice->view('admin.activity_category.create');
    }
    
    public function store() {
        $data = array(
            'activity_category_name' => $this->input->post('activity_category_name')
        );
        
        $this->model_activity_category->add($data);
        redirect('activity/category/admin');
    }
    
    public function show($id) {
        $data['activity_categories'] = $this->model_activity_category->edit($id)->row_array();
        return $this->slice->view('admin.activity_category.show', $data);
    }
    
    public function update($id) {
        $data = array(
            'activity_category_name' => $this->input->post('activity_category_name')
        );
        
        $this->model_activity_category->update($id, $data);
        redirect('activity/category/admin');
    }

    public function delete($id) {
        $this->model_activity_category->delete($id);
        redirect('activity/category/admin');
    }
}