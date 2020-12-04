    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akb extends CI_Controller {

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

    private $_folder_view = "akb/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Akb_model');
        $this->load->model('Prk_model');
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
            redirect('akb/daftar_akb');
        } else {
            redirect('login');
        }
    }

    public function daftar_akb($prk_id)
    {
        $page = array();
        $data = array();
        $akb = $this->Akb_model->getByPrk($prk_id);
        $data['satu_prk'] = $this->Prk_model->getById($prk_id);
        $data['semua_akb'] = array();
        foreach ($akb as $row)
        {
            $data['semua_akb'][$row->akb_bulan] = $row->akb_nilai;
        }
        array_push($page, array('view' => $this->_folder_view . "daftar_akb_view", 'data' => $data));
        $this->init_page($page, "#nav-list-akb");
    }

    public function ubah_akb($prk_id)
    {
        $page = array();
        $data = array();
        $data['satu_prk'] = $this->Prk_model->getById($prk_id);
        $data['semua_akb'] = $this->Akb_model->getByPrk($prk_id);
        array_push($page, array('view' => $this->_folder_view . "ubah_akb_view", 'data' => $data));
        $this->init_page($page, "#nav-list-akb");
    }

    public function aksi_ubah_akb()
    {
        $prk_id = $this->input->post('prk_id');
        $semua_akb = $this->Akb_model->getByPrk($prk_id);

        foreach ($semua_akb as $row) 
        {
            $data_update = array(
                "akb_nilai" => $this->input->post('akb_nilai_'.$row->akb_id)
            );
            $this->Akb_model->update($row->akb_id,$data_update);
        }
        redirect('akb/daftar_akb/'.$prk_id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */