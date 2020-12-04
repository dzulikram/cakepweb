    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends CI_Controller {

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

    private $_folder_view = "vendor/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Vendor_model');
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
            redirect('vendor/daftar_vendor');
        } else {
            redirect('login');
        }
    }

    public function daftar_vendor()
    {
        $page = array();
        $data = array();
        $data['semua_vendor'] = $this->Vendor_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_vendor_view", 'data' => $data));
        $this->init_page($page, "#nav-list-vendor");
    }

    public function tambah_vendor()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_vendor_view", 'data' => $data));
        $this->init_page($page, "#nav-list-vendor");
    }

    public function aksi_tambah_vendor()
    {
        $vendor_nama = $this->input->post('vendor_nama');
        $data_insert = array(
            "vendor_nama" => $vendor_nama
            );
        $this->Vendor_model->insert($data_insert);
        redirect('vendor/daftar_vendor');
    }

    public function ubah_vendor($id)
    {
        $page = array();
        $data = array();
        $data['satu_vendor'] = $this->Vendor_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_vendor_view", 'data' => $data));
        $this->init_page($page, "#nav-list-vendor");   
    }

    public function aksi_ubah_vendor()
    {
        $vendor_id = $this->input->post('vendor_id');
        $vendor_nama = $this->input->post('vendor_nama');
        $data_update = array(
            "vendor_nama" => $vendor_nama
            );
        $this->Vendor_model->update($vendor_id,$data_update);
        redirect('vendor/daftar_vendor');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */