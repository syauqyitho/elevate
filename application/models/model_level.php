<?php

class Model_level extends CI_Model {

    public function index() {
        return $this->db->get('level');
    }
}