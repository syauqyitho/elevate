<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Constrain_category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_constrain_category');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['constrain_categories'] = $this->model_constrain_category->index()->result();
        return $this->slice->view('admin.constrain_category.index', $data);
    }
    
    public function create() {
        return $this->slice->view('admin.constrain_category.create');
    }
    
    public function store() {
        $data = array(
            'constrain_category_name' => $this->input->post('constrain_category_name')
        );
        
        $data = $this->model_constrain_category->add($data);
        redirect('constrain/admin');
    }
    
    public function show($id) {
        $data['constrain_categories'] = $this->model_constrain_category->edit($id)->row_array();
        return $this->slice->view('admin.constrain_category.show', $data);
    }
    
    public function update($id) {
        $data = array(
            'constrain_category_name' => $this->input->post('constrain_category_name')
        );
        
        $id = $this->uri->segment(4);
        $this->model_constrain_category->update($id, $data);
        redirect('constrain/admin');
    }
    
    public function delete($id) {
        $this->model_constrain_category->delete($id);
        redirect('constrain/admin');
    }
}