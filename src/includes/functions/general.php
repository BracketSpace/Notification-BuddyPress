<?php
/**
 * General functions
 *
 * @package notification/buddypress
 */

/**
 * Gets one of the plugin filesystems
 *
 * @since  1.2.0
 * @param  string $name Filesystem name.
 * @return Filesystem|null
 */
function notification_buddypress_filesystem( $name ) {
	return \NotificationBuddyPress::runtime()->get_filesystem( $name );
}
