<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LongToShort extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Url_M');
        $this->load->helper('url');
    }
    public function index()
    {
        $this->load->view('lo_sh');
    }

    private function do_md5($longurl)
    {
        $base32 = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
            'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
            'y', 'z', '0', '1', '2', '3', '4', '5'
        );
        $hex = md5($longurl);
        $hexLen = strlen($hex);
        $subHexLen = $hexLen / 8;
        $output = array();
        for ($i = 0; $i < $subHexLen; $i++) {
//把加密字符按照8位一组16进制与0x3FFFFFFF(30位1)进行位与运算
            $subHex = substr($hex, $i * 8, 8);
            $int = 0x3FFFFFFF & (1 * ('0x' . $subHex));
            $out = '';
            for ($j = 0; $j < 6; $j++) {
//把得到的值与0x0000001F进行位与运算，取得字符数组chars索引
                $val = 0x0000001F & $int;
                $out .= $base32[$val];
                $int = $int >> 5;
            }
            $output[] = $out;
        }
        return $output;
    }
    public function addurl(){
        $userid = $this->session->userdata('userid');
        $longurl = $this->input->post('longurl');
        if(!trim($longurl)){
            redirect('LongToShort');
        }
        $dburl=$this->Url_M->selecturl($longurl);
        if($dburl==null){
            $shorturl = $this->do_md5($longurl);
            $shurl = $shorturl[array_rand($shorturl)];
            $insertdata = array(
                "longurl" => $longurl,
                "shorturl" => $shurl,
                "createtime" => time()
            );
            $urlid=$this->Url_M->addurl($insertdata,$userid);
        }
        redirect('LongToShort');
    }

    public function geturl(){
        $result=$this->Url_M->geturl();
        header("Content-Type:text/html;charset=UTF-8");
        header("Cache-Control:no-cache");
        echo json_encode($result);
    }

    public function jumpurl($shorturl){
        $result=$this->Url_M->select_short_url($shorturl);
        if($result!=null){
            echo "<script>window.open('".$result[0]->longurl."')</script>";
            $this->index();
        }
    }
}




