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
            <h1><?php echo $page[0]->title;?></h1>
            <h3><?php echo $page[0]->subtitle;?></h3>
        </div>  
    </div>  
    <div class="row">
        <?php echo $page[0]->content;?>
    </div>
</div>