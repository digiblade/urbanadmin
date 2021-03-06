<?php 
defined("BASEPATH") or exit("direct access not allowed");
class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("api/Productmodel","product");
        

    }
    public function allCategory(){
        $data['products'] = $this->product->getAllCategory();
        echo json_encode($data);
    }
    public function addCategory(){
        $msg['response'] = false;
        $msg['error'] = "Nothing";
        $config['upload_path'] = './assets/category/';
        $config['allowed_types'] =  'png|jpg|jpeg|PNG|JPG|JPEG';
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('image')){
            $msg['error'] = $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            $imagename = $data['raw_name'].$data['file_ext'];
            $input['category_name'] = $this->input->post("category") ;
            $input['category_description'] = $this->input->post("description");
            $input['category_image'] = base_url().'assets/category/'.$imagename;
            $input['category_status'] = 1;
            $input['category_creation'] = date("d/m/Y");
            $msg['response']=$this->product->addCategory($input);

            
        }
        echo json_encode($msg);
    }
   
    public function allSubCategory(){
        $data['products'] = $this->product->getAllSubCategory();
        echo json_encode($data);
    }
    public function addSubCategory(){
        $msg['response'] = false;
        $msg['error'] = "Nothing";
        $config['upload_path'] = './assets/subcategory/';
        $config['allowed_types'] =  'png|jpg|jpeg|PNG|JPG|JPEG';
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('image')){
            $msg['error'] = $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            $imagename = $data['raw_name'].$data['file_ext'];
            $input['subcategory_name'] = $this->input->post("subcategory") ;
            $input['subcategory_description'] = $this->input->post("description");
            $input['subcategory_image'] = base_url().'assets/subcategory/'.$imagename;
            $input['subcategory_status'] = 1;
            $input['subcategory_creation'] = date("d/m/Y");
            $input['category_id'] = $this->input->post("categoryid");
            $msg['response']=$this->product->addSubCategory($input);   
        }
        echo json_encode($msg);
    }
}