<?php
/**
 * Triggers
 *
 * @package notification-buddypress
 */

use BracketSpace\Notification\BuddyPress\Components\Recipient;

notification_register_recipient( 'buddypress-notification', new Recipient\User() );
notification_register_recipient( 'buddypress-notification', new Recipient\UserID() );
notification_register_recipient( 'buddypress-notification', new Recipient\UserEmail() );
notification_register_recipient( 'buddypress-notification', new Recipient\Role() );
