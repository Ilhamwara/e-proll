<?php

class Auth404 extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->library('breadcrumbcomponent');
        $this->load->library('sidebar');
    }

    public function index(){

        $this->output->set_status_header('404');

        $this->breadcrumbcomponent->add('404','');

        $this->load->view('admin/o_header');
        $this->load->view('auth/404_view');
        $this->load->view('admin/o_footer');
    }
}

?>
