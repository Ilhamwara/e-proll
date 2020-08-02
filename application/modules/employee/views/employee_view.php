<!-- BEGIN USER SCRIPTS -->
<script src="<?php echo base_url('assets/jsinternal/jsgrid.js');?>" type="text/javascript"></script>
<!-- END USER SCRIPTS -->
<script>   

  $(document).ready(function() {
    
    var oTable = listgrid("<?php echo site_url('employee/controller_gridlist')?>","employeeTable","rtip", 10, [5]);    
    //$($.fn.dataTable.tables(true)).DataTable()   
    //$('#employeeTable').wrap("<div class='table-responsive'></div>");    

    $('#tabedit').click(function() {
      alert('Please, select data from list');
      $("#tablist").trigger('click');
    });    
       
  });

</script>

<style>
  table {
    table-layout:fixed;
  }
</style>

      <!-- BEGIN PAGE CONTENT-->
      <div class="row">
        <div class="col-md-12 col-sm-12">

          <!-- Begin: TABLE PORTLET -->                
            <div class="portlet light">
              <div class="portlet-title">
                <div class="caption">
                  <i class="icon-settings font-green"></i>
                  <span class="caption-subject font-green bold uppercase">Employee List</span>
                </div>
                <div class="actions">                  
                  <a class="btn green" href="<?php echo site_url('employee/employee_new'); ?>" data-original-title="" title=""><i class="fa fa-plus"></i>
                  <span class="hidden-xs"> Add New </span></a>                  
                  <div class="btn-group">
                      <a class="btn default green" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-share"></i>
                          <span class="hidden-xs"> Tools </span>
                          <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu pull-right" id="sample_3_tools">
                          <li>
                              <a href="javascript:;" data-action="0" class="tool-action">
                                  <i class="icon-printer"></i> Print</a>
                          </li>
                          <li>
                              <a href="javascript:;" data-action="1" class="tool-action">
                                  <i class="icon-check"></i> Copy</a>
                          </li>
                          <li>
                              <a href="javascript:;" data-action="2" class="tool-action">
                                  <i class="icon-doc"></i> PDF</a>
                          </li>
                          <li>
                              <a href="javascript:;" data-action="3" class="tool-action">
                                  <i class="icon-paper-clip"></i> Excel</a>
                          </li>
                          <li>
                              <a href="javascript:;" data-action="4" class="tool-action">
                                  <i class="icon-cloud-upload"></i> CSV</a>
                          </li>
                          <li class="divider"> </li>
                          <li>
                              <a href="javascript:;" data-action="5" class="tool-action">
                                  <i class="icon-refresh"></i> Reload</a>
                          </li>
                          
                      </ul>
                  </div>
                </div>
              </div>            
              <div class="portlet-body portlet-datatable">                                 
                <table class="table table-hover nowrap table-bordered table-condensed table-striped" id='employeeTable'>
                  <thead>
                    <tr role="row" class="bg-green font-white">
                      <th width="8%">NIPP</th>
                      <th width="15%">Nama Pegawai</th>
                      <th width="8%">Divisi</th>
                      <th width="8%">Bagian</th>
                      <th width="10%">Jabatan</th>
                      <th width="10%">Tgl. Masuk</th>
                      <th width="10%"><div align="center">Action</div></th>
                    </tr>              
                  </thead>
                  <tbody>
                  </tbody>
                </table>                                        
              </div>
            </div>          
          <!-- End: TABLE PORTLET -->          
        </div>
      </div>
      <!-- END PAGE CONTENT-->       