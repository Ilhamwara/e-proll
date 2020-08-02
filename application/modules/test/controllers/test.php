<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{
    
    function __construct(){
        
        parent::__construct();        
        // Check login and make sure email has been verified
        //check_user_login();
        
        //$this->load->model('model_jvoucher');
		//$this->load->library('breadcrumbcomponent');
		//$this->load->library('form_validation');
    }
    
    function index(){       
        //redirect('jvoucher/jvoucher/jvoucherlist');
        
    }    
  
    
}  