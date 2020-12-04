<?php

class Usulan_rkap_model extends CI_Model {

    private $table = "usulan_rkap";
    private $primary_key = "usulan_rkap_id";
    private $status_aktif = "usulan_rkap_isaktif";

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

    public function getTotalByUnit()
    {
        $data = $this->db->query("SELECT unit_id, unit_nama, sum(usulan_rkap_aki) as total FROM `usulan_rkap`,unit WHERE usulan_rkap_unit = unit_id group by unit_id");
        return $data->result();
    }

    public function getTotal()
    {
        $data = $this->db->query('select sum(usulan_rkap_aki) as total_aki, sum(usulan_rkap_ai) as total_ai from usulan_rkap');
        return $data->first_row();
    }

    public function getTotalByPic($pic)
    {
        $data = $this->db->query("select sum(usulan_rkap_aki) as total_aki, sum(usulan_rkap_ai) as total_ai from usulan_rkap where usulan_rkap_unit = ".$pic);
        return $data->first_row();
    }

    public function getByUnit($unit_id)
    {
        $this->db->where('usulan_rkap_unit',$unit_id);
        $data = $this->db->get($this->table);
        return $data->result();
    }
}
