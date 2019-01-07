<?php
/**
 * Nextcore Theme Customizer
 *
 * @package Nextcore
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nextcore_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'nextcore_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'nextcore_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'nextcore_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nextcore_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nextcore_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nextcore_customize_preview_js() {
	wp_enqueue_script( 'nextcore-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'nextcore_customize_preview_js' );


Kirki::add_config( 'my_them___e', array(
    'capability'  => 'edit_theme_options',
    'option_type' => 'theme_mod',
) );

Kirki::add_panel( 'panel_id', array(
    'priority'    => 1,
    'title'       => __( 'Tổng quan', 'nextcore' ),
    'description' => __( 'Cài đặt chung cho site', 'nextcore' ),
) );

//Garenal Logo
function remove_customizer_settings( $wp_customize ){
    $wp_customize->remove_section( 'colors' );
    $wp_customize->remove_section( 'background_image' );
    $wp_customize->remove_section( 'header_image' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_control( 'blogdescription' );
    $wp_customize->remove_control( 'blogname' );
    $wp_customize->remove_control( 'display_header_text' );
    // Rename existing section

    $wp_customize->add_section('title_tagline', array(
        'title'    => esc_html__( 'Logo', 'nextcore' ),
        'priority' => 1,
        'panel'    => 'panel_id',
    ) );

    /* Custom CSS */
    $wp_customize->add_section( 'custom_css', array(
        'title'              => __( 'Custom CSS' ),
        'priority'           => 200,
        'panel'    => 'panel_id',
        'description_hidden' => true,
        'description'        => sprintf( '%s<br /><a href="%s" class="external-link" target="_blank">%s<span class="screen-reader-text">%s</span></a>',
            __( 'CSS allows you to customize the appearance and layout of your site with code. Separate CSS is saved for each of your themes. In the editing area the Tab key enters a tab character. To move below this area by pressing Tab, press the Esc key followed by the Tab key.' ),
            esc_url( __( 'https://codex.wordpress.org/CSS' ) ),
            __( 'Learn more about CSS' ),
            /* translators: accessibility text */
            __( '(opens in a new window)' )
        ),
    ) );
}

add_action( 'customize_register', 'remove_customizer_settings', 20 );

Kirki::add_section( 'section_id', array(
    'title'          => esc_html__( 'My Section', 'textdomain' ),
    'description'    => esc_html__( 'My section description.', 'textdomain' ),
    'panel'          => 'panel_id',
    'priority'       => 160,
) );

Kirki::add_field( 'theme_config_id', array(
    'type'     => 'text',
    'settings' => 'my_setting',
    'label'    => __( 'Text Control', 'textdomain' ),
    'section'  => 'section_id',
    'default'  => esc_html__( 'This is a default value', 'textdomain' ),
    'priority' => 10,
    'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
    'input_attrs' => array( // Optional.
        'class' => '.content_main',
        'style' => 'border: 1px solid #999',
        'placeholder' => __( 'Enter message...' ),
    ),
) );