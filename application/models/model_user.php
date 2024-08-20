<?php

class Model_user extends CI_Model {
    public function index() {
        return $this->db->get('user');
    }
    
    public function add($data) {
        $this->db->insert('user', $data);
    }
    
    public function detail($id) {
        $params = array('user_id' => $id);

        return $this->db->get_where('user', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
    }
    
    public function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}