<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage khaown
 * @since 1.0.0
 */

?>

<div class="text-left">
	<h4>Nothing found related to <?php echo get_search_query(); ?></h4>
	<p>There is no page or post related to this search term. Please search with another term.</p>
	<h3><a href="<?php echo esc_url( home_url() ); ?>">Go to Homepage</a></h3>
</div>
<!--end of container-->