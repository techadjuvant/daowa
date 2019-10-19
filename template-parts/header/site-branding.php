<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */
?>
<div class="module left site-branding">
	<?php if ( has_custom_logo() ) { ?>
		<div class="logo logo-dark"><?php the_custom_logo(); ?></div>
	<?php } else { ?>
		<?php $blog_info = get_bloginfo( 'name' ); ?>
		<?php if ( ! empty( $blog_info ) ) : ?>
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
	<?php endif; ?>
	<?php } ?>
</div>