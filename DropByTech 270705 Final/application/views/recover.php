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
    	<h4 class="modal-title text-center">Reset Password</h4>	
    	<form class="form-horizontal recover-form" name="recover-form" action="javascript-void(0)" method="post">
        	<p class="error-message"></p>
            <div class="form-group">    
            	<div class="col-sm-12">
                	<input type="password" class="form-control col-sm-10" id="password" name="password" placeholder="Password"/>
                    <span class="error"></span>
                </div>
            </div>    
                   
            <div class="form-group">
            	<div class="col-sm-12">
                	<input type="password" class="form-control col-sm-10" name="passwordConfirm" placeholder="Confirm Password"/>
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-12 text-center">
            		<input type="hidden" value="<?php echo $hash;?>" name="hash" />
                	<input type="submit" class="btn type-c login-btn" name="save" value="Reset" />
                </div>
            </div>
    	</form>  
    </div>  
</div>