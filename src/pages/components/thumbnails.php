<?php 

// Smart Thumbnail
add_filter( 'post_thumbnail_html', 'wpf_post_thumbnail', 20, 5 );
function wpf_post_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	$wpfThumbnail = '';
	$postTitle = esc_html( get_the_title( $post_id ) );
	$wpfThumbnailUrl = '';

	if ($html) {
		//return post thumbnail url if post thumbnail exists
		$wpfThumbnailUrl = get_the_post_thumbnail_url($post_id,$size);
	} else {
		//Try to catch first post image
        $args = array(
            'numberposts' => 1,
            'order' => 'ASC',
            'post_mime_type' => 'image',
            'post_parent' => $post_id,
            'post_status' => null,
            'post_type' => 'attachment',
        );

        $images = get_children($args);
        if ($images) {
            foreach ($images as $image) {
				if ( wp_get_attachment_image_src( $image->ID, $size, false ) ) {
					$attachment = wp_get_attachment_image_src( $image->ID, $size, false );
					$wpfThumbnailUrl = $attachment[0];
				}
                //return wp_get_attachment_image($image->ID, $size,false,$attr);
            }
        } else if ( get_theme_mod( 'fallback_thumbnail' ) ){
			$wpfThumbnailUrl = get_theme_mod( 'fallback_thumbnail' );
        }
    } 
	if (!empty($wpfThumbnailUrl)) {
		$wpfThumbnail .= '<img src="'. $wpfThumbnailUrl .'"';
		if (!empty( get_option( $size.'_size_h' ) ) ) $wpfThumbnail .= ' height="'. get_option( $size.'_size_h' ) .'"';
		if (!empty( get_option( $size.'_size_w' ) ) ) $wpfThumbnail .= ' width="'. get_option( $size.'_size_w' ) .'"';
		if (!empty($attr['class'])) $wpfThumbnail .= ' class="photo '. $attr['class'] .'"';
		if (!empty($attr['property'])) $wpfThumbnail .= ' property="'. $attr['property'] .'"';
		$wpfThumbnail .= ' alt="'. $postTitle .'"';
		$wpfThumbnail .= ' />';
		//$wpfThumbnail .= '<span vocab="http://schema.org/" typeof="ImageObject"><meta property="url" content="'. $wpfThumbnailUrl .'" /></span>';
	}
	return $wpfThumbnail;
}

/*
function get_category_thumbnail_url( $catId, $size = 'medium' ) {
	$image_id = get_term_meta( $catId, 'image', true );
	$wpfThumbnailUrl = '';
	if (!empty($image_id) ) {
		$image_data = wp_get_attachment_image_src( $image_id, $size, false );
		$wpfThumbnailUrl = $image_data[0];
	} else {
		$args = array(
			'posts_per_page' => 1,
			'meta_key' => '_thumbnail_id',
			'cat' => $catId
		);
		$latest_thumb = new WP_Query( $args );
		if ( $latest_thumb->have_posts() ) $wpfThumbnailUrl = get_the_post_thumbnail_url( $latest_thumb->post->ID, $size);
		wp_reset_query();
	}
	return $wpfThumbnailUrl;
}
*/
?>