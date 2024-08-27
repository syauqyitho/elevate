<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('slice');
    }

    public function login() {
        $this->slice->view('auth.login');
    }
    
    public function register() {
        $this->slice->view('auth.register');
    }
}