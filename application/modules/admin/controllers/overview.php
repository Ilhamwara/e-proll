<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends CI_Controller {

    public function __construct(){
        parent::__construct();
      
        if ( ! $this->session->userdata('authenticated'))
        { 
            redirect('login');
        }

        $this->load->library('breadcrumbcomponent');
        $this->load->library('sidebar');
        //$this->load->model('template/template_model');
        $this->load->model('template/template_model');  

        $this->template_model->set_table('master_employee');
    }

    function index(){

        $this->breadcrumbcomponent->add('Dashboard','');
        $this->sidebar->set_active('Home');


        $rTotal = $this->template_model->count_all();   


        $data['test'] = $rTotal;

           
        $this->load->view("admin/o_header");
        $this->load->view("admin/_partials/mainboard", $data);
        $this->load->view("admin/o_footer");
    }

} 

?>