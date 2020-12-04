    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

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

    private $_folder_view = "user/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
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
            redirect('user/daftar_user');
        } else {
            redirect('login');
        }
    }

    public function daftar_user()
    {
        $page = array();
        $data = array();
        $data['semua_user'] = $this->User_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_user_view", 'data' => $data));
        $this->init_page($page, "#nav-list-user");
    }

    public function tambah_user()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_user_view", 'data' => $data));
        $this->init_page($page, "#nav-list-user");
    }

    public function aksi_tambah_user()
    {
        $user_nama = $this->input->post('user_nama');
        $user_telpon = $this->input->post('user_telpon');
        $user_email = $this->input->post('user_email');
        $user_username = $this->input->post('user_username');
        $user_password = $this->input->post('user_password');
        $user_privilage = $this->input->post('user_privilage');
        $data_insert = array(
            "user_nama" => $user_nama,
            "user_telpon" => $user_telpon,
            "user_email" => $user_email,
            "user_username" => $user_username,
            "user_password" => $user_password,
            "user_privilage" => $user_privilage
            );
        $this->User_model->insert($data_insert);
        redirect('user/daftar_user');
    }

    public function ubah_user($id)
    {
        $page = array();
        $data = array();
        $data['satu_user'] = $this->User_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_user_view", 'data' => $data));
        $this->init_page($page, "#nav-list-user");   
    }

    public function aksi_ubah_user()
    {
        $user_id = $this->input->post('user_id');
        $user_nama = $this->input->post('user_nama');
        $user_telpon = $this->input->post('user_telpon');
        $user_email = $this->input->post('user_email');
        $user_username = $this->input->post('user_username');
        $user_password = $this->input->post('user_password');
        $user_privilage = $this->input->post('user_privilage');
        $data_update = array(
            "user_nama" => $user_nama,
            "user_telpon" => $user_telpon,
            "user_email" => $user_email,
            "user_username" => $user_username,
            "user_password" => $user_password,
            "user_privilage" => $user_privilage
            );
        $this->User_model->update($user_id,$data_update);
        redirect('user/daftar_user');
    }

    public function changepassword($id){
        $page = array();
        $data = array();
        $data['satu_user'] = $this->User_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "change_password", 'data' => $data));
        $this->init_page($page, "#nav-list-user");
    }

    public function aksi_ubah_password()
    {
        $user_id = $this->input->post('user_id');
        $user_password = $this->input->post('user_password');
        $data_update = array(
            "user_password" => $user_password
            );
        $this->User_model->update($user_id,$data_update);
        redirect('user/changepassword/'.$user_id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */