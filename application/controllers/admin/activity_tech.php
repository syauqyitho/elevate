<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_tech extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_user');
        $this->load->model('model_activity_tech');
    }

    public function create($id) {
        $data['activities'] = $this->model_activity_tech->add_activity_tech($id)->row_array();
        $data['users'] = $this->model_user->index()->result();
        $this->slice->view('admin.activity.create_tech', $data);
    }
    
    public function store($id) {
        $data = array(
            'activity_id' => $id,
            'user_id' => $this->input->post('name')
        );
        
        $this->model_activity_tech->add($data);
        redirect('activity/show/admin/'.$id);
    }
    
    public function show($id) {
        $data['activities'] = $this->model_activity_tech->edit_activity_tech($id)->row_array();
        // var_dump($data);
        // exit();
        $data['users'] = $this->model_user->index()->result();
        $this->slice->view('admin.activity.show_tech', $data);
    }
    
    public function update($id) {
        $data = array(
            'user_id' => $this->input->post('name')
        );
        
        $this->model_activity_tech->update($id, $data);
        redirect('activity/show/admin/'.$this->input->post('activity_id'));
    }
    
    public function delete($id) {
        $this->model_activity_tech->delete($id);
        redirect('activity/admin');
    }
}