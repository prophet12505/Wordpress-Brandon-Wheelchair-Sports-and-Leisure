<?php

function ilovewp_sanitize_choice( $value, $setting ) {
    return $value;
}

if ( ! function_exists( 'ilovewp_maybe_hash_hex_color' ) ) :
    /**
     * Ensures that any hex color is properly hashed.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string $color The proposed color.
     *
     * @return string|null The sanitized color.
     */
    function ilovewp_maybe_hash_hex_color( $color ) {
        if ( $unhashed = ilovewp_sanitize_hex_color_no_hash( $color ) ) {
            return '#' . $unhashed;
        }

        return $color;
    }
endif;


if ( ! function_exists( 'ilovewp_sanitize_hex_color' ) ) :
    /**
     * Sanitizes a hex color.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function ilovewp_sanitize_hex_color( $color ) {
        if ( '' === $color ) {
            return '';
        }

        // 3 or 6 hex digits, or the empty string.
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }

        return null;
    }
endif;

if ( ! function_exists( 'ilovewp_sanitize_hex_color_no_hash' ) ) :
    /**
     * Sanitizes a hex color without a hash. Use ilovewp_sanitize_hex_color() when possible.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function ilovewp_sanitize_hex_color_no_hash( $color ) {
        $color = ltrim( $color, '#' );

        if ( '' === $color ) {
            return '';
        }

        return ilovewp_sanitize_hex_color( '#' . $color ) ? $color : null;
    }
endif;

if ( ! function_exists( 'ilovewp_maybe_hash_hex_color' ) ) :
    /**
     * Ensures that any hex color is properly hashed.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function ilovewp_maybe_hash_hex_color( $color ) {
        if ( $unhashed = ilovewp_sanitize_hex_color_no_hash( $color ) ) {
            return '#' . $unhashed;
        }

        return $color;
    }
endif;

if ( ! function_exists( 'ilovewp_hex2rgb' ) ) :
    /**
     * Convert HEX color to RGB value
     */
    function ilovewp_hex2rgb( $color ) {

		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		
		$color = "$r, $g, $b";
		return $color; // returns an array with the rgb values
    }
endif;


/**
 * Allow only certain tags and attributes in a string.
 *
 * @param  string    $string    The unsanitized string.
 * @return string               The sanitized string.
 */
function ilovewp_sanitize_text( $string ) {
    global $allowedtags;
    $expandedtags = $allowedtags;

    // span
    $expandedtags['span'] = array();

    // Enable id, class, and style attributes for each tag
    foreach ( $expandedtags as $tag => $attributes ) {
        $expandedtags[$tag]['id']    = true;
        $expandedtags[$tag]['class'] = true;
        $expandedtags[$tag]['style'] = true;
    }

    // br (doesn't need attributes)
    $expandedtags['br'] = array();

    /**
     * Customize the tags and attributes that are allows during text sanitization.
     *
     * @param array     $expandedtags    The list of allowed tags and attributes.
     * @param string    $string          The text string being sanitized.
     */
    apply_filters( 'ilovewp_sanitize_text_allowed_tags', $expandedtags, $string );

    return wp_kses( $string, $expandedtags );
}

if ( ! function_exists( 'endurance_get_pages' ) ) :
/**
 * Return an array of pages
 *
 * @since 1.0.0.
 *
 * @return array                The list of pages.
 */
function endurance_get_pages() {

    $choices = array( 0 );

    // Default
    $choices = array( 'none' => esc_html__( 'None', 'endurance' ) );

    // Pages
    $type_terms = get_pages( array( 'sort_column' => 'post_title', 'sort_order' => 'asc' ) );
    if ( ! empty( $type_terms ) ) {

        $type_names = wp_list_pluck( $type_terms, 'post_title', 'ID' );
        $choices = $choices + $type_names;

    }

    return apply_filters( 'endurance_get_pages', $choices );
}
endif;

if ( ! function_exists( 'endurance_sanitize_pages' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function endurance_sanitize_pages( $value ) {

    $choices = endurance_get_pages();
    $valid   = array_keys( $choices );

    if ( ! in_array( $value, $valid ) ) {
        $value = 'none';
    }

    return $value;
}
endif;

if ( ! function_exists( 'endurance_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function endurance_get_categories() {

    $choices = array( 0 );

    // Default
    $choices = array( 'none' => esc_html__( 'None', 'endurance' ) );

    // Categories
    $type_terms = get_terms( 'category' );
    if ( ! empty( $type_terms ) ) {

        $type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
        $choices = $choices + $type_names;

    }

    return apply_filters( 'endurance_get_categories', $choices );
}
endif;

if ( ! function_exists( 'endurance_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function endurance_sanitize_categories( $value ) {

    $choices = endurance_get_categories();
    $valid   = array_keys( $choices );

    if ( ! in_array( $value, $valid ) ) {
        $value = 'none';
    }

    return $value;
}
endif;