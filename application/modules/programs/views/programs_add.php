<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>   

  $(document).ready(function() {
      //$('#inputTglLahir').inputmask();

      $('#btn-submit').click( function (){

        let oForm={
            "action": "insert"
        };
        //alert('test');
        oForm['header'] = {
                  program_id: $('#program_id').val(), 
                  program_group_id: $('#program_group_id').val(), 
                  program_title: $('#program_title').val(), 
                  program_url: $('#program_url').val(),
                  program_class: $('#program_class').val()
        };

        oForm['detil'] = [];
        oForm['options'] = {'autoid': true};
        console.log(oForm);
        $.ajax({
            url      : "<?php echo site_url('programs/programs_save');?>",
            type     : 'POST',
            data     : oForm,
            dataType : 'json',
            success: function(e) {
              // Run the code here that needs
              //    to access the data returned
              //console.log(e);
              if (!e.status){            
                display_modal('Error!', e.message);
              } else {                       
                $('#program_id').val(e.id);             
                display_modal('Success!', `Data '`+e.id+`' has been saved.`);
              }
/*
              oTable.rows().eq(0).each( function ( index ) {
                  var row = oTable.row( index );                
                  var d = row.data();

                  d['coll_id'] = e.data.id;
                  d['_rowstate'] = 'update';
                  oTable.row(row).data(d).draw();                                      
              });
*/                                
            },
            error: function(xhr) {
                //console.log(d.statusText);
                if (xhr.status == 500) {
                    display_modal('Internal error:',`[ERROR] Eksekusi API Error`);
                } else {
                    display_modal('You have an error', `[ERROR] Eksekusi API Error`);
                }
            }
        }); 


                
      }); 

      function display_modal(title, message){
          $("#modal-default").modal("show");
          $('.modal-title').show().html(title);
          $('.modal-body').show().html(message);
		      //alert(message);		   
      }
  });

</script>

<style>
textarea {
  resize: vertical;
}
</style>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Success!</h4>
      </div>
      <div class="modal-body">
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
        
<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>Master Programs (Bootstrap)
        </div>
        <div class="actions">
          <a href="#" id="btn-submit" class="btn blue-madison">Save</a>
          <!--<input type="submit" value="SUBMIT" class="btn blue-madison btn-sm" />-->
          <div class="btn-group">
            <a href="#" class="btn blue-madison dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">Action
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a id='test' href="javascript:;"> Export </a>
              </li>
              <li>
                <a href="javascript:;"></i> Delete </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body" style="display: block;">
        <!-- BEGIN FORM -->
        <form id="form" action ="#" class="form-horizontal">
          <div class="form-body">
            <div class="form-group">
              <label class="col-md-2 control-label">ID</label>
              <div class="col-md-4">
                <input id="program_id" type="text" class="form-control" placeholder="[auto_generate]">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Group Name</label>
              <div class="col-md-4">
                <input id="program_group_id" type="text" class="form-control" placeholder="Auto..">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Program Title </label>
              <div class="col-md-4">
                <input id="program_title" type="text" class="form-control" placeholder="Nama Program">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Program URL</label>
              <div class="col-md-4">
                <input id="program_url" type="text" class="form-control" placeholder="Class/Method">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label">Program Class</label>
              <div class="col-md-4">
                <input id="program_class" type="text" class="form-control" placeholder="Class Name">
              </div>
            </div>                  
          </div>
        </form>    
        <!-- END FORM -->        
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTENT-->       