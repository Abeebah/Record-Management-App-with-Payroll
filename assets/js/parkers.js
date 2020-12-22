$('#myModal').on('shown.bs.modal', function () {
	$('#myInput').trigger('focus')
})


$(document).ready(function(){
	$.ajax({
        url: site_url+'/settings/loggedin',
        type: 'post',
        data: {},    
        success: function(response){
			res = JSON.parse(response);
			if(res.status == 'success'){
				window.location.href = site_url+"/login";
			}else{
				$.ajax({
					url: site_url+'/app/dashboard',
					type: 'post',
					data: {},
					beforeSend: function(){
						$('#content-div').html('loading...');
					},
					success: function(response){
						res = JSON.parse(response);
						$('#form-title').html(res.title);
						$('#content-div').html(res.content);
					}
				})
			}
        }
	})

	$('#dashboard').click(function(e){
		e.preventDefault();
		$.ajax({
			url: site_url+'/app/dashboard',
			type: 'post',
			data: {  },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);				
			}
		})
	})

	$('#content-div').on('click','#dashboard-item',function(e){
		e.preventDefault();
		var company_id = $(this).attr('company_id');
		$.ajax({
			url: site_url+'/records',
			type: 'post',
			data: { company_id: company_id },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);				
			}
		})
	})

	$('#signout').click(function(e){
		$.ajax({
			url: site_url+'/signout',
			type: 'post',
			data:{},
			beforeSend: function(e){
				$('#signout').html('signing out....');
			},
			success: function(e){
				$('#signout').html('Sign Out');
				window.location.href = site_url+"/login";
			}
		})
		// alert('signing out');
	})

	$('#change-password').click(function(e){
		var currentPassword = $('#current-password').val();
		var newPassword 	= $('#new-password').val();
		var confirmPassword = $('#confirm-password').val();

		var error = 0;
		var message = '';

		if(newPassword !== confirmPassword){
			message = 'Password does not match';
			error++;
		}

		if(newPassword.length < 8){
			message = 'Password must be at least 8 characters';
			error++;
		}
		
		if(confirmPassword == ''){
			message = 'Please confirm password';
			error++;
		}
		
		if(newPassword == ''){
			message = 'New password can not be blank';
			error++;
		}

		if(currentPassword == ''){
			message = 'Current password can not be blank';
			error++;
		}
		

		if(error <= 0){
			$.ajax({
				url: site_url+'/change-password',
				type: 'post',
				data:{ current_password: currentPassword, new_password: newPassword },
				beforeSend: function(e){
					$('#change-password').html('Processing....');
					$('#change-password').attr('disabled', true);
				},
				success: function(response){
					$('#change-password').html('Submit');
					$('#change-password').attr('disabled', false);
					var res = JSON.parse(response);
					if(res.status == 'success'){
						$('#pass-change-error-div').html(success_message(res.message));
					}else{
						window.location.href = site_url+"/login";
					}
				}
			})
		}else{
			$('#pass-change-error-div').html(error_message(message));
		}
		// alert('signing out');
	})

	$('#settings').click(function(e){
		e.preventDefault();
		$.ajax({
			url: site_url+'/settings',
			type: 'post',
			data: {},
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#form-title').html(res.title);
				$('#content-div').html(res.content);
			}
		})
	})

	$('#content-div').on('click','#settings_company', function(e){
		e.preventDefault();
		company_settings();		
	})
	
	$('#content-div').on('click','#settings_company_h', function(e){
		e.preventDefault();
		company_settings();
	})

	$('#content-div').on('click','#settings_category', function(e){
		e.preventDefault();
		category_settings();	
	})

	$('#content-div').on('click','#settings_category_h', function(e){
		e.preventDefault();
		category_settings();	
	})

	$('#content-div').on('click','#settings_users', function(e){
		e.preventDefault();		
		users_settings();
	})

	$('#content-div').on('click','#settings_users_h', function(e){
		e.preventDefault();		
		users_settings();
	})

	$('#content-div').on('click', '#edit-company', function(e){
		e.preventDefault();
		var company_id = $(this).attr('company_id');
		$('#error-div').html('');

		if(company_id !== '' && !isNaN(company_id)){
			$.ajax({
				url: site_url+'/settings/edit-company',
				type: 'post',
				data: {company_id: company_id},
				beforeSend: function(){
					$('#edit-company').html('loading...');
				},
				success: function(response){
					$('#edit-company').html('Edit');						
					if(response){
						res = JSON.parse(response);
						$('#company-id').val(res.id);
						$('#company-name').val(res.name);
						$('#company-text').val(res.description);
						$('#action-type').val('edit');
					}
				}
			})
		}
	})

	$('#content-div').on('click', '#add-company', function(e){
		e.preventDefault();
		
		$('#error-div').html('');
		$('#company-name').val('');
		$('#company-text').val('');
		$('#action-type').val('add');					
	})

	$('#company-process').click(function(e){
		e.preventDefault();
		var action_type 	= $('#action-type').val();
		var company_id 		= $('#company-id').val();
		var company_name 	= $('#company-name').val();
		var company_desc 	= $('#company-text').val();
		var file 			= _("company-logo").files[0];

		var message = '';
		var error = 0

		if(action_type == 'edit' && (company_id == '' || isNaN(company_id))){
			message = 'Something went wrong please try again. 1';
			error++;
		}

		if(company_desc == ''){
			message = 'Company description can not be empty.';
			error++;
		}

		if(company_name == ''){
			message = 'Company name can not be empty.'
			error++;
		}

		if(error <= 0){
			var formdata = new FormData();
			formdata.append("company_logo", file);
            formdata.append("action_type", action_type);
            formdata.append("company_id", company_id);
            formdata.append("company_desc", company_desc);
            formdata.append("company_name", company_name);            

			var ajax = new XMLHttpRequest();
			$('#company-process').html('processing...');
			$('#company-process').attr('disabled', true);

			ajax.addEventListener("load", function(e){
				$('#company-process').attr('disabled', false);
				$('#company-process').html('Submit');
				if(e){
					res = JSON.parse(e.target.responseText);
					if(res.status == "success"){
						$('#error-div').html(success_message(res.message));
						$('#settings_company_h').trigger("click");
					}else{
						$('#error-div').html(error_message(res.message));
					}
				}				
			}, false);            
            ajax.open("POST", site_url+"/settings/company-process"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
			ajax.send(formdata);

			// $.ajax({
			// 	url: site_url+'/settings/company-process',
			// 	type: 'post',
			// 	data: { action_type:action_type, company_id: company_id, company_desc: company_desc, company_name: company_name },
			// 	beforeSend: function(){
			// 		$('#company-process').html('processing...');
			// 		$('#company-process').attr('disabled', true);
			// 	},
			// 	success: function(response){
			// 		$('#company-process').attr('disabled', false);
			// 		$('#company-process').html('Submit');
			// 		if(response){
			// 			res = JSON.parse(response);
			// 			if(res.status == "success"){
			// 				$('#error-div').html(success_message(res.message));
			// 				$('#settings_company_h').trigger("click");
			// 			}else{
			// 				$('#error-div').html(error_message('Something went wrong please try again. '));
			// 			}
			// 		}
			// 	}
			// })			
		}else{
			$('#error-div').html(error_message(message));
		}
	})

	$('#content-div').on('click', '#delete-company', function(e){
		var company_id = $(this).attr('company_id');
		var action_type = $(this).attr('action_type');

		if(company_id !== '' && !isNaN(company_id)){
			if(confirm("Do you want to proceed with deleting company?")){
				$.ajax({
					url: site_url+'/settings/delete-company',
					type: 'post',
					data: {company_id: company_id, action_type: action_type},
					beforeSend: function(){
						$('#delete-company').html('loading...');
					},
					success: function(response){
						$('#delete-company').html('Delete');						
						if(response){
							res = JSON.parse(response);
							if(res.status == "success"){
								$('#settings_company_h').trigger("click");
								alert(res.message);
							}else{
								alert("Something went wrong. Please try again shortly.")
							}						
						}
					}
				})
			}
		}
	})
	
	$('#content-div').on('click', '#edit-category', function(e){
		e.preventDefault();
		var category_id = $(this).attr('category_id');
		$('#cat-error-div').html('');

		if(category_id !== '' && !isNaN(category_id)){
			$.ajax({
				url: site_url+'/settings/edit-category',
				type: 'post',
				data: {category_id: category_id},
				beforeSend: function(){
					$('#edit-category').html('loading...');
				},
				success: function(response){
					$('#edit-category').html('Edit');						
					if(response){
						res = JSON.parse(response);
						$('#category-id').val(res.id);
						$('#category-name').val(res.name);
						$('#category-class').val(res.class);
						$('#category-text').val(res.description);
						$('#cat-action-type').val('edit');
					}
				}
			})
		}
	})

	$('#content-div').on('click', '#add-category', function(e){
		e.preventDefault();
		
		$('#cat-error-div').html('');
		$('#category-name').val('');
		$('#category-text').val('');
		$('#cat-action-type').val('add');					
	})

	$('#category-process').click(function(e){
		e.preventDefault();
		var action_type 	= $('#cat-action-type').val();
		var category_id 	= $('#category-id').val();
		var category_name 	= $('#category-name').val();
		var category_class 	= $('#category-class').val();
		var category_desc 	= $('#category-text').val();

		var message = '';
		var error = 0

		if(action_type == 'edit' && (category_id == '' || isNaN(category_id))){
			message = 'Something went wrong please try again. 1';
			error++;
		}

		if(category_desc == ''){
			message = 'Category description can not be empty.';
			error++;
		}

		if(category_name == ''){
			message = 'Category name can not be empty.'
			error++;
		}

		if(category_class == '' || !category_class){
			message = 'Category class can not be empty.'
			error++;
		}

		if(error <= 0){
			$.ajax({
				url: site_url+'/settings/category-process',
				type: 'post',
				data: { action_type:action_type, category_id: category_id, category_desc: category_desc, category_name: category_name, category_class: category_class },
				beforeSend: function(){
					$('#category-process').html('processing...');
					$('#category-process').attr('disabled', true);
				},
				success: function(response){
					$('#category-process').attr('disabled', false);
					$('#category-process').html('Submit');
					if(response){
						res = JSON.parse(response);
						if(res.status == "success"){
							$('#cat-error-div').html(success_message(res.message));
							$('#settings_category_h').trigger("click");
						}else{
							$('#cat-error-div').html(error_message('Something went wrong please try again. '));
						}
					}
				}
			})			
		}else{
			$('#cat-error-div').html(error_message(message));
		}
	})

	$('#content-div').on('click', '#delete-category', function(e){
		var category_id = $(this).attr('category_id');
		var action_type = $(this).attr('action_type');

		if(category_id !== '' && !isNaN(category_id)){
			if(confirm("Do you want to proceed with deleting category?")){
				$.ajax({
					url: site_url+'/settings/delete-category',
					type: 'post',
					data: {category_id: category_id, action_type: action_type},
					beforeSend: function(){
						$('#delete-category').html('loading...');
					},
					success: function(response){
						$('#delete-category').html('Delete');						
						if(response){
							res = JSON.parse(response);
							if(res.status == "success"){
								$('#settings_category_h').trigger("click");
								alert(res.message);
							}else{
								alert("Something went wrong. Please try again shortly.")
							}						
						}
					}
				})
			}
		}
	})

	$('#content-div').on('click', '#users-process', function(e){
		e.preventDefault();
		var firstname 	= $('#firstname').val();
		var lastname 	= $('#lastname').val();
		var username	= $('#username').val();
		var position	= $('#position').val();
		var email 		= $('#email').val();
		var gender		= $('#gender option:selected').val();
		var address		= $('#address').val();
		var role		= $('#role option:selected').val();
		var company		= $('#company option:selected').val();
		var profile_pic	= $('#profile-pic').val();
		var salary		= $('#salary').val();
		var phone		= $('#phone').val();
		var file 		= _("profile-pic").files[0];
		
		var validateRes = validateUser(firstname, lastname, username, position, email, gender, address, role, company, profile_pic, salary, phone, file);

		if(validateRes.error <= 0){
			var formdata = new FormData();
			formdata.append("profile_pic", file);
            formdata.append("firstname", firstname);
            formdata.append("lastname", lastname);
            formdata.append("username", username);
            formdata.append("position", position);
			formdata.append("email", email);
			formdata.append("gender", gender);
            formdata.append("address", address);
            formdata.append("role", role);
            formdata.append("company", company);
            formdata.append("salary", salary);
            formdata.append("phone", phone);

			var ajax = new XMLHttpRequest();
			$('#users-process').html('processing...');
			$('#users-process').attr('disabled', true);

            // ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", function(e){
				$('#users-process').html('Submit');
				$('#users-process').attr('disabled', false);
				res = JSON.parse(e.target.responseText);
				if(res.status == 'success'){
					alert(res.message);
					$('#settings_users_h').trigger("click");
					$('#user-error-div').html(success_message(res.message));			
				}else{
					$('#user-error-div').html(error_message(res.message));			
				}
			}, false);
            // ajax.addEventListener("error", errorHandler, false);
            // ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", site_url+"/settings/users-process"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
			ajax.send(formdata);						
		}else{
			$('#user-error-div').html(error_message(validateRes.message));
		}
	})

	$('#content-div').on('click', '#user-edit', function(e){
		// e.preventDefault();
		var user_id = $(this).attr('user_id');
		$('#edit-user-error-div').html('');
		$('#edit-user-id').val('');
		$("#edit-profile-pic-label").html("Upload picture");

		$.ajax({
			url: site_url + '/settings/users-edit',
			type: 'post',
			data: { user_id: user_id},
			beforeSend: function(e){
				$('#user-edit').html('loading...');
			},
			success: function(response){
				$('#user-edit').html('Edit');
				res = JSON.parse(response);
				// console.log(res.data.first_name);
				if(res.status == "success"){
					$('#edit-company').html(res.companies);
					$('#edit-user-id').val(res.data.id);
					$('#edit-firstname').val(res.data.first_name);
					$('#edit-lastname').val(res.data.last_name);
					$('#edit-position').val(res.data.position);
					$('#edit-gender').val(res.data.gender);
					$('#edit-email').val(res.data.email);
					$('#edit-address').val(res.data.address);
					$('#edit-phone').val(res.data.phone);
					$('#edit-username').val(res.data.username);
					$('#edit-position').val(res.data.position);
					$('#edit-salary').val(res.data.salary);
					$('#edit-role').val(res.data.role);
					$('#edit-company').val(res.data.company_id);
					$('#edit-profile-pic-div').html('<img src = "'+base_url+'uploads/'+res.data.avatar+'" class = "img img-responsive">');
				}
				// $('#content-div').html();
			}
		})
	})

	$('#user-edit-process').click(function(e){
		e.preventDefault();

		var firstname 	= $('#edit-firstname').val();
		var user_id 	= $('#edit-user-id').val();
		var lastname 	= $('#edit-lastname').val();
		var username	= $('#edit-username').val();
		var position	= $('#edit-position').val();
		var email 		= $('#edit-email').val();
		var gender		= $('#edit-gender option:selected').val();
		var address		= $('#edit-address').val();
		var role		= $('#edit-role option:selected').val();
		var company		= $('#edit-company option:selected').val();
		var profile_pic	= $('#edit-profile-pic').val();
		var salary		= $('#edit-salary').val();
		var phone		= $('#edit-phone').val();
		var file 		= (_("edit-profile-pic").files[0]) ? _("edit-profile-pic").files[0] : '';
		
		var validateRes = validateUser(firstname, lastname, username, position, email, gender, address, role, company, profile_pic, salary, phone, file, true);

		if(validateRes.error <= 0){
			var formdata = new FormData();
			formdata.append("profile_pic", file);
            formdata.append("user_id", user_id);
            formdata.append("firstname", firstname);
            formdata.append("lastname", lastname);
            formdata.append("username", username);
            formdata.append("position", position);
			formdata.append("email", email);
			formdata.append("gender", gender);
            formdata.append("address", address);
            formdata.append("role", role);
            formdata.append("company", company);
            formdata.append("salary", salary);
            formdata.append("phone", phone);

			var ajax = new XMLHttpRequest();
			$('#users-edit-process').html('processing...');
			$('#users-edit-process').attr('disabled', true);

			ajax.addEventListener("load", function(e){
				$('#user-edit-process').html('Submit');
				$('#user-edit-process').attr('disabled', false);
				res = JSON.parse(e.target.responseText);
				if(res.status == 'success'){
					alert(res.message);
					$('#settings_users_h').trigger("click");
					$('#edit-user-error-div').html(success_message(res.message));			
				}else{
					$('#edit-user-error-div').html(error_message(res.message));			
				}
			}, false);
            // ajax.addEventListener("error", errorHandler, false);
            // ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", site_url+"/settings/edit-user-process"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
			ajax.send(formdata);	
		}else{
			$('#edit-user-error-div').html(error_message(validateRes.message));
		}
	})

	$('#content-div').on('click','#user-reset-pass', function(e){
		e.preventDefault();
		var action_type = $(this).attr('action_type');
		var user_id = $(this).attr('user_id');
		
		reset_suspend_user($(this), action_type, user_id);
	})

	$('#content-div').on('click','#user-suspend', function(e){
		e.preventDefault();
		var action_type = $(this).attr('action_type');
		var user_id = $(this).attr('user_id');
		
		reset_suspend_user($(this), action_type, user_id);
	})

	$('#payroll').click(function(e){
		e.preventDefault();
		$.ajax({
			url: site_url+'/payroll',
			type: 'post',
			data: {  },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);
				date_range();
			}
		})
	})

	$('#content-div').on('click', '#add-payroll', function(e){
		$.ajax({
			url: site_url+'/payroll/add-payroll-view',
			type: 'post',
			data: {},
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);
				date_range();
			}
		})
	})

	$('#content-div').on('change', '#staff-select', function(e){
		var staff_id = $('#staff-select').val();
		if(staff_id !== ''){
			$.ajax({
				url: site_url+'/payroll/staff-select',
				type: 'post',
				data: { staff_id: staff_id},
				success: function(response){
					res = JSON.parse(response);
					if(res.status == 'success'){
						$('#basic').val(res.salary);
						$('#tax').val(res.tax);
						$('#position').val(res.position);
					}
				}
			})
		}
	})

	$('#content-div').on('click', '#payroll-process', function(e){
		e.preventDefault();
		var basic 	= $('#basic').val();
		var tax		= $('#tax').val();
		var deduction = $('#deduction').val();
		var month	= $('#month').val();
		var note	= $('#note').val();
		var staff_id = $('#staff-select').val();

		var message = '';
		var error = 0;
		
		if(month == ''){
			message = 'Select payment month.';
			error++;
		}

		if(basic == ''){
			message = 'Select a staff.';
			error++;
		}

		if(isNaN(basic)){
			message = 'please enter a number';
			$('#basic').val('');
			error++;
		}

		if(isNaN(tax)){
			message = 'please enter a number';
			$('#tax').val('');
			error++;
		}

		if(deduction == ''){
			message = 'Deduction can not be blank.';
			error++;
		}

		if(isNaN(deduction)){
			message = 'please enter a number';
			$('#deduction').val('');
			error++;
		}
		
		if(error <= 0){
			$.ajax({
				url: site_url+'/payroll/payroll-process',
				type: 'post',
				data: { staff_id: staff_id, basic: basic, tax: tax, deduction: deduction, month: month, note: note },
				beforeSend: function(e){
					$('#payroll-process').val('processing...');
					$('#payroll-process').attr('disabled', true);
				},
				success: function(response){
					$('#payroll-process').val('Submit');
					$('#payroll-process').attr('disabled', false);
					var res = JSON.parse(response);

					if(res.status == "success"){
						$('#payroll-error-div').html(success_message(res.message));
						alert(res.message);
					}else{
						$('#payroll-error-div').html(error_message(res.message));
						alert(res.message);
					}
				}
			})
		}else{
			$('#payroll-error-div').html(error_message(message));
		}
	})

	$('#records').click(function(e){
		e.preventDefault();
		$.ajax({
			url: site_url+'/records',
			type: 'post',
			data: {  },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);
			}
		})
	})

	$('#content-div').on('click', '#add-records', function(e){
		$.ajax({
			url: site_url+'/records/add-records',
			type: 'post',
			data: {  },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);
			}
		})
	})

	$('#content-div').on('click', '#records-process', function(e){
		e.preventDefault();
		var company_id 	= $('#rec-company-id').val();
		var type_id 	= $('#rec-type-id').val();
		var amount 		= $('#rec-amount').val();
		var description = $('#rec-description').val();
		var category_id = $('#rec-category-id').val();

		var message = '';
		var error = 0;
		if(company_id == ''){
			message = 'Please select a company';
			error++;
		}

		if(category_id == ''){
			message = 'Please select a category';
			error++;
		}

		if(type_id == ''){
			message = 'Please select a type';
			error++;
		}

		if(amount == ''){
			message = 'Amount can not be empty';
			error++;
		}

		if(isNaN(amount)){
			message = 'please enter a number for amount';
			$('#amount').val('');
			error++;
		}

		if(description == ''){
			message = 'Description can not be empty';
			error++;
		}

		if(error <= 0){
			$.ajax({
				url: site_url+'/records/records-process',
				type: 'post',
				data: { company_id: company_id, type_id: type_id, category_id: category_id, amount: amount, description: description },
				beforeSend: function(){
					$('#records-process').val('loading...');
					$('#records-process').attr('disabled', true);
				},
				success: function(response){
					$('#records-process').val('Submit');
					$('#records-process').attr('disabled', false);
					res = JSON.parse(response);
					if(res.status == 'success'){						
						$('#record-error-div').html(success_message(res.message));
						alert(res.message);
					}else{
						$('#record-error-div').html(error_message(res.message));
					}
					// $('#content-div').html(res.content);
				}
			})
		}else{
			$('#record-error-div').html(error_message(message));
		}
	})

	$('#content-div').on('click', '#records_delete', function(e){
		e.preventDefault();

		b_type = $(this).attr('b_type');
		records_id = $(this).attr('record_id');

		$.ajax({
			url: site_url+'/records/records-delete',
			type: 'post',
			data: { b_type: b_type, records_id: records_id },
			beforeSend: function(){
				$('#records_delete').val('loading...');
				$('#records_delete').attr('disabled', true);
			},			
			success: function(response){
				// res = JSON.parse(response);
				alert(response);
				$('#records_delete').val('Delete');
				$('#records_delete').attr('disabled', false);
				
				$('#records').trigger("click");
			}
		})
	})

	$('#content-div').on('change', '#record-company-select', function(e){
		company_id = $('#record-company-select').val();
		$.ajax({
			url: site_url+'/records/company-select',
			type: 'post',
			data: { company_id: company_id },
			beforeSend: function(e){
				$('#records-table').html('Process....');
			},
			success: function(response){
				$('#records-table').html(response);
			}
		})
	})

	$('#reports').click(function(e){
		e.preventDefault();
		$.ajax({
			url: site_url+'/reports',
			type: 'post',
			data: {  },
			beforeSend: function(){
				$('#content-div').html('loading...');
			},
			success: function(response){
				res = JSON.parse(response);
				$('#content-div').html(res.content);
				
				var table = $('#example').DataTable( {
					lengthChange: false,
					buttons: [ 'copy', 'excel', 'pdf', 'colvis', 'print' ]
				});
			
				table.buttons().container()
				.appendTo( '#example_wrapper .col-sm-6:eq(0)' );
			}
		})
	})

})

