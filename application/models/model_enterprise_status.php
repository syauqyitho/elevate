<?php

class Model_enterprise_status extends CI_Model {
    public function index() {
        return $this->db->get('enterprise_status');
    }
    
    public function add($data) {
        $this->db->insert('enterprise_status', $data);
    }
    
    public function edit($id) {
        $params = array('enterprise_status_id' => $id);

        return $this->db->get_where('enterprise_status', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('enterprise_status_id', $id);
        $this->db->update('enterprise_status', $data);
    }
    
    public function delete($id) {
        $this->db->where('enterprise_status_id', $id);
        $this->db->delete('enterprise_status');
    }
}