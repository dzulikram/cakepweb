    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rencana extends CI_Controller {

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

    private $_folder_view = "rencana/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Rencana_model');
        $this->load->model('Prk_model');
        $this->load->model('Unit_model');
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
            redirect('rencana/daftar_rencana');
        } else {
            redirect('login');
        }
    }

    public function rencana_mingguan()
    {
        $page = array();
        $data = array();
        //$data['semua_prk'] = $this->Prk_model->getPrkDetail();
        $pengguna = $this->session->userdata('sesi');
        $data['semua_pic'] = $this->Unit_model->getAll();
        if(!empty($this->input->get('awal')))
        {
            $awal = $this->input->get('awal');
            $akhir = $this->input->get('akhir');
            $pic = $this->input->get('pic');
            // if($pengguna->pengguna_unit != 0)
            // {
            //     $pic = $pengguna->pengguna_unit;
            //     $data['semua_prk'] = $this->Prk_model->getRencanaMingguRentangUnit($awal,$akhir,$pic);
            //     $data['pic'] = $pic;
            //     $data['rekap_total'] = $this->Prk_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
            // }
            // else 
            if(!empty($pic))
            {
                $data['semua_prk'] = $this->Prk_model->getRencanaMingguRentangUnit($awal,$akhir,$pic);
                $data['pic'] = $pic;
                $data['rekap_total'] = $this->Prk_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
            }
            else
            {
                $data['semua_prk'] = $this->Prk_model->getRencanaMingguRentang($awal,$akhir);
                $data['rekap_total'] = $this->Prk_model->getRekapMingguanPeriodic($awal,$akhir);
            }
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            //$data['bulan'] = $this->input->get('bulan');
        }
        array_push($page, array('view' => $this->_folder_view . "rencana_mingguan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function daftar_rencana($prk_id)
    {
        $page = array();
        $data = array();
        $rencana = $this->Rencana_model->getByPrk($prk_id);
        $data['satu_prk'] = $this->Prk_model->getById($prk_id);
        $data['semua_rencana'] = array();
        foreach ($rencana as $row)
        {
            $data['semua_rencana'][$row->rencana_bulan] = $row->rencana_nilai;
        }
        array_push($page, array('view' => $this->_folder_view . "daftar_rencana_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function ubah_rencana($prk_id)
    {
        $page = array();
        $data = array();
        $data['satu_prk'] = $this->Prk_model->getById($prk_id);
        $data['semua_rencana'] = $this->Rencana_model->getByPrk($prk_id);
        array_push($page, array('view' => $this->_folder_view . "ubah_rencana_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function aksi_ubah_rencana()
    {
        $prk_id = $this->input->post('prk_id');
        $semua_rencana = $this->Rencana_model->getByPrk($prk_id);

        foreach ($semua_rencana as $row) 
        {
            $data_update = array(
                "rencana_nilai" => $this->input->post('rencana_nilai_'.$row->rencana_id)
            );
            $this->Rencana_model->update($row->rencana_id,$data_update);
        }
        redirect('rencana/daftar_rencana/'.$prk_id);
    }

    public function pilih_bulan_rencana_mingguan()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $pic = $this->input->post('pic');
        if(!empty($pic))
        {
            redirect("rencana/rencana_mingguan?awal=".$awal."&akhir=".$akhir."&pic=".$pic);
        }
        else
        {
            redirect("rencana/rencana_mingguan?awal=".$awal."&akhir=".$akhir);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */