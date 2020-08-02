<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
      Trans Retail | Web Application
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/dist/img/fave-ico.png');?>">
    <!-- Bootstrap 3.3.6 -->

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    
    <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/components.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url('assets/css/layout.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/themes/darkblue.min2.css');?>" rel="stylesheet" type="text/css" id="style_color" />
   
    <link href="<?php echo base_url('assets/plugins/datatables/datatables.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');?>" rel="stylesheet" type="text/css" />

  	<link href="<?php echo base_url('assets/plugins/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/jquery-file-upload/css/jquery.fileupload.css');?>" rel="stylesheet" type="text/css" />
   
    <script src="<?php echo base_url('assets/plugins/jquery.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/js.cookie.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/datatable.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/datatables.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/app.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/table-datatables-buttons.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/layout.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/jquery.number.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/jsinternal/jsgrid.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/jqBootstrapValidation.js');?>"></script>
 

 <link href="<?php echo base_url('assets/css/fixedColumns.bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url('assets/scripts/dataTables.fixedColumns.min.js');?>" type="text/javascript"></script>
 
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/vendor/load-image.min.js');?>" type="text/javascript"></script>  
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/jquery.fileupload.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js');?>" type="text/javascript"></script>
        
	<style>
		.modal-header{
    		background-color: #3498db;
		}

		.modal-title{
    		color: white;
		}
		.modal-dialog{
    		padding-top: 0px;
		}
		label {
    		margin-bottom: 0px !important;
		}

		.form-group {
   		 	margin-bottom: 1px !important;
		}
		.nogaris {border-style:none;}

table.dataTable tr {
    cursor: pointer; 
}


</style>
<script>        
 $(document).ready(function() {
 //Date picker
            $('#coll_date').datepicker({
                format: "yyyy-mm-dd",
				minView : 2,
                autoclose: true
            })
 })

</script>
  </head>
 <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
    <div class="page-wrapper">
      <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner">
          <!-- BEGIN LOGO -->
          <div class="page-logo" valign="top">
            <a href="index.html">
            <img src="<?php echo base_url('assets/img/ebyt.png');?>" alt="logo" class="logo-default" /></a>
            <div class="menu-toggler sidebar-toggler">
              <i class="fa fa-bars" aria-hidden="true" style="color: white;">
              </i>
            </div>
          </div>
          <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <i class="fa fa-bars" aria-hidden="true" style="color: white;"></i>
          </a>
          <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="<?php echo base_url('assets/img/avatar3_small.jpg');?>" />
                <span class="username username-hide-on-mobile" style="color: white;"> <strong>WELCOME</strong> : HARRIS </span>
                <i class="fa fa-angle-down" style="color: yellow;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                  <li>
                    <a href="page_user_profile_1.html">
                    <i class="icon-user"></i> My Profile </a>
                  </li>
                  <li>
                    <a href="app_calendar.html">
                    <i class="icon-calendar"></i> My Calendar </a>
                  </li>
                  <li>
                    <a href="app_inbox.html">
                    <i class="icon-envelope-open"></i> My Inbox
                    <span class="badge badge-danger"> 3 </span>
                    </a>
                  </li>
                  <li>
                    <a href="app_todo.html">
                    <i class="icon-rocket"></i> My Tasks
                    <span class="badge badge-success"> 7 </span>
                    </a>
                  </li>
                  <li class="divider">
                  </li>
                  <li>
                    <a href="page_user_lock_1.html">
                    <i class="icon-lock"></i> Lock Screen </a>
                  </li>
                  <li>
                    <a href="page_user_login_1.html">
                    <i class="icon-key"></i> Log Out </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="page-container">
        <div class="page-sidebar-wrapper">
          <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
              <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                  <span>
                  </span>
                </div>
              </li>

              
               <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-briefcase"></i>
                <span class="title">Floor Plan</span>
                <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                 
                  <?php echo getMenuloo();?>
                  
                  
                </ul>
                
              </li>
              
               <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-puzzle"></i>
                <span class="title">LOO</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                
                 <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo_cl/loo_cl/penalist'); ?>" class="nav-link ">
                    <span class="title">Proposed LOO ATM</span>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo_cl/looapp_cl/looapplist'); ?>" class="nav-link ">
                    <span class="title">Proposed LOO ATM Approval</span>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo_cl/loo_cl/loolist'); ?>" class="nav-link ">
                    <span class="title">LOO ATM Print</span>
                    </a>
                  </li>
                  <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo_bts/loo/loolist'); ?>" class="nav-link ">
                    <span class="title">LOO BTS</span>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo/loo'); ?>" class="nav-link ">
                    <span class="title">LOO Permanent/Casual</span>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                     <a href="<?php echo base_url('index.php/loo/looapp'); ?>" class="nav-link ">
                    <span class="title">LOO Permanent/Casual Approval</span>
                    </a>
                  </li>
                  
                   <li class="nav-item">
                    <a href="<?php echo base_url('index.php/loo/looconf'); ?>" class="nav-link ">
                    <span class="title">LOO Permanent/Casual Doc.Return</span>
                    </a>
                  </li>
                 
                </ul>
              </li>
              
            </ul>
          </div>
        </div>
        
        <div class="page-content-wrapper">
          <div class="page-content">
            <div class="page-bar">
              <br>
              <?php echo $this->breadcrumbcomponent->show() ?>
               </div>
            <br />