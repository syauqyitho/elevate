<?php

class Model_activity_category extends CI_Model {
    public function index() {
        $query = 'select * from activity_category';

        return $this->db->query($query);
    }
}