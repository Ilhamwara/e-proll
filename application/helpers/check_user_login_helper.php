<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	 function check_user_login()
    {                             
	 $CI =& get_instance();
     $CI->load->library('session');
	 $CI->session->set_userdata('user_fullname','nachadong@gmail.com'); 
	 $CI->session->set_userdata('username','nacha');
	 $CI->session->set_userdata('channel_id','TRP');
     
    }

 
	
	 
          
     