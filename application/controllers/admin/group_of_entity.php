<?php
defined('BASEPATH') OR exit('No direct scirpt access allowed');

class Group_of_entity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_enterprise');
        $this->load->model('model_group_of_entity');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['group_of_entities'] = $this->model_group_of_entity->index()->result();
        
        return $this->slice->view('admin.group_of_entity.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|jpeg|png'
            ));
            
            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('admin/group_of_entity/add');
            } else {
                $img = $this->upload->data();
                $data = array(
                    'enterprise_id' => $this->input->post('enterprise'),
                    'group_of_entity_name' => $this->input->post('group_of_entity_name'),
                    'npwp_number' => $this->input->post('npwp_number'),
                    'img' => $img['file_name']
                );
            }
            
            $this->model_group_of_entity->add($data);            
            redirect('admin/group_of_entity/index');
        } else {
            $data['enterprises'] = $this->model_enterprise->index()->result();
            
            return $this->slice->view('admin.group_of_entity.add', $data);
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            $data = array(
                'enterprise_id' => $this->input->post('enterprise'),
                'group_of_entity_name' => $this->input->post('name'),
                'npwp_number' => $this->input->post('npwp_number')
            );

            if ($_FILES['img']['name'] != '') {
                $this->upload->initialize(array(
                    'upload_path' => './uploads',
                    'allowed_types' => 'jpg|jpeg|png'
                ));
                
                if (!$this->upload->do_upload('img')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    exit;
                    
                    redirect('admin/group_of_entity/add');
                } else {
                    $img = $this->upload->data();
                    $data['img'] = $img['file_name'];
                }
            }
            
            $this->model_group_of_entity->update($id, $data);            
            redirect('admin/group_of_entity');
        } else {
            $id = $this->uri->segment(4);
            $data['enterprises'] = $this->model_enterprise->index()->result();
            $data['group_of_entities'] = $this->model_group_of_entity->edit($id)->row_array();
            
            return $this->slice->view('admin.group_of_entity.edit', $data);
        }
    }
    
    public function delete($id) {
        $id = $this->uri->segment(4);
        $this->model_group_of_entity->delete($id);
        
        redirect('admin/group_of_entity');
    }
}