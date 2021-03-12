<?php 
defined("BASEPATH") or exit("Direct access not allowed");
class Order extends CI_Controller{
    public function getOrder(){
        $input['email'] = $this->input->post("email");
        
    }
}