<?php
/* Template Name: Job Archive */
require_once 'job-functions.php';
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'job_archive_loop' );
remove_all_actions( 'genesis_entry_header' );
remove_all_actions( 'genesis_entry_footer' );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'archive_job_display_details' );
genesis();