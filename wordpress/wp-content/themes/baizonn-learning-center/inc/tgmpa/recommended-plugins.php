<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Good Looking Blog Pro for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'education_center_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
if( ! function_exists( 'education_center_register_required_plugins' ) ) :
	function education_center_register_required_plugins() {
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		$plugins = array(
			array(
				'name'      => __( 'One Click Demo Import', 'education-center' ),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),
			array(
				'name'      => __( 'Tutor LMS', 'education-center' ),
				'slug'      => 'tutor',
				'required'  => false,
			),
			array(
				'name'      => __( 'Contact Form 7', 'education-center' ),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
		);

		/*
		* Array of configuration settings. Amend each line as needed.
		*
		* TGMPA will start providing localized text strings soon. If you already have translations of our standard
		* strings available, please help us make TGMPA even better by giving us access to these translations or by
		* sending in a pull-request with .po file(s) with the translations.
		*
		* Only uncomment the strings in the config array if you want to customize the strings.
		*/
		$config = array(
			'id'           => 'education-center',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

			/*
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'education-center' ),
				'menu_title'                      => __( 'Install Plugins', 'education-center' ),
				/* translators: %s: plugin name. * /
				'installing'                      => __( 'Installing Plugin: %s', 'education-center' ),
				/* translators: %s: plugin name. * /
				'updating'                        => __( 'Updating Plugin: %s', 'education-center' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'education-center' ),
				'notice_can_install_required'     => _n_noop(
					/* translators: 1: plugin name(s). * /
					'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.',
					'education-center'
				),
				'notice_can_install_recommended'  => _n_noop(
					/* translators: 1: plugin name(s). * /
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'education-center'
				),
				'notice_ask_to_update'            => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'education-center'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					/* translators: 1: plugin name(s). * /
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'education-center'
				),
				'notice_can_activate_required'    => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'education-center'
				),
				'notice_can_activate_recommended' => _n_noop(
					/* translators: 1: plugin name(s). * /
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'education-center'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'education-center'
				),
				'update_link' 					  => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'education-center'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'education-center'
				),
				'return'                          => __( 'Return to Required Plugins Installer', 'education-center' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'education-center' ),
				'activated_successfully'          => __( 'The following plugin was activated successfully:', 'education-center' ),
				/* translators: 1: plugin name. * /
				'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'education-center' ),
				/* translators: 1: plugin name. * /
				'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'education-center' ),
				/* translators: 1: dashboard link. * /
				'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'education-center' ),
				'dismiss'                         => __( 'Dismiss this notice', 'education-center' ),
				'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'education-center' ),
				'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'education-center' ),

				'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
			),
			*/
		);

		tgmpa( $plugins, $config );
	}
endif;