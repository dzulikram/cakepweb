    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usulan_rkap extends CI_Controller {

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

    private $_folder_view = "usulan_rkap/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Usulan_rkap_model');
        $this->load->model('Unit_model');
        $this->load->model('Fungsi_model');
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
            redirect('usulan_rkap/daftar_usulan_rkap');
        } else {
            redirect('login');
        }
    }

    public function daftar_usulan_rkap()
    {
        $page = array();
        $data = array();
        $pengguna = $this->session->userdata('sesi');
        if($pengguna->pengguna_unit > 0)
        {
            $data['semua_usulan_rkap'] = $this->Usulan_rkap_model->getByUnit($pengguna->pengguna_unit);
            $data['rekap_total'] = $this->Usulan_rkap_model->getTotalByPic($pengguna->pengguna_unit);
        }
        else
        {
            $data['rekap_total'] = $this->Usulan_rkap_model->getTotal();
            $data['semua_usulan_rkap'] = $this->Usulan_rkap_model->getAll();
        }
        array_push($page, array('view' => $this->_folder_view . "daftar_usulan_rkap_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");
    }

    public function tambah_usulan_rkap()
    {
        $page = array();
        $data = array();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_usulan_rkap_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");
    }

    public function aksi_tambah_usulan_rkap()
    {
        $usulan_rkap_pekerjaan = $this->input->post('usulan_rkap_pekerjaan');
        $usulan_rkap_kapasitas = $this->input->post('usulan_rkap_kapasitas');
        $usulan_rkap_ai = $this->input->post('usulan_rkap_ai');
        $usulan_rkap_aki = $this->input->post('usulan_rkap_aki');
        $usulan_rkap_operasi = $this->input->post('usulan_rkap_operasi');
        $usulan_rkap_rencana_lelang = $this->input->post('usulan_rkap_rencana_lelang');
        $pengguna = $this->session->userdata('sesi');
        $usulan_rkap_unit = $pengguna->pengguna_unit;

        $data_insert = array(
            "usulan_rkap_pekerjaan" => $usulan_rkap_pekerjaan,
            "usulan_rkap_kapasitas" => $usulan_rkap_kapasitas,
            "usulan_rkap_ai" => $usulan_rkap_ai,
            "usulan_rkap_aki" => $usulan_rkap_aki,
            "usulan_rkap_operasi" => $usulan_rkap_operasi,
            "usulan_rkap_unit" => $usulan_rkap_unit,
            "usulan_rkap_rencana_lelang" => $usulan_rkap_rencana_lelang,
            "usulan_rkap_jenis" => $usulan_rkap_jenis,
            "usulan_rkap_fungsi" => $usulan_rkap_fungsi
            );
        $this->Usulan_rkap_model->insert($data_insert);
        redirect('usulan_rkap/daftar_usulan_rkap');
    }

    public function ubah_usulan_rkap($id)
    {
        $page = array();
        $data = array();
        $data['satu_usulan_rkap'] = $this->Usulan_rkap_model->getById($id);
        $data['semua_unit'] = $this->Unit_model->getAll();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "ubah_usulan_rkap_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");   
    }

    public function aksi_ubah_usulan_rkap()
    {
        $usulan_rkap_id = $this->input->post('usulan_rkap_id');
        $usulan_rkap_pekerjaan = $this->input->post('usulan_rkap_pekerjaan');
        $usulan_rkap_kapasitas = $this->input->post('usulan_rkap_kapasitas');
        $usulan_rkap_ai = $this->input->post('usulan_rkap_ai');
        $usulan_rkap_aki = $this->input->post('usulan_rkap_aki');
        $usulan_rkap_operasi = $this->input->post('usulan_rkap_operasi');
        $usulan_rkap_unit = $this->input->post('usulan_rkap_unit');
        $usulan_rkap_rencana_lelang = $this->input->post('usulan_rkap_rencana_lelang');

        $data_update = array(
            "usulan_rkap_pekerjaan" => $usulan_rkap_pekerjaan,
            "usulan_rkap_kapasitas" => $usulan_rkap_kapasitas,
            "usulan_rkap_ai" => $usulan_rkap_ai,
            "usulan_rkap_aki" => $usulan_rkap_aki,
            "usulan_rkap_operasi" => $usulan_rkap_operasi,
            "usulan_rkap_unit" => $usulan_rkap_unit,
            "usulan_rkap_rencana_lelang" => $usulan_rkap_rencana_lelang,
            "usulan_rkap_jenis" => $usulan_rkap_jenis,
            "usulan_rkap_fungsi" => $usulan_rkap_fungsi
            );
        $this->Usulan_rkap_model->update($usulan_rkap_id,$data_update);
        redirect('usulan_rkap/daftar_usulan_rkap');
    }

    public function total_usulan_rkap()
    {
        $page = array();
        $data = array();
        $data['semua_usulan'] = $this->Usulan_rkap_model->getTotalByUnit();
        $data['semua_unit'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "total_usulan_rkap_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");
    }

    public function usulan_unit($id)
    {
        $page = array();
        $data = array();
        $data['semua_usulan_rkap'] = $this->Usulan_rkap_model->getByUnit($id);
        $data['satu_unit'] = $this->Unit_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "usulan_unit_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");
    }

    public function detail_usulan($id)
    {
        $page = array();
        $data = array();
        $data['satu_usulan'] = $this->Usulan_rkap_model->getById($id);
        $data['satu_unit'] = $this->Unit_model->getById($data['satu_usulan']->usulan_rkap_unit);
        array_push($page, array('view' => $this->_folder_view . "detail_usulan_rkap_view", 'data' => $data));
        $this->init_page($page, "#nav-list-usulan_rkap");
    }    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */