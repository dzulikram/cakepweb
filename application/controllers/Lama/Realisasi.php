    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realisasi extends CI_Controller {

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

    private $_folder_view = "realisasi/";

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Rencana_model');
        $this->load->model('Pekerjaan_model');
        $this->load->model('Unit_model');
        $this->load->library('Excel');
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
            redirect('rencana/daftar_realisasi');
        } else {
            redirect('login');
        }
    }

    public function daftar_pekerjaan()
    {
        $page = array();
        $data = array();
        $data['semua_pekerjaan'] = $this->Pekerjaan_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_pekerjaan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function rencana_bulanan($pekerjaan_id)
    {
        $page = array();
        $data = array();
        $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($pekerjaan_id);
        $data['semua_pic'] = $this->Unit_model->getAll();
        array_push($page, array('view' => $this->_folder_view . "daftar_rencana_bulanan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function rencana_mingguan($pekerjaan_id,$bulan)
    {
        $page = array();
        $data = array();
        $data['semua_rencana'] = $this->Rencana_model->getRencanaMingguan($pekerjaan_id,$bulan);
        $data['semua_pic'] = $this->Unit_model->getAll();
        $data['bulan'] = $bulan;
        $data['pekerjaan_id'] = $pekerjaan_id;
        array_push($page, array('view' => $this->_folder_view . "daftar_rencana_mingguan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function aksi_realisasi()
    {
        $bulan = $this->input->post('bulan');
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        $semua_rencana = $this->Rencana_model->getRencanaMingguan($pekerjaan_id,$bulan);
        foreach ($semua_rencana as $row)
        {
            $data_update = array(
                "rencana_realisasi" => $this->input->post('rencana_realisasi_'.$row->rencana_id)
                );
            $this->Rencana_model->update($row->rencana_id,$data_update);
        }
        redirect("realisasi/rencana_mingguan/".$pekerjaan_id."/".$bulan);
    }

    public function tambah_rencana()
    {
        $page = array();
        $data = array();
        array_push($page, array('view' => $this->_folder_view . "tambah_rencana_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function aksi_tambah_rencana()
    {
        $rencana_nama = $this->input->post('rencana_nama');
        $data_insert = array(
            "rencana_nama" => $rencana_nama
            );
        $this->Rencana_model->insert($data_insert);
        redirect('rencana/daftar_rencana');
    }

    public function ubah_rencana($id)
    {
        $page = array();
        $data = array();
        $data['satu_rencana'] = $this->Rencana_model->getById($id);
        array_push($page, array('view' => $this->_folder_view . "ubah_rencana_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");   
    }

    public function aksi_ubah_rencana()
    {
        $rencana_id = $this->input->post('rencana_id');
        $rencana_nama = $this->input->post('rencana_nama');
        $data_update = array(
            "rencana_nama" => $rencana_nama
            );
        $this->Rencana_model->update($rencana_id,$data_update);
        redirect('rencana/daftar_rencana');
    }

    

    public function pilih_bulan_realisasi_bulanan()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $pic = $this->input->post('pic');
        if(!empty($pic))
        {
            redirect("realisasi/realisasi_bulanan?awal=".$awal."&akhir=".$akhir."&pic=".$pic);
        }
        else
        {
            redirect("realisasi/realisasi_bulanan?awal=".$awal."&akhir=".$akhir);
        }
        //redirect("realisasi/realisasi_bulanan/?awal=".$awal."&akhir=".$akhir);
    }

    /////
    public function realisasi_mingguan()
    {
        $page = array();
        $data = array();
        //$data['semua_prk'] = $this->Pekerjaan_model->getPrkDetail();
        $data['semua_pic'] = $this->Unit_model->getAll();
        $pengguna = $this->session->userdata('sesi');
        if(!empty($this->input->get('awal')))
        {
            $awal = $this->input->get('awal');
            $akhir = $this->input->get('akhir');
            $pic = $this->input->get('pic');
            // if($pengguna->pengguna_unit != 0)
            // {
            //     $pic = $pengguna->pengguna_unit;
            //     $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiMingguRentangUnit($awal,$akhir,$pic);
            //     $data['pic'] = $pic;
            //     $data['detail_pic'] = $this->Unit_model->getById($pic);
            //     $data['awal'] = $awal;
            //     $data['akhir'] = $akhir;
            //     $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
            //     $this->session->set_flashdata('data',$data);
            // }
            // else 
            if(!empty($pic))
            {
                $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiMingguRentangUnit($awal,$akhir,$pic);
                $data['pic'] = $pic;
                $data['detail_pic'] = $this->Unit_model->getById($pic);
                $data['awal'] = $awal;
                $data['akhir'] = $akhir;
                $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
                $this->session->set_flashdata('data',$data);
            }
            else
            {
                $data['awal'] = $awal;
                $data['akhir'] = $akhir;
                $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiMingguRentang($awal,$akhir);
                $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodic($awal,$akhir);
                $this->session->set_flashdata('data',$data);
            }
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            //$data['bulan'] = $this->input->get('bulan');
        }
        array_push($page, array('view' => $this->_folder_view . "realisasi_mingguan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");   
        // print_r($data['semua_prk']);
    }

    public function pilih_bulan_realisasi_mingguan()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $pic = $this->input->post('pic');
        if(!empty($pic))
        {
            redirect("realisasi/realisasi_mingguan?awal=".$awal."&akhir=".$akhir."&pic=".$pic);
        }
        else
        {
            redirect("realisasi/realisasi_mingguan?awal=".$awal."&akhir=".$akhir);
        }
        //redirect("realisasi/realisasi_mingguan/?awal=".$awal."&akhir=".$akhir);
    }

    public function input_realisasi($pekerjaan_id,$bulan)
    {
        $page = array();
        $data = array();
        $data['semua_rencana'] = $this->Rencana_model->getRencanaMingguan($pekerjaan_id,$bulan);
        $data['pekerjaan_id'] = $pekerjaan_id;
        $data['bulan'] = $bulan;
        $data['satu_pekerjaan'] = $this->Pekerjaan_model->getById($pekerjaan_id);
        array_push($page, array('view' => $this->_folder_view . "input_realisasi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");   
    }

    public function daftar_realisasi($pekerjaan_id,$bulan)
    {
        $page = array();
        $data = array();
        $data['semua_rencana'] = $this->Rencana_model->getRencanaMingguan($pekerjaan_id,$bulan);
        $data['pekerjaan_id'] = $pekerjaan_id;
        $data['bulan'] = $bulan;
        array_push($page, array('view' => $this->_folder_view . "daftar_realisasi_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");   
    }    

    public function aksi_input_realisasi()
    {
        $pekerjaan_id = $this->input->post('pekerjaan_id');
        $bulan = $this->input->post('bulan');
        $semua_rencana = $this->Rencana_model->getRencanaMingguan($pekerjaan_id,$bulan);
        foreach ($semua_rencana as $row)
        {
            $data_update = array(
                "rencana_realisasi" => $this->input->post('realisasi_'.$row->rencana_id)
                );
            $this->Rencana_model->update($row->rencana_id,$data_update);
        }
        redirect("realisasi/daftar_realisasi/".$pekerjaan_id."/".$bulan);
    }

    public function realisasi_akumulatif()
    {
        $page = array();
        $data = array();
        if($this->input->get('dari') && $this->input->get('hingga'))
        {
            $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiAkumulatif($this->input->get('dari'),$this->input->get('hingga'));
            $data['dari'] = $this->input->get('dari');
            $data['hingga'] = $this->input->get('hingga');
        }
        //print_r($data['semua_prk']);
        array_push($page, array('view' => $this->_folder_view . "realisasi_akumulatif_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");
    }

    public function aksi_realisasi_akumulatif()
    {
        $dari = $this->input->post('dari');
        $hingga = $this->input->post('hingga');
        redirect("realisasi/realisasi_akumulatif?dari=".$dari."&hingga=".$hingga);
    }

    public function cetak_realisasi() {
        $this->load->library('Excel');
        $data = $this->session->flashdata('data');
        $this->session->keep_flashdata('data');
        $inputFileName = './template/laporan.xls';
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
            'font' => array(
                'size' => 12,
                'name' => 'Calibri'
                ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );

        $nomor = 1;
        $counter = 8;

        foreach ($data['semua_prk'] as $row) 
        {
            $counter++;

            $sheetData->setCellValue('A' . $counter, $nomor);
            $sheetData->setCellValue('B' . $counter, $row->pekerjaan_no);
            $sheetData->setCellValue('C' . $counter, $row->pekerjaan_no_kontrak);
            $sheetData->setCellValue('D' . $counter, $row->pekerjaan_uraian);
            $sheetData->setCellValue('E' . $counter, $row->pekerjaan_ai);
            $sheetData->setCellValue('F' . $counter, $row->pekerjaan_aki);
            $sheetData->setCellValue('G' . $counter, $row->rencana_nilai_1);
            $sheetData->setCellValue('H' . $counter, $row->rencana_nilai_2);
            $sheetData->setCellValue('I' . $counter, $row->rencana_nilai_3);
            $sheetData->setCellValue('J' . $counter, $row->rencana_nilai_4);
            $sheetData->setCellValue('K' . $counter, $row->rencana_total);
            $sheetData->setCellValue('L' . $counter, $row->realisasi_nilai_1);
            $sheetData->setCellValue('M' . $counter, $row->realisasi_nilai_2);
            $sheetData->setCellValue('N' . $counter, $row->realisasi_nilai_3);
            $sheetData->setCellValue('O' . $counter, $row->realisasi_nilai_4);
            $sheetData->setCellValue('P' . $counter, $row->realisasi_total);
            if(empty($row->pekerjaan_aki) || $row->pekerjaan_aki == 0)
            {
                $sheetData->setCellValue('Q' . $counter, 0);
            }
            else
            {
                $sheetData->setCellValue('Q' . $counter, $row->realisasi_total/$row->pekerjaan_aki);
            }
            if(empty($row->rencana_total) || $row->rencana_total == 0)
            {
                $sheetData->setCellValue('R' . $counter, 0);
            }
            else
            {
                $sheetData->setCellValue('R' . $counter, $row->realisasi_total/$row->rencana_total);
            }
            $sheetData->setCellValue('S' . $counter, $row->unit_nama);
            $sheetData->setCellValue('T' . $counter, $row->fungsi_nama);
            if($row->pekerjaan_jenis == 1)
            {
                $sheetData->setCellValue('U' . $counter, "Luncuran");
            }    
            else
            {
                $sheetData->setCellValue('U' . $counter, "Murni");
            }
            
            $nomor++;
        }
        $counter++;
        $rekap_total = $data['rekap_total'];
        $sheetData->setCellValue('A' . $counter, $nomor);
        $sheetData->setCellValue('C' . $counter, "Total");
        $sheetData->setCellValue('E' . $counter, $rekap_total->pekerjaan_ai);
        $sheetData->setCellValue('F' . $counter, $rekap_total->pekerjaan_aki);
        $sheetData->setCellValue('G' . $counter, $rekap_total->rencana_nilai_1);
        $sheetData->setCellValue('H' . $counter, $rekap_total->rencana_nilai_2);
        $sheetData->setCellValue('I' . $counter, $rekap_total->rencana_nilai_3);
        $sheetData->setCellValue('J' . $counter, $rekap_total->rencana_nilai_4);
        $sheetData->setCellValue('K' . $counter, $rekap_total->rencana_total);
        $sheetData->setCellValue('L' . $counter, $rekap_total->realisasi_nilai_1);
        $sheetData->setCellValue('M' . $counter, $rekap_total->realisasi_nilai_2);
        $sheetData->setCellValue('N' . $counter, $rekap_total->realisasi_nilai_3);
        $sheetData->setCellValue('O' . $counter, $rekap_total->realisasi_nilai_4);
        $sheetData->setCellValue('P' . $counter, $rekap_total->realisasi_total);
        if(empty($rekap_total->pekerjaan_aki) || $rekap_total->pekerjaan_aki == 0)
        {
            $sheetData->setCellValue('Q' . $counter, "0");
        }
        else
        {
            $sheetData->setCellValue('Q' . $counter, ($rekap_total->realisasi_total/$rekap_total->pekerjaan_aki)*100);
        }
        if(empty($rekap_total->rencana_total) || $rekap_total->rencana_total == 0)
        {
            $sheetData->setCellValue('R' . $counter, "0");
        }
        else
        {
            $sheetData->setCellValue('R' . $counter, ($rekap_total->realisasi_total/$rekap_total->rencana_total)*100);
        }

        $sheetData->getStyle("A9:U". $counter)->applyFromArray($styleArray);
        $filename = 'Laporan Realisasi.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        // print_r($data['semua_prk']);
    }

    /////
    public function realisasi_bulanan()
    {
        $page = array();
        $data = array();
        //$data['semua_prk'] = $this->Pekerjaan_model->getPrkDetail();
        $pengguna = $this->session->userdata('sesi');
        $data['semua_pic'] = $this->Unit_model->getAll();
        $semua_vendor = $this->Vendor_model->getAll();
        $vendor = array();
        foreach ($semua_vendor as $row) 
        {
            $vendor[$row->vendor_id] = $row->vendor_nama;
        }
        $vendor[0] = "-";
        $data['semua_vendor'] = $vendor;
        if(!empty($this->input->get('awal')))
        {
            $awal = $this->input->get('awal');
            $akhir = $this->input->get('akhir');
            $pic = $this->input->get('pic');
            // if($pengguna->pengguna_unit != 0)
            // {
            //     $pic = $pengguna->pengguna_unit;
            //     $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiBulanRentangUnit($awal,$akhir,$pic);
            //     $data['pic'] = $pic;
            //     $data['awal'] = $awal;
            //     $data['akhir'] = $akhir;
            //     $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
            //     $this->session->set_flashdata('data',$data);
            //     // echo "masuk a";
            //     // print_r($data['rekap_total']);
            // }
            // else 
            if(!empty($pic))
            {
                $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiBulanRentangUnit($awal,$akhir,$pic);
                $data['pic'] = $pic;
                $data['awal'] = $awal;
                $data['akhir'] = $akhir;
                $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodicUnit($awal,$akhir,$pic);
                $this->session->set_flashdata('data',$data);
                // echo "masuk b";
            }
            else
            {
                $data['semua_prk'] = $this->Pekerjaan_model->getRealisasiBulanRentang($awal,$akhir);
                $data['rekap_total'] = $this->Pekerjaan_model->getRekapMingguanPeriodic($awal,$akhir);
                $data['awal'] = $awal;
                $data['akhir'] = $akhir;
                $this->session->set_flashdata('data',$data);
                // echo "masuk c";
            }
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            //$data['bulan'] = $this->input->get('bulan');
        }
        array_push($page, array('view' => $this->_folder_view . "realisasi_bulanan_view", 'data' => $data));
        $this->init_page($page, "#nav-list-rencana");   
        //print_r($data['rekap_total']);
    }

    public function cetak_realisasi_bulanan() {
        $this->load->library('Excel');
        $data = $this->session->flashdata('data');
        $this->session->keep_flashdata('data');
        $inputFileName = './template/realisasi_bulanan.xls';
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
            'font' => array(
                'size' => 12,
                'name' => 'Calibri'
                ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );

        $nomor = 1;
        $counter = 7;

        foreach ($data['semua_prk'] as $row) 
        {
            $counter++;

            $sheetData->setCellValue('A' . $counter, $nomor);
            $sheetData->setCellValue('B' . $counter, $row->pekerjaan_no);
            $sheetData->setCellValue('C' . $counter, $row->fungsi_nama); // fungsi
            if($row->pekerjaan_jenis == 1)
            {
                $sheetData->setCellValue('D' . $counter, "Murni"); // jenis    
            }
            else
            {
                $sheetData->setCellValue('D' . $counter, "Luncuran"); // jenis       
            }
            $sheetData->setCellValue('E' . $counter, $row->pekerjaan_uraian);
            if(!empty($data['semua_vendor'][$row->vendor_id]))
            {
                $sheetData->setCellValue('F' . $counter, $data['semua_vendor'][$row->vendor_id]); // vendor
            }
            $sheetData->setCellValue('G' . $counter, $row->pekerjaan_nilai_kontrak); // nilai kontrak
            $sheetData->setCellValue('H' . $counter, $row->pekerjaan_no_kontrak); // nilai kontrak
            $sheetData->setCellValue('I' . $counter, $row->pekerjaan_ai);
            $sheetData->setCellValue('J' . $counter, $row->pekerjaan_aki);
            $sheetData->setCellValue('K' . $counter, $row->total_rencana);
            $sheetData->setCellValue('L' . $counter, $row->total_realisasi);
            $sheetData->setCellValue('M' . $counter, $row->pekerjaan_nilai_kontrak - $row->total_realisasi); // sisa kontrak
            $sheetData->setCellValue('N' . $counter, $row->pekerjaan_aki - $row->total_realisasi); // sisa aki
            $sheetData->setCellValue('O' . $counter, $row->unit_nama); // unit
            $nomor++;
        }
        $counter++;
        // $rekap_total = $data['rekap_total'];
        // $sheetData->setCellValue('A' . $counter, $nomor);
        // $sheetData->setCellValue('C' . $counter, "Total");
        // $sheetData->setCellValue('D' . $counter, $rekap_total->pekerjaan_ai);
        // $sheetData->setCellValue('E' . $counter, $rekap_total->pekerjaan_aki);
        // $sheetData->setCellValue('F' . $counter, $rekap_total->rencana_nilai_1);
        // $sheetData->setCellValue('G' . $counter, $rekap_total->rencana_nilai_2);
        $sheetData->setCellValue('I' . $counter, $data['rekap_total']->total_ai);
        $sheetData->setCellValue('J' . $counter, $data['rekap_total']->total_aki);
        $sheetData->setCellValue('K' . $counter, $data['rekap_total']->rencana_total);
        $sheetData->setCellValue('L' . $counter, $data['rekap_total']->realisasi_total);
        // $sheetData->setCellValue('L' . $counter, $rekap_total->realisasi_nilai_2);
        // $sheetData->setCellValue('M' . $counter, $rekap_total->realisasi_nilai_3);
        // $sheetData->setCellValue('N' . $counter, $rekap_total->realisasi_nilai_4);
        // $sheetData->setCellValue('O' . $counter, $rekap_total->realisasi_total);
        // if(empty($rekap_total->pekerjaan_aki) || $rekap_total->pekerjaan_aki == 0)
        // {
        //     $sheetData->setCellValue('P' . $counter, "0");
        // }
        // else
        // {
        //     $sheetData->setCellValue('P' . $counter, ($rekap_total->realisasi_total/$rekap_total->pekerjaan_aki)*100);
        // }
        // if(empty($rekap_total->rencana_total) || $rekap_total->rencana_total == 0)
        // {
        //     $sheetData->setCellValue('Q' . $counter, "0");
        // }
        // else
        // {
        //     $sheetData->setCellValue('Q' . $counter, ($rekap_total->realisasi_total/$rekap_total->rencana_total)*100);
        // }

        $sheetData->getStyle("A8:O". $counter)->applyFromArray($styleArray);
        $sheetData->getStyle("A8:O". $counter)->getAlignment()->setWrapText(true);
        $filename = 'Laporan Realisasi.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */