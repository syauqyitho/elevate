<?php

class Model_user extends CI_Model {
    public function index() {
        return $this->db->get('user');
    }
}