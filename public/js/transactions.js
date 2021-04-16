$(document).ready(function(){

  var finding = 2;

  get_requests(2);

  $('#btn_new_requests').click(function(){
    get_requests(2);
  });

  $('#btn_approved_requests').click(function(){
    get_requests(3);
  });

  $('#btn_rejected_requests').click(function(){
    get_requests(0);
  });

  $('#btn_add_findings').click(function(){
    $('#findings').append('<div class="row mt-3">'+
            '<div class="col-lg-2 align-self-center">Finding #' + finding + ':</div>' +
            '<div class="col-lg-9"><input type="text" class="form-control form-control-sm" id="text_finding"></div>' +
            '<div class="col-lg-1"><button class="btn btn-sm btn-danger" id="btn_remove_finding"><i class="fas fa-times"></i></button></div>' +
            '</div>');
    finding++;
  });

  $(document).on('click', '#btn_remove_finding', function(){
    $(this).closest('div').parent().remove();
    finding--;

    var fctr = 1;
    $('#findings .row .col-lg-2').each(function(){
      $(this).html('Finding #'+fctr+':');
      fctr++;
    });
  });

  $('body').on('click', '#btn_approve', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to approve this request?',
      buttons: {
                yes: function () {
                    toggle_request(id, 3);
                    get_requests(2)
                },
                no: function () {

                }
              }
    });
  });

  $('body').on('click', '#btn_reject', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to reject this request?',
      buttons: {
                yes: function () {
                    toggle_request(id, 0);
                    get_requests(2);
                },
                no: function () {

                }
              }
    });
  });

  $('body').on('click', '#btn_reactivate', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to re-activate this request?',
      buttons: {
                yes: function () {
                    toggle_request(id, 2);
                    get_requests(0);
                },
                no: function () {

                }
              }
    });
  });

  
  $('body').on('click', '#btn_view', function(){
    var id = $(this).val();
    $('#btn_save').val(id);
    $('#btn_print_this').val(id);
    get_request_info(id);
    get_request_findings(id);
    get_request_note(id);
    $('#modal_view_info').modal({
                backdrop: 'static',
                keyboard: false
            })
  });

  $('body').on('click', '#btn_print', function(){
    var id = $(this).val();
    print_certificate(id);
  });

  $('#btn_print_this').click(function(){
    var id = $(this).val();
    print_certificate(id);
  });

  $('#btn_save').click(function(){
    var findings = [], ctr = 0, error = 0;
    $('#findings input[type="text"]').each(function(){
      if ($(this).val() == ''){
        error = 1;
      }
      else{
        findings[ctr] = $(this).val();
        ctr++;
      } 
    });

    if (error == 1){
      $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide findings in the empty field!',
        });
    }
    else{
      var firstname = $('#text_firstname').val(),
      middlename = $('#text_middlename').val(),
      lastname = $('#text_lastname').val(),
      extension = $('#cbo_extension').val(),
      address = $('#text_address').val(),
      sex = $('#cbo_sex').val(),
      dob = $('#text_dob').val(),
      contact = $('#text_contactno').val(),
      note = $('#text_note').val(),
      id = $('#btn_save').val();

      if (firstname == ''){
        $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide patient first name!',
        });
      }
      else if(lastname == ''){
        $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide patient last name!',
        });
      }
      else if(address == ''){
        $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide patient address!',
        });
      }
      else if(dob == ''){
        $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide patient date of birth!',
        });
      }
      else{
          update_cert_req(id, firstname, middlename, lastname, extension, address, sex, dob, contact, findings, note);
      }
    }
  });

  function get_requests(status){
    $.ajax({
        url: 'get_requests',
          method: 'POST',
          data: {status: status},
          dataType: 'html',
        beforeSend: function() {
          $('.overlay-wrapper').html('<div class="overlay">' +
                    '<i class="fas fa-3x fa-sync-alt fa-spin"></i>' +
                    '<div class="text-bold pt-2">Loading...</div>' +
                        '</div>');
          },
        complete: function(){
          $('.overlay-wrapper').html('');
        },
        success: function(result) {
          $('#request_list').html(result);
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

  function toggle_request(id, status){
    $.ajax({
        url: 'toggle_request',
          method: 'POST',
          data: {id: id, status: status},
          dataType: 'html',
        success: function(result) {
          
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

  function get_request_info(id){
    $.ajax({
        url: 'get_request_info',
          method: 'POST',
          data: {id: id},
          dataType: 'JSON',
        success: function(result) {
          $('#text_firstname').val(result['firstname']);
          $('#text_middlename').val(result['middlename']);
          $('#text_lastname').val(result['lastname']);
          $('#cbo_extension').val(result['extension']);
          $('#cbo_sex').val(result['sex']);
          $('#text_contact').val(result['contact_number']);
          $('#text_dob').val(result['dob']);
          $('#text_address').val(result['address']);
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

  function get_request_findings(id){
    $.ajax({
        url: 'get_findings',
          method: 'POST',
          data: {id: id},
          dataType: 'JSON',
        success: function(result) {
          var ctr = 1;
          $("#findings").children(":not(#always)").remove();

          $.each(result, function(key, value) {
            $.each(this, function(key, value) {
                if (ctr == 1 & key == 'finding'){
                  $('#text_finding').val(value);
                }
                else{
                  if (key == 'finding'){
                    $('#findings').append('<div class="row mt-3">'+
                    '<div class="col-lg-2 align-self-center">Finding #' + finding + ':</div>' +
                    '<div class="col-lg-9"><input type="text" class="form-control form-control-sm" id="text_finding"value="'+value+'"></div>' +
                    '<div class="col-lg-1"><button class="btn btn-sm btn-danger" id="btn_remove_finding"><i class="fas fa-times"></i></button></div>' +
                    '</div>');
                    finding++;
                  }
                }
            });
            ctr++;
          });
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

  function get_request_note(id){
    $.ajax({
        url: 'get_note',
          method: 'POST',
          data: {id: id},
          dataType: 'JSON',
        success: function(result) {
          $('#text_note').val(result['note']);
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

  function update_cert_req(id, firstname, middlename, lastname, extension, address, sex, dob, contact, findings, note){
    $.ajax({
        url: 'update_cert_req',
          method: 'POST',
          data: {id: id,
                firstname: firstname, 
                middlename: middlename,
                lastname: lastname,
                extension: extension,
                address: address,
                sex: sex,
                dob: dob,
                contact: contact,
                findings: findings,
                note: note},
          dataType: 'html',
        beforeSend: function() {
          $('.overlay-wrapper').html('<div class="overlay">' +
                    '<i class="fas fa-3x fa-sync-alt fa-spin"></i>' +
                    '<div class="text-bold pt-2">Loading...</div>' +
                        '</div>');
          },
        complete: function(){
          $('.overlay-wrapper').html('');
        },
        success: function(result) {
          if (result == 1){
            $.alert({
                title: 'Success',
                type: 'blue',
                content: 'Patient info has been saved!',
            });
          }
          else{
            $.alert({
                title: 'Error',
                type: 'red',
                content: "Error during saving!",
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

  function print_certificate(id){
    $.ajax({
        url: 'print_certificate',
          method: 'POST',
          data: {id: id},
          dataType: 'html',
        success: function(result) {
          var mywindow = window.open('', 'Medical Certificate', 'height=800,width=1020,scrollbars=yes');
          mywindow.document.write('<html><head>');
          mywindow.document.write('<title>Medical Certificate</title>');
          mywindow.document.write('</head><body>');
          mywindow.document.write(result);
          mywindow.document.write('</body></html>');
          mywindow.document.close();
          setTimeout(function(){
              mywindow.focus();
              mywindow.print();    
          },350);
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
          });
      }
    })
  }

});