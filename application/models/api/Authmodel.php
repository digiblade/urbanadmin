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
               
                if($this->addOtp($input)){
                    $response = true;
                };
            }
        }
        return $response;
    }
    public function otpGenerator(){
        $num = mt_rand(100000,999999);
        $data = $this->db->get_where("tbl_otp",array("otp_value"=>$num));
        if($data->num_rows()>0){
            $num = $this->otpGenerator();
        }else{
            return $num;
        }
    }
    public function removeAllOtp($email){
        $response = false;
        $this->db->set('otp_status', 0);
        $this->db->where("otp_useremail",$email);
        if($this->db->update("tbl_otp")){
            $response = true;
        }   
        return $response;
    }
    public function addOtp($input){
        $response = false;
        $otp = $this->otpGenerator();
        $data = array(
            "otp_value"=>$otp,
            "otp_useremail"=>$input['user_email'],
            "otp_status"=>1,
            "otp_creation"=>date("d/m/Y"),
        );
        $this->removeAllOtp($input['user_email']);
        if($this->db->insert("tbl_otp",$data)){
            $response = true;
        }
        return $response;
    }
    public function activeUser($email){
        $response = false;
        $this->db->set("user_status",1);
        $this->db->where("user_email",$email);
        if($this->db->update("tbl_user")){
            $response = true;
        }
        return $response;
    }
    public function verifyEmail($input){
        $response = false;
        $condition = array("otp_useremail"=>$input['user_email'],"otp_value"=>$input['otp_value']);
        $data = $this->db->get_where("tbl_otp",$condition);
        if($data->num_rows() >0){
            
            $this->removeAllOtp($input['user_email']);
            if($this->activeUser($input['user_email'])){
                $response = true;
            }
        }
        return $response;
    }
    public function changePassword($input){
        $response = false;
        $this->db->set("user_password",$input['password']);
        $this->db->where("user_email",$input['email']);
        if($this->db->update("tbl_user")){
            $response = true;
        }
        return $response;
    }
    public function otpVerification($input){
        $response = false;
        $condition = array("otp_useremail"=>$input['email'],"otp_value"=>$input['otp'],"otp_status"=>1);
        $data = $this->db->get_where("tbl_otp",$condition);
        if($data->num_rows() >0){
            
            $this->removeAllOtp($input['email']);
            if($this->changePassword($input)){
                $response = true;
            }
        }
        return $response;
    }
}