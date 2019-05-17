<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="header hero-header" <?php if ( has_post_thumbnail() ) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); echo 'style="background-image: url(\''. $thumb['0'] .'\');"'; } ?>>
                                <div class="grid-x grid-padding-x">
                                    <h1 class="entry-title small-12">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </h1>
                                    <div class="small-12 text-left">
                                        <?php get_template_part( 'entry', 'meta' ); ?>
                                    </div>
                                </div>
                            </header>
                            <?php get_template_part('entry', 'content'); ?>
                            <?php get_template_part( 'entry-footer' ); ?>
                        </article>

                        <?php if ( comments_open() && ! post_password_required() ) { comments_template( '', true ); } ?>
                <?php endwhile; endif; ?>
                <footer class="footer">
                <?php get_template_part( 'nav', 'below-single' ); ?>
                </footer>
            </main>
            <?php get_sidebar(); ?>
        </div>
    </div>  
</section>
<?php get_footer(); ?>