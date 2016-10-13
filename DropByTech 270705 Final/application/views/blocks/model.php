<div class="modal fade" id="certificate-modal" tabindex="-1" role="dialog" aria-labelledby="certificate-modal" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Upload a Certification</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal c-form" name="certificate-form" enctype="multipart/form-data" method="post" action="javascript:void(0)">

                   <input type="hidden" name = "c_user" value="<?php echo $user->id; ?>" />

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="c_name" placeholder="Certification name"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="c_authority" placeholder="Certification Authority"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="c_licence_no" placeholder="License Number"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="c_url" placeholder="Certification URL"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-xs-12 col-sm-12"><label>Validity</label></div>

                        <div class="col-xs-12 col-sm-6">

                            <input type="text" class="form-control validity" name="c_sdate" placeholder="Some Text Here..." id="start-date" />

                            <span class="error"></span>

                        </div>

                        

                        <div class="col-xs-12 col-sm-6">

                            <input type="text" class="form-control validity" name="c_edate" placeholder="Some Text Here..." id="end-date" />

                            <span class="error"></span>

                        </div>    

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <p>

                                <input type="checkbox" name="c_expire" value="1" id="c_expire" />

                                <label for="c_expire" class="expire-label">This certificate does not expire</label>

                            </p>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center file-upload-field">

                            <div id="uc_image_queue" class="hide"></div>

                            <input type="hidden" class="original_file_name" name="original_file_name" value="" />

                            <input type="hidden" class="upload_file_name" name="upload_file_name" value="" />

                            <input type="file" name="c_document" class="c_document">

                            <span class="file-format">(JPG, PDF, PNG)</span>

                            <span class="file-name"></span>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c c_add" value="add">

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="client-post-project-modal modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Post a project</h4>	

				</div>

				<div class="modal-body">

					<div class="message-container"></div>

					<form class="form-horizontal" id="proyect-upload" action="javascript:void(0)" method="POST" enctype="multipart/form-data" >

						<input type="hidden" value="<?php echo $user->id; ?>" name="clientid" />

						<div class="form-group">

							<div class="col-xs-12 col-sm-4">

								<label for="name">Start Date</label>

								<input type="text" class="form-control datepick" name="startdate" placeholder="pick date" />

								<span class="error"></span>

							</div>

							<div class="col-xs-12 col-sm-4">

								<label for="name">Deliver by</label>

								<input type="text" class="form-control datepick" name="deliverydate" placeholder="pick date" />

								<span class="error"></span>

							</div>

							<!--

							<div class="col-xs-12 col-sm-4">

								<label for="name">Zip Code</label>

								<input type="text" class="form-control zip-code" id="zip-code" name="zip" placeholder="Some Text Here..." data-toggle="tooltip" data-placement="bottom" title="The default radius is 25 miles" />

							</div>

							-->

							<div class="col-xs-12 col-sm-4">

								<label for="name">Budget</label>

								<input type="text" class="form-control" name="budget" placeholder="Min $100"/>

								<span class="error"></span>

							</div>    

						</div>

						<div class="form-group">

							<div class="col-sm-12">

								<input type="text" class="form-control col-sm-10" name="title" placeholder="Title"/>

								<span class="error"></span>

							</div>

						</div>

						<div class="form-group">

							<div class="col-sm-12">

								<textarea class="form-control custom-control" rows="4" name="description" placeholder="Description Be as descriptive as possible. Anything that doesn't appear in the description will not be worked on."></textarea>

								<span class="error"></span>

							</div>

						</div>

                    <!--div class="form-group">

                        <div class="col-sm-12">

                            <textarea class="form-control custom-control" rows="4" name="details" placeholder="Other details that will appear when contractor clicks on 'more details' in the projects list."></textarea>

                        </div>

                    </div-->	

                    <div class="form-group">

							<div class="col-xs-12 col-sm-12">

								<label for="name">Place where job will be done:</label>

							</div>

  

  						    <div class="col-lg-12">

    							<div class="input-group">

      							  	<span class="input-group-addon">

        								<input type="radio" name="addressSet" value="defaultDir" aria-label="..." checked >

      							    </span>

      									<input type="text" class="form-control" value="My Registered Address (from profile)" readonly />

    						    </div><!-- /input-group -->  

  						    </div>

							<span>&nbsp;</br></span>

  						    <div class="col-lg-12">

    							<div class="input-group">

      							    <span class="input-group-addon">

        								<input type="radio" id="newDir" name="addressSet" value="newDir" aria-label="...">

      							    </span>

      							        <input type="text" id="newstreet" name="newstreet" class="form-control" value="" placeholder="Enter new street here" />

										<span><br></span>

										<span>

										<div class="col-sm-6">

										<input type="text" id="newcity" name="newcity" class="form-control" placeholder="City" />

										</div>

										<div class="col-sm-6">

										<input type="text" id="newzip" name="newzip" class="form-control" placeholder="Zip Code" />

										</div>

										</span>

										<input type="hidden" name="status" value="1">

    							</div><!-- /input-group -->  

  						    </div>

  															

						<div class="form-group">

							<div class="col-sm-12 text-center file-upload-field">

								<span class="file-upload">Upload a Document</span><input type="file" id="proyectName" name="proyectName">

								<span class="file-format">(PDF, Word, Excel, jpg, powerpoint)</span>

							</div>

						</div>

						<div class="form-group">

							<div class="col-sm-12 text-center">

                                <button type="submit" id="upload-proyect-action" class="btn type-c">Post</button>

							</div>

						</div>

					</form>

				</div>

			</div>

			</div>

		</div>

	</div>

