$(document).ready(function(){

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
			error = false;

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

		if (error == false){

			var symptoms = [], ctr = 0;
		    $('#symptoms_checklist input[type="checkbox"]').each(function(){
		      if ($(this).is(':checked')){
		        symptoms[ctr] = [$(this).val(), $(this).attr("data-desc")];
		        ctr++;
		      }
		    });

		    var address = purok + ', ' + brgy + ', ' + muncity + ', ' + prov; 

			submit_request(firstname, middlename, lastname, extension, address, sex, dob, contact, pickupdate, symptoms);
		}
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
					setTimeout(function(){ window.location = 'dashboard';}, 3000);
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

	function submit_request(firstname, middlename, lastname, extension, address, sex, dob, contact, pickupdate, symptoms){
		
		var sym = '', sym_val = [], ctr = 0;

		$.each(symptoms , function(i, val) { 
			$.each(val , function(index, value) { 
				if (index == 1){	
					sym += '<div class="form-row m-2">' +
								'<div class="col-sm-12"><strong>' + '- ' + value + '</strong></div>' +
							'</div>';
				}
				else{
					sym_val[ctr] = value;
					ctr++;
				}
			});	
		}); 

		if (sym == ''){
			sym = '<div class="form-row m-2">' +
						'<div class="col-sm-12"><strong>None</strong></div>' +
					'</div>';
		}

		$.confirm({
			title: 'Confirm',
			type: 'blue',
			columnClass: 'col-lg-12',
			content: '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Fullname: </div>' +
					 	'<div class="col-sm-10"><strong>'+ firstname + ' ' + middlename + ' ' + lastname + ' ' + extension + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Address: </div>' +
					 	'<div class="col-sm-10"><strong>'+ address + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Sex: </div>' +
					 	'<div class="col-sm-10"><strong>'+ sex + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Date of Birth: </div>' +
					 	'<div class="col-sm-10"><strong>'+ dob + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Contact Number: </div>' +
					 	'<div class="col-sm-10"><strong>'+ dob + '</strong></div>' +
					 '</div>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Pick-up Date: </div>' +
					 	'<div class="col-sm-10"><strong>'+ pickupdate + '</strong></div>' +
					 '</div><br>' +
					 '<div class="form-row m-2">' +
					 	'<div class="col-sm-2">Symptoms: </div>'+
					 '</div>' + sym,
			buttons: {
		        confirm: function () {
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
								symptoms: sym_val},
				        success: function(result) {
				        	if (result == 1){
				        		$.alert({
								    title: 'Success',
								    type: 'green',
								    content: 'Your request has been sent!',
								    buttons: {
								        ok: function(){
								        	location.reload();
								        }
								    }

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
		    	},
			    cancel: function(){

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
	        	$.each(result, function(key, value) {
	        		$.each(this, function(key, value) {
	        			if (key == 'desc'){
	        				$('#cbo_barangay').append('<option value="'+value+'">'+value+'</option>');
	        			}
	        		});
	        	});
		    }
		})
	}
});