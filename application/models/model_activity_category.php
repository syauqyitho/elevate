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
    
    public function add($data) {
        $this->db->insert('activity_category', $data);
    }
    
    public function edit($id) {
        $params = array('activity_category_id' => $id);

        return $this->db->get_where('activity_category', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('activity_category_id', $id);
        $this->db->update('activity_category', $data);
    }
    
    public function delete($id) {
        $this->db->where('activity_category_id', $id);
        $this->db->delete('activity_category');
    }
}