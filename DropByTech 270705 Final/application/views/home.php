<div class="top-message-container">
	<div class="message-container signup-message-container">
       <?php 
       if($this->session->flashdata('success')) { echo flash_message($this->session->flashdata('success'), 'success'); }  ?>
	</div>
</div>
<div class="slider">
    <div id="owl-demo" class="owl-carousel">
        <div class="item" style="background-image: url(<?php echo base_url(); ?>assets/images/banner-1.png);">
            <div>
                <span class="banner-text">Empowering You</span><br>
                <span class="banner-subtext">IT Support at your fingertips anywhere</span>
            </div>
        </div>
        <div class="item" style="background-image: url(<?php echo base_url(); ?>assets/images/banner-2.png);">
            <div>
                <span class="banner-text">Find Out Why</span><br>
                <span class="banner-subtext">More and More Businesses are using Drop By Tech</span>
            </div>
        </div>
    </div>
    <div class="slider-btn text-center">
		<?php if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 2): ?>
            <a href="<?php echo base_url(); ?>user/personal_info" class="btn type-a">Start a project</a>
		<?php elseif(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 1): ?>
            <a href="<?php echo base_url(); ?>client/personal_info" class="btn type-a">Start a project</a>
        <?php else : ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#signup-modal" class="btn type-a">Start a project</a>
        <?php endif; ?>
	</div>
</div>
<div class="container our-focus">
    <div class="row">
        <div class="col-lg-12">
            <h1>Our Focus</h1>
            <h3>We connect Businesses with IT Professional Contractors</h3>
        </div>  
    </div>  
    <div class="row home-blocks">
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="s-block">
                <div class="s-block-img">
                    <span>No Contracts</span>
                    <img src="<?php echo base_url(); ?>assets/images/focus-img1.png" />
                </div>
                <p>That’s right! No contracts or commitments. You can use our IT services any time you need them without paying the extra monthly fees.</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="s-block">
                <div class="s-block-img">
                    <span>Local Help</span>
                    <img src="<?php echo base_url(); ?>assets/images/focus-img2.png" />
                </div>
                <p>Don't frustrate yourself working with someone halfway across the world or in another time zone. Our contractors are real certified professionals in your local area that will come to you. You will meet your contractor face to face so that you know you are getting the service you need.</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="s-block">
                <div class="s-block-img">
                    <span>Low Cost</span>
                    <img src="<?php echo base_url(); ?>assets/images/focus-img3.png" />
                </div>
                <p>We know how expensive  IT service can get, especially when working with a regular IT firm. That's why we allow you to receive multiple quotes from our contractors and let you decide who is the best person for your job. You will experience our contractors willing to do the same type of work at a fraction of the cost.</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="s-block">
                <div class="s-block-img">
                    <span>Peace of Mind</span>
                    <img src="<?php echo base_url(); ?>assets/images/focus-img4.png" />
                </div>
                <p>We understand that you are a busy professional with a hectic work schedule. We take care of all your IT needs so that you don't waste time dealing with the headaches and hassle.</p>
            </div>
        </div>
    </div>
