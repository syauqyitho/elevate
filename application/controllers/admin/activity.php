<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user'); 
        $this->load->model('model_urgency'); 
        $this->load->model('model_activity');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        $this->load->model('model_activity_detail');
        $this->load->model('model_activity_tech');
        $this->load->library('slice');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->admin_index()->result();
        $this->slice->view('admin.activity.index', $data);
    }
    
    public function create() {
        $data['activities'] = $this->model_activity_category->index()->result();
        $data['constrains'] = $this->model_constrain_category->index()->result();
        $data['users'] = $this->model_user->index()->result();
        $data['urgencies'] = $this->model_urgency->index()->result();
        // var_dump($data);
        // exit;

        return $this->slice->view('admin.activity.create', $data);
    }
    
    public function store() {
        $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
        $created_at = $dt->format('Y-m-d H:i:s');
        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|jpeg',
            'file_name' => $dt->format('Y-m-d_His')
        ));
        
        if ($_FILES['img']['name'] !== '') {
            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('activity/admin');
            } else {
                $img = $this->upload->data();
            }

            $activity = array(
                'activity_status_id' => 1,
                'user_id' => $this->input->post('name'),
                'urgency_id' => $this->input->post('urgency'),
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'),
                'constrain_description' => $this->input->post('constrain_description'),
                'img' => $img['file_name'],
                'created_at' => $created_at
            );

            // var_dump($activity, $activity_detail);
            // exit;
            $this->model_activity->add($activity, $activity_detail);
            redirect('activity/admin');
        } else {
            $activity = array(
                'activity_status_id' => 1,
                'user_id' => $this->input->post('name'),
                'urgency_id' => $this->input->post('urgency'),
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'),
                'constrain_description' => $this->input->post('constrain_description'),
                'created_at' => $created_at
            );

            // var_dump($activity, $activity_detail);
            // exit;
            $this->model_activity->add($activity, $activity_detail);
            redirect('activity/admin');
        }
    }

    public function show($id) {
        $data['activities'] = $this->model_activity->detail($id)->row_array();
        $data['activity_details'] = $this->model_activity_detail->list_detail($id)->result();
        $data['list_tech'] = $this->model_activity_tech->index($id)->result();
        $data['users'] = $this->model_user->index()->result();
        $data['urgencies'] = $this->model_urgency->index()->result();
        $data['activity_status'] = $this->model_activity_status->index()->result();
        $data['activity_categories'] = $this->model_activity_category->index()->result();
        $data['constrain_categories'] = $this->model_constrain_category->index()->result();
        // $this->slice->view('admin.activity.edit', $data);
        $this->slice->view('admin.activity.show', $data);
    }

    public function update($id) {
        $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
        $created_at = $dt->format('Y-m-d H:i:s');
        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|jpeg',
            'file_name' => $dt->format('Y-m-d_His')
        ));
        
        if ($_FILES['img']['name'] !== '') {
            if (!$this->upload->do_upload('img')) {
                $errors = $this->upload->display_errors();
                var_dump($errors);
                exit;
                
                redirect('activity/admin');
            } else {
                $img = $this->upload->data();

                $data = array(
                    'user_id' => $this->input->post('name'),
                    'urgency_id' => $this->input->post('urgency'),
                    'activity_category_id' => $this->input->post('activity_category'),
                    'constrain_category_id' => $this->input->post('constrain_category'),
                    'constrain' => $this->input->post('constrain'),
                    'constrain_description' => $this->input->post('constrain_description'),
                    'img' => $img['file_name']
                );

                // var_dump($activity);
                // exit;
                $this->model_activity->update($id, $data);
                redirect('activity/admin');
            }
        } else {
            $data = array(
                'user_id' => $this->input->post('name'),
                'urgency_id' => $this->input->post('urgency'),
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'),
                'constrain_description' => $this->input->post('constrain_description')
            );

            // var_dump($data);
            // exit;
            $this->model_activity->update($id, $data);
            redirect('activity/admin');
        }
    }
    
    public function delete($id) {
        $this->model_activity->delete($id);
        redirect('activity/admin');
    }
}