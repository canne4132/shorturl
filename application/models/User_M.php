<?php
class User_M extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->user_tb="user";
        $this->user_url_tb="user_url";
        $this->lon_sh_tb="long_short";
    }

    public function select_user($username,$password){
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query=$this->db->get($this->user_tb);
        return $query->result();
    }
}