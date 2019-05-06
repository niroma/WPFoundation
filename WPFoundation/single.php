<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'entry' ); ?>
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