<?php

class Model_enterprise extends CI_Model {
    public function index() {
        $query = "SELECT
                    e.enterprise_id,
                    e.enterprise_name,
                    es.enterprise_status_name 
                FROM
                    enterprise e
                    LEFT JOIN enterprise_status es ON e.enterprise_status_id = es.enterprise_status_id";

        return $this->db->query($query);
    }
    
    public function add($data) {
        $this->db->insert('enterprise', $data);
    }
    
    public function edit($id) {
        $params = array('enterprise_id' => $id);
        return $this->db->get_where('enterprise', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('enterprise_id', $id);
        $this->db->update('enterprise', $data);
    }
    
    public function delete($id) {
        $this->db->where('enterprise_id', $id);
        $this->db->delete('enterprise');
    }
}