<?php

class Model_constrain_category extends CI_Model {
    public function index() {
        $query = 'select * from constrain_category';

        return $this->db->query($query);
    }
}