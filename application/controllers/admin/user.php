<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->model('model_role');
        $this->load->model('model_company_branch');
        $this->load->library('slice');
        check_session();
        role_admin();
    }
    
    public function index() {
        $data['users'] = $this->model_user->index()->result();
        $this->slice->view('admin.user.index', $data);
    }
    
    public function create() {
        $data['users'] = $this->model_user->index()->result();
        $data['company_branchs'] = $this->model_company_branch->index()->result();
        $data['roles'] = $this->model_role->index()->result();
        // var_dump($data);
        // exit;

        return $this->slice->view('admin.user.create', $data);
    }
    
    public function store() {
        $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
        $created_at = $dt->format('Y-m-d H:i:s');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', ['min_length' => 'password too short']);
        // $this->form_validation->set_rules('name', 'NAME','required');
        // $this->form_validation->set_rules('username', 'USERNAME','required');
        // $this->form_validation->set_rules('email','EMAIL','required|valid_email');
        // $this->form_validation->set_rules('password','PASSWORD','required');
        // $this->form_validation->set_rules('password_match','PASSWORD','required|matches[password]');

        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|jpeg',
            'file_name' => $dt->format('Y-m')
        ));

        if ($_FILES['img']['name'] !== '') {
            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('user/admin');
            } else {
                $img = $this->upload->data();
            }

            $data = array(
                'name' => $this->input->post('name'),
                'role_id' => $this->input->post('role'),
                'phone_number' => $this->input->post('phone_number'),
                'company_branch_id' => $this->input->post('company_branch'),
                'address' => $this->input->post('address'),
                'department' => $this->input->post('department'),
                'email' => $this->input->post('email'),
                'img' => $img['file_name']
            );

            if (!empty($this->input->post('password'))) {
                $data['password'] = md5($this->input->post('password'));
            }

            // var_dump($activity, $activity_detail);
            // exit;
            $this->model_user->add($data);
            redirect('user/admin');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'role_id' => $this->input->post('role'),
                'phone_number' => $this->input->post('phone_number'),
                'company_branch_id' => $this->input->post('company_branch'),
                'address' => $this->input->post('address'),
                'department' => $this->input->post('department'),
                'email' => $this->input->post('email'),
            );

            if (!empty($this->input->post('password'))) {
                $data['password'] = md5($this->input->post('password'));
            }

            // var_dump($activity, $activity_detail);
            // exit;
            $this->model_user->add($data);
            redirect('user/admin');
        }
    }
    
    public function show($id) {
        $data['users'] = $this->model_user->detail($id)->row_array();
        $data['company_branchs'] = $this->model_company_branch->index()->result();
        $data['roles'] = $this->model_role->index()->result();
        // var_dump($data);
        // exit;

        return $this->slice->view('admin.user.show', $data);
    }
    
    public function update($id) {
        $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
        $created_at = $dt->format('Y-m-d H:i:s');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', ['min_length' => 'password too short']);

        $this->upload->initialize(array(
            'upload_path' => './uploads',
            'allowed_types' => 'jpg|png|jpeg',
            'file_name' => $dt->format('Y-m-d_His')
        ));

        if ($_FILES['img']['name']) {
            if (!$this->upload->do_upload('img')) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                exit;
                
                redirect('user/admin');
            } else {
                $img = $this->upload->data();
            }

            $data = array(
                'name' => $this->input->post('name'),
                'role_id' => $this->input->post('role'),
                'phone_number' => $this->input->post('phone_number'),
                'company_branch_id' => $this->input->post('company_branch'),
                'address' => $this->input->post('address'),
                'department' => $this->input->post('department'),
                'email' => $this->input->post('email'),
                'img' => $img['file_name']
            );
            
            if (!empty($this->input->post('password'))) {
                $data['password'] = md5($this->input->post('password'));
            }

            // var_dump($data);
            // exit;
            $this->model_user->update($id, $data);
            redirect('user/admin');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'role_id' => $this->input->post('role'),
                'phone_number' => $this->input->post('phone_number'),
                'company_branch_id' => $this->input->post('company_branch'),
                'address' => $this->input->post('address'),
                'department' => $this->input->post('department'),
                'email' => $this->input->post('email'),
            );
            
            if (!empty($this->input->post('password'))) {
                $data['password'] = md5($this->input->post('password'));
            }

            // var_dump($data);
            // exit;
            $this->model_user->update($id, $data);
            redirect('user/admin');
        }
    }

    public function delete($id) {
        $this->model_user->delete($id);
        redirect('user/admin');
    }
}