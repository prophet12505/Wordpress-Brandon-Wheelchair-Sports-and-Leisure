<?php

function ilovewp_option_defaults() {
    $defaults = array(

        /* translators: This is the copyright notice that appears in the footer of the website. */
        'footer-text' => sprintf( esc_html__( 'Copyright &copy; %1$s %2$s.', 'endurance' ), date( 'Y' ), get_bloginfo( 'name' ) ),
    );

    return $defaults;
}

function ilovewp_get_default( $option ) {
    $defaults = ilovewp_option_defaults();
    $default  = ( isset( $defaults[ $option ] ) ) ? $defaults[ $option ] : false;

    return $default;
}
