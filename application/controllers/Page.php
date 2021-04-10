<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

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
    public function __construct() {
        parent::__construct();
        // $this->load->library('My_PHPMailer');
        $this->load->model('User_model');
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

    public function dashboard()
    {
        $ch = curl_init();
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            ));
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden-answer");
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);

        $output = json_decode($output,TRUE);   
        $corespon = $output['content'];

        
        $tgl1 = date("Y-m-d");
        $tgl2 = date('Y-m-d', strtotime('-7 days', strtotime($tgl1)));
        $dt1 = new DateTime($tgl1);
        $dt2 = new DateTime($tgl2);
        $tglmax = $dt1->format('Y-m-d');
        $tglmin = $dt2->format('Y-m-d');

        $isi = array();
        $tol = array();
        $bulan = array();
        $puas = array();   
        $tpuas = array();
        $bayar = array();
        $sambung1 = array();
        $sambung2 = array();
        $sambung3 = array();
        $sambung4 = array();
        $info1 = array();
        $info2 = array();
        $info3 = array();
        $info4 = array();


        $pelangganisi = array();
        $pelanggantol = array();
        $pelanggan = array();
        $pelangganpuas = array();
        $pelanggantpuas = array();
        $pelangganbayar = array();
        $penyambungan1 = array();
        $penyambungan2 = array();
        $penyambungan3 = array();
        $penyambungan4 = array();
        $sumberinfo1 = array();
        $sumberinfo2 = array();
        $sumberinfo3 = array();
        $sumberinfo4 = array();


        foreach ($corespon as $row)
        {

        $s = $row['created_at'];
        $dt = new DateTime($s);
        $date = $dt->format('Y-m-d');
        $str = explode("-",$date);
        $date2 = $dt->format('Ymd');
        if($row['survey_id']==1 && $row['id']>=5740){

            if(empty($pelangganisi[$row['mdn']])&&$row['active_question_id']=='1'&&$row['answer']=='Y'){ 
                $pelangganisi[$row['mdn']] = 'true';
                if(empty($isi[$date2]))
                {
                    $isi[$date2] = 1;
                }
                else{
                    $isi[$date2]++;
                }
            }
            if(empty($pelanggantol[$row['mdn']])&&$row['active_question_id']=='1'&&$row['answer']=='T'){ 
                $pelanggantol[$row['mdn']] = 'true';
                if(empty($tol[$date2]))
                {
                    $tol[$date2] = 1;
                }
                else{
                    $tol[$date2]++;
                }
            }

            if(empty($penyambungan1[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='A'){ 
                $penyambungan1[$row['mdn']] = 'true';

                if(empty($sambung1[$date2]))
                {
                    $sambung1[$date2] = 1;
                }
                else{
                    $sambung1[$date2]++;
                }
            }
            if(empty($penyambungan2[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='B'){ 
                $penyambungan2[$row['mdn']] = 'true';

                if(empty($sambung2[$date2]))
                {
                    $sambung2[$date2] = 1;
                }
                else{
                    $sambung2[$date2]++;
                }
            }
            if(empty($penyambungan3[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='C'){ 
                $penyambungan3[$row['mdn']] = 'true';

                if(empty($sambung3[$date2]))
                {
                    $sambung3[$date2] = 1;
                }
                else{
                    $sambung3[$date2]++;
                }
            }
            if(empty($penyambungan4[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='D'){ 
                $penyambungan4[$row['mdn']] = 'true';

                if(empty($sambung4[$date2]))
                {
                    $sambung4[$date2] = 1;
                }
                else{
                    $sambung4[$date2]++;
                }
            }

            if(empty($sumberinfo1[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='A'){ 
                $sumberinfo1[$row['mdn']] = 'true';

                if(empty($info1[$date2]))
                {
                    $info1[$date2] = 1;
                }
                else{
                    $info1[$date2]++;
                }
            }
            if(empty($sumberinfo2[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='B'){ 
                $sumberinfo2[$row['mdn']] = 'true';

                if(empty($info2[$date2]))
                {
                    $info2[$date2] = 1;
                }
                else{
                    $info2[$date2]++;
                }
            }
            if(empty($sumberinfo3[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='C'){ 
                $sumberinfo3[$row['mdn']] = 'true';

                if(empty($info3[$date2]))
                {
                    $info3[$date2] = 1;
                }
                else{
                    $info3[$date2]++;
                }
            }
            if(empty($sumberinfo4[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='D'){ 
                $sumberinfo4[$row['mdn']] = 'true';

                if(empty($info4[$date2]))
                {
                    $info4[$date2] = 1;
                }
                else{
                    $info4[$date2]++;
                }
            }

            if($date<$tglmax && $date>$tglmin)
            {
                
                if(empty($pelanggan[$row['mdn']])){ 
                    $pelanggan[$row['mdn']] = 'true';                    
                    if(empty($bulan[$date2]))
                    {
                        $bulan[$date2] = 1;
                    }
                    else{
                        $bulan[$date2]++;
                    }
                }
                if(empty($pelangganpuas[$row['mdn']])&&$row['active_question_id']=='6'&&$row['answer']=='A'){ 
                    $pelangganpuas[$row['mdn']] = 'true';

                    if(empty($puas[$date2]))
                    {
                        $puas[$date2] = 1;
                    }
                    else{
                        $puas[$date2]++;
                    }
                }
                if(empty($pelanggantpuas[$row['mdn']])&&$row['active_question_id']=='6'&&$row['answer']=='B'){ 
                    $pelanggantpuas[$row['mdn']] = 'true';

                    if(empty($tpuas[$date2]))
                    {
                        $tpuas[$date2] = 1;
                    }
                    else{
                        $tpuas[$date2]++;
                    }
                }
                if(empty($pelangganbayar[$row['mdn']])&&$row['active_question_id']=='5'&&$row['answer']=='A'){ 
                    $pelanggantbayar[$row['mdn']] = 'true';

                    if(empty($bayar[$date2]))
                    {
                        $bayar[$date2] = 1;
                    }
                    else{
                        $bayar[$date2]++;
                    }
                }
                
            }
        }   
        }  

        $ch = curl_init();
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            ));
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);

        $output = json_decode($output,TRUE);   
        $corespon = $output['content'];

        $all = array();
        $pelanggan2 = array();        

        foreach ($corespon as $row)
        {
        if($row['survey_id']==1 && $row['id']>=1013){
            $s = $row['created_at'];
            $dt = new DateTime($s);
            $date = $dt->format('Y-m-d');
            $str = explode("-",$date);
            $date2 = $dt->format('Ymd');
            
            if(empty($pelanggan2[$row['mdn']])){ 
                $pelanggan2[$row['mdn']] = 'true';
                $str = explode("-",$row['created_at']);
                if(empty($all[$date2]))
                {
                    $all[$date2] = 1;
                }
                else{
                    $all[$date2]++;
                }
            }
        }
        }

        $data['bulan'] = $bulan;           
        $data['puas'] = $puas;
        $data['tpuas'] = $tpuas;
        $data['bayar'] = $bayar;
        $data['all'] = $all;
        $data['isi'] = $isi;  
        $data['tol'] = $tol;
        $data['sambung1'] = $sambung1;
        $data['sambung2'] = $sambung2;
        $data['sambung3'] = $sambung3;
        $data['sambung4'] = $sambung4;
        $data['info1'] = $info1;
        $data['info2'] = $info2;
        $data['info3'] = $info3;
        $data['info4'] = $info4;
        // echo "<pre>";
        // print_r($info1);
        // print_r($info2);
        // print_r($info3);
        // print_r($info4);
        // echo "</pre>";
        //print_r($all);
        
        $this->load->view('dashboard/dashboard_view',$data);
    }

    public function dashboard_unit()
    {
        $ch = curl_init();
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            ));
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden-answer");
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);

        $output = json_decode($output,TRUE);   
        $corespon = $output['content'];

        
        $tgl1 = date("Y-m-d");
        $tgl2 = date('Y-m-d', strtotime('-7 days', strtotime($tgl1)));
        $dt1 = new DateTime($tgl1);
        $dt2 = new DateTime($tgl2);
        $tglmax = $dt1->format('Y-m-d');
        $tglmin = $dt2->format('Y-m-d');

        $isi = array();
        $tol = array();
        $bulan = array();
        $puas = array();   
        $tpuas = array();
        $bayar = array();
        $sambung1 = array();
        $sambung2 = array();
        $sambung3 = array();
        $sambung4 = array();
        $info1 = array();
        $info2 = array();
        $info3 = array();
        $info4 = array();


        $pelangganisi = array();
        $pelanggantol = array();
        $pelanggan = array();
        $pelangganpuas = array();
        $pelanggantpuas = array();
        $pelangganbayar = array();
        $penyambungan1 = array();
        $penyambungan2 = array();
        $penyambungan3 = array();
        $penyambungan4 = array();
        $sumberinfo1 = array();
        $sumberinfo2 = array();
        $sumberinfo3 = array();
        $sumberinfo4 = array();


        foreach ($corespon as $row)
        {

        $s = $row['created_at'];
        $dt = new DateTime($s);
        $date = $dt->format('Y-m-d');
        $str = explode("-",$date);
        $date2 = $dt->format('Ymd');
        if($row['survey_id']==1 && $row['id']>=5740){

            if(empty($pelangganisi[$row['mdn']])&&$row['active_question_id']=='1'&&$row['answer']=='Y'){ 
                $pelangganisi[$row['mdn']] = 'true';
                if(empty($isi[$date2]))
                {
                    $isi[$date2] = 1;
                }
                else{
                    $isi[$date2]++;
                }
            }
            if(empty($pelanggantol[$row['mdn']])&&$row['active_question_id']=='1'&&$row['answer']=='T'){ 
                $pelanggantol[$row['mdn']] = 'true';
                if(empty($tol[$date2]))
                {
                    $tol[$date2] = 1;
                }
                else{
                    $tol[$date2]++;
                }
            }

            if(empty($penyambungan1[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='A'){ 
                $penyambungan1[$row['mdn']] = 'true';

                if(empty($sambung1[$date2]))
                {
                    $sambung1[$date2] = 1;
                }
                else{
                    $sambung1[$date2]++;
                }
            }
            if(empty($penyambungan2[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='B'){ 
                $penyambungan2[$row['mdn']] = 'true';

                if(empty($sambung2[$date2]))
                {
                    $sambung2[$date2] = 1;
                }
                else{
                    $sambung2[$date2]++;
                }
            }
            if(empty($penyambungan3[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='C'){ 
                $penyambungan3[$row['mdn']] = 'true';

                if(empty($sambung3[$date2]))
                {
                    $sambung3[$date2] = 1;
                }
                else{
                    $sambung3[$date2]++;
                }
            }
            if(empty($penyambungan4[$row['mdn']])&&$row['active_question_id']=='4'&&$row['answer']=='D'){ 
                $penyambungan4[$row['mdn']] = 'true';

                if(empty($sambung4[$date2]))
                {
                    $sambung4[$date2] = 1;
                }
                else{
                    $sambung4[$date2]++;
                }
            }

            if(empty($sumberinfo1[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='A'){ 
                $sumberinfo1[$row['mdn']] = 'true';

                if(empty($info1[$date2]))
                {
                    $info1[$date2] = 1;
                }
                else{
                    $info1[$date2]++;
                }
            }
            if(empty($sumberinfo2[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='B'){ 
                $sumberinfo2[$row['mdn']] = 'true';

                if(empty($info2[$date2]))
                {
                    $info2[$date2] = 1;
                }
                else{
                    $info2[$date2]++;
                }
            }
            if(empty($sumberinfo3[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='C'){ 
                $sumberinfo3[$row['mdn']] = 'true';

                if(empty($info3[$date2]))
                {
                    $info3[$date2] = 1;
                }
                else{
                    $info3[$date2]++;
                }
            }
            if(empty($sumberinfo4[$row['mdn']])&&$row['active_question_id']=='2'&&$row['answer']=='D'){ 
                $sumberinfo4[$row['mdn']] = 'true';

                if(empty($info4[$date2]))
                {
                    $info4[$date2] = 1;
                }
                else{
                    $info4[$date2]++;
                }
            }

            if($date<$tglmax && $date>$tglmin)
            {
                
                if(empty($pelanggan[$row['mdn']])){ 
                    $pelanggan[$row['mdn']] = 'true';                    
                    if(empty($bulan[$date2]))
                    {
                        $bulan[$date2] = 1;
                    }
                    else{
                        $bulan[$date2]++;
                    }
                }
                if(empty($pelangganpuas[$row['mdn']])&&$row['active_question_id']=='6'&&$row['answer']=='A'){ 
                    $pelangganpuas[$row['mdn']] = 'true';

                    if(empty($puas[$date2]))
                    {
                        $puas[$date2] = 1;
                    }
                    else{
                        $puas[$date2]++;
                    }
                }
                if(empty($pelanggantpuas[$row['mdn']])&&$row['active_question_id']=='6'&&$row['answer']=='B'){ 
                    $pelanggantpuas[$row['mdn']] = 'true';

                    if(empty($tpuas[$date2]))
                    {
                        $tpuas[$date2] = 1;
                    }
                    else{
                        $tpuas[$date2]++;
                    }
                }
                if(empty($pelangganbayar[$row['mdn']])&&$row['active_question_id']=='5'&&$row['answer']=='A'){ 
                    $pelanggantbayar[$row['mdn']] = 'true';

                    if(empty($bayar[$date2]))
                    {
                        $bayar[$date2] = 1;
                    }
                    else{
                        $bayar[$date2]++;
                    }
                }
                
            }
        }   
        }  

        $ch = curl_init();
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            ));
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/coresponden");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);

        $output = json_decode($output,TRUE);   
        $corespon = $output['content'];

        $all = array();
        $pelanggan2 = array();        

        foreach ($corespon as $row)
        {
        if($row['survey_id']==1 && $row['id']>=1013){
            $s = $row['created_at'];
            $dt = new DateTime($s);
            $date = $dt->format('Y-m-d');
            $str = explode("-",$date);
            $date2 = $dt->format('Ymd');
            
            if(empty($pelanggan2[$row['mdn']])){ 
                $pelanggan2[$row['mdn']] = 'true';
                $str = explode("-",$row['created_at']);
                if(empty($all[$date2]))
                {
                    $all[$date2] = 1;
                }
                else{
                    $all[$date2]++;
                }
            }
        }
        }

        $data['bulan'] = $bulan;           
        $data['puas'] = $puas;
        $data['tpuas'] = $tpuas;
        $data['bayar'] = $bayar;
        $data['all'] = $all;
        $data['isi'] = $isi;  
        $data['tol'] = $tol;
        $data['sambung1'] = $sambung1;
        $data['sambung2'] = $sambung2;
        $data['sambung3'] = $sambung3;
        $data['sambung4'] = $sambung4;
        $data['info1'] = $info1;
        $data['info2'] = $info2;
        $data['info3'] = $info3;
        $data['info4'] = $info4;
        // echo "<pre>";
        // print_r($info1);
        // print_r($info2);
        // print_r($info3);
        // print_r($info4);
        // echo "</pre>";
        //print_r($all);
        
        $this->load->view('dashboard/dashboard_unit',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */