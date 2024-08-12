<?php

class Model_company_branch extends CI_Model {
    public function index() {
        $query = "SELECT
                    company_branch_id,
                    branch_name,
                    group_of_entity_name
                FROM
                    company_branch cb
                    LEFT JOIN group_of_entity goe ON cb.group_of_entity_id = goe.group_of_entity_id";
        
        return $this->db->query($query);
    }

    public function add($data) {
        $this->db->insert('company_branch', $data);
    }

    public function edit($id) {
        $params = array('company_branch_id' => $id);

        return $this->db->get_where('company_branch', $params);
    }
    
    public  function update($id, $data) {
        $this->db->where('company_branch_id', $id);
        $this->db->update('company_branch', $data);
    }
    
    public function delete($id) {
        $this->db->where('company_branch_id', $id);
        $this->db->delete('company_branch');
    }
}