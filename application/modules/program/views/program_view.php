<link href="<?php echo base_url('assets/jsinternal/jquery-easyui-1.9.7/themes/default/easyui.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/jsinternal/jquery-easyui-1.9.7/themes/icon.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/jsinternal/jquery-easyui-1.9.7/themes/color.css') ?>" rel="stylesheet" type="text/css">
<!-- BEGIN USER SCRIPTS -->
<script src="<?php echo base_url('assets/jsinternal/jquery-easyui-1.9.7/jquery.easyui.min.js');?>" type="text/javascript"></script>
<!-- END USER SCRIPTS -->

<script>  
 $(document).ready(function() { 
    if ($.fn.datagrid) {
      $('.easyui-datagrid').datagrid({       
        title: 'Master Program',
        loadFilter: function(e){
          return {total: e.recordsTotal, rows:e.data}
        }
      })
    }
 });
</script>  

<style>
  
</style>

  <!-- BEGIN PAGE CONTENT-->        
  <table class="easyui-datagrid"
        data-options="url:'<?php echo site_url('program/controller_gridlist'); ?>',method:'get',singleSelect:true,fit:true,fitColumns:true">
    <thead>
      <tr>
          <th data-options="field:'program_id'" width="80">ID</th>
          <th data-options="field:'program_group_id'" width="100">Group(s)</th>
          <th data-options="field:'program_title'" width="80">Title</th>
          <th data-options="field:'program_url'" width="100">Url</th>
          <th data-options="field:'program_ico'" width="90">Ico</th>
          <th data-options="field:'program_class'" width="80">Class</th>
      </tr>
    </thead>
</table>