<div class="modal fade" id="credit-card-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Add New CREDIT CARD</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal credit-card-form" method="post" action="javascript:void(0)" name="creditcard-form">

                    <input type="hidden" name = "user_id" value="<?php echo $user->id; ?>" />

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="card_name" placeholder="Cardholder's name"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="card_no" placeholder="Card Number"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="security_code" placeholder="Security Code"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-xs-12 col-sm-12">

                            <label>Expiration Date</label>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <select class="selectpicker" name="card_month">

                                <option value="1">January</option>

                                <option value='2'>February</option>

                                <option value='3'>March</option>

                                <option value='4'>April</option>

                                <option value='5'>May</option>

                                <option value='6'>June</option>

                                <option value='7'>July</option>

                                <option value='8'>August</option>

                                <option value='9'>September</option>

                                <option value='10'>October</option>

                                <option value='11'>November</option>

                                <option value='12'>December</option>        

                            </select>

                            <select class="selectpicker" name="card_year">

                                <option>2015</option>

                                <option>2016</option>

                                <option>2017</option>

                                <option>2018</option>

                                <option>2019</option>

                                <option>2020</option>

                            </select>

                        </div>	

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" name="ccbtn" class="btn type-c ccbtn" value="Add">

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url();?>assets/images/cancel-btn.png">

                <img class="bg-modal1" src="<?php echo base_url();?>assets/images/bg-modal1.png">

                <h4 class="modal-title text-center">post a project</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal">

                    <div class="form-group">

                        <div class="col-xs-12 col-sm-4">

                            <label for="name">Deliver by</label>

                            <input type="text" class="form-control deliver-by" placeholder="Some Text Here..." id="datepicker" />

                        </div>

                        <div class="col-xs-12 col-sm-4">

                            <label for="name">Zip Code</label>

                            <input type="text" class="form-control zip-code" id="zip-code" placeholder="Some Text Here..." data-toggle="tooltip" data-placement="bottom" title="The default radius is 25 miles" />

                        </div>

                        <div class="col-xs-12 col-sm-4">

                            <label for="name">Budget</label>

                            <input type="text" class="form-control" placeholder="Min $100"/>

                        </div>    

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="name" placeholder="Title"/>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <textarea class="form-control custom-control" rows="5" placeholder="Description Be as descriptive as possible. Anything that doesn't appear in the description will not be worked on."></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <textarea class="form-control custom-control" rows="5" placeholder="Other details that will appear when contractor clicks on 'more details'."></textarea>

                        </div>

                    </div>					

                    <div class="form-group">

                        <div class="col-sm-12 text-center file-upload-field">

                            <span class="file-upload">Upload a Document</span><input type="file">

                            <span class="file-format">(PDF, Word, Excel, jpg, powerpoint)</span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <button type="submit" class="btn type-c">Post</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="dispute-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Dispute</h4>	

            </div>

            <div class="modal-body">

				<div class="message-container"></div>

                <form class="form-horizontal dispute_form" name="dispute-form" action="javascript:void(0)" method="post">

                    <div class="form-group">

                        <div class="col-sm-12">

                            <textarea class="form-control col-sm-10" name="message" placeholder="Message"></textarea>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c signup-btn" name="save" value="Send" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Signup</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal signup_form" name="signup-form" action="javascript:void(0)" method="post">

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="fname" placeholder="First Name"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10" name="lname" placeholder="Last Name"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="email" class="form-control col-sm-10" name="email" placeholder="Email"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="password" class="form-control col-sm-10" name="password" placeholder="Password"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12">

                             <label class="radio-inline">

                                 <input type="radio" name="user_type" value="1" checked="cheked">Client

                            </label>

                            <label class="radio-inline">

                                 <input type="radio" name="user_type" value="2"> IT Contractor

                            </label>

                            <span class="error"></span>

                        </div>	

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c signup-btn" name="save" value="Signup" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Login</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal login-form" name="login-form" action="javascript:void(0)" method="post">

                    <p class="error-message"></p>

                    <div class="form-group">    

                        <div class="col-sm-12">

                            <input type="email" class="form-control col-sm-10" name="email" placeholder="Email"/>

                            <span class="error"></span>

                        </div>

                    </div>    

                   

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="password" class="form-control col-sm-10" name="password" placeholder="Password"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

						<div class="col-sm-6">

							<a id="forgot" href="javascript:void(0);"  data-dismiss="modal" data-toggle="modal" data-target="#recover-password-modal" style="color: #c0c0c0;">Did you forget your password?</a>

						</div>

						<div class="col-sm-6 text-right">

							<a id="resend-notification" href="javascript:void(0);"  data-dismiss="modal" data-toggle="modal" data-target="#resend-notification-modal" style="color: #c0c0c0;">Re-send notification</a>

						</div>

					</div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c login-btn" name="save" value="Login" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="recover-password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Recover Password</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal recover-password" name="recover-password" action="javascript:void(0)" method="post">

                    <p class="error-message"></p>

                    <div class="form-group">    

                        <div class="col-sm-12">

                            <input type="email" class="form-control col-sm-10" name="email" placeholder="Email"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c login-btn" name="save" value="Recover" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="resend-notification-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Re-send Notification</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal resend-notification" name="resend-notification" action="javascript:void(0)" method="post">

                    <p class="error-message"></p>

                    <div class="form-group">    

                        <div class="col-sm-12">

                            <input type="email" class="form-control col-sm-10" name="email" placeholder="Email"/>

                            <span class="error"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="submit" class="btn type-c login-btn" name="save" value="Send" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="signup-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-body">

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <h4>Your Account has been successfully created! Please Check your email to verify your account.</h4>

                <div class="text-center">

                    <a href="javascript:void(0)" class="text-center btn type-c signup-success-btn">Close</a>

                </div>   

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="recover-password-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-body">

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <h4>Please follow the instructions sent to your mail.</h4>

                <div class="text-center">

                    <a href="javascript:void(0)" data-dismiss="modal" class="text-center btn type-c signup-success-btn">Close</a>

                </div>   

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="resend-notification-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog certificate">

        <div class="modal-content">

            <div class="modal-body">

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <h4>Please check your mail.</h4>

                <div class="text-center">

                    <a href="javascript:void(0)" data-dismiss="modal" class="text-center btn type-c signup-success-btn">Close</a>

                </div>   

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="delete-cc-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

                <h4>Are you sure, you want to delete this Creditcard?</h4>

                <input type="hidden" name="cc_id" class="ccid" value="">

            </div>



            <div class="modal-footer">

                <div class="">

                    <button type="button" class="btn type-c" id="confirm-cc" data-dismiss="modal" aria-hidden="true">Yes</button>

                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="disable-account-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

                <h4>Are you sure you want to disable your account?</h4>

				<p>You can always enable it later down the line</p>

            </div>



            <div class="modal-footer">

                <div class="">

                    <button type="button" class="btn type-c" id="confirm-disable" data-dismiss="modal" aria-hidden="true">Yes</button>

                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="delete-certificate-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

                <h4>Are you sure, you want to delete this Certificate?</h4>

                <input type="hidden" name="cid" class="cid" value="">

            </div>



            <div class="modal-footer">

                <div class="">

                    <button type="button" class="btn type-c" id="confirm_c" data-dismiss="modal" aria-hidden="true">Yes</button>

                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="skill-modal">

    <div class="modal-dialog skii">

        <div class="modal-content">

            <div class="modal-header">

                <span></span>

                <img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

                <img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

                <h4 class="modal-title text-center">Add Skill</h4>	

            </div>

            <div class="modal-body">

                <form class="form-horizontal skill-form" name="skill-form" action="javascript:void(0)" method="post">

                    <input type="hidden" name = "user_id" value="<?php echo $user->id; ?>" />

                    <div class="form-group">    

                        <div class="col-sm-12">

                            <input type="text" class="form-control col-sm-10 skill"  name="skill" placeholder="Add Skill" data-role="tagsinput" />

                            <span class="error"></span>

                        </div>

                    </div>    

                    <div class="form-group">

                        <div class="col-sm-12 text-center">

                            <input type="button" class="btn type-c skill-form-btn" name="save" value="Add" />

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Give Feedback</h4>	

				</div>

				<div class="modal-body">

					<label>Please remember that you can't change reviews after you gave them. Be sure of what you write.</label>

                <form class="form-horizontal feedback-form" name="feedback-form" action="javascript:void(0)" method="post" >

                    <input type="hidden" name = "user_id" value="<?php echo $user->id; ?>" />

                    <div class="form-group">    

						<label>Title</label>

                        <div class="col-sm-12">

                            <input type="text" class="form-control"  name="title" />

                            <span class="error"></span>

                        </div>

                    </div>    

					<div class="form-group">

						<label>Please rate 1-5 stars:</label>

						<input id="input-2c" name="rating" class="rating" min="0" max="5" step="0.5" data-size="sm"

           data-symbol="&#xf005;" data-glyphicon="false" data-rating-class="rating-fa">

						<span class="error"></span>

					</div>

					<div class="form-group">

						<label>Review text</label>

						<div class="col-sm-12">

							<textarea class="form-control custom-control" rows="5" name="reviewtext" placeholder="Some text goes here..."></textarea>

							<span class="error"></span>

						</div>

					</div>

				</form>

				</div>

	            <div class="modal-footer">

	                <div class="">

	                    <button type="button" class="btn type-c" id="confirm_c" data-dismiss="modal" aria-hidden="true">Submit Feedback</button>

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

	                </div>

	            </div>

			</div>

		</div>

