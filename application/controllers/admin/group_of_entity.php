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
    
    public function create() {
        $data['enterprises'] = $this->model_enterprise->index()->result();
        return $this->slice->view('admin.group_of_entity.create', $data);
    }
    
    public function store() {
        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|jpeg|png'
        ));
        
        if (!$this->upload->do_upload('img')) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
            exit;
            
            redirect('entity-group/admin');
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
        redirect('entity-group/admin');
    }
    
    public function show($id) {
        $data['enterprises'] = $this->model_enterprise->index()->result();
        $data['group_of_entities'] = $this->model_group_of_entity->edit($id)->row_array();
        
        return $this->slice->view('admin.group_of_entity.show', $data);
    }
    
    public function update($id) {
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
        redirect('entity-group/admin');
    }
    
    public function delete($id) {
        $this->model_group_of_entity->delete($id);
        redirect('entity-group/admin');
    }
}