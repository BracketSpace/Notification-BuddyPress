<?php
/**
 * Plugin Name: Notification : BuddyPress
 * Description: Extension for Notification plugin
 * Plugin URI: https://bracketspace.com
 * Author: BracketSpace
 * Author URI: https://bracketspace.com
 * Version: 1.0.0
 * License: GPL3
 * Text Domain: notification-buddypress
 * Domain Path: /languages
 *
 * @package notification/buddypress
 */

/**
 * Things @todo. Replace globally these values:
 * - BuddyPress
 * - BuddyPress
 * - buddypress
 *
 * You can do this with this simple command replacing the sed parts:
 * find . -type f \( -iname \*.php -o -iname \*.txt -o -iname \*.json -o -iname \*.js \) -exec sed -i 's/BuddyPress/YOURNAMESPACE/g; s/BuddyPress/Your Nicename/g; s/buddypress/yourslug/g' {} +
 *
 * Or just execute the rename.sh script
 */

/**
 * Load Composer dependencies.
 */
require_once 'vendor/autoload.php';

/**
 * Gets plugin runtime object.
 *
 * @since  [Next]
 * @return BracketSpace\Notification\BuddyPress\Runtime
 */
function notification_buddypress_runtime() {

	global $notification_buddypress_runtime;

	if ( empty( $notification_buddypress_runtime ) ) {
		$notification_buddypress_runtime = new BracketSpace\Notification\BuddyPress\Runtime( __FILE__ );
	}

	return $notification_buddypress_runtime;

}

/**
 * Boot up the plugin
 */
add_action( 'notification/boot/initial', function() {

	/**
	 * Requirements check
	 */
	$requirements = new BracketSpace\Notification\BuddyPress\Utils\Requirements( __( 'Notification : BuddyPress', 'notification-buddypress' ), [
		'php'          => '5.6',
		'wp'           => '4.9',
		'notification' => '6.0.0',
		'buddypress'   => '4.4.0',
	] );

	$requirements->add_check( 'notification', require 'src/inc/requirements/notification.php' );

	if ( ! $requirements->satisfied() ) {
		add_action( 'admin_notices', [ $requirements, 'notice' ] );
		return;
	}

	$runtime = notification_buddypress_runtime();
	$runtime->boot();

} );
