<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */
?>
<footer id="colophon" class="site-footer">
	<div class="row">
		<div class="col-md-4">
			<div class="site-info">
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
				<?php endif; ?>
				<a target="_blank" href="<?php echo esc_url( __( 'http://e-motahar.com', 'khaown' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress. */
					printf( __( 'Proudly powered by %s.', 'khaown' ), 'Motahar' );
					?>
				</a>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<h4>
					<?php if(get_theme_mod("social_account_twitter", "")) { ?>
						<a target="_blank" href="<?php echo get_theme_mod("social_account_twitter", ""); ?>"><i class="ti-twitter-alt"></i></a> 
					<?php } ?>
					<?php if(get_theme_mod("social_account_facebook", "")) { ?>
						<a target="_blank" href="<?php echo get_theme_mod("social_account_facebook", ""); ?>"><i class="ti-facebook"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Instagram", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Instagram", ""); ?>"><i class="ti-instagram"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Pinterest", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Pinterest", ""); ?>"><i class="ti-pinterest-alt"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Dribbble", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Dribbble", ""); ?>"><i class="ti-dribbble"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_LinkedIn", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_LinkedIn", ""); ?>"><i class="ti-linkedin"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Tumblr", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Tumblr", ""); ?>"><i class="ti-tumblr-alt"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Youtube", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Youtube", ""); ?>"><i class="ti-youtube"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Vimeo", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Vimeo", ""); ?>"><i class="ti-vimeo"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_RSS", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_RSS", ""); ?>"><i class="ti-rss"></i></a>
					<?php } ?>
					<?php if(get_theme_mod("social_account_Email", "")) { ?>
					<a target="_blank" href="<?php echo get_theme_mod("social_account_Email", ""); ?>"><i class="ti-email"></i></a>
					<?php } ?>
				</h4>
		</div><!-- .site-info -->
		</div>
		<div class="col-md-8">
			<div class="site-info">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'khaown' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						)
					);
					?>
				</nav><!-- .footer-navigation -->
			<?php endif; ?>
		</div>
	</div>
	
	<a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