</div>



<div class="modal fade" id="photoupload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Upload Photo</h4>	

				</div>

				<?php if($this->session->userdata['user_data']['user_type'] == 1){

					echo form_open_multipart('client/photoupload');

				}elseif($this->session->userdata['user_data']['user_type'] == 2){

					echo form_open_multipart('user/photoupload');

				}?>

				<div class="modal-body">

					<label>Please remember that the photo you upload to your profile can be seen by everyone registered on the site. Upload a photo that shows you clearly, in .png or .jpg format.<br> Size is automatically adjusted to 100x100 pixels.</label>

                    <div class="form-group"> 

						<label>Please select file:</label>

                        <div class="col-sm-12">

                            <input type="file" name="myfile" size="20" />

                        </div>

                    </div>    					

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Upload" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>



<!-- MODALS FOR PROJECT STATUS CHANGE -->



<!-- CANCEL JOB: PROJECT STATUS IS -->

<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Cancel Project</h4>	

				</div>

				<form id="cancel">

				<div class="modal-body">

					<label>Are you sure you want to cancel this project?</label>		

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Confirm Cancellation" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>



<!-- MARK PROJECT COMPLETE - PROJECT STATUS IS 3 -->

<div class="modal fade" id="jobdone-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Mark Project As Complete</h4>	

				</div>

				<form id="completed" action="<?php echo base_url(); ?>project/done">

				<div class="modal-body">

					<input type="hidden" value="" name="projectid" id="projectid" />

					<label>Are you sure you want to mark this project as done?</label>		

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Confirm Completed" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div> 



