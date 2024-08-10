<?php

class Model_enterprise_status extends CI_Model {
    public function index() {
        return $this->db->get('enterprise_status');
    }
}