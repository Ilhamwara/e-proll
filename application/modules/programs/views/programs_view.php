

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
      <div class="portlet-title" id='portlet_top'>
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
