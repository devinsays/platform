<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Platform
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function platform_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'platform_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function platform_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'platform' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'platform_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function platform_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'platform_setup_author' );

/**
 * Add HTML5 placeholders for each default comment field
 *
 * @param array $fields
 * @return array $fields
 */
function platform_comment_fields( $fields ) {

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="comment-form-author">
        	<label for="author">' . __( 'Name', 'summit' ) . '</label>
            <input required minlength="3" maxlength="30" placeholder="' . __( 'Name *', 'summit' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="comment-form-email">
        	<label for="email">' . __( 'Email', 'summit' ) . '</label>
            <input required placeholder="' . __( 'Email *', 'summit' ) . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['url'] =
        '<p class="comment-form-url">
        	<label for="url">' . __( 'Website', 'summit' ) . '</label>
            <input placeholder="' . __( 'Website', 'summit' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'platform_comment_fields' );

/**
 * Add HTML5 placeholder to the comment textarea.
 *
 * @param string $comment_field
 * @return string $comment_field
 */
 function platform_commtent_textarea( $comment_field ) {

    $comment_field =
        '<p class="comment-form-comment">
            <textarea required placeholder="' . __( 'Comment *', 'summit' ) . '" id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
        </p>';

    return $comment_field;
}
add_filter( 'comment_form_field_comment', 'platform_commtent_textarea' );

/**
 * Get default footer text
 *
 * @return string $text
 */
function platform_get_default_footer_text() {
	$text = sprintf(
		__( 'Powered by %s', 'platform' ),
		'<a href="' . esc_url( __( 'http://wordpress.org/', 'platform' ) ) . '">WordPress</a>'
	);
	$text .= '<span class="sep"> | </span>';
	$text .= sprintf(
		__( '%1$s by %2$s.', 'platform' ),
			'Platform',
			'<a href="http://devpress.com/" rel="designer">DevPress</a>'
	);
	return $text;
}

/**
 * Append class "social" to specific off-site links
 *
 * @since Platform 0.2.0
 */
function platform_social_nav_class( $classes, $item ) {

    if ( 0 == $item->parent && 'custom' == $item->type) {

    	$url = parse_url( $item->url );

    	if ( !isset( $url['host'] ) ) {
	    	return $classes;
    	}

    	$base = str_replace( "www.", "", $url['host'] );

    	// @TODO Make this filterable
    	$social = array(
    		'behance.com',
    		'dribbble.com',
    		'facebook.com',
    		'flickr.com',
    		'github.com',
    		'linkedin.com',
    		'pinterest.com',
    		'plus.google.com',
    		'instagr.am',
    		'instagram.com',
    		'skype.com',
    		'spotify.com',
    		'twitter.com',
    		'vimeo.com'
    	);

    	// Tumblr needs special attention
    	if ( strpos( $base, 'tumblr' ) ) {
			$classes[] = 'social';
		}

    	if ( in_array( $base, $social ) ) {
	    	$classes[] = 'social';
    	}

    }

    return $classes;

}
add_filter( 'nav_menu_css_class', 'platform_social_nav_class', 10, 2 );