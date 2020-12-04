<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proyek extends CI_Controller {

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

    private $_folder_view = "proyek/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Proyek_model');
        $this->load->model('Tipe_model');
        $this->load->model('Jenis_model');
        $this->load->model('Fungsi_model');
        $this->load->model('Prk_model');
        $this->load->model('Unit_model');
        $this->load->model('Akb_model');
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
            redirect('proyek/daftar_proyek');
        } else {
            redirect('login');
        }
    }

    public function daftar_proyek()
    {
        $page = array();
        $data = array();
        $data['semua_proyek'] = $this->Proyek_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_proyek_view", 'data' => $data));
        $this->init_page($page, "#nav-list-proyek");
    }

    public function tambah_proyek()
    {
        $page = array();
        $data = array();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_proyek_view", 'data' => $data));
        $this->init_page($page, "#nav-list-proyek");
    }

    public function aksi_tambah_proyek()
    {
        $proyek_nama = $this->input->post('proyek_nama');
        $proyek_kode = $this->input->post('proyek_kode');
        $fungsi_id = $this->input->post('fungsi_id');
        $unit_id = $this->input->post('unit_id');
        $data_insert = array(
            "proyek_nama" => $proyek_nama,
            "proyek_kode" => $proyek_kode,
            "fungsi_id" => $fungsi_id,
            "unit_id" => $unit_id
            );
        $this->Proyek_model->insert($data_insert);
        redirect('proyek/daftar_proyek');
    }

    public function ubah_proyek($id)
    {
        $page = array();
        $data = array();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['satu_proyek'] = $this->Proyek_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_proyek_view", 'data' => $data));
        $this->init_page($page, "#nav-list-proyek");   
    }

    public function aksi_ubah_proyek()
    {
        $proyek_id = $this->input->post('proyek_id');
        $proyek_nama = $this->input->post('proyek_nama');
        $proyek_kode = $this->input->post('proyek_kode');
        $fungsi_id = $this->input->post('fungsi_id');
        $data_update = array(
            "proyek_nama" => $proyek_nama,
            "proyek_kode" => $proyek_kode,
            "fungsi_id" => $fungsi_id,
            "unit_id" => $unit_id
            );
        $this->Proyek_model->update($proyek_id,$data_update);
        redirect('proyek/daftar_proyek');
    }

    public function daftar_prk($proyek_id)
    {
        $page = array();
        $data['satu_proyek'] = $this->Proyek_model->getById($proyek_id);
        $data['semua_prk'] = $this->Prk_model->getByProyek($proyek_id);
        array_push($page, array('view' => $this->_folder_view . "daftar_prk_view", 'data' => $data));
        $this->init_page($page, "#nav-list-proyek");
    }

    public function tambah_prk($proyek_id)
    {
        $page = array();
        $data = array(); 
        $data['satu_proyek'] = $this->Proyek_model->getById($proyek_id);
        $data['semua_proyek'] = $this->Proyek_model->getAll();
        $data['semua_tipe'] = $this->Tipe_model->getAll();
        $data['semua_jenis'] = $this->Jenis_model->getAll();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_prk_view", 'data' => $data));
        $this->init_page($page, "#nav-list-proyek");
    }

    public function aksi_tambah_prk()
    {
        $prk_nama = $this->input->post('prk_nama');
        $fungsi_id = $this->input->post('fungsi_id');
        $proyek_id = $this->input->post('proyek_id');
        $jenis_id = $this->input->post('jenis_id');
        $unit_id = $this->input->post('unit_id');
        $tipe_id = $this->input->post('tipe_id');
        $prk_no_prk = $this->input->post('prk_no_prk');
        $prk_no_kontrak = $this->input->post('prk_no_kontrak');
        $prk_nilai_kontrak = $this->input->post('prk_nilai_kontrak');
        $prk_ai = $this->input->post('prk_ai');
        $prk_aki = $this->input->post('prk_aki');

        $data_insert = array(
            "prk_nama" => $prk_nama,
            "fungsi_id" => $fungsi_id,
            "proyek_id" => $proyek_id,
            "jenis_id" => $jenis_id,
            "unit_id" => $unit_id,
            "tipe_id" => $tipe_id,
            "prk_no_prk" => $prk_no_prk,
            "prk_no_kontrak" => $prk_no_kontrak,
            "prk_nilai_kontrak" => $prk_nilai_kontrak,
            "prk_ai" => $prk_ai,
            "prk_aki" => $prk_aki
            );
        // print_r($data_insert);
        $insert_id = $this->Prk_model->insert($data_insert);

        for($i = 1;$i<=12;$i++)
        {
            $insert_akb = array(
                "prk_id" => $insert_id,
                "akb_bulan" => $i,
                "akb_nilai" => 0
            );
            $this->Akb_model->insert($insert_akb);
        }

        for($i=1;$i<=12;$i++)
        {
            for($j=1;$j<=4;$j++)
            {
                $insert_rencana = array(
                    "prk_id" => $insert_id,
                    "rencana_minggu" => $j,
                    "rencana_bulan" => $i,
                    "rencana_nilai" => 0
                );
                $this->Rencana_model->insert($insert_rencana);
            }
        }
        redirect('proyek/daftar_prk/'.$proyek_id);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */