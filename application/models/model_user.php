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

    public function tech_role($id) {
        $query = "SELECT
                    atc.user_id,
                    u.name
                FROM
                    activity_tech atc
                    LEFT JOIN activity a ON atc.activity_id = a.activity_id
                    LEFT JOIN user u ON atc.user_id = u.user_id
                WHERE
                    atc.activity_id=".$id;

        return $this->db->query($query);
    }
    
    public function fetch_technician_role_list() {
        $this->db->select('user_id, name');
        $this->db->from('user');
        $this->db->where('role_id', 2);

        $query = $this->db->get();
        
        // Check if the query is successful
        if (!$query) {
            log_message('error', 'Database query failed!' . $this->db->last_query());
            return []; // return an empty array or handle the error properly.
        }
        
        // Return the result as an assosiative array
        return $query->result();
    }
}