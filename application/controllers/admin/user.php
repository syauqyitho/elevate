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
    
    public function add() {
        if (isset($_POST['submit'])) {
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
                    
                    redirect('admin/activity/index');
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
                    // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'password' => md5($this->input->post('password')),
                    'img' => $img['file_name']
                );

                // var_dump($activity, $activity_detail);
                // exit;
                $this->model_user->add($data);
                redirect('admin/user/');
            } else {
                $data = array(
                    'name' => $this->input->post('name'),
                    'role_id' => $this->input->post('role'),
                    'phone_number' => $this->input->post('phone_number'),
                    'company_branch_id' => $this->input->post('company_branch'),
                    'address' => $this->input->post('address'),
                    'department' => $this->input->post('department'),
                    'email' => $this->input->post('email'),
                    // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                    'password' => md5($this->input->post('password'))
                );

                // var_dump($activity, $activity_detail);
                // exit;
                $this->model_user->add($data);
                redirect('admin/user/');
            }
        } else {
            $data['users'] = $this->model_user->index()->result();
            $data['company_branchs'] = $this->model_company_branch->index()->result();
            $data['roles'] = $this->model_role->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('admin.user.add', $data);
        }
    }
    
    public function edit() {
        if (isset($_POST['submit'])) {
            $dt = new DateTimeImmutable('now', new DateTimeZone('Asia/Jakarta'));
            $created_at = $dt->format('Y-m-d H:i:s');
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', ['min_length' => 'password too short']);
            // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            // $this->form_validation->set_rules('name', 'NAME','required');
            // $this->form_validation->set_rules('username', 'USERNAME','required');
            // $this->form_validation->set_rules('email','EMAIL','required|valid_email');
            // $this->form_validation->set_rules('password','PASSWORD','required');
            // $this->form_validation->set_rules('password_conf','PASSWORD','required|matches[password]');

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
                    
                    redirect('admin/activity/index');
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
                    // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'password' => md5($this->input->post('password')),
                    'img' => $img['file_name']
                );

                // var_dump($data);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_user->update($id, $data);
                redirect('admin/user/');
            } else {
                $data = array(
                    'name' => $this->input->post('name'),
                    'role_id' => $this->input->post('role'),
                    'phone_number' => $this->input->post('phone_number'),
                    'company_branch_id' => $this->input->post('company_branch'),
                    'address' => $this->input->post('address'),
                    'department' => $this->input->post('department'),
                    'email' => $this->input->post('email'),
                    // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'password' => md5($this->input->post('password'))
                );

                // var_dump($data);
                // exit;
                $id = $this->uri->segment(4);
                $this->model_user->update($id, $data);
                redirect('admin/user/');
            }
            
        } else {
            $id = $this->uri->segment(4);
            $data['users'] = $this->model_user->detail($id)->row_array();
            $data['company_branchs'] = $this->model_company_branch->index()->result();
            $data['roles'] = $this->model_role->index()->result();
            // var_dump($data);
            // exit;

            return $this->slice->view('admin.user.edit', $data);
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->model_user->delete($id);
        redirect('admin/user');
    }
}