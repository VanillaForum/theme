$.home = {
    validate_signup: function(){
        $('.signup_form').validate({
            ignore: [],
            rules: {
                'fname' : { required: true },
                'lname' : { required: true },
                'email' : { required: true, email: true,remote: "email_check"}, // Allow only .edu emails
                'password' : { required: true, minlength: 6 },
                'user_type' :{required: true }
            },
            errorPlacement: function(error, element) {
                element.parents('div.form-group').find('span.error').html(error);
            },
            messages: {
                email: {
                    remote: jQuery.format("{0} is already in use!")
                },
            },
            submitHandler: function(form) {
                var params = $('.signup_form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'home/save', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        $('#signup-modal').modal('hide');
                        $('#signup-modal').find("input,textarea,select").val('').end().find("input[type=checkbox]").prop("checked", "").end().find("input[type=submit]").val('Signup').end();
                        $('#signup-success').modal('show');
                    }
                    else if (response.status == 'failure') {
                        $('.error-message').html(response.error).css('display', 'block');
                    }
                });
            }
        });
    },
    recover_password:function(){
        $('.recover-password').validate({
            ignore: [],
            rules: {
                'email': {
                    required: true,
                    email :true
                }
            },
            errorPlacement: function(error, element) {
                //error.insertAfter(element.parent('.controls'));
                element.parent('div').find('span.error').html(error);
            },
            messages: {
            },
            submitHandler: function(form) {
                var params = $('.recover-password').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'home/recover', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        $('#recover-password-modal').modal('hide');
                        $('#recover-password-success').modal('show');
                    }
                    else if (response.status == 'failure') {
                        
                        $('.error-message').html(response.error).css('display', 'block');

                    }
                });
            }
        });
    },
	resend_notification:function(){
        $('.resend-notification').validate({
            ignore: [],
            rules: {
                'email': {
                    required: true,
                    email :true
                }
            },
            errorPlacement: function(error, element) {
                element.parent('div').find('span.error').html(error);
            },
            submitHandler: function(form) {
                var params = $('.resend-notification').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'home/resend_notification', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        $('#resend-notification-modal').modal('hide');
                        $('#resend-notification-success').modal('show');
                    }
                    else if (response.status == 'failure') {
                        
                        $('.error-message').html(response.error).css('display', 'block');

                    }
                });
            }
        });
    },
    validate_recover:function(){
        $('.recover-form').validate({
            ignore: [],
            rules: {
                'password' : { required: true, minlength: 6 },
                'passwordConfirm' : { required: true, equalTo: '#password' }
            },
            errorPlacement: function(error, element) {
                //error.insertAfter(element.parent('.controls'));
                element.parent('div').find('span.error').html(error);
            },
            messages: {
            },
            submitHandler: function(form) {
                var params = $('.recover-form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'home/validate_recover', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        
                    }
                    else if (response.status == 'failure') {
                        
                        $('.error-message').html(response.error).css('display', 'block');

                    }
                });
            }
        });
    },
    validate_login :function(){
        $('.login-form').validate({
            ignore: [],
            rules: {
                'email': {
                    required: true,
                    email :true
                },
                'password': {
                    required: true
                }
            },
            errorPlacement: function(error, element) {
                //error.insertAfter(element.parent('.controls'));
                element.parent('div').find('span.error').html(error);
            },
            messages: {
            },
            submitHandler: function(form) {
                var params = $('.login-form').serialize();
                $('.different-loader').show();
                $.app.ajax('POST', $.app.urls('base_url') + 'home/login', params, function(response) {
                    $('.different-loader').hide();
                    if (response.status == 'success') {
                        if(response.user_type == '1'){
                            location.href = $.app.urls('base_url')+ 'project/find?owner=me';
                        }
						if(response.user_type == '2'){
							location.href = $.app.urls('base_url')+ 'user/personal_info';
						}
                        if(response.user_type == '3'){
                            location.href = $.app.urls('base_url')+ 'admin'; 
                        }
                        
                    }
                    else if (response.status == 'failure') {
                        
                        $('.error-message').html(response.error).css('display', 'block');

                    }
                });
            }
        });
    }
}
        
$(document).ready(function() {
    $.home.validate_signup();
    $.home.recover_password();
	$.home.resend_notification();
    $.home.validate_login();
    $.home.validate_recover();
    $(".img").mouseenter(function() {
        $(this).addClass("hover");
    })
    // handle the mouseleave functionality
    .mouseleave(function() {
        $(this).removeClass("hover");
    });
    
    $(document).on('click','.signup-success-btn',function(){
        $('#signup-success').modal('hide'); 
    });
});