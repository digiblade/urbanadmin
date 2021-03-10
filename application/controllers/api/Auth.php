<?php 
defined("BASEPATH") or exit("no direct access allowed");
class Auth extends CI_Controller{
    public function index(){
        echo "api controller";
    }
    public function checkLogin(){
        $input['email'] = $this->input->post("email");
        $input['password'] = md5($this->input->post("password"));
    }
}