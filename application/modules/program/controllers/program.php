<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller{

    function __construct(){

        parent::__construct();

        if ( ! $this->session->userdata('authenticated'))
        { 
            redirect('login');
        }

        $this->load->library('breadcrumbcomponent');
        $this->load->library('sidebar');
        $this->load->model('template/template_model');        
        /** Main Table */
        $this->template_model->set_table('master_program');
    }

    function index(){
        redirect('program/program_list');
    }

    function initialize_grid(){		 			

        $top    = (isset($_POST['start']))?((int)$_POST['start']):0 ;
        $limit  = (isset($_POST['length']))?((int)$_POST['length'] ):10 ;
        $limit  = $limit+$top;

        $rResult = $this->template_model->get_with_limit($limit, $top, '');    
        $rTotal = $this->template_model->count_all();   
        $rFilteredTotal = $this->template_model->count_all();

        $output = array(
            //"draw"              => $_POST['draw'],
            "recordsTotal"      => $rTotal,
            "recordsFiltered"   => $rFilteredTotal,
            "data"              => array()
        );
		   		
		    $data['output']=$output;
		    $data['rResult']=$rResult;
	
      return $data;
	  }    

    function program_list(){

        $this->breadcrumbcomponent->add('Program','program/program_view');
        $this->sidebar->set_active('Program');

        $this->load->view("admin/o_header");
        $this->load->view("program/program_view");
        $this->load->view("admin/o_footer");

    }

    function controller_gridlist(){        

        $vResult = $this->initialize_grid();
        $rResult = $vResult['rResult'];
    	  $output = $vResult['output'];

        foreach($rResult->result() as $eRow)            
        {            
            $id = $eRow->program_id;

            $menu='
                  <a href="program_edit/' . $id . '" data-toggle="tooltip" title="Edit" class="btn default btn-xs green"><i class="fa fa-edit"></i></a>
                  <a href="#" data-toggle="tooltip" title="Detail" class="btn default btn-xs green"><i class="fa fa-print"></i></a>
                  <a href="#" data-toggle="tooltip" title="Delete" class="btn default btn-xs green"><i class="fa fa-trash-o"></i></a>
                  ';

            $row = array();
            $row['program_id']= $eRow->program_id;
            $row['program_group_id']= $eRow->program_group_id;
            $row['program_title']= $eRow->program_title;
            $row['program_url']= $eRow->program_url;
            $row['program_ico']= $eRow->program_ico;
            $row['program_class']= $eRow->program_class;
            $row['menu']= $menu;

            if (!empty($row)) { $output['data'][] = $row; }
        }

      echo json_encode($output);            
    }

    function program_new(){

        $this->breadcrumbcomponent->add('Employee','employee/employee_list');
        $this->breadcrumbcomponent->add('New','employee/employee_new');
        $this->sidebar->set_active('Employee');

        $data['region'] = $this->region_select();
        $data['divisi'] = $this->divisi_select();
        $data['jabatan'] = $this->jabatan_select();
        $data['golongan'] = $this->golongan_select();

        $this->load->view("admin/o_header");
        $this->load->view("employee/employee_new", $data);
        $this->load->view("admin/o_footer");

    }

    function employee_add(){

      //print_r($_POST);exit;
      if ($_POST) 
      {
          $NEWDATA = $_POST;      
          
          $employee_id = generate_id_string('EP', 6, 'master_seq');

          $NEWDATA['employee_id'] = $employee_id;        

          $employee_tglahir = inputmask_todate($NEWDATA['employee_tglahir']);          
          $NEWDATA['employee_tglahir'] = $employee_tglahir;

          $employee_start = date('Y-m-d', strtotime($NEWDATA['employee_start']));          
          $NEWDATA['employee_start'] = $employee_start;

          $employee_end = date('Y-m-d', strtotime($NEWDATA['employee_end']));          
          $NEWDATA['employee_end'] = $employee_end;          

          $this->template_model->_insert($NEWDATA); 
      
        redirect("employee/employee_list");
      }

    }

    function employee_edit(){

        $id = $this->uri->segment(3);

        $data = array( 
                  'result'      => $this->employee_select('employee_id', $id),
                  'employee_id' => $id
                ); 

        $this->breadcrumbcomponent->add('Employee','employee/employee_list');
        $this->breadcrumbcomponent->add('Edit','employee/employee_edit');
        $this->sidebar->set_active('Employee');

        $data['region'] = $this->region_select();
        $data['divisi'] = $this->divisi_select();
        $data['jabatan'] = $this->jabatan_select();
        $data['golongan'] = $this->golongan_select();
        $data['sex'] = $this->sex_select();
        $data['agama'] = $this->agama_select();
        $data['status'] = $this->status_select();
        $data['spajak'] = $this->spajak_select();
        $data['bank'] = $this->bank_select();

        $this->load->view("admin/o_header");
        $this->load->view("employee/employee_edit", $data);
        $this->load->view("admin/o_footer");

    }

    function employee_modify(){

      //print_r($_POST);exit;
      if ($_POST) 
      {
          $EDITDATA = $_POST;      
          
          //$employee_id = generate_id_string('EP', 6, 'master_seq');
          //$NEWDATA['employee_id'] = $employee_id;        
          $employee_id = $EDITDATA['employee_id']; 

          $employee_tglahir = inputmask_todate($EDITDATA['employee_tglahir']);          
          $EDITDATA['employee_tglahir'] = $employee_tglahir;

          $employee_start = date('Y-m-d', strtotime($EDITDATA['employee_start']));          
          $EDITDATA['employee_start'] = $employee_start;

          $employee_end = date('Y-m-d', strtotime($EDITDATA['employee_end']));          
          $EDITDATA['employee_end'] = $employee_end;          

          $this->template_model->_update('employee_id', $employee_id, $EDITDATA); 
      
        redirect("employee/employee_list");
      }

    }

    function employee_select($id, $value){

        //$this->template_model->set_table('master_region');
        $rEmployee = $this->template_model->get_where($id, $value);        
        $result = $rEmployee->result();        
        
        return $result;
    }

    function region_select(){

        $this->template_model->set_table('master_region');

        $rRegion = $this->template_model->get('');        
        $options    = array('' => '');             
        foreach($rRegion->result() as $key => $value){
            $options[$value->region_id]= $value->region_name;
        }
                    
        return $options;
    }

    function divisi_select(){

        $this->template_model->set_table('master_divisi');

        $rDivisi = $this->template_model->get('');        
        $options    = array('' => '');             
        foreach($rDivisi->result() as $key => $value){
            $options[$value->divisi_id]= $value->divisi_name;
        }
                    
        return $options;
    }

    function jabatan_select(){

        $this->template_model->set_table('master_jabatan');

        $rJabatan = $this->template_model->get('');        
        $options    = array('' => '');             
        foreach($rJabatan->result() as $key => $value){
            $options[$value->jabatan_id]= $value->jabatan_name;
        }
                    
        return $options;
    }

    function golongan_select(){

        $this->template_model->set_table('master_gol');

        $rGolongan = $this->template_model->get('');        
        $options    = array('' => '');             
        foreach($rGolongan->result() as $key => $value){
            $options[$value->gol_id]= $value->gol_name;
        }
                    
        return $options;
    }

    function sex_select(){

        $options['pria'] = 'PRIA';
        $options['wanita'] = 'WANITA';

        return $options;
    }

    function agama_select(){

        $options['islam'] = 'Islam';
        $options['kristen'] = 'Kristen';
        $options['katolik'] = 'Katolik';
        $options['hindu'] = 'Hindu';
        $options['buddha'] = 'Buddha';
        $options['konghucu'] = 'Konghucu';

        return $options;
    }

    function status_select(){

        $options['single'] = 'Lajang';
        $options['married'] = 'Menikah';

        return $options;
    }

    function spajak_select(){

        $this->template_model->set_table('master_spajak');

        $rSpajak = $this->template_model->get('');        
        $options = array('' => '');             
        foreach($rSpajak->result() as $key => $value){
            $options[$value->spajak_id]= $value->spajak_name;
        }
                    
        return $options;
    }

    function bank_select(){

        $this->template_model->set_table('master_bank');

        $rBank = $this->template_model->get('');        
        $options = array('' => '');             
        foreach($rBank->result() as $key => $value){
            $options[$value->bank_id]= $value->bank_name;
        }
                    
        return $options;
    }

}