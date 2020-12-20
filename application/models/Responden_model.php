<?php

class Responden_model extends CI_Model {

    private $table = "coresponden";
    private $primary_key = "id";


    public function getAll() {
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getNext() {
        $this->db->from($this->table);
        $this->db->order_by('id','desc')->limit(1);
        $data = $this->db->get();
        return $data->result();

    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }


}