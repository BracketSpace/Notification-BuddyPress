<?php
/**
 * Carriers
 *
 * @package notification-buddypress
 */

use BracketSpace\Notification\BuddyPress\Components\Carrier;
use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\DocHooks\Helper as DocHooksHelper;

notification_register_carrier( DocHooksHelper::hook( new Carrier\BuddyPressNotification() ) );
