var item_id = 0;

get_checklist(1);

$('#btn_submit').click(function(e){
  process_checklist(item_id);
  get_checklist(1);
});

$('#btn_new_item').click(function(e){
   $('#text_description').val('');
});

$('#btn_active').click(function(e){
   get_checklist(1);
});

$('#btn_trash').click(function(e){
   get_checklist(0);
});

$('.btn_yes').click(function(e){
  toggle_checklist_item(item_id, 0);
  $('#modal_confirm').modal('hide');
  get_checklist(1);
});

$('body').on('click', '#btn_edit_checklistitem', function(e){
  item_id = $(this).val();
  get_checklistitem_info(item_id);
  $('#modal_checklist_item_form').modal('show');
});

$('body').on('click', '#btn_delete_checklistitem', function(e){
  item_id = $(this).val();
  $('#modal_confirm #modal_title').html("Confirm");
  $('#modal_confirm #modal_body').html("Are you sure you want to delete this item?");
  $('#modal_confirm').modal('show');
});

$('body').on('click', '#btn_activate_checklistitem', function(e){
  item_id = $(this).val();
  toggle_checklist_item(item_id, 1);
  $('#modal_confirm').modal('hide');
  get_checklist(0);
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
          $('#modal_message_box #modal_title').html("New Item");
          $('#modal_message_box #modal_body').html("New checklist item added!");
          $('#modal_message_box').modal('show');
          
          setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
          setTimeout(function(){ $('#modal_role_form').modal('hide'); }, 3000);
        }
        else if (result == 2){
          $('#modal_message_box #modal_title').html("Item Updated");
          $('#modal_message_box #modal_body').html("Checklist item updated!");
          $('#modal_message_box').modal('show');

          setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
          setTimeout(function(){ $('#modal_role_form').modal('hide'); }, 3000);
        }
        else{
          $('#modal_message_box #modal_title').html("Error");
          $('#modal_message_box #modal_body').html("Error during submission. . .");
          $('#modal_message_box').modal('show');
        }
      },
      error: function(obj, err, ex){
        $('#modal_message_box #modal_title').html("Error");
        $('#modal_message_box #modal_body').html(err + ": " + obj.toString() + " " + ex);
        setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
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
        $('#modal_message_box #modal_title').html("Error");
        $('#modal_message_box #modal_body').html(err + ": " + obj.toString() + " " + ex);
        setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
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
        $('#modal_message_box #modal_title').html("Error");
        $('#modal_message_box #modal_body').html(err + ": " + obj.toString() + " " + ex);
        setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
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
        $('#modal_message_box #modal_title').html("Error");
        $('#modal_message_box #modal_body').html(err + ": " + obj.toString() + " " + ex);
        setTimeout(function(){ $('#modal_message_box').modal('hide'); }, 3000);
    }
  })
}
