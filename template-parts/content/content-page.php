<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

?>

<header class="daowa-entry-header">
	<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
</header>
<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'daowa' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'daowa' ),
			'after'  => '</div>',
		)
	);
?>