</div>
<div class="video-section">
    <div class="container">
        <div class="row coming-up-project">
            <div class="col-xs-12 col-sm-6 col-lg-6 project-text">
                <span>need it support? <br>big project coming up?</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-6 project-btn">
				<?php if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 2): ?>
					<a href="<?php echo base_url(); ?>user/personal_info" class="btn type-a">Big Project Coming Up?</a>
				<?php elseif(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 1): ?>
					<a href="<?php echo base_url(); ?>client/personal_info" class="btn type-a">Big Project Coming Up?</a>
				<?php else : ?>
					<a href="javascript:void(0)" data-toggle="modal" data-target="#signup-modal" class="btn type-a">Big Project Coming Up?</a>
				<?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/lvtfD_rJ2hE" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row">
            <p class="col-xs-12 text-center">Drop By  Tech connects Businesses with IT Contractors that are certified in a wide variety of area's and expertise</p>
        </div>
        <div class="row">
            <div class="col-lg-12 sponsors text-center">
                <div>
                    <img src="<?php echo base_url(); ?>assets/images/vmware.png" />
                </div>
                <div>
                    <img src="<?php echo base_url(); ?>assets/images/cisco.png" />
                </div>
                <div>
                    <img src="<?php echo base_url(); ?>assets/images/microsoft.png" />
                </div>
                <div>
                    <img src="<?php echo base_url(); ?>assets/images/comptia.png" />
                </div>
                <div>
                    <span>and many more...</span>
                </div>	
            </div>
        </div>
        <div class="row support">
            <div class="col-xs-12 col-sm-6 col-lg-6 project-text">
                <span>need it support? <br>big project coming up?</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-6 project-btn">
                <?php if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 2): ?>
		            <a href="<?php echo base_url(); ?>user/personal_info" class="btn type-a">Need IT Support?</a>
				<?php elseif(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 1): ?>
		            <a href="<?php echo base_url(); ?>client/personal_info" class="btn type-a">Need IT Support?</a>
		        <?php else : ?>
		            <a href="javascript:void(0)" data-toggle="modal" data-target="#signup-modal" class="btn type-a">Need IT Support?</a>
		        <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="container question-section">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 s-question img">
            <div id="effect-2" class="effects clearfix">
                <div class="img">
                    <img src="<?php echo base_url(); ?>assets/images/question-img1.png" alt="">
                    <div class="overlay">
                        <span>why use<br> drop by tech</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 s-question">
            <div id="effect-2" class="effects clearfix">
                <div class="img">
                    <img src="<?php echo base_url(); ?>assets/images/question-img2.png" class="img-responsive" />
                    <div class="overlay">
                        <span>who uses<br> drop by tech</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 s-question">
            <div id="effect-2" class="effects clearfix">
                <div class="img">
                    <img src="<?php echo base_url(); ?>assets/images/question-img3.png" class="img-responsive" />
                    <div class="overlay">
                        <span>customer<br> satisfaction</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="newsletter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center">Join Our NewsLetter</p>
            </div>
            <div class="col-lg-12">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="First Name/Last Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn type-c">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="review-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Reviews From Happy Clients</h1>
            </div>
        </div>
        <div class="row review-slider">
            <div class="col-lg-12">
                <div id="client-review" class="row owl-carousel">
                    <div class="item">
                        <div class="s-client clearfix">
                            <img src="<?php echo base_url(); ?>assets/images/client-1.png" alt="" />
                            <div class="client-detail">
                                <h4>John Doe</h4>
                                <img src="<?php echo base_url(); ?>assets/images/rating-star.png" alt="" />
                            </div>
                            <p>Maecenas tincidunt lectus eget enim congue, eget dapibus enim venenatis. Quisque finibus libero nisi, ac viverra ipsum tempor at. Vivamus in velit a risus vestibulum pretium id nec ipsum.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="s-client clearfix">
                            <img src="<?php echo base_url(); ?>assets/images/client-2.png" alt="" />
                            <div class="client-detail">
                                <h4>John Doe</h4>
                                <img src="<?php echo base_url(); ?>assets/images/rating-star.png" alt="" />
                            </div>
                            <p>Maecenas tincidunt lectus eget enim congue, eget dapibus enim venenatis. Quisque finibus libero nisi, ac viverra ipsum tempor at. Vivamus in velit a risus vestibulum pretium id nec ipsum.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="s-client clearfix">
                            <img src="<?php echo base_url(); ?>assets/images/client-3.png" alt="" />	
                            <div class="client-detail">
                                <h4>John Doe</h4>
                                <img src="<?php echo base_url(); ?>assets/images/rating-star.png" alt="" />
                            </div>
                            <p>Maecenas tincidunt lectus eget enim congue, eget dapibus enim venenatis. Quisque finibus libero nisi, ac viverra ipsum tempor at. Vivamus in velit a risus vestibulum pretium id nec ipsum.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="s-client clearfix">
                            <img src="<?php echo base_url(); ?>assets/images/client-2.png" alt="" />
                            <div class="client-detail">
                                <h4>John Doe</h4>
                                <img src="<?php echo base_url(); ?>assets/images/rating-star.png" alt="" />
                            </div>
                            <p>Maecenas tincidunt lectus eget enim congue, eget dapibus enim venenatis. Quisque finibus libero nisi, ac viverra ipsum tempor at. Vivamus in velit a risus vestibulum pretium id nec ipsum.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="s-client clearfix">
                            <img src="<?php echo base_url(); ?>assets/images/client-1.png" alt="" />
                            <div class="client-detail">
                                <h4>John Doe</h4>
                                <img src="<?php echo base_url(); ?>assets/images/rating-star.png" alt="" />
                            </div>
                            <p>Maecenas tincidunt lectus eget enim congue, eget dapibus enim venenatis. Quisque finibus libero nisi, ac viverra ipsum tempor at. Vivamus in velit a risus vestibulum pretium id nec ipsum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>