<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

get_header();
?>

<div class="main-container">
    <section class="page-title page-title-4 bg-menu-4">
        <div class="container">
            <div class="row">
				<div class="col-sm-7 text-left">	
					<h2 class="uppercase mb0">
						Search <strong><?php echo get_search_query(); ?></strong>
					</h2>					
				</div>
				<div class="col-sm-5 col-xs-12 text-right">
					<?php echo get_search_form(); ?>
				</div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
	<section id="menu" class="page-template">
        <div class="container">
            <div class="blog-posts em-site-content">
                <div class="row">
                    <div class="col-md-9 col-xs-12">
						<main id="daowa-main" class="daowa-site-main">
							<?php
								if ( have_posts() ) {
									// Load posts loop.
									while ( have_posts() ) {
										the_post();
										get_template_part( 'template-parts/content/content', 'excerpt');
									}
									// Previous/next page navigation.
									daowa_the_posts_navigation();
								} else {
									// If no content, include the "No posts found" template.
									get_template_part( 'template-parts/content/content', 'none' );
								}
							?>
						</main><!-- .site-main -->
					</div>
					<div class="col-md-3 col-xs-12 text-center feature bordered bg-color-blog-posts">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>                    
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
