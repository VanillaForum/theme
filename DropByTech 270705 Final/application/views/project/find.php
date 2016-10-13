<?php 

function myrating($number)

{

	if($number == 0)

		echo "<h6>No ratings yet</h6>";

	else

		echo '<img src="'.base_url(). 'assets/images/rating-star-' .$number. '.png" alt="" />';

}

?>

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

                <li class="active"><a href="#info-tab" data-toggle="tab">Open Projects</a></li>

				<?php if($owner == 'me'):?>

                <li><a href="#address-tab" data-toggle="tab">ArchiveD</a></li>

				<?php endif;?>

            </ul>

        </div>

		<div class="row tab-content personal-info" >

			<div role="tabpanel" class="tab-pane active" id="info-tab">
            	<?php if($msg == 's') { echo '<br><p style="color:black"><b>Request Successfully Sent!</b></p>'; }		


				if ($user_type != 2 AND $owner != 'me') { echo '<br><p style="color:white"><b>You have to be a contractor to view this page!</b></p>'; }		

					foreach ($projects as $project): 

						$project_files = $this->project_model->get_files($project->id)->result();

						$bid_status	= $this->bid_model->get_bid_status($project->id,$user->id)->result();

						if($bid_status[0]->status == 3) continue;?>

						<div class="row project-details">

							<div class="col-xs-12 col-sm-12 col-md-12 project-client">

								<div class="row">

									<div class="col-xs-12 col-sm-2 col-md-2 text-center">

										<?php 

										$user_query = array(

											'select' => array('users.*'),

											'where' => array('users.id' => $project->clientid),

											'row' => 1

										);

										$ownerProject = $this->user_model->get_rows($user_query, 'users');

										$myfile = DIRAVATAR .$ownerProject->avatar;	

									

										if (file_exists($myfile)):?>

										<img src="<?php echo URLAVATAR . $ownerProject->avatar;?>" alt="" height="81" width="81" class="circular2" />

										<?php else:?>

										<img src="<?php echo base_url();?>assets/images/person.png" alt="" height="81" width="81" class="circular2" />

										<?php endif;?>

										<h6><?php echo $clientname[$project->id][0]->fname .' '.$clientname[$project->id][0]->lname?></h6>

									</div>

									<div class="col-xs-12 col-sm-7 col-md-8">

										<h4><?php echo $project->title;?></h4>

										<span>Deliver by - 

											<?php $source = $project->deliverydate;

											$date = new DateTime($source);

											echo $date->format('F j, Y');?>

										</span>

										<p><?php echo $project->description;?></p>

									</div>

									<div class="col-xs-12 col-sm-3 col-md-2 budget-project">

										<span>Budget: <b> $<?php echo $project->budget;?></b></span><br/>

										<span>Bids: <?php echo $bidsCount[$project->id];?></span><br/>

										<div class="text-center">

											<div id="#accordion">

												<p>

													<?php if ($project->status == 1) { echo "Open "; }

													if ($project->status == 3) { echo "Project Done / Closed"; }

													if($project->awardedid > 0) { echo "/ Working"; }?>

												</p>

												<a href="#detailstext<?php echo $project->id?>" class="btn btn-link" data-toggle="collapse" data-parent="#accordion">View Details</a>

												<?php if ($owner == 'me') { // TODO: change variables to check for status of project

													if ($project->status == 5) { echo '<a href="javascript:void(0)" class="btn btn-danger" data-toggle="modal" data-target="#cancel-modal" >Cancel Project</a>'; };	// cancellation is shown when project status is "working"

													if ($project->status == 3 AND $feedback == 1) { echo '<a href="javascript:void(0)" class="btn btn-danger" data-toggle="modal" data-target="#cancel-modal" >Archive Project</a>'; };	// archive project is shown when project status is "closed / done" and have been gi ven feedback- these projects can be seen in "archived" tab

												} 

												if ($owner != 'me') { // if projects list has been invoked as user and not client - not in 'my project' button, we are contractor:

													if ($project->awardedid == 0 && empty($bid_status)) {

														echo '<a href="#" data-id="'.$project->id.'" data-toggle="modal" class="projected btn type-c">Apply</a>';	// apply to project

													} else {

														$contractorname = $this->user_model->get_username($project->awardedid)->result();

														echo 'Already Awarded to:<br>'.$contractorname[0]->fname.' '.$contractorname[0]->lname;

													}

												}?>

											</div>

										</div>

									</div>

								</div>

							</div>

							<div class="collapse col-xs-12 col-sm-12 col-md-12 panel-body" id="detailstext<?php echo $project->id;?>" >

								<div class="col-xs-4 col-sm-4 col-md-4">

									<p class=""><?php echo $project->details;?></p>

									<?php if(!empty($project_files)):?>

									<h6>Files:</h6>

										<?php foreach($project_files as $file):?>

											<div class="col-md-4"><a href="<?php echo URLPROYECTFILES . $file->name;?>"><?php echo $file->name;?></a></div>

									<?php endforeach;

									endif;?>

								</div>

								<div class="col-xs-8 col-sm-8 col-md-8">

								<?php if($this->session->userdata['user_data']['user_type'] == 1):?>

									<?php $bids	= $this->bid_model->find_bids_for_project($project->id)->result();

									$contractorname = array();

									if ($project->awardedid > 0):

										$projectMessages = $this->project_model->get_messages_by_bider($project->id,$user->id,$project->clientid)->result();?>

									

										<div class="modal fade" id="message-<?php echo $project->awardedid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

												<div class="modal-dialog certificate">

													<div class="modal-content">

														<div class="modal-header">

															<span></span>

															<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

															<img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

															<h4 class="modal-title text-center">Messages</h4>	

														</div>

														<div class="modal-body">

															<form class="form-horizontal send-message" name="send-message" id="send-message-<?php echo $project->awardedid;?>" enctype="multipart/form-data" method="post" action="javascript:void(0)">

																<div class="message-container"></div>

																<input type="hidden" name = "c_user" value="<?php echo $user->id; ?>" />

																<input type="hidden" name = "project_id" value="<?php echo $project->id; ?>" />

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

															<?php if($projectMessages):?>

																<?php foreach($projectMessages as $message):?>

																	<a class="list-group-item">

																		<!--img src="images/profile50x50.png" class="chat-user-avatar" alt=""-->

																		<span class="username"><?php if($message->userId == $user->id):?> You <?php endif;?><span class="time"><?php echo $message->message_date;?></span> </span>

																		<p><?php echo $message->message;?></p>

																	</a>

																<?php endforeach;?>

															<?php endif;?>

														</div>

													</div>

												</div>

										</div>

									

										<?php $contractorname = $this->user_model->get_username($project->awardedid)->result();

										$awardedBid = $this->bid_model->get_awarded_bid($project->id,$project->awardedid)->result();

										$user_query = array(

											'select' => array('users.*'),

											'where' => array('users.id' => $project->awardedid),

											'row' => 1

										);

										$userData = $this->user_model->get_rows($user_query, 'users');

										?>

										<p>Already Awarded to:</p>

										<div class="col-xs-12 col-sm-12 col-md-12 project-client">

											<div class="row">

												<div class="col-xs-12 col-sm-2 col-md-2 text-center">

													<?php $myfile = DIRAVATAR .$userData->avatar;		

													if (file_exists($myfile)):?>

													<img src="<?php echo URLAVATAR . $userData->avatar;?>" alt="" height="41" width="41" class="circular1" />

													<?php else:?>

													<img src="<?php echo base_url();?>assets/images/person.png" alt="" height="41" width="41" class="circular1" />

													<?php endif;?>

													<h6><?php echo $contractorname[0]->fname .' '.$contractorname[0]->lname?></h6>

												</div>

												<div class="col-xs-12 col-sm-7 col-md-8">

													<span>I will Deliver by - 

														<?php $source = $awardedBid[0]->deliverydate;

														$date = new DateTime($source);

														echo $date->format('F j, Y'); ?>

													</span>

												</div>

												<div class="col-xs-12 col-sm-4 col-md-4 budget-project">

													<span>Budget: <b>$ <?php echo $awardedBid[0]->budget;?></b></span><br/>

													<br/>

												</div>

											</div>

										</div>

										<div class="col-sm-4 col-md-4">

											<a href="#" data-id="<?php echo $project->id;?>" class="finish-project btn btn-danger" data-toggle="modal">Finish</a>

										</div>

										<div class="col-sm-4 col-md-4">

											<a href="javascript:void(0)" data-toggle="modal" data-target="#message-<?php echo $project->awardedid;?>" class="btn btn-warning">Message</a>

										</div>

										<div class="col-sm-4 col-md-4">

											<a href="javascript:void(0)" class="btn btn-danger" data-toggle="modal" data-target="#dispute-modal" >Dispute</a>

										</div>

									<?php else:

										foreach ($bids as $bid): if($bid->status == 3) continue;

											$contractorname[$bid->id] = $this->user_model->get_username($bid->contractorid)->result();

											$projectMessages = $this->project_model->get_messages_by_bider($bid->projectid,$bid->contractorid,$project->clientid)->result();

											$user_query = array(

												'select' => array('users.*'),

												'where' => array('users.id' => $bid->contractorid),

												'row' => 1

											);

											$userData = $this->user_model->get_rows($user_query, 'users');?>

											

											<div class="modal fade" id="message-<?php echo $bid->contractorid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

												<div class="modal-dialog certificate">

													<div class="modal-content">

														<div class="modal-header">

															<span></span>

															<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

															<img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

															<h4 class="modal-title text-center">Messages</h4>	

														</div>

														<div class="modal-body">

															<form class="form-horizontal send-message" name="send-message" id="send-message-<?php echo $bid->contractorid;?>" enctype="multipart/form-data" method="post" action="javascript:void(0)">

																<div class="message-container"></div>

																<input type="hidden" name = "c_user" value="<?php echo $user->id; ?>" />

																<input type="hidden" name = "project_id" value="<?php echo $project->id; ?>" />

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

															<?php if($projectMessages):?>

																<?php foreach($projectMessages as $message):?>

																	<a class="list-group-item">

																		<!--img src="images/profile50x50.png" class="chat-user-avatar" alt=""-->

																		<span class="username"><?php if($message->userId == $user->id):?> You <?php endif;?><span class="time"><?php echo $message->message_date;?></span> </span>

																		<p><?php echo $message->message;?></p>

																	</a>

																<?php endforeach;?>

															<?php endif;?>

														</div>

													</div>

												</div>

											</div>

											

											<div class="col-xs-12 col-sm-12 col-md-12 project-client">

												<div class="row">

													<div class="col-xs-12 col-sm-2 col-md-2 text-center">

														<?php $myfile = DIRAVATAR .$userData->avatar;		

														if (file_exists($myfile)):?>

														<img src="<?php echo URLAVATAR . $userData->avatar;?>" alt="" height="41" width="41" class="circular1" />

														<?php else:?>

														<img src="<?php echo base_url();?>assets/images/person.png" alt="" height="41" width="41" class="circular1" />

														<?php endif;?>

													</div>

													<div class="col-xs-12 col-sm-8 col-md-10">

														<div class="col-sm-4 col-md-4">

															<h6><?php echo $contractorname[$bid->id][0]->fname .' '.$contractorname[$bid->id][0]->lname;?></h6>

														</div>

														<?php $reviews	= $this->review_model->get_my_ratings($bid->contractorid)->result();

														$mirating = 0; $k=0;

														foreach ($reviews as $review) {

															$k = $k+1;

															$mirating = $mirating + $review->rating; 

														} 

														$mirating = ($k == 0) ? 0 : $mirating / $k;?>

														<div class="col-sm-4 col-md-4">

															<?php myrating($mirating);?>

														</div>

														<div class="col-sm-4 col-md-4">

															<h6>Bid: $<?php echo $bid->budget;?></h6>

														</div>

													</div>

													<div class="col-xs-12 col-sm-8 col-md-10 budget-project">

														<div class="col-sm-4 col-md-4">

															<a href="<?php echo base_url();?>user/profile/<?php echo $bid->contractorid;?>" class="btn btn-warning" data-toggle="modal">Profile</a>

														</div>

														<div class="col-sm-4 col-md-4">

															<a href="javascript:void(0)" data-toggle="modal" data-target="#message-<?php echo $bid->contractorid;?>" class="btn btn-warning">Message</a>

														</div>

														<div class="col-sm-4 col-md-4">

															<a href="#" data-id="<?php echo $bid->projectid;?>" data-userid="<?php echo $bid->contractorid;?>" class="awarding btn" data-toggle="modal">Accept</a>

														</div>

													</div>

												</div>

											</div>

										<?php endforeach;?>

									<?php endif;?>

								<?php else: ?>

									

									

									<?php

									if ($project->awardedid > 0 && $project->awardedid != $user->id):

										$contractorname = $this->user_model->get_username($project->awardedid)->result();

										$awardedBid = $this->bid_model->get_awarded_bid($project->id,$project->awardedid)->result();?>

										<p>Already Awarded</p>

									<?php elseif($bid_status[0]->status != 3):

											$projectMessages = $this->project_model->get_messages_by_bider($project->id,$user->id,$project->clientid)->result();

											if($project->awardedid == $user->id):?>

												<?php if ($project->status == 1): ?>

												<p>Working</p>

												<?php endif;?>

											<?php endif;?>

											<div class="modal fade" id="message-<?php echo $project->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

												<div class="modal-dialog certificate">

													<div class="modal-content">

														<div class="modal-header">

															<span></span>

															<img class="close" data-dismiss="modal" aria-hidden="true" src="<?php  echo base_url() ; ?>assets/images/cancel-btn.png">

															<img class="bg-modal2" src="<?php  echo base_url() ; ?>assets/images/bg-modal2.png">

															<h4 class="modal-title text-center">Messages</h4>	

														</div>

														<div class="modal-body">

															<form class="form-horizontal send-message" name="send-message" id="send-message-<?php echo $project->id;?>" enctype="multipart/form-data" method="post" action="javascript:void(0)">

																<div class="message-container"></div>

																<input type="hidden" name = "c_user" value="<?php echo $user->id; ?>" />

																<input type="hidden" name = "project_id" value="<?php echo $project->id; ?>" />

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

															<?php if($projectMessages):?>

																<?php foreach($projectMessages as $message):?>

																	<a class="list-group-item">

																		<!--img src="images/profile50x50.png" class="chat-user-avatar" alt=""-->

																		<span class="username"><?php if($message->userId == $user->id):?> You <?php endif;?><span class="time"><?php echo $message->message_date;?></span> </span>

																		<p><?php echo $message->message;?></p>

																	</a>

																<?php endforeach;?>

															<?php endif;?>

														</div>

													</div>

												</div>

											</div>

											

											<div class="col-xs-12 col-sm-12 col-md-12 project-client">

												<div class="row">

													<div class="col-xs-12 col-sm-8 col-md-10 budget-project">

													<?php if (!empty($bid_status)):?>

														<div class="col-sm-4 col-md-4">

															<a href="javascript:void(0)" data-toggle="modal" data-target="#message-<?php echo $project->id;?>" class="btn btn-warning">Message</a>

														</div>

													<?php endif;?>

														<?php 

														if ($project->status == 1 && !empty($bid_status) && $project->awardedid == 0):?>

														<div class="col-sm-4 col-md-4">

															<a href="#" data-id="<?php echo $project->id;?>" class="cancel-bid btn btn-warning" data-toggle="modal">Cancel Bid</a>

														</div>

														<?php endif;?>

														<?php if($project->awardedid > 0 && $project->awardedid == $user->id):?>

														<div class="col-sm-4 col-md-4">

															<a href="#" data-id="<?php echo $project->id;?>" class="finish-project btn btn-danger" data-toggle="modal">Finish</a>

														</div>

														<?php endif;?>

													</div>

												</div>

											</div>

									<?php endif;?>

									

								<?php endif;?>

								</div>

							</div>

						</div>

					<?php endforeach; ?>

			</div>

					

			<?php if($owner == 'me'):?>

				<div role="tabpanel" class="tab-pane" id="address-tab">

					<?php foreach ($archivedProjects as $project):?>

						<div class="row project-details">

							<div class="col-xs-12 col-sm-12 col-md-12 project-client">

								<div class="row">

									<div class="col-xs-12 col-sm-2 col-md-2 text-center">

										<?php $user_query = array(

											'select' => array('users.*'),

											'where' => array('users.id' => $project->clientid),

											'row' => 1

										);

										$ownerProject = $this->user_model->get_rows($user_query, 'users');

										$myfile = DIRAVATAR .$ownerProject->avatar;		

										if (file_exists($myfile)):?>

										<img src="<?php echo URLAVATAR . $ownerProject->avatar;?>" alt="" height="81" width="81" class="circular2" />

										<?php else:?>

										<img src="<?php echo base_url();?>assets/images/person.png" alt="" height="81" width="81" class="circular2" />

										<?php endif;?>

										<h6><?php echo $clientname[$project->id][0]->fname .' '.$clientname[$project->id][0]->lname;?></h6>

									</div>

									<div class="col-xs-12 col-sm-7 col-md-8">

										<h4><?php echo $project->title;?></h4>

										<span>Deliver by - 

											<?php $source = $project->deliverydate;

											$date = new DateTime($source);

											echo $date->format('F j, Y'); ?>

										</span>

										<p><?php echo $project->description;?></p>

									</div>

									<div class="col-xs-12 col-sm-3 col-md-2 budget-project">

										<span>Budget: <b>$<?php echo $project->budget;?></b></span><br>

										<span>Bids: <?php echo $bids[$project->id];?></span><br>

										<div class="text-center">

											<div id="#accordion">

												<!--a href="#detailstext<?php echo $project->id;?>" class="btn btn-link" data-toggle="collapse" data-parent="#accordion">View Details</a-->

												<?php if ($project->status == 3) { 

														if ($project->awardedid > 0) {

															echo '<a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#feedback-modal" >Give Feedback</a>'; 
															if ($user_type==2) {
																$chk_wthdrawal_request = $this->project_model->check_wthdrawal_request($project->id,$this->session->userdata['user_data']['id'])->result();
																if(count($chk_wthdrawal_request)>0)
																{
																	echo '<br/>Request Sent!';
																}
																else
																{
																	echo '<br/><a href="#" data-id="'.$project->id.'" data-budget="'.$project->budget.'" data-userid="'.$this->session->userdata['user_data']['id'].'" class="applyWithdrawal btn btn-info" data-toggle="modal">Apply for Withdrawal</a>';
																}															
															}
															else {
																echo '&nbsp;'; 
															}

														}else{ 

															echo 'Project Closed'; 

														}

													} // feedback can only be given once and when project is finished so we check if it hasn't already be given

												?>

											</div>

										</div>

									</div>

								</div>

							</div>

							<!--div class="col-xs-12 col-sm-12 col-md-12 panel-body">

								<div id="detailstext<?php echo $project->id;?>" class="collapse">

									<p class=""><?php echo $project->details;?></p>

									<p>

										<b>Project status:</b>

										Archived

									</p>

								</div>

							</div-->

						</div>

					<?php endforeach;?>

				</div>

			<?php endif;?>

		</div>

	</div>

</div>