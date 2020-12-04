    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Referensi extends CI_Controller {

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

    private $_folder_view = "referensi/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Referensi_model');
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
            redirect('referensi/daftar_referensi');
        } else {
            redirect('login');
        }
    }

    public function daftar_referensi()
    {
        $page = array();
        $data = array();
        $data['semua_referensi'] = $this->Referensi_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_referensi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-referensi");
    }

    public function tambah_referensi()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_referensi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-referensi");
    }

    public function aksi_tambah_referensi()
    {
        $referensi_file = "";

        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc|xls|docx|xlsx|ppt|pptx';
        $config['max_size']             = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('referensi_file'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else
        {
            $data_upload = $this->upload->data();
            $referensi_file = $data_upload['file_name'];
        }

        $referensi_nama = $this->input->post('referensi_nama');
        $referensi_keterangan = $this->input->post('referensi_keterangan');
        $data_insert = array(
            "referensi_nama" => $referensi_nama,
            "referensi_keterangan" => $referensi_keterangan,
            "referensi_file" => $referensi_file
            );
        $this->Referensi_model->insert($data_insert);
        redirect('referensi/daftar_referensi');
    }

    public function ubah_referensi($id)
    {
        $page = array();
        $data = array();
        $data['satu_referensi'] = $this->Referensi_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_referensi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-referensi");   
    }

    public function aksi_ubah_referensi()
    {
        $referensi_id = $this->input->post('referensi_id');
        $referensi_nama = $this->input->post('referensi_nama');
        $referensi_keterangan = $this->input->post('referensi_keterangan');
        $data_insert = array(
            "referensi_nama" => $referensi_nama,
            "referensi_keterangan" => $referensi_keterangan
            );

        $referensi_file = "";

        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc|xls|docx|xlsx';
        $config['max_size']             = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('referensi_file'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else
        {
            $data_upload = $this->upload->data();
            $referensi_file = $data_upload['file_name'];
            $data_insert['referensi_file'] = $referensi_file;
        }

        
        $this->Referensi_model->update($referensi_id,$data_insert);
        redirect('referensi/daftar_referensi');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */