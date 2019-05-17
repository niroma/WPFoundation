<article id="post-<?php the_ID(); ?>" <?php post_class('grid-x'); ?>>
    <?php 
        $order = ( $wp_query->current_post % 2 == 0 ) ? 1 : 2;
		$order2 = ( $wp_query->current_post % 2 == 0 ) ? 2 : 1;
	?>
    <div class="small-12 medium-6 small-order-1 medium-order-<?php echo $order; ?>">
        <?php $post_id = get_the_ID(); 
            $thumb = get_the_post_thumbnail($post_id, 'medium', array( 'property' => 'image' )); if (!empty($thumb)) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $thumb; ?></a>
        <?php endif; ?>
    </div>
    <div class="small-12 medium-6 small-order-<?php echo $order2; ?>">
        <header>
        	<h2 class="entry-title">
        		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
            	</a>
            </h2>
        </header>
    	<div class="entry-summary">
			<?php the_excerpt(); ?>
            <?php if ( is_search() ) { ?>
            	<div class="entry-links"><?php wp_link_pages(); ?></div>
            <?php } ?>
    	</div>
	</div>
</article>