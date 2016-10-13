<?php

/*----------------------------------------
* 	Socials Widget
-----------------------------------------*/

class socials_widget extends WP_Widget {

	function socials_widget() {

		$widget_ops = array( 'classname' => 'socials_widget', 'description' => __('A widget Social Links', 'prestige') );
		$this->WP_Widget( 'socials_widget', __('IDNA Socials', 'prestige'), $widget_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		$text_title = $instance['text_title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$linkedin = $instance['linkedin'];
		$google = $instance['google'];
		$skype = $instance['skype'];
		$youtube = $instance['youtube'];
		$instagram = $instance['instagram'];
		$vimeo = $instance['vimeo'];

		echo $before_widget;

		if ($text_title) echo $beforetitle .'<div class="socials-title">'. $text_title .'</div>'. $aftertitle;

		 ?>

		<div class="content-socials">

		<?php 
			if ($facebook) {
				?>
					<a href="<?php echo $facebook; ?>" class="social-facebook" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				<?php
			}
			if ($twitter) {
				?>
					<a href="<?php echo $twitter; ?>" class="social-twitter" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				<?php
			}
			if ($google) {
				?>
					<a href="<?php echo $google; ?>" class="social-google" target="_blank">
						<i class="fa fa-google-plus"></i>
					</a>
				<?php
			}
			if ($instagram) {
				?>
					<a href="<?php echo $instagram; ?>" class="social-instagram" target="_blank">
						<i class="fa fa-instagram"></i>
					</a>
				<?php
			}
			if ($youtube) {
				?>
					<a href="<?php echo $youtube; ?>" class="social-youtube" target="_blank">
						<i class="fa fa-youtube-play"></i>
					</a>
				<?php
			}
			if ($vimeo) {
				?>
					<a href="<?php echo $vimeo; ?>" class="social-vimeo" target="_blank">
						<i class="fa fa-vimeo-square"></i>
					</a>
				<?php
			}
			if ($linkedin) {
				?>
					<a href="<?php echo $linkedin; ?>" class="social-linkedin" target="_blank">
						<i class="fa fa-linkedin"></i>
					</a>
				<?php
			}
			
			if ($skype) {
				?>
					<a href="<?php echo $skype; ?>" class="social-skype" target="_blank">
						<i class="fa fa-skype"></i>
					</a>
				<?php
			}
				

		?>
			
		</div>           	           

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['text_title'] = strip_tags( $new_instance['text_title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['google'] = strip_tags( $new_instance['google'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );

		return $instance;

	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
		'text_title' => '',
		'facebook' => '',
		'twitter' => '',
		'linkedin' => '',
		'google' => '',
		'skype' => '',
		'youtube' => '',
		'instagram' => '',
		'vimeo' => '',
		);
		$text_title = $instance['text_title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$linkedin = $instance['linkedin'];
		$google = $instance['google'];
		$skype = $instance['skype'];
		$youtube = $instance['youtube'];
		$instagram = $instance['instagram'];
		$vimeo = $instance['vimeo'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_title' ); ?>"><?php _e('Title:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_title'); ?>" name="<?php echo $this->get_field_name('text_title'); ?>" type="text" value="<?php echo attribute_escape($text_title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo attribute_escape($facebook); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo attribute_escape($twitter); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('Google+ Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo attribute_escape($google); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo attribute_escape($instagram); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo attribute_escape($youtube); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo attribute_escape($vimeo); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('Linkedin Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo attribute_escape($linkedin); ?>" />
		</p>

		

		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo attribute_escape($skype); ?>" />
		</p>

		
	<?php

	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("socials_widget");') );

?>