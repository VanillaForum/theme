<div class="header">
    <div class="navbar-toggle">
        Menu
    </div>
    <div class="logo">
        <a href="<?php echo base_url(); ?>"><img src="<?php  echo base_url() ; ?>assets/images/logo.png" class="img-responsive" /></a>
    </div>
    <div class="login-section">
        <?php if(isset($this->session->userdata['user_data']['id'])): ?>
                <a href="<?php echo base_url(); ?>home/logout" class="btn btn-link">Logout</a>
        <?php else : ?>
            <a href="javascript:void(0);"  data-toggle="modal" data-target="#login-modal"  class="btn btn-link">Log in</a>
        <?php endif; ?>
		<?php if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 2): ?>
            <a href="<?php echo base_url(); ?>user/personal_info" class="btn type-b">Profile</a>
		<?php elseif(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 1): ?>
            <a href="<?php echo base_url(); ?>client/personal_info" class="btn type-b">Profile</a>
        <?php else : ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#signup-modal" class="btn type-b">Sign Up</a>
        <?php endif; ?>
    </div>
</div>
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-control">
            <span class="close-menu">
                <a href="javascript:void(0);"><span class="glyphicon glyphicon-remove"></span></a>
            </span>
            <?php if(isset($this->session->userdata['user_data']['id'])): ?>
                <a href="<?php echo base_url(); ?>home/logout" class="btn btn-link">Logout</a>
            <?php else : ?>
                <a href="javascript:void(0);"  data-toggle="modal" data-target="#login-modal"  class="btn btn-link">Log in</a>
            <?php endif; ?>
        </div>
		<?php if(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 2): ?>
            <a href="<?php echo base_url(); ?>user/personal_info" class="btn type-b">Profile</a>
		<?php elseif(isset($this->session->userdata['user_data']['id']) && $this->session->userdata['user_data']['user_type'] == 1): ?>
            <a href="<?php echo base_url(); ?>client/personal_info" class="btn type-b">Profile</a>
        <?php else : ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#signup-modal" class="btn type-b">Sign Up</a>
        <?php endif; ?>
        <ul>
            <li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
            <li><a href="<?php echo base_url(); ?>blog">Blog</a></li>
            <li><a href="<?php echo base_url(); ?>faq-center">Support Center</a></li>
        </ul>
    </div>
</nav>