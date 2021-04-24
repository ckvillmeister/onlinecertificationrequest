$(document).ready(function(){

  var faq_id = 0;
  get_photos(1);

  $('#btn_submit').click(function(e){
    process_photo(faq_id);
    get_photos(1);
  });

  $('#btn_new_photo').click(function(e){
     $('#text_caption').val('');
     $('#upload_photo').val('');
  });

  $('#btn_active').click(function(e){
     get_photos(1);
  });

  $('#btn_trash').click(function(e){
     get_photos(0);
  });

  $('body').on('click', '#btn_delete_photo', function(e){
    var id = $(this).val();
    $.confirm({
        title: 'Confirm',
        content: 'Are you sure you want to delete this photo?',
        type: 'blue',
        buttons: {
                  yes: function () {
                    toggle_photo(id, 0);
                    get_photos(1);
                  },
                  no: function () {

                  }
        }
    });
  });

  $('body').on('click', '#btn_activate_photo', function(e){
    var id = $(this).val();
    $.confirm({
        title: 'Confirm',
        content: 'Are you sure you want to activate this photo?',
        type: 'blue',
        buttons: {
                  yes: function () {
                    toggle_photo(id, 1);
                    get_photos(0);
                  },
                  no: function () {

                  }
        }
    });
  });

  function process_photo(id){
    var caption = $('#text_caption').val();
    var file_data = $("#upload_photo")[0].files[0];   
    var form_data = new FormData();            
    form_data.append('file', file_data);

    $.ajax({
        url: 'process_photo?caption='+caption,
        method: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(result) {
          if (result == 1){
            $.alert({
                title: 'Saved!',
                type: 'green',
                content: "New Photo added!",
                buttons: {
                          ok: function () {
                            $('#modal_faq_form').modal('hide');
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

  function get_photos(status){
    $.ajax({
        url: 'get_photos',
          method: 'POST',
          data: {status: status},
          dataType: 'html',
        success: function(result) {
          $('#gallery_list').html(result);
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

  function toggle_photo(id, status){
    $.ajax({
        url: 'toggle_photo',
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