<?php
/**
 * Template Name: News Template
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive 
 */
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop


function custom_do_grid_loop() { 
	?>
	<div class="page hentry entry">
	<div class="entry-content"><?php the_content() ?>
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
	'post_type' => 'post', // enter your custom post type
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'cat' => 3,	
	'posts_per_page'=> '12', // overrides posts per page in theme settings
	'paged' => $paged
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
	while( $loop->have_posts() ): $loop->the_post(); global $post;
	?>
	<div class="news-loop">
		<div class="wrap">
			<a href="<?php the_permalink() ?>"><div class="news-thumb"><?php the_post_thumbnail( $id, array("0") ) ?></div></a>
			<div class="news-summary">
				<span class="news-date"><?php echo get_the_date(); ?></span>
				<h3><?php the_title() ?></h3>
				<p><?php the_excerpt() ?></p>
			</div>
		</div>
	</div>
	<?php
	endwhile;
	?>
	<div class="navigation">
		<div class="next-posts"><?php next_posts_link('&laquo; Newer Entries' , $loop->max_num_pages) ?></div>
		<div class="prev-posts"><?php previous_posts_link('Older Entries &raquo;' , $loop->max_num_pages) ?></div>
	</div>
	<?php
	endif;
	wp_reset_query();
	?>
	</div><!-- end .entry-content -->
	</div><!-- end .page .hentry .entry -->
	<?php
}
 
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();