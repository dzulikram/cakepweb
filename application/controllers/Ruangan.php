    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan extends CI_Controller {

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

    private $_folder_view = "ruangan/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Ruangan_model');
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
            redirect('ruangan/daftar_ruangan');
        } else {
            redirect('login');
        }
    }

    public function daftar_ruangan()
    {
        $page = array();
        $data = array();
        $data['semua_ruangan'] = $this->Ruangan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_ruangan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-ruangan");
    }

    public function tambah_ruangan()
    {
        $page = array();
        $data = array();
        $data['semua_ruangan'] = $this->Ruangan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "tambah_ruangan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-ruangan");
    }

    public function aksi_tambah_ruangan()
    {
        $ruangan_nama = $this->input->post('ruangan_nama');
        $ruangan_level = $this->input->post('ruangan_level');
        $ruangan_induk = $this->input->post('ruangan_induk');
        $data_insert = array(
            "ruangan_nama" => $ruangan_nama,
            "ruangan_level" => $ruangan_level,
            "ruangan_induk" => $ruangan_induk
            );
        $this->Ruangan_model->insert($data_insert);
        redirect('ruangan/daftar_ruangan');
    }

    public function ubah_ruangan($id)
    {
        $page = array();
        $data = array();
        $data['semua_ruangan'] = $this->Ruangan_model->getAll();
        $data['satu_ruangan'] = $this->Ruangan_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_ruangan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-ruangan");   
    }

    public function aksi_ubah_ruangan()
    {
        $ruangan_id = $this->input->post('ruangan_id');
        $ruangan_nama = $this->input->post('ruangan_nama');
        $ruangan_level = $this->input->post('ruangan_level');
        $ruangan_induk = $this->input->post('ruangan_induk');
        $data_update = array(
            "ruangan_nama" => $ruangan_nama,
            "ruangan_level" => $ruangan_level,
            "ruangan_induk" => $ruangan_induk
            );
        $this->Ruangan_model->update($ruangan_id,$data_update);
        redirect('ruangan/daftar_ruangan');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */