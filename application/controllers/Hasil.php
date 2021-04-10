<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hasil extends CI_Controller {

    
    public function __construct() {
        parent::__construct();    
        require_once APPPATH.'third_party/Classes/PHPExcel.php';
        require_once APPPATH.'third_party/Classes/PHPExcel/Writer/CSV.php';
    }

    public function init_page($page) {
        /**
         * parameter $page berupa array yang mengandung 
         * page view dan array data untuk masing masing view
         */
        if($this->session->userdata('sesi'))
        {
            // $this->load->view('header_view');
            // $this->load->view('sidebar_view');
            foreach ($page as $p) {
                $this->load->view($p['view'], $p['data']);
            }
            // $this->load->view('footer_view');
        }
        else
        {
            redirect('login');
        }
    }

    public function index() {
        if ($this->session->userdata('sesi')) {
            redirect('page/dashboard');
        } else {
            redirect('login');
        }
    }

    public function login() {
        if ($this->session->flashdata('item')) {
            $data['message'] = $this->session->flashdata('item');
            $this->load->view('login_view', $data);
        } else {
            $this->load->view('login_view');
        }
    }

    public function cek_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array();
        $data = $this->User_model->getByUsernamePassword($username,$password);
        if($data)
        {
            $this->session->set_userdata('sesi',$data);
            redirect('page/dashboard');
            // echo "berhasil login";
        }
        else
        {
            redirect('login');
            //echo "gagal login";
        }
    }

    public function cetak_session()
    {
        print_r($this->session->userdata('sesi'));
    }

    public function logout()
    {
        $this->session->unset_userdata('sesi');
        redirect('login');
    }

    public function daftar_hasil()
    {
        // persiapkan curl
        $ch = curl_init(); 

        // set url
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            )); 
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden-answer");

        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);

        $output = json_decode($output,TRUE);    
 
        $data = array();
        $pelanggan = array();
        $jawaban = array();

        $corespon = $output['content'];
        $flag_pelanggan = array();
        $tanggal = array();
        $idpel = array();
        foreach ($corespon as $row)
        {
            if($row['survey_id']==1 && $row['id']>=5740){
            $jawaban[$row['mdn']][$row['active_question_id']]=$row['answer'];
            if(empty($flag_pelanggan[$row['mdn']]))
            {
                $flag_pelanggan[$row['mdn']] = true;
                array_push($pelanggan,$row['mdn']);
                $tanggal[$row['mdn']] = $row['created_at'];
                $idpel[$row['mdn']] = $row['id_pel'];
            }}
            
        }
        
        $data['tanggal'] = $tanggal;
        $data['idpel'] = $idpel;
        $data['pelanggan']=$pelanggan;
        $data['jawaban']=$jawaban;

        $this->load->view('hasil/hasil_view',$data);
        
    }

    public function broadcast()
    {
        $this->load->view('hasil/broadcast_view');
    }

    public function send_satu()
    {
        $mdn = $this->input->post('mdn');
        $idpel = $this->input->post('idpel');        
        $data = array('mdn'=>$mdn,
              'id_pel'=>$idpel);
        $datajson = json_encode($data);
        $ch = curl_init(); 
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey, 'Content-Type:application/json'
            )); 
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$datajson);
         
        $output = curl_exec($ch); 
        
        curl_close($ch);
        if(substr($output,0,30) == '{"code":200,"message":"Success')
            {$this->session->set_flashdata('pop',"1");}
        else
            {$this->session->set_flashdata('pop',"2");}
       
        
       redirect('hasil/broadcast');
        
    }

    public function send()
    {               
        $notif = array();
        $dir = "upload/";                 // Main Directory Name 
        $file_arr = array();
        $file_ext_arr = array('xls','xlsx');            // Valid Extensions of Excel File    
    
        if(!empty($_FILES)) {
            $info = pathinfo($_FILES['fileku']['name']);
            $ext = $info['extension']; // get the extension of the file
            $newname = "excelfile.".$ext;     
            $target = $dir.$newname;
            move_uploaded_file( $_FILES['fileku']['tmp_name'], $target);

            if(is_dir($dir))
            {
                if($dh = opendir($dir))
                {
                    while(($file = readdir($dh)) !== false)
                    {
                        $info = new SplFileInfo($file);
                        $ext = $info->getExtension();           // Get Extension of Current File
                        if(in_array($ext,$file_ext_arr))
                        {
                            array_push($file_arr, $file);
                        }
                    }
                    closedir($dh);
                }
            }
            $list = array();   
            foreach($file_arr as $val)
            {
                
                $arr_data = array();
                $mdn = array();
                $idpel = array();
                $objPHPExcel = PHPExcel_IOFactory::load($dir . $val);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                foreach($cell_collection as $cell)
                {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    if($column == 'A' && $row>=2)
                    {
                        $nomor[$row][$column] = $data_value;
                    }
                    if($column == 'B' && $row>=2)
                    {
                        //$arr_data[$row]['row'] = $row;
                        $id[$row][$column] = $data_value;
                    } 
                                                                
                }

                for($i=2;$i<=$row;$i++){

                        // echo $mdn[$i]['A'];echo "<pre>";
                        // echo $idpel[$i]['B'];echo "<pre>";                    
                        $mdn = $nomor[$i]['A'];
                        $idpel = $id[$i]['B'];
                        $data = array('mdn'=>$mdn,
                            'id_pel'=>$idpel);
                        $datajson = json_encode($data);
                        $ch = curl_init(); 
                        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'X-key: ' . $apiKey, 'Content-Type:application/json'
                            )); 
                        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');        
                        curl_setopt($ch, CURLOPT_POSTFIELDS,$datajson);
                            
                        $output = curl_exec($ch); 
                        
                        curl_close($ch); 
                        $notif['popup'][$i] = $output;
                }        
                            
            }
            
        }
        if(substr($output,0,30) == '{"code":200,"message":"Success')
            {$this->session->set_flashdata('pop',"1");}
        else
            {$this->session->set_flashdata('pop',"2");}

        redirect('hasil/broadcast');
    }
    
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */