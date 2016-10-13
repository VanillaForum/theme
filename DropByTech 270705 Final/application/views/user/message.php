<style>
.circular1 {
	width: 41px;
	height: 41px;
	border-radius: 40px;
	-webkit-border-radius: 40px;
	-moz-border-radius: 40px;
	}
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
            <ul class="nav nav-tabs">
                <li class="active"><a href="#info-tab" data-toggle="tab">Messages</a></li>
            </ul>
        </div>
		<div class="row tab-content" >
			<div role="tabpanel" class="tab-pane active" id="info-tab">
				<?php $messages_array = array(); ?>
				<?php foreach ($messages as $message): ?>
					<?php if (!array_key_exists($message->projectId, $messages_array)):?>
					
						<div class="modal fade" id="message-<?php echo $message->projectId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog certificate">
								<div class="modal-content">
									<div class="modal-header">
										<span></span>
										<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">
										<img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">
										<h4 class="modal-title text-center">Messages</h4>	
									</div>
									<div class="modal-body">
										<form class="form-horizontal send-message" name="send-message" id="send-message-<?php echo $user->awardedid;?>" enctype="multipart/form-data" method="post" action="javascript:void(0)">
											<div class="message-container"></div>
											<input type="hidden" name = "c_user" value="<?php echo $user->id; ?>" />
											<input type="hidden" name = "project_id" value="<?php echo $message->projectId; ?>" />
											<div class="form-group">
												<div class="col-sm-12">
													<textarea class="form-control custom-control" rows="4" name="message" placeholder="Message"></textarea>
													<span class="error"></span>
												</div>   
											</div>
											<div class="form-group">
												<div class="col-sm-12 text-center">
													<input type="submit" class="btn type-c c_add" value="Send">
												</div>
											</div>
										</form>
									</div>
									<div class="list-group conversation">
										<?php $projectMessages = $this->project_model->get_messages_by_bider($message->projectId,$user->id,$message->userId)->result();
										if($projectMessages):?>
											<?php foreach($projectMessages as $submessage):?>
												<a class="list-group-item">
													<!--img src="images/profile50x50.png" class="chat-user-avatar" alt=""-->
													<span class="username"><?php if($submessage->userId == $user->id):?> You <?php endif;?><span class="time"><?php echo $submessage->message_date;?></span> </span>
													<p><?php echo $submessage->message;?></p>
												</a>
											<?php endforeach;?>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
					<?php $messages_array[$message->projectId] = true;
					endif;?>
						<div class="row project-details">
							<div class="col-xs-12 col-sm-12 col-md-12 project-client <?php if($message->status == 0) echo "message-unread";?>">
								<div class="row">
									<div class="col-xs-12 col-sm-2 col-md-2 text-center">
										<?php 
										$user_query = array(
											'select' => array('users.*'),
											'where' => array('users.id' => $message->userId),
											'row' => 1
										);
										$ownerProject = $this->user_model->get_rows($user_query, 'users');
										$myfile = DIRAVATAR .$ownerProject->avatar;	
									
										if (file_exists($myfile)):?>
										<img src="<?php echo URLAVATAR . $ownerProject->avatar;?>" alt="" height="81" width="81" class="circular2" />
										<?php else:?>
										<img src="<?php echo base_url();?>assets/images/person.png" alt="" height="81" width="81" class="circular2" />
										<?php endif;?>
									</div>
									<div class="col-xs-12 col-sm-7 col-md-8">
										<h4><?php echo $ownerProject->fname .' '.$ownerProject->lname . ' - ' . $message->title;?></h4>
										<span><?php $source = $message->message_date;
											$date = new DateTime($source);
											echo $date->format('F j, Y');?>
										</span>
										<a href="javascript:void(0)" data-toggle="modal" data-userid="<?php echo $message->userId;?>" data-id="<?php echo $message->projectId;?>" data-target="#message-<?php echo $message->projectId;?>" class="read-message">
											<p>
												<?php 
												if (strlen($message->message) > 40)
													echo substr($message->message, 0, 37) . '...'; 
												else
													echo $message->message;?>
											</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>