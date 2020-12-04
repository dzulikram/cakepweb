<?php

class Server_model extends CI_Model {

    private $table = "server";
    private $primary_key = "server_id";
    private $status_aktif = "server_isaktif";

    public function getAllAktif() {
        $this->db->where($this->status_aktif, 1);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getAll() {
        $query = "select * from server order by INET_ATON(server_ip) asc";
        $data = $this->db->query($query);
        // $this->db->order_by('server_ip','asc');
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

    public function getRekapTerakhir()
    {
        $data = $this->db->query('select * from server, pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by INET_ATON(server_ip) asc');
        return $data->result();
    }

    public function getOrderByParam($column, $type)
    {
        $data = $this->db->query("select * from server, pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by ".$column." ".$type."");
        return $data->result();
    }

    public function getByOrderHardiskPrimary()
    {
        $data = $this->db->query("select *,(pemantauan_hardisk_primary/server_hardisk_primary) as kapasitas_hardisk_primary from server, pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by kapasitas_hardisk_primary desc");
        return $data->result();
    }

    public function getByOrderHardiskSecondary()
    {
        $data = $this->db->query("select *,(pemantauan_hardisk_secondary/server_hardisk_secondary) as kapasitas_hardisk_secondary from server, pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by kapasitas_hardisk_secondary desc");
        return $data->result();
    }

    public function getEventTerbanyak()
    {
        $data = $this->db->query("select source_pemantauan, count(source_pemantauan) as jumlah from 
            ( 
                select pemantauan_source_event1 as source_pemantauan from server,pemantauan WHERE server.server_pemantauan_terakhir = pemantauan.pemantauan_id 
                UNION ALL 
                select pemantauan_source_event2 as source_pemantauan from server,pemantauan WHERE server.server_pemantauan_terakhir = pemantauan.pemantauan_id
                UNION ALL 
                select pemantauan_source_event3 as source_pemantauan from server,pemantauan WHERE server.server_pemantauan_terakhir = pemantauan.pemantauan_id ) 
            aa group by source_pemantauan order by jumlah desc");
        return $data->result();
    }

    public function getByAVLastUpdate()
    {
        $data = $this->db->query('select * from server,pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by pemantauan_update_av_terakhir');
        return $data->result();   
    }

    public function getByAVLastScan()
    {
        $data = $this->db->query('select * from server,pemantauan where server.server_pemantauan_terakhir = pemantauan.pemantauan_id order by pemantauan_scan_av_terakhir');
        return $data->result();   
    }

}
