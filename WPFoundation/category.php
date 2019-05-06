<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <header class="header">
                	<h1 class="entry-title"><?php single_term_title(); ?></h1>
                	<div class="archive-meta"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>
                </header>
				<?php $counter = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); $counter++; ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('grid-x article-preview'); ?>>
                        <?php $order = ( $counter % 2 == 0 ) ? 1 : 2;
                            $order2 = ( $counter % 2 == 0 ) ? 2 : 1;
                        ?>
                        <?php /* <div class="small-12 medium-6 small-order-1 medium-order-<?php echo $order; ?> thumbBox"> */ ?>
                            <?php $post_id = get_the_ID(); 
                                $thumb = get_the_post_thumbnail($post_id, 'medium', array( 'property' => 'image' )); if (!empty($thumb)) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="small-12 medium-6 small-order-1 medium-order-<?php echo $order; ?> thumbBox">
										<?php echo $thumb; ?>
                                    </a>
                            <?php endif; ?>
                        <?php /* </div> */ ?>
                        <div class="small-12 medium-auto small-order-<?php echo $order2; ?>">
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
                <?php endwhile; endif; ?>
                <?php get_template_part( 'nav', 'below' ); ?>
            </main>
            <?php get_sidebar(); ?>
        </div>
    </div>  
</section>
<?php get_footer(); ?>