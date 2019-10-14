<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

$discussion = ! is_page() && daowa_can_show_post_thumbnail() ? daowa_get_discussion_data() : null; ?>

<?php the_title( '<h1 class="daowa-entry-title">', '</h1>' ); ?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
	<?php daowa_posted_by(); ?>
	<?php daowa_posted_on(); ?>
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			daowa_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php daowa_comment_count(); ?>
	</span>
	<?php
	// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'daowa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . daowa_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	?>
</div><!-- .entry-meta -->
<?php endif; ?>
