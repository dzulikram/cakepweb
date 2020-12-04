    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pic extends CI_Controller {

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

    private $_folder_view = "pic/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Pic_model');
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
            redirect('pic/daftar_pic');
        } else {
            redirect('login');
        }
    }

    public function daftar_pic()
    {
        $page = array();
        $data = array();
        $data['semua_pic'] = $this->Pic_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_pic_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pic");
    }

    public function tambah_pic()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_pic_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pic");
    }

    public function aksi_tambah_pic()
    {
        $pic_nama = $this->input->post('pic_nama');
        $data_insert = array(
            "pic_nama" => $pic_nama
            );
        $this->Pic_model->insert($data_insert);
        redirect('pic/daftar_pic');
    }

    public function ubah_pic($id)
    {
        $page = array();
        $data = array();
        $data['satu_pic'] = $this->Pic_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_pic_view", 'data' => $data));
        $this->init_page($page, "#nav-list-pic");   
    }

    public function aksi_ubah_pic()
    {
        $pic_id = $this->input->post('pic_id');
        $pic_nama = $this->input->post('pic_nama');
        $data_update = array(
            "pic_nama" => $pic_nama
            );
        $this->Pic_model->update($pic_id,$data_update);
        redirect('pic/daftar_pic');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */