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

/**
 * TemplateMonster real estate class plugin
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
		$this->constants();

		// Load all models
		$this->load_models();

		// Require cherry core
		if ( ! class_exists( 'Cherry_Core' ) ) {
			require_once( TM_REAL_ESTATE_DIR . '/cherry-framework/cherry-core.php' );
		}

		// Launch our plugin.
		add_action( 'after_setup_theme', array( $this, 'launch' ), 10 );

		// Add tm-re-properties shortcode
		add_shortcode( 'tm-re-properties', array( 'Model_Properties', 'shortcode_properties' ) );
	}

	/**
	 * Load plugin models
	 */
	public function load_models() {
		$models = array(
			'Model_Main',
			'Model_Properties'
		);

		foreach ( $models as $model ) {
			if ( ! class_exists( $model ) ) {
				$path = 'models'.DIRECTORY_SEPARATOR.str_replace( '_', '-', $model ).'.php';
				require_once( $path );
			}
		}
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

			$this->core = new Cherry_Core(
				array(
					'base_dir'	=> TM_REAL_ESTATE_DIR . 'cherry-framework',
					'base_url'	=> TM_REAL_ESTATE_URI . 'cherry-framework',
					'modules'	=> array(
						'cherry-js-core'	=> array(
							'priority'	=> 999,
							'autoload'	=> true,
						),
						'cherry-page-builder'	=> array(
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
									'switcher',
									'collection',
									'media',
								),
							),
						),
						'cherry-post-meta'	=> array(
							'priority'	=> 999,
							'autoload'	=> true,
							'args'      => array(
								'title' => __( 'Settings', 'cherry' ),
								'page'  => array( 'property' ),
								'fields' => array(
									'price' => array(
										'type'       => 'text',
										'id'         => 'price',
										'name'       => 'property_price',
										'value'      => 0,
										'left_label' => __( 'Price', 'tm-real-estate' ),
									),
									'status' => array(
										'type'       => 'select',
										'id'         => 'status',
										'name'       => 'status',
										'value'      => 'rent',
										'left_label' => __( 'Property status', 'tm-real-estate' ),
										'options'    => array(
											'rent' => __( 'Rent', 'tm-real-estate' ),
											'sale' => __( 'Sale', 'tm-real-estate' ),
										)
									),
									'type' => array(
										'type'       => 'select',
										'id'         => 'type',
										'name'       => 'type',
										'value'      => 'rent',
										'left_label' => __( 'Property type', 'tm-real-estate' ),
										'options'    => array(
											'rent' => __( 'Rent', 'tm-real-estate' ),
											'sale' => __( 'Sale', 'tm-real-estate' ),
										)
									),
									'bathrooms' => array(
										'type'    => 'number',
										'id'      => 'bathrooms',
										'name'    => 'bathrooms',
										'value'   => 0,
										'left_label' => __( 'Bathrooms', 'tm-real-estate' )
									),
									'bedrooms' => array(
										'type'    => 'number',
										'id'      => 'bedrooms',
										'name'    => 'bedrooms',
										'value'   => 0,
										'left_label' => __( 'Bedrooms', 'tm-real-estate' )
									),
									'area' => array(
										'type'    => 'number',
										'id'      => 'area',
										'name'    => 'area',
										'value'   => 0,
										'left_label' => __( 'Area', 'tm-real-estate' )
									),
									'gallerys' => array(
										'type'	  => 'collection',
										'id'      => 'gallery',
										'name'    => 'gallery',
										'left_label' => __( 'Gallery', 'tm-real-estate' ),
										'controls' => array(
											'UI_Text' => array(
												'type'    => 'text',
												'id'      => 'title',
												'class'   => 'large_text',
												'name'    => 'title',
												'value'   => '',
												'left_label' => __( 'Title', 'tm-real-estate' )
											),
											'UI_Media' => array(
												'id'           => 'image',
												'name'         => 'image',
												'value'        => '',
												'multi_upload' => false,
												'left_label'   => __( 'Image', 'tm-real-estate' ),
											),
										),
									),
									'tag' => array(
										'type'        => 'select',
										'id'          => 'tag',
										'name'        => 'tag',
										'multiple'	  => true,
										'value'       => '',
										'left_label'  => __( 'Tag', 'tm-real-estate' ),
										'options'     => Model_Main::get_tags(),
									),
									'categories' => array(
										'type'        => 'select',
										'id'          => 'categories',
										'name'        => 'categories',
										'multiple'	  => false,
										'value'       => '',
										'left_label'  => __( 'Categories', 'tm-real-estate' ),
										'options'     => Model_Main::get_categories(),
									),
									'agent' => array(
										'type'        => 'select',
										'id'          => 'agent',
										'name'        => 'agent',
										'multiple'	  => false,
										'value'       => '',
										'left_label'  => __( 'Agent', 'tm-real-estate' ),
										'options'     => Model_Main::get_agents(),
									),
								),
							),
						),
						'cherry-post-types' => array(
							'priority'	=> 999,
							'autoload'	=> true,
						),
					),
				)
			);

			$this->add_admin_menu_page();
			$this->add_post_type();
			$this->add_user_role();
		}
	}

	/*
	 * Add some admin menu
	 */
	public function add_admin_menu_page() {

		$sections = array(

				'tm-properties-main-settings' => array(
					'slug'			=> 'tm-properties-main-settings',
					'name'			=> __( 'Main', 'tm-real-estate' ),
					'description'	=> '',
				),

				'tm-properties-types' => array(
					'slug'	=> 'tm-properties-types',
					'name'	=> __( 'Property type', 'tm-real-estate' ),
					'description'	=> '',
				),

			);

		$settings['tm-properties-main-settings'][] = array(
						'type'			=> 'select',
						'slug'			=> 'area-unit',
						'title'			=> 'Area unit',
						'field'			=> array(
							'id'			=> 'area-unit',
							'size'			=> 1,
							'value'			=> 'feets',
							'options'		=> array(
								'feets'	=> 'feets',
								'meters'	=> 'meters',
							),
						),
					);

		$settings['tm-properties-main-settings'][] = array(
				'slug'	=> 'сurrency-sign',
				'title'	=> 'Currency Sign',
				'type'	=> 'text',
				'field'	=> array(
						'id'			=> 'сurrency-sign',
						'value'			=> '$',
						'placeholder'	=> '$',
					),
			);

		$settings['tm-properties-types'][] = array(
				'slug'	=> 'field-switcher',
				'title'	=> 'Switcher',
				'type'				=> 'switcher',
				'field'	=> array(
						'id'				=> 'test-switcher',
						'value'				=> 'true',
						'toggle'			=> array(
							'true_toggle'	=> 'On',
							'false_toggle'	=> 'Off',
							'true_slave'	=> '',
							'false_slave'	=> ''
						),
						'style'				=> 'normal',
					),
			);

		$page = new Cherry_Page_Builder( $this->core );

		$page->make( 'cherry-property-settings', 'Property Settings', null )->set( array(
					'capability'	=> 'manage_options',
					'position'		=> 20,
					'icon'			=> 'dashicons-admin-site',
					'sections'		=> $sections,
					'settings'		=> $settings,
					'before'		=> 'Before page description',
					'after'			=> 'After page description',
				) );
	}

	/**
	 * Add property post type
	 */
	public function add_post_type() {
		$this->core->modules['cherry-post-types']->create(
			'property',
			'Property',
			'Properties',
			array(
				'supports' => array(
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'comments'
				)
			)
		)->font_awesome_icon( 'f1ad' );
	}

	/**
	 * Add RE Agent role
	 *
	 * @return  WP_Role / NULL
	 */
	public function add_user_role() {
		return add_role(
			're_agent',
			__( 'RE Agent', 'tm-real-estate' ),
			array(
				'read'              => true, // true allows this capability
				'edit_posts'        => true, // Allows user to edit their own posts
				'edit_pages'        => true, // Allows user to edit pages
				'edit_others_posts' => true, // Allows user to edit others posts not just their own
				'create_posts'      => true, // Allows user to create new posts
				'manage_categories' => true, // Allows user to manage post categories
				'publish_posts'     => true, // Allows the user to publish, otherwise posts stays in draft mode
				'edit_themes'       => false, // false denies this capability. User can’t edit your theme
				'install_plugins'   => false, // User cant add new plugins
				'update_plugin'     => false, // User can’t update any plugins
				'update_core'       => false // user cant perform core updates
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
