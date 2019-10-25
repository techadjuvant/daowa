<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */

get_header();
?>

<div class="main-container">
<?php 
	$show = get_theme_mod("display_header_or_not", "");
	if(!$show) : 
?>
    <section class="page-title page-title-4 bg-menu-4">
        <div class="container">
            <div class="row">
				<?php $blog_info = get_bloginfo( 'name' ); ?>
					<?php if ( ! empty( $blog_info ) ) : ?>
						<div class="col-sm-7 text-left">							
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="khaown-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="khaown-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif; ?>

							<?php $description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="khaown-site-description">
										<?php echo $description; ?>
									</p>
							<?php endif; ?>
						</div>
						<div class="col-sm-5 col-xs-12 text-right">
							<?php echo get_search_form(); ?>
						</div>
						<?php else : ?>
							<div class="col-xs-8 col-xs-offset-2 text-center">
								<?php echo get_search_form(); ?>
							</div>
				<?php endif; ?>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
<?php endif; ?>
	<section id="main" class="page-template">
        <div class="container">
            <div class="blog-posts em-site-content">
                <div class="row">
					<?php 
						$sidebar_position = get_theme_mod("blog_page_sidebar_position", "right-sidebar"); 
						if($sidebar_position === "right-sidebar") : 
					?>
						<div class="col-md-9 col-xs-12">
							<main id="khaown-main" class="khaown-site-main pd-right-32">
								<?php
									if ( have_posts() ) {
										// Load posts loop.
										while ( have_posts() ) {
											the_post();
											get_template_part( 'template-parts/content/content', 'excerpt');
										}
										// Previous/next page navigation.
										khaown_the_posts_navigation();
									} else {
										// If no content, include the "No posts found" template.
										get_template_part( 'template-parts/content/content', 'none' );
									}
								?>
							</main><!-- .site-main -->
						</div>
						<div class="col-md-3 col-xs-12 text-center feature bordered bg-color-blog-posts">
							<?php get_sidebar(); ?> 
						</div>
					<?php endif; ?>
					<?php if($sidebar_position === "left-sidebar") : ?>
						<div class="col-md-3 col-xs-12 text-center feature bordered bg-color-blog-posts">
							<?php get_sidebar(); ?>           
						</div>
						<div class="col-md-9 col-xs-12">
							<main id="khaown-main" class="khaown-site-main pd-left-32">
								<?php
									if ( have_posts() ) {
										// Load posts loop.
										while ( have_posts() ) {
											the_post();
											get_template_part( 'template-parts/content/content', 'excerpt');
										}
										// Previous/next page navigation.
										khaown_the_posts_navigation();
									} else {
										// If no content, include the "No posts found" template.
										get_template_part( 'template-parts/content/content', 'none' );
									}
								?>
							</main><!-- .site-main -->
						</div>
					<?php endif; ?>
					<?php if($sidebar_position === "no-sidebar") : ?>
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<main id="khaown-main" class="khaown-site-main">
								<?php
									if ( have_posts() ) {
										// Load posts loop.
										while ( have_posts() ) {
											the_post();
											get_template_part( 'template-parts/content/content', 'excerpt');
										}
										// Previous/next page navigation.
										khaown_the_posts_navigation();
									} else {
										// If no content, include the "No posts found" template.
										get_template_part( 'template-parts/content/content', 'none' );
									}
								?>
							</main><!-- .site-main -->
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>