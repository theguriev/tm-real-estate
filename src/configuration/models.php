<?php
/**
 * Configuration models engine class file
 *
 * @package photolab
 */

/**
 * Models class
 */
class Models {

	/**
	 * Models class constructor
	 */
	public function __construct() {
		$paths = self::get_all_paths();
		if ( count( $paths ) ) {
			foreach ( $paths as $path ) {
				if ( file_exists( $path ) ) {
					require_once( $path );
				}
			}
		}
	}

	/**
	 * Get all paths to classes
	 *
	 * @return array
	 */
	public static function get_all_paths() {
		$pattern = sprintf(
			'%sapp/models/*.php',
			TM_REAL_ESTATE_PATH
		);
		return (array) glob( $pattern );
	}
}
