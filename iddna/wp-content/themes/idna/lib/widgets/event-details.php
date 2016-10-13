<?php

/*----------------------------------------
* 	Event Details
-----------------------------------------*/

class events_detail extends WP_Widget {

	function events_detail() {

		$widget_ops = array( 'classname' => 'events_detail', 'description' => __('A widget for Atlas Event Details', 'prestige') );
		$this->WP_Widget( 'events_detail', __('Atlas Event Details Widget', 'prestige'), $widget_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		$event_id = $instance['event_id'];
		$event_content = $instance['event_content'];

		echo $before_widget;

		//if ($text_title) echo $beforetitle .'<div class="news-title">'. $text_title .'</div>'. $aftertitle;

		 ?>

		<div class="event-detail-container">

		<?php 
			$query = new WP_Query(array( 'post_type' => 'event', 'showposts' => -1, 'orderby' => 'date', 'order' => 'DESC' ));
			
			if( $query->have_posts() ) :

				while($query->have_posts()) : $query->the_post();

					$id_event = get_the_ID();
					if ($id_event == $event_id) {
						echo '<div class="details-top">'.do_shortcode('[event post_id="'.$event_id.'"]#_LOCATIONLINK,<br>#_{M} #_{j} #_{Y}.[/event]').'</div>';
						echo '<div class="detail-event">'.do_shortcode($event_content).'</div>';
					}					

					wp_reset_query();

				endwhile;

			endif;		

		?>
			
		</div>           	           

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['event_id'] = strip_tags( $new_instance['event_id'] );
		$instance['event_content'] = $new_instance['event_content'];

		return $instance;

	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
		'event_id' => '',
		'event_content' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$event_id = $instance['event_id'];
		$event_content = $instance['event_content'];

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'event_id' ); ?>"><?php _e('Event ID:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('event_id'); ?>" name="<?php echo $this->get_field_name('event_id'); ?>" type="text" value="<?php echo attribute_escape($event_id); ?>" />
		</p>

		<p>
	        <label for="<?php echo $this->get_field_id('event_content'); ?>">Event Detail: </label>
	        <textarea style="min-height:300px;" class="widefat" id="<?php echo $this->get_field_id('event_content'); ?>" name="<?php echo $this->get_field_name('event_content'); ?>"><?php echo attribute_escape($event_content); ?></textarea>
	    </p>
	<?php

	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("events_detail");') );

?>