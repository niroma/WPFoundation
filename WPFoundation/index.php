<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'entry' ); ?>
                    <?php comments_template(); ?>
                <?php endwhile; endif; ?>
                <?php get_template_part( 'nav', 'below' ); ?>
            </main>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>