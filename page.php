<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */

get_header();
?>
<main id="main-container" >
	<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<section class="fullscreen image-bg overlay parallax">
						<!-- Image overlay opacity control is loacted on line 637 of the theme-gunmetal.css file - CW -->
						<div class="background-image-holder">
							<?php the_post_thumbnail(); ?>
						</div>
					</section>					
				<?php endif; ?>
				<div id="single-content">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<?php get_template_part( 'template-parts/content/content', 'single' ); ?>
								<!-- If comments are open or we have at least one comment, load up the comment template. -->
								<?php if ( comments_open() || get_comments_number() ) { ?>
									<div class="comm em_comment mb-80">
										<?php comments_template(); ?>
										<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
										<?php paginate_comments_links( ) ?>
									</div>
								<?php } ?>

							</div>
						</div>
						<!--end of row-->
					</div>
					<!--end of container-->
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

		 <?php endwhile; ?> <!-- End of the loop. -->

</main><!-- #main -->
<?php
get_footer();
