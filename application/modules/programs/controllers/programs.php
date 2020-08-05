<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programs extends CI_Controller{

    function __construct(){

        parent::__construct();

        if ( ! $this->session->userdata('authenticated'))
        {
            redirect('auth');
        }

        $this->load->library('breadcrumbcomponent');
        $this->load->library('sidebar');
        $this->load->model('template/template_model');
        /** Main Table */
        $this->template_model->set_table('master_program');
    }

    function index(){
        redirect('programs/programs_list');
    }

    function initialize_grid(){

        $draw = $_POST['draw'];
        $top    = (isset($_POST['start']))?((int)$_POST['start']):0 ;
        $limit  = (isset($_POST['length']))?((int)$_POST['length'] ):10 ;
        $limit  = $limit+$top;
        $o_colIndex = $_POST['order'][0]['column'];
        $o_colName = $_POST['columns'][$o_colIndex]['data'];
        $colSortOrder = $_POST['order'][0]['dir'];
        $searchValue = $_POST['search']['value']; // Search value
        $arrSearch = array(
            'program_title' => $searchValue,
            'program_url' => $searchValue,
            'program_ico' => $searchValue
        );

        $rResult = $this->template_model->get_where_with_limit($limit, $top, $o_colName, $colSortOrder, $arrSearch);
        $rTotal = $this->template_model->count_all();
        $rFilteredTotal = $this->template_model->count_where_like($arrSearch);

        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $rTotal,
            "recordsFiltered"   => $rFilteredTotal,
            "data"              => array()
        );

		    $data['output']=$output;
		    $data['rResult']=$rResult;

      return $data;
	  }

    function programs_list(){

        $this->breadcrumbcomponent->add('Programs','programs/programs_list');
        $this->breadcrumbcomponent->add('List','#');

        $this->load->view("admin/o_header");
        $this->load->view("programs/programs_list");
        $this->load->view("admin/o_footer");
        $this->load->view("programs/programs_js");
    }

    function controller_gridlist(){

        //$this->session->sess_destroy();

        $result = new \stdClass;

        $vResult = $this->initialize_grid();
        $rResult = $vResult['rResult'];
        $output = $vResult['output'];

        $rownum=0;
        foreach($rResult->result() as $eRow){
            $menu='
                  <a title="Edit" class="btn-edit">
                    <i class="glyphicon glyphicon-edit font-blue-ebonyclay"></i>
                  </a>
                  ';

            $row = array();
            $row['rownum']= $rownum;
            $row['menu']= $menu;
            $row['program_id']= $eRow->program_id;
            $row['program_group_id']= $eRow->program_group_id;
            $row['program_title']= $eRow->program_title;
            $row['program_url']= $eRow->program_url;
            $row['program_ico']= $eRow->program_ico;
            $row['program_class']= $eRow->program_class;
            $rownum++;

            if (!empty($row)) { $output['data'][] = $row; }
        }

        echo json_encode($output);
    }

    function programs_save(){

        //print_r($_POST);exit;
        $username = $this->session->userdata('username');
        $primarykey = 'program_id';

        if (isset($_POST["action"]) && !empty($_POST["action"])) {
            $action = $_POST['action'];
            $formheader = $_POST['header'];
            $options = $_POST['options'];
            $autoid = $options['autoid'];
            //print_r($options['autoid']);exit;
            $oHeader = [];
            foreach ( $formheader as $fieldname => $value) {
              $oHeader[$fieldname] = $value;
            }

            $this->db->trans_begin();
            //$this->db->trans_start(FALSE);

            try {


                if ($action =='insert'){
                    $state = 'insert';
                    if ($autoid){

                        $oHeader[$primarykey] = $this->NewId([]);
                    }
                    //$oHeader->_createby = $username;
                    //$oHeader->_createdate = date("Y-m-d H:i:s");
                    $this->template_model->_insert($oHeader);
                    //$this->db->trans_complete();
                } else {
                    /** Update data */
                    $this->template_model->_update($primarykey, $oHeader[$primarykey], $oHeader);
                }

                $this->db->trans_commit();
                $result = array('status' => true, 'id' => $oHeader[$primarykey], 'message' => 'Success');
            } catch (Exception $e) {
                //log_message('error: ',$e->getMessage());
                $this->db->trans_rollback();
                $result = array('status' => false, 'id' => $oHeader[$primarykey], 'message' => $e->getMessage());
                return;
            } finally {
              echo json_encode($result);
            }
        }
    }

    function NewId($param){
        return uniqid();
    }

    function programs_retrieve(){

        $result = new \stdClass;

        $username = $this->session->userdata('username');
        $primarykey = 'program_id';

        if (isset($_POST["action"]) && !empty($_POST["action"])) {
            $val = $_POST[$primarykey];

            try {

                $SQL = $this->template_model->get_where($primarykey, $val);
                $row = $SQL->result();

                $record = [];

                foreach ($row as $key => $value){
                    $record[$key] = $value;
                }
                $record[0]->program_group_name = $this->groups_select_id($record[0]->program_group_id, 'group_id', 'group_name');

                $result->record = $record;
                $result->status = true;
                //$result->record = $record;
                echo json_encode($result);

            } catch (Exception $ex) {
                throw $ex;
            }
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

    function groups_select(){

        $this->template_model->set_table('master_group');

        $rSearch = empty($_GET['term']) ? '' : $_GET['term'];

        if (is_array($rSearch) && $rSearch['_type'] == 'query'){

           $term = '';
           if (isset($rSearch['term'])) { $term = $rSearch['term']; };

           $arrSearch = array('group_id' => $term, 'group_name' => $term);
           $rGroups = $this->template_model->get_where_or_like_array($arrSearch);
           $items = $rGroups->result();
           $result['items']= $items;

           echo json_encode($result);
        }
    }

    function groups_select_id($value, $id, $name){

        $this->template_model->set_table('master_group');

        $SQL = $this->template_model->get_where($id, $value);
        $row = $SQL->result();
        $record = [];
        foreach ($row as $key => $value){
            $record[$key] = $value;
        }

        $result = $record[0]->$name;

        return $result;
    }

}
