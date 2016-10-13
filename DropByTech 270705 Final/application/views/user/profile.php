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
        <div class="row tab-content personal-info">
        <!-- personal info section -->
            <div role="tabpanel" class="tab-pane active col-xs-12 col-md-12" id="personalinfo">
                <div class="message-container"></div>
                <div class="col-xs-12 col-md-2 personal-img">
                    <!--
					<img src="<?php  echo base_url() ; ?>assets/images/personal-info1.png" alt="" />
					-->
					<!-- user photo name is user id plus extension -->
					<?php
					$myfile = DIRAVATAR .$user->avatar;
					if (file_exists($myfile)) {
					    	echo '<img src="' .URLAVATAR . $user->avatar.'" height="100" width="100" alt="" />';
					} else {
					    	echo '<img src="' .base_url(). 'assets/images/person.png" height="100" width="100" alt="" />';
					}
					?>
                </div>
						<?php if(!empty($user->fname)): ?>
                            <div class="col-xs-12 col-md-10">
								<h6>Name: <?php echo $user->fname . ' ' . $user->lname;?></h6>
                            </div>
                        <?php endif;?>
						<?php if(!empty($user->email)): ?>	
                            <div class="col-xs-12 col-md-10">
								<h6>Email: <?php echo $user->email;?></h6>
                            </div>
                        <?php endif;?>
						
						<?php if(!empty($user->phone)): ?>
                            <div class="col-xs-12 col-md-10">
								<h6>Phone: <?php echo $user->phone;?></h6>
                            </div>
                        <?php endif;?>
						
						<?php if(!empty($user->businees_name)): ?>
                            <div class="col-xs-12 col-md-10">
								<h6>Business Name: <?php echo $user->businees_name;?></h6>
                            </div>
                        <?php endif;?>						

						<?php if(!empty($user->business_url)): ?>
                            <div class="col-xs-12 col-md-10">
								<h6>Business URL: <?php echo $user->business_url;?></h6>
                            </div>
                        <?php endif;?>

                        <!--div class="form-group">
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="address" name="address" value="<?php if(!empty($user->address)){ echo $user->address; } ?>" placeholder="Address"/>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" name="zipcode" id="zip-code" value="<?php if(!empty($user->zipcode)){ echo $user->zipcode; } ?>" placeholder="Zip Code" />
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php if(!empty($user->city)){ echo $user->city; } ?>"/>
                            </div>    
                        </div-->
						
						<?php if(!empty($user->about_business)): ?>
                            <div class="col-xs-12 col-md-10">
								<h6>Business URL:</h6>
								<p><?php echo $user->about_business;?></p>
                            </div>
                        <?php endif;?>
                        <div class="col-xs-12 col-md-10 skill-section">
                        <?php    
                            $skills = get_skill($this->session->userdata['user_data']['id']);
                            if(!empty($skills)){
                                foreach ($skills as $skill)
                                {
                        ?>
                            <span id="skill_<?php echo $skill->id; ?>"><?php echo $skill->skill;?>
                            </span>
                        <?php    
                                }
                            }
                        ?>
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
                                            <div class="certificate-block">
                                                <img src="<?php  echo base_url() ; ?>assets/certificate/<?php echo $cerificate->c_document; ?>" alt="" />
                                            </div>
                                           
                                    </div>
                        <?php 
                                endif;
                            endforeach;
                        ?>
                </div>
                </div>
          

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
				<div class="col-xs-12 col-sm-12">
                    <h5>Average rating</h5>
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
                    <?php
                    $k = 0;
                        foreach ($reviews as $review) {
                        $k = $k+1;
                        if ($k % 3 == 0) { echo '<div class="row">';}
                        echo '<div class="col-xs-12 col-sm-12 col-lg-4 rating">';
                        echo '    <div class="s-client clearfix">';
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
