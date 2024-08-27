<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
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

    // public function index() {
    //     if (isset($_POST['submit'])) {
    //         $name = $this->input->post('name');
    //         $password = md5($this->input->post('password'));
    //         $check_data = $this->model_login->login($name);
    //         // $verify = password_verify($password, $check_data->password);
    //         // var_dump($check_data, $verify, $password);
    //         // exit();
            
    //         if ($check_data) {
    //             if (password_verify($password, $check_data->password)) {
    //                 echo "Berhasil";
    //                 exit();
    //             } else {
    //                 echo "Salah";
    //                 exit();
    //             }
    //         }
    //     } else {
    //         $this->slice->view('auth.login');
    //     }
    // }

    // public function index()
    // {
    //     $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
    //     $this->form_validation->set_rules('password', 'Password', 'required|trim');
    //     if ($this->form_validation->run() == false) {
    //         $this->slice->view('auth.login');
    //     } else {
    //         ///validasi success
    //         $this->_login();
    //     }
    // }

    // private function _login(){
    //     $password = $this->input->post('password');
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //     var_dump($hashed_password);
    //     $entered_password = 'my_secret_password';
    //     if (password_verify($password, $hashed_password)) {
    //         echo 'Password is valid!';
    //     } else {
    //         echo 'Password is invalid!';
    //     }
    //     exit();

    //     $email = $this->input->post('email');
    //     $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    //     // $password = $this->input->post('password');
    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     //Jika user aktif
    //     if ($user) {
    //         //cek password
    //         if (password_verify($password, $user['password'])) {

    //             $data = [
    //                 'user_id' => $user['user_id'],
    //                 'email' => $user['email'],
    //                 'role_id' => $user['role_id']
    //             ];

    //             $this->session->set_userdata($data);
    //             $this->slice->view('user.dashboard');

    //             // var_dump($data);
    //             // exit();
    //             // if ($user['role_id'] == 1) {
    //             //     redirect('user/dashboard');
    //             // } elseif ($user['role_id'] == 2) {
    //             //     redirect('tech/activity');
    //             // } else {
    //             //     redirect('admin/activity');
    //             // }
    //         } /* else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Salah!</div>');
    //             redirect('auth/login');
    //         } */
    //     } /* else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email Yang dimasukan Belum Diregistrasi </div>');
    //         redirect('auth/login');
    //     } */
    // }

	
    // public function registrasi()
    // {
    //     $this->form_validation->set_rules('name', 'Name', 'required|trim');
    //     $this->form_validation->set_rules('email', 'Email', 'required|trim');
    //     $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'password not match!', 'min_length' => 'password too short']);
    //     $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    //     if ($this->form_validation->run() == false) {
    //         $data['titles'] = 'Form Register';
    //         $this->load->view('v_register',$data);
    //     } else {
    //         $data = [
    //             'name' => htmlspecialchars($this->input->post('name', true)),
    //             'email' => htmlspecialchars($this->input->post('email', true)),
    //             'gambar' => 'default.jpg',
    //             'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
    //             'role_id' => 2,
    //             'is_active' => 1,
    //             'date_created' => time()
    //         ];


    //         $this->db->insert('tbl_pengguna', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun anda telah dibuat. Silahkan Login!</div>');
    //         redirect('auth');
    //     }
    // }
    // public function logout(){
    //     $this->session->unset_userdata('email');
    //     $this->session->unset_userdata('role_id');

    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> kamu berhasil Log out!</div>');
    //     redirect('auth');
    // }
}