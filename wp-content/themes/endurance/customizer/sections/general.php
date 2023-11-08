<?php

function ilovewp_customizer_define_general_sections( $sections ) {
    $panel           = 'ilovewp' . '_general';
    $general_sections = array();

    $theme_header_style = array(
        'default' => esc_html__('Default', 'endurance'),
        'centered' => esc_html__('Centered', 'endurance')
    );

    $general_sections['general'] = array(
        'title'     => esc_html__( 'Theme Settings', 'endurance' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-header-style'     => array(
                'setting' => array(
                    'default' => 'default',
                    'sanitize_callback' => 'ilovewp_sanitize_text'
                ),
                'control' => array(
                    'label' => esc_html__( 'Header Layout', 'endurance' ),
                    'type'  => 'radio',
                    'choices' => $theme_header_style
                ),
            ),

            'endurance-display-pages'    => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display Featured Pages on Homepage', 'endurance' ),
                    'type'              => 'checkbox'
                )
            ),

            'endurance-featured-page-1'  => array(
                'setting'               => array(
                    'default'           => 'none',
                    'sanitize_callback' => 'endurance_sanitize_pages'
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Featured Page #1', 'endurance' ),
                    'description'       => /* translators: link to pages */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Pages</a>.', 'endurance' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ),
                    'type'              => 'select',
                    'choices'           => endurance_get_pages()
                ),
            ),

            'endurance-featured-page-2'  => array(
                'setting'               => array(
                    'default'           => 'none',
                    'sanitize_callback' => 'endurance_sanitize_pages'
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Featured Page #2', 'endurance' ),
                    'type'              => 'select',
                    'choices'           => endurance_get_pages()
                ),
            ),

            'endurance-featured-page-3'  => array(
                'setting'               => array(
                    'default'           => 'none',
                    'sanitize_callback' => 'endurance_sanitize_pages'
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Featured Page #3', 'endurance' ),
                    'type'              => 'select',
                    'choices'           => endurance_get_pages()
                ),
            ),

            'endurance-display-pages-excerpts'    => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => __( 'Display the excerpts of Featured Pages', 'endurance' ),
                    'type'              => 'checkbox'
                )
            ),

            'endurance-display-dynamic-menu' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => __( 'Display the Dynamic Menu in Sidebar of Pages', 'endurance' ),
                    'type'              => 'checkbox'
                )
            ),

            'endurance-display-featured-hero' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display the Featured Images on Single Pages', 'endurance' ),
                    'type'              => 'checkbox'
                )
            ),

            'endurance-display-featured-parent-title' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => __( 'Display the Parent Page Title', 'endurance' ),
                    'description'       => __( 'When opening a child page with a featured image, display the parent page title overlaid over the featured image.', 'endurance' ),
                    'type'              => 'checkbox'
                )
            ),

        ),
    );

    return array_merge( $sections, $general_sections );
}

add_filter( 'ilovewp_customizer_sections', 'ilovewp_customizer_define_general_sections' );
