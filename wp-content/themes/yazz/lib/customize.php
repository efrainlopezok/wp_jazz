<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		array(
			'default'           => genesis_sample_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'genesis-sample' ),
				'label'       => __( 'Link Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		array(
			'default'           => genesis_sample_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'genesis-sample' ),
				'label'       => __( 'Accent Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_accent_color',
			)
		)
	);

}

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the site title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'header', 'option' );
	echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="AG"><img src="'.$logo['logo'].'" alt="logo"/></a>';
}
add_action( 'genesis_site_title', 'custom_site_title' );

//* Remove copyright wordpress
function remove_footer_admin () 	{
    echo '';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');
//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
