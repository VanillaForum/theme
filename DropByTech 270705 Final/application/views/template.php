<?php 
    error_reporting(0);
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <title><?php echo site_name(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" id="description" />
		<meta name="author" content="Drop By Tech" />
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
	    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	
       <!-- Stylesheets -->
		<?php echo $this->dynamic_load->load_files('header'); ?>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script>
        	var urls = '<?php 
						echo json_encode(
								array('base_url' => base_url(),
									'backend_url' => backend_view(),
									'assets' => array( 'base' => asset_url(),
										'js' => asset_url('js'),
										'css' => asset_url('css'),
										'img' => asset_url('images')
									)
								)
							)
						?>';
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.15&sensor=false&libraries=places"></script>
		<style type="text/css">
		.different-loader{
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255,255,255,0.8) url('<?php echo asset_url("images", "bx_loader.gif"); ?>') no-repeat center center;
            z-index: 9999;
        }
        </style>

	</head>
        <body class="new_bg">
        <div class="different-loader"></div>		
		<?php 
            switch($page) {
                case 'home':
                   echo $this->load->view('blocks/home_header');
                break;
                case 'user':
                    echo $this->load->view('blocks/user_header');
                break;
                case 'client':
                    echo $this->load->view('blocks/client_header');
                break;
				default:
					echo $this->load->view('blocks/home_header');
                break;
            }
        ?>    
       <div class="main-wrapper">
			<?php echo $content; ?>
		</div>
		<?php echo $this->load->view('blocks/model'); ?>
        <?php echo $this->load->view('blocks/footer'); ?>
		<?php echo $this->dynamic_load->load_files('footer'); ?>
        
	</body>
</html>
