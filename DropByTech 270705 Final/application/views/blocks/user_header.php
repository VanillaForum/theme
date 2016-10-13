<?php $message_count = $this->messages_model->get_user_messages_count($this->session->userdata['user_data']['id'])->result();?>
<style>
.circular1 {
	width: 32px;
	height: 32px;
	border-radius: 16px;
	-webkit-border-radius: 16px;
	-moz-border-radius: 16px;
	}
</style>

<div class="bg-img" style="background-image: url(<?php  echo base_url() ; ?>assets/images/banner-1.png); background-size:cover">
    <div class="project-header">
        <div class="project-logo">
            <a href="<?php echo base_url(); ?>"><img src="<?php  echo base_url() ; ?>assets/images/logo.png" class="img-responsive" /></a>
        </div>
        <div class="project-profile hidden-mobile">
            <ul class="nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
						<?php
						$myfile = DIRAVATAR .$user->avatar;	
						
						if (file_exists($myfile)) {
						    echo '<img src="' .URLAVATAR . $user->avatar.'" alt="" height="32" width="32" class="circular1" />';
						}else{
						    echo '<img src="' .base_url(). 'assets/images/person.png" alt="" height="32" width="32" class="circular1" />';
						}
						?>
						<span><?php echo $this->session->userdata['user_data']['fname'] .' '.$this->session->userdata['user_data']['lname']; ?></span>
                        <img src="<?php  echo base_url() ; ?>assets/images/client-project-arrow.png" alt="" />
                    </a>
                    <ul class="dropdown-menu" id="menu1">
						<li><a href="<?php echo base_url(); ?>user/personal_info"><img src="<?php  echo base_url() ; ?>assets/images/profile.png" />Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>home/logout"><img src="<?php  echo base_url() ; ?>assets/images/log-out.png" />Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
		<div class="project-profile hidden-mobile">
            <ul class="nav">
                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>user/messages" class="dropdown-toggle">
                        <img src="<?php  echo base_url() ; ?>assets/images/mail.png" alt="" />
						<?php if($message_count[0]->count > 0):?>
						<i id="messagenum"><?php echo $message_count[0]->count;?></i>
						<?php endif;?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="project-button">
            <a href="<?php echo base_url(); ?>project/find" class="btn type-a">Find Projects</a>
            <a href="<?php echo base_url(); ?>project/find?owner=me" class="btn type-b">My Projects</a>
        </div>
        <div class="project-profile visible-mobile">
            <ul class="nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <?php
						$myfile = DIRAVATAR .$user->avatar;	
						
						if (file_exists($myfile)) {
						    echo '<img src="' .URLAVATAR . $user->avatar.'" alt="" height="32" width="32" class="circular1" />';
						}else{
						    echo '<img src="' .base_url(). 'assets/images/person.png" alt="" height="32" width="32" class="circular1" />';
						}
						?>
                        <span><?php echo $this->session->userdata['user_data']['fname'] .' '.$this->session->userdata['user_data']['lname']; ?></span>
                        <img src="<?php  echo base_url() ; ?>assets/images/client-project-arrow.png" alt="" />
                    </a>
                    <ul class="dropdown-menu" id="menu1">
                        <li><a href="<?php echo base_url(); ?>user/personal_info"><img src="<?php  echo base_url() ; ?>assets/images/profile.png" />Profile</a></li>
                        <li><a href="<?php echo base_url(); ?>home/logout"><img src="<?php  echo base_url() ; ?>assets/images/log-out.png" />Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
		<div class="project-profile visible-mobile">
            <ul class="nav">
                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>user/messages" class="dropdown-toggle">
                        <img src="<?php  echo base_url() ; ?>assets/images/mail.png" alt="" />
						<?php if($message_count[0]->count > 0):?>
						<i id="messagenum"><?php echo $message_count[0]->count;?></i>
						<?php endif;?>
                    </a>
                </li>
            </ul>
        </div>
    </div>