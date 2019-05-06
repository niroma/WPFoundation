<?php

add_action( 'after_setup_theme', 'wpfoundation_setup' );
function wpfoundation_setup() {
	load_theme_textdomain( 'wpfoundation', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );
	global $content_width;
	global $current_class;
	if ( ! isset( $content_width ) ) { $content_width = 1920; }
	register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'wpfoundation' ) ) );
}

add_action( 'wp_enqueue_scripts', 'wpfoundation_load_scripts' );
function wpfoundation_load_scripts() {
	wp_enqueue_style( 'wpfoundation-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
}

if ( ! is_admin() ) add_action( 'wp_enqueue_scripts', 'theme_load_scripts' );
function theme_load_scripts() {
		wp_deregister_script('jquery');
		wp_deregister_script('jquery-core');
		
		if (defined('WP_DEBUG') && true === WP_DEBUG) {
			wp_register_script('jquery-core', get_template_directory_uri() . '/assets/js/app.js', false, rand());
		} else {
			wp_register_script('jquery-core', get_template_directory_uri() . '/assets/js/app.js');
		}

		$translations = array(
			'loading' => __( 'Loading', 'amazon' )
		);
		wp_localize_script( 'jquery-core', 'translation', $translations );	
		wp_localize_script( 'jquery-core', 'do_ajax',  array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_script('jquery-core', false, '', true);
		wp_register_script( 'jquery', false, array( 'jquery-core' ), false, true );
}

add_filter( 'document_title_separator', 'wpfoundation_document_title_separator' );
function wpfoundation_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'wpfoundation_title' );
function wpfoundation_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'wpfoundation_read_more_link' );
function wpfoundation_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'wpfoundation_excerpt_read_more_link' );
function wpfoundation_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'wpfoundation_image_insert_override' );
function wpfoundation_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'wpfoundation_widgets_init' );
function wpfoundation_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'wpfoundation' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'wpfoundation_pingback_header' );
function wpfoundation_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'wpfoundation_enqueue_comment_reply_script' );
function wpfoundation_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function wpfoundation_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'wpfoundation_comment_count', 0 );
function wpfoundation_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

function oddeven_post_class ( $classes ) {
   global $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   $classes[] = $current_class;
   return $classes;
}
add_filter ( 'post_class' , 'oddeven_post_class' );

include_once('components/menu_walker.php');
include_once('components/theme-customizer.php');
include_once('components/thumbnails.php');
include_once('components/sidebars.php');