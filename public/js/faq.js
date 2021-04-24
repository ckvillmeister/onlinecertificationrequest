$(document).ready(function(){

var faq_id = 0;
get_faqs(1);

$('#btn_submit').click(function(e){
  process_faq(faq_id);
  get_faqs(1);
});

$('#btn_new_faq').click(function(e){
   $('#text_question').val('');
   $('#text_answer').val('');
});

$('#btn_active').click(function(e){
   get_faqs(1);
});

$('#btn_trash').click(function(e){
   get_faqs(0);
});

$('body').on('click', '#btn_edit_faq', function(e){
  faq_id = $(this).val();
  get_faq_info(faq_id);
  $('#modal_faq_form').modal('show');
});

$('body').on('click', '#btn_delete_faq', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to delete this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_faq(id, 0);
                  get_faqs(1);
                },
                no: function () {

                }
      }
  });
});

$('body').on('click', '#btn_activate_faq', function(e){
  var id = $(this).val();
  $.confirm({
      title: 'Confirm',
      content: 'Are you sure you want to activate this item?',
      type: 'blue',
      buttons: {
                yes: function () {
                  toggle_faq(id, 1);
                  get_faqs(0);
                },
                no: function () {

                }
      }
  });
});

function process_faq(id){
  $.ajax({
      url: 'process_faq',
      method: 'POST',
      data: {id: id, 
            question: $('#text_question').val(),
            answer: $('#text_answer').val()
      },
      success: function(result) {
        if (result == 1){
          $.alert({
              title: 'Saved!',
              type: 'green',
              content: "New FAQ added!",
              buttons: {
                        ok: function () {
                          $('#modal_faq_form').modal('hide');
                        }
              }
          });
        }
        else if (result == 2){
          $.alert({
              title: 'Updated!',
              type: 'green',
              content: "FAQ updated!",
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

function get_faqs(status){
  $.ajax({
      url: 'get_faqs',
        method: 'POST',
        data: {status: status},
        dataType: 'html',
      success: function(result) {
        $('#faqs_list').html(result);
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

function get_faq_info(id){
  $.ajax({
      url: 'get_faq_info',
        method: 'POST',
        data: {id: id},
        dataType: 'JSON',
      success: function(result) {
        $('#text_question').val(result['question']);
        $('#text_answer').val(result['answer']);
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

function toggle_faq(id, status){
  $.ajax({
      url: 'toggle_faq',
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
