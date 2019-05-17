<?php
function wpf_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'wpf_logo' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpf_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'wpf' ),
        'section'  => 'title_tagline',
        'settings' => 'wpf_logo',
    ) ) );
	
    $wp_customize->add_setting( 'wpf_header_background' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpf_header_background', array(
        'label'    => __( 'Header Background Image', 'wpf' ),
        'section'  => 'title_tagline',
        'settings' => 'wpf_header_background',
    ) ) );
	
    $wp_customize->add_setting( 'fallback_thumbnail' ); // Add setting for logo uploader
	     
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fallback_thumbnail', array(
        'label'    => __( 'Fallback thumbnail', 'wpf' ),
        'section'  => 'title_tagline',
        'settings' => 'fallback_thumbnail',
    ) ) );
	
	$wp_customize->add_section('custom_theme_settings' , array(
		'title'     => __('Custom Settings', 'wpf'),
		'priority'  => 1020
	));

	$wp_customize->add_setting('show_searchbox_header', array(
		'default'    => '1'
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_searchbox_header',
			array(
				'label'     => __('Show Searchbox in header', 'wpf'),
				'section'   => 'custom_theme_settings',
				'settings'  => 'show_searchbox_header',
				'type'      => 'checkbox',
			)
		)
	);
	
	$wp_customize->add_section( 'wpf_theme_colors', array(
		'title' => __( 'Theme Colors', 'wpf' ),
		'priority' => 100,
	) );
	
	// add color picker setting
	$wp_customize->add_setting( 'primary_color', array(
		'default' => '#333333'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label' =>   __( 'Primary Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'primary_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'primary_text_color', array(
		'default' => '#FFFFFF'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_text_color', array(
		'label' =>   __( 'Primary Text Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'primary_text_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'secondary_color', array(
		'default' => '#e74c3c'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
		'label' =>   __( 'Secondary Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'secondary_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default' => '#FFFFFF'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label' =>   __( 'Secondary Text Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'secondary_text_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'link_color', array(
		'default' => '#e74c3c'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label' =>   __( 'Link Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'link_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'link_hover_color', array(
		'default' => '#CE3323'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label' =>  __( 'Link Hover Color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'link_hover_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'text_color', array(
		'default' => '#000000'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label' => __( 'Default text color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'text_color',
	) ) );
	
	// add color picker setting
	$wp_customize->add_setting( 'body_background_color', array(
		'default' => '#FFFFFF'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background_color', array(
		'label' => __( 'Website background color', 'wpf' ),
		'section' => 'wpf_theme_colors',
		'settings' => 'body_background_color',
	) ) );
}
add_action( 'customize_register', 'wpf_customize_register' );
?>