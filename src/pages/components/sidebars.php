<?php 
add_action( 'widgets_init', 'wpf_init_sidebars' );
function wpf_init_sidebars() {
    register_sidebar( array(
        'name' => __( 'widgetized-footer-multi-columns', 'wpf' ),
        'id' => 'widgetized-footer-multi-columns',
        'description' => __( 'Multi columns footer widget area.', 'wpf' ),
        'before_widget' => '<div id="%1$s" class="cell medium-auto small-12 widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>',
    ) );
}