<?php
/**
 * Precision Tree Services Theme.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  Webzstore
 * @license GPL-2.0+
 * @link    http://www.webzstore.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.4' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Poppins:300,400,500,600', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'genesis-sample' ),
		'subMenu'  => __( 'Menu', 'genesis-sample' ),
	);
	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 389,
	'height'          => 73,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );
add_image_size( 'hero-image', 1600, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}


//* add blog on home page
add_shortcode( 'blog-home-posts', 'blog_home_posts' );
function blog_home_posts(){
	ob_start();	
	$args = array(
		'post_type' => 'post', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> 3, // overrides posts per page in theme settings	
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
	while( $loop->have_posts() ): $loop->the_post(); global $post;
	?>
	<div class="home-blog-loop">
		<div class="home-blog-thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( ) ?></a></div>
		<div class="home-blog-summary">
			<p class="home-post-date"><?php echo get_the_date(); ?></p>
			<h5><?php the_title() ?></h5>
			<p><?php the_excerpt() ?></p>
			
		</div>
	</div>
	<?php
	endwhile;
	endif;
	wp_reset_query();	
	return ob_get_clean();
}

//* Register widget for before footer
genesis_register_sidebar( array(
	'id'		=> 'before-footer',
	'name'		=> __( 'Before Footer', 'nabm' ),
	'description'	=> __( 'This is the widget area for Before Footer', 'nabm' ),
) );

//* Add the page widget in the content - HTML5
add_action( 'genesis_before_footer', 'nabm_add_page_content', 8);
function nabm_add_page_content() {
	genesis_widget_area ('before-footer', array(
        'before' => '<div class="before-footer"><div class="wrap">',
        'after' => '</div></div>',
	) );
}

//* Register widget for copyright footer
genesis_register_sidebar( array(
	'id'		=> 'copyright-footer',
	'name'		=> __( 'Copyright Footer', 'nabm-copyright' ),
	'description'	=> __( 'This is the widget area for Before Footer', 'nabm-copyright' ),
) );

//* Add the page widget in the content - HTML5
add_action( 'genesis_after_footer', 'nabm_copyright_section', 8);
function nabm_copyright_section() {
	genesis_widget_area ('copyright-footer', array(
        'before' => '<div class="copyright-footer"><div class="wrap">',
        'after' => '</div></div>',
	) );
}

//* Register widget for header top
genesis_register_sidebar( array(
	'id'		=> 'header-top',
	'name'		=> __( 'Header Top', 'nabm-header-top' ),
	'description'	=> __( 'This is the widget area for Header top', 'nabm-header-top' ),
) );

//* Add the page widget in the content - HTML5
add_action( 'genesis_before_header', 'header_top_section', 8);
function header_top_section() {
	genesis_widget_area ('header-top', array(
        'before' => '<div class="header-top"><div class="wrap">',
        'after' => '</div></div>',
	) );
}

 // Remove Footer
 remove_action('genesis_footer', 'genesis_do_footer');
 remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
 remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
 
 
 //* add hero images, hero title and hero sub title
	add_action( 'genesis_after_header', 'hero_image_section' );
	function hero_image_section(){
		if( !( is_home() || is_front_page() ) ){
	   $hero_image = get_field("hero_image");
		$hero_image_mobile 	= get_field("hero_image_mobile");
		$hero_title = get_field("hero_title");
		$hero_subtitle = get_field("hero_subtitle");
		?>
	<div id="hero-image-section">
  		<?php if( $hero_image ):?>
			<?php echo wp_get_attachment_image( $hero_image, 'hero-image', "", array( "class" => "hero-image" ) );?>
  		<?php endif; ?>	
		<?php if( $hero_image_mobile ):?>
  		<img src="<?php echo $hero_image_mobile["url"]?>" class="hero-image-mobile">
  		<?php endif; ?>			
  		<?php if( $hero_title ):?>
			<div class="hero-title-wrap"><span class="hero-title"><h1><?php echo $hero_title?></h1></span></div>
  		<?php endif; ?>
  		<?php if( $hero_subtitle ):?>
  		<span class="hero-subtitle"><?php echo $hero_subtitle?></span>
  		<?php endif; ?>
  	</div>
	<?php
	}
}

//* Register widget google review section
genesis_register_sidebar( array(
	'id'		=> 'google-review-section',
	'name'		=> __( 'Google Review', 'genesis' ),
	'description'	=> __( 'This is the widget area to show google review', 'genesis' ),
) );

add_shortcode('google-review-widget', 'google_review_widget');
function google_review_widget(){
	ob_start();
	genesis_widget_area ('google-review-section', array(
		'before' => '<div class="google-review-section"><div class="wrap">',
		'after' => '</div></div>',
	) );
	return ob_get_clean();
}