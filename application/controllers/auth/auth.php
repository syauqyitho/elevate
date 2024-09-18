<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('model_login');
    }
    
    public function index() {
        if (isset($_POST['submit'])) {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            // var_dump($email, $password);
            // exit();
            $result = $this->model_login->login($email, $password);
            // print_r($result);
            // die();

            if ($result == 1) {
                // $this->db->where('email', $email);
                // $this->db->update('operator', array('last_login' => date('Y-m-d')));
                $user = $this->db->get_where('user', array('email' => $email))->row_array();

                $data = array(
                    'user_id' => $user['user_id'],
                    'role_id' => $user['role_id'],
                    'img' => $user['img'],
                    'name' => $user['name'],
                    'status_login' => 'Oke'
                );

                $this->session->set_userdata($data);
                
                if ($data['role_id'] == 1) {
                    redirect('user/dashboard');
                } elseif ($data['role_id'] == 2) {
                    redirect('tech/activity');
                } else {
                    redirect('admin/activity');
                }
                // $this->slice->view('dashboard.user');
            } else {
                redirect('auth/login');
            }
        } else {
            // check_login_session();
            // $this->load->view('form_login');
            // check login session
            $data = array(
                'status_login' => $this->session->userdata('status_login'),
                'role' => $this->session->userdata('role_id')
            );
            
            if ($data['status_login'] == 'Oke') {
                if ($data['role'] == 3) {
                    redirect('admin/activity');
                } elseif ($data['role'] == 2) {
                    redirect('tech/activity');
                } else {
                    redirect('user/activity');
                }
            } else {
                $this->slice->view('auth.login');
            }

        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}