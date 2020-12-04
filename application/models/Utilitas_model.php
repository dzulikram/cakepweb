<?php

class Utilitas_model extends CI_Model {

    private $table = "utilitas";
    private $primary_key = "utilitas_id";
    private $status_aktif = "utilitas_isaktif";

    public function getAllAktif() {
        $this->db->where($this->status_aktif, 1);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getAll() {
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getById($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);
        $result = $query->result();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function getByColumn($column, $id)
    {
        $this->db->where($column, $id);
        $query = $this->db->get($this->table);
        $result = $query->result();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    public function update($id, $data) {
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        //$this->db->where("proyek_id",$id);
        $query = $this->db->delete($this->table,array($this->primary_key=>$id));
        return $query;
    }

    public function get_table_name() {
        return $this->table;
    }

    public function get_primary_key() {
        return $this->primary_key;
    }

    public function getByPc($pc_id) {
        $this->db->where("pc_id", $pc_id);
        $data = $this->db->get($this->table);
        return $data->result();
    }
}
