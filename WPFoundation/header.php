<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>




<header class="header">
	<hgroup class="header-title">
					<?php if ( get_theme_mod( 'wpf_logo' ) ) : ?>
                        <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1 class="logo">'; } else { echo '<div class="logo">'; } ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                <img src="<?php echo get_theme_mod( 'wpf_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                            </a>
                        <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } else { echo '</div>'; }  ?>
                    <?php else : ?>
                            <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1 class="logo">'; } else { echo '<div class="logo">'; } ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                            <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } else { echo '</div>'; }  ?>
                            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                    <?php endif; ?>	
  </hgroup>
</header>


<nav class="navigation" data-sticky-container>
	<div data-sticky data-options="marginTop:0;" data-top-anchor="300" data-sticky-on="small">
		<div class="title-bar hide-for-medium" data-responsive-toggle="responsive-menu">
			<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
			<div class="title-bar-title"><?php echo __('Menu', 'wpf'); ?></div>
		</div>

		<div class="top-bar" id="responsive-menu">
			<div class="top-bar-left">
				<?php if ( has_nav_menu( 'main-menu' ) ) {
							wp_nav_menu( array( 
                'container'       => false,
								'theme_location'  => 'main-menu',
                'menu_class'      => 'menu vertical medium-horizontal dropdown',
                'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
								'walker'          => new wpf_nav_menu_walker
							) );
				} ?>
			</div>
			<div class="top-bar-right">
				<ul class="menu">
					<li>
						<a href="#">Icons</a>
					</li>
				</ul>
			</div>
		</div>	
	</div>
</nav>



