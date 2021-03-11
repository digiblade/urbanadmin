<?php 
defined("BASEPATH") or exit("Direct access not allowed");
class Productmodel extends CI_Model{
    public function getAllCategory(){
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
    public function getAllSubCategory(){
        $data = $this->db->get("tbl_subcategory");
        return $data->result();
    }
    public function addSubCategory($input){
        $response =false;
        if($this->db->insert("tbl_subcategory",$input)){
            $response = true;
        }
        return $response;
    }
}