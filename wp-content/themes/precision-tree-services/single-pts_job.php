<?php
require_once 'job-functions.php';
add_action( 'genesis_entry_header', 'genesis_do_job_image', 1 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'get_job_apply_button' );

remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action( 'genesis_entry_footer', 'get_job_apply_button' );
add_action( 'genesis_entry_footer', function(){ 
	echo do_shortcode('[apply-form]');
	?>
	<script>
		function openPopup(elm){
			var job_id = jQuery(elm).data("job-id");			
			jQuery("#input_3_1").val(job_id);
			jQuery("#apply_frm").show();
		}
		function closePopup(popId){
			jQuery("#apply_frm").hide();
		}
	</script>
	<?php
	} 
);
genesis();