$(document).ready(function(){

var item_id = 0;
get_checklist(1);

$('#btn_submit').click(function(e){
  process_checklist(item_id);
  get_checklist(1);
});

$('#btn_new_item').click(function(e){
  item_id = 0;
  $('#text_description').val('');
});

$('#btn_active').click(function(e){
   get_checklist(1);
});

$('#btn_trash').click(function(e){
   get_checklist(0);
});

$('body').on('click', '#btn_edit_checklistitem', function(e){
  item_id = $(this).val();
  get_checklistitem_info(item_id);
  $('#modal_checklist_item_form').modal('show');
});

$('body').on('click', '#btn_delete_checklistitem', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to delete this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_checklist_item(id, 0);
                  get_checklist(1);
                },
                no: function () {

                }
      }
  });
});

$('body').on('click', '#btn_activate_checklistitem', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to activate this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_checklist_item(id, 1);
                  get_checklist(0);
                },
                no: function () {

                }
      }
  });
});

function process_checklist(id){
  $.ajax({
      url: 'checklist/process_checklist',
        method: 'POST',
        data: {id: id, 
          description: $('#text_description').val()
        },
      success: function(result) {
        if (result == 1){
          $.alert({
              title: 'New Item',
              type: 'green',
              content: "New checklist item added!",
              buttons: {
                        ok: function () {
                          $('#modal_checklist_item_form').modal('hide');
                        }
              }
          });
        }
        else if (result == 2){
          $.alert({
              title: 'Item Updated',
              type: 'green',
              content: "Checklist item updated!",
              buttons: {
                        ok: function () {
                          $('#modal_checklist_item_form').modal('hide');
                        }
              }
          });
        }
        else{
          $.alert({
              title: 'Error!',
              type: 'red',
              content: "Error during submission!",
          });
        }
      },
      error: function(obj, err, ex){
        $.alert({
              title: 'Error!',
              type: 'red',
              content: err + ": " + obj.toString() + " " + ex,
          });
    }
  })
}

function get_checklist(status){
  $.ajax({
      url: 'checklist/get_checklist',
        method: 'POST',
        data: {status: status},
        dataType: 'html',
      success: function(result) {
        $('#checklist').html(result);
      },
      error: function(obj, err, ex){
        $.alert({
              title: 'Error!',
              type: 'red',
              content: err + ": " + obj.toString() + " " + ex,
          });
    }
  })
}

function get_checklistitem_info(id){
  $.ajax({
      url: 'checklist/get_checklistitem_info',
        method: 'POST',
        data: {id: id},
        dataType: 'JSON',
      success: function(result) {
        $('#text_description').val(result['description']);
      },
      error: function(obj, err, ex){
        $.alert({
              title: 'Error!',
              type: 'red',
              content: err + ": " + obj.toString() + " " + ex,
          });
    }
  })
}

function toggle_checklist_item(id, status){
  $.ajax({
      url: 'checklist/toggle_checklist_item',
        method: 'POST',
        data: {id: id, status: status},
        dataType: 'html',
      success: function(result) {
        
      },
      error: function(obj, err, ex){
        $.alert({
              title: 'Error!',
              type: 'red',
              content: err + ": " + obj.toString() + " " + ex,
          });
    }
  })
}

});