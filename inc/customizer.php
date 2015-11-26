<?php
/**
 * Popperscores Theme Customizer.
 *
 * @package Popperscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function popperscores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Custom Customizer Customizations
	 */
	
	// Add heading color setting
	$wp_customize->add_setting( 'header_color', array(
		'default' => '#000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	
	// Add control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __( 'Header Background Color', 'popperscores' ),
				'section' => 'colors',
				'settings' => 'header_color',
			)
		)
	);
	
	
}
add_action( 'customize_register', 'popperscores_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function popperscores_customize_preview_js() {
	wp_enqueue_script( 'popperscores_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'popperscores_customize_preview_js' );
