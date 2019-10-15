<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
?>

<h2><i class="ti ti-comments"></i>Comments</h2>
<?php $args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ul',
	'callback'          => null,
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 50,
	'reverse_top_level' => null,
	'reverse_children'  => '',
	'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
	'short_ping'        => false,   // @since 3.6
        'echo'              => true     // boolean, default is true
); ?>
<?php wp_list_comments($args, $comments); ?>

<?php
$form_args = array(
        // change the title of send button 
        'label_submit'=>'POST COMMENT',
        // change the title of the reply section
        'title_reply'=>'Write a Reply or Comment',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
 );?>
         <?php if ( !is_user_logged_in() ) : ?>

            <?php comment_form( $form_args ); ?>         

        <?php else : ?>

            <?php $form_args[ 'comment_field' ] = '<textarea name="comment" id="comment" class="form-control comment-field"  aria-required="true" rows="10"></textarea>'; ?>

            <?php comment_form( $form_args ); ?> 

        <?php endif ?>

<?php
//comment_form($form_args);

