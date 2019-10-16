<?php
/**
 * Daowa: Customizer
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function daowa_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'daowa_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'daowa_customize_partial_blogdescription',
			)
		);
	}


	/**
	 * Background color.
	 */
	// add the settings and controls for each color
	// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
	$txtcolors[] = array(
		'slug'=>'bg_color_scheme_1', 
		'default' => '#1e7e7e',
		'label' => 'Body Background Color'
	);

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=>'homepage_header_bg_color', 
		'default' => '#be9ae2',
		'label' => 'Homepage Header Background Color'
	);

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=>'button_bg_color', 
		'default' => '#292929',
		'label' => 'Button Background Color'
	);

	// link color
	$txtcolors[] = array(
		'slug'=>'text_color', 
		'default' => '#545454',
		'label' => 'Text Color'
	);

	// link color
	$txtcolors[] = array(
		'slug'=>'link_color', 
		'default' => '#545454',
		'label' => 'Link Color'
	);
	
	// link color ( hover, active )
	$txtcolors[] = array(
		'slug'=>'hover_link_color', 
		'default' => '#a0a0a0',
		'label' => 'Link Color (on hover)'
	);

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=>'sidebar_background_color', 
		'default' => '#f8f8f8',
		'label' => 'Sidebar & Posts Background Color'
	);

	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=> 'veriant_posts_background_color', 
		'default' => '#333347',
		'label' => 'Veriant Posts Background Color'
	);
	
	// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=> 'veriant_posts_text_color', 
		'default' => '#d2d2d2',
		'label' => 'Veriant Posts Text Color'
	);

	foreach( $txtcolors as $txtcolor ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' => $txtcolor['default'],
				'type' => 'theme_mod', 
				//'capability' => 'edit_theme_options'
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


	// Typography Section setup
	$wp_customize->add_section('typography', array(
		'title'			=> __('Typography', 'daowa'),
		'description'	=> sprintf(__('Setup your theme typography', 'daowa') ),
		'priority' 		=> 41
	) );

	// Heading setting setup
	$wp_customize->add_setting('font_family_source', array(
		'default'			=> __("https://fonts.googleapis.com/css?family=Varela+Round&display=swap", 'daowa'),
		'type' 				=> 'theme_mod'
	) );

	// heading Control setup
	$wp_customize->add_control('font_family_source', array(
		'label'			=> __('Import Google Font. Exm: https://example.com ', 'daowa'),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );

	// Heading setting setup
	$wp_customize->add_setting('font_family', array(
		'default'			=> __(" 'Varela Round', sans-serif; ", 'daowa'),
		'type' 				=> 'theme_mod'
	) );

	// heading Control setup
	$wp_customize->add_control('font_family', array(
		'label'			=> __('Add Font Family', 'daowa'),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );
	
	// Heading setting setup
	$wp_customize->add_setting('heading_1_font_size', array(
		'default'			=> __('28', 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_font_size', array(
		'label'			=> __('H1 Heading Font Size', 'daowa'),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_1_font_weight', array(
		'default'			=> __('300', 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_font_weight', array(
		'type'     => 'select',
		'label'    => __( 'H1 Heading Font Weight', 'daowa' ),
		'choices'  => array(
			'100' => _x( '100', '100', 'daowa' ),
			'200'  => _x( '200', '200', 'daowa' ),
			'300'  => _x( '300', '300', 'daowa' ),
			'400' => _x( '400', '400', 'daowa' ),
			'500'  => _x( '500', '500', 'daowa' ),
			'600'  => _x( '600', '600', 'daowa' ),
			'700'  => _x( '700', '700', 'daowa' ),
		),
		'section'  => 'typography',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_1_line_height', array(
		'default'			=> __( 36, 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_line_height', array(
		'type'     => 'number',
		'label'    => __( 'H1 Heading Line Height', 'daowa' ),
		'section'  => 'typography',
		'priority' 		=>  20
	) );

	// Heading setting setup
	$wp_customize->add_setting('heading_1_letter_spacing', array(
		'default'			=> __('1', 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_letter_spacing', array(
		'label'			=> __('H3 Heading Letter Spacing', 'daowa'),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );
	// Heading setting setup
	$wp_customize->add_setting('heading_1_text_case', array(
		'default'			=> __('uppercase', 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// heading Control setup
	$wp_customize->add_control('heading_1_text_case', array(
		'type'     => 'select',
		'label'    => __( 'H1 Heading Text Case', 'daowa' ),
		'choices'  => array(
			'uppercase' => _x( 'Uppercase', 'uppercase', 'daowa' ),
			'lowercase'  => _x( 'Lowercase', 'lowercase', 'daowa' ),
			'capitalize'  => _x( 'Capitalize', 'capitalize', 'daowa' ),
		),
		'section'  => 'typography',
		'priority' 		=>  20
	) );
	





	// Text setting setup
	$wp_customize->add_setting('paragraph_font_size', array(
		'default'			=> __('14', 'daowa'),
		'type' 				=> 'theme_mod'
	) );
	
	// Text Control setup
	$wp_customize->add_control('paragraph_font_size', array(
		'label'			=> __('Paragraph Font Size', 'daowa'),
		'section' 		=> 'typography',
		'priority' 		=>  20
	) );
}
add_action( 'customize_register', 'daowa_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function daowa_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function daowa_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function daowa_customize_preview_js() {
	wp_enqueue_script( 'daowa-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '20181231', true );
}
add_action( 'customize_preview_init', 'daowa_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function daowa_panels_js() {
	wp_enqueue_script( 'daowa-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'daowa_panels_js' );

/**
 * Sanitize custom color choice.
 *
 * @param string $choice Whether image filter is active.
 *
 * @return string
 */
function daowa_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}

	return 'default';
}
