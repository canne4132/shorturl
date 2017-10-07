<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_M');
        $this->load->helper('url');
    }
    public function index(){
        if(empty($_SESSION['userid'])){
            echo "<script>alert('请重新登录')</script>";
            $this->load->view('login');
        }else{
            redirect('LongToShort');
        }
    }
    public function userlogin(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $result=$this->login($username,$password);
        if(!$result){
            echo "<script>alert('用户名或密码错误')</script>";
            $this->load->view("login");
        }else{
            $userdata=array(
                'username'=>$username,
                'userid'=>$result[0]->id
            );
            $this->session->set_userdata($userdata);
            $this->load->view('lo_sh');
        }
        $data["result"]=$result;
    }
}