function error_message(message) {
    return `<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error </strong> - ${message}
  </div>`;
}

function success_message(message) {
    return `<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success </strong> - ${message}
  </div>`;
}

function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function validateUser(firstname, lastname, username, position, email, gender, address, role, company, profile_pic, salary, phone, file, isEdit = false){
	var message = '';
	var error 	= 0;

	if(firstname == ''){
		message = "Firstname can not be blank";
		error++;
	}

	if(lastname == ''){
		message = "Lastname can not be blank";
		error++;
	}

	if(username == ''){
		message = "Username can not be blank";
		error++;
	}

	if(position == ''){
		message = "Position can not be blank";
		error++;
	}

	if(email == ''){
		message = "Email address can not be blank";
		error++;
	}

	if(!validateEmail(email)){
		message = "Invalid email address";
		error++
	}

	if(gender == ''){
		message = "Select a gender";
		error++;
	}

	if(address == ''){
		message = "Home address can not be blank";
		error++;
	}

	if(role == ''){
		message = "Select a user role";
		error++;
	}

	if(company == ''){
		message = "Select a company";
		error++;
	}

	if(phone == ''){
		message = "Phone number can not be blank";
		error++;
	}

	if(phone.length !== 11 || isNaN(phone)){
		message = "Invalid phone number";
		error++;
	}

	if(salary == ''){
		message = "Salary can not be blank";
		error++;
	}

	if(!isEdit){		
		if(profile_pic == ''){
			message = "Upload profile picture";
			error++;
		}
	}
	if(file){
		if(file.type !== 'image/png' && file.type !== 'image/jpeg'){
			message = "Invalid file type" + file.type;
			error++;
		}
	}

	return {"message": message, "error": error}
}

