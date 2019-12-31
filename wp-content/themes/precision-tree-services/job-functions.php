<?php
function job_archive_loop(){
	global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args	
    $args = array(
        'post_type' => "pts_job", // exclude posts from this category
        'paged'    	=> $paged, // respect pagination
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
}

function get_excerpt(){
	$excerpt = get_the_excerpt();
	if( $excerpt )
		return $excerpt;	
	$excerpt = get_the_content();
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 140);		
	$excerpt = $excerpt.'...';
	return $excerpt;
}

function archive_job_display_details(){
	global $post;
	?>
	<a href="<?php echo the_permalink();?>" class="job-item">
		<div class="job-image">
			<?php
			$img = genesis_get_image( array(
			  'format'  => 'html',
			  'size'    => 'full',
			  'context' => 'archive',
			  'fallback'=> 1442, // Dummy Image ID
			  'attr'    => genesis_parse_attr( 'entry-image', array(
				'alt' => get_the_title(),
			  ) ),
			) );
			if ( ! empty( $img ) ) {
				  genesis_markup( array(
					 'open'    => '',
					 'close'   => '',
					 'content' => wp_make_content_images_responsive( $img ),
					 'context' => 'entry-job-image-link',
				   ) );
			 }
			?>		
		</div>
		<div class="title">
			<?php
			$title = genesis_markup( array(
					  'open'    => '',
					  'close'   => '',
					  'content' => get_the_title(),
					  'context' => 'entry-job-title-link',
					  'echo'    => false,
					) );
			$wrap = "h4";		
			genesis_markup( array(
				'open'    => "<{$wrap} %s>",
				'close'   => "</{$wrap}>",
				'content' => $title,
				'context' => 'entry-title',
				'params'  => array(
				  'wrap'  => $wrap,
				),			
			  ) );
			?>
		</div>
		<div class="description">
			<p><?php echo get_excerpt()?></p>
		</div>
	</a>
	<?php
}
function genesis_do_job_image(){
	?>
	<div class="job-big-image">
		<?php
		$img = genesis_get_image( array(
		  'format'  => 'html',
		  'size'    => 'hero-image',
		  'context' => 'single',
		  'fallback'=> 1442, // Dummy Image ID
		  'attr'    => genesis_parse_attr( 'entry-image', array(
			'alt' => get_the_title(),
		  ) ),
		) );
		if ( ! empty( $img ) ) {
			  genesis_markup( array(
				 'open'    => '',
				 'close'   => '',
				 'content' => wp_make_content_images_responsive( $img ),
				 'context' => 'entry-job-image-link',
			   ) );
		 }
		?>		
	</div>
	<?php
}
add_shortcode( 'apply-button', 'apply_button_html' );
function apply_button_html( $atts ){
	extract( shortcode_atts( array(						
		'job_id'	=> null,
		'title'		=> "Apply Now"		
	), $atts ) );
	ob_start();	
	?>
	<a href="javascript:void(0)" onclick="openPopup(this)" data-job-id="<?php echo $job_id?>"><?php echo $title?></a>
	<?php
	return ob_get_clean();
}

add_shortcode( 'apply-form', 'apply_form_html' );
function apply_form_html( $atts ){
	extract( shortcode_atts( array(									
	), $atts ) );
	ob_start();
	?>
	<div id="apply_frm" class="modal">					  
	  <div class="modal-content">
		<div class="modal-header">
			<span class="close" onclick="closePopup()">&times;</span>
			<h2>Apply Form</h2>
		</div>
		<div class="modal-body">
			<?php echo do_shortcode('[gravityform id="3" title="true" description="true" ajax="true"]')?>			
		</div>
	  </div>
	</div>
	<?php
	return ob_get_clean();
}

function get_job_apply_button(){
	global $post;
	echo do_shortcode('[apply-button job_id='.get_the_ID().']');	
}