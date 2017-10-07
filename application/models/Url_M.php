<?php
/**
 * Created by PhpStorm.
 * User: shixi_anqi8
 * Date: 2017/9/30
 * Time: 11:26
 */
class Url_M extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->long_short_tb='long_short';
        $this->user_url_tb='user_url';
    }
    public function addurl($insertdata,$userid){
        $this->db->insert($this->long_short_tb,$insertdata);
        $urlid=$this->db->insert_id();
        $data=array(
            "user_id"=>$userid,
            "url_id"=>$urlid,
            "status"=>0,
            "time"=>time()
        );
        $id=$this->url_user($data);
        return $id;
    }
    private function url_user($insertdata){
        $this->db->insert($this->user_url_tb,$insertdata);
        return $this->db->insert_id();
    }
    public function selecturl($longurl){
        $this->db->where('longurl',$longurl);
        $query=$this->db->get($this->long_short_tb);
        return $query->result();
    }
    public function geturl(){
        $query=$this->db->query('select * from long_short');
        return $query->result_array();
    }
    public function select_short_url($shorturl){
        $this->db->where('shorturl',$shorturl);
        $query=$this->db->get($this->long_short_tb);
        return $query->result();
    }
}