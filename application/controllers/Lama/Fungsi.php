    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fungsi extends CI_Controller {

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

    private $_folder_view = "fungsi/";

    public function __construct() 
    {
        parent::__construct();
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
            redirect('fungsi/daftar_fungsi');
        } else {
            redirect('login');
        }
    }

    public function daftar_fungsi()
    {
        $page = array();
        $data = array();
        $data['semua_fungsi'] = $this->Fungsi_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_fungsi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-fungsi");
    }

    public function tambah_fungsi()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_fungsi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-fungsi");
    }

    public function aksi_tambah_fungsi()
    {
        $fungsi_nama = $this->input->post('fungsi_nama');
        $data_insert = array(
            "fungsi_nama" => $fungsi_nama
            );
        $this->Fungsi_model->insert($data_insert);
        redirect('fungsi/daftar_fungsi');
    }

    public function ubah_fungsi($id)
    {
        $page = array();
        $data = array();
        $data['satu_fungsi'] = $this->Fungsi_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_fungsi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-fungsi");   
    }

    public function aksi_ubah_fungsi()
    {
        $fungsi_id = $this->input->post('fungsi_id');
        $fungsi_nama = $this->input->post('fungsi_nama');
        $data_update = array(
            "fungsi_nama" => $fungsi_nama
            );
        $this->Fungsi_model->update($fungsi_id,$data_update);
        redirect('fungsi/daftar_fungsi');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */