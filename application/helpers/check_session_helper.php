<?php

function check_session() {
    $get = & get_instance();
    $session = $get->session->userdata('status_login');

    if ($session != 'Oke') {
        redirect('auth/login');
    } 
}

// function check_login_session() {
//     $get = & get_instance();
//     $session = $get->session->userdata('status_login');
    
//     if ($session == 'Oke') {
//         redirect('auth/login');
//     }
// }

function role_admin() {
    $get = & get_instance();
    $role = $get->session->userdata('role_id');
    
    if ($role != '3') {
        redirect('auth/login');
    }
}

function role_tech() {
    $get = & get_instance();
    $role = $get->session->userdata('role_id');
    
    if ($role != '2') {
        redirect('auth/login');
    }
}

function role_user() {
    $get = & get_instance();
    $role = $get->session->userdata('role_id');
    
    if ($role != '1') {
        redirect('auth/login');
    }
}