<!-- Main Admin View  -->



<!-- Include header -->



<!-- Include Main Left Menu -->



<!-- Include Footer -->



<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8">

		<title>CMS / Administration</title>

		<meta name="description" content="description">

		<meta name="author" content="DK">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/bootstrap/bootstrap.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/xcharts/xcharts.min.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/select2/select2.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/css/style_v1.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/devoops/plugins/chartist/chartist.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>

				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>

				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>

		<![endif]-->

		<script>

        	var base_url = '<?php echo base_url()?>assets/devoops/';

		</script>

	</head>

<body>

<!--Start Header-->

<div id="screensaver">

	<canvas id="canvas"></canvas>

	<i class="fa fa-lock" id="screen_unlock"></i>

</div>

<div id="modalbox">

	<div class="devoops-modal">

		<div class="devoops-modal-header">

			<div class="modal-header-name">

				<span>Basic table</span>

			</div>

			<div class="box-icons">

				<a class="close-link">

					<i class="fa fa-times"></i>

				</a>

			</div>

		</div>

		<div class="devoops-modal-inner">

		</div>

		<div class="devoops-modal-bottom">

		</div>

	</div>

</div>

<header class="navbar">

	<div class="container-fluid expanded-panel">

		<div class="row">

			<div id="logo" class="col-xs-12 col-sm-2">

				<a href="#">DropByTech Admin</a>

			</div>

			<div id="top-panel" class="col-xs-12 col-sm-10">

				<div class="row">

					<div class="col-xs-8 col-sm-4">

						<!--div id="search">

							<input type="text" placeholder="search"/>

							<i class="fa fa-search"></i>

						</div-->

					</div>

					<div class="col-xs-4 col-sm-8 top-panel-right">

						<!-- <a href="index.html" class="style2"></a>-->

						<ul class="nav navbar-nav pull-right panel-menu">

							<!--li class="hidden-xs">

								<a href="index.html" class="modal-link">

									<i class="fa fa-bell"></i>

									<span class="badge">7</span>

								</a>

							</li>

							<li class="hidden-xs">

								<a class="ajax-link" href="ajax/calendar.html">

									<i class="fa fa-calendar"></i>

									<span class="badge">7</span>

								</a>

							</li>

							<li class="hidden-xs">

								<a href="ajax/page_messages.html" class="ajax-link">

									<i class="fa fa-envelope"></i>

									<span class="badge">7</span>

								</a>

							</li-->

							<li class="dropdown">

								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">

									<div class="avatar">

										<img src="<?php echo base_url(); ?>assets/images/userphoto/8.jpg" class="img-circle" alt="avatar" />

									</div>

									<i class="fa fa-angle-down pull-right"></i>

									<div class="user-mini pull-right">

										<span class="welcome">Welcome,</span>

										<span><?php echo $this->session->userdata['user_data']['fname'] .' '.$this->session->userdata['user_data']['lname']; ?></span>

									</div>

								</a>

								<ul class="dropdown-menu">

									<!--li>

										<a href="#">

											<i class="fa fa-user"></i>

											<span>Profile</span>

										</a>

									</li>

									<li>

										<a href="ajax/page_messages.html" class="ajax-link">

											<i class="fa fa-envelope"></i>

											<span>Messages</span>

										</a>

									</li>

									<li>

										<a href="ajax/gallery_simple.html" class="ajax-link">

											<i class="fa fa-picture-o"></i>

											<span>Albums</span>

										</a>

									</li>

									<li>

										<a href="ajax/calendar.html" class="ajax-link">

											<i class="fa fa-tasks"></i>

											<span>Tasks</span>

										</a>

									</li>

									<li>

										<a href="#">

											<i class="fa fa-cog"></i>

											<span>Settings</span>

										</a>

									</li-->

									<li>

										<a href="#">

											<i class="fa fa-power-off"></i>

											<span>Logout</span>

										</a>

									</li>

								</ul>

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

</header>

<!--End Header-->

<!--Start Container-->

