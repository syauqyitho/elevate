<?php

class Model_activity_status extends CI_Model {
    public function index() {
        return $this->db->get('activity_status');
    }
}