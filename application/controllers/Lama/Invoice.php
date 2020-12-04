       <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

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

    private $_folder_view = "invoice/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Invoice_model');
        $this->load->model('Pekerjaan_model');
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
            redirect('invoice/daftar_invoice');
        } else {
            redirect('login');
        }
    }

    public function daftar_invoice()
    {
        $page = array();
        $data = array();
        if(!empty($this->input->get('bulan')))
        {
            $bulan = $this->input->get('bulan');
            $data['bulan'] = $bulan;
            $data['semua_invoice'] = $this->Invoice_model->getByBulan($bulan);
        }
        array_push($page, array('view' => $this->_folder_view . "daftar_invoice_view", 'data' => $data));
        $this->init_page($page, "#nav-list-invoice");
    }

    public function tambah_invoice()
    {
        $page = array();
        $data = array();
        if(!empty($this->input->get('prk')))
        {
            $prk = $this->input->get('prk');
            $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($prk);
            $data['total_realisasi'] = $this->Pekerjaan_model->getTotalRealisasi($prk);
        }
        $pengguna = $this->session->userdata('sesi');
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAll();
        //print_r($data['satu_pekerjaan']);
        //print_r($data['total_realisasi']);
        array_push($page, array('view' => $this->_folder_view . "tambah_invoice_view", 'data' => $data));
        $this->init_page($page, "#nav-list-invoice");
    }

    public function aksi_tambah_invoice()
    {
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        $satu_pekerjaan = $this->Pekerjaan_model->getById($pekerjaan_id);
        $realisasi = $this->Pekerjaan_model->getTotalRealisasi($pekerjaan_id)->total_realisasi;
        $ai = $satu_pekerjaan->pekerjaan_ai;
        $sisa_ai = $ai-$realisasi;
        $invoice_progress = $this->input->post('invoice_progress');
        $invoice_tagihan = $this->input->post('invoice_tagihan');
        //echo $realisasi;
        if($sisa_aki < $invoice_tagihan)
        {
            $this->session->set_flashdata('lebih',"1");
            redirect('invoice/tambah_invoice/?prk='.$pekerjaan_id);
        }
        $invoice_no_bap = $this->input->post('invoice_no_bap');
        $bap_tanggal = $this->input->post('bap_tanggal');
        $bap_bulan = $this->input->post('bap_bulan');
        $bap_tahun = $this->input->post('bap_tahun');
        $invoice_tgl_bap = $bap_tahun."-".$bap_bulan."-".$bap_tanggal;
        $migo_tanggal = $this->input->post('migo_tanggal');
        $migo_bulan = $this->input->post('migo_bulan');
        $migo_tahun = $this->input->post('migo_tahun');
        $invoice_migo = $migo_tahun."-".$migo_bulan."-".$migo_tanggal;
        $invoice_bulan = $this->input->post('invoice_bulan');
        $data_insert = array(
            "pekerjaan_id" => $pekerjaan_id,
            "invoice_progress" => $invoice_progress,
            "invoice_tagihan" => $invoice_tagihan,
            "invoice_no_bap" => $invoice_no_bap,
            "invoice_tgl_bap" => $invoice_tgl_bap,
            "invoice_migo" => $invoice_migo,
            "invoice_bulan" => $invoice_bulan
            );
        $this->Invoice_model->insert($data_insert);
        //print_r($data_insert);
        redirect('invoice/daftar_invoice?bulan='.$invoice_bulan);
     }

    public function cari_prk()
    {
        $page = array();
        $data = array();
        if($this->input->get('prk'))
        {
            $prk = $this->input->get('prk');
            $data_filter = array(
                "pekerjaan_uraian" => $prk
                );
            $data['semua_prk'] = $this->Pekerjaan_model->search($data_filter);
            $data['prk'] = $prk;
        }

        array_push($page, array('view' => $this->_folder_view . "cari_prk_view", 'data' => $data));
        //print_r($data['satu_invoice']);
        $this->init_page($page, "#nav-list-invoice");
    }

    public function aksi_cari_prk()
    {
        $prk = $this->input->post('pekerjaan_nama');
        redirect('invoice/cari_prk?prk='.$prk);
    }

    public function ubah_invoice($id)
    {
        $page = array();
        $data = array();
        $data['satu_invoice'] = $this->Invoice_model->getById($id);
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "ubah_invoice_view", 'data' => $data));
        //print_r($data['satu_invoice']);
        $this->init_page($page, "#nav-list-invoice");
    }

    public function aksi_ubah_invoice()
    {
        $invoice_id = $this->input->post('invoice_id');
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        $invoice_progress = $this->input->post('invoice_progress');
        $invoice_tagihan = $this->input->post('invoice_tagihan');
        $invoice_no_bap = $this->input->post('invoice_no_bap');
        $bap_tanggal = $this->input->post('bap_tanggal');
        $bap_bulan = $this->input->post('bap_bulan');
        $bap_tahun = $this->input->post('bap_tahun');
        $invoice_tgl_bap = $bap_tahun."-".$bap_bulan."-".$bap_tanggal;
        $migo_tanggal = $this->input->post('migo_tanggal');
        $migo_bulan = $this->input->post('migo_bulan');
        $migo_tahun = $this->input->post('migo_tahun');
        $invoice_migo = $migo_tahun."-".$migo_bulan."-".$migo_tanggal;
        $invoice_bulan = $this->input->post('invoice_bulan');
        $data_insert = array(
            "pekerjaan_id" => $pekerjaan_id,
            "invoice_progress" => $invoice_progress,
            "invoice_tagihan" => $invoice_tagihan,
            "invoice_no_bap" => $invoice_no_bap,
            "invoice_tgl_bap" => $invoice_tgl_bap,
            "invoice_migo" => $invoice_migo,
            "invoice_bulan" => $invoice_bulan
            );
        $this->Invoice_model->update($invoice_id, $data_insert);
        //print_r($data_insert);
        redirect('invoice/daftar_invoice?bulan='.$invoice_bulan);
    }

    public function pilih_bulan_invoice()
    {
        $bulan = $this->input->post('bulan');
        redirect('invoice/daftar_invoice?bulan='.$bulan);
    }

    public function bayar_invoice($id)
    {
        $page = array();
        $data = array();
        $data['satu_invoice'] = $this->Invoice_model->getDetailById($id);
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAll();
        //print_r($data['satu_invoice']);
        array_push($page, array('view' => $this->_folder_view . "bayar_invoice_view", 'data' => $data));
        $this->init_page($page, "#nav-list-invoice");
    }

    public function aksi_bayar_invoice()
    {
        $miro_tanggal = $this->input->post('miro_tanggal');
        $miro_bulan = $this->input->post('miro_bulan');
        $miro_tahun = $this->input->post('miro_tahun');
        $invoice_miro = $miro_tahun."-".$miro_bulan."-".$miro_tanggal;
        $bayar_tanggal = $this->input->post('bayar_tanggal');
        $bayar_bulan = $this->input->post('bayar_bulan');
        $bayar_tahun = $this->input->post('bayar_tahun');
        $invoice_tgl_bayar = $bayar_tahun."-".$bayar_bulan."-".$bayar_tanggal;

        $invoice_id = $this->input->post('invoice_id');
        $satu_invoice = $this->Invoice_model->getById($invoice_id);
        $data_update = array(
            "invoice_tgl_bayar" => $invoice_tgl_bayar,
            "invoice_miro" => $invoice_miro
            );
        $this->Invoice_model->update($invoice_id,$data_update);
        //print_r($data_update);
        redirect('invoice/daftar_invoice?bulan='.$satu_invoice->invoice_bulan);
    }

    public function detail_invoice($id)
    {
        $page = array();
        $data = array();
        $data['satu_invoice'] = $this->Invoice_model->getDetailById($id);
        array_push($page, array('view' => $this->_folder_view . "detail_invoice_view", 'data' => $data));
        $this->init_page($page, "#nav-list-invoice");
    }

    public function hapus_invoice($invoice_id)
    {
        $satu_invoice = $this->Invoice_model->getById($invoice_id);
        $this->Invoice_model->delete($invoice_id);
        redirect('invoice/daftar_invoice?bulan='.$satu_invoice->invoice_bulan);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */