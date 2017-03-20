<?php
/**
 * 
 * this file is designed to provide specific functions for the child theme
 *
 * @package    clea-2-IB
 * @subpackage Functions
 * @version    1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2015 Anne-Laure Delpech
 * @link       
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/* !!!! Do NOT include or require other php files !!!! */
// this will break the json parse for the quiz... 


// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'clea_ib_theme_setup', 11 ); 

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'clea-ib-inter', 800, 800, false ) ;
	add_image_size( 'clea-ib-full', 1200, 1200, false ) ;
}

add_filter( 'image_size_names_choose', 'clea_ib_image_size_names_choose' );

// add meta boxes for sections of front page
add_action( 'add_meta_boxes', 'clea_ib_frontpage_meta_box' );
add_action( 'save_post', 'clea_ib_save_meta_box_data' );

function clea_ib_theme_setup() {

	/* Register and load styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'clea_ib_enqueue_styles_scripts', 4 ); 
	/* Set content width. */
	hybrid_set_content_width( 1200 );

	// Sets the 'post-thumbnail' size.
	set_post_thumbnail_size( 175, 131, true );

	register_nav_menus(
		array(
		  'subsidiary' => __( 'Subsidiary' )
		)
	);

}

function clea_ib_custom_logo() {
	
	// change default logo size
	$args = array(
    	'height' => 90,
    	'width' => 97,
    );
    add_theme_support( 'custom-logo', $args );	
	
}

function clea_ib_image_size_names_choose( $sizes ) {

	$addsizes = array(
	"clea-ib-inter" => __( "taille intermédiaire", 'clea-2-IB'),
	"clea-ib-full"	=> __( "Pleine page", 'clea-2-IB')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}

 
function clea_ib_enqueue_styles_scripts() {
	// feuille de style pour l'impression
	wp_enqueue_style( 'clea-fz-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );
	// style pour le site IB
	wp_enqueue_style( 'clea-fz', get_stylesheet_directory_uri() . '/css/clea-fz-style.css', array(), false, 'all' );
	
	// pour la page d'accueil uniquement
	if( is_front_page() ) {
		
		wp_enqueue_style( 'clea-fz-front-page', get_stylesheet_directory_uri() . '/css/clea-fz-front-page.css', array(), false, 'all' );
	}
	
	// font awesome CDN
	wp_enqueue_script( 'clea-ib-font-awesome', 'https://use.fontawesome.com/1dcb7878fd.js', false );
	
}

/**********************************************
* display 1 metaboxe with 4 editors on frontpage
* source http://help4cms.com/add-wysiwyg-editor-in-wordpress-meta-box/
* https://premium.wpmudev.org/blog/creating-meta-boxes/
**********************************************/

function clea_ib_frontpage_meta_box( $post ){

	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	// check for a template type
	if ($template_file == 'page/IB-home-page-template.php') {

		add_meta_box( 
			'edit_sections', 					
			__( "Editer les sections de la page d'accueil", 'clea-2-IB' ), 
			'clea_ib_custom_meta_box', 
			'page', 'normal', 
			'low' 
		);
		
		// remove default editor 
		// http://wordpress.stackexchange.com/questions/31991/is-it-possible-to-remove-the-main-rich-text-box-editor
		remove_post_type_support( 'page', 'editor' );

	}
}


function clea_ib_custom_meta_box( $post ){

	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'edit_sections_nonce' );

	$sections = array(
		'1',
		'2',
		'3',
		'4',
		'5',
	) ;

	?>
	<div class='inside'>
	<?php
	foreach( $sections as $section ) {

	$field = "section_" . $section ;
	$data =  "_section_" . $section ;
	
	$settings = array(
		"media_buttons" => true,
		"wpautop"		=> false
	) ;
	
	
	// keeps all html 
	$content = wp_kses_decode_entities( get_post_meta( $post->ID, $data, true ) );
	
	echo "<h3>" . __( 'Section ', 'clea-2-IB' ) . $section . "</h3>" ;

		wp_editor(
			$content ,
			$field, 
			$settings
		);		
		
	}
		
	?>
	</div>
	<?php
}



function clea_ib_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['edit_sections_nonce'] ) || !wp_verify_nonce( $_POST['edit_sections_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	
	$section_1 = $_POST['section_1'];
	$section_2 = $_POST['section_2'];	
	$section_3 = $_POST['section_3'];	
	$section_4 = $_POST['section_4'];
	$section_5 = $_POST['section_5'];	
	
	// store section_1
	if ( isset( $_REQUEST['section_1'] ) ) {
		update_post_meta( $post_id, '_section_1', $section_1 ) ;
	}	
	
	// store section_2
	if ( isset( $_REQUEST['section_2'] ) ) {
		update_post_meta( $post_id, '_section_2', $section_2 );
	}	

	// store section_3
	if ( isset( $_REQUEST['section_3'] ) ) {
		update_post_meta( $post_id, '_section_3', $section_3 );
	}

	// store section_4
	if ( isset( $_REQUEST['section_4'] ) ) {
		update_post_meta( $post_id, '_section_4', $section_4 );
	}	

		// store section_5
	if ( isset( $_REQUEST['section_5'] ) ) {
		update_post_meta( $post_id, '_section_5', $section_5 );
	}	
	
}

// add breadcrumb trail to the strong testimonials single posts
// add_filter( 'breadcrumb_trail_items', 'clea_ib_breadcrumb_trail_items' );

function clea_ib_breadcrumb_trail_items( $items ) {
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