<?php

class Model_activity_tech extends CI_Model {

    public function index($id) {
        $query = "SELECT
                    atc.activity_tech_id,
                    u.name
                FROM
                    activity a
                    LEFT JOIN activity_tech atc ON a.activity_id = atc.activity_id
                    LEFT JOIN user u ON atc.user_id = u.user_id
                WHERE
                    atc.activity_id=".$id;

        return $this->db->query($query);
    }

    public function add($data) {
        $this->db->insert('activity_tech', $data);
    }
    
    public function delete($id) {
        $this->db->where('activity_tech_id', $id);
        $this->db->delete('activity_tech');
    }

    public function add_activity_tech($id) {
        $query = "SELECT
                    activity_id
                FROM
                    activity
                WHERE activity_id=".$id;

        return $this->db->query($query);
    }
    
    public function edit_activity_tech($id) {
        $params = array('activity_tech_id' => $id);
        return $this->db->get_where('activity_tech', $params);
    }
    
    public function update($id, $data) {
        $this->db->where('activity_tech_id', $id);
        $this->db->update('activity_tech', $data);
    }
}