$(document).ready(function(){

var service_id = 0;
get_services(1);

$('#btn_submit').click(function(e){
  process_service(service_id);
  get_services(1);
});

$('#btn_new_service').click(function(e){
    service_id = 0;
   $('#text_service_name').val('');
   $('#text_description').val('');
});

$('#btn_active').click(function(e){
   get_services(1);
});

$('#btn_trash').click(function(e){
   get_services(0);
});

$('body').on('click', '#btn_edit_service', function(e){
  service_id = $(this).val();
  get_service_info(service_id);
  $('#modal_service_form').modal('show');
});

$('body').on('click', '#btn_delete_service', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to delete this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_service(id, 0);
                  get_services(1);
                },
                no: function () {

                }
      }
  });
});

$('body').on('click', '#btn_activate_service', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to activate this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_service(id, 1);
                  get_services(0);
                },
                no: function () {

                }
      }
  });
});

function process_service(id){
  $.ajax({
      url: 'process_service',
      method: 'POST',
      data: {id: id, 
            service_name: $('#text_service_name').val(),
            desc: $('#text_description').val()
      },
      success: function(result) {
        if (result == 1){
          $.alert({
              title: 'Saved!',
              type: 'green',
              content: "New service added!",
              buttons: {
                        ok: function () {
                          $('#modal_service_form').modal('hide');
                        }
              }
          });
        }
        else if (result == 2){
          $.alert({
              title: 'Updated!',
              type: 'green',
              content: "service updated!",
              buttons: {
                        ok: function () {
                          $('#modal_service_form').modal('hide');
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

function get_services(status){
  $.ajax({
      url: 'get_services',
        method: 'POST',
        data: {status: status},
        dataType: 'html',
      success: function(result) {
        $('#services_list').html(result);
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

function get_service_info(id){
  $.ajax({
      url: 'get_service_info',
        method: 'POST',
        data: {id: id},
        dataType: 'JSON',
      success: function(result) {
        $('#text_service_name').val(result['name']);
        $('#text_description').val(result['desc']);
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

function toggle_service(id, status){
  $.ajax({
      url: 'toggle_service',
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
