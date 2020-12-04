<?php

class Prk_model extends CI_Model {

    private $table = "prk";
    private $primary_key = "prk_id";
    private $status_aktif = "prk_isaktif";

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

    public function getByProyek($proyek_id)
    {
        $this->db->where("proyek_id", $proyek_id);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getTotalByBulan($id)
    {
        $data = $this->db->query("select sum(prk_rencana_".$id.") as total from prk");
        return $data->first_row();
    }

    public function getTotalByBulanUnit($bulan)
    {
        $data = $this->db->query("select unit.unit_id,unit_nama,sum(prk_rencana_".$bulan.") as total from unit, prk where unit.unit_id = prk.unit_id");
        return $data->result();
    }

    public function getAllPekerjaanByBulan($bulan)
    {
        $data = $this->db->query("SELECT prk.prk_id as prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, prk_rencana_".$bulan." as prk_rencana,
                                    rencana1.rencana_nilai as rencana_nilai_1, rencana1.rencana_realisasi as rencana_realisasi_1, 
                                    rencana2.rencana_nilai as rencana_nilai_2, rencana2.rencana_realisasi as rencana_realisasi_2,
                                    rencana3.rencana_nilai as rencana_nilai_3, rencana3.rencana_realisasi as rencana_realisasi_3,
                                    rencana4.rencana_nilai as rencana_nilai_4, rencana4.rencana_realisasi as rencana_realisasi_4,
                                    rencana1.rencana_realisasi + rencana2.rencana_realisasi + rencana3.rencana_realisasi + rencana4.rencana_realisasi as realisasi_total
                                    FROM rencana,prk
                                    LEFT JOIN (rencana as rencana1)
                                        ON (rencana1.prk_id = prk.prk_id AND rencana1.rencana_minggu = 1 and rencana1.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana2)
                                        ON (rencana2.prk_id = prk.prk_id AND rencana2.rencana_minggu = 2 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana3)
                                        ON (rencana3.prk_id = prk.prk_id AND rencana3.rencana_minggu = 3 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana4)
                                        ON (rencana4.prk_id = prk.prk_id AND rencana4.rencana_minggu = 4 and rencana2.rencana_bulan = ".$bulan.")
                                    WHERE rencana.prk_id = prk.prk_id and rencana.rencana_bulan = ".$bulan." GROUP BY prk.prk_id");
        return $data->result();
    }

    public function getAllPekerjaanByBulanUnit($bulan,$unit_id)
    {
        $data = $this->db->query("SELECT prk.prk_id as prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, prk_rencana_".$bulan." as prk_rencana,
                                    rencana1.rencana_nilai as rencana_nilai_1, rencana1.rencana_realisasi as rencana_realisasi_1, 
                                    rencana2.rencana_nilai as rencana_nilai_2, rencana2.rencana_realisasi as rencana_realisasi_2,
                                    rencana3.rencana_nilai as rencana_nilai_3, rencana3.rencana_realisasi as rencana_realisasi_3,
                                    rencana4.rencana_nilai as rencana_nilai_4, rencana4.rencana_realisasi as rencana_realisasi_4,
                                    rencana1.rencana_realisasi + rencana2.rencana_realisasi + rencana3.rencana_realisasi + rencana4.rencana_realisasi as realisasi_total
                                    FROM rencana,prk
                                    LEFT JOIN (rencana as rencana1)
                                        ON (rencana1.prk_id = prk.prk_id AND rencana1.rencana_minggu = 1 and rencana1.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana2)
                                        ON (rencana2.prk_id = prk.prk_id AND rencana2.rencana_minggu = 2 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana3)
                                        ON (rencana3.prk_id = prk.prk_id AND rencana3.rencana_minggu = 3 and rencana2.rencana_bulan = ".$bulan.")
                                    LEFT JOIN (rencana as rencana4)
                                        ON (rencana4.prk_id = prk.prk_id AND rencana4.rencana_minggu = 4 and rencana2.rencana_bulan = ".$bulan.")
                                    WHERE rencana.prk_id = prk.prk_id and rencana.rencana_bulan = ".$bulan." and prk.unit_id = '".$unit_id."' GROUP BY prk.prk_id");
        return $data->result();
    }

    public function getRencanaMingguRentangUnit($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT p.prk_id as prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, 
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_total
                                    FROM prk p where unit_id = '".$unit_id."' GROUP BY p.prk_id");  
        return $data->result();
    }

    public function getRencanaMingguRentang($awal,$akhir)
    {
        $data = $this->db->query("SELECT p.prk_id as prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, 
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_total
                                    FROM prk p GROUP BY p.prk_id");  
        return $data->result();
    }

    public function getRencanaBulanRentang($awal, $akhir)
    {
        $data = $this->db->query("select prk.prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, (select sum(rencana_nilai) from rencana where rencana.prk_id = prk.prk_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_bulan,(select sum(akb.akb_nilai) from akb where akb.prk_id = prk.prk_id and akb.akb_bulan <= '".$akhir."' and akb.akb_bulan >= '".$awal."') as total_akb from prk group by prk.prk_id");
        return $data->result();
    }

    public function getRencanaBulanRentangUnit($awal, $akhir, $pic)
    {
        $data = $this->db->query("select prk.prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki, (select sum(rencana_nilai) from rencana where rencana.prk_id = prk.prk_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_bulan,(select sum(akb.akb_nilai) from akb where akb.prk_id = prk.prk_id and akb.akb_bulan <= '".$akhir."' and akb.akb_bulan >= '".$awal."') as total_akb from prk where prk.unit_id = '".$pic."' group by prk.prk_id");
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
        $data = $this->db->query("select prk.prk_id, prk_nama, sum(rencana_nilai) as total_rencana, sum(rencana_realisasi) as total_realisasi, prk_ai, prk_aki from prk, rencana where prk.prk_id = rencana.prk_id and rencana.rencana_bulan='".$bulan."' group by prk.prk_id");
        return $data->result();
    }

    public function getRealisasiAkumulatif($dari, $hingga)
    {
        $data = $this->db->query("select prk.prk_id, prk_nama, sum(rencana_nilai) as total_rencana, sum(rencana_realisasi) as total_realisasi, prk_ai, prk_aki from prk, rencana where prk.prk_id = rencana.prk_id and rencana.rencana_bulan >='".$dari."' and rencana.rencana_bulan <= '".$hingga."' group by prk.prk_id");
        return $data->result();
    }

    public function getRekapTotal()
    {
        $data = $this->db->query("SELECT sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana) as total_realisasi, (select sum(rencana_nilai) from rencana) as total_rencana  FROM prk");
        return $data->first_row();
    }

    public function getRekapTotalByPic($unit_id)
    {
        $data = $this->db->query("SELECT sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.unit_id = '".$unit_id."') as total_realisasi, (select sum(rencana_nilai) from rencana, prk where prk.prk_id = rencana.prk_id and prk.unit_id = '".$unit_id."') as total_rencana  FROM prk WHERE prk.unit_id = '".$unit_id."'");
        return $data->first_row();
    }

    public function getRekapTotalByPicPeriodic($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana, prk where prk.prk_id = rencana.prk_id and prk.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana, (select sum(akb_nilai) from akb, prk where akb.prk_id = prk.prk_id and prk.unit_id = '".$unit_id."' and akb.akb_bulan >='".$awal."' and akb.akb_bulan <= '".$akhir."') as total_akb  FROM prk WHERE prk.unit_id = '".$unit_id."'");
        return $data->first_row();
    }

    public function getRekapTotalPeriodic($awal,$akhir)
    {
        $data = $this->db->query("SELECT sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana, prk where prk.prk_id = rencana.prk_id and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana, (select sum(akb_nilai) from akb, prk where akb.prk_id = prk.prk_id and akb.akb_bulan >='".$awal."' and akb.akb_bulan <= '".$akhir."') as total_akb  FROM prk");
        return $data->first_row();
    }

    public function getRekapMingguanPeriodic($awal, $akhir)
    {
        $data = $this->db->query("select sum(prk_ai) as total_ai,
         sum(prk_aki) as total_aki,
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
            from prk p
            ");
        return $data->first_row();
    }

    public function getRekapMingguanPeriodicUnit($awal, $akhir, $pic)
    {
        $data = $this->db->query("select sum(prk_ai) as total_ai,
         sum(prk_aki) as total_aki,
         (select sum(rencana.rencana_nilai) from rencana,prk where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana,prk where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana,prk where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana,prk where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana,prk where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana,prk  where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana,prk where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana,prk where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana,prk where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana,prk where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = prk.prk_id and prk.unit_id = '".$pic."') as realisasi_total
            from prk p where p.unit_id = '".$pic."'
            ");
        return $data->first_row();
    }

    public function getRekapPerPIC()
    {
        $data = $this->db->query("SELECT prk.unit_id as pic, unit.unit_nama, sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.unit_id = pic) as total_realisasi, (select sum(rencana_nilai) from rencana , prk where prk.prk_id = rencana.prk_id and prk.unit_id = pic) as total_rencana  FROM prk, unit WHERE unit.unit_id = prk.unit_id group by (prk.unit_id)");
        return $data->result();
    }

    // menampilkan rekap per fungsi

    public function getRekapPerFungsi()
    {
        $data = $this->db->query("SELECT prk.fungsi_id as fungsi, fungsi.fungsi_nama, sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi) as total_realisasi, (select sum(rencana_nilai) from rencana , prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi) as total_rencana  FROM prk, fungsi WHERE fungsi.fungsi_id = prk.fungsi_id group by (prk.fungsi_id)");
        return $data->result();
    }

    public function getRekapPerFungsiByPic($unit_id)
    {
        $data = $this->db->query("SELECT prk.fungsi_id as fungsi, fungsi.fungsi_nama, sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi and prk.unit_id = '".$unit_id."') as total_realisasi, (select sum(rencana_nilai) from rencana , prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi and prk.unit_id = '".$unit_id."') as total_rencana  FROM prk, fungsi WHERE fungsi.fungsi_id = prk.fungsi_id and prk.unit_id = ".$unit_id." group by (prk.fungsi_id)");
        return $data->result();
    }



    public function getRekapPerFungsiByPicPeriodic($unit_id,$awal,$akhir)
    {
        $data = $this->db->query("SELECT prk.fungsi_id as fungsi, fungsi.fungsi_nama, sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi and prk.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana , prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi and prk.unit_id = '".$unit_id."' and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana  FROM prk, fungsi WHERE fungsi.fungsi_id = prk.fungsi_id and prk.unit_id = ".$unit_id." group by (prk.fungsi_id)");
        return $data->result();
    }

    public function getRekapPerFungsiPeriodic($awal,$akhir)
    {
        $data = $this->db->query("SELECT prk.fungsi_id as fungsi, fungsi.fungsi_nama, sum(prk_ai) as total_ai, sum(prk_aki) as total_aki, (select sum(rencana_realisasi) from rencana, prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_realisasi, (select sum(rencana_nilai) from rencana , prk where prk.prk_id = rencana.prk_id and prk.fungsi_id = fungsi  and rencana.rencana_bulan >='".$awal."' and rencana.rencana_bulan <= '".$akhir."') as total_rencana  FROM prk, fungsi WHERE fungsi.fungsi_id = prk.fungsi_id group by (prk.fungsi_id)");
        return $data->result();
    }

    public function getPrkDetail()
    {   
        $data = $this->db->query("select prk.prk_no_prk, 
            prk.prk_id ,
            prk_nama, 
            prk.prk_aki, 
            prk.prk_ai, 
            unit_nama, 
            fungsi_nama,
            sum(rencana.rencana_nilai) as total_rencana, 
            sum(rencana.rencana_realisasi) as total_realisasi,
            (select akb_nilai from akb where akb_bulan = 1 and akb.prk_id = prk.prk_id) as akb_1,
            (select akb_nilai from akb where akb_bulan = 2 and akb.prk_id = prk.prk_id) as akb_2,
            (select akb_nilai from akb where akb_bulan = 3 and akb.prk_id = prk.prk_id) as akb_3,
            (select akb_nilai from akb where akb_bulan = 4 and akb.prk_id = prk.prk_id) as akb_4,
            (select akb_nilai from akb where akb_bulan = 5 and akb.prk_id = prk.prk_id) as akb_5,
            (select akb_nilai from akb where akb_bulan = 6 and akb.prk_id = prk.prk_id) as akb_6,
            (select akb_nilai from akb where akb_bulan = 7 and akb.prk_id = prk.prk_id) as akb_7,
            (select akb_nilai from akb where akb_bulan = 8 and akb.prk_id = prk.prk_id) as akb_8,
            (select akb_nilai from akb where akb_bulan = 9 and akb.prk_id = prk.prk_id) as akb_9,
            (select akb_nilai from akb where akb_bulan = 10 and akb.prk_id = prk.prk_id) as akb_10,
            (select akb_nilai from akb where akb_bulan = 11 and akb.prk_id = prk.prk_id) as akb_11,
            (select akb_nilai from akb where akb_bulan = 12 and akb.prk_id = prk.prk_id) as akb_12
            from rencana, prk, unit , fungsi
            WHERE prk.prk_id = rencana.prk_id and prk.unit_id = unit.unit_id and fungsi.fungsi_id = prk.fungsi_id
            group by prk.prk_id");
        return $data->result();
    }

    public function getPrkDetailPerUnit($unit_id)
    {
        $data = $this->db->query("select prk.prk_no_prk, 
            prk.prk_id ,
            prk_nama, 
            prk.prk_aki, 
            prk.prk_ai, 
            unit_nama, 
            fungsi_nama,
            sum(rencana.rencana_nilai) as total_rencana, 
            sum(rencana.rencana_realisasi) as total_realisasi,
            (select akb_nilai from akb where akb_bulan = 1 and akb.prk_id = prk.prk_id) as akb_1,
            (select akb_nilai from akb where akb_bulan = 2 and akb.prk_id = prk.prk_id) as akb_2,
            (select akb_nilai from akb where akb_bulan = 3 and akb.prk_id = prk.prk_id) as akb_3,
            (select akb_nilai from akb where akb_bulan = 4 and akb.prk_id = prk.prk_id) as akb_4,
            (select akb_nilai from akb where akb_bulan = 5 and akb.prk_id = prk.prk_id) as akb_5,
            (select akb_nilai from akb where akb_bulan = 6 and akb.prk_id = prk.prk_id) as akb_6,
            (select akb_nilai from akb where akb_bulan = 7 and akb.prk_id = prk.prk_id) as akb_7,
            (select akb_nilai from akb where akb_bulan = 8 and akb.prk_id = prk.prk_id) as akb_8,
            (select akb_nilai from akb where akb_bulan = 9 and akb.prk_id = prk.prk_id) as akb_9,
            (select akb_nilai from akb where akb_bulan = 10 and akb.prk_id = prk.prk_id) as akb_10,
            (select akb_nilai from akb where akb_bulan = 11 and akb.prk_id = prk.prk_id) as akb_11,
            (select akb_nilai from akb where akb_bulan = 12 and akb.prk_id = prk.prk_id) as akb_12
            from rencana, prk, unit , fungsi
            WHERE prk.prk_id = rencana.prk_id and prk.unit_id = unit.unit_id and fungsi.fungsi_id = prk.fungsi_id and prk.unit_id = '".$unit_id."'
            group by prk.prk_id");
        return $data->result();
    }

    public function getPrkDetailPerBulanUnit($bulan,$unit_id)
    {
        $data = $this->db->query("select prk.prk_no_prk, prk.prk_id,prk_nama, prk.prk_aki, prk.prk_ai, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi, prk_rencana_1, prk_rencana_2, prk_rencana_3, prk_rencana_4, prk_rencana_5, prk_rencana_6, prk_rencana_7, prk_rencana_8, prk_rencana_9, prk_rencana_10, prk_rencana_11, prk_rencana_12, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, prk WHERE prk.prk_id = rencana.prk_id and unit_id = '".$unit_id."' and rencana_bulan = '".$bulan."' group by prk.prk_id");
        return $data->result();
    }

    public function getPrkDetailPerBulan($bulan)
    {
        $data = $this->db->query("select prk.prk_no_prk, prk.prk_id,prk_nama, prk.prk_aki, prk.prk_ai, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi, prk_rencana_1, prk_rencana_2, prk_rencana_3, prk_rencana_4, prk_rencana_5, prk_rencana_6, prk_rencana_7, prk_rencana_8, prk_rencana_9, prk_rencana_10, prk_rencana_11, prk_rencana_12, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, prk WHERE prk.prk_id = rencana.prk_id and rencana_bulan = '".$bulan."' group by prk.prk_id");
        return $data->result();
    }

    // untuk realisasi bulanan
    public function getRealisasiBulanRentang($awal, $akhir)
    {
        $data = $this->db->query("select prk.prk_id, prk_no_prk,prk_no_prk_kontrak, prk_jenis, fungsi.fungsi_id, fungsi_nama,prk_nama,prk_ai,prk_aki, prk_nilai_kontrak, vendor_id, unit.unit_id, unit_nama, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, prk, fungsi, unit where prk.prk_id = rencana.prk_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and fungsi.fungsi_id = prk.fungsi_id and unit.unit_id = prk.unit_id group by prk.prk_id");
        return $data->result();
    }

    public function getRealisasiBulanRentangUnit($awal, $akhir,$unit_id)
    {
        $data = $this->db->query("select prk.prk_id, prk_no_prk, prk_no_prk_kontrak, prk_jenis, fungsi.fungsi_id, fungsi_nama, prk_nama,prk_ai,prk_aki, prk_nilai_kontrak, vendor_id, unit.unit_id, unit_nama, sum(rencana.rencana_nilai) as total_rencana, sum(rencana.rencana_realisasi) as total_realisasi from rencana, prk, fungsi, unit where prk.prk_id = rencana.prk_id and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and prk.unit_id = unit.unit_id and fungsi.fungsi_id = prk.fungsi_id and prk.unit_id = '".$unit_id."' group by prk.prk_id");
        return $data->result();
    }

    // untuk realisasi mingguan
    public function getRealisasiMingguRentangUnit($awal,$akhir,$unit_id)
    {
        $data = $this->db->query("SELECT p.prk_id as prk_id, prk_no_prk, prk_nama,prk_ai,prk_aki,prk_jenis,prk_no_prk_kontrak, unit_nama,fungsi_nama,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."') as realisasi_total
                                    FROM prk p, fungsi,unit where p.unit_id = '".$unit_id."' and fungsi.fungsi_id = p.fungsi_id and p.unit_id = unit.unit_id  GROUP BY p.prk_id");  
        return $data->result();
    }

    public function getRealisasiMingguRentang($awal,$akhir)
    {
        $data = $this->db->query("SELECT p.prk_id as prk_id, prk_no_prk, unit_nama,fungsi_nama,prk_nama,prk_ai,prk_aki,prk_jenis,prk_no_prk_kontrak,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_1,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 1 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_1,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 2 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_2,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 2 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_2,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 3 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_3,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 3 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_3,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_minggu = 4 and rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_nilai_4,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_minggu = 4 and 
                        rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_nilai_4,
                    (select sum(rencana.rencana_nilai) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as rencana_total,
                    (select sum(rencana.rencana_realisasi) from rencana where rencana.rencana_bulan <= '".$akhir."' and rencana.rencana_bulan >= '".$awal."' and rencana.prk_id = p.prk_id) as realisasi_total
                                    FROM prk p,fungsi,unit where fungsi.fungsi_id = p.fungsi_id and p.unit_id = unit.unit_id GROUP BY p.prk_id");
        return $data->result();
    }

    public function isPrkExsist($prk_no_prk)
    {
        $this->db->where('prk_no_prk',$prk_no_prk);
        $query = $this->db->get('prk');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function updateByNoPrk($prk_no_prk,$data)
    {
        $this->db->where('prk_no_prk', $prk_no_prk);
        $this->db->update($this->table, $data);
    }

    public function search($data_search)
    {
        $this->db->like($data_search);
        $data = $this->db->get($this->table);
        return $data->result();
    }

    public function getTotalRealisasi($prk_id)
    {
        $data = $this->db->query("select sum(rencana_realisasi) as total_realisasi from rencana where prk_id='".$prk_id."'");
        return $data->first_row();
    }
}