<!-- MARK PROJECT AS ARCHIVED - PROJECT STATUS IS 4 -->



<div class="modal fade" id="archivedproject-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Mark Project As Archived</h4>	

				</div>

				<form id="archive">

				<div class="modal-body">

					<label>Are you sure you want to archive this project?</label>		

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Yes, Archive" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div> 



<!-- AWARD PROJECT - PROJECT STATUS IS WORKING, STATUS NR. 5 -->

<div class="modal fade" id="awarding-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Award Project</h4>	

				</div>

				<form id="award" action="<?php echo base_url() .'project/award'; ?>" method="POST"> <!-- when project is awarded we mark it using this link -->

				<div class="modal-body">

					<label>Are you sure you want to award this project?</label>		

					<input type="hidden" value="" name="projectid" id="projectid" />

					<input type="hidden" value="" name="userid" id="userid" />

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Confirm Award" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>
<!-- ADDED BY PADAM JAIN -->
<!-- AWARD PROJECT - PROJECT STATUS IS WORKING, STATUS NR. 5 -->

<div class="modal fade" id="applyWithdrawal-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Award Project</h4>	

				</div>

				<form id="award" action="<?php echo base_url() .'project/apply_withdrawal'; ?>" method="POST"> <!-- when project is awarded we mark it using this link -->

				<div class="modal-body">

					<label>Are you sure you want for Applying Withdrawal the amount of this project?</label>		

					<input type="hidden" value="" name="projectid" id="projectid" />
					<input type="hidden" value="" name="budget" id="budget" />
					<input type="hidden" value="" name="userid" id="userid" />

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Apply for Withdrawal" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>

