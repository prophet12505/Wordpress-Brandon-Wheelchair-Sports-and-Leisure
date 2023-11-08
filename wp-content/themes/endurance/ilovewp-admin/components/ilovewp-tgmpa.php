<?php
/**
 * Include the TGM_Plugin_Activation class.
 *
 */
require_once get_template_directory() . '/ilovewp-admin/components/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ilovewp_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function ilovewp_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.

		array(
			'name'      => 'Better Block Patterns',
			'slug'      => 'better-block-patterns', // https://wordpress.org/plugins/better-block-patterns/
			'required'  => false,
		)

	);

	tgmpa( $plugins );
}
?>