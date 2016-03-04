<?php
/**
 * Plugin Name: TM Real Estate
<<<<<<< HEAD
 * Description: 
 * Version: 1.0
 * Author: Guriev Eugen and Serhii Osadchyi
 * Author URI: http://www.templatemonster.com/
 * License: GPLv2 or later
 * Text Domain: tm-real-estate
=======
 * Plugin URI:  http://www.templatemonster.com/
 * Description: Plugin for adding real estate functionality to the site.
 * Version:     1.0.0
 * Author:      Guriev Eugen & Sergyj Osadchij
 * Author URI:  http://www.templatemonster.com/
 * Text Domain: tm-real-estate
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 *
 * @package  TM Real Estate
 * @author   Guriev Eugen & Sergyj Osadchij
 * @license  GPL-2.0+
>>>>>>> master
 */

class TM_Real_Estate {

	/**
	 * A reference to an instance of this class.
	 * Singleton pattern implementation.
	 * 
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

<<<<<<< HEAD
/**
 * Autoload all classes
 */
require_once 'src/autoload.php';
new Autoload(
	array(
		'ui',
		'configuration',
		'core',
		'field',
		'field/fields',
		'page'
	)
);
Configuration::load();
=======
	/**
	 * A reference to an instance of cherry framework core class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private $core = null;

	/**
	 * TM_REAL_ESTATE class constructor
	 */
	private function __construct() {
		// Set the constants needed by the plugin.
		add_action( 'plugins_loaded', array( $this, 'constants' ), 0 );

		// Launch our plugin.
		add_action( 'after_setup_theme', array( $this, 'launch' ), 10 );
	}

	/**
	 * Defines constants for the plugin.
	 *
	 * @since 1.0.0
	 */
	public function constants() {
		/*
		 * Set constant path to the plugin directory.
		 *
		 * @since 1.0.0
		 */
		define( 'TM_REAL_ESTATE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/**
		 * Set constant path to the plugin URI.
		 *
		 * @since 1.0.0
		 */
		define( 'TM_REAL_ESTATE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	 * Loads the core functions. These files are needed before loading anything else in the
	 * theme because they have required functions for use.
	 *
	 * @since  1.0.0
	 */
	public function launch() {
		if ( is_admin() ) {
			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( ! class_exists( 'Cherry_Core' ) ) {
				require_once( TM_REAL_ESTATE_DIR . '/cherry-framework/cherry-core.php' );
			}

			$this->core = new Cherry_Core(
				array(
					'base_dir'	=> TM_REAL_ESTATE_DIR . 'cherry-framework',
					'base_url'	=> TM_REAL_ESTATE_URI . 'cherry-framework',
					'modules'	=> array(
						'cherry-js-core'	=> array(
							'priority'	=> 999,
							'autoload'	=> true,
						),
						'cherry-post-meta'	=> array(
							'priority'	=> 999,
							'autoload'	=> true,
						),
						'cherry-ui-elements' => array(
							'priority'	=> 999,
							'autoload'	=> true,
							'args'		=> array(
								'ui_elements' => array(
									'text',
									'select',
								),
							),
						),
					),
				)
			);
			$this->add_metaboxes();
		}
	}

	/**
	 * Add some metaboxes
	 */
	public function add_metaboxes() {
		$meta = new Cherry_Post_Meta(
			$this->core,
			array(
				'title' => 'some title',
				'fields' => array(
					'name_checkbox' => array(
						'type'    => 'select',
						'id'      => 'amaid',
						'name'    => 'theme_sidebar[oh-yeah]',
						'value'   => 1,
						'options' => array( 
							'' => __( 'Sidebar not selected', 'cherry-sidebar-manager' ),
							1 => 'some shit'
						),
					)
				)
			)
		);
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

TM_Real_Estate::get_instance();
>>>>>>> master
