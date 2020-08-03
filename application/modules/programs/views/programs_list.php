<script>
  $(document).ready(function() {

    var oTable = $('#programsTable').DataTable({
      'ajax': {
          "url": '<?php echo site_url('programs/controller_gridlist')?>',
          "type": 'POST'
      },
      'processing': true,
      'serverSide': true,
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
              'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
   });

    //console.log(oTable);

    $('#programsTable').on('click', '.btn-edit', function(e) {

        console.log($(this).closest('tr').find('.primarykey').text());
        return false;

    });

    $('#test').on('click', function() {
      var rows_selected = oTable.column(0).checkboxes.selected();
        // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
          console.log(rowId);
      });

    })

  });
</script>

<style>

</style>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-gift"></i>Master Programs (Bootstrap)
        </div>
        <div class="actions">
          <a href="<?php echo site_url('programs/programs_add');?>" class="btn blue-madison">Create</a>
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
      <div class="portlet-body" style="display: block;">
        <table class="table table-hover text-nowrap" id='programsTable' cellspacing=0 width="100%">
          <thead>
            <tr role="row" class="heading">
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
