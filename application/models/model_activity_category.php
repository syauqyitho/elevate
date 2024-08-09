<?php

class Model_activity_category extends CI_Model {
    public function index() {
        $query = 'select * from activity_category';

        return $this->db->query($query);
    }
    
    public function get_one($id) {
        $query = 'select * from activity_category where activity_category_id = '.$id;

        return $this->db->query($query);
    }
}