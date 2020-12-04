    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan_tambahan extends CI_Controller {

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

    private $_folder_view = "pekerjaan_tambahan/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Pekerjaan_tambahan_model');
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
            redirect('pekerjaan_tambahan/daftar_pekerjaan_tambahan');
        } else {
            redirect('login');
        }
    }

    public function daftar_pekerjaan_tambahan()
    {
        $page = array();
        $data = array();
        $data['semua_pekerjaan_tambahan'] = $this->Pekerjaan_tambahan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_pekerjaan_tambahan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan_tambahan");
    }

    public function tambah_pekerjaan_tambahan()
    {
        $page = array();
        $data = array();
        $data['semua_unit'] = $this->Unit_model->getAll();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_pekerjaan_tambahan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan_tambahan");
    }

    public function aksi_tambah_pekerjaan_tambahan()
    {
        $pekerjaan_tambahan_nama = $this->input->post('pekerjaan_tambahan_nama');
        $pekerjaan_tambahan_ai = $this->input->post('pekerjaan_tambahan_ai');
        $pekerjaan_tambahan_aki = $this->input->post('pekerjaan_tambahan_aki');
        $unit_id = $this->input->post('unit_id');
        $pekerjaan_tambahan_jenis = $this->input->post('pekerjaan_tambahan_jenis');
        $fungsi_id = $this->input->post('fungsi_id');
        $pekerjaan_tambahan_1 = $this->input->post('pekerjaan_tambahan_1');
        $pekerjaan_tambahan_2 = $this->input->post('pekerjaan_tambahan_2');
        $pekerjaan_tambahan_3 = $this->input->post('pekerjaan_tambahan_3');
        $pekerjaan_tambahan_4 = $this->input->post('pekerjaan_tambahan_4');
        $pekerjaan_tambahan_5 = $this->input->post('pekerjaan_tambahan_5');
        $pekerjaan_tambahan_6 = $this->input->post('pekerjaan_tambahan_6');
        $pekerjaan_tambahan_7 = $this->input->post('pekerjaan_tambahan_7');
        $pekerjaan_tambahan_8 = $this->input->post('pekerjaan_tambahan_8');
        $pekerjaan_tambahan_9 = $this->input->post('pekerjaan_tambahan_9');
        $pekerjaan_tambahan_10 = $this->input->post('pekerjaan_tambahan_10');
        $pekerjaan_tambahan_11 = $this->input->post('pekerjaan_tambahan_11');
        $pekerjaan_tambahan_12 = $this->input->post('pekerjaan_tambahan_12');

        $data_insert = array(
            "pekerjaan_tambahan_nama" => $pekerjaan_tambahan_nama,
            "pekerjaan_tambahan_ai" => $pekerjaan_tambahan_ai,
            "pekerjaan_tambahan_ai" => $pekerjaan_tambahan_aki,
            "unit_id" => $unit_id,
            "pekerjaan_tambahan_jenis" => $pekerjaan_tambahan_jenis,
            "fungsi_id" => $fungsi_id,
            "pekerjaan_tambahan_1" => $pekerjaan_tambahan_1,
            "pekerjaan_tambahan_2" => $pekerjaan_tambahan_2,
            "pekerjaan_tambahan_3" => $pekerjaan_tambahan_3,
            "pekerjaan_tambahan_4" => $pekerjaan_tambahan_4,
            "pekerjaan_tambahan_5" => $pekerjaan_tambahan_5,
            "pekerjaan_tambahan_6" => $pekerjaan_tambahan_6,
            "pekerjaan_tambahan_7" => $pekerjaan_tambahan_7,
            "pekerjaan_tambahan_8" => $pekerjaan_tambahan_8,
            "pekerjaan_tambahan_9" => $pekerjaan_tambahan_9,
            "pekerjaan_tambahan_10" => $pekerjaan_tambahan_10,
            "pekerjaan_tambahan_11" => $pekerjaan_tambahan_11,
            "pekerjaan_tambahan_12" => $pekerjaan_tambahan_12
            );
        $this->Pekerjaan_tambahan_model->insert($data_insert);
        redirect('pekerjaan_tambahan/daftar_pekerjaan_tambahan');
    }

    public function ubah_pekerjaan_tambahan($id)
    {
        $page = array();
        $data = array();
        $data['satu_pekerjaan_tambahan'] = $this->Pekerjaan_tambahan_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_pekerjaan_tambahan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pekerjaan_tambahan");   
    }

    public function aksi_ubah_pekerjaan_tambahan()
    {
        $pekerjaan_tambahan_id = $this->input->post('pekerjaan_tambahan_id');
        $pekerjaan_tambahan_nama = $this->input->post('pekerjaan_tambahan_nama');
        $pekerjaan_tambahan_ai = $this->input->post('pekerjaan_tambahan_ai');
        $pekerjaan_tambahan_aki = $this->input->post('pekerjaan_tambahan_aki');
        $unit_id = $this->input->post('unit_id');
        $pekerjaan_tambahan_jenis = $this->input->post('pekerjaan_tambahan_jenis');
        $fungsi_id = $this->input->post('fungsi_id');
        $pekerjaan_tambahan_1 = $this->input->post('pekerjaan_tambahan_1');
        $pekerjaan_tambahan_2 = $this->input->post('pekerjaan_tambahan_2');
        $pekerjaan_tambahan_3 = $this->input->post('pekerjaan_tambahan_3');
        $pekerjaan_tambahan_4 = $this->input->post('pekerjaan_tambahan_4');
        $pekerjaan_tambahan_5 = $this->input->post('pekerjaan_tambahan_5');
        $pekerjaan_tambahan_6 = $this->input->post('pekerjaan_tambahan_6');
        $pekerjaan_tambahan_7 = $this->input->post('pekerjaan_tambahan_7');
        $pekerjaan_tambahan_8 = $this->input->post('pekerjaan_tambahan_8');
        $pekerjaan_tambahan_9 = $this->input->post('pekerjaan_tambahan_9');
        $pekerjaan_tambahan_10 = $this->input->post('pekerjaan_tambahan_10');
        $pekerjaan_tambahan_11 = $this->input->post('pekerjaan_tambahan_11');
        $pekerjaan_tambahan_12 = $this->input->post('pekerjaan_tambahan_12');

        $data_update = array(
            "pekerjaan_tambahan_nama" => $pekerjaan_tambahan_pekerjaan,
            "pekerjaan_tambahan_ai" => $pekerjaan_tambahan_ai,
            "pekerjaan_tambahan_ai" => $pekerjaan_tambahan_aki,
            "unit_id" => $unit_id,
            "pekerjaan_tambahan_jenis" => $pekerjaan_tambahan_jenis,
            "fungsi_id" => $fungsi_id,
            "pekerjaan_tambahan_1" => $pekerjaan_tambahan_1,
            "pekerjaan_tambahan_2" => $pekerjaan_tambahan_2,
            "pekerjaan_tambahan_3" => $pekerjaan_tambahan_3,
            "pekerjaan_tambahan_4" => $pekerjaan_tambahan_4,
            "pekerjaan_tambahan_5" => $pekerjaan_tambahan_5,
            "pekerjaan_tambahan_6" => $pekerjaan_tambahan_6,
            "pekerjaan_tambahan_7" => $pekerjaan_tambahan_7,
            "pekerjaan_tambahan_8" => $pekerjaan_tambahan_8,
            "pekerjaan_tambahan_9" => $pekerjaan_tambahan_9,
            "pekerjaan_tambahan_10" => $pekerjaan_tambahan_10,
            "pekerjaan_tambahan_11" => $pekerjaan_tambahan_11,
            "pekerjaan_tambahan_12" => $pekerjaan_tambahan_12
            );
        $this->Pekerjaan_tambahan_model->update($pekerjaan_tambahan_id,$data_update);
        redirect('pekerjaan_tambahan/daftar_pekerjaan_tambahan');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */