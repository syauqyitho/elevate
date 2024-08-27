<?php

class Model_login extends CI_Model {
    
    // public function login($name) {
    //    $this->db->select(array('*'));
    //    return $this->db->get_where('user', array('name' => $name))->row();
    // }

    // public function logged_in_data($id) {
    //     $this->db->select('*');
    //     $this->db->where('id', $id);
    //     $this->db->from('user');
        
    //     return $this->db->get()->row();
    // }
    
    public function login($email, $password) {
        $check = $this->db->get_where('user', array(
            'email' => $email,
            // 'password' => md5($password)
            'password' => $password
        ));

        if ($check->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}