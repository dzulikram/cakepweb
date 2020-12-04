<?php

class Pc_model extends CI_Model {

    private $table = "pc";
    private $primary_key = "pc_id";
    private $status_aktif = "pc_isaktif";

    public function getAllAktif() {
        $this->db->where($this->status_aktif, 1);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getAll() {
        $data = $this->db->get($this->table);
        return $data->result();
    }
    
    public function getAllWithJoin($unit_id) {
        $this->db->select('*');
        $this->db->from('pc as a');
        $this->db->join('unit as b','a.unit_id = b.unit_id', 'left');
        $this->db->join('user as c','a.pc_it_support = c.user_id', 'left');
        if(isset($unit_id)){
            if($unit_id != 'all'){
                $this->db->where('a.unit_id',$unit_id);
            }
        }
        $this->db->order_by('a.pc_pemeliharaan_tanggal', "desc");
        $data = $this->db->get();
        return $data->result();
    }

    public function getByUnit($unit_id) {
        $this->db->where("unit_id", $unit_id);
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

    public function getAvTerlama()
    {
        $user = $this->session->userdata('sesi');
        if($user->user_privilage == 1)
        {
            $data = $this->db->query('select * from pc,unit where pc.unit_id = unit.unit_id order by pc_av_tahun asc');
        }
        else
        {
            $data = $this->db->query("select * from pc,unit,mapping,user where pc.unit_id = unit.unit_id and unit.unit_id = mapping.mapping_unit and mapping.mapping_it_support = user.user_id and user.user_id = '".$user->user_id."' order by pc_av_tahun asc");
        }
        return $data->result();
    }


    public function getAvUpdateTerlama()
    {
        $user = $this->session->userdata('sesi');
        if($user->user_privilage == 1)
        {
            $data = $this->db->query('select * from pc,unit where pc.unit_id = unit.unit_id order by pc_update_tanggal asc');
        }
        else
        {
            $data = $this->db->query("select * from pc,unit,mapping,user where pc.unit_id = unit.unit_id and unit.unit_id = mapping.mapping_unit and mapping.mapping_it_support = user.user_id and user.user_id = '".$user->user_id."' order by pc_update_tanggal asc");
        }
        return $data->result();
    }

    public function getPemeliharaanTerlama()
    {
        $user = $this->session->userdata('sesi');
        if($user->user_privilage == 1)
        {
            $data = $this->db->query('select * from pc,unit where pc.unit_id = unit.unit_id order by pc_pemeliharaan_tanggal asc');
        }
        else
        {
            $data = $this->db->query("select * from pc,unit,mapping,user where pc.unit_id = unit.unit_id and unit.unit_id = mapping.mapping_unit and mapping.mapping_it_support = user.user_id and user.user_id = '".$user->user_id."' order by pc_pemeliharaan_tanggal asc");
        }
        return $data->result();
    }

    public function getUtilitasTerlama()
    {
        $user = $this->session->userdata('sesi');
        if($user->user_privilage == 1)
        {
            $data = $this->db->query('select * from pc,unit where pc.unit_id = unit.unit_id order by pc_utilitas_tanggal asc');
        }
        else
        {
            $data = $this->db->query("select * from pc,unit,mapping,user where pc.unit_id = unit.unit_id and unit.unit_id = mapping.mapping_unit and mapping.mapping_it_support = user.user_id and user.user_id = '".$user->user_id."' order by pc_utilitas_tanggal asc");
        }
        return $data->result();
    }

    public function getUninstallTerlama()
    {
        $user = $this->session->userdata('sesi');
        if($user->user_privilage == 1)
        {
            $data = $this->db->query('select * from pc,unit where pc.unit_id = unit.unit_id order by pc_uninstall_tanggal asc');
        }
        else
        {
            $data = $this->db->query("select * from pc,unit,mapping,user where pc.unit_id = unit.unit_id and unit.unit_id = mapping.mapping_unit and mapping.mapping_it_support = user.user_id and user.user_id = '".$user->user_id."' order by pc_uninstall_tanggal asc");
        }
        return $data->result();
    }

    public function getRekapInventarisasi()
    {
        $data = $this->db->query("select unit_id, unit_nama, unit_total_pc,(select count(*) from pc where pc.unit_id = un.unit_id group by un.unit_id) as jumlah from unit as un order by (jumlah/unit_total_pc) asc");
        return $data->result();
    }

}
