<?php 
defined("BASEPATH") or exit("Direct access not allowed");
class Productmodel extends CI_Model{
    public function getAllProduct(){
        $data = $this->db->get("tbl_category");
        return $data->result();
    }
    public function addCategory($input){
        $response =false;
        if($this->db->insert("tbl_category",$input)){
            $response = true;
        }
        return $response;
    }
}