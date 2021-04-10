<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question extends CI_Controller {

    
    public function __construct() {
        parent::__construct();        
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

    public function daftar_question()
    {
        // persiapkan curl
        $ch = curl_init(); 

        // set url
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            )); 
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/question");

        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);

        $output = json_decode($output,TRUE);    
 
        $data = array(); 
        $quest = array(); 
        $id2 = array();

        $question = $output['content'];

        foreach($question as $row)
        {   
            if($row['id']<=8){
            array_push($id2,$row['id']);       
            $quest[$row['id']]=$row['question'];
            $survey[$row['id']]=$row['survey_id'];}
        }
        
        
        $data['id']=$id2;
        $data['quest']=$quest;
        $data['survey']=$survey;
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        $this->load->view('question/question_view',$data);
        
    }

    public function ubah_question($id)
    {
        
        $ch = curl_init(); 

        // set url
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey
            )); 
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/question?id=".$id);

        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // tutup curl 
        curl_close($ch);

        $output = json_decode($output,TRUE);    
        $question = $output['content'];
        $data = array();

        foreach($question as $row)
        {
        $data['satu_id']=$row['id'];
        $data['satu_quest']=$row['question'];
        }
        //print_r($data);

        $this->load->view('question/edit_question_view',$data);
        
    }
    public function aksi_ubah_question($id)
    {
        
        $question = $this->input->post('question');
        $ch = curl_init(); 
        $data = array('question'=>$question);
        $datajson = json_encode($data);
        $apiKey = "G8hHOmJGYIgRFihsx7PiKHcl+Rdjbt8mnwdIM/7YFz3BOgd5oMcYLk5RsqwGMA==";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-key: ' . $apiKey, 'Content-Type:application/json'
            )); 
        curl_setopt($ch, CURLOPT_URL, "https://api-wa-auto-reply.coffeincode.my.id/api/question/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');    
        curl_setopt($ch, CURLOPT_POSTFIELDS,$datajson);
         
        $output = curl_exec($ch); 
        
        curl_close($ch);

            // print_r($datajson);
            // echo $output;
        redirect('question/daftar_question');
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */