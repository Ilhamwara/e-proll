
<script>

function validateb4submit(){
  var max=GetDgvLineMaxNum('jDetil',0);
  if (max < 1 ){    
    display_modal('Alert!', 'Please, Add Term & Condition !');
    return false;
  }
}

$(document).on("focusin", "#itenant", function() {
   $(this).prop('readonly', true);  
});

$(document).on("focusout", "#itenant", function() {
   $(this).prop('readonly', false); 
});

$(document).ready(function(){  
  
  $('#iregion').select2({placeholder: 'Select a business unit'});
  $('#iutype').select2({placeholder: 'Choose unit ..'});
  $('#istruk').select2({placeholder: 'Choose strukturunit ..'});
  $('#iperiod').select2();
  $('.account').select2();
  $('.region-sel').select2();
  $('.branch-sel').select2();
  $('.struktur-sel').select2();

  $('#ibranch').on('select2:select', function (e) {
    var bra = e.params.data;    

    $('#iregion').val(bra.region).trigger('change');      

    $('#cboregion').val(bra.region);  

    listunit = branchData.filter(function (data) { return data.branch == bra.id });   
        
  });  

  $('#ibranch').select2({
      placeholder: 'Select an option',
      minimumInputLength: 2,
      //tags: true,
      minimumResultsForSearch: 10,
      tokenSeparators: [',', ' '],
      ajax: {
          url: '<?php echo site_url('jvoucher/jvoucher/branch_select')?>',
          dataType: 'json',
          type: "GET",
          data: function (term) {
              return {
                  term: term                  
              };
          },
          processResults: function (data) {
              return {
                  results: $.map(data.items, function (item) {

                        //console.log(data.items);
                      return {

                          text: item.branch_name,
                          region: item.region_id,
                          id: item.branch_id
                      }
                  })
              };
          }
      }
  });

  $("#itenant").on('keydown paste', function(e){
      e.preventDefault();
  });

  $("#ibrand").on('keydown paste', function(e){
    e.preventDefault();
  });

  $("#idebtor").on('keydown paste', function(e){
    e.preventDefault();
  });

  var arrid= [];
  //lfrtip =default  
  var rTable = selectionGrid("<?php echo site_url('jvoucher/jvoucher/controler_gridpop')?>","popLoader","trp", 10, [], 0);  
  var tTable = $('#detailLoader').DataTable();

  $("#tabedit").trigger('click');

  $('#btTemplate').click(function() {
    if (($('#iregion option:selected').length == 0) || ($('#ibranch').val() =='') || ($('#iutype').val() ==null)) { 

     //alert("Please select Bussiness Unit and Store and Unit Type");
     display_modal('Alert!', 'Please select Bussiness Unit and Store and Unit Type.');
    }else{

    var searchID  = $("#iutype").val();    

    scTable.search(searchID).draw();
    
    scTable.rows('.selected').deselect();
    $("#tempdialog").modal("show");
    }

  });

  $('#bttenant').click(function() {

    if (($('#ibranch option:selected').length == 0) || ($('#ibranch').val() =='')) { 
      
      display_modal('Alert!', 'Please select Bussiness Unit or Store.');
    }else{

      var searchBranch = $('#ibranch').val();    

      rTable.search(searchBranch).draw();

      rTable.rows('.selected').deselect();
      $("#tedialog").modal("show");
    }
  });

  $("#jDetil").on('click','#bTenant',function(){          
     
      jLine = $(this).closest('tr').find('td').eq(0).text();      

      //$('#detailLoader').DataTable().destroy();
      tTable.destroy();

      tTable=selectionGrid("<?php echo site_url('jvoucher/jvoucher/controler_gridtenant')?>","detailLoader","trp", 10, [], jLine);  
      
      $("#dedialog").modal("show");    

  });

  $('#btnrek').click(function() {
    var searchTenant  = $("#searchTenant").val();

    rTable.search(searchTenant).draw();
  });

  $('#btdetil').click(function() {

    if (($('#iregion option:selected').length == 0) || ($('#ibranch').val() =='')) { 
      
      display_modal('Alert!', 'Please select Bussiness Unit or Store.');
    }else{  

        var activetab = $('.detil .active').text();
        switch(activetab) {

            case 'Rental':
                addRow();               
                break;

            case 'Charge':
                addRowCharge();
                break;

            case 'Deposit':
                addRowDeposit();
                break;

            case 'Loan':
                addRowLoan();
                break;
        }
    }
  

  });  

  $('#tabedit').click(function() {

    display_modal('Alert!', 'Please, select data from list.');
  });  

  $('#addtenant').click(function () {

      var linenum=0;
       var rData = rTable.rows('.selected').data();

       for (var i=0; i < rData.length ;i++){

          var tid       = rData[i][1];
          var tname     = rData[i][2];
          var tline     = rData[i][3];
          var tbrand    = rData[i][4];
          var tdebtor   = rData[i][5];          

          $('#htenant').val(tid);
          $('#itenant').val(tname);
          $('#hbrand').val(tline);
          $('#ibrand').val(tbrand);
          $('#idebtor').val(tdebtor);          
      }

  }); 

  $('#chooseTenant').click( function() {

      tData = tTable.rows('.selected').data();          

      tenantId    = tData[0][1];
      tenantName  = tData[0][2];      
      brandId     = tData[0][3];
      brandName   = tData[0][4];      
      tLine       = tData[0][6];
      
      var uRows = $('#jDetil tbody >tr');
      var uColumns;

      for (var i = 0; i < uRows.length; i++) {  

          uLine = $(uRows[i]).find('td').eq(0).text();

          if (uLine === tLine) {

            $(uRows[i]).find('input[type="text"]').eq(2).val(tenantName);
          }
                        
      }
  });  

  $("#rentalTab").on('click','#rDelete',function(){
    if (confirm("Are you sure to delete this row ?") == false) {
              return false;
          }

      deleted = 'rental|'+$(this).closest('tr').find('td:eq(0)').text();

      $('#agreement_save').prepend('<input type="hidden" name="deleted[]" value="'+deleted+'" />');        
      $(this).closest('tr').remove();
  });

/*
  var tTable = $('#detailTenant').DataTable({      
      "paging": false,
      "ordering": false,     
      "processing": true,
      "columns":[
          { "data": "checked" },
          { "data": "id" },          
          { "data": "tenant" },
          { "data": "line" },
          { "data": "brand" },
          { "data": "debtor" }
      ],
      columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets:   0
      }],
      select: {
          style:    'os',
          selector: 'td:first-child'
      },      
      dom:'t',
      "autoWidth": false
    
  });
*/

  function addRow(ci) {      

      var linenum=0;

      var max=GetDgvLineMaxNum('jDetil', 0);
      linenum= Number(max) + 10;      

      if (typeof ci === 'undefined') { ci = linenum}        

      $('#jDetil tbody').append('<tr>'+
        '<td>' + linenum + '<input type="hidden" name="rline[]" value="'+ linenum +'" readonly class="nogaris"/></td>'+
        '<td><div class="form-group form-group-sm"><?php echo form_dropdownext('dacc[]',$account, "", 'id="d_acc\'+ci+\'" class="form-control input-sm" style="width: 100%;" required');?></div></td>'+
        '<td><input type="text" id="d_descr" name="ddescr[]" value="" class="pops form-control input-sm"/>'+
             '<input type="hidden" name="dstate[]" value="update"/></td>'+
        '<td><input type="text" id="d_idr" name="didr[]" value="0" class="deci form-control input-sm" style= "text-align: right;"/></td>'+
        '<td><?php echo form_dropdownext('dregion[]', $region, "", 'id="d_region" class="form-control input-sm" required');?></td>'+
        '<td><?php echo form_dropdownext('dbranch[]', $branch, "", 'id="d_branch" class="form-control input-sm" required');?></td>'+
        '<td><?php echo form_dropdownext('dstruktur[]', $struktur, "", 'id="d_struktur" class="form-control input-sm" required');?></td>'+
        '<td><?php echo form_dropdownext('drekanan[]', "", "", 'id="d_rekanan" class="form-control input-sm" required');?></td>'+
        '<td><input type="text" id="d_ref" name="dref[]" value="" class="detil bulet form-control input-sm" disabled/></td>'+
        '<td><input type="text" id="d_refline" name="drefline[]" value="" class="form-control input-sm" disabled /></td>'+
        '<td><input type="text" id="d_channel" name="dchannel[]" value="" class="form-control input-sm" disabled/></td>'+
        '<td><a id= "rDelete" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a></td></tr>');          

      $('.deci').number( true, 2 );
      $('.bulet').number( true, 0 );     
      
      $('.pops').popover({   
            trigger: 'manual',    
            placement: 'left',
            title: function(){
              var line = $(this).closest('tr').find('td:eq(0)').text();
              var frm = 'Descr Line: '+line;

              return frm;
            },
            html:true,
            content: function() {          
              var olddesc = $(this).val();

              $('#popover-form').find('textarea[name="txtContent"]').text(olddesc);

              return $('#popover-form').html();
            } 
        }).on('click', function(){
          // had to put it within the on click action so it grabs the correct info on submit
          var $popup = $(this);

          $(this).popover('show');

          $('.btn-primary').click(function(){

            var newdesc = $('.popover #txtContent').val();

            $($popup[0]).val(newdesc);

            $popup.popover('hide');

          });

          $('.btn-default').click(function(){

            $popup.popover('hide');
            
          });

      });

      $('body').on('click', function (e) {
        $('.pops').each(function () {
            // hide any open popovers when the anywhere else in the body is clicked
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });   
      });       

      $('.dropunit').on("select2:select", function(e){
        var uData = e.params.data;

        /* console.log(uData); */        
        $(this).closest('tr').find('input[type="hidden"]').eq(1).val(uData['text']);
        $(this).closest('tr').find('input[type="text"]').eq(8).val(uData['sqm']);
        
      });

  }  

  function display_modal(title, message){
     $("#mdlinfo").modal("show");
     $("#mdltitle").show().html(title);
     $("#mdlbody").show().html(message);
  }  

  $('.pops').popover({   
        trigger: 'manual',    
        placement: 'left',
        title: 'Descr',
        html:true,
        content: function() {          
          var olddesc = $(this).val();

          $('#popover-form').find('textarea[name="txtContent"]').text(olddesc);

          return $('#popover-form').html();
        } 
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      var $popup = $(this);

      $(this).popover('show');

      $('.btn-primary').click(function(){

        var newdesc = $('.popover #txtContent').val();

        $($popup[0]).val(newdesc);

        $popup.popover('hide');

      });

      $('.btn-default').click(function(){

        $popup.popover('hide');
        
      });
  });

  $('body').on('click', function (e) {
    $('.pops').each(function () {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });   
  });

  $('.deci').number( true, 2 );
  $('.bulet').number( true, 0 );

  $('.deci').on('input', function (e) {
    $(this).css("color", ""); 
    $(this).toggleClass('redForeground', $(this).val() < 0);    
  });

});


  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $.fn.datepicker.defaults.autoclose = true;

function selectionGrid(vlink,namatable,optsearch, pLength=10, aCenter=[], line){
    
  var dt = $('#'+namatable).DataTable({        
    "pageLength": pLength,
    "processing": true, 
    "serverSide": true, 
    "order": [],
    "searching" : true,
    "ajax": {
      "url": vlink,
      "type": "POST",
      "data": function(d){
        d.line_no = line;       
      }  
    },   
    "columnDefs": [
      { "targets": [ -1 ], "orderable": false },
      { "targets": aCenter, "className": "text-center" },
      { "orderable": false, "className": 'select-checkbox', "targets": 0 }
    ],
    select: {
        style:    'os',
        selector: 'td:first-child'
    },  
    dom:optsearch
    });
      
  return dt;
}

$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

</script>

<style>

table.dataTable td {
    padding:2px;
    font-size: 9pt;
}

#jDetil th, #jDetil td, #jDetil label {
    font-size: 9pt;
    white-space: nowrap;    
}

#chargeTab th, #chargeTab td, #chargeTab label {

    font-size: 9pt;
    white-space: nowrap;    
}

#depositTab th, #depositTab td, #depositTab label {
    font-size: 9pt;
    white-space: nowrap;    
}

#loanTab th, #loanTab td, #loanTab label {
    font-size: 9pt;
    white-space: nowrap;    
}

.redForeground {
    color: red;
}

.detil {
    padding: 2px;
}

label {
  font-size: 9pt;
  font-weight: bold;
}

.select2-container {
  min-width:120px;
}

</style>

    <div id="popover-form" class="hide">
      <div class="form-group">
        <textarea rows="4" name="txtContent" id="txtContent" class="form-control input-sm"></textarea>        
        <br>
        <button id="btnOk" type="button" class="btn btn-primary">
          <span class="glyphicon glyphicon-ok"></span>&nbsp;
        </button>  
        <button id="btnCancel" type="button" class="btn btn-default">
          <span class="glyphicon glyphicon-remove"></span>&nbsp;
        </button>
      </div>
    </div>

        <div class="modal" id="mdlinfo" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mdltitle">Success!</h4>
              </div>
              <div class="modal-body" id="mdlbody">
                <p>Data has been saved&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default center-block" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- /.popup-tenant -->
        <div class="modal fade" id="tedialog" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                </button>
                <h4 class="modal-title">
                  Data Tenant
                </h4>
              </div>
              <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                <div class="row">
                <div class="col-md-8">
                   <label>Search Tenant || Brand</label>
                  <input  type="text" id="searchTenant" class="form-control input-sm" placeholder="Search Tenant" >
                </div>                           
                <div class="col-md-4" align="right">
                  <br>                              
                  <button id="btnrek" type="button" class="btn btn-sm btn-primary" style="margin-right: 5px;" >
                    <i class="fa fa-history"></i> LOAD
                  </button>
                </div>
              </div>
               <div class="portlet-body">
                <div class="table-container">
                  <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover compact nowrap" id='popLoader' style="border:solid 1px #999; #999; border-radius:0px;" width="100%">
                      <thead>
                       <tr>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">ID</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Tenant</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Brand</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Debt No.</th>
                       </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <br />
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn green" data-dismiss="modal" id="addtenant">
                  Add Selected Data
                </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- /.popup-tenant-detail -->
        <div class="modal fade" id="dedialog" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                </button>
                <h4 class="modal-title">
                  Data Tenant
                </h4>
              </div>
              <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                <div class="row">
                <div class="col-md-8">
                   <label>Search Tenant || Brand</label>
                  <input  type="text" id="searchTenant" class="form-control input-sm" placeholder="Search Tenant" >
                </div>                           
                <div class="col-md-4" align="right">
                  <br>                              
                  <button id="btnrek" type="button" class="btn btn-sm btn-primary" style="margin-right: 5px;" >
                    <i class="fa fa-history"></i> LOAD
                  </button>
                </div>
              </div>
               <div class="portlet-body">
                <div class="table-container">
                  <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover compact nowrap" id='detailLoader' style="border:solid 1px #999; #999; border-radius:0px;" width="100%">
                      <thead>
                       <tr>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">ID</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Tenant</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Brand</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Debt No.</th>
                        <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line No.</th>
                       </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <br />
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn green" data-dismiss="modal" id="chooseTenant">
                  Add Selected Data
                </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

            <!-- CONTENT -->
            <div class="row">
              <div class="col-md-12">
                <div class="portlet">
                  <div class="portlet-title">
                    <div class="caption" align="right">
                      <div class="actions">
                        <div class="btn-group">
                          <a class="btn green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> <i class="fa fa-search"></i> Advanced Search
                          <i class="fa fa-angle-down"></i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                            <br>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="contain">
                                  Author
                                </label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">
                                  Contains the words
                                </label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">
                                  Select Option
                                </label>
                                <select class="form-control">
                                  <option>
                                    Option 1
                                  </option>
                                  <option>
                                    Option 2
                                  </option>
                                  <option>
                                    Option 3
                                  </option>
                                  <option>
                                    Option 4
                                  </option>
                                  <option>
                                    Option 5
                                  </option>
                                </select>
                                <br>
                                <button type="search" class="btn blue">
                                  Search
                                </button>
                              </div>
                            </div>
                          </ul>
                        </div>
                        <div class="btn-group">
                          <a class="btn green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> <i class="fa fa-print"></i> Export
                          <i class="fa fa-angle-down"></i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                            <li>
                              <a href="javascript:;">
                              <i class="fa fa-file-pdf-o"></i> PDF </a>
                            </li>
                            <li>
                              <a href="javascript:;">
                              <i class="fa fa-file-excel-o"></i> EXCEL </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="tools">
                      <a href="javascript:;" class="collapse"> </a>
                      <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <div class="tabbable-custom ">
                      <ul class="nav nav-tabs ">
                        <li class="active">
                          <a href="<?php echo base_url('index.php/jvoucher/jvoucher/jvoucherlist'); ?>" id='tablist'> LIST </a>
                        </li>
                        <li>                          
                          <a href="<?php echo base_url('index.php/jvoucher/jvoucher/jvoucheradd'); ?>" id='tabdata'> INPUT </a>
                        </li>
                        <li>
                          <a href="#editdata" data-toggle="tab"  id='tabedit'> EDIT </a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane" id="editdata">
                          <div class="portlet-body form">
                         <form action="<?php echo site_url('jvoucher/jvoucher/jvoucher_edit');?>" method="post" onsubmit="return validateb4submit();"
                            id="jvoucher_save">
                            <?php
                              if(isset($result)){
                               //print_r($result);
                               foreach($result as $row){ ?>
                            <div class="row">
                              <div class="col-md-12">
                             <div style="color:red"> <?php echo validation_errors(); ?> </div>
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>ID</label>
                                      <label class="post checkbox-inline pull-right"><input type="checkbox" <?php if ($row->jurnal_isposted == 1) echo 'checked= "checked"';?> disabled><b>Posted</b></label>
                                      <label class="post checkbox-inline pull-right"><input type="checkbox" <?php if ($row->jurnal_isdisabled == 1) echo 'checked= "checked"';?> disabled><b>Disabled</b>&nbsp;</label>
                                      <label class="post checkbox-inline pull-right"><input type="checkbox" <?php if ($row->jurnal_isreversed == 1) echo 'checked= "checked"';?> disabled><b>Reversed</b>&nbsp;</label>
                                      <input  type="text" id="jurnal_id" name="jurnal_id" class="form-control input-sm" value="<?php echo $row->jurnal_id;?>" readonly>
                                    </div>
                                  </div>   
                                  <div class="col-md-4 form-group form-group-sm row">
                                    <div class="col-xs-12">
                                    <label>Business Unit</label>
                                      <?php echo form_dropdown('iregion', $region, $row->region_id, 'id ="iregion" class="form-control" style="width: 100%;" required disabled '); ?>
                                    </div>
                                    <input type="hidden" id = "cboregion" name="cboregion" value="<?php echo $row->region_id; ?>">
                                  </div>                                           
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Channel</label>
                                        <input type="text" id = "channel_id" name="channel_id" class="form-control input-sm" value="<?php echo $row->channel_id;?>" readonly>
                                    </div>
                                  </div>                     
                                  <div class="col-md-4 form-group form-group-sm row">
                                    <div class="col-xs-12">
                                    <label>Periode</label>
                                      <?php echo form_dropdown('iperiod', $period, $row->periode_id, 'id ="iperiod" class="form-control" style="width: 100%;" required'); ?>
                                    </div>
                                  </div>                                  
                                  <div class="col-md-4 form-group form-group-sm row">
                                    <div class="col-xs-12">
                                      <label>Store</label>
                                        <select data-placeholder="Select a Store" id= "ibranch" name= "cbobranch" required>
                                          <option value="<?php echo $row->branch_id;?>" selected="selected" ><?php echo $row->branch_name;?></option>
                                        </select>
                                    </div>
                                  </div>  
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Jurnal Type</label>
                                        <input type="text" id = "jurnaltype_id" name="jurnaltype_id" class="form-control input-sm" value="<?php echo $row->jurnaltype_id;?>" readonly>
                                    </div>
                                  </div>  
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Book Date</label>
                                      <div class="input-group date" data-provide="datepicker">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control input-sm pull-right" id="jurnal_bookdate" name="jurnal_bookdate" value = "<?php echo $row->jurnal_bookdate;?>">
                                      </div>
                                    </div>
                                  </div>                                     
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Rekanan/ Tenant</label>
                                      <div class="input-group input-group-sm">
                                        <input type="text" id = "itenant" name="itenant" class="form-control input-sm" value="<?php echo $row->rekanan_name;?>" required autocomplete="off">
                                        <span class="input-group-btn">
                                          <button id ="bttenant" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </span> 
                                      <input type="hidden" id = "htenant" name="htenant" value="<?php echo $row->rekanan_id;?>">
                                      </div>
                                    </div>
                                  </div>   
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Jurnal Source</label>
                                        <input type="text" id = "jurnal_source" name="jurnal_source" class="form-control input-sm" value="<?php echo $row->jurnal_source;?>" readonly>
                                    </div>
                                  </div>    
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                      <label>Due Date</label>
                                      <div class="input-group date" data-provide="datepicker">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control input-sm pull-right" id="jurnal_duedate" name="jurnal_duedate" value = "<?php echo $row->jurnal_duedate;?>">
                                      </div>
                                    </div>
                                  </div>                          
                                  <div class="col-md-4 form-group form-group-sm row">
                                    <div class="col-xs-12">
                                      <label>Strukturunit</label>                                        
                                        <?php echo form_dropdown('istruk', $struktur, $row->strukturunit_id, 'id ="istruk" class="form-control" style="width: 100%;" required '); ?>
                                    </div>
                                  </div>
                                  <div class="col-md-4 form-group row">
                                    <div class="col-xs-12">
                                        <label>Faktur/Invoice</label>                                        
                                        <input type="text" id = "jurnal_faktur" name="jurnal_faktur" class="form-control input-sm" value="<?php echo $row->jurnal_faktur;?>" readonly>
                                    </div>
                                  </div>                                 
                                  <div class="col-md-11 form-group row">                                    
                                    <div class="col-xs-12">
                                      <label>Description:</label>
                                      <textarea id = "jurnal_descr" name="jurnal_descr" class="form-control input-sm" required rows="2" ><?php echo $row->jurnal_descr;?></textarea>
                                    </div>                                    
                                  </div>
                                  <div class="col-md-12 form-group row"></div>
                                  <div class="col-md-4 form-group row"></div>
                                  <div class="col-md-4 form-group row">
                                    <label class="col-sm-4">Jumlah Foreign</label>        
                                    <div class = "col-sm-8">                                                        
                                        <input type="text" id = "agreement_idr" name="agreement_idr" class="bulet form-control input-sm" style="text-align: right;font-weight: bold;" value="0" readonly>
                                    </div>  
                                  </div>                                
                                  <div class="col-md-4 form-group row form-group-sm">
                                    <label class="col-sm-4">Jumlah</label>        
                                    <div class = "col-sm-8">                    
                                      <div class="input-group input-group-sm">
                                        <input type="text" id = "agreement_idr" name="agreement_idr" class="bulet form-control input-sm"
                                          style="text-align: right;font-weight: bold;" value="0" readonly>
                                        <span class="input-group-addon" style="font-style: italic;">Rp.</span>
                                      </div>
                                    </div>  
                                  </div> 
                                  <div class="col-md-12 form-group row"></div>
                                  <div class="col-md-4 form-group row"></div>
                                  <div class="col-md-4 form-group row">
                                    <label class="col-sm-4">Selisih Foreign</label>        
                                    <div class = "col-sm-8">                                                        
                                        <input type="text" id = "agreement_idr" name="agreement_idr" class="bulet form-control input-sm" style="text-align: right;font-weight: bold;" value="0" readonly>
                                    </div>  
                                  </div> 
                                  <div class="col-md-4 form-group row form-group-sm">
                                    <label class="col-sm-4">Selisih</label>        
                                    <div class = "col-sm-8">
                                      <div class="input-group input-group-sm">
                                        <input type="text" id = "agreement_tlv" name="agreement_tlv" class="bulet form-control input-sm"
                                          style="text-align: right;font-weight: bold;" value="0" readonly>
                                        <span class="input-group-addon" style="font-style: italic;">Rp.</span>
                                      </div>
                                    </div> 
                                  </div> 
                                  <div class="col-md-12">                                  
                                  <br>
                                    <a href="javascript:void(0)" id="btdetil"><strong>Add Row</strong></a>
                                      <!-- Custom Tabs -->
                                      <div class="nav-tabs-custom">
                                        <ul class="detil nav nav-tabs">
                                          <li class="active"><a href="#tab_1" data-toggle="tab" role= "tab">Detail</a></li>
                                          <li><a href="#tab_2" data-toggle="tab" role = "tab">Reference</a></li>
                                          <li><a href="#tab_3" data-toggle="tab" role = "tab">Response</a></li>
                                          <li><a href="#tab_4" data-toggle="tab" role = "tab">Record</a></li>
                                        </ul>
                                        <div class="tab-content">
                                          <div class="tab-pane active" id="tab_1">
                                            <div class ="table-responsive">
                                              <table class="table table-bordered table-striped compact" id='jDetil' style="border:solid 1px #999; #999; border-radius:0px;">
                                                <thead>
                                                  <tr>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Account</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Description Detail</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Journal Detail IDR</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Region</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Branch</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Rekanan Name Breakdown</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Strukturunit</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Ref. ID</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Ref Line</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Channel</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Delete</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php if(isset($resultd)){                                                          
                                                      foreach($resultd as $rowd){
                                                  ?>
                                                    <tr>
                                                    <td><?php echo "$rowd->jurnaldetil_line";?><input type="hidden" name="dline[]" value="<?php echo "$rowd->jurnaldetil_line";?>"/></td>
                                                    <td><div class="form-group form-group-sm">
                                                          <?php echo form_dropdownext('dacc[]',$account, $rowd->acc_id, 'd_acc" class="account form-control" style="width: 100%;" required');?>
                                                        </div>
                                                    </td>                                                    
                                                    <td><input type="text" id="d_descr" name="ddescr[]" value="<?php echo $rowd->jurnaldetil_descr;?>" class="pops form-control input-sm"/>
                                                        <input type="hidden" name="dstate[]" value="update"/></td>
                                                    <td><input type="text" id="d_idr" name="didr[]" value="<?php echo $rowd->jurnaldetil_idr;?>" 
                                                              class="detil deci form-control input-sm" 
                                                              style= "<?php  echo ($rowd->jurnaldetil_idr< 0) ? 'color: red' : '';?>;text-align: right;"/>
                                                    </td>
                                                    <td><div class="form-group form-group-sm">
                                                          <?php echo form_dropdownext('dregion[]', $region, $rowd->region_id, 'id="d_region" class="region-sel form-control input-sm" required');?>
                                                        </div>
                                                    </td>                                                        
                                                    <td><div class="form-group form-group-sm">                                                          
                                                          <select data-placeholder="Select a Store" id= "d_branch" name= "dbranch[]" class="branch-sel" required>
                                                            <option value="<?php echo $row->branch_id;?>" selected="selected" ><?php echo $row->branch_name;?></option>
                                                          </select>
                                                        </div>
                                                    </td>
                                                    <td><div class="input-group input-group-sm">
                                                          <input type="text" id = "d_tenant" name="dtenant[]" class="form-control" value="<?php echo $rowd->rekanan_name;?>" required autocomplete="off">
                                                          <span class="input-group-btn">
                                                            <button id ="bTenant" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                          </span> 
                                                        <input type="hidden" id = "htenant" name="htenant" value="<?php echo $rowd->rekanan_id;?>">
                                                        </div>
                                                    </td>
                                                    <td><div class="form-group form-group-sm">
                                                          <?php echo form_dropdownext('dstruktur[]', $struktur, $rowd->strukturunit_id, 'id="d_struktur" class="struktur-sel form-control input-sm" required');?>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" id="d_ref" name="dref[]" value="<?php echo $rowd->ref_id;?>" class="form-control input-sm" readonly/></td>
                                                    <td><input type="text" id="d_refline" name="drefline[]" value="<?php echo $rowd->ref_line;?>" class="form-control input-sm" readonly /></td>
                                                    <td><input type="text" id="d_channel" name="dchannel[]" value="<?php echo $rowd->channel_id;?>" class="form-control input-sm" readonly/></td>
                                                    <td><a id= "rDelete" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a></td>
                                                    </tr>
                                                    <script>                                                      
                                                    </script>
                                                  <?php
                                                     }
                                                   }
                                                  ?>
                                                </tbody>
                                              </table>
                                             </div>
                                            </div>
                                            <div class="tab-pane" id="tab_2">
                                            <div class ="table-responsive">                                             
                                              <table class="table table-bordered table-striped" id='chargeTab' style="border:solid 1px #999; #999; border-radius:0px;">
                                                <thead>
                                                  <tr>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Transaction Type</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Start Date Paym.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">P. Inst</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Start Date Trans.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">R.Ins(M)</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">R.Ins(D)</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">End Date Trans.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Intval.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Time Unit.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Per(%)</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Unit</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Ind./Outd.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Space</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Lump.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Base Rent IDR</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Monthly Installment</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">VAT(%)</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Adend.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">n-Inst.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Descr</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Delete</th>
                                                  </tr>
                                                </thead>
                                                <tbody>                                                  
                                                </tbody>
                                              </table>
                                             </div>
                                            </div>
                                            <div class="tab-pane" id="tab_3">
                                             <div class ="table-responsive">
                                              <table class="table table-bordered table-striped" id='depositTab' style="border:solid 1px #999; #999; border-radius:0px;">
                                                <thead>
                                                  <tr>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Line</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Transaction Type</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Start Date Trans.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Len.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Time Type</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Unit</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Space</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Lump.</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Base Rent/Total</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Monthly Installment</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">VAT</th>
                                                      <th bgcolor="#3c8dbc" style="background: #0096d5; color: white;">Delete</th>
                                                  </tr>
                                                </thead>
                                                <tbody>                                                   
                                                </tbody>
                                              </table>
                                             </div>
                                            </div>                                            
                                            <div class="tab-pane" id="tab_5">
                                              <div class="row">
                                               <div class="col-md-6">
                                                <div class="col-xs-8">
                                                  <label>Create By</label>
                                                  <input type="text" id= "jurnal_createby" name="jurnal_createby" class="form-control input-sm" value="<?php echo $row->jurnal_createby;?>">
                                                </div>
                                               </div>
                                               <div class="col-md-6">
                                                <div class="col-xs-8">
                                                  <label>Create Date</label>
                                                  <input type="text" id="jurnal_createdate" name="jurnal_createdate" class="form-control input-sm" value="<?php echo $row->jurnal_createdate;?>">
                                                </div>
                                               </div>
                                               <div class="col-md-6">
                                                <div class="col-xs-8">
                                                  <label>Modify By</label>
                                                  <input type="text" id= "jurnal_modifyby"  name="jurnal_modifyby" class="form-control input-sm" value="<?php echo $row->jurnal_modifyby;?>">
                                                </div>
                                               </div>
                                               <div class="col-md-6">
                                                <div class="col-xs-8">
                                                  <label>Modify Date</label>
                                                  <input type="text" id="jurnal_modifydate" name="jurnal_modifydate" class="form-control input-sm" value="<?php echo $row->jurnal_modifydate;?>">
                                                </div>
                                               </div>
                                               </div>
                                            </div>
                                          <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- nav-tabs-custom -->
                                    </div>
                                    <!-- /.col -->
                                <div class="col-xs-12">
                                  <br /><input type="submit" value="SUBMIT" class="btn btn-sm btn-info" <?php echo ($row->jurnaltype_id) === 'JV' && (!($row->jurnal_isposted)) ? '' : 'disabled';?> />
                                </div>
                              </div>
                             </div>
                            </form>
                            <?php }}?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- END OF CONTENT -->
