<?php

/*----------------------------------------
* 	Sign Up Widget
-----------------------------------------*/

class sign_up_widget extends WP_Widget {

	function sign_up_widget() {

		$widget_ops = array( 'classname' => 'sign_up_widget', 'description' => __('A widget Sign Up', 'prestige') );
		$this->WP_Widget( 'sign_up_widget', __('Atlas Sign Up', 'prestige'), $widget_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		$button_text_one = $instance['button_text_one'];
		$button_link_one = $instance['button_link_one'];
		$button_text_two = $instance['button_text_two'];
		$button_link_two = $instance['button_link_two'];

		echo $before_widget;

		//if ($button_text_one) echo $beforetitle .'<div class="news-title">'. $button_text_one .'</div>'. $aftertitle;

		 ?>

		<div class="content-buttons-top">

		<?php 
			if ($button_text_one) {
				echo '<a href="'.$button_link_one.'" class="first-button">'.$button_text_one.'</a>';
			}
			if ($button_text_two) {
				echo '<a href="'.$button_link_two.'" class="second-button">'.$button_text_two.'</a>';
			}
			

		?>
			
		</div>           	           

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['button_text_one'] = strip_tags( $new_instance['button_text_one'] );
		$instance['button_link_one'] = $new_instance['button_link_one'];
		$instance['button_text_two'] = strip_tags( $new_instance['button_text_two'] );
		$instance['button_link_two'] = strip_tags( $new_instance['button_link_two'] );

		return $instance;

	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
		'button_text_one' => '',
		'button_link_one' => '',
		'button_text_two' => '',
		'button_link_two' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$button_text_one = $instance['button_text_one'];
		$button_link_one = $instance['button_link_one'];
		$button_text_two = $instance['button_text_two'];
		$button_link_two = $instance['button_link_two'];  
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text_one' ); ?>"><?php _e('First Button Text:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_text_one'); ?>" name="<?php echo $this->get_field_name('button_text_one'); ?>" type="text" value="<?php echo attribute_escape($button_text_one); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_link_one' ); ?>"><?php _e('First Button Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_link_one'); ?>" name="<?php echo $this->get_field_name('button_link_one'); ?>" type="text" value="<?php echo attribute_escape($button_link_one); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text_two' ); ?>"><?php _e('Second Button Text:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_text_two'); ?>" name="<?php echo $this->get_field_name('button_text_two'); ?>" type="text" value="<?php echo attribute_escape($button_text_two); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'button_link_two' ); ?>"><?php _e('Second Button Url:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_link_two'); ?>" name="<?php echo $this->get_field_name('button_link_two'); ?>" type="text" value="<?php echo attribute_escape($button_link_two); ?>" />
		</p>
	<?php

	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("sign_up_widget");') );

?>