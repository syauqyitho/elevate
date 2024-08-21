<?php

class Model_activity_detail extends CI_Model {

    public function detail($id) {
        $params = array('activity_detail_id' => $id);
        return $this->db->get_where('activity_detail', $params);
    }

    public function list_detail($id) {
        $this->db->where('activity_id', $id);
        return $this->db->get('activity_detail');
    }
}