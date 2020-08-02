<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jvoucher extends CI_Controller{
    
    function __construct(){
        
        parent::__construct();        
        // Check login and make sure email has been verified
        //check_user_login();
        
        $this->load->model('model_jvoucher');
		$this->load->library('breadcrumbcomponent');
		$this->load->library('form_validation');
    }
    
    function index(){       
        redirect('jvoucher/jvoucher/jvoucherlist');
    }
    function globalsearch_dialog(){
		$arcari=array('unit_name', 'region_id', 'branch_id');
		return $arcari;
	}   
    function globalsearch_rekanan(){
        $arcari=array('rekanan_name','rekananshipping_name', 'branch_id');
        return $arcari;
    }    
	
    function globalsearch_new(){
        $arcari=array('unittype_id');
        return $arcari;
    }  

    function globalsearch_detil(){
        $arcari=array('loo_id');
        return $arcari;
    }  
	
	function controler_griddialog(){
    	$arcari=$this->globalsearch_dialog();
    	$vResult=$this->initialize_grid("qry_alldatadialog","qry_filtereddialog","qry_totalalldialog",$arcari);
    	$rResult=$vResult['rResult'];
    	$output=$vResult['output'];

    	foreach ($rResult as $aRow) {
            $row = array();
    		$id=$aRow['unit_id'];
                    $row[]=$aRow['unit_id'];
    				$row[]=$aRow['unit_name'];
    				$row[]=$aRow['unit_sqm'];
    				$row[]=$aRow['lantai_name'];
                    $row[]=$aRow['lantai_id'];

            if (!empty($row)) { $output['data'][] = $row; }
        	}   
        	echo json_encode($output);
		
    }

    function controler_gridpop(){
        $arcari=$this->globalsearch_rekanan();

        $vResult=$this->initialize_grid("qry_alldatapop","qry_filteredpop","qry_totalallpop",$arcari);
        $rResult=$vResult['rResult'];
        $output=$vResult['output'];        

        foreach ($rResult as $aRow) {
            $row = array();
            $id=$aRow['rekanan_id'];
                    $row[]= '';
                    $row[]= $aRow['rekanan_id'];
                    $row[]= $aRow['rekanan_name'];
                    $row[]= $aRow['rekananshipping_line'];
                    $row[]= $aRow['rekananshipping_name'];
                    $row[]= $aRow['debtor_no'];

            if (!empty($row)) { $output['data'][] = $row; }
            }   
            echo json_encode($output);
            
    }

    function controler_gridtenant(){
        //print_r($_POST);
        $line_no =  isset($_POST['line_no']) ? $_POST['line_no']: 0 ;  

        $arcari=$this->globalsearch_rekanan();

        $vResult=$this->initialize_grid("qry_alldatapop","qry_filteredpop","qry_totalallpop",$arcari);
        $rResult=$vResult['rResult'];
        $output=$vResult['output'];        

        foreach ($rResult as $aRow) {
            $row = array();
            $id=$aRow['rekanan_id'];
                    $row[]= '';
                    $row[]= $aRow['rekanan_id'];
                    $row[]= $aRow['rekanan_name'];
                    $row[]= $aRow['rekananshipping_line'];
                    $row[]= $aRow['rekananshipping_name'];
                    $row[]= $aRow['debtor_no'];
                    $row[]= $line_no;

            if (!empty($row)) { $output['data'][] = $row; }
            }   
            echo json_encode($output);
            
    }

    function controler_gridnew(){
        $arcari=$this->globalsearch_new();
        $vResult=$this->initialize_grid("qry_alldatanew","qry_filterednew","qry_totalallnew",$arcari);
        $rResult=$vResult['rResult'];
        $output=$vResult['output'];

        foreach ($rResult as $aRow) {
            $row = array();
            
            $id=$aRow['loo_id'];
            $row[]=$aRow['loo_id'];
            $row[]=$aRow['loo_sdate'];
            $row[]=$aRow['loo_edate'];
            $row[]=$aRow['_createby'];
            $row[]=$aRow['_createdate'];
            $row[]=$aRow['region_name'];
            $row[]=$aRow['branch_name'];
            $row[]=$aRow['region_id'];
            $row[]=$aRow['branch_id'];
            $row[]=$aRow['size_indoor'];
            $row[]=$aRow['size_outdoor'];
            $row[]=$aRow['fitting_out'];
            $row[]=$aRow['grace_period'];
            $row[]=$aRow['product_name'];
            $row[]=$aRow['loounit_term'];

            if (!empty($row)) { $output['data'][] = $row; }
            }   
            echo json_encode($output);
            
    }

    function controler_gridnewdetil(){
        $arcari=$this->globalsearch_detil();
        $vResult=$this->initialize_grid("qry_alldatadetil","qry_filtereddetil","qry_totalalldetil",$arcari);
        $rResult=$vResult['rResult'];
        $output=$vResult['output'];

        foreach ($rResult as $aRow) {
            $row = array();
            
            $id=$aRow['loo_id'];
            $row[]=$aRow['loo_id'];
            $row[]=$aRow['rekanan_id'];
            $row[]=$aRow['rekanan_name'];
            $row[]=$aRow['rekananshipping_line'];
            $row[]=$aRow['rekananshipping_name'];
            $row[]=$aRow['debtor_no'];

            if (!empty($row)) { $output['data'][] = $row; }
            }   
            echo json_encode($output);
            
    }
    
	function globalsearch_list(){
		$arcari=array('jurnal_id',  'jurnaltype_id','jurnal_source','periode_id','jurnal_createby');
		return $arcari;
	}
	
	function initialize_grid($qry_alldata,$qry_filtered,$qry_totalall,$arcari,$cariOptional = ''){
		$aColumns = $arcari;
     
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) ) {
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".addslashes( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ) {
				$sOrder = "";
			}
		}
		   
		$sWhere = ""; 
		if ( isset($_POST['search']['value']) && $_POST['search']['value'] != "" ) {
		   $sWhere = "WHERE ("; 
			for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
				$sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_POST['search']['value'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

		for ($i=0; $i < count($aColumns); $i++) {
			if ( isset($_POST['columns'][$i]['search']['value']) && $_POST['columns'][$i]['search']['value'] != "" ) { 
				$searchCol = trim($_POST['columns'][$i]['search']['value']);
				if ($searchCol != '') {
					if ($sWhere != ''){             
						$sWhere .= " AND ". $aColumns[$i] . " LIKE '%".$searchCol."%'";
					} else {
						$sWhere = "WHERE ". $aColumns[$i] . " LIKE '%".$searchCol."%'";
					}
					 $sWhere .=  $cariOptional <> '' ?  $cariOptional . " AND " : '' ;
					
				}
			}
		}
		 
		
		$top = (isset($_POST['start']))?((int)$_POST['start']):0 ;
		$limit = (isset($_POST['length']))?((int)$_POST['length'] ):10 ;
		$limit=$limit+$top;

		$b =  $cariOptional <> '' ?   " AND ".$cariOptional  : '' ;        

		$sWhere = $sWhere.$b;
		
		$rResult=$this->model_jvoucher->$qry_alldata($limit,$top,$sWhere);
			
		$rResultCnt =$this->model_jvoucher->$qry_filtered($sWhere);
		$iFilteredTotal = $rResultCnt['jml'];

		$rResultTotal =$this->model_jvoucher->$qry_totalall();
		$iTotal = $rResultTotal['jml'];
		   
		$output = array(
			"draw"=> $_POST['draw'],
			"recordsTotal" => $iTotal,
			"recordsFiltered" => $iFilteredTotal,
			"data" => array()
		);
		  $data['output']=$output;
		  $data['rResult']=$rResult;
	
		return $data;
	}    


    function controler_gridlist($val_search = ''){
		$arcari=$this->globalsearch_list(); 
		$searchStatus = $val_search;
		
		
		$criteria = null; 
		if($searchStatus == 'app')
		{
			if(!empty($criteria))
			{
				$criteria = $criteria." AND CTE.isapproved = 1";
			}
			else
			{
				$criteria =  " CTE.isapproved = 1";
			}
		}
		elseif($searchStatus == 'ret')
		{
			if(!empty($criteria))
			{
				$criteria = $criteria." AND CTE.isconfirm = 1";
			}
			else
			{
				$criteria =  " CTE.isconfirm = 1";
			}	
		} 
		elseif($searchStatus == 'not_app')
		{
			if(!empty($criteria))
			{
				$criteria = $criteria." AND CTE.isapproved = 0";
			}
			else
			{
				$criteria =  " CTE.isapproved = 0";
			}	
		}
		elseif($searchStatus == 'not_ret')
		{
			if(!empty($criteria))
			{
				$criteria = $criteria." AND CTE.isconfirm = 0";
			}
			else
			{
				$criteria =  " CTE.isconfirm = 0";
			}	
		} 
		elseif($searchStatus == 'all')
		{
			 $criteria = null ; 
		}
		elseif($searchStatus == 'k')
		{
			 $criteria = null ; 
		}
		
    	$vResult=$this->initialize_grid("qry_alldatalist","qry_filteredlist","qry_totalalllist",$arcari,$criteria);
    	$rResult=$vResult['rResult'];
    	$output=$vResult['output'];

      //print_r($rResult);exit;
    	foreach ($rResult as $aRow) {

            $i_link = str_replace('/', '_', $aRow['jurnal_id']);

            $ship_name = substr($aRow['rekanan_name'], 0, 15) . '...';
            $is_post = ($aRow['jurnal_isposted']) ? 1 : 0;

            $_menu='
                <a href="/index.php/jvoucher/jvoucher/jvoucheredit/'.$i_link.'" data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit fa-lg"></i></a>
                <a href="/index.php/laprint5/laprint5/laprint5pdf/'.$i_link.'" data-toggle="tooltip" title="Edit" target="_blank">
                <i class="fa fa-print fa-lg"></i></a>
                <a href="/index.php/jvoucher/jvoucher/jvoucher_delete/'.$i_link.'" data-toggle="tooltip" title="Trash" onclick="return deleteid('.$is_post.')">
                <i class="fa fa-trash fa-lg"></i></a>';

            $row = array();

			      $row[]=$aRow['jurnal_id'];            
            $row[]=date("d-m-Y", strtotime($aRow['jurnal_bookdate']));
			      $row[]=number_format($aRow['jurnal_amountidr'], 2);
			      $row[]=$aRow['branch_name'];
            $row[]=$ship_name;
            $row[]=$aRow['strukturunit_name'];
            ///<input type="checkbox" id="posted"'. ($rowd->utilitieslistrikdetil_isposted == 1 ? 'checked= "checked"' : '').
            //$row[]=$aRow['jurnal_isposted'];
            $row[] = '<input type="checkbox" id="posted"'. ($aRow['jurnal_isposted'] == 1 ? 'checked= "checked"' : '').' disabled>';
			      $row[]=$_menu;
    	
            if (!empty($row)) { $output['data'][] = $row; }
        	}   
        	echo json_encode($output);    		
    }

    function jvoucherlist(){
        
        $jurnal_id = $this->uri->segment(4);
        $data   = array(
                  'result'      => $this->model_jvoucher->viewjurnal($jurnal_id),
                  'jurnal_id'   => $jurnal_id
            );        

        $data['source'] = $this->source_select();
		
		$this->breadcrumbcomponent->add('Entry Journal','jvoucher/jvoucherlist');

        $this->load->view('template/v_header');
        $this->load->view('jvoucher/jvoucher_list', $data);
        $this->load->view('template/v_footer');
    }
    
    function jvoucheradd()
	{    
        $jurnal_id = $this->uri->segment(4);  
        
        $data   = array(
                  'result'      => $this->model_jvoucher->viewjurnal($jurnal_id),
                  'jurnal_id'   => $jurnal_id
            );        
        
        $data['region']     = $this->region_select();
        $data['source']     = $this->source_select();
        $data['struktur']   = $this->strukturnit_select();
        $data['account']    = $this->acc_select();
        $data['period']     = $this->periode_select();
        $data['channel']    = $this->session->userdata('channel_id');

  		$this->breadcrumbcomponent->add('List Journal','jvoucher/jvoucher/jvoucherlist')
             ->add('Add Journal','jvoucher/jvoucher/jvoucheradd');


        $this->load->view('template/v_header');
        $this->load->view('jvoucher/jvoucher_add', $data);
        $this->load->view('template/v_footer');
	}
    
	
	function jvoucheredit(){		
        
        $i_link = $this->uri->segment(4);  

        $_id = str_replace('_', '/', $i_link);     

        $data   = array(
                  'result'       => $this->model_jvoucher->viewjurnal($_id),
                  'jurnal_id'    => $_id
            );                
        
        $data['region']         = $this->region_select();
        $data['branch']         = $this->branch_select();
        $data['struktur']       = $this->strukturnit_select();
        $data['account']        = $this->acc_select();
        $data['period']         = $this->periode_select();

        $data['resultd']        = $this->model_jvoucher->vdetiljurnal($_id);
		
	    $this->breadcrumbcomponent->add('List Journal','jvoucher/jvoucher/jvoucherlist')
             ->add('Edit Journal','jvoucher/jvoucher/jvoucheredit');        

        $this->load->view('template/v_header');
        $this->load->view('jvoucher/jvoucher_edit', $data);
        $this->load->view('template/v_footer');
	}    
    
    function region_select(){
        $this->load->model('template/Master_m');
        
        $region     = $this->Master_m->get_region();
        //$options    = array('' => 'Select an option');                
        
        if(count($region)){
            foreach($region as $key => $value){
                $options[$value->region_id]= $value->region_name;
            }
        }
                    
        return $options;
    }
    
    function branch_select(){

        $rSearch = empty($_GET['term']) ? '' : $_GET['term'];
        //$rRegion = empty($_GET['region']) ? '' : $_GET['region'];


        if (is_array($rSearch) && $rSearch['_type'] == 'query'){            

            $this->load->model('template/Master_m');
            
            $branch      = $this->Master_m->get_branchbyall($rSearch['term']);
            
            $result['items']= $branch;
          
            echo json_encode($result);
            
        };
    }   

    function acc_select(){
         
        $account = $this->model_jvoucher->get_acc();              
        
        if(count($account)){
            foreach($account as $key => $value){
                $options[$value->acc_id]= $value->acc_name;
            }
        }
                    
        return $options;
    }   

    function periode_select(){
         
        $periode = $this->model_jvoucher->get_periode();              
        
        if(count($periode)){
            foreach($periode as $key => $value){
                $options[$value->periode_id]= $value->periode_name;
            }
        }
                    
        return $options;
    }   

    function strukturnit_select(){
        $this->load->model('template/Master_m');
        
        $strukturunit = $this->Master_m->get_strukturunit();              
        
        if(count($strukturunit)){
            foreach($strukturunit as $key => $value){
                $options[$value->strukturunit_id]= $value->strukturunit_name;
            }
        }
                    
        return $options;
    }

    function source_select() {
        $source = $this->model_jvoucher->get_journalsource();

        if(count($source)){
            foreach($source as $key => $value){
                $options[$value->jurnalsource_id]= $value->jurnalsource_name;
            }
        }
                    
        return $options;
    }   

    function agreement_add(){

        if ($_POST){

            //print_r($_POST);            
            $_contractno        = $this->input->post('idebtor');
            $_formula           = $this->input->post('cbocalctype');
            $branch_id          = $this->input->post('cbobranch');
            $region_id          = $this->input->post('cboregion');
            $strukturunit_id    = $this->input->post('cbostruktur');
            $rekanan_id         = $this->input->post('htenant');
            $rekananshipping_line = $this->input->post('hbrand');
            $_virtualaccount    = $this->input->post('ivirtual');
            $transaksi_id       = $this->input->post('htransaksi');
            $_loonumber         = $this->input->post('agreement_loonumber');
            $_isflat            = $this->input->post('_isflat');; //$this->input->post('isflat');
            $_installmentflat   = $this->input->post('agreement_installmentflat');
            $_startperiod       = $this->input->post('agreement_startperiod');
            $_term              = $this->input->post('agreement_term');
            $_dayterm           = $this->input->post('agreement_dayterm');
            $_endperiod         = $this->input->post('agreement_endperiod');
            $_createby          = $this->session->userdata('user_fullname');
            $_createdate        = date("Y-m-d", time());
			$_modifyby	        = $this->input->post('_modifyby');
            $_modifydate        = date("Y-m-d", time());
            $product_name       = $this->input->post('product_name');
            $_descr             = $this->input->post('agreement_descr');
            $fitting_out        = $this->input->post('fitting_out');
            $grace_period       = $this->input->post('grace_periode');
            $size_indoor        = $this->input->post('size_indoor');
            $size_outdoor       = $this->input->post('size_outdoor');
            $channel_id         = $this->session->userdata('channel_id');
            $_space             = 0;
            $_idr               = 0;
            $_foreign           = 0;
            $_foreign_rate      = 0;
            $currency_id        = '';            
            $_ref               = '';
            $ref_id             = '';
            $ref_type           = '';
            $_startdate         = $this->input->post('agreement_startperiod');
            $_enddate           = $this->input->post('agreement_endperiod');
            $leasetype_id       = '';
            $_renttype          = 1;
            $_deduct            = 0;
            $_provision         = 0;
            $_renewalno         = '';
            $_contractlongnumber = '';
            $_lanumber          = '';
            $_tlv               = 0;
            $_bapdate           = $this->input->post('agreement_bapdate');
            $r_line             = $this->input->post('rline');
            $r_type             = $this->input->post('rtype');
            $r_sdate            = $this->input->post('rsdate');
            $r_edate            = $this->input->post('redate');
            $r_rinstm           = $this->input->post('rrinstm');
            $r_rinstd           = $this->input->post('rrinstd');
            $r_pinst            = $this->input->post('rpinst');
            $r_int              = $this->input->post('rint');
            $r_titype           = $this->input->post('rtitype');
            $r_space            = $this->input->post('rspace');
            $r_per              = $this->input->post('rper');
            $r_base             = $this->input->post('rbase');
            $r_vat              = $this->input->post('rvat');
            $r_unit             = $this->input->post('runit');
            $r_una              = $this->input->post('runa');
            $r_mia              = $this->input->post('rmia');
            $r_adendum          = $this->input->post('radendum');
            $r_lumpsum          = $this->input->post('rlumpsum');
            $r_descr            = $this->input->post('rdescr');
            $r_spdate           = $this->input->post('rspdate');
            $r_unitspot         = $this->input->post('runitspot');
            $c_line             = $this->input->post('cline');
            $c_type             = $this->input->post('ctype');
            $c_sdate            = $this->input->post('csdate');
            $c_edate            = $this->input->post('cedate');
            $c_rinstm           = $this->input->post('crinstm');
            $c_rinstd           = $this->input->post('crinstd');
            $c_pinst            = $this->input->post('cpinst');
            $c_int              = $this->input->post('cint');
            $c_titype           = $this->input->post('ctitype');
            $c_space            = $this->input->post('cspace');
            $c_per              = $this->input->post('cper');
            $c_base             = $this->input->post('cbase');
            $c_vat              = $this->input->post('cvat');
            $c_unit             = $this->input->post('cunit');
            $c_una              = $this->input->post('cuna');
            $c_mia              = $this->input->post('cmia');
            $c_adendum          = $this->input->post('cadendum');
            $c_lumpsum          = $this->input->post('clumpsum');
            $c_descr            = $this->input->post('cdescr');
            $c_spdate           = $this->input->post('cspdate');
            $c_unitspot         = $this->input->post('cunitspot');
            $de_line            = $this->input->post('dline');
            $de_type            = $this->input->post('dtype');
            $de_sdate           = $this->input->post('dsdate');
            $de_due             = $this->input->post('ddue');
            $de_titype          = $this->input->post('dtitype');
            $de_unit            = $this->input->post('dunit');
            $de_space           = $this->input->post('dspace');
            $de_lumpsum         = $this->input->post('dlumpsum');
            $de_base            = $this->input->post('dbase');
            $de_mia             = $this->input->post('dmia');
            $de_vat             = $this->input->post('dvat');
            $de_una             = $this->input->post('duna');            

            $this->load->model('template/Master_m');    
            $dtregion   = $this->Master_m->get_regionbyid($region_id);
            $dtchannel  = $this->Master_m->get_channelbyid($channel_id);
                       
            $r_code     = $dtregion[0]->region_nameshort;  
            $channel_no = $dtchannel[0]->channel_number; 
			
			$this->form_validation->set_rules('cboregion', 'Business Unit', 'required');
			$this->form_validation->set_rules('cbobranch', 'Store', 'required');
			$this->form_validation->set_rules('htenant', 'Tenant', 'required');

            $fitting_out        = empty($fitting_out) ? 0 : $fitting_out;
            $grace_period       = empty($grace_period) ? 0 : $grace_period;
            $size_indoor        = empty($size_indoor) ? 0 : $size_indoor;
            $size_outdoor       = empty($size_outdoor) ? 0 : $size_outdoor;
			
			if ($this->form_validation->run() == TRUE) { 
        	$idx=$this->model_agreement->insertagreement(
                $_ref, $ref_id, $ref_type, $_startdate, $_enddate, $_space, $_idr, $_foreign, $_foreign_rate,
                $currency_id, $_term, $_dayterm, $leasetype_id, $_descr, $_tlv, $_createby, $_createdate, $_modifyby, $_modifydate, 
                $channel_id, $region_id, $branch_id, $rekanan_id, $rekananshipping_line, $strukturunit_id, $transaksi_id, 
                $_formula, $_renttype, $_deduct, $_provision, $_contractno, $_startperiod, $_endperiod, $_renewalno, 
                $_isflat, $_installmentflat, $_virtualaccount, $fitting_out, $product_name, $grace_period, $size_indoor, $size_outdoor,
                $_contractlongnumber, $_loonumber, $_lanumber, $_bapdate,
                $r_code, $channel_id, $channel_no, $r_line, $r_type, $r_sdate, $r_edate, $r_rinstm, $r_rinstd, 
                $r_pinst, $r_int, $r_titype, $r_space, $r_per, $r_base, $r_vat, $r_unit, $r_mia, $r_adendum, $r_lumpsum,
                $r_descr, $r_spdate, $r_unitspot, $r_una, $c_line, $c_type, $c_sdate, $c_edate, $c_rinstm, $c_rinstd, 
                $c_pinst, $c_int, $c_titype, $c_space, $c_per, $c_base, $c_vat, $c_unit, $c_mia, $c_adendum, $c_lumpsum,
                $c_descr, $c_spdate, $c_unitspot, $c_una, $de_line, $de_type, $de_sdate, $de_due, $de_titype, $de_unit, $de_space,
                $de_lumpsum, $de_base, $de_mia, $de_vat, $de_una
            );

        	redirect("agreement/agreement/agreementedit/".$idx);
			} else {
			$this->agreementadd();	
			}
        }
    }
  
    function agreement_edit(){    

            //print_r($_POST);exit;

            $agreement_id       = $this->input->post('agreement_id');
            $_contractno        = $this->input->post('idebtor');
            $_formula           = $this->input->post('cbocalctype');
            $branch_id          = $this->input->post('cbobranch');
            $region_id          = $this->input->post('cboregion');
            $strukturunit_id    = $this->input->post('cbostruktur');
            $rekanan_id         = $this->input->post('htenant');
            $rekananshipping_line = $this->input->post('hbrand');
            $_virtualaccount    = $this->input->post('ivirtual');
            $transaksi_id       = $this->input->post('htransaksi');
            $_loonumber         = $this->input->post('agreement_loonumber');
            $_isflat            = $this->input->post('_isflat');; //$this->input->post('isflat');
            $_installmentflat   = $this->input->post('agreement_installmentflat');
            $_startperiod       = $this->input->post('agreement_startperiod');
            $_term              = $this->input->post('agreement_term');
            $_dayterm           = $this->input->post('agreement_dayterm');
            $_endperiod         = $this->input->post('agreement_endperiod');
            $_createby          = $this->session->userdata('user_fullname');
            $_createdate        = date("Y-m-d", time());
            $_modifyby          = $this->input->post('_modifyby');
            $_modifydate        = date("Y-m-d", time());
            $product_name       = $this->input->post('product_name');
            $_descr             = $this->input->post('agreement_descr');
            $fitting_out        = $this->input->post('fitting_out');
            $grace_period       = $this->input->post('grace_periode');
            $size_indoor        = $this->input->post('size_indoor');
            $size_outdoor       = $this->input->post('size_outdoor');
            $channel_id         = $this->session->userdata('channel_id');
            $_space             = 0;
            $_idr               = 0;
            $_foreign           = 0;
            $_foreign_rate      = 0;
            $currency_id        = '';            
            $_ref               = '';
            $ref_id             = '';
            $ref_type           = '';
            $_startdate         = $this->input->post('agreement_startperiod');
            $_enddate           = $this->input->post('agreement_endperiod');
            $leasetype_id       = '';
            $_renttype          = 1;
            $_deduct            = 0;
            $_provision         = 0;
            $_renewalno         = '';
            $_contractlongnumber = '';
            $_lanumber          = '';
            $_tlv               = 0;
            $_bapdate           = $this->input->post('agreement_bapdate');
            $r_line             = $this->input->post('rline');
            $r_type             = $this->input->post('rtype');
            $r_sdate            = $this->input->post('rsdate');
            $r_edate            = $this->input->post('redate');
            $r_rinstm           = $this->input->post('rrinstm');
            $r_rinstd           = $this->input->post('rrinstd');
            $r_pinst            = $this->input->post('rpinst');
            $r_int              = $this->input->post('rint');
            $r_titype           = $this->input->post('rtitype');
            $r_space            = $this->input->post('rspace');
            $r_per              = $this->input->post('rper');
            $r_base             = $this->input->post('rbase');
            $r_vat              = $this->input->post('rvat');
            $r_unit             = $this->input->post('runit');
            $r_una              = $this->input->post('runa');
            $r_mia              = $this->input->post('rmia');
            $r_adendum          = $this->input->post('radendum');
            $r_lumpsum          = $this->input->post('rlumpsum');
            $r_descr            = $this->input->post('rdescr');
            $r_spdate           = $this->input->post('rspdate');
            $r_unitspot         = $this->input->post('runitspot');
            $r_state            = $this->input->post('rstate');
            $c_line             = $this->input->post('cline');
            $c_type             = $this->input->post('ctype');
            $c_sdate            = $this->input->post('csdate');
            $c_edate            = $this->input->post('cedate');
            $c_rinstm           = $this->input->post('crinstm');
            $c_rinstd           = $this->input->post('crinstd');
            $c_pinst            = $this->input->post('cpinst');
            $c_int              = $this->input->post('cint');
            $c_titype           = $this->input->post('ctitype');
            $c_space            = $this->input->post('cspace');
            $c_per              = $this->input->post('cper');
            $c_base             = $this->input->post('cbase');
            $c_vat              = $this->input->post('cvat');
            $c_unit             = $this->input->post('cunit');
            $c_una              = $this->input->post('cuna');
            $c_mia              = $this->input->post('cmia');
            $c_adendum          = $this->input->post('cadendum');
            $c_lumpsum          = $this->input->post('clumpsum');
            $c_descr            = $this->input->post('cdescr');
            $c_spdate           = $this->input->post('cspdate');
            $c_unitspot         = $this->input->post('cunitspot');
            $c_state            = $this->input->post('cstate');
            $de_line            = $this->input->post('dline');
            $de_type            = $this->input->post('dtype');
            $de_sdate           = $this->input->post('dsdate');
            $de_due             = $this->input->post('ddue');
            $de_titype          = $this->input->post('dtitype');
            $de_unit            = $this->input->post('dunit');
            $de_space           = $this->input->post('dspace');
            $de_lumpsum         = $this->input->post('dlumpsum');
            $de_base            = $this->input->post('dbase');
            $de_mia             = $this->input->post('dmia');
            $de_vat             = $this->input->post('dvat');
            $de_una             = $this->input->post('duna');            
            $de_state           = $this->input->post('dstate');
            $deleted            = $this->input->post('deleted');

            $this->load->model('template/Master_m');    
            $dtregion   = $this->Master_m->get_regionbyid($region_id);
            $dtchannel  = $this->Master_m->get_channelbyid($channel_id);
                       
            $r_code     = $dtregion[0]->region_nameshort;  
            $channel_no = $dtchannel[0]->channel_number; 
            
            $this->form_validation->set_rules('cboregion', 'Business Unit', 'required');
            $this->form_validation->set_rules('cbobranch', 'Store', 'required');
            $this->form_validation->set_rules('htenant', 'Tenant', 'required');

            $fitting_out        = empty($fitting_out) ? 0 : $fitting_out;
            $grace_period       = empty($grace_period) ? 0 : $grace_period;
            $size_indoor        = empty($size_indoor) ? 0 : $size_indoor;
            $size_outdoor       = empty($size_outdoor) ? 0 : $size_outdoor;
            
            if ($this->form_validation->run() == TRUE) { 
            $this->model_agreement->updateagreement(
                $_ref, $ref_id, $ref_type, $_startdate, $_enddate, $_space, 
                $_idr, $_foreign, $_foreign_rate, $currency_id, $_term, $_dayterm, $leasetype_id, $_descr, 
                $_tlv, $_createby, $_createdate, $_modifyby, $_modifydate, 
                $channel_id, $region_id, $branch_id, $rekanan_id, $rekananshipping_line, $strukturunit_id, $transaksi_id, 
                $_formula, $_renttype, $_deduct, $_provision, $_contractno, $_startperiod, $_endperiod, $_renewalno, 
                $_isflat, $_installmentflat, $_virtualaccount, $fitting_out, $product_name, $grace_period, $size_indoor, $size_outdoor, 
                $_contractlongnumber, $_loonumber, $_lanumber, $_bapdate,
                $r_code, $channel_id, $channel_no, $r_line, $r_type, $r_sdate, $r_edate, $r_rinstm, $r_rinstd, 
                $r_pinst, $r_int, $r_titype, $r_space, $r_per, $r_base, $r_vat, $r_unit, $r_mia, $r_adendum, $r_lumpsum,
                $r_descr, $r_spdate, $r_unitspot, $r_una, $c_line, $c_type, $c_sdate, $c_edate, $c_rinstm, $c_rinstd, 
                $c_pinst, $c_int, $c_titype, $c_space, $c_per, $c_base, $c_vat, $c_unit, $c_mia, $c_adendum, $c_lumpsum,
                $c_descr, $c_spdate, $c_unitspot, $c_una, $de_line, $de_type, $de_sdate, $de_due, $de_titype, $de_unit, $de_space,
                $de_lumpsum, $de_base, $de_mia, $de_vat, $de_una, $agreement_id, $r_state, $c_state, $de_state, $deleted 
            );

            redirect("agreement/agreement/agreementedit/".$agreement_id);
            } else {
            $this->agreementadd();  
            }
    }
	
	function agreement_delete(){
		
        $i_link = $this->uri->segment(4);       

        $_id = str_replace('_', '/', $i_link); 

		$this->model_agreement->deleteagreement($_id);
		redirect("agreement/agreement/agreementlist");
	}
  
    
}  