<?php

class User_model extends CI_Model {

    private $table = "user";
    private $primary_key = "id";
    
    public function get_primary_key() {
        return $this->primary_key;
    }

    public function getByUsernamePassword($username, $password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        $data = $this->db->get($this->table);
        return $data->first_row();
    }

    public function getItSupport() {
        $this->db->where("user_privilage", 2);
        $data = $this->db->get($this->table);
        return $data->result();
    }


}
