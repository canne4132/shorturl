<?php
class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_M');
        $this->load->helper('url');
    }
    public function login($username,$password){
        $result=$this->User_M->select_user($username,$password);
        return $result;
    }
}