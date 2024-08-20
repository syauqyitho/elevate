<?php

class Model_role extends CI_Model {
    public function index() {
        return $this->db->get('role');
    }
}