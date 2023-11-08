<?php

function ilovewp_customizer_define_footer_sections( $sections ) {
    $panel           = 'ilovewp' . '_footer';
    $footer_sections = array();

    $footer_sections['footer'] = array(
        'title'   => esc_html__( 'Footer', 'endurance' ),
        'priority' => 5000,
        'options' => array(

            'footer-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                ),
                'control' => array(
                    'label'             => esc_html__( 'Copyright Text', 'endurance' ),
                    'type'              => 'text',
                ),
            ),

        ),
    );

    return array_merge( $sections, $footer_sections );
}

add_filter( 'ilovewp_customizer_sections', 'ilovewp_customizer_define_footer_sections' );