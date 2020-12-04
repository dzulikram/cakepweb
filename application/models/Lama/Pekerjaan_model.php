<?php

class Pekerjaan_model extends CI_Model {

    private $table = "pekerjaan";
    private $primary_key = "pekerjaan_id";
    private $status_aktif = "pekerjaan_isaktif";

    public function getAllAktif() {
        $this->db->where($this->status_aktif, 1);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getAll() {
        $data = $this->db->get($this->table);
        return $data->result();
    } 

    public function getByNoPrk($pekerjaan_no)
    {
        $this->db->where("pekerjaan_no", $pekerjaan_no);
        $query = $this->db->get($this->table);
        $result = $query->result();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
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

    public function deleteByPrk($id) {
        //$this->db->where("proyek_id",$id);
        $query = $this->db->delete($this->table,array("pekerjaan_id" => $id));
        return $query;
    }

    public function get_table_name() {
        return $this->table;
    }

    public function get_primary_key() {
        return $this->primary_key;
    }

    public function getTotalByBulan($id)
    {
        $data = $this->db->query("select sum(pekerjaan_rencana_".$id.") as total from pekerjaan");
        return $data->first_row();
    }

    public function getTotalByBulanUnit($bulan)
    {
        $data = $this->db->query("select unit.unit_id,unit_nama,sum(pekerjaan_rencana_".$bulan.") as total from unit, pekerjaan where unit.unit_id = pekerjaan.unit_id");
        return $data->result();
    }

    public function getAllPekerjaanByBulan($bulan)
    {
        $data = $this->db->query("SELECT pekerjaan.pekerjaan_id as pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, pekerjaan_rencana_".$bulan." as pekerjaan_rencana,
                                    rencana1.rencana_nilai as rencana_nilai_1, rencana1.rencana_realisasi as rencana_realisasi_1, 
                                    rencana2.rencana_nilai as rencana_nilai_2, rencana2.rencana_realisasi as rencana_realisasi_2,
                                    rencana3.rencana_nilai as rencana_nilai_3, rencana3.rencana_realisasi as rencana_realisasi_3,
                                    rencana4.rencana_nilai as rencana_nilai_4, rencana4.rencana_realisasi as rencana_realisasi_4,
                                    rencana1.rencana_realisasi + rencana2.rencana_realisasi + rencana3.rencana_realisasi + rencana4.rencana_realisasi as realisasi_total
                                    FROM rencana,pekerjaan
                                    LEFT JOIN (rencana as rencana1)
                                        ON (rencana1.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana1.rencana_minggu = 1 and rencana1.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana2)
                                        ON (rencana2.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana2.rencana_minggu = 2 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana3)
                                        ON (rencana3.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana3.rencana_minggu = 3 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana4)
                                        ON (rencana4.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana4.rencana_minggu = 4 and rencana2.rencana_bulan = ".$bulan.")
                                    WHERE rencana.pekerjaan_id = pekerjaan.pekerjaan_id and rencana.rencana_bulan = ".$bulan." GROUP BY pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getAllPekerjaanByBulanUnit($bulan,$unit_id)
    {
    	$data = $this->db->query("SELECT pekerjaan.pekerjaan_id as pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, pekerjaan_rencana_".$bulan." as pekerjaan_rencana,
                                    rencana1.rencana_nilai as rencana_nilai_1, rencana1.rencana_realisasi as rencana_realisasi_1, 
                                    rencana2.rencana_nilai as rencana_nilai_2, rencana2.rencana_realisasi as rencana_realisasi_2,
                                    rencana3.rencana_nilai as rencana_nilai_3, rencana3.rencana_realisasi as rencana_realisasi_3,
                                    rencana4.rencana_nilai as rencana_nilai_4, rencana4.rencana_realisasi as rencana_realisasi_4,
                                    rencana1.rencana_realisasi + rencana2.rencana_realisasi + rencana3.rencana_realisasi + rencana4.rencana_realisasi as realisasi_total
                                    FROM rencana,pekerjaan
                                    LEFT JOIN (rencana as rencana1)
                                        ON (rencana1.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana1.rencana_minggu = 1 and rencana1.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana2)
                                        ON (rencana2.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana2.rencana_minggu = 2 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana3)
                                        ON (rencana3.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana3.rencana_minggu = 3 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana4)
                                        ON (rencana4.pekerjaan_id = pekerjaan.pekerjaan_id AND rencana4.rencana_minggu = 4 and rencana2.rencana_bulan = ".$bulan.")
                                    WHERE rencana.pekerjaan_id = pekerjaan.pekerjaan_id and rencana.rencana_bulan = ".$bulan." and pekerjaan.unit_id = '".$unit_id."' GROUP BY pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getRencanaMingguRentangUnit($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT p.pekerjaan_id as pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, 
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_total
                                    FROM pekerjaan p where unit_id = '".$unit_id."' GROUP BY p.pekerjaan_id");  
        return $data->result();
    }

    public function getRencanaMingguRentang($awal,$akhir)
    {
        $data = $this->db->query("SELECT p.pekerjaan_id as pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, 
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_total
                                    FROM pekerjaan p GROUP BY p.pekerjaan_id");  
        return $data->result();
    }

    public function getRencanaBulanRentang($awal, $akhir)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, (select sum(rencana_nilai) from rencana where rencana.pekerjaan_id = pekerjaan.pekerjaan_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_bulan,(select sum(akb.akb_nilai) from akb where akb.pekerjaan_id = pekerjaan.pekerjaan_id and akb.akb_bulan <= '".$akhir."' and akb.akb_bulan >= '".$awal."') as total_akb from pekerjaan group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getRencanaBulanRentangUnit($awal, $akhir, $pic)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, (select sum(rencana_nilai) from rencana where rencana.pekerjaan_id = pekerjaan.pekerjaan_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_bulan,(select sum(akb.akb_nilai) from akb where akb.pekerjaan_id = pekerjaan.pekerjaan_id and akb.akb_bulan <= '".$akhir."' and akb.akb_bulan >= '".$awal."') as total_akb from pekerjaan where pekerjaan.unit_id = '".$pic."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getByUnit($unit_id)
    {
        $this->db->where("unit_id",$unit_id);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getPekerjaanTotalRealisasiByBulan($bulan)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_uraian, sum(rencana_nilai) as total_rencana, sum(rencana_realisasi) as total_realisasi, pekerjaan_ai, pekerjaan_aki from pekerjaan, rencana where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan='".$bulan."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getRealisasiAkumulatif($dari, $hingga)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_uraian, sum(rencana_nilai) as total_rencana, sum(rencana_realisasi) as total_realisasi, pekerjaan_ai, pekerjaan_aki from pekerjaan, rencana where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan >='".$dari."' and rencana.rencana_bulan <= '".$hingga."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getRekapTotal()
    {
        $data = $this->db->query("SELECT sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana) as total_realisasi, (select sum(rencana_nilai) from rencana) as total_rencana  FROM pekerjaan");
        return $data->first_row();
    }

    public function getRekapTotalByPic($unit_id)
    {
        $data = $this->db->query("SELECT sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = '".$unit_id."') as total_realisasi, (select sum(rencana_nilai) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = '".$unit_id."') as total_rencana  FROM pekerjaan WHERE pekerjaan.unit_id = '".$unit_id."'");
        return $data->first_row();
    }

    public function getRekapTotalByPicPeriodic($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana, (select sum(akb_nilai) from akb, pekerjaan where akb.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$unit_id."' and akb.akb_bulan >='".$awal."' and akb.akb_bulan <= '".$akhir."') as total_akb  FROM pekerjaan WHERE pekerjaan.unit_id = '".$unit_id."'");
        return $data->first_row();
    }

    public function getRekapTotalPeriodic($awal,$akhir)
    {
        $data = $this->db->query("SELECT sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana, (select sum(akb_nilai) from akb, pekerjaan where akb.pekerjaan_id = pekerjaan.pekerjaan_id and akb.akb_bulan >='".$awal."' and akb.akb_bulan <= '".$akhir."') as total_akb  FROM pekerjaan");
        return $data->first_row();
    }

    public function getRekapMingguanPeriodic($awal, $akhir)
    {
        $data = $this->db->query("select sum(pekerjaan_ai) as total_ai,
         sum(pekerjaan_aki) as total_aki,
         (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_total
            from pekerjaan p
            ");
        return $data->first_row();
    }

    public function getRekapMingguanPeriodicUnit($awal, $akhir, $pic)
    {
        $data = $this->db->query("select sum(pekerjaan_ai) as total_ai,
         sum(pekerjaan_aki) as total_aki,
         (select sum(rencana.rencana_nilai) from rencana,pekerjaan where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana,pekerjaan where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana,pekerjaan where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana,pekerjaan where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana,pekerjaan where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana,pekerjaan  where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana,pekerjaan where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana,pekerjaan where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana,pekerjaan where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana,pekerjaan where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = pekerjaan.pekerjaan_id and pekerjaan.unit_id = '".$pic."') as realisasi_total
            from pekerjaan p where p.unit_id = '".$pic."'
            ");
        return $data->first_row();
    }

    public function getRekapPerPIC()
    {
        $data = $this->db->query("SELECT pekerjaan.unit_id as pic, unit.unit_nama, sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = pic) as total_realisasi, (select sum(rencana_nilai) from rencana , pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = pic) as total_rencana  FROM pekerjaan, unit WHERE unit.unit_id = pekerjaan.unit_id group by (pekerjaan.unit_id)");
        return $data->result();
    }

    // menampilkan rekap per fungsi

    public function getRekapPerFungsi()
    {
        $data = $this->db->query("SELECT pekerjaan.fungsi_id as fungsi, fungsi.fungsi_nama, sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi) as total_realisasi, (select sum(rencana_nilai) from rencana , pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi) as total_rencana  FROM pekerjaan, fungsi WHERE fungsi.fungsi_id = pekerjaan.fungsi_id group by (pekerjaan.fungsi_id)");
        return $data->result();
    }

    public function getRekapPerFungsiByPic($unit_id)
    {
        $data = $this->db->query("SELECT pekerjaan.fungsi_id as fungsi, fungsi.fungsi_nama, sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi and pekerjaan.unit_id = '".$unit_id."') as total_realisasi, (select sum(rencana_nilai) from rencana , pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi and pekerjaan.unit_id = '".$unit_id."') as total_rencana  FROM pekerjaan, fungsi WHERE fungsi.fungsi_id = pekerjaan.fungsi_id and pekerjaan.unit_id = ".$unit_id." group by (pekerjaan.fungsi_id)");
        return $data->result();
    }



    public function getRekapPerFungsiByPicPeriodic($unit_id,$awal,$akhir)
    {
        $data = $this->db->query("SELECT pekerjaan.fungsi_id as fungsi, fungsi.fungsi_nama, sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi and pekerjaan.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana , pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi and pekerjaan.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana  FROM pekerjaan, fungsi WHERE fungsi.fungsi_id = pekerjaan.fungsi_id and pekerjaan.unit_id = ".$unit_id." group by (pekerjaan.fungsi_id)");
        return $data->result();
    }

    public function getRekapPerFungsiPeriodic($awal,$akhir)
    {
        $data = $this->db->query("SELECT pekerjaan.fungsi_id as fungsi, fungsi.fungsi_nama, sum(pekerjaan_ai) as total_ai, sum(pekerjaan_aki) as total_aki, (select sum(rencana_realisasi) from rencana, pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana , pekerjaan where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.fungsi_id = fungsi  and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana  FROM pekerjaan, fungsi WHERE fungsi.fungsi_id = pekerjaan.fungsi_id group by (pekerjaan.fungsi_id)");
        return $data->result();
    }

    public function getPrkDetail()
    {   
        $data = $this->db->query("select pekerjaan.pekerjaan_no, 
            pekerjaan.pekerjaan_id ,
            pekerjaan_uraian, 
            pekerjaan.pekerjaan_aki, 
            pekerjaan.pekerjaan_ai, 
            unit_nama, 
            fungsi_nama,
            sum(rencana.rencana_nilai) as total_rencana, 
            sum(rencana.rencana_realisasi) as total_realisasi,
            (select akb_nilai from akb where akb_bulan = 1 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_1,
            (select akb_nilai from akb where akb_bulan = 2 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_2,
            (select akb_nilai from akb where akb_bulan = 3 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_3,
            (select akb_nilai from akb where akb_bulan = 4 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_4,
            (select akb_nilai from akb where akb_bulan = 5 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_5,
            (select akb_nilai from akb where akb_bulan = 6 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_6,
            (select akb_nilai from akb where akb_bulan = 7 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_7,
            (select akb_nilai from akb where akb_bulan = 8 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_8,
            (select akb_nilai from akb where akb_bulan = 9 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_9,
            (select akb_nilai from akb where akb_bulan = 10 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_10,
            (select akb_nilai from akb where akb_bulan = 11 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_11,
            (select akb_nilai from akb where akb_bulan = 12 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_12
            from rencana, pekerjaan, unit , fungsi
            WHERE pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = unit.unit_id and fungsi.fungsi_id = pekerjaan.fungsi_id
            group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getPrkDetailPerUnit($unit_id)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_no, 
            pekerjaan.pekerjaan_id ,
            pekerjaan_uraian, 
            pekerjaan.pekerjaan_aki, 
            pekerjaan.pekerjaan_ai, 
            unit_nama, 
            fungsi_nama,
            sum(rencana.rencana_nilai) as total_rencana, 
            sum(rencana.rencana_realisasi) as total_realisasi,
            (select akb_nilai from akb where akb_bulan = 1 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_1,
            (select akb_nilai from akb where akb_bulan = 2 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_2,
            (select akb_nilai from akb where akb_bulan = 3 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_3,
            (select akb_nilai from akb where akb_bulan = 4 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_4,
            (select akb_nilai from akb where akb_bulan = 5 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_5,
            (select akb_nilai from akb where akb_bulan = 6 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_6,
            (select akb_nilai from akb where akb_bulan = 7 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_7,
            (select akb_nilai from akb where akb_bulan = 8 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_8,
            (select akb_nilai from akb where akb_bulan = 9 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_9,
            (select akb_nilai from akb where akb_bulan = 10 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_10,
            (select akb_nilai from akb where akb_bulan = 11 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_11,
            (select akb_nilai from akb where akb_bulan = 12 and akb.pekerjaan_id = pekerjaan.pekerjaan_id) as akb_12
            from rencana, pekerjaan, unit , fungsi
            WHERE pekerjaan.pekerjaan_id = rencana.pekerjaan_id and pekerjaan.unit_id = unit.unit_id and fungsi.fungsi_id = pekerjaan.fungsi_id and pekerjaan.unit_id = '".$unit_id."'
            group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getPrkDetailPerBulanUnit($bulan,$unit_id)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_no, pekerjaan.pekerjaan_id,pekerjaan_uraian, pekerjaan.pekerjaan_aki, pekerjaan.pekerjaan_ai, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi, pekerjaan_rencana_1, pekerjaan_rencana_2, pekerjaan_rencana_3, pekerjaan_rencana_4, pekerjaan_rencana_5, pekerjaan_rencana_6, pekerjaan_rencana_7, pekerjaan_rencana_8, pekerjaan_rencana_9, pekerjaan_rencana_10, pekerjaan_rencana_11, pekerjaan_rencana_12, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, pekerjaan WHERE pekerjaan.pekerjaan_id = rencana.pekerjaan_id and unit_id = '".$unit_id."' and rencana_bulan = '".$bulan."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getPrkDetailPerBulan($bulan)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_no, pekerjaan.pekerjaan_id,pekerjaan_uraian, pekerjaan.pekerjaan_aki, pekerjaan.pekerjaan_ai, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi, pekerjaan_rencana_1, pekerjaan_rencana_2, pekerjaan_rencana_3, pekerjaan_rencana_4, pekerjaan_rencana_5, pekerjaan_rencana_6, pekerjaan_rencana_7, pekerjaan_rencana_8, pekerjaan_rencana_9, pekerjaan_rencana_10, pekerjaan_rencana_11, pekerjaan_rencana_12, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, pekerjaan WHERE pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana_bulan = '".$bulan."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    // untuk realisasi bulanan
    public function getRealisasiBulanRentang($awal, $akhir)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_no,pekerjaan_no_kontrak, pekerjaan_jenis, fungsi.fungsi_id, fungsi_nama,pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, pekerjaan_nilai_kontrak, vendor_id, unit.unit_id, unit_nama, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, pekerjaan, fungsi, unit where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and fungsi.fungsi_id = pekerjaan.fungsi_id and unit.unit_id = pekerjaan.unit_id group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    public function getRealisasiBulanRentangUnit($awal, $akhir,$unit_id)
    {
        $data = $this->db->query("select pekerjaan.pekerjaan_id, pekerjaan_no, pekerjaan_no_kontrak, pekerjaan_jenis, fungsi.fungsi_id, fungsi_nama, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki, pekerjaan_nilai_kontrak, vendor_id, unit.unit_id, unit_nama, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, pekerjaan, fungsi, unit where pekerjaan.pekerjaan_id = rencana.pekerjaan_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and pekerjaan.unit_id = unit.unit_id and fungsi.fungsi_id = pekerjaan.fungsi_id and pekerjaan.unit_id = '".$unit_id."' group by pekerjaan.pekerjaan_id");
        return $data->result();
    }

    // untuk realisasi mingguan
    public function getRealisasiMingguRentangUnit($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT p.pekerjaan_id as pekerjaan_id, pekerjaan_no, pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki,pekerjaan_jenis,pekerjaan_no_kontrak, unit_nama,fungsi_nama,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_total
                                    FROM pekerjaan p, fungsi,unit where p.unit_id = '".$unit_id."' and fungsi.fungsi_id = p.fungsi_id and p.unit_id = unit.unit_id  GROUP BY p.pekerjaan_id");  
        return $data->result();
    }

    public function getRealisasiMingguRentang($awal,$akhir)
    {
        $data = $this->db->query("SELECT p.pekerjaan_id as pekerjaan_id, pekerjaan_no, unit_nama,fungsi_nama,pekerjaan_uraian,pekerjaan_ai,pekerjaan_aki,pekerjaan_jenis,pekerjaan_no_kontrak,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.pekerjaan_id = p.pekerjaan_id) as realisasi_total
                                    FROM pekerjaan p,fungsi,unit where fungsi.fungsi_id = p.fungsi_id and p.unit_id = unit.unit_id GROUP BY p.pekerjaan_id");
        return $data->result();
    }

    public function isPrkExsist($pekerjaan_no)
    {
        $this->db->where('pekerjaan_no',$pekerjaan_no);
        $query = $this->db->get('pekerjaan');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function updateByNoPrk($prk_no,$data)
    {
        $this->db->where('pekerjaan_no', $prk_no);
        $this->db->update($this->table, $data);
    }

    public function search($data_search)
    {
        $this->db->like($data_search);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getTotalRealisasi($pekerjaan_id)
    {
        $data = $this->db->query("select sum(rencana_realisasi) as total_realisasi from rencana where pekerjaan_id='".$pekerjaan_id."'");
        return $data->first_row();
    }

}
