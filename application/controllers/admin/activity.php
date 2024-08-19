<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_activity');
        $this->load->model('model_activity_status');
        $this->load->model('model_activity_category'); 
        $this->load->model('model_constrain_category'); 
        $this->load->model('model_user'); 
    }
    
    public function index() {
        $data['activities'] = $this->model_activity->index()->result();
        $this->slice->view('admin.activity.index', $data);
    }
    
    public function add() {
        if (isset($_POST['submit'])) {
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format('Y-m-d H:i:s');
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $dt->format('Ymd_His')
            ));

            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('admin/activity/index');
            } else {
                $img = $this->upload->data();
            }

            $activity = array(
                'activity_status_id' => $this->input->post('activity_status'),
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'user_id' => $this->input->post('user_name'),
                'constrain' => $this->input->post('constrain'),
                'img' => $img['file_name']
            );

            $activity_detail = array(
                'constrain_description' => $this->input->post('constrain_description'),
                'action_description' => $this->input->post('action_description'),
                'level' => $this->input->post('level'),
                'urgency' => $this->input->post('urgency'),
                'user_id' => $this->input->post('tech_name'),
                'created_at' => $created_at
            );
            // var_dump($activity, $activity_detail);
            // exit;

            $this->model_activity->add($activity, $activity_detail);
            redirect('admin/activity/index');
        } else {
            $data['activities'] = $this->model_activity_category->index()->result();
            $data['constrains'] = $this->model_constrain_category->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            $data['users'] = $this->model_user->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('admin.activity.add', $data);
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $id = $this->uri->segment(4);
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format("Y-m-d_H:i:s");
            // configuration for file upload
            $this->upload->initialize(array(
                'upload_path' => './uploads',
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $dt->format('Ymd_His')
            ));
            
            // handle user_img
            if (!$this->upload->do_upload('user_img')) {
                $errors = $this->upload->display_errors();
                var_dump($errors);
                exit;
            } else {
                $user_img = $this->upload->data();
            }

            // handle tech_img
            if (!$this->upload->do_upload('tech_img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
            } else {
                $tech_img = $this->upload->data();
            }

            $activity = array(
                'activity_status_id' => $this->input->post('activity_status'),
                'activity_category_id' => $this->input->post('activity_category'),
                'constrain_category_id' => $this->input->post('constrain_category'),
                'constrain' => $this->input->post('constrain'), 
                'user_id' => $this->input->post("user_name"),
                'img' => $user_img['file_name'],

            );

            $activity_detail = array(
                'constrain_description' => $this->input->post('constrain_description'),
                'action_description' => $this->input->post('action_description'),
                'level' => $this->input->post('level'),
                'urgency' => $this->input->post('urgency'),
                'analyze' => $this->input->post('analyze'),
                'troubleshooting' => $this->input->post('troubleshooting'),
                'user_id' => $this->input->post('tech_name'),
                'img' => $tech_img['file_name']
            ); 
            
            $user = array(
                'department' => $this->input->post('department')
            );

            $company_branch = array(
                'address' => $this->input->post('address')
            );
            
            $id = $this->uri->segment(4);
            // var_dump($id, $activity, $activity_detail, $user, $company_branch);
            // exit;
            $this->model_activity->admin_update($id, $activity, $activity_detail, $user, $company_branch);
            redirect('admin/activity/index');
        } else {
            $id = $this->uri->segment(4);
            $data['activities'] = $this->model_activity->admin_edit($id)->row_array();
            $data['activity_categories'] = $this->model_activity_category->index()->result();
            $data['constrain_categories'] = $this->model_constrain_category->index()->result();
            $data['activity_status'] = $this->model_activity_status->index()->result();
            $data['users'] = $this->model_user->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('admin.activity.edit', $data);
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_activity->delete($id);
        
        redirect('admin/activity/index');
    }
}