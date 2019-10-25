<?php
/**
 * khaown: Customizer
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function khaown_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'khaown_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'khaown_customize_partial_blogdescription',
			)
		);
	}


	/**
	 * Background color.
	 */
	// add the settings and controls for each color
	// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
	$bgcolors[] = array(
		'slug'=>'bg_color_scheme_1', 
		'default' => '#ffffff',
		'label' => 'Body Background Color'
	);
	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$bgcolors[] = array(
		'slug'=>'button_bg_color', 
		'default' => '#292929',
		'label' => 'Button Background Color'
	);

	// link color
	$bgcolors[] = array(
		'slug'=>'text_color', 
		'default' => '#545454',
		'label' => 'Text Color'
	);

	// link color
	$bgcolors[] = array(
		'slug'=>'link_color', 
		'default' => '#545454',
		'label' => 'Link Color'
	);
	
	// link color ( hover, active )
	$bgcolors[] = array(
		'slug'=>'hover_link_color', 
		'default' => '#a0a0a0',
		'label' => 'Link Color (on hover)'
	);

	foreach( $bgcolors as $txtcolor ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' => $txtcolor['default'],
				'type' => 'theme_mod',
				'sanitize_callback'  => 'esc_attr'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$txtcolor['slug'], 
				array('label' => $txtcolor['label'], 
				'section' => 'colors',
				'settings' => $txtcolor['slug'])
			)
		);
	}

	/**************************************
	 * // Layout Design Section setup
	**************************************/
	
	$wp_customize->add_section('layout_design', array(
		'title'			=> __('Layout', 'khaown'),
		'description'	=> sprintf(__('Customize your layout desing', 'khaown') ),
		'priority' 		=> 41
	) );

	// flat_or_deep_design setting setup
	$wp_customize->add_setting('flat_or_deep_design', array(
		'default'			=> __('flat_design', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// flat_or_deep_design Control setup
	$wp_customize->add_control('flat_or_deep_design', array(
		'label'			=> __('Choose Design Type', 'khaown'),
		'type'			=> 'radio',
		'choices'   => array(
			'flat_design' => __( 'Flat Design', 'khaown' ),
			'deep_design' => __( 'Deep Design', 'khaown' )
		),
		'section' 		=> 'layout_design',
		'priority' 		=>  20
	) );
	// Border setting setup
	$wp_customize->add_setting('border_design', array(
		'default'			=> __('border_none', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// Border Control setup
	$wp_customize->add_control('border_design', array(
		'label'			=> __('Box Border', 'khaown'),
		'type'			=> 'radio',
		'choices'   => array(
			'has_border' => __( 'Has Border', 'khaown' ),
			'border_none' => __( 'Border None', 'khaown' )
		),
		'section' 		=> 'layout_design',
		'priority' 		=>  20
	) );

	// Border Radius setting setup
	$wp_customize->add_setting('border_radius', array(
		'default'			=> __( 0, 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// Border Radius Control setup
	$wp_customize->add_control('border_radius', array(
		'label'			=> __('Border Radius', 'khaown'),
		'type'			=> 'number',
		'section' 		=> 'layout_design',
		'priority' 		=>  20
	) );

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$index_bgcolors[] = array(
		'slug'=>'sidebar_background_color', 
		'default' => '#f8f8f8',
		'label' => 'Posts Background Color'
	);

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$index_bgcolors[] = array(
		'slug'=> 'veriant_posts_background_color', 
		'default' => '#333347',
		'label' => 'Veriant Posts Background Color'
	);
	
	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$index_bgcolors[] = array(
		'slug'=> 'veriant_posts_text_color', 
		'default' => '#d2d2d2',
		'label' => 'Veriant Posts Text Color'
	);

	foreach( $index_bgcolors as $index_bg_color ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$index_bg_color['slug'], array(
				'default' => $index_bg_color['default'],
				'type' => 'theme_mod',
				'sanitize_callback'  => 'esc_attr'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$index_bg_color['slug'], 
				array('label' => $index_bg_color['label'], 
				'section' => 'layout_design',
				'priority' 		=>  20,
				'settings' => $index_bg_color['slug']),
				
			)
		);
	}

	/**************************************
	 * Sidebar Layout Section setup
	**************************************/
	$wp_customize->add_panel('sidebar_layout_panel', array(
        'theme_supports' => '',
		'title'			=> __('Sidebar', 'khaown'),
		'description'	=> sprintf(__('Setup your theme Top header', 'khaown') ),
		'priority' 		=> 42
    ) );
	
	$wp_customize->add_section('blogpage_sidebar_layout', array(
		'title'			=> __('Blog Page Sidebar', 'khaown'),
		'panel'          => 'sidebar_layout_panel',
		'priority' 		=> 41
	) );

	// Blog page sidebar setting setup
	$wp_customize->add_setting('blog_page_sidebar_position', array(
		'default'			=> __('right_sidebar', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// Blog page sidebar Control setup
	$wp_customize->add_control('blog_page_sidebar_position', array(
		'label'			=> __('Sidebar', 'khaown'),
		'section' 		=> 'blogpage_sidebar_layout',
		'type'			=> 'select',
		'choices'  => array(
			'no_sidebar' => _x( 'No Sidebar', 'no_sidebar', 'khaown' ),
			'left_sidebar' => _x( 'Left Sidebar', 'left_sidebar', 'khaown' ),
			'right_sidebar' => _x( 'Right Sidebar', 'right_sidebar', 'khaown' ),
		),
		'priority' 		=>  20
	) );

	// Section search page sidebar
	$wp_customize->add_section('search_page_sidebar_layout', array(
		'title'			=> __('Search Page Sidebar', 'khaown'),
		'panel'          => 'sidebar_layout_panel',
		'priority' 		=> 41
	) );

	// Search page sidebar setting setup
	$wp_customize->add_setting('search_page_sidebar_position', array(
		'default'			=> __('no_sidebar', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// Search page sidebar Control setup
	$wp_customize->add_control('search_page_sidebar_position', array(
		'label'			=> __('Sidebar', 'khaown'),
		'section' 		=> 'search_page_sidebar_layout',
		'type'			=> 'select',
		'choices'  => array(
			'no_sidebar' => _x( 'No Sidebar', 'no_sidebar', 'khaown' ),
			'left_sidebar' => _x( 'Left Sidebar', 'left_sidebar', 'khaown' ),
			'right_sidebar' => _x( 'Right Sidebar', 'right_sidebar', 'khaown' ),
		),
		'priority' 		=>  20
	) );

	// Section archive page sidebar
	$wp_customize->add_section('archive_page_sidebar_layout', array(
		'title'			=> __('Archive Page Sidebar', 'khaown'),
		'panel'          => 'sidebar_layout_panel',
		'priority' 		=> 41
	) );

	// archive page sidebar setting setup
	$wp_customize->add_setting('archive_page_sidebar_position', array(
		'default'			=> __('no_sidebar', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// archive page sidebar Control setup
	$wp_customize->add_control('archive_page_sidebar_position', array(
		'label'			=> __('Sidebar', 'khaown'),
		'section' 		=> 'archive_page_sidebar_layout',
		'type'			=> 'select',
		'choices'  => array(
			'no_sidebar' => _x( 'No Sidebar', 'no_sidebar', 'khaown' ),
			'left_sidebar' => _x( 'Left Sidebar', 'left_sidebar', 'khaown' ),
			'right_sidebar' => _x( 'Right Sidebar', 'right_sidebar', 'khaown' ),
		),
		'priority' 		=>  20
	) );

	/**************************************
	 * // Typography Section setup
	**************************************/
	
	$wp_customize->add_section('typography', array(
		'title'			=> __('Typography', 'khaown'),
		'description'	=> sprintf(__('Setup your theme typography', 'khaown') ),
		'priority' 		=> 43
	) );

	// default_or_customfont setting setup
	$wp_customize->add_setting('default_or_customfont', array(
		'default'			=> __('default_font', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// default_or_customfont Control setup
	$wp_customize->add_control('default_or_customfont', array(
		'label'			=> __('Choose Font Family', 'khaown'),
		'type'			=> 'radio',
		'choices'   => array(
			'default_font' => __( 'Default Font', 'khaown' ),
			'custom_font' => __( 'Custom Font', 'khaown' )
		),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );

	// font_family setting setup
	$wp_customize->add_setting('font_family', array(
		'default'			=> __("Rajdhani", 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );


	// font_family Control setup
	$wp_customize->add_control('font_family', array(
		'type'     => 'textarea',
		'label'    => __( 'Copy Font Family From fonts.google.com', 'khaown' ),
		'section'  => 'typography',
		'priority' 		=>  20
	) );

	// paragraph_font_style setting setup
	$wp_customize->add_setting('paragraph_font_style', array(
		'default'			=> __('normal', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_font_style Control setup
	$wp_customize->add_control('paragraph_font_style', array(
		'label'			=> __('Font Style', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'select',
		'choices'  => array(
			'normal' => _x( 'Normal', 'normal', 'khaown' ),
			'italic'  => _x( 'Italic', 'italic', 'khaown' )
		),
		'priority' 		=>  20
	) );

	// paragraph_text_transform setting setup
	$wp_customize->add_setting('paragraph_text_transform', array(
		'default'			=> __('none', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_text_transform Control setup
	$wp_customize->add_control('paragraph_text_transform', array(
		'label'			=> __('Text Transform', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'select',
		'choices'  => array(
			'none' => _x( 'Default', 'default', 'khaown' ),
			'uppercase' => _x( 'Uppercase', 'uppercase', 'khaown' ),
			'lowercase'  => _x( 'Lowercase', 'lowercase', 'khaown' ),
			'capitalize'  => _x( 'Capitalize', 'capitalize', 'khaown' ),
		),
		'priority' 		=>  20
	) );

	// paragraph_font_size setting setup
	$wp_customize->add_setting('paragraph_font_size', array(
		'default'			=> __('14', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_font_size Control setup
	$wp_customize->add_control('paragraph_font_size', array(
		'label'			=> __('Font Size', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'number',
		'priority' 		=>  20
	) );

	// paragraph_font_weight setting setup
	$wp_customize->add_setting('paragraph_font_weight', array(
		'default'			=> __('300', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_font_weight Control setup
	$wp_customize->add_control('paragraph_font_weight', array(
		'label'			=> __('Font Weight', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'select',
		'choices'  => array(
			'100' => _x( '100', '100', 'khaown' ),
			'200'  => _x( '200', '200', 'khaown' ),
			'300'  => _x( '300', '300', 'khaown' ),
			'400' => _x( '400', '400', 'khaown' ),
			'500'  => _x( '500', '500', 'khaown' ),
			'600'  => _x( '600', '600', 'khaown' ),
			'700'  => _x( '700', '700', 'khaown' ),
		),
		'priority' 		=>  20
	) );

	// paragraph_line_height setting setup
	$wp_customize->add_setting('paragraph_line_height', array(
		'default'			=> __('24', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_line_height Control setup
	$wp_customize->add_control('paragraph_line_height', array(
		'label'			=> __('Line Height', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'number',
		'priority' 		=>  20
	) );

	// paragraph_letter_spacing setting setup
	$wp_customize->add_setting('paragraph_letter_spacing', array(
		'default'			=> __('0', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_letter_spacing Control setup
	$wp_customize->add_control('paragraph_letter_spacing', array(
		'label'			=> __('Letter Spacing', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'number',
		'priority' 		=>  20
	) );

	// paragraph_word_spacing setting setup
	$wp_customize->add_setting('paragraph_word_spacing', array(
		'default'			=> __('0', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// paragraph_word_spacing Control setup
	$wp_customize->add_control('paragraph_word_spacing', array(
		'label'			=> __('Word Spacing', 'khaown'),
		'section' 		=> 'typography',
		'type'			=> 'number',
		'priority' 		=>  20
	) );


	/**********************************
		Heading Section setup
	*********************************/
	$wp_customize->add_section('heading', array(
		'title'			=> __('Heading', 'khaown'),
		'description'	=> sprintf(__('Setup your theme heading', 'khaown') ),
		'priority' 		=> 44
	) );

	// Heading setting setup
	$wp_customize->add_setting('heading_1_text_case', array(
		'default'			=> __('uppercase', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_text_case', array(
		'type'     => 'select',
		'label'    => __( 'Heading Text Case', 'khaown' ),
		'choices'  => array(
			'none' => _x( 'Default', 'default', 'khaown' ),
			'uppercase' => _x( 'Uppercase', 'uppercase', 'khaown' ),
			'lowercase'  => _x( 'Lowercase', 'lowercase', 'khaown' ),
			'capitalize'  => _x( 'Capitalize', 'capitalize', 'khaown' ),
		),
		'section'  => 'heading',
		'priority' 		=>  20
	) );

	// SETTINGS
	$wp_customize->add_setting('heading_text_color', array(
		'default'			=> __('#7a7a7a', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'heading_text_color', 
			array(
				'label'			=> __('Heading Text Color', 'khaown'),
				'section' 		=> 'heading',
				'priority' 		=>  20
			)
		)
	);
	// Heading setting setup
	$wp_customize->add_setting('heading_1_letter_spacing', array(
		'default'			=> __('1', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_letter_spacing', array(
		'label'			=> __('Heading Letter Spacing', 'khaown'),
		'section' 		=> 'heading',
		'type'			=> 'number',
		'priority' 		=>  20
	) );

	// Heading setting setup
	$wp_customize->add_setting('heading_wordspecing_spacing', array(
		'default'			=> __('0', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_wordspecing_spacing', array(
		'label'			=> __('Heading Word Spacing', 'khaown'),
		'section' 		=> 'heading',
		'type'			=> 'number',
		'priority' 		=>  20
	) );
	
	
	// Heading setting setup
	$wp_customize->add_setting('heading_1_font_weight', array(
		'default'			=> __('300', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_font_weight', array(
		'type'     => 'select',
		'label'    => __( 'Heading Font Weight', 'khaown' ),
		'choices'  => array(
			'100' => _x( '100', '100', 'khaown' ),
			'200'  => _x( '200', '200', 'khaown' ),
			'300'  => _x( '300', '300', 'khaown' ),
			'400' => _x( '400', '400', 'khaown' ),
			'500'  => _x( '500', '500', 'khaown' ),
			'600'  => _x( '600', '600', 'khaown' ),
			'700'  => _x( '700', '700', 'khaown' ),
		),
		'section'  => 'heading',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_1_font_size', array(
		'default'			=> __('28', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_font_size', array(
		'label'			=> __('H1 Font Size', 'khaown'),
		'section' 		=> 'heading',
		'type'			=> 'number',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_1_line_height', array(
		'default'			=> __( '36', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_line_height', array(
		'type'     => 'number',
		'label'    => __( 'H1 Line Height', 'khaown' ),
		'section'  => 'heading',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_h2_font_size', array(
		'default'			=> __('24', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_h2_font_size', array(
		'label'			=> __('H2 Font Size', 'khaown'),
		'section' 		=> 'heading',
		'type'			=> 'number',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_h2_line_height', array(
		'default'			=> __( '32', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_h2_line_height', array(
		'type'     => 'number',
		'label'    => __( 'H2 Line Height', 'khaown' ),
		'section'  => 'heading',
		'priority' 		=>  20
	) );


	/**********************************
		Navigation Bar Section setup
	*********************************/
	$wp_customize->add_section('nav_bar', array(
		'title'			=> __('Navigation Bar', 'khaown'),
		'description'	=> sprintf(__('Setup your theme Navigation', 'khaown') ),
		'priority' 		=> 45
	) );

	// Top header Site Desc color
	$nav_colors[] = array(
		'slug'=>'nav_bar_bg_color', 
		'default' => '#ffffff',
		'label' => 'Background Color'
	);
	$nav_colors[] = array(
		'slug'=>'nav_bar_text_color', 
		'default' => '#000000',
		'label' => 'Text Color'
	);
	foreach( $nav_colors as $colors ) {	
		// SETTINGS
		$wp_customize->add_setting(
			$colors['slug'], array(
				'default' => $colors['default'],
				'sanitize_callback'  => 'esc_attr',
				'type' => 'theme_mod'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$colors['slug'], 
				array('label' => $colors['label'], 
				'section' => 'nav_bar',
				'priority' 		=>  20,
				'settings' => $colors['slug'])
			)
		);
	}
	// Heading setting setup
	$wp_customize->add_setting('nav_bar_font_size', array(
		'default'			=> __( '15', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('nav_bar_font_size', array(
		'type'     => 'number',
		'label'    => __( 'Nav Bar Font Size', 'khaown' ),
		'section'  => 'nav_bar',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('nav_bar_font_weight', array(
		'default'			=> __( '500', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('nav_bar_font_weight', array(
		'type'     => 'select',
		'choices'  => array(
			'100' => _x( '100', '100', 'khaown' ),
			'200'  => _x( '200', '200', 'khaown' ),
			'300'  => _x( '300', '300', 'khaown' ),
			'400' => _x( '400', '400', 'khaown' ),
			'500'  => _x( '500', '500', 'khaown' ),
			'600'  => _x( '600', '600', 'khaown' ),
			'700'  => _x( '700', '700', 'khaown' ),
		),
		'label'    => __( 'Nav Bar Font Weight', 'khaown' ),
		'section'  => 'nav_bar',
		'priority' 		=>  20
	) );

	// Heading setting setup
	$wp_customize->add_setting('nav_bar_margin_right', array(
		'default'			=> __( '15', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('nav_bar_margin_right', array(
		'type'		=>	'number',
		'default' 	=> 	__( '25', 'khaown'),
		'label' 	=> 	'Margin Right',
		'section'  	=> 	'nav_bar',
		'priority' 	=>  20
	) );

	/**********************************
		Header Top Section setup
	*********************************/
	$wp_customize->add_section('top_header', array(
		'title'			=> __('Top Header', 'khaown'),
		'description'	=> sprintf(__('Setup your theme Top header', 'khaown') ),
		'priority' 		=> 46
	) );

	// Heading setting setup
	$wp_customize->add_setting('display_header_or_not', array(
		'default'			=> __( '0', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('display_header_or_not', array(
		'type'     => 'checkbox',
		'label'    => __( 'Hide Top Header', 'khaown' ),
		'section'  => 'top_header',
		'priority' 		=>  20
	) );
	// Top header Background color
	$header_topcolors[] = array(
		'slug'=>'homepage_header_bg_color', 
		'default' => '#be9ae2',
		'label' => 'Top Header Background Color'
	);
	// Top header Site Title color
	$header_topcolors[] = array(
		'slug'=>'top_header_site_tile_color', 
		'default' => '#000000',
		'label' => 'Top Header Site Title Color'
	);
	// Top header Site Desc color
	$header_topcolors[] = array(
		'slug'=>'top_header_site_desc_color', 
		'default' => '#5f5f5f',
		'label' => 'Top Header Site Desc Color'
	);
	foreach( $header_topcolors as $colors ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$colors['slug'], array(
				'default' => $colors['default'],
				'sanitize_callback'  => 'esc_attr',
				'type' => 'theme_mod'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$colors['slug'], 
				array('label' => $colors['label'], 
				'section' => 'top_header',
				'priority' 		=>  20,
				'settings' => $colors['slug'])
			)
		);
	}

	// Heading setting setup
	$wp_customize->add_setting('site_title_font_size', array(
		'default'			=> __( '32', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('site_title_font_size', array(
		'type'     => 'number',
		'label'    => __( 'Site Title Font Size', 'khaown' ),
		'section'  => 'top_header',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('site_title_font_weight', array(
		'default'			=> __( '500', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('site_title_font_weight', array(
		'type'     => 'select',
		'choices'  => array(
			'100' => _x( '100', '100', 'khaown' ),
			'200'  => _x( '200', '200', 'khaown' ),
			'300'  => _x( '300', '300', 'khaown' ),
			'400' => _x( '400', '400', 'khaown' ),
			'500'  => _x( '500', '500', 'khaown' ),
			'600'  => _x( '600', '600', 'khaown' ),
			'700'  => _x( '700', '700', 'khaown' ),
		),
		'label'    => __( 'Site Title Font Weight', 'khaown' ),
		'section'  => 'top_header',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('site_title_margin_bottom', array(
		'default'			=> __( '5', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('site_title_margin_bottom', array(
		'type'     => 'number',
		'label'    => __( 'Site Title Bottom Space', 'khaown' ),
		'section'  => 'top_header',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('site_desc_font_size', array(
		'default'			=> __( '15', 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('site_desc_font_size', array(
		'type'     => 'number',
		'label'    => __( 'Site Desc Font Size', 'khaown' ),
		'section'  => 'top_header',
		'priority' 		=>  20
	) );

	

	/**********************************
	Social Media Add customizer setup
    *********************************/
    $wp_customize->add_section( 'social_media_section', array(
		'title'          => __( 'Social Accounts', 'khaown' ),
        'priority' 		 => 47
	) );
	
	// Heading setting setup
	$wp_customize->add_setting('display_social_media_accounts', array(
		'default'			=> __( false, 'khaown'),
		'sanitize_callback'  => 'esc_attr',
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('display_social_media_accounts', array(
		'type'     => 'checkbox',
		'label'    => __( 'Hide All Social Accounts', 'khaown' ),
		'section'  => 'social_media_section',
		'priority' 		=>  20
	) );
	// Social media colors
	$social_media_colors[] = array(
		'slug'=>'social_media_icon_color', 
		'default' => '#a0a0a0',
		'label' => 'Social Media Icon Color'
	);
	$social_media_colors[] = array(
		'slug'=>'social_media_icon_hover_color', 
		'default' => '#0073aa',
		'label' => 'Social Media Icon Hover Color'
	);
	foreach( $social_media_colors as $sm_color ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$sm_color['slug'], array(
				'default' => $sm_color['default'],
				'sanitize_callback'  => 'esc_attr',
				'type' => 'theme_mod'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$sm_color['slug'], 
				array('label' => $sm_color['label'], 
				'section' => 'social_media_section',
				'priority' 		=>  20,
				'settings' => $sm_color['slug'])
			)
		);
	}
	// Font Size of Icon
	$social_accounts[] = array(
		'slug'=>'social_icon_font_size', 
		'default' => 14,
		'label' => 'Social Icon Font Size',
		'type' 	=> 'number'
	);
	// Social Accounts color
	$social_accounts[] = array(
		'slug'=>'social_account_twitter', 
		'default' 	=> '',
		'label' 	=> 'Twitter',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_facebook', 
		'default' 	=> '',
		'label' 	=> 'Facebook',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Instagram', 
		'default' 	=> '',
		'label' 	=> 'Instagram',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Pinterest', 
		'default' 	=> '',
		'label' 	=> 'Pinterest',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Dribbble', 
		'default' 	=> '',
		'label' 	=> 'Dribbble',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_LinkedIn', 
		'default' 	=> '',
		'label' 	=> 'LinkedIn',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Tumblr', 
		'default' 	=> '',
		'label' 	=> 'Tumblr',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Youtube', 
		'default' 	=> '',
		'label' 	=> 'Youtube',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Vimeo', 
		'default' 	=> '',
		'label' 	=> 'Vimeo',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_RSS', 
		'default' 	=> '',
		'label' 	=> 'RSS',
		'type' 		=> 'text'
	);
	$social_accounts[] = array(
		'slug'=>'social_account_Email', 
		'default' 	=> '',
		'label' 	=> 'Email',
		'type' 		=> 'text'
	);
	foreach( $social_accounts as $account ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$account['slug'], array(
				'default' => $account['default'],
				'sanitize_callback'  => 'esc_attr',
				'type' => 'theme_mod'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
				$account['slug'], 
				array('label' => $account['label'], 
				'section' => 'social_media_section',
				'type' 	=> $account['type'], 
				'priority' 		=>  20,
				'settings' => $account['slug'])
		);
	}



	
}
add_action( 'customize_register', 'khaown_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function khaown_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function khaown_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function khaown_customize_preview_js() {
	wp_enqueue_script( 'khaown-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '20181231', true );
}
add_action( 'customize_preview_init', 'khaown_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function khaown_panels_js() {
	wp_enqueue_script( 'khaown-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'khaown_panels_js' );
