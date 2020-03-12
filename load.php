<?php
/**
 * Load file
 *
 * @package notification/buddypress
 */

/**
 * Load the main plugin file.
 */
require_once __DIR__ . '/notification-buddypress.php';

/**
 * Initialize early.
 */
add_action( 'notification/init', function() {
	NotificationBuddyPress::init( __FILE__ )->init();
}, 1 );
