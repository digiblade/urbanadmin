<?php
defined('BASEPATH') or exit("No direct access allowed");
class Authmodel extends CI_Model{
    public function checkLogin($input){
        $response = false;
        $this->db->where("user_email",$input['email']);
        $data = $this->db->get("tbl_user");
        foreach($data->result() as $row){
            if($row->user_password == $input['password']){
                $response = true;
            }
        }
        return $response;
    }
    public function isUser($email){
        $data = $this->db->get_where("tbl_user",array("user_email"=>$email));
        return $data->num_rows();
    }
    public function registerUser($input){
        
        $response = false;
        if($this->isUser($input['user_email'])==0){
            if($this->db->insert('tbl_user',$input)){
                $response = true;
            }
        }
        return $response;
    }
}