<?php
/**
 * Plugin Name: Notification : Buddy Press
 * Description: Extension for Notification plugin
 * Plugin URI: https://bracketspace.com
 * Author: BracketSpace
 * Author URI: https://bracketspace.com
 * Version: 1.0.0
 * License: GPL3
 * Text Domain: notification-buddypress
 * Domain Path: /src/languages
 *
 * @package notification/buddypress
 */

/**
 * Things @todo. Replace globally these values:
 * - BuddyPress
 * - Buddy Press
 * - buddypress
 *
 * You can do this with this simple command replacing the sed parts:
 * find . -type f \( -iname \*.php -o -iname \*.txt -o -iname \*.json -o -iname \*.js \) -exec sed -i 's/BuddyPress/YOURNAMESPACE/g; s/Buddy Press/Your Nicename/g; s/buddypress/yourslug/g' {} +
 *
 * Or just execute the rename.sh script
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
		 * @since  [Next]
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
		 * @since  [Next]
		 * @return array
		 */
		public static function components() {
			return isset( self::$runtime ) ? self::$runtime->components() : [];
		}

		/**
		 * Gets runtime component
		 *
		 * @since  [Next]
		 * @param  string $component_name Component name.
		 * @return mixed
		 */
		public static function component( $component_name ) {
			return isset( self::$runtime ) ? self::$runtime->component( $component_name ) : null;
		}

		/**
		 * Gets runtime object
		 *
		 * @since  [Next]
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
