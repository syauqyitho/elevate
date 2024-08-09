<?php
class Enterprise extends CI_Model {
    function add($data) {
        $this->db->insert('enterprises', $data);
    }
}