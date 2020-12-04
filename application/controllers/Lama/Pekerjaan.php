    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    private $_folder_view = "pekerjaan/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
        $this->load->model('Vendor_model');
        $this->load->model('Fungsi_model');
        $this->load->model('Unit_model');
        $this->load->model('Rencana_model');
    }

    public function init_page($page) {
        /**
         * parameter $page berupa array yang mengandung 
         * page view dan array data untuk masing masing view
         */
        if($this->session->userdata('sesi'))
        {
            $this->load->view('header_view');
            $this->load->view('sidebar_view');
            foreach ($page as $p) {
                $this->load->view($p['view'], $p['data']);
            }
            $this->load->view('footer_view');
        }
        else
        {
            redirect('login');
        }
    }

    public function index() {
        if ($this->session->userdata('sesi')) {
            redirect('pekerjaan/daftar_pekerjaan');
        } else {
            redirect('login');
        }
    }

    public function daftar_pekerjaan()
    {
        $page = array();
        $data = array();
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function tambah_pekerjaan()
    {
        $page = array();
        $data = array();
        $data['semua_vendor'] = $this->Vendor_model->getAll();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function aksi_tambah_pekerjaan()
    {
        $pekerjaan_no = $this->input->post('pekerjaan_no');
        $pekerjaan_uraian = $this->input->post('pekerjaan_uraian');
        $pekerjaan_nilai_kontrak = $this->input->post('pekerjaan_nilai_kontrak');
        $pekerjaan_ai = $this->input->post('pekerjaan_ai');
        $pekerjaan_aki = $this->input->post('pekerjaan_aki');
        $pekerjaan_mulai = $this->input->post('pekerjaan_mulai');
        $pekerjaan_selesai = $this->input->post('pekerjaan_selesai');
        $pekerjaan_jenis = $this->input->post('pekerjaan_jenis');
        $vendor_id = $this->input->post('vendor_id');
        $fungsi_id = $this->input->post('fungsi_id');
        $unit_id = $this->input->post('unit_id');
        $data_insert = array(
            "pekerjaan_no" => $pekerjaan_no,
            "pekerjaan_uraian" => $pekerjaan_uraian,
            "pekerjaan_nilai_kontrak" => $pekerjaan_nilai_kontrak,
            "pekerjaan_ai" => $pekerjaan_ai,
            "pekerjaan_aki" => $pekerjaan_aki,
            "pekerjaan_mulai" => $pekerjaan_mulai,
            "pekerjaan_selesai" => $pekerjaan_selesai,
            "pekerjaan_jenis" => $pekerjaan_jenis,
            "fungsi_id" => $fungsi_id,
            "vendor_id" => $vendor_id,
            "unit_id" => $unit_id
            );
        $pekerjaan_id = $this->Pekerjaan_model->insert($data_insert);
        for($i=0;$i<12;$i++)
        {
            for($j=0;$j<4;$j++)
            {
                $data_insert = array(
                    "pekerjaan_id" => $pekerjaan_id,
                    "rencana_minggu" => $j+1,
                    "rencana_bulan" => $i+1
                    );
                $this->Rencana_model->insert($data_insert);
            }
        }
        redirect('pekerjaan/daftar_pekerjaan');
    }

    public function ubah_pekerjaan($id)
    {
        $page = array();
        $data = array();
        $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($id);
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['semua_vendor'] = $this->Vendor_model->getAll();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "ubah_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function aksi_ubah_pekerjaan()
    {
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        $pekerjaan_no = $this->input->post('pekerjaan_no');
        $pekerjaan_uraian = $this->input->post('pekerjaan_uraian');
        $pekerjaan_nilai_kontrak = $this->input->post('pekerjaan_nilai_kontrak');
        $pekerjaan_ai = $this->input->post('pekerjaan_ai');
        $pekerjaan_aki = $this->input->post('pekerjaan_aki');
        $pekerjaan_mulai = $this->input->post('pekerjaan_mulai');
        $pekerjaan_selesai = $this->input->post('pekerjaan_selesai');
        $pekerjaan_jenis = $this->input->post('pekerjaan_jenis');
        $vendor_id = $this->input->post('vendor_id');
        $unit_id = $this->input->post('unit_id');
        $fungsi_id = $this->input->post('fungsi_id');
        $pekerjaan_jenis = $this->input->post('pekerjaan_jenis');
        $data_update = array(
            "pekerjaan_no" => $pekerjaan_no,
            "pekerjaan_uraian" => $pekerjaan_uraian,
            "pekerjaan_nilai_kontrak" => $pekerjaan_nilai_kontrak,
            "pekerjaan_ai" => $pekerjaan_ai,
            "pekerjaan_aki" => $pekerjaan_aki,
            "pekerjaan_mulai" => $pekerjaan_mulai,
            "pekerjaan_selesai" => $pekerjaan_selesai,
            "pekerjaan_jenis" => $pekerjaan_jenis,
            "vendor_id" => $vendor_id,
            "unit_id" => $unit_id,
            "fungsi_id" => $fungsi_id,
            "pekerjaan_jenis" => $pekerjaan_jenis
            );
        $this->Pekerjaan_model->update($pekerjaan_id,$data_update);
        //print_r($data_update);
        redirect('pekerjaan/daftar_pekerjaan');
    }

    public function rencana_bulanan($pekerjaan_id)
    {
        $page = array();
        $data = array();
        $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($pekerjaan_id);
        array_push($page, array('view' => $this->_folder_view . "rencana_bulanan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function aksi_rencana_bulanan()
    {
        $pekerjaan_rencana_1 = $this->input->post('pekerjaan_rencana_1');
        $pekerjaan_rencana_2 = $this->input->post('pekerjaan_rencana_2');
        $pekerjaan_rencana_3 = $this->input->post('pekerjaan_rencana_3');
        $pekerjaan_rencana_4 = $this->input->post('pekerjaan_rencana_4');
        $pekerjaan_rencana_5 = $this->input->post('pekerjaan_rencana_5');
        $pekerjaan_rencana_6 = $this->input->post('pekerjaan_rencana_6');
        $pekerjaan_rencana_7 = $this->input->post('pekerjaan_rencana_7');
        $pekerjaan_rencana_8 = $this->input->post('pekerjaan_rencana_8');
        $pekerjaan_rencana_9 = $this->input->post('pekerjaan_rencana_9');
        $pekerjaan_rencana_10 = $this->input->post('pekerjaan_rencana_10');
        $pekerjaan_rencana_11 = $this->input->post('pekerjaan_rencana_11');
        $pekerjaan_rencana_12 = $this->input->post('pekerjaan_rencana_12');
        $pekerjaan_id = $this->input->post('pekerjaan_id');

        $data_update = array(
            "pekerjaan_rencana_1" => $pekerjaan_rencana_1,
            "pekerjaan_rencana_2" => $pekerjaan_rencana_2,
            "pekerjaan_rencana_3" => $pekerjaan_rencana_3,
            "pekerjaan_rencana_4" => $pekerjaan_rencana_4,
            "pekerjaan_rencana_5" => $pekerjaan_rencana_5,
            "pekerjaan_rencana_6" => $pekerjaan_rencana_6,
            "pekerjaan_rencana_7" => $pekerjaan_rencana_7,
            "pekerjaan_rencana_8" => $pekerjaan_rencana_8,
            "pekerjaan_rencana_9" => $pekerjaan_rencana_9,
            "pekerjaan_rencana_10" => $pekerjaan_rencana_10,
            "pekerjaan_rencana_11" => $pekerjaan_rencana_11,
            "pekerjaan_rencana_12" => $pekerjaan_rencana_12
            );
        $this->Pekerjaan_model->update($pekerjaan_id,$data_update);
        redirect('pekerjaan/rencana_bulanan/'.$pekerjaan_id);
    }

    public function rencana_mingguan($pekerjaan_id)
    {
        $page = array();
        $data = array();
        $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($pekerjaan_id);
        $semua_rencana = $this->Rencana_model->getByPekerjaanId($pekerjaan_id);
        $rencana_nilai = array();
        for($i=1;$i<=12;$i++)
        {
            $rencana_nilai[$i] = array();
            for($j=1;$j<=4;$j++)
            {
                foreach ($semua_rencana as $key) 
                {
                    if($key->rencana_bulan == $i && $key->rencana_minggu == $j)
                    {
                        $rencana_nilai[$i][$j] = $key->rencana_nilai;
                        break;
                    }
                }
            }
        }
        $data['rencana_nilai'] = $rencana_nilai;
        array_push($page, array('view' => $this->_folder_view . "rencana_mingguan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function aksi_rencana_mingguan()
    {
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        if($this->input->post('rencana_1_1'))
        {
            $rencana_1_1 = $this->input->post('rencana_1_1');
            $data_update['rencana_nilai'] = $rencana_1_1;
            $this->Rencana_model->updateByPeriode('1','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_1_2'))
        {
            $rencana_1_2 = $this->input->post('rencana_1_2');
            $data_update['rencana_nilai'] = $rencana_1_2;
            $this->Rencana_model->updateByPeriode('1','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_1_3'))
        {
            $rencana_1_3 = $this->input->post('rencana_1_3');
            $data_update['rencana_nilai'] = $rencana_1_3;
            $this->Rencana_model->updateByPeriode('1','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_1_4'))
        {
            $rencana_1_4 = $this->input->post('rencana_1_4');
            $data_update['rencana_nilai'] = $rencana_1_4;
            $this->Rencana_model->updateByPeriode('1','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_2_1'))
        {
            $rencana_2_1 = $this->input->post('rencana_2_1');
            $data_update['rencana_nilai'] = $rencana_2_1;
            $this->Rencana_model->updateByPeriode('2','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_2_2'))
        {
            $rencana_2_2 = $this->input->post('rencana_2_2');
            $data_update['rencana_nilai'] = $rencana_2_2;
            $this->Rencana_model->updateByPeriode('2','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_2_3'))
        {
            $rencana_2_3 = $this->input->post('rencana_2_3');
            $data_update['rencana_nilai'] = $rencana_2_3;
            $this->Rencana_model->updateByPeriode('2','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_2_4'))
        {
            $rencana_2_4 = $this->input->post('rencana_2_4');
            $data_update['rencana_nilai'] = $rencana_2_4;
            $this->Rencana_model->updateByPeriode('2','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_3_1'))
        {
            $rencana_3_1 = $this->input->post('rencana_3_1');
            $data_update['rencana_nilai'] = $rencana_3_1;
            $this->Rencana_model->updateByPeriode('3','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_3_2'))
        {
            $rencana_3_2 = $this->input->post('rencana_3_2');
            $data_update['rencana_nilai'] = $rencana_3_2;
            $this->Rencana_model->updateByPeriode('3','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_3_3'))
        {
            $rencana_3_3 = $this->input->post('rencana_3_3');
            $data_update['rencana_nilai'] = $rencana_3_3;
            $this->Rencana_model->updateByPeriode('3','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_3_4'))
        {
            $rencana_3_4 = $this->input->post('rencana_3_4');
            $data_update['rencana_nilai'] = $rencana_3_4;
            $this->Rencana_model->updateByPeriode('3','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_4_1'))
        {
            $rencana_4_1 = $this->input->post('rencana_4_1');
            $data_update['rencana_nilai'] = $rencana_4_1;
            $this->Rencana_model->updateByPeriode('4','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_4_2'))
        {
            $rencana_4_2 = $this->input->post('rencana_4_2');
            $data_update['rencana_nilai'] = $rencana_4_2;
            $this->Rencana_model->updateByPeriode('4','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_4_3'))
        {
            $rencana_4_3 = $this->input->post('rencana_4_3');
            $data_update['rencana_nilai'] = $rencana_4_3;
            $this->Rencana_model->updateByPeriode('4','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_4_4'))
        {
            $rencana_4_4 = $this->input->post('rencana_4_4');
            $data_update['rencana_nilai'] = $rencana_4_4;
            $this->Rencana_model->updateByPeriode('4','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_5_1'))
        {
            $rencana_5_1 = $this->input->post('rencana_5_1');
            $data_update['rencana_nilai'] = $rencana_5_1;
            $this->Rencana_model->updateByPeriode('5','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_5_2'))
        {
            $rencana_5_2 = $this->input->post('rencana_5_2');
            $data_update['rencana_nilai'] = $rencana_5_2;
            $this->Rencana_model->updateByPeriode('5','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_5_3'))
        {
            $rencana_5_3 = $this->input->post('rencana_5_3');
            $data_update['rencana_nilai'] = $rencana_5_3;
            $this->Rencana_model->updateByPeriode('5','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_5_4'))
        {
            $rencana_5_4 = $this->input->post('rencana_5_4');
            $data_update['rencana_nilai'] = $rencana_5_4;
            $this->Rencana_model->updateByPeriode('5','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_6_1'))
        {
            $rencana_6_1 = $this->input->post('rencana_6_1');
            $data_update['rencana_nilai'] = $rencana_6_1;
            $this->Rencana_model->updateByPeriode('6','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_6_2'))
        {
            $rencana_6_2 = $this->input->post('rencana_6_2');
            $data_update['rencana_nilai'] = $rencana_6_2;
            $this->Rencana_model->updateByPeriode('6','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_6_3'))
        {
            $rencana_6_3 = $this->input->post('rencana_6_3');
            $data_update['rencana_nilai'] = $rencana_6_3;
            $this->Rencana_model->updateByPeriode('6','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_6_4'))
        {
            $rencana_6_4 = $this->input->post('rencana_6_4');
            $data_update['rencana_nilai'] = $rencana_6_4;
            $this->Rencana_model->updateByPeriode('6','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_7_1'))
        {
            $rencana_7_1 = $this->input->post('rencana_7_1');
            $data_update['rencana_nilai'] = $rencana_7_1;
            $this->Rencana_model->updateByPeriode('7','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_7_2'))
        {
            $rencana_7_2 = $this->input->post('rencana_7_2');
            $data_update['rencana_nilai'] = $rencana_7_2;
            $this->Rencana_model->updateByPeriode('7','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_7_3'))
        {
            $rencana_7_3 = $this->input->post('rencana_7_3');
            $data_update['rencana_nilai'] = $rencana_7_3;
            $this->Rencana_model->updateByPeriode('7','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_7_4'))
        {
            $rencana_7_4 = $this->input->post('rencana_7_4');
            $data_update['rencana_nilai'] = $rencana_7_4;
            $this->Rencana_model->updateByPeriode('7','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_8_1'))
        {
            $rencana_8_1 = $this->input->post('rencana_8_1');
            $data_update['rencana_nilai'] = $rencana_8_1;
            $this->Rencana_model->updateByPeriode('8','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_8_2'))
        {
            $rencana_8_2 = $this->input->post('rencana_8_2');
            $data_update['rencana_nilai'] = $rencana_8_2;
            $this->Rencana_model->updateByPeriode('8','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_8_3'))
        {
            $rencana_8_3 = $this->input->post('rencana_8_3');
            $data_update['rencana_nilai'] = $rencana_8_3;
            $this->Rencana_model->updateByPeriode('8','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_8_4'))
        {
            $rencana_8_4 = $this->input->post('rencana_8_4');
            $data_update['rencana_nilai'] = $rencana_8_4;
            $this->Rencana_model->updateByPeriode('8','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_9_1'))
        {
            $rencana_9_1 = $this->input->post('rencana_9_1');
            $data_update['rencana_nilai'] = $rencana_9_1;
            $this->Rencana_model->updateByPeriode('9','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_9_2'))
        {
            $rencana_9_2 = $this->input->post('rencana_9_2');
            $data_update['rencana_nilai'] = $rencana_9_2;
            $this->Rencana_model->updateByPeriode('9','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_9_3'))
        {
            $rencana_9_3 = $this->input->post('rencana_9_3');
            $data_update['rencana_nilai'] = $rencana_9_3;
            $this->Rencana_model->updateByPeriode('9','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_9_4'))
        {
            $rencana_9_4 = $this->input->post('rencana_9_4');
            $data_update['rencana_nilai'] = $rencana_9_4;
            $this->Rencana_model->updateByPeriode('9','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_10_1'))
        {
            $rencana_10_1 = $this->input->post('rencana_10_1');
            $data_update['rencana_nilai'] = $rencana_10_1;
            $this->Rencana_model->updateByPeriode('10','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_10_2'))
        {
            $rencana_10_2 = $this->input->post('rencana_10_2');
            $data_update['rencana_nilai'] = $rencana_10_2;
            $this->Rencana_model->updateByPeriode('10','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_10_3'))
        {
            $rencana_10_3 = $this->input->post('rencana_10_3');
            $data_update['rencana_nilai'] = $rencana_10_3;
            $this->Rencana_model->updateByPeriode('10','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_10_4'))
        {
            $rencana_10_4 = $this->input->post('rencana_10_4');
            $data_update['rencana_nilai'] = $rencana_10_4;
            $this->Rencana_model->updateByPeriode('10','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_11_1'))
        {
            $rencana_11_1 = $this->input->post('rencana_11_1');
            $data_update['rencana_nilai'] = $rencana_11_1;
            $this->Rencana_model->updateByPeriode('11','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_11_2'))
        {
            $rencana_11_2 = $this->input->post('rencana_11_2');
            $data_update['rencana_nilai'] = $rencana_11_2;
            $this->Rencana_model->updateByPeriode('11','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_11_3'))
        {
            $rencana_11_3 = $this->input->post('rencana_11_3');
            $data_update['rencana_nilai'] = $rencana_11_3;
            $this->Rencana_model->updateByPeriode('11','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_11_4'))
        {
            $rencana_11_4 = $this->input->post('rencana_11_4');
            $data_update['rencana_nilai'] = $rencana_11_4;
            $this->Rencana_model->updateByPeriode('11','4',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_12_1'))
        {
            $rencana_12_1 = $this->input->post('rencana_12_1');
            $data_update['rencana_nilai'] = $rencana_12_1;
            $this->Rencana_model->updateByPeriode('12','1',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_12_2'))
        {
            $rencana_12_2 = $this->input->post('rencana_12_2');
            $data_update['rencana_nilai'] = $rencana_12_2;
            $this->Rencana_model->updateByPeriode('12','2',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_12_3'))
        {
            $rencana_12_3 = $this->input->post('rencana_12_3');
            $data_update['rencana_nilai'] = $rencana_12_3;
            $this->Rencana_model->updateByPeriode('12','3',$pekerjaan_id,$data_update);
        }
        if($this->input->post('rencana_12_4'))
        {
            $rencana_12_4 = $this->input->post('rencana_12_4');
            $data_update['rencana_nilai'] = $rencana_12_4;
            $this->Rencana_model->updateByPeriode('12','4',$pekerjaan_id,$data_update);
        }
        redirect('pekerjaan/rencana_mingguan/'.$pekerjaan_id);
    }

    public function daftar_bulan()
    {
        $page = array();
        $data = array();
        for($i = 1;$i<=12;$i++)
        {
            $data['total_'.$i] = $this->Pekerjaan_model->getTotalByBulan($i);
        }
        //print_r($data);
        array_push($page, array('view' => $this->_folder_view . "daftar_bulan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function daftar_unit($bulan)
    {
        $page = array();
        $data = array();
        $data['total_semua'] = $this->Pekerjaan_model->getTotalByBulan($bulan);
        $data['semua_unit'] = $this->Pekerjaan_model->getTotalByBulanUnit($bulan);
        $data['bulan'] = $bulan;
        //print_r($data);
        array_push($page, array('view' => $this->_folder_view . "daftar_unit_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function rekap_pekerjaan($bulan)
    {
        $page = array();
        $data = array();
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAllPekerjaanByBulan($bulan);
        array_push($page, array('view' => $this->_folder_view . "rekap_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");
    }

    public function rekap_pekerjaan_unit($bulan,$unit_id)
    {
        $page = array();
        $data = array();
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAllPekerjaanByBulanUnit($bulan,$unit_id);
        array_push($page, array('view' => $this->_folder_view . "rekap_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan");      
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */