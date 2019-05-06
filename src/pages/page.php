<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="header hero-header"<?php if ( has_post_thumbnail() ) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); echo 'style="background-image: url(\''. $thumb['0'] .'\');"'; } ?>>
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>
                        <div class="entry-content">
                            <?php //if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
                            <?php the_content(); ?>
                            <div class="entry-links"><?php wp_link_pages(); ?></div>
                        </div>
                    </article>
                    <?php if ( comments_open() && ! post_password_required() ) { comments_template( '', true ); } ?>
                <?php endwhile; endif; ?>
            </main>
            <?php get_sidebar(); ?>
        </div>
    </div>  
</section>
<?php get_footer(); ?>