function _(el) {
    return document.getElementById(el);
}

function profile_pic_upload(){
	var file = _("profile-pic").files[0];
    if(file){
		var sizeKB = file.size / 1024;
		if (sizeKB < 1) {        
			var fileSize = file.size + ' bytes';
		}else{
			var fileSize = Math.floor(sizeKB) + ' KB';
		}
		$("#profile-pic-label").html(file.name + ' - ' + fileSize + ' - ' + file.type);
	}else{
		$("#profile-pic-label").html("Upload picture");
	}
    
}

function edit_profile_pic_upload(){
	var file = _("edit-profile-pic").files[0];
    if(file){
		var sizeKB = file.size / 1024;
		if (sizeKB < 1) {        
			var fileSize = file.size + ' bytes';
		}else{
			var fileSize = Math.floor(sizeKB) + ' KB';
		}
		$("#edit-profile-pic-label").html(file.name + ' - ' + fileSize + ' - ' + file.type);
	}else{
		$("#edit-profile-pic-label").html("Upload picture");
	}
    
}

function company_settings(){
	$.ajax({
		url: site_url+'/settings/company',
		type: 'post',
		data: {},
		beforeSend: function(){
			$('#content-div').html('loading...');
		},
		success: function(response){
			res = JSON.parse(response);
			$('#form-title').html(res.title);
			$('#content-div').html(res.content);
		}
	})
}

function company_logo_upload(){
	var file = _("company-logo").files[0];
    if(file){
		var sizeKB = file.size / 1024;
		if (sizeKB < 1) {        
			var fileSize = file.size + ' bytes';
		}else{
			var fileSize = Math.floor(sizeKB) + ' KB';
		}
		$("#company-logo-label").html(file.name + ' - ' + fileSize + ' - ' + file.type);
	}else{
		$("#company-logo-label").html("Upload picture");
	}
    
}

function category_settings(){
	$.ajax({
		url: site_url+'/settings/category',
		type: 'post',
		data: {},
		beforeSend: function(){
			$('#content-div').html('loading...');
		},
		success: function(response){
			res = JSON.parse(response);
			$('#form-title').html(res.title);
			$('#content-div').html(res.content);
		}
	})
}

function users_settings(){
	$.ajax({
		url: site_url+'/settings/users',
		type: 'post',
		data: {},
		beforeSend: function(){
			$('#content-div').html('loading...');
		},
		success: function(response){
			res = JSON.parse(response);
			$('#form-title').html(res.title);
			$('#content-div').html(res.content);
		}
	})
}

function reset_suspend_user(handler, action_type, user_id){
	$.ajax({
		url: site_url+'/settings/reset-suspend-user',
		type: 'post',
		data: { action_type: action_type, user_id: user_id },
		beforeSend: function(){
			handler.html('Processing...');
		},
		success: function(response){
			handler.html('Reset Password');			
			res = JSON.parse(response);
			if(res.status == 'success'){
				alert(res.message);
				$('#settings_users_h').trigger("click");
			}else{
				alert(res.message)
			}
		}
	})
}

function get_payroll(start, end){
	$.ajax({
		url: site_url+'/payroll/payroll-range',
		type: 'post',
		data: { start: start, end: end },
		beforeSend: function(){
			$('#payroll-table').html('loading...');
		},
		success: function(response){
			res = JSON.parse(response);
			$('#payroll-table').html(res.table);
		}
	})
}

function date_range(){
	$(function() {
		$('input[name="daterange"]').daterangepicker({
		  	opens: 'left'
		}, function(start, end, label) {
			console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			get_payroll(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
		});
	});
}