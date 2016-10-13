<?php
/*
	Template Name: Vanilla Blog
	Author: Quantum
*/
include_once('functions.php');
get_header();

?>
</div>
<div class="wrapper afclr">
	<section class="row row-content">
          <div class="col-lg-12 vanilla-home-contents">
               <div class="row">
		<?php 
			$query_args = array(
			'posts_per_page' => 8,
		
		);
		$query = new WP_Query($query_args);
		//$query->the_post();
		while($query -> have_posts()) : $query -> the_post();
		$categories = get_the_category();
		$tag_ids = get_the_tags();
		$tag = $tag_ids[0];
		?>
		<div class="col-sm-12 col-md-6 ">
			<div class="quantum-post-content">
				<div class="quantum-home-post">
					<h2><a href ="<?php the_permalink(); ?>"><?php

$thetitle = $post->post_title;

$getlength = strlen($thetitle);

$thelength = 90;

echo substr($thetitle, 0, $thelength);

if ($getlength > $thelength) echo "...";

?>
</a></h2>
					<div class="img-thumbnail"><a href ="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'blog' ); ?></a></div>								
				</div>
				<div class = "quantum-author-section afclr">
					<div class="quantum-author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?> </div>
					<div class="quantum-author-name"><?php the_author_posts_link(); ?><span> in </span> <span class="quantum-home-cat"><a href=""><?php echo esc_html( $categories[0]->name); ?></a></span></div>
					<div class="quantum-home-date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></div>
					<div class ="quantum-home-read"><?php post_read_time(); ?></div>
				</div>
				<div class="quantum-post-comments afclr">
					<div class ="quantum-post-like"><?php
if(function_exists('like_counter_p')) { like_counter_p(''); }
?>	</span></div>
					<div class= "quantum-comment-count">
						<a href=""><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
						<div class = "quantum-comment-number"><a href=""><?php comments_number( '' ); ?></a></div>						
					</div>
                    <?php if($tag )
					{ ?>
					<div class = "quantum-home-tag"><div class = "quantum-home-out"><div class="quantum-home-tag-inner"><a href="#"><?php echo $tag->name ?></a></div></div></div>
                    <?php }  else { ?>
                   <div class = "quantum-home-tag"><a href="#"><?php echo $tag->name ?></a></div>
                   <?php } ?>
				</div>
			</div>
		</div>	
		
		
		
		<?php endwhile; ?>
        
		
			<?php echo do_shortcode( '[ajax_load_more post_type="post" posts_per_page="6" pause="true" button_label="Load More..." container_type="div"]'); ?>
		
		
		</div>
          </div>
          
		<div class="load-bars col-lg-12">
		<div class="row quantum-home-old-load">
               <?php /*?><div class="col-md-3 col-sm-6 ">
               <div class="quantum-home-older"><div class="quantum-home-older-inner"><a href = "#">Older Posts</a></div></div>
               </div><?php */?>
               <div class="col-md-9 col-sm-6">
			   
			   
			   
               <!-- <div class="quantum-home-load"><a href = "#">Load more ... </a></div> */ -->
               </div>
		</div>
          </div>
</section>

<?php
get_sidebar(); ?>
</div>
<?php
get_footer();
?>