<aside id="sidebar" class="sidebar cell small-12 medium-shrink">
    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
        <div id="primary" class="widget-area">
            <?php dynamic_sidebar( 'primary-widget-area' ); ?>
        </div>
    <?php endif; ?>
</aside>