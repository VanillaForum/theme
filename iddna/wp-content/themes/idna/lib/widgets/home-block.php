<?php

/*----------------------------------------
* 	Home Events
-----------------------------------------*/

class events_block extends WP_Widget {

	function events_block() {

		$widget_ops = array( 'classname' => 'events_block', 'description' => __('A widget for Atlas Events', 'prestige') );
		$this->WP_Widget( 'events_block', __('Atlas Events Widget', 'prestige'), $widget_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		$evets_order = $instance['evets_order'];
		$text_link = $instance['text_link'];
		$background = $instance['background'];
		$text_link = $instance['text_link'];

		echo $before_widget;

		//if ($text_title) echo $beforetitle .'<div class="news-title">'. $text_title .'</div>'. $aftertitle;

		 ?>

		<div class="events-container">

		<?php $today = date('Y-m-d');
			$query = new WP_Query(array( 'post_type' => 'event', 'showposts' => -1, 'meta_key' => '_event_start_date', 'orderby' => 'meta_value', 'order' => $evets_order ));
			echo '<div id="owl-demo" class="owl-carousel">';
			$counter = 0;
			if( $query->have_posts() ) :

				while($query->have_posts()) : $query->the_post();

					if (has_post_thumbnail()) {
						$date = do_shortcode('[event post_id="'.get_the_ID().'"]#_{Y}-#_{m}-#_{d}[/event]');
						if ($date >= $today) {
							$counter++;
							//echo do_shortcode('[events_list limit="-1"][/events_list]');
							if ($counter==1) { $first = 'first-event'; }else{$first='';}
							
							$location_image = do_shortcode('[event post_id="'.get_the_id().'"]#_LOCATIONLINK[/event]');
							$image_location = strip_tags($location_image);
							$event_permalink = get_the_permalink();
							$event_title = get_the_title();
							$event_id = get_the_ID();
							//echo $image_location;
							$queryloc = new WP_Query(array( 'post_type' => 'location', 'showposts' => -1, 'order' => $evets_order ));
							if( $queryloc->have_posts() ) :
								while($queryloc->have_posts()) : $queryloc->the_post();

									if ($image_location == get_the_title()) {
										
										$final_image = get_the_post_thumbnail(get_the_id(),'event-thumbnail');
										echo '<div class="item">';
										echo '';
										echo '<a href="'.$event_permalink.'" class="content-event"><div class="event-block '.$first.'">'.$final_image;
										echo '<div class="block-event-title">'.$event_title.'</div>';
										echo '<div class="block-event-description">'.do_shortcode('[event post_id="'.$event_id.'"]#_LOCATIONLINK<br>#_{M} #_{j}<span>TH</span>[/event]').'</div>';
										//[event post_id="123"]My selected event is called #_EVENTNAME[/event]
										echo '</div>';
										echo '</a>';
										echo '</div>';
									}else{
									}

									wp_reset_query();

								endwhile;
							endif;
							
								
							
							
						}
					}else{

					}					

					wp_reset_query();

				endwhile;

			endif;	
			echo '</div>';
			//echo '</div><div class="clearfix"></div><a class="prev" id="foo2_prev" href="#"><span><img src="'.get_site_url().'/wp-content/themes/atlas_kiah/images/arrow-left-c.png"></span></a><a class="next" id="foo2_next" href="#"><span><img src="'.get_site_url().'/wp-content/themes/atlas_kiah/images/arrow-right-c.png"></span></a></div>';		
			echo '<script>
			    jQuery(document).ready(function() {
			      jQuery("#owl-demo").owlCarousel({
			        autoPlay: 3000,
			        items : 3,
			        itemsDesktop : [1199,3],
			        itemsDesktopSmall : [979,3],
			        itemsTablet : [823, 2],
			        itemsMobile : [660, 1]
			      });

			    });
			    </script>';
		?>

			
		</div>           	           

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['evets_order'] = strip_tags( $new_instance['evets_order'] );

		return $instance;

	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
		'evets_order' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$evets_order = $instance['evets_order'];

		?>

		<!--<p>
			<label for="<?php echo $this->get_field_id( 'text_title' ); ?>"><?php _e('Title:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_title'); ?>" name="<?php echo $this->get_field_name('text_title'); ?>" type="text" value="<?php echo attribute_escape($text_title); ?>" />
		</p>-->

		<p>			
			<label for="<?php echo $this->get_field_id( 'evets_order' ); ?> "><?php _e('Order:', 'evets_order'); ?></label>
			<select id="<?php echo $this->get_field_id( 'evets_order' ); ?>" name="<?php echo $this->get_field_name( 'evets_order' ); ?>">
		     <option value="ASC" <?php echo ($evets_order=='ASC')?'selected':''; ?>>Ascending</option>
		     <option value="DESC" <?php echo ($evets_order=='DESC')?'selected':''; ?>>Descending</option>
		     <option value="RAND" <?php echo ($evets_order=='RAND')?'select':''; ?>>Random</option>
			</select>
		</p>

		<!--<p>
			<label for="<?php echo $this->get_field_id( 'text_button' ); ?>"><?php _e('Button Text:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_button'); ?>" name="<?php echo $this->get_field_name('text_button'); ?>" type="text" value="<?php echo attribute_escape($text_button); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_link' ); ?>"><?php _e('Button Link:', 'prestige') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_link'); ?>" name="<?php echo $this->get_field_name('text_link'); ?>" type="text" value="<?php echo attribute_escape($text_link); ?>" />
		</p>-->
	<?php

	}

}

add_action( 'widgets_init', create_function('', 'return register_widget("events_block");') );

?>