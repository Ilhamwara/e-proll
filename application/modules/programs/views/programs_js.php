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

      obj.datastate = 'insert';
      obj.program_id.val('');
      obj.program_group_id.empty();
      obj.program_url.val('');
      obj.program_title.val('');
      obj.program_class.val('');

    })

    $('#programsTable').on('click', '.btn-edit', function(e) {

        e.preventDefault();

        //$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
        //$('html,body').animate({scrollTop:($(this).position()).top}, 500);
        Metronic.scrollTop();

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
           //console.log(result);
           obj.program_id.val(result.record[0].program_id);
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
              dataType: 'json'
          });

          return result;

      } catch (error) {
        console.error(error);
      }
    }

    async function save(url, param){
        let result;

        try {
             result = await $.ajax({
                 url: url,
                 type: 'POST',
                 data: param,
                 dataType: 'json'
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

      url = `<?php echo site_url('programs/programs_save');?>`;

      save(url, oForm)
        .then( function (result){
            //console.log(result);
            if (!result.status){
                Metronic.alert({type: 'danger', icon: 'warning', message: result.message, place: 'prepend'});
            } else {
               obj.program_id.val(result.id);
               oTable.ajax.reload( null, false );
               Metronic.alert({type: 'success', icon: 'check', message: `Data '`+result.id+`' has been saved.`, place: 'prepend', closeInSeconds: 3});
               obj.datastate = 'update';
            }
        })
/***
      $.ajax({
          url      : "<?php //echo site_url('programs/programs_save');?>",
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
**/
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