<div id="main" class="container-fluid">

	<div class="row">

		<div id="sidebar-left" class="col-xs-2 col-sm-2">

			<ul class="nav main-menu">

				<li>

					<a href="<?php echo base_url(); ?>admin" class="active">

						<i class="fa fa-dashboard"></i>

						<span class="hidden-xs">Dashboard</span>

					</a>

				</li>

				<li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-list"></i>

						 <span class="hidden-xs">Pages</span>

					</a>

					<ul class="dropdown-menu">

						<li><a href="<?php echo base_url(); ?>admin/home">Home</a></li>

						<li><a href="<?php echo base_url(); ?>admin/safety">Safety</a></li>

						<li><a href="<?php echo base_url(); ?>admin/about-us">About Us</a></li>

						<li><a href="<?php echo base_url(); ?>admin/faq-center">FAQ center</a></li>

						<li><a href="<?php echo base_url(); ?>admin/legal">Legal</a></li>

						<li><a href="<?php echo base_url(); ?>admin/blog">Blog</a></li>

						<li><a href="<?php echo base_url(); ?>admin/terms-of-service">Terms of Service</a></li>

						<li><a href="<?php echo base_url(); ?>admin/privacy-policy">Privacy Policy</a></li>

						<li><a href="<?php echo base_url(); ?>admin/how-it-works">How it works</a></li>

						<li><a href="<?php echo base_url(); ?>admin/why-choose-us">Why choose us</a></li>

					</ul>

				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">

						<i class="fa fa-table"></i>

						 <span class="hidden-xs">Projects</span>

					</a>

					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>admin/projects">Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/withdrawal_requests">Withdrawal Requests</a></li>
                    </ul>
				</li>
				<!--li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-bar-chart-o"></i>

						<span class="hidden-xs">Users</span>

					</a>

				</li>

				<li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-table"></i>

						 <span class="hidden-xs">Projects</span>

					</a>

					<ul class="dropdown-menu">

						<li><a class="ajax-link" href="ajax/tables_simple.html">Simple Tables</a></li>

						<li><a class="ajax-link" href="ajax/tables_datatables.html">Data Tables</a></li>

						<li><a class="ajax-link" href="ajax/tables_beauty.html">Beauty Tables</a></li>

					</ul>

				</li>

				<li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-pencil-square-o"></i>

						 <span class="hidden-xs">Bids</span>

					</a>

					<ul class="dropdown-menu">

						<li><a class="ajax-link" href="ajax/forms_elements.html">Elements</a></li>

						<li><a class="ajax-link" href="ajax/forms_layouts.html">Layouts</a></li>

						<li><a class="ajax-link" href="ajax/forms_file_uploader.html">File Uploader</a></li>

					</ul>

				</li>

				<li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-desktop"></i>

						 <span class="hidden-xs">Reviews</span>

					</a>

					<ul class="dropdown-menu">

						<li><a class="ajax-link" href="ajax/ui_grid.html">Grid</a></li>

						<li><a class="ajax-link" href="ajax/ui_buttons.html">Buttons</a></li>

						<li><a class="ajax-link" href="ajax/ui_progressbars.html">Progress Bars</a></li>

						<li><a class="ajax-link" href="ajax/ui_jquery-ui.html">Jquery UI</a></li>

						<li><a class="ajax-link" href="ajax/ui_icons.html">Icons</a></li>

					</ul>

				</li>

				<li class="dropdown">

					<a href="#" class="dropdown-toggle">

						<i class="fa fa-map-marker"></i>

						<span class="hidden-xs">Maps</span>

					</a>

					<ul class="dropdown-menu">

						<li><a class="ajax-link" href="ajax/maps.html">OpenStreetMap</a></li>

						<li><a class="ajax-link" href="ajax/map_fullscreen.html">Fullscreen map</a></li>

						<li><a class="ajax-link" href="ajax/map_leaflet.html">Leaflet</a></li>

					</ul>

				</li-->

			</ul>

		</div>

		<!--Start Content-->

		<div id="content" class="col-xs-12 col-sm-10">
			<!-- ADDED BY PADAM JAIN 24-07-2015 -->
            <div class="row tab-content personal-info" >

			<div role="tabpanel" class="tab-pane active" id="info-tab">
				<table class="table table-bordered">
            		<tr><th>Project</th><th>Client</th><th>IT Contractor</th><th>Budget</th><th>IT Contractor Amount</th><th>Request Date</th><th class="thaction">Actions</th></tr>
				<?php if (count($withdrawal_reqs)>0){		
					foreach ($withdrawal_reqs as $wtdrw): 
						$projectDtl = $this->project_model->find_wthdrwl_project($wtdrw->project_id);
						$itc_data	= $this->user_model->get_userdata($wtdrw->userid)->result_array();
						$clt_data	= $this->user_model->get_userdata($projectDtl[0]['clientid'])->result_array();
						$request_date = date('Y-m-d H:i:s A', strtotime($wtdrw->withdrawal_request_date));
				?>
                <tr>
                	<td valign="top"><?php echo $projectDtl[0]['title'];?></td>
                    <td valign="top"><?php echo $clt_data[0]['fname']." ".$clt_data[0]['lname'];?></td>
                    <td valign="top"><?php echo $itc_data[0]['fname']." ".$itc_data[0]['lname'];?></td>
                    <td valign="top"><?php echo "$".$projectDtl[0]['budget'];?></td>
                    <td valign="top"><?php echo "$".$wtdrw->ammount;?></td>
                    <td valign="top"><?php echo $request_date;?></td>
                    <td valign="top">
						<?php 
						if($wtdrw->withdrawal_request_status==0)
						{
						?>
                        <a href="<?php echo base_url(); ?>admin/approve_request/<?php echo $wtdrw->id;?>">Wait for Approval</a>
                        <?php //echo $projectDtl->budget;
						}
						else if($wtdrw->withdrawal_request_status==1)
						{
						?>
                        Approved
                        <?php
						}
						else if($wtdrw->withdrawal_request_status==1)
						{
						?>
                        Reject
                        <?php
						}
						else
						{
							echo "&nbsp;";
						}
						?>
                    </td>
                </tr>
				<?php endforeach; ?>
				<?php }
				else
				{
				?>
                <tr><td colspan="7">No Request!</td></tr>
                <?php
				}
				?>
                </table>
			</div>
		</div>
        <!-- END ADDED BY PADAM JAIN 24-07-2015 -->
			<!--Welcome to the Drop By Tech admin panel

			<div id="about">

				<div class="about-inner">

					<h4 class="page-header">Drop By Tech</h4>

				</div>

			</div>

			<div class="preloader">

			</div>

			<div id="ajax-content"></div>-->

		</div>

		<!--End Content-->

	</div>

</div>

<!--End Container-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!--<script src="http://code.jquery.com/jquery.js"></script>-->

<script src="<?php echo base_url(); ?>assets/js/vendor/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/devoops/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="<?php echo base_url(); ?>assets/devoops/plugins/bootstrap/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/devoops/plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/devoops/plugins/tinymce/tinymce.min.js"></script>

<script src="<?php echo base_url(); ?>assets/devoops/plugins/tinymce/jquery.tinymce.min.js"></script>

<!-- All functions for this theme + document.ready processing -->

<script src="<?php echo base_url(); ?>assets/devoops/js/devoops.js"></script>

</body>

</html>