<!-- END ADDED BY PADAM JAIN -->




<!-- finish project -->

<div class="modal fade" id="finish-project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Finish Project</h4>	

				</div>

				<form id="award" action="<?php echo base_url() .'project/finish'; ?>" method="POST"> <!-- when project is awarded we mark it using this link -->

				<div class="modal-body">

					<label>Are you sure you want to finish this project?</label>		

					<input type="hidden" value="" name="finishid" id="finishid" />

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Finish Project" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>



<!-- CANCEL BID -->

<div class="modal fade" id="cancel-bid-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">Cancel Bid</h4>	

				</div>

				<form id="award" action="<?php echo base_url() .'bid/cancel'; ?>" method="POST"> <!-- when project is awarded we mark it using this link -->

				<div class="modal-body">

					<label>Are you sure you want to cancel this bid?</label>		

					<input type="hidden" value="" name="projectid" id="projectid" />

				</div>

	            <div class="modal-footer">

	                <div class="">

						<input type="submit" value="Cancel Bid" name="submit" class="btn type-c" />

	                    <button type="button" class="btn type-c" data-dismiss="modal" aria-hidden="true">Cancel</button>

					</div>

	            </div>

				</form>

			</div>

		</div>

</div>



<!-- APPLY TO PROJECT -->

<div class="modal fade" id="apply-project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<span></span>

					<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php echo base_url(); ?>assets/images/cancel-btn.png">

                    <img class="bg-modal1" src="<?php echo base_url(); ?>assets/images/bg-modal1.png">

					<h4 class="modal-title text-center">APPLY TO PROJECT</h4>	

				</div>

				<div class="modal-body">

					<form class="form-horizontal" action="<?php echo base_url(); ?>project/apply/" method="POST">

						<input type="hidden" value="" name="projectid" id="projectid" />

						<input type="hidden" value="<?php echo $user->id; ?>" name="contractorid" />

						<div class="form-group">

							<div class="col-xs-12 col-sm-4">

								<label for="name">Deliver by</label>

								<input type="text" class="form-control datepick" name="deliverydate" placeholder="pick date" />

                            </div>

							<div class="col-xs-12 col-sm-4">

								<label for="name">Budget</label>

								<input type="text" class="form-control" name="budget" placeholder="Min $100"/>

							</div>    

						</div>

						<div class="form-group">

							<div class="col-sm-12">

								<textarea class="form-control custom-control" rows="4" name="coverletter" placeholder="Specify your experience and anything you think the client will need to know about you and how you do your work."></textarea>

							</div>

						</div>

						<div class="form-group">

							<div class="col-sm-12 text-center">

                                <button type="submit" class="btn type-c">Apply</button>

							</div>

						</div>

					</form>

				</div>

			</div>

			</div>

		</div>

	</div>