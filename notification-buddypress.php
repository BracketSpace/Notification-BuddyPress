<?php
/**
 * Plugin Name: Notification : BuddyPress
 * Description: BuddyPress integration with Notification plugin. Add Triggers for all BuddyPress actions.
 * Plugin URI: http://wordpress.org/plugins/notification-buddypress/
 * Author: BracketSpace
 * Author URI: https://bracketspace.com
 * Version: 1.2.1
 * License: GPL3
 * Text Domain: notification-buddypress
 * Domain Path: /languages
 *
 * @package notification/buddypress
 */

if ( ! class_exists( 'NotificationBuddyPress' ) ) :

	/**
	 * NotificationBuddyPress class
	 */
	class NotificationBuddyPress {

		/**
		 * Runtime object
		 *
		 * @var BracketSpace\Notification\BuddyPress\Runtime
		 */
		protected static $runtime;

		/**
		 * Initializes the plugin runtime
		 *
		 * @since  1.2.0
		 * @param  string $plugin_file Main plugin file.
		 * @return BracketSpace\Notification\BuddyPress\Runtime
		 */
		public static function init( $plugin_file ) {
			if ( ! isset( self::$runtime ) ) {
				// Autoloading.
				require_once dirname( $plugin_file ) . '/vendor/autoload.php';
				self::$runtime = new BracketSpace\Notification\BuddyPress\Runtime( $plugin_file );
			}

			return self::$runtime;
		}

		/**
		 * Gets runtime component
		 *
		 * @since  1.2.0
		 * @return array
		 */
		public static function components() {
			return isset( self::$runtime ) ? self::$runtime->components() : [];
		}

		/**
		 * Gets runtime component
		 *
		 * @since  1.2.0
		 * @param  string $component_name Component name.
		 * @return mixed
		 */
		public static function component( $component_name ) {
			return isset( self::$runtime ) ? self::$runtime->component( $component_name ) : null;
		}

		/**
		 * Gets runtime object
		 *
		 * @since  1.2.0
		 * @return BracketSpace\Notification\Runtime
		 */
		public static function runtime() {
			return self::$runtime;
		}

	}

endif;

add_action( 'notification/init', function() {
	NotificationBuddyPress::init( __FILE__ )->init();
}, 2 );
