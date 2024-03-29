$(document).ready(function(){

  var finding = 2;
  get_requests(2);

  $('body').on('click', '#btn_clear_date', function(){
    $(this).parent().parent().find('input[type=date]').val('');
  });

  //New Request
  $('#btn_new_requests').click(function(){
    get_requests(2);
    $('#control_buttons').html('<div class="row">' +
                                '<div class="col-lg-3">' +
                                    '<button class="btn btn-sm btn-secondary mr-1" style="width:110px" id="btn_approve_all">Approve All</button>' +
                                  '</div>' +
                                '</div>');
  });

  $('body').on('click', '#btn_approve_all', function(){
    $.confirm({
      title: 'Request Approval',
      content: 'Do you want to approve all requests?',
      type: 'blue',
      buttons: {
                yes: function () {
                  $.alert({
                    title: 'Approval Success',
                    content: 'All pending request has been approved!',
                    type: 'green',
                    buttons: {
                            ok: function(){
                              approve_all_request();
                              get_requests(2);  
                            }
                    }
                  })
                },
                no: function () {

                }
              }
    });
  });

  //Approved Request
  $('#btn_approved_requests').click(function(){
    //get_requests(3);
    $('#request_list').html('');
    $('#control_buttons').html('<div class="row">' +
                                  '<div class="col-lg-2"><strong>Filter By</strong></div>' +
                                '</div><br>' +
                                '<div class="row">' +
                                  '<div class="col-lg-2">Request Date:</div>' +
                                  '<div class="col-lg-3">' +
                                    '<input type="date" id="text_rdate" class="form-control form-control-sm mr-2 mb-2">' + 
                                  '</div>' +
                                  '<div class="col-lg-1">' +
                                    '<button class="btn btn-xs btn-danger rounded-circle" id="btn_clear_date"><i class="fas fa-times pr-1 pl-1"></i></button>' + 
                                  '</div>' +
                                '</div>' +
                                '<div class="row">' +
                                  '<div class="col-lg-2">Pick-up Date:</div>' +
                                  '<div class="col-lg-3">' +
                                    '<input type="date" id="text_pdate" class="form-control form-control-sm mr-2 mb-2">' + 
                                  '</div>' +
                                  '<div class="col-lg-1">' +
                                    '<button class="btn btn-xs btn-danger rounded-circle" id="btn_clear_date"><i class="fas fa-times pr-1 pl-1"></i></button>' + 
                                  '</div>' +
                                '</div>' +
                                '<div class="row">' +
                                  '<div class="col-lg-2">Print Status:</div>' +
                                  '<div class="col-lg-3">' +
                                    '<select id="cbo_printstat" class="form-control form-control-sm mr-2 mb-2">' +
                                      '<option value=""> [ Print Status ] </option>' +
                                      '<option value="1">Not Printed</option>' +
                                      '<option value="2">Printed</option>' +
                                    '</select>' +
                                  '</div>' +
                                '</div>' +
                                '<div class="row">' +
                                  '<div class="col-lg-2">Symptoms:</div>' +
                                  '<div class="col-lg-3">' +
                                    '<select id="cbo_symptomstat" class="form-control form-control-sm mr-2 mb-2">' +
                                      '<option value=""> [ Symptom Status ] </option>' +
                                      '<option value="1">Without Symptoms</option>' +
                                      '<option value="2">With Symptoms</option>' +
                                    '</select>' +
                                  '</div>' +
                                '</div>' +
                                '<div class="row">' +
                                  '<div class="col-lg-2">Courses:</div>' +
                                  '<div class="col-lg-3">' +
                                    '<select id="cbo_courses" class="form-control form-control-sm mr-2 mb-2">' +
                                      '<option value=""> [ Courses ] </option>' +
                                    '</select>' +
                                  '</div>' +
                                '</div><br>' +
                                '<div class="row">' +
                                  '<div class="col-lg-12">' +
                                    '<button class="btn btn-sm btn-secondary mr-1" style="width:100px" id="btn_filter">Generate</button>' +
                                    '<button class="btn btn-sm btn-secondary mr-1" style="width:100px" id="btn_print_all">Print All</button>' +
                                    '<button class="btn btn-sm btn-secondary mr-1" style="width:100px" id="btn_print_list">Print List</button>' +
                                  '</div>' +
                                '</div>');
    //'<button class="btn btn-sm btn-secondary mr-1" style="width:100px" id="btn_select_print">Print Custom</button>' +

    get_courses(1);
  });

  $('body').on('click', '#btn_filter', function(){
    var rdate = $('#text_rdate').val(),
        pdate = $('#text_pdate').val(),
        printstat = $('#cbo_printstat').val(), 
        symptomstat = $('#cbo_symptomstat').val(),
        course = $('#cbo_courses').val();

    if (rdate != '' | pdate != '' | printstat != '' | symptomstat != '' | course != ''){
      get_filtered_requests(rdate, pdate, printstat, symptomstat, course);
    }
    else{
      $.confirm({
      title: 'Confirm',
      content: 'Do you want to generate all requests?',
      type: 'blue',
      buttons: {
                yes: function () {
                    get_filtered_requests(rdate, pdate, printstat, symptomstat, course);
                },
                no: function () {

                }
              }
      });
    }
      
  });

  //Reject Request
  $('#btn_rejected_requests').click(function(){
    get_requests(0);
    $('#control_buttons').html('');
  });

  //Add Findings
  $('#btn_add_findings').click(function(){
    $('#findings').append('<div class="row mt-3">'+
            '<div class="col-lg-2 align-self-center">Finding #' + finding + ':</div>' +
            '<div class="col-lg-9"><input type="text" class="form-control form-control-sm" id="text_finding"></div>' +
            '<div class="col-lg-1"><button class="btn btn-sm btn-danger" id="btn_remove_finding"><i class="fas fa-times"></i></button></div>' +
            '</div>');
    finding++;
  });

  //Remove Findings
  $(document).on('click', '#btn_remove_finding', function(){
    $(this).closest('div').parent().remove();
    finding--;

    var fctr = 1;
    $('#findings .row .col-lg-2').each(function(){
      $(this).html('Finding #'+fctr+':');
      fctr++;
    });
  });

  //Approve Request
  $('body').on('click', '#btn_approve', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to approve this request?',
      type: 'blue',
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

  //Reject Request
  $('body').on('click', '#btn_reject', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to reject this request?',
      type: 'blue',
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

  //Reactivate Request
  $('body').on('click', '#btn_reactivate', function(){
    var id = $(this).val();

    $.confirm({
      title: 'Process Request',
      content: 'Do you want to re-activate this request?',
      type: 'blue',
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

  //View Request
  $('body').on('click', '#btn_view', function(){
    var id = $(this).val();
    $('#btn_save').val(id);
    $('#btn_print_this').val(id);
    get_request_info(id);
    get_request_findings(id);
    get_request_note(id);
    get_symptoms(id);
    $('#modal_view_info').modal({
                backdrop: 'static',
                keyboard: false
            })
  });

  //Print Request
  $('body').on('click', '#btn_print', function(){
    var id = $(this).val(),
        fullname = $(this).closest("tr").find('td:eq(1)').text();

    var ids = [];
    ids[0] = id;
    print_certificate(ids, fullname);
  });

  //Print Request
  $('#btn_print_this').click(function(){
    var id = $(this).val(),
        fullname = $(this).closest("tr").find('td:eq(1)').text();
    var ids = [];
    ids[0] = id;
    print_certificate(ids, fullname);
  });

  $('body').on('click', '#btn_print_all', function(){
    
    var request_ids = [], ctr = 0, symptomstat = $('#cbo_symptomstat').val();

    //if (! table.data().any()){
    if (table.rows().count() <= 0){
      $.alert({
            title: 'Empty!',
            type: 'red',
            content: 'No displayed list of request to be printed!',
        });
    }
    else{
      $('#table_new_request_list #btn_print').each(function(){
        request_ids[ctr] = $(this).val();
        ctr++;
      });
      
      print_mult_certificate(request_ids, symptomstat);
    }
    
  });

  $('body').on('click', '#btn_print_list', function(){
    
    var request_ids = [], ctr = 0;

    //if (! table.data().any()){
    if (table.rows().count() <= 0){
      $.alert({
            title: 'Empty!',
            type: 'red',
            content: 'No displayed list of request to be printed!',
        });
    }
    else{
      $('#table_new_request_list #btn_print').each(function(){
        request_ids[ctr] = $(this).val();
        ctr++;
      });
      
      print_list(request_ids);
    }
    
  });

  //Save Request Information
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

    /*if (error == 1){
      $.alert({
            title: 'Error!',
            type: 'red',
            content: 'Please provide findings in the empty field!',
        });
    }
    else{*/
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
    //}
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
              type: 'red',
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
              type: 'red',
          });
      }
    })
  }

  function approve_all_request(){
    $.ajax({
        url: 'approve_all_request',
          method: 'POST',
          dataType: 'html',
        success: function(result) {
          
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
              type: 'red',
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
              type: 'red',
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
                    '<div class="col-lg-1 align-self-center">Finding ' + finding + ':</div>' +
                    '<div class="col-lg-10"><input type="text" class="form-control form-control-sm" id="text_finding"value="'+value+'"></div>' +
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
              type: 'red',
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
              type: 'red',
          });
      }
    })
  }

  function get_symptoms(id){
    $.ajax({
        url: 'get_symptoms',
          method: 'POST',
          data: {id: id},
          dataType: 'JSON',
        success: function(result) {
          $.each(result, function(key, value) {
            if ($('#text_symptoms').val() == ''){
              $('#text_symptoms').val(value['symp_desc']);
            }
            else{
              $('#text_symptoms').val($('#text_symptoms').val() + ", " + value['symp_desc']);
            }
          });
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
              type: 'red',
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

  function print_certificate(id, fullname){
    $.ajax({
        url: 'print_certificate',
          method: 'POST',
          data: {ids: id},
          dataType: 'html',
        success: function(result) {
          var mywindow = window.open('', 'Medical Certificate - ' + fullname, 'height=800,width=1020,scrollbars=yes');
          mywindow.document.write('<html><head>');
          mywindow.document.write('<title>Medical Certificate - ' + fullname + '</title>');
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
              type: 'red',
          });
      }
    })
  }

  function print_mult_certificate(ids, sym_stat){
    $.ajax({
        url: 'print_certificate',
          method: 'POST',
          data: {ids: ids, sym_stat: sym_stat},
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
              type: 'red',
          });
      }
    })
  }

  function get_filtered_requests(rdate, pdate, printstat, symptomstat, course){
    $.ajax({
        url: 'get_filtered_requests',
          method: 'POST',
          data: {rdate: rdate, pdate: pdate, printstat: printstat, symptomstat: symptomstat, course: course},
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
              type: 'red',
          });
      }
    })
  }

  function get_courses(status){
    $.ajax({
        url: 'get_courses',
          method: 'POST',
          data: {status: status},
          dataType: 'JSON',
        success: function(result) {
          $.each(result, function(key, value) {
            $('body').find('#cbo_courses').append('<option value="'+value['id']+'">'+value['desc']+'</option');
          });
        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
              type: 'red',
          });
      }
    })
  }

  function print_list(ids){
    $.ajax({
        url: 'print_list',
          method: 'POST',
          data: {ids: ids},
          dataType: 'html',
        success: function(result) {
          var mywindow = window.open('', 'Master List', 'height=800,width=1020,scrollbars=yes');
          mywindow.document.write('<html><head>');
          mywindow.document.write('<title>Master List</title>');
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
              type: 'red',
          });
      }
    })
  }

});