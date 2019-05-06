<?php get_header(); ?>
<section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <main id="content" class="cell auto">
                <header class="header">
                	<h1 class="entry-title"><?php single_term_title(); ?></h1>
                	<div class="archive-meta"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>
                </header>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
                <?php endwhile; endif; ?>
                <?php get_template_part( 'nav', 'below' ); ?>
            </main>
            <?php get_sidebar(); ?>
        </div>
    </div>  
</section>
<?php get_footer(); ?>