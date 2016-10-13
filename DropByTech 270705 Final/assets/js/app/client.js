$.client = {
    validate_personal_info: function() {
        $('.cpi_form').validate({
            ignore: [],
            rules: {
                'fname': {required: true},
                'lname': {required: true},
                'email': {required: true, email: true}, // Allow only .edu emails
                'phone': {required: true, digits: true, phoneno: true},
                'businees_name': {required: true},
                'business_url': {required: true},
                'address': {required: true},
                'zipcode': {required: true, digits: true},
                'city': {required: true},
                'about_business': {required: true},
            },
            errorPlacement: function(error, element) {
                element.parent('div').find('span.error').html(error);
            },
            messages: {
                email: {
                    remote: jQuery.format("{0} is already in use!")
                },
            },
            submitHandler: function(form) {
                var params = $('.cpi_form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'client/save_persopnal_info', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        var html = '<p class="bg-success">' + 'Your Info Updated Successfully' + '</p>';
                        $('#personalinfo').find('.message-container').html(html);
                    }
                    else if (response.status == 'failure') {
                        var html = '<p class="bg-danger">' + 'Your Info Not Updated Successfully' + '</p>';
                        $('#personalinfo').find('.message-container').append(html);
                    }
                });
            }
        });
    },
	validate_proyect_info: function() {
        $('#proyect-upload').validate({
            ignore: [],
            rules: {
                'startdate':	{required: true},
                'deliverydate': {required: true},
                'budget': 		{required: true,digits: true,min: {param: 100}},
                'title': 		{required: true},
                'description':	{required: true},
            },
            errorPlacement: function(error, element) {
                element.parent('div').find('span.error').html(error);
            },
            submitHandler: function(form) {
                var params = $('#proyect-upload').serialize();
                $('.different-loader').show();
				$.ajax({
					url: $.app.urls('base_url') + 'project/postproject',
					type: 'POST',
					data: new FormData( $('#proyect-upload')[0] ),
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(response) {
						$('.different-loader').hide();
						if (response.status == 'success') {
							window.location.href = $.app.urls('base_url') + 'project/find?owner=me';
						}
						else if (response.status == 'failure') {
							var html = '<p class="bg-danger">' + response.error + '</p>';
							$('.message-container').append(html);
						}
					},
					 error: function (request, status, error) {
						console.log(request.responseText);
						console.log(error);
					}
				});
            }
        });
    },
    validate_preference: function() {
        $('#preference-form').validate({
            ignore: [],
            rules: {
                'password': {remote : 'check_password',required: true},
                'newpassword': {minlength: 6},
                'repeatpassword': {
                    equalTo: "#newpassword"
                }, 
                
            },
            errorPlacement: function(error, element) {
                element.parent('div').find('span.error').html(error);
            },
            messages: {
                'password' : {
                    remote : "Old password is not correct."
                }
            },
            submitHandler: function(form) {
                var params = $('#preference-form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'client/save_preference_info', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        var html = '<p class="bg-success">' + 'Your Preference Updated Successfully' + '</p>';
                        $('#preference').find('.message-container').html(html);
                    }
                    else if (response.status == 'failure') {
                        var html = '<p class="bg-danger">' + 'Your Preference Not Updated Successfully' + '</p>';
                        $('#preference').find('.message-container').append(html);

                    }
                });
            }
        });
    },
    validate_creditcard :function(){
       $('.credit-card-form').validate({
            ignore: [],
            rules: {
                'card_name': {required: true },
                'card_no': { required: true,digits:true},
                'security_code': { required: true,digits:true }, 
                
            },
            errorPlacement: function(error, element) {
                element.parent('div').find('span.error').html(error);
            },
            messages: {
                'password' : {
                    remote : "Old password is not correct"
                }
            },
            submitHandler: function(form) {
                var params = $('.credit-card-form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'client/save_credit_card', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        $('.credit-card-form').find("input,textarea,select").val('').end().find("input[type=checkbox]").prop("checked", "").end().find("input[type=submit]").val('Add').end();
                        $('#credit-card-modal').modal('hide');
                        var html = '<p class="bg-success">' + 'Your Preference Updated Successfully' + '</p>';
                        $('#preference').find('.message-container').html(html);
                        var creditcard_html = '<ul><li><img src="'+$.app.urls('base_url')+'assets/images/billing-info1.png" /></li><li>Visa  **** **** **** '+response.cc_no+'</li><li><a href="javascript:void(0);" rel="'+response.id+'" class="delete_cc_info">Delete</a></li><li><a href="javascript:void(0);" rel="'+response.id+'" class="default">Make Default</a></li></ul>';
                        $('#preference').find('.add-credit-card').before(creditcard_html);
                    }
                    else if (response.status == 'failure') {
                        var html = '<p class="bg-danger">' + 'Your Preference Not Updated Successfully' + '</p>';
                        $('#preference').find('.message-container').append(html);

                    }
                });
            }
        }); 
    },
    delete_cc_info:function(id){
        var params = {'method' : 'delete-cc','id' : id};
            $.app.ajax('POST', $.app.urls('base_url')+'client/ajax', params,function(response){
                if(response.status == 'success')
                {
                   $('#preference').find('.cc_info_'+id).remove();
                }
        });
        return false;
    },
	disable_account:function(){
			var params = {'id' : 'true'};
            $.app.ajax('POST', $.app.urls('base_url')+'client/disable', params,function(response){
               if (response.status == 'success') {
                     var html = '<p class="bg-success">' + 'Your account has been disabled' + '</p>';
					$('#preference').find('.message-container').html(html);
                }else if (response.status == 'failure') {
                    var html = '<p class="bg-danger">' + 'Your account can not be disabled, please try again later' + '</p>';
					$('#preference').find('.message-container').append(html);

				}
        });
        return false;
    }
}
//additional method for phone no
jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
}, "<br />Please Enter 10 digit valid phone number");


$(document).ready(function() {
     $.client.validate_creditcard();
     $.client.validate_personal_info();
     $.client.validate_preference();
	 $.client.validate_proyect_info();
     
    $(document).on('click','.delete_cc_info',function(){
        var id = $(this).attr('rel');
        $('#delete-cc-modal').find('.ccid').val(id);
        $('#delete-cc-modal').modal('show');
    });
	
	$(document).on('change','#proyectName',function(){
		$('#proyect-upload').find('.file-upload').html($(this).val());
    });
	
	$(document).on('click','.read-message',function(){
	    var projectId = $(this).data('id');
		var userId = $(this).data('userid');
		var params = {'projectId' : projectId, 'userid':userId};
        $.app.ajax('POST', $.app.urls('base_url')+'messages/update_messages', params,function(response){});
	});
	
    $(document).on('click','#confirm-cc',function(){
        var id = $('#delete-cc-modal').find('.ccid').val();
        $.client.delete_cc_info(id);
    });
	$(document).on('click','#confirm-disable',function(){
        $.client.disable_account();
    });
	
});