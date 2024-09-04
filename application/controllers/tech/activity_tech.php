<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_tech extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_user');
        $this->load->model('model_activity_tech');
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            
            $data = array(
                'activity_id' => $id,
                'user_id' => $this->input->post('name')
            );
            
            $this->model_activity_tech->add($data);
            redirect('tech/activity/edit/'.$id);
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity_tech->add_activity_tech($id)->row_array();
            $data['users'] = $this->model_user->fetch_technician_role_list();
            $this->slice->view('tech.activity.add_tech', $data);
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            
            $data = array(
                'user_id' => $this->input->post('name')
            );
            
            $this->model_activity_tech->update($id, $data);
            redirect('tech/activity/edit/'.$this->input->post('activity_id'));
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity_tech->edit_activity_tech($id)->row_array();
            // var_dump($data);
            // exit();
            $data['users'] = $this->model_user->index()->result();
            $this->slice->view('tech.activity.edit_tech', $data);
        }
    }
    
    public function delete($id) {
        $id = $this->uri->segment(4);
        $this->model_activity_tech->delete($id);
        
        redirect('tech/activity/');
    }
}