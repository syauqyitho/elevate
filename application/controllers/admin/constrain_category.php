<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Constrain_category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_constrain_category');
    }
    
    public function index() {
        $data['constrain_categories'] = $this->model_constrain_category->index()->result();
        
        return $this->slice->view('admin.constrain_category.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $data = array(
                'constrain_category_name' => $this->input->post('constrain_category_name')
            );
            
            $data = $this->model_constrain_category->add($data);
            redirect('admin/constrain_category/index');
        } else {
            return $this->slice->view('admin.constrain_category.add');
        }
         
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $data = array(
                'constrain_category_name' => $this->input->post('constrain_category_name')
            );
            
            $id = $this->uri->segment(4);
            $this->model_constrain_category->update($id, $data);
            redirect('admin/constrain_category/index');
        } else {
            $id = $this->uri->segment(4);
            $data['constrain_categories'] = $this->model_constrain_category->edit($id)->row_array();
            
            return $this->slice->view('admin.constrain_category.edit', $data);
        }
        
    }
    
    public function delete($id) {
        $id = $this->uri->segment(4);
        $this->model_constrain_category->delete($id);

        redirect('admin/constrain_category/index');
    }
}