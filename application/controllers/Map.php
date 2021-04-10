<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Map extends CI_Controller {

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
        //$this->load->model('Hasil_model');
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

    public function sebaranmap()
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
        $jawaban = array();
        $idpel = array();
        $melakp = array();
        $melaktp = array();
        $sambojap = array();
        $sambojatp = array();
        $sangatap = array();
        $sangatatp = array();
        $kobap = array();
        $kobatp = array();
        $tarakanp = array();
        $tarakantp = array();
        $corespon = $output['content'];
        $no=0;
        foreach ($corespon as $row)
        {
        if($row['survey_id']==1 && $row['id']>=5740){
            $no++;
        
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23141" && $row['answer']=="A")
            {
                $melakp[$no]=$row;
            } 
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23141" && $row['answer']=="B")
            {
                $melaktp[$no]=$row;
            }
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23211" && $row['answer']=="A")
            {
                $sambojap[$no]=$row;
            } 
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23211" && $row['answer']=="B")
            {
                $sambojatp[$no]=$row;
            }   
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23420" && $row['answer']=="A")
            {
                $sangatap[$no]=$row;
            } 
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23420" && $row['answer']=="B")
            {
                $sangatatp[$no]=$row;
            }      
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23120" && $row['answer']=="A")
            {
                $kobap[$no]=$row;
            } 
            if($row['active_question_id']==6 && substr($row['id_pel'],0,5)=="23120" && $row['answer']=="B")
            {
                $kobatp[$no]=$row;
            } 
            if($row['active_question_id']==6 && $row['answer']=="A")
            {
                $tarakanp[$no]=$row;
            } 
            if($row['active_question_id']==6 && $row['answer']=="B")
            {
                $tarakantp[$no]=$row;
            } 
        }              
        }     
        
        $data['melakp']=count($melakp);
        $data['melaktp']=count($melaktp);
        $data['sambojap']=count($sambojap);
        $data['sambojatp']=count($sambojatp);
        $data['sangatap']=count($sangatap);
        $data['sangatatp']=count($sangatatp);
        $data['kobap']=count($sangatap);
        $data['kobatp']=count($sangatatp);
        $data['tarakanp']=count($tarakanp);
        $data['tarakantp']=count($tarakantp);
        $this->load->view('map/map_view',$data);
        //print_r($data);
        
    }

}