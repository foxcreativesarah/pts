<?php

/**
 * Get additional system & plugin specific information for feedback
 *
 */
if ( ! function_exists( 'ig_rm_get_additional_info' ) ) {

	/**
	 * Get Rainmaker specific information
	 *
	 * @param $additional_info
	 * @param bool $system_info
	 *
	 * @return mixed
	 *
	 * @since 1.0
	 */
	function ig_rm_get_additional_info( $additional_info, $system_info = false ) {
		global $icegram_rainmaker, $ig_rm_tracker;
		$additional_info['version'] = $icegram_rainmaker->version;
		if ( $system_info ) {

			$additional_info['active_plugins']   = implode( ', ', $ig_rm_tracker::get_active_plugins() );
			$additional_info['inactive_plugins'] = implode( ', ', $ig_rm_tracker::get_inactive_plugins() );
			$additional_info['current_theme']    = $ig_rm_tracker::get_current_theme_info();
			$additional_info['wp_info']          = $ig_rm_tracker::get_wp_info();
			$additional_info['server_info']      = $ig_rm_tracker::get_server_info();

			// RM Specific information
			$additional_info['plugin_meta_info'] = Rainmaker::get_rm_meta_info();
		}

		return $additional_info;

	}

}

add_filter( 'ig_rm_additional_feedback_meta_info', 'ig_rm_get_additional_info', 10, 2 );
