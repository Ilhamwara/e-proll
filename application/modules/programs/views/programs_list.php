<script>
  $(document).ready(function() {

    var oTable = $('#programsTable').DataTable({
      'ajax': {
          "url": '<?php echo site_url('programs/controller_gridlist')?>',
          "type": 'POST'
      },
      'columns':[
        {data: 'rownum'},
        {data: 'menu'},
        {data: 'program_id'},
        {data: 'program_group_id'},
        {data: 'program_title'},
        {data: 'program_url'},
        {data: 'program_ico'},
        {data: 'program_class'}
      ],
      'processing': true,
      'serverSide': true,
      'columnDefs': [
        {
            'targets': 0,
            'checkboxes': {
              'selectRow': true
            },
        },
        {'targets': 1, orderable: false},
        {'targets': 2, className: 'primarykey'}
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[2, 'asc']]
    });
/*
    $('#oTable tbody').on('click', 'tr', function () {
      $(this).toggleClass('selected');
    });
*/
    const obj = {
      program_id: $('#program_id'),
      program_group_id: $('#program_group_id'),
      program_title: $('#program_title'),
      program_url: $('#program_url'),
      program_class: $('#program_class'),
      datastate: 'insert'
    }

    //console.log(oTable);
    $('.btn-create').on('click', function() {

      $('#form-collapse').collapse('show');
      oTable.rows( '.selected' ).nodes().to$().removeClass( 'selected' );

      let oForm={
          'primarykey': obj.program_id,
          'autoid': true
      }

      if (oForm.autoid) {
        obj.program_id.prop('readonly', true);
      }else{
        obj.program_id.prop('readonly', false);
      }

      obj.program_id.val('');
      obj.program_group_id.empty();
      obj.program_url.val('');
      obj.program_title.val('');
      obj.program_class.val('');
      obj.datastate = 'insert';

    })

    $('#programsTable').on('click', '.btn-edit', function(e) {

        $('#form-collapse').collapse('show');

        let oForm={
            "action": "update"
        };

        primarykey = $(this).closest('tr').find('.primarykey').text();

        oTable.rows( '.selected' ).nodes().to$().removeClass( 'selected' );
        $(this).closest('tr').toggleClass('selected');

        oForm['program_id'] = primarykey;
        obj.datastate = 'update';

        url = "<?php echo site_url('programs/programs_retrieve');?>";

        retrive(url, oForm)
          .then(function(result) {
           console.log(result);

           //obj.program_group_id.val(null).trigger('change');
           obj.program_id.val(result.record[0].program_id);
           //obj.program_group_id.val(result.record[0].program_group_id);
           //$("#myMultipleSelect2").val(5).trigger('change');
           //obj.program_group_id.val(result.record[0].program_group_id).trigger('change');
           //obj.program_group_id.append(new Option(result.record[0].program_group_name, result.record[0].program_group_id, false, false)).trigger('change');
           if (obj.program_group_id.find("option[value='" + result.record[0].program_group_id + "']").length) {
                obj.program_group_id.val(result.record[0].program_group_id).trigger('change');
            } else {
                var newOption = new Option(result.record[0].program_group_name, result.record[0].program_group_id, true, true);
                obj.program_group_id.append(newOption).trigger('change');
            }
           obj.program_title.val(result.record[0].program_title);
           obj.program_url.val(result.record[0].program_url);
           obj.program_class.val(result.record[0].program_class);
        })
    });

    async function retrive(url, param){
      let result;

      try{
          result = await $.ajax({
              url: url,
              type: 'POST',
              data: param,
              dataType : 'json'
          });

          return result;

      } catch (error) {
        console.error(error);
      }
    }

    $('#form-cancel').on('click', function() {
      $('#form-collapse').collapse('hide');
      oTable.rows( '.selected' ).nodes().to$().removeClass( 'selected' );
      //oTable.rows('.selected').deselect();
    })

    $('#form').submit( function (e){

      let oForm={};
      //alert('test');
      oForm['header'] = {
                program_id: obj.program_id.val(),
                program_group_id: obj.program_group_id.val(),
                program_title: obj.program_title.val(),
                program_url: obj.program_url.val(),
                program_class: obj.program_class.val(),
      };

      oForm['detil'] = [];
      oForm['options'] = {'autoid': true};
      oForm['action'] = obj.datastate;
      //console.log(oForm);
      $.ajax({
          url      : "<?php echo site_url('programs/programs_save');?>",
          type     : 'POST',
          data     : oForm,
          dataType : 'json',
          success: function(e) {
            //console.log(e);
            if (!e.status){
              Metronic.alert({
                  type: 'danger',
                  icon: 'warning',
                  message: e.message,
                  place: 'prepend'
              });
            } else {
              obj.program_id.val(e.id);
              oTable.ajax.reload( null, false );
              //display_modal('Success!', `Data '`+e.id+`' has been saved.`);
              Metronic.alert({
                  type: 'success',
                  icon: 'check',
                  message: `Data '`+e.id+`' has been saved.`,
                  place: 'prepend',
                  closeInSeconds: 3
              });
            }
          },
          error: function(xhr) {
              if (xhr.status == 500) {
                  //display_modal('Internal error:',`[ERROR] Eksekusi API Error`);
                  Metronic.alert({
                      type: 'danger',
                      icon: 'warning',
                      message: `Internal Error: [ERROR] Eksekusi API Error `+xhr.responseText,
                      place: 'prepend'
                  });
              } else {
                  Metronic.alert({
                      type: 'danger',
                      icon: 'warning',
                      message: `[ERROR] Eksekusi API Error `+xhr.responseText,
                      place: 'prepend'
                  });
              }
          }
      });
      e.preventDefault();
    });

    $('#program_group_id').select2({
        minimumInputLength: 0,
        allowClear: true,
        placeholder: 'Select an Option',
        ajax: {
            url: '<?php echo site_url('programs/groups_select')?>',
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
                        return {
                            //sqm: item.unit_sqm,
                            text: item.group_name,
                            id: item.group_id
                        }
                    })
                };
            }
        }
    });

    $('#test').on('click', function() {
      var rows_selected = oTable.column(0).checkboxes.selected();
        // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
          console.log(rowId);
      });

    })

    function display_modal(title, message){
        $("#modal-default").modal("show");
        $('.modal-title').show().html(title);
        $('.modal-body').show().html(message);
    }

  });
</script>

<style>
table.dataTable tbody tr.selected {
    background-color: #B0BED9 !important;
}
</style>

<!-- MODAL BEGIN -->
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
          <a  class="btn btn-create blue-madison">Create</a>
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
      <div class="portlet-body form collapse" id="form-collapse">
        <!-- BEGIN FORM -->
        <form id="form" class="form-horizontal">
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
                <select data-placeholder="Select an Option" id= "program_group_id" class="form-control" style="width: 100%;" required>
                </select>
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
          <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-2 col-md-6">
                <button type="submit" class="btn blue-madison btn-sm">Submit</button>
                <a id="form-cancel" class="btn default btn-sm">Back</a>
              </div>
            </div>
          </div>
        </form>
        <!-- END FORM -->
      </div>
      <div class="portlet-body" style="display: block;">
        <table class="table table-hover text-nowrap" id='programsTable' cellspacing=0 width="100%">
          <thead>
            <tr role="row" class="bg-blue-hoki">
              <th></th>
              <th width="50px">Edit</div></th>
              <th width="80px">ID</th>
              <th width="80px">Group Name</th>
              <th width="100px">Program Title</th>
              <th width="80px">Program URL</th>
              <th width="100px">Program Ico</th>
              <th width="100px">Program Class</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
