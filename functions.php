<?php
/**
 * Override spacious_header_title function
 **/
function spacious_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$spacious_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$spacious_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$spacious_header_title =  sprintf( __( 'Author: %s', 'spacious' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_day() ) :
			$spacious_header_title = sprintf( __( 'Day: %s', 'spacious' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			$spacious_header_title = sprintf( __( 'Month: %s', 'spacious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			$spacious_header_title = sprintf( __( 'Year: %s', 'spacious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			$spacious_header_title = __( 'Asides', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			$spacious_header_title = __( 'Images', 'spacious');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			$spacious_header_title = __( 'Videos', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			$spacious_header_title = __( 'Quotes', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			$spacious_header_title = __( 'Links', 'spacious' );

		elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) :
			$spacious_header_title = woocommerce_page_title( false );

		else :
                    if (get_post_type()=='stories'):
                        $spacious_header_title = __( 'Stories', 'spacious' );
                    else:
			$spacious_header_title = __( 'Archives', 'spacious' );
                    endif;
		endif;
	}
	elseif( is_404() ) {
		$spacious_header_title = __( 'Page NOT Found', 'spacious' );
	}
	elseif( is_search() ) {
		$spacious_header_title = __( 'Search Results', 'spacious' );
	}
	elseif( is_page()  ) {
		$spacious_header_title = get_the_title();
	}
	elseif( is_single()  ) {
		$spacious_header_title = get_the_title();
	}
	elseif( is_home() ){
		$queried_id = get_option( 'page_for_posts' );
		$spacious_header_title = get_the_title( $queried_id );
	}
	else {
		$spacious_header_title = '';
	}

	return $spacious_header_title;

}

/**
* Enqueues child theme stylesheet, loading first the parent theme stylesheet.
*/
function themify_custom_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'themify_custom_enqueue_child_theme_styles', 11 );
