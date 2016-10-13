<style>
.circular2 {
    width: 81px;
    height: 81px;
    border-radius: 40px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    }
</style>
<div class="tab-menu">
    <div class="container">
        <div class="row tab-info">
            <ul class="nav nav-tabs" role="tablist" id="myTab">
                <li class="active"><a href="#personalinfo" data-toggle="tab">Personal Info</a></li>
                <li><a href="#preference" data-toggle="tab">Preferences</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>
            </ul>
        </div>
        <div class="row tab-content personal-info">
        <!-- personal info section -->
                <div role="tabpanel" class="tab-pane active col-xs-12 col-md-12" id="personalinfo">
                <div class="message-container"></div>
                <div class="col-xs-12 col-md-2 personal-img">
                    <!--
					<img src="<?php  echo base_url() ; ?>assets/images/personal-info1.png" alt="" />
					-->
					<!-- user photo name is user id plus extension -->
					<a href="javascript:void(0)" data-toggle="modal" data-target="#photoupload-modal">
					<?php
					$myfile = DIRAVATAR .$user->avatar;
					if (file_exists($myfile)) {
					    	echo '<img src="' .URLAVATAR . $user->avatar.'" height="100" width="100" alt="" />';
					} else {
					    	echo '<img src="' .base_url(). 'assets/images/person.png" height="100" width="100" alt="" />';
					}
					?>
					<p style="color:black;">Click to upload a photo</p>
					</a>
                </div>
                <div class="col-xs-12 col-md-10">
                    <form class="form-horizontal upi_form" method="post" action="javascript:void(0)" name="upi-form" id="upi-form-user">
                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-2">
                                    <input type="text" name ="fname" value="<?php if(!empty($user->fname)){ echo $user->fname; } ?>" class="form-control" placeholder="First Name"/>
                                    <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <input type="text" name="lname" value="<?php if(!empty($user->lname)){ echo $user->lname; } ?>" class="form-control" placeholder="Last Name"/>
                                <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="email" value="<?php if(!empty($user->email)) { echo $user->email; } ?>" placeholder="Email" />
                                <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="phone" value="<?php if(!empty($user->phone)){ echo $user->phone ; } ?>" placeholder="Telephone"/>
                                <span class="error"></span>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="businees_name" value="<?php if(!empty($user->businees_name)){ echo $user->businees_name; } ?>" placeholder="Business Name"/>
                                <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="business_url" value="<?php if(!empty($user->business_url)){ echo $user->business_url; } ?>" id="" placeholder="Business URL" />
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="address" name="address" value="<?php if(!empty($user->address)){ echo $user->address; } ?>" placeholder="Address"/>
                                <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="zipcode" id="zip-code" value="<?php if(!empty($user->zipcode)){ echo $user->zipcode; } ?>" placeholder="Zip Code" />
                                <span class="error"></span>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php if(!empty($user->city)){ echo $user->city; } ?>"/>
                                <span class="error"></span>
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control custom-control" name="about_business" rows="5" placeholder="About our Business" value="<?php if(!empty($user->about_business)){ echo $user->about_business; } ?>"><?php if(!empty($user->about_business)){ echo $user->about_business; } ?></textarea>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="skill-section">
                        <?php    
                            $skills = get_skill($this->session->userdata['user_data']['id']);
                            if(!empty($skills)){
                                foreach ($skills as $skill)
                                {
                        ?>
                            <span id="skill_<?php echo $skill->id; ?>"><?php echo $skill->skill;?>
                                &nbsp;&nbsp;<a href="javascript:void(0)" rel="<?php echo $skill->id; ?>" class="remove_skill"> X</a>
                            </span>
                        <?php    
                                }
                            }
                        ?>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#skill-modal" ><span class="add-skill">+ Add Skill</span></a>
                       
                        <div class="form-group">
                            <div class="col-sm-12 save-btn">
								<input type="hidden" value="" name="googleCoords" id="googleCoords" />
                                <input id="send-upi-form-user" type="submit" name="upi_btn" class="btn type-c upi_btn" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
                        <hr>
            <div class="certificate-section">
                <div class="col-xs-12 col-sm-12">
                    <h5 class="text-center">MY Certifications</h5>
                </div>
                <div class="col-lg-12 certificate-main">
                    <?php 
                        $cerificates = get_certificate($user->id);
                            foreach ( $cerificates as $cerificate):
                                if(!empty($cerificate->c_document)):
                    ?>
                                    <div class="col-xs-12 col-sm-4 col-md-4" id="certificate_<?php echo $cerificate->id; ?>">
                                        <a href="javascript:void(0)" rel="<?php echo $cerificate->id; ?>" class="delete-btn"><img src="<?php echo base_url(); ?>assets/images/closelabel.png"/></a> 
                                        <div class="certificate-block ">
											<img src="<?php  echo base_url() ; ?>assets/certificate/<?php echo $cerificate->c_document; ?>" alt="" />
											<p class="text-left">Certification Name: <?php echo $cerificates[0]->c_name;?></p>
											<p class="text-left">Certification Authority: <?php echo $cerificates[0]->c_authority;?></p>
											<p class="text-left">Certification License Number: <?php echo $cerificates[0]->c_licence_no;?></p>
											<p class="text-left">Certification Url: <?php echo $cerificates[0]->c_url;?></p>
                                        </div>
                                    </div>
                        <?php 
                                endif;
                            endforeach;
                        ?>
                </div>
                
                <div class="col-sm-12 text-center file-upload-field">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#certificate-modal" ><span class="file-upload">+ Upload a Certification</span><input type="file"></a>
                </div>
                </div>
            </div>
                <!-- preference section -->
                <div role="tabpanel" class="tab-pane col-xs-12 col-md-12 preference-section" id ="preference">
                    
                    <div class="col-xs-12 col-md-12">
                         <div class="message-container">
                         </div>
                        <form class="form-horizontal user-preference-form" id="preference-form" method="post" action="javascript:void(0)">
                            <input type="hidden" name = "user_id" value="<?php echo $user->id; ?>" />
                            <div class="form-group">
                                <div class="col-xs-8 col-sm-4 col-md-3">
                                    <label>Receive Notifications</label>
                                </div>
                                <div class="col-xs-4 col-sm-8 col-md-9">
                                    <p>
                                        <input type="checkbox" name="receive_notification" <?php if($user->receive_notification == 1) { echo "checked = 'checked'"; } ?> id="receive_notification" value="1" />
                                        <label for="receive_notification" class="notification"></label>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <label>Change Password</label>
                                </div>  
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <input type="password" class="form-control" name="password" value="<?php if(!empty($user->password)) { echo $user->password; } ?>" placeholder="Current Password"/>
                                    <span class="error"></span>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" />
                                    <span class="error"></span>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                    <input type="password" class="form-control" name="repeatpassword" placeholder="Repeat Password"/>
                                    <span class="error"></span>
                                </div>    
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 text-left">
                                    <a href="javascript:void(0);" class="btn type-b">Disable My Account<img src="<?php  echo base_url() ; ?>assets/images/disable-account.png" alt="" /></a>
                                </div>
                                <div class="col-sm-6 save-btn">
                                    <input type="submit" class="btn type-c preference-btn" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-md-12 billing-info">
                        <h5 class="text-center billing-header">Withdrawal Info</h5>
                        <?php $cc_info = get_credit_card_info($user->id);
                              foreach ($cc_info as $cc_info):
                        ?>
                        <ul class="<?php echo 'cc_info_'.$cc_info->id; ?>">
                            <li><img src="<?php  echo base_url() ; ?>assets/images/billing-info1.png" alt="" /></li>
                            <li>Visa  **** **** **** <?php echo substr($cc_info->card_no, -4)?></li>
                            <li><a href="javascript:void(0);" rel="<?php echo  $cc_info->id; ?>" class="delete_cc_info">Delete</a></li>
                            <li><a href="javascript:void(0);" rel="<?php echo  $cc_info->id; ?>" >Make Default</a></li>
                        </ul>
                        <?php 
                            endforeach;
                        ?>
                        <div class="add-credit-card">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#credit-card-modal" >+ Add a Credit Card</a>
                        </div>
                    </div>
                </div>
                <!-- end of preference section -->

                <!-- review section -->
                <?php
                function myrating($number)
                {
                    if($number == 0)
						echo "<p>No ratings yet</p>";
					else
						echo '<img src="'.base_url(). 'assets/images/rating-star-' .$number. '.png" alt="" />';
                }
                
                ?>
                <div role="tabpanel" class="tab-pane col-xs-12 col-md-12" id ="review">
                    <h5>Your average rating</h5>
                    <div class="avg-rating">
                        <?php
                        $mirating = 0; $k=0;
                        foreach ($reviews as $review) {
                            $k = $k+1;
                            $mirating = $mirating + $review->rating; 
                        } 
                       $mirating = ($k == 0) ? 0 : $mirating / $k;
                        // $mirating holds average rating, now i take integer part and show
                        myrating($mirating);
                         ?>
                    </div>
                    <!-- <div class="row rating"> -->
                    <?php
                    $k = 0;
                        foreach ($reviews as $review) {
                        $k = $k+1;
                        if ($k % 3 == 0) { echo '<div class="row">';}
                        echo '<div class="col-xs-12 col-sm-12 col-lg-4 rating">';
                        echo '    <div class="s-client clearfix">';
                        //echo '        <img src="'. base_url() .'assets/images/'.$review->reviewerid.'.png" alt="" />';
                        $reviewer = $this->user_model->get_username($review->reviewerid)->result();
                        $myfile = 'assets/images/userphoto/' .$review->reviewerid;
                        if (file_exists($myfile .'.png')) {
                                echo '<img src="' .base_url() . $myfile. '.png' .'" height="100" width="100" alt="" class="circular2" />';
                        } else {
                        if (file_exists($myfile .'.jpg')) {
                                echo '<img src="' .base_url() . $myfile. '.jpg' .'" height="100" width="100" alt="" class="circular2" />';
                        } else {
                                echo '<img src="' .base_url(). 'assets/images/person.png" height="100" width="100" alt="" class="circular2" />';
                        }
                        }
                        echo '        <div class="client-detail">';
                        echo '            <h4>' .$reviewer[0]->fname. ' ' .$reviewer[0]->lname. '</h4>';
                        //echo '            <img src="'.base_url().'assets/images/rating-star.png" alt="" />';
                        myrating($review->rating);
                        echo '        </div>';
                        echo '<p><b>'.$review->reviewtitle.'</b></p>';
                        echo '<p>'.$review->reviewtext.'</p>';
                        echo '    </div>';
                        echo '</div>';
                        if ($k % 3 == 0) { echo '</div>';}
                    }
                    ?>
                </div>
                <!-- end of review section -->

        </div>
    </div>
</div>
</div>
