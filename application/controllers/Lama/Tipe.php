    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipe extends CI_Controller {

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

    private $_folder_view = "tipe/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Tipe_model');
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
            redirect('tipe/daftar_tipe');
        } else {
            redirect('login');
        }
    }

    public function daftar_tipe()
    {
        $page = array();
        $data = array();
        $data['semua_tipe'] = $this->Tipe_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_tipe_view", 'data' => $data));
        $this->init_page($page, "#nav-list-tipe");
    }

    public function tambah_tipe()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_tipe_view", 'data' => $data));
        $this->init_page($page, "#nav-list-tipe");
    }

    public function aksi_tambah_tipe()
    {
        $tipe_nama = $this->input->post('tipe_nama');
        $data_insert = array(
            "tipe_nama" => $tipe_nama
            );
        $this->Tipe_model->insert($data_insert);
        redirect('tipe/daftar_tipe');
    }

    public function ubah_tipe($id)
    {
        $page = array();
        $data = array();
        $data['satu_tipe'] = $this->Tipe_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_tipe_view", 'data' => $data));
        $this->init_page($page, "#nav-list-tipe");   
    }

    public function aksi_ubah_tipe()
    {
        $tipe_id = $this->input->post('tipe_id');
        $tipe_nama = $this->input->post('tipe_nama');
        $data_update = array(
            "tipe_nama" => $tipe_nama
            );
        $this->Tipe_model->update($tipe_id,$data_update);
        redirect('tipe/daftar_tipe');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */