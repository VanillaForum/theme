$.user = {


    //validate personal info function


    validate_personal_info: function() {


        $('.upi_form').validate({


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


                var params = $('.upi_form').serialize();


                $('.different-loader').show();


                $.app.ajax('POST', $.app.urls('base_url') + 'user/save_persopnal_info', params, function(response) {


                    $('.different-loader').hide();


                    if (response.status == 'success') {


                        var html = '<p class="bg-success">' + 'Your Info Updated Successfully' + '</p>';


                        $('.personal-info').find('.message-container').html(html);


                    }


                    else if (response.status == 'failure') {


                        var html = '<p class="bg-danger">' + 'Your Info Not Updated Successfully' + '</p>';


                        $('#personalinfo').find('.message-container').append(html);





                    }


                });


            }


        });


    },


    //validate cetificate function


    validate_certificate : function(){


        $('.c-form').validate({


            ignore: [],


            rules: {


                'c_name': {required: true},


                'c_authority': {required: true},


                'c_licence_no': {required: true},


                'c_url': {required: true},


                'c_sdate': {required: true},


                'c_edate': {required: true},


//                'c_document' :{required : true}


                


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


                var params = $('.c-form').serialize();


                $('.different-loader').show();


                $.app.ajax('POST', $.app.urls('base_url') + 'user/save_certificate', params, function(response) {


                    $('.different-loader').hide();


                    if (response.status == 'success') {


                        var html = '<p class="bg-success">' + 'Your Info Updated Successfully' + '</p>';


                        $('.personal-info').find('.message-container').html(html);


                        $('#certificate-modal').find("input,textarea,select").val('').end().find("input[type=checkbox]").prop("checked", "").end().find("input[type=submit]").val('Add').end();


                        $('#certificate-modal').modal('hide');


                        var html = '<div class="col-xs-12 col-sm-4 col-md-4" id="certificate_'+response.cid+'"><a href="javascript:void(0)" rel="'+response.cid+'" class="delete-btn"><img src="'+$.app.urls('base_url')+'assets/images/closelabel.png"/></a><div class="certificate-block"> <img src="'+$.app.urls('base_url')+'assets/certificate/'+response.file_name+'" alt="" /></div></div>';


                        $('.certificate-section').find('.certificate-main').append(html); 


                    }


                    else if (response.status == 'failure') {


                        var html = '<p class="bg-danger">' + 'Your Info Not Updated Successfully' + '</p>';


                        $('#personalinfo').find('.message-container').append(html);





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


	//validate cetificate function


    validate_message : function(){


		$.each($('.send-message'),function(key,val){


			$('#'+val.id).validate({


				ignore: [],


				rules: {


					'message': {required: true}


					


				},


				errorPlacement: function(error, element) {


					element.parent('div').find('span.error').html(error);


				},


				submitHandler: function(form) {


					var params = $('#'+val.id).serialize();


					$('.different-loader').show();


					$.app.ajax('POST', $.app.urls('base_url') + 'project/save_message', params, function(response) {


						$('.different-loader').hide();


						if (response.status == 'success') {


							$('.list-group.conversation').prepend(response.data);


							 var html = '<p class="bg-success">' + 'Message sent' + '</p>';


							$('.send-message').find('.message-container').html(html);


						}


						else if (response.status == 'failure') {


							var html = '<p class="bg-danger">' + 'Your Info Not Updated Successfully' + '</p>';


							$('.send-message').find('.message-container').html(html);





						}


					});


				}


			});


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


                $.app.ajax('POST', $.app.urls('base_url') + 'user/save_preference_info', params, function(response) {


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


	validate_dispute: function() {


        $('.dispute_form').validate({


            ignore: [],


            rules: {


                'message': {required: true}


            },


            errorPlacement: function(error, element) {


                element.parent('div').find('span.error').html(error);


            },


            submitHandler: function(form) {


                var params = $('.dispute_form').serialize();


                $('.different-loader').show();


                $.app.ajax('POST', $.app.urls('base_url') + 'user/dispute', params, function(response) {


                    $('.different-loader').hide();


                    if (response.status == 'success') {


                        var html = '<p class="bg-success">Your message was sent shortly we will contact you</p>';


						$('.dispute_form').hide();


                        $('#dispute-modal').find('.message-container').html(html);


                    }


                    else if (response.status == 'failure') {


                        var html = '<p class="bg-danger">An error has occurred, please try again later</p>';


                        $('#dispute-modal').find('.message-container').append(html);





                    }


                });


            }


        });


    },


    //upload certificate function


    upload_certificate : function(classname){


        $('.'+classname).uploadifive({


            'auto'              : true,


            'multi'             : false,


            'queueID'           : 'uc_image_queue',


            'buttonText'        : '<a href="javscript:void(0);" class="btn cerificate-btn">Upload Document</a>',


            'uploadScript'      : $.app.urls('base_url')+'user/upload',


            'formData'          : {'ajax':'1'},


            'onError'           : function (event,ID,fileObj,errorObj) {


                  //console.log(fileObj);


        },


        'onUpload'     : function(filesToUpload) {


              $('.different-loader').show();


            },


        'onUploadComplete'  : function(file, data) {


                data = $.parseJSON(data);


                if(data.status == 'success') {


                  $('.file-upload-field').find('.original_file_name').val(data.original_file_name);


                  $('.file-upload-field').find('.upload_file_name').val(data.upload_file_name);


                  $('.file-upload-field').find('.file-name').html(data.original_file_name); 


                         


                       


                }


                else {


                   $('.file-upload-field').find('.error').html(data.message); 


                }


                $('.different-loader').hide();


            }


        });


    },


    //delete certificate function


    delete_certificate:function(id){


        var params = {'method' : 'delete-certificate','id' : id};


            $.app.ajax('POST', $.app.urls('base_url')+'user/ajax', params,function(response){


                if(response.status == 'success')


                {


                    $('.certificate-main').find('#certificate_'+id).remove();


                }


        });


        return false;


    },


//    add skill function 


    add_skill :function(){


            var params = $('.skill-form').serialize() +'&method=add_skill';


            $('.different-loader').show();


            $.app.ajax('POST', $.app.urls('base_url') + 'user/ajax', params, function(response) {


                $('.different-loader').hide();


                if (response.status == 'success') {


                    var html = '<p class="bg-success">' + 'Skill Added Successfully.' + '</p>';


                    $('.skill-section').html(response.html);


                    $('.skill-form').find('.skill').val('');


                    $('.bootstrap-tagsinput').find('.tag').remove();


                    $('.skill-form').find('.skill').tagsinput('destroy');


                     $('.skill-form').find('.skill').tagsinput('refresh');


                    $('#skill-modal').modal('hide');


                    $('.personal-info').find('.message-container').html(html);


                }


                else if (response.status == 'failure') {


                    var html = '<p class="bg-danger">' + 'Skill Not Added Successfully.' + '</p>';


                    $('#personalinfo').find('.message-container').append(html);





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


	disable_account:function(){


			var params = {'id' : 'true'};


            $.app.ajax('POST', $.app.urls('base_url')+'user/disable', params,function(response){


               if (response.status == 'success') {


                     var html = '<p class="bg-success">' + 'Your account has been disabled' + '</p>';


					$('#preference').find('.message-container').html(html);


                }else if (response.status == 'failure') {


                    var html = '<p class="bg-danger">' + 'Your account can not be disabled, please try again later' + '</p>';


					$('#preference').find('.message-container').append(html);





				}


        });


        return false;


    },


    // remove skill 


    remove_skill : function(id){


        var params ={'id' : id,'method':'remove_skill'}


        $('.different-loader').show();


        $.app.ajax('POST',$.app.urls('base_url')+'user/ajax',params,function(response){


            $('.different-loader').hide();


           if (response.status == 'success') {


                    $('.skill-section #skill_'+id).remove();


                    var html = '<p class="bg-success">' + 'Skill Removed Successfully' + '</p>';


                    $('.personal-info').find('.message-container').html(html);


                }


                else if (response.status == 'failure') {


                    var html = '<p class="bg-danger">' + 'Skill Not Removed Successfully' + '</p>';


                    $('#personalinfo').find('.message-container').append(html);


                    


                } 


        });


    }


}





//additional method for phone no


jQuery.validator.addMethod("phoneno", function(phone_number, element) {


    phone_number = phone_number.replace(/\s+/g, "");


    return this.optional(element) || phone_number.length == 10 &&


            phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);


}, "<br />Please Enter 10 digit valid phone number");





$(document).ready(function() {


    $.user.validate_personal_info(); // call validate personal info function


    $.user.validate_certificate(); // call  validate cetificate function


	$.user.validate_message();


	$.user.validate_creditcard();


	$.user.validate_dispute();


    $.user.upload_certificate('c_document');  //upload certificate  function


	$.user.validate_proyect_info();


	$.user.validate_preference();


    


    // delete certificate btn click


    $(document).on('click','.delete-btn',function(){


        var id = $(this).attr('rel');


        $('#delete-certificate-modal').find('.cid').val(id);


        $('#delete-certificate-modal').modal('show');


    });


    //confirm delete certificate btn event


    $(document).on('click','#confirm_c',function(){


        var id = $('#delete-certificate-modal').find('.cid').val();


        $.user.delete_certificate(id);


    });


    


     //add skill btn click


    $(document).on('click','.skill-form-btn',function(){


       $.user.add_skill();


    });


	


	$(document).on('click','#confirm-disable',function(){


        $.user.disable_account();


    });


    


    //remove skill


    $(document).on('click','.skill-section .remove_skill',function(){


      var id = $(this).attr('rel');


      $.user.remove_skill(id);


    });


	


	$(document).on('click','.projected',function(){


        var myProjectedId = $(this).data('id');


        $(".modal-body #projectid").val( myProjectedId );


		$('#apply-project-modal').modal('show');


	});


	


	$(document).on('click','.awarding',function(){


	    var myProjectedId = $(this).data('id');


		var userId = $(this).data('userid');


	    $(".modal-body #projectid").val( myProjectedId );


		$(".modal-body #userid").val( userId );


		$('#awarding-modal').modal('show');


	});
	$(document).on('click','.applyWithdrawal',function(){


	    var myProjectedId = $(this).data('id');


		var userId = $(this).data('userid');
		var myBudget = $(this).data('budget');


	    $(".modal-body #projectid").val( myProjectedId );

		$(".modal-body #budget").val( myBudget );
		$(".modal-body #userid").val( userId );


		$('#applyWithdrawal-modal').modal('show');


	});


	


	$(document).on('click','.read-message',function(){


	    var projectId = $(this).data('id');


		var userId = $(this).data('userid');


		var params = {'projectId' : projectId, 'userid':userId};


        $.app.ajax('POST', $.app.urls('base_url')+'messages/update_messages', params,function(response){});


	});


	


	$(document).on('change','#proyectName',function(){


		$('#proyect-upload').find('.file-upload').html($(this).val());


    });


	


	$(document).on('click','.finish-project',function(){


	    var myProjectedId = $(this).data('id');


	    $(".modal-body #finishid").val( myProjectedId );


		$('#finish-project-modal').modal('show');


	});


	


	$(document).on('click','.cancel-bid',function(){


	    var projectId = $(this).data('id');


	    $("#cancel-bid-modal #projectid").val( projectId );


		$('#cancel-bid-modal').modal('show');


	});





});