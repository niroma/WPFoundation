<?php /*
</div>
<footer id="footer">
<div id="copyright">
&copy; <?php echo esc_html( date_i18n( __( 'Y', 'wpfoundation' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
</div>
</footer>
</div>
*/ ?>


<section>
	<div class="grid-container">
		<div class="grid-x grid-padding-x">

            <div class="simple-subscription-form cell small-12">
              <form>
                <h4><i class="fas fa-paper-plane"></i> Subscribe</h4>
				<div class="grid-x grid-padding-x">
                	<div class="cell medium-auto small-12">
						<p>Receive updates and latest news direct from our team. Simply enter your email below :</p>
                    </div>
                	<div class="cell medium-auto small-12">
						<div class="grid-x grid-padding-x">
							<div class="cell auto">
								<input type="email" placeholder="Email" required>
							</div>
							<div class="cell shrink">
								<button class="button">Sign up now</button>
							</div>
						</div>
                    </div>
                </div>
              </form>
            </div>
            
		</div>
	</div>
</section>


<?php if ( is_active_sidebar( 'widgetized-footer-multi-columns' ) ) : ?>
    <section class="multi-columns-footer">
        <div class="grid-container">
            <div class="grid-x grid-padding-x widget-area">
                <?php dynamic_sidebar( 'widgetized-footer-multi-columns' ); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="grid-x grid-padding-y">
	<div class="cell auto text-center">
		<small>
			&copy; 
			<?php echo date("Y"); ?> 
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
			| 
			<?php echo __('Powered by', 'wpfoundation'); ?> <a href="https://github.com/niroma/WPFoundation">WPFoundation</a>
		</small>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>