<?php
/**
 * Hooks compatibilty file.
 *
 * Automatically generated with `wp notification dump-hooks`.
 *
 * @package notification/buddypress
 */

/** @var \BracketSpace\Notification\BuddyPress\Runtime $this */

// phpcs:disable
add_action( 'notification/init', [ $this, 'elements' ], 10, 0 );
add_filter( 'bp_notifications_get_registered_components', [ $this->component( 'frontend/handler' ), 'register_component' ], 10, 1 );
add_filter( 'bp_notifications_get_notifications_for_user', [ $this->component( 'frontend/handler' ), 'handle_notification' ], 10, 8 );
