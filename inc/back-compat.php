<?php
/**
 * Daowa back compat functionality
 *
 * Prevents Daowa from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Daowa
 * @since Daowa 1.0.0
 */

/**
 * Prevent switching to Daowa on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Daowa 1.0.0
 */
function daowa_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'daowa_upgrade_notice' );
}
add_action( 'after_switch_theme', 'daowa_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Daowa on WordPress versions prior to 4.7.
 *
 * @since Daowa 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function daowa_upgrade_notice() {
	$message = sprintf( __( 'Daowa requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'daowa' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Daowa 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function daowa_customize() {
	wp_die(
		sprintf(
			__( 'Daowa requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'daowa' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'daowa_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Daowa 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function daowa_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Daowa requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'daowa' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'daowa_preview' );
