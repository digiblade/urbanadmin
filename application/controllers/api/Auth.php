<?php 
defined("BASEPATH") or exit("no direct access allowed");
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("api/Authmodel","auth");
    }
    public function index(){
        echo "api controller";
    }
    public function checkLogin(){
        $input['email'] = $this->input->post("email");
        $input['password'] = md5($this->input->post("password"));
        $msg['response'] = $this->auth->checkLogin($input);
        echo json_encode($msg);
    }
    public function userRegister(){
        $input['user_email'] = $this->input->post("email");
        $input['user_name'] = $this->input->post("username");
        $input['user_mobile'] = $this->input->post("mobile");
        $input['user_status'] = 0;
        $input['user_creation'] = date("d/m/Y");
        $input['user_password'] = md5($this->input->post("password"));
        $msg['response'] = $this->auth->registerUser($input);
        echo json_encode($msg);
    }
    public function userVerification(){
        $input['user_email'] = $this->input->post("email");
        $input['otp_value'] = $this->input->post("otp");
        $msg['response'] = $this->auth->verifyEmail($input);
        echo json_encode($msg);
    }
    public function generateOTP(){
        $input['user_email'] = $this->input->post("email");
        $msg['response'] = $this->auth->addOtp($input);
        echo json_encode($msg);
    }
    public function forgetPassword(){
        $input['otp'] = $this->input->post('otp');
        $input['email'] = $this->input->post('email');
        $input['password'] = md5($this->input->post("password"));
        $msg['response'] = $this->auth->otpVerification($input);
        echo json_encode($msg);
    }
}