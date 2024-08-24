<?php

class Model_urgency extends CI_Model {
    public function index() {
        return $this->db->get('urgency');
    }
}