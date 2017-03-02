<?php
/**
 * 
 * this file is designed to provide specific functions for the child theme
 *
 * @package    clea-2-base
 * @subpackage Functions
 * @version    1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2015 Anne-Laure Delpech
 * @link       
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'c2b_theme_setup', 11 ); 

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'clea-fz-inter', 800, 800, false ) ;
	add_image_size( 'clea-fz-full', 1200, 1200, false ) ;
}

add_filter( 'image_size_names_choose', 'clea_fz_image_size_names_choose' );


function c2b_theme_setup() {

	// Add support for the Wordpress custom-Logo 
	// see https://codex.wordpress.org/Theme_Logo
	add_theme_support( 'custom-logo', array(
		'height'      => 78,
		'width'       => 150,
		'flex-width'  => true,
	) );
	
	// add featured images to rss feed
	add_filter('the_excerpt_rss', 'c2b_featuredtoRSS');
	add_filter('the_content_feed', 'c2b_featuredtoRSS');

	// add breadcrumb trail to the strong testimonials single posts
	// add_filter( 'breadcrumb_trail_items', 'clea_fz_breadcrumb_trail_items' );
	
}
 
function clea_fz_image_size_names_choose( $sizes ) {

	$addsizes = array(
	"clea-fz-inter" => __( "taille intermédiaire", 'clea-2-FZ'),
	"clea-fz-full"	=> __( "Pleine page", 'clea-2-FZ')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}

 
function clea_fz_enqueue_styles_scripts() {
	// feuille de style pour l'impression
	wp_enqueue_style( 'clea-fz-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );
	// style pour le site IB
	wp_enqueue_style( 'clea-fz', get_stylesheet_directory_uri() . '/css/clea-fz-style.css', array(), false, 'all' );
	
	// pour la page d'accueil uniquement
	if( is_front_page() ) {
		
	}

	// font awesome CDN
	wp_enqueue_script( 'clea-ib-font-awesome', 'https://use.fontawesome.com/1dcb7878fd.js', false );
	
} 

	
function c2b_featuredtoRSS( $content ) {
	// https://woorkup.com/show-featured-image-wordpress-rss-feed/
	
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px; margin-right: 15px; float: left;' ) ) . '</div>' . $content;
	}
	
	return $content;
}


function clea_fz_breadcrumb_trail_items( $items ) {
	// http://themehybrid.com/board/topics/filter-breadcrumb_trail_args-syntax-for-2-arguments
	// http://themehybrid.com/board/topics/display-blog-in-breadcrumbs
	
	if( is_post_type( 'wpm-testimonial' ) )  {			

		$blog_id = absint( get_option( 'page_for_posts' ) );

		if ( 0 < $blog_id ) {

			$new_items = array();

			// Shifts the "home" item off of original array.
			$new_items[] = array_shift( $items );

			$new_items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $blog_id ) ), esc_html( get_the_title( $blog_id ) ) );

			$items = array_merge( $new_items, $items );
		}
	}
		

	return $items;
}


?>