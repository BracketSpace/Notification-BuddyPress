<?php
/**
 * Plugin Name: Notification : BuddyPress
 * Description: BuddyPress integration with Notification plugin. Add Triggers for all BuddyPress actions.
 * Plugin URI: http://wordpress.org/plugins/notification-buddypress/
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
 * Load Composer dependencies.
 */
require_once 'vendor/autoload.php';

/**
 * Gets plugin runtime object.
 *
 * @since  1.0.0
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

/**
 * Registers BuddyPress Component.
 *
 * @since  [Next]
 * @param  array $components Registered components.
 * @return void
 */
add_filter( 'bp_notifications_get_registered_components', function( $components = [] ) {
	array_push( $components, 'notification-buddypress' );
	return $components;
} );
