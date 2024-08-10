<?php

class Model_group_of_entity extends CI_Model {
    public function index() {
        return $this->db->get('group_of_entity');
    }
    
    public function add($data) {
        $this->db->insert('group_of_entity', $data);
    }
    
    public function edit($id) {
        $params = array('group_of_entity_id' => $id); 

        return $this->db->get_where('group_of_entity', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('group_of_entity_id', $id);
        $this->db->update('group_of_entity', $data);
    }

    public function delete($id) {
        $this->db->where('group_of_entity_id', $id);
        $this->db->delete('group_of_entity');
    }
}