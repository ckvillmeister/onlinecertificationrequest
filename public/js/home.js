$(document).ready(function(){

	var pickupdate_limit = 0;

	$('#btn_login').click(function(e){
		var username = $('#text_username').val(),
			password = $('#text_password').val(),
			error = false;

		if (username == ''){
			$('#authentication-message').html("<span id='message'>Please enter username!</span>");
			$('#authentication-message').addClass("text-danger");
			error = true;
		}
		else if(password == ''){
			$('#authentication-message').html("<span id='message'>Please enter password!</span>");
			$('#authentication-message').addClass("text-danger");
			error = true;
		}
		else{
			$('#authentication-message').html("");
		}
		
		if (error == false){
			login(username, password);
		}
	});

	$('#text_username').keypress(function(event){
     	var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == 13){
			var username = $('#text_username').val(),
				password = $('#text_password').val();
			login(username, password);
		}
    });

	$('#text_password').keypress(function(event){
     	var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == 13){
			var username = $('#text_username').val(),
				password = $('#text_password').val();
			login(username, password);
		}
    });

    $('#cbo_muncity').on('change', function(){
    	var selected = $('#cbo_muncity').find('option:selected');
    	var data = selected.data('id'); 
    	retireve_barangays(data);
    });

    $('#cbo_schools').on('change', function(){
    	var selected = $('#cbo_schools').find('option:selected');
    	var data = selected.data('id'); 
    	retrieve_courses(data);
    });

    $('#btn_submitrequest').click(function(e){
		var firstname = $('#text_firstname').val(),
			middlename = $('#text_middlename').val(),
			lastname = $('#text_lastname').val(),
			extension = $('#cbo_extension').val(),
			prov = $('#text_prov').val(),
			muncity = $('#cbo_muncity').val(),
			brgy = $('#cbo_barangay').val(),
			purok = $('#cbo_purok').val(),
			sex = $('#cbo_sex').val(),
			dob = $('#text_dob').val(),
			contact = $('#text_contactno').val(),
			pickupdate = $('#text_pickupdate').val(),
			school = $('#cbo_schools').val(),
			school_course = $('#cbo_courses').val(),
			error = false,
			course_text = '';

		//$('#cbo_courses option:selected').text();
		if (school_course != ''){
			course_text = $('#cbo_courses option:selected').text();
		}

		var pdate = new Date(pickupdate).valueOf();
		var datetoday = new Date().valueOf();

		if ($( window ).width() < 992) {
			if (firstname == '' | lastname == ''){
				$.alert({
					    title: 'Empty',
					    type: 'red',
					    content: 'Please provide your fullname!',
					});
				error = true;
			}
			else if (muncity == '' | brgy == '' | purok == ''){
				$.alert({
					    title: 'Empty',
					    type: 'red',
					    content: 'Please provide your address!',
					});
				error = true;
			}
			else if(contact == ''){
				$.alert({
					    title: 'Empty',
					    type: 'red',
					    content: 'Please provide your contact number!',
					});
				error = true;
			}
			else if(pickupdate_limit == 1){
				$.alert({
				    title: 'Error',
				    type: 'red',
				    content: 'Pick-up date has reached its limit. Please select another pick-up date!',
				});
				error = true;
			}

			if (pickupdate == ''){
				$.alert({
					    title: 'Empty',
					    type: 'red',
					    content: 'Please select pick-up date!',
					});
				error = true;
			}
			else{
				if (pdate <= datetoday){
					$.alert({
					    title: 'Empty',
					    type: 'red',
					    content: 'Cannot select expired or current date as pick-up date!',
					});
					error = true;
				}
				else{
					$('.error-message-pickupdate').html("<span id='message'></span>");
					$('.error-message-pickupdate').addClass("text-success");
				}
			}


		}
		else{
			if (firstname == ''){
				$('.error-message-firstname').html("<span id='message'>Please enter your first name!</span>");
				$('.error-message-firstname').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-firstname').html("<span id='message'></span>");
				$('.error-message-firstname').addClass("text-success");
			}

			if(lastname == ''){
				$('.error-message-lastname').html("<span id='message'>Please enter your last name!</span>");
				$('.error-message-lastname').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-lastname').html("<span id='message'></span>");
				$('.error-message-lastname').addClass("text-success");
			}

			if(muncity == ''){
				$('.error-message-addrmuncity').html("<span id='message'>Please select a municipality!</span>");
				$('.error-message-addrmuncity').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-addrmuncity').html("<span id='message'></span>");
				$('.error-message-addrmuncity').addClass("text-success");
			}

			if(brgy == ''){
				$('.error-message-addrbrgy').html("<span id='message'>Please select a barangay!</span>");
				$('.error-message-addrbrgy').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-addrbrgy').html("<span id='message'></span>");
				$('.error-message-addrbrgy').addClass("text-success");
			}

			if(purok == ''){
				$('.error-message-addrpurok').html("<span id='message'>Please select a purok!</span>");
				$('.error-message-addrpurok').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-addrpurok').html("<span id='message'></span>");
				$('.error-message-addrpurok').addClass("text-success");
			}

			if(contact == ''){
				$('.error-message-contactno').html("<span id='message'>Please enter your contact number!</span>");
				$('.error-message-contactno').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-contactno').html("<span id='message'></span>");
				$('.error-message-contactno').addClass("text-success");
			}

			if (pickupdate == ''){
				$('.error-message-pickupdate').html("<span id='message'>Please select pick-up date.</span>");
				$('.error-message-pickupdate').addClass("text-danger");
				error = true;
			}
			else{
				if (pdate <= datetoday){
					$('.error-message-pickupdate').html("<span id='message'>Cannot select expired or current date as pick-up date.</span>");
					$('.error-message-pickupdate').addClass("text-danger");
					error = true;
				}
				else{
					$('.error-message-pickupdate').html("<span id='message'></span>");
					$('.error-message-pickupdate').addClass("text-success");
				}
			}

			if (pickupdate_limit == 1){
				$('.error-message-pickupdate').html("<span id='message'>Pick-up date has reached its limit. Please select another pick-up date!</span>");
				$('.error-message-pickupdate').addClass("text-danger");
				error = true;
			}
			else{
				$('.error-message-pickupdate').html("");
				$('.error-message-pickupdate').addClass("text-success");
			}
	        		
		}

		if (error == false){

			var symptoms = [], ctr = 0;
		    $('#symptoms_checklist input[type="checkbox"]').each(function(){
		      if ($(this).is(':checked')){
		        symptoms[ctr] = [$(this).val(), $(this).attr("data-desc")];
		        ctr++;
		      }
		    });

		    var address = purok + ', ' + brgy + ', ' + muncity + ', ' + prov; 
		    var sym = '', sym_val = [], ctr = 0;

			$.each(symptoms , function(i, val) { 
				$.each(val , function(index, value) { 
					if (index == 1){	
						sym += value + ", ";
					}
					else{
						sym_val[ctr] = value;
						ctr++;
					}
				});	
			}); 

			if (sym == ''){
				sym = '<div class="form-row m-2">' +
							'<div class="col-sm-4"><strong>None</strong></div>' +
						'</div>';
			}
			else{
				sym = sym.substring(0, sym.length - 2);
			}

			//submit_request(firstname, middlename, lastname, extension, address, sex, dob, contact, pickupdate, symptoms);
			$('#modal_confirm_content').html('<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Fullname: </div>' +
					 	'<div class="col-sm-9"><strong>'+ firstname + ' ' + middlename + ' ' + lastname + ' ' + extension + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Address: </div>' +
					 	'<div class="col-sm-9"><strong>'+ address + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Sex: </div>' +
					 	'<div class="col-sm-9"><strong>'+ sex + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Date of Birth: </div>' +
					 	'<div class="col-sm-9"><strong>'+ dob + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Contact Number: </div>' +
					 	'<div class="col-sm-9"><strong>'+ contact + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">School: </div>' +
					 	'<div class="col-sm-9"><strong>'+ school + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Course: </div>' +
					 	'<div class="col-sm-9"><strong>'+ course_text + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Pick-up Date: </div>' +
					 	'<div class="col-sm-9"><strong>'+ pickupdate + '</strong></div>' +
					 '</div><br>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-3">Symptoms: </div>'+
					 '</div>' +
					 '<div class="form-row m-2">' +
						'<div class="col-sm-12"><strong>' + sym + '</strong></div>' +
					 '</div>' +
					 '<hr>' +
					 '<div class="form-row m-2">' +
						'<div class="col-sm-12">' +
							'<p style="text-align: justify; text-justify: inter-word;">' + 
							'In accordance with the "Data Privacy Act of 2012", ' + $('#biz_name').html() + ' will protect your information by not sharing it with anyone and will use it for its purpose (Medical Certification).' + 
						'</div>' +
					 '</div>');
			
			$('#confirm').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
		}
	});

	// $('#frmCertRequest').on('submit', function(e){
 //    	e.preventDefault();
	$('#btn_confirm').click(function(e){
		var firstname = $('#text_firstname').val(),
			middlename = $('#text_middlename').val(),
			lastname = $('#text_lastname').val(),
			extension = $('#cbo_extension').val(),
			prov = $('#text_prov').val(),
			muncity = $('#cbo_muncity').val(),
			brgy = $('#cbo_barangay').val(),
			purok = $('#cbo_purok').val(),
			sex = $('#cbo_sex').val(),
			dob = $('#text_dob').val(),
			contact = $('#text_contactno').val(),
			pickupdate = $('#text_pickupdate').val(),
			school = $('#cbo_schools').val(),
			school_course = $('#cbo_courses').val(),
			symptoms = [], 
			ctr = 0,
			address = purok + ', ' + brgy + ', ' + muncity + ', ' + prov; 

		    $('#symptoms_checklist input[type="checkbox"]').each(function(){
		      if ($(this).is(':checked')){
		        symptoms[ctr] = [$(this).val(), $(this).attr("data-desc")];
		        ctr++;
		      }
		    });
		submit_request(firstname, middlename, lastname, extension, address, sex, dob, contact, pickupdate, school_course, symptoms);
	});

	$('#text_pickupdate').on('change', function(){
		var pickup_date = $(this).val();
		
		$.ajax({
		    url: 'transaction/check_pickupdate_limit',
	        method: 'POST',
	        data: {pickup_date: pickup_date},
	        success: function(result) {
	        	if (result == 1){
	        		if ($( window ).width() < 992) {
	        			$.alert({
						    title: 'Error',
						    type: 'red',
						    content: 'Pick-up date has reached its limit. Please select another pick-up date!',
						});
	        		}
	        		else{
	        			$('.error-message-pickupdate').html("<span id='message'>Pick-up date has reached its limit. Please select another pick-up date.</span>");
						$('.error-message-pickupdate').addClass("text-danger");
	        		}

	        		pickupdate_limit = 1;
	        	}
	        	else if(result == 0){
	        		$('.error-message-pickupdate').html("");
					$('.error-message-pickupdate').addClass("text-success");

					pickupdate_limit = 0;
	        	}
	        	else{
					pickupdate_limit = 0;
	        	}
		    }
		})
	});

	function login(username, password){
		$.ajax({
		    url: 'authentication/validate_login',
	        method: 'POST',
	        data: {username: username, password: password},
	        success: function(result) {
	        	if (result == 1){
	        		$.dialog({
					    icon: 'fas fa-spinner fa-spin',
					    title: 'Success!',
					    type: 'green',
					    content: '<img class="mr-3" src="public/bootstrap/medilab_temp/assets/img/check.gif" width="50" height="50">' + ' ' + 'Login successful!'
					});
                    //$('#authentication-message').html("<img class='mt-3' src='public/bootstrap/medilab_temp/assets/img/load.gif' width='50' height='50'>");
					setTimeout(function(){ window.location = 'transaction/certification';}, 3000);
	        	}
	        	else{
	        		$.alert({
					    title: 'Failed',
					    type: 'red',
					    content: 'Authentication failed!',
					});
	        	}
		    }
		})
	}

	function submit_request(firstname, middlename, lastname, extension, address, sex, dob, contact, pickupdate, school_course, symptoms){
		
        $.ajax({
		    url: 'transaction/process_request',
	        method: 'POST',
	        data: {firstname: firstname, 
	        		middlename: middlename,
		        	lastname: lastname,
		        	extension: extension,
		    		address: address,
		    		sex: sex,
		    		dob: dob,
					contact: contact,
					pickupdate: pickupdate,
					school_course: school_course,
					symptoms: symptoms
				},
			beforeSend: function() {
				$('#confirm').modal('hide');
				$('#basicloader').show();
			},
	        complete: function(){
	          	$('#basicloader').hide();
	        },
	        success: function(result) {
	        	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				var date = new Date(pickupdate);
				var new_date = months[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();

	        	if (result == 1){
	        		$.alert({
					    title: 'Success',
					    type: 'green',
					    content: 'Your request has been sent! <br>' +
					    		'Go to Sure Care Medical Clinic located ' +
					    		'Poblacion, Trinidad, Bohol on <strong>' + new_date + '</strong>' +
					    		' to pick up your medical certificate.',
					    buttons: {
					        ok: function(){
					        	location.reload();
					        }
					    }

					});
	        	}
	        	else if (result == 2){
	        		$.alert({
					    title: 'Error',
					    type: 'red',
					    content: 'Unable to proceed request. Request time limit is until 10:00 PM only'
					});
	        	}
	        	else{
                    $.alert({
					    title: 'Error',
					    type: 'red',
					    content: 'Error during submission!',
					});
	        		
	        	}
		    }
		});
	}

	function retireve_barangays(muncity_code){
		$.ajax({
		    url: 'home/retrieve_barangays',
	        method: 'POST',
	        data: {muncity_code: muncity_code},
	        dataType: 'JSON',
	        success: function(result) {
	        	$('#cbo_barangay').empty();
	        	$('#cbo_barangay').append('<option value=""> [ Barangay ] </option>');
	        	$.each(result, function(key, value) {
	        		$('#cbo_barangay').append('<option value="'+value['desc']+'">'+value['desc']+'</option>');
	        	});
		    }
		})
	}

	function retrieve_courses(school_id){
		$.ajax({
		    url: 'course/retrieve_courses',
	        method: 'POST',
	        data: {school_id: school_id},
	        dataType: 'JSON',
	        success: function(result) {
	        	$('#cbo_courses').empty();
	        	$('#cbo_courses').append('<option value=""> [ Course ] - <i>For Students</i> </option>');
	        	$.each(result, function(key, value) {
	        		$('#cbo_courses').append('<option value="'+value['id']+'">'+value['desc']+'</option>');
	        	});
		    }
		})
	}
});