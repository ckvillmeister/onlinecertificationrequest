$(document).ready(function(){

  $('#text_font_color').colorpicker();
  $('#text_font_color').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

  $('#btn_submit').click(function(e){
     save_settings($('#text_system_name').val(), $('#text_site_title').val(), $('#text_biz_name').val(), $('#text_biz_add').val(), $('#text_clinic_sched').val(), $('#text_email').val(), $('#text_number').val(), $('#text_doctor').val(), $('#text_licenseno').val(), $('#text_ptr').val(), $('#text_font_color').val());
  });

  $('#btn_backup').click(function(e){
     $.ajax({
        url: 'settings/back_up_database',
        method: 'POST',
        success: function(result) {
          if (result == 1){
            $.alert({
                title: 'Backed-up',
                type: 'green',
                content: "Your database has been backed-up!",
            });
          }
          else{
            $.alert({
                title: 'Error!',
                type: 'red',
                content: "Error database back-up!",
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
  });

  $('#btn_save_logo').click(function(e){
    e.preventDefault();

    var sys_logo = "System Logo";
    var file_data = $("#system_image")[0].files[0];   
    var form_data = new FormData();            
    form_data.append('file', file_data);

     $.ajax({
        url: 'settings/save_system_image?set_name='+sys_logo,
        method: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(result) {
          if (result == 1){
            $.alert({
                title: 'Backed-up',
                type: 'green',
                content: "Image has been saved!",
            });
          }
          else{
            $.alert({
                title: 'Error!',
                type: 'red',
                content: "Error during saving image!",
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
  });

  function save_settings(systemname, title, bizname, bizadd, sched, email, number, doctor, licenseno, ptr, fontcolor){
    $.ajax({
        url: 'settings/save_settings',
        data: { name: systemname,
                title: title,
                bizname: bizname,
                bizadd: bizadd,
                sched: sched,
                email: email,
                number: number,
                doctor: doctor,
                licenseno: licenseno,
                ptr: ptr,
                fontcolor: fontcolor
        },
        method: 'POST',
        success: function(result) {
          if (result == 1){
            $.alert({
                title: 'Saved',
                type: 'green',
                content: "Your new settings has been saved!",
            });
          }
          else{
            $.alert({
                title: 'Error!',
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
});
