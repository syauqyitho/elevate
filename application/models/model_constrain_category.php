<?php

class Model_constrain_category extends CI_Model {
    public function index() {
        $query = 'select * from constrain_category';

        return $this->db->query($query);
    }
    
    public function add($data) {
        $this->db->insert('constrain_category', $data);
    }
    
    public function edit($id) {
        $params = array('constrain_category_id' => $id);

        return $this->db->get_where('constrain_category', $params);
    }

    public function update($id, $data) {
        $this->db->where('constrain_category_id', $id);
        $this->db->update('constrain_category', $data);
    }
    
    public function delete($id) {
        $this->db->where('constrain_category_id', $id);
        $this->db->delete('constrain_category');
    }
}