<?php

class Invoice_model extends CI_Model {

    private $table = "invoice";
    private $primary_key = "invoice_id";
    private $status_aktif = "invoice_isaktif";

    public function getAllAktif() {
        $this->db->where($this->status_aktif, 1);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getAll() {
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getByBulan($bulan)
    {
        $data = $this->db->query("select * from pekerjaan, invoice where invoice.pekerjaan_id = pekerjaan.pekerjaan_id and invoice.invoice_bulan = '".$bulan."'");
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

    public function getDetailById($id)
    {
        $data = $this->db->query("select * from pekerjaan, invoice where invoice.pekerjaan_id = pekerjaan.pekerjaan_id and invoice_id = '".$id."'");
        return $data->result()[0];
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

    public function deleteByPrk($id)
    {
        $this->db->query("delete from invoice where pekerjaan_id = '".$id."'");
    }
}
