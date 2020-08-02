<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar {
    protected $_ci;
    protected $_selectedgroup;

    function __construct(){
        $this->_ci = &get_instance();     
        $this->_URI = $this->_ci->uri->segment(1);
    }

    function set_active($group){
        $this->_selectedgroup = $group;      
    }

    // Get table from table property
    function get_active() {       
            
      $this->_ci->load->model('template/template_model');
      $this->_ci->template_model->set_table('master_program');      
      //$URI_string = $this->_ci->uri->uri_string();
      $SQL = $this->_ci->template_model->get_where('program_class', $this->_URI);
      $row = $SQL->row();      
      $group_id = isset($row) ? $row->program_group_id : '';   
      //$group = $this->_selectedgroup;
      return $group_id;
    }

    function render(){

      $this->_ci->load->model('template/template_model');
      
      if ( $this->get_active() != 'Home' ){
          $side = '<li class="start">
              <a href="javascript:;">
              <i class="icon-home"></i>
              <span class="title">Home</span>                              
              </a></li>';
      }else{          
          $side = '<li class="start active">
              <a href="javascript:;">
              <i class="icon-home"></i>
              <span class="title">Home</span>
              <span class="selected"></span>                  
              </a></li>';
      }

      $this->_ci->template_model->set_table('master_group');
      $group = $this->_ci->template_model->get('');  

      /** Group Loop */                	
      foreach ($group->result() as $main){  
          $group_id = $main->group_id;
          $group_ico = $main->group_ico;
          $group_name = $main->group_name;

          $group_active = ($this->get_active() == $group_id) ? 'active open' : ''; 
          $group_selected = ($this->get_active() == $group_id) ? '<span class="selected"></span>' : '';           
          $arrow_open = ($this->get_active() == $group_id) ? 'open' : ''; 

          $induk = '<li class="'.$group_active.'">
                      <a href="javascript:;">
                      <i class="'.$group_ico.'"></i>
                      <span class="title">'.$group_name.'</span>
                      ' . $group_selected .
                      '<span class="arrow '.$arrow_open.'"></span></a>';     
          /** Program Loop */                 
          $this->_ci->template_model->set_table('master_program');
          $modul = $this->_ci->template_model->get_where_custom_sort('program_group_id', $group_id, 'program_title');                              
          $sub = $modul->result_array();
          if (is_array($sub)) {              
            $cabang = '<ul class="sub-menu">';
            foreach ($sub as $eRow){                                    
                $program_title = $eRow['program_title'];
                $program_url = $eRow['program_url'];
                $program_class = $eRow['program_class'];
                
                $program_active =  ($this->_URI === $program_class) ? 'active' : '';
                $cabang .= '<li class="'.$program_active.'"><a href="'.site_url($program_url).'">'.$program_title.'</a></li>';
            } 
            $induk .= $cabang . '</ul>';
          }
        $side .= $induk . '</li>';
      }               

      return $side;
    }
}