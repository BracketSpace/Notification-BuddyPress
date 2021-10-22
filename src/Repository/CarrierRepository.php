<?php
/**
 * Register Carriers.
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository;

use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\DocHooks\Helper as DocHooksHelper;
use BracketSpace\Notification\Register;

/**
 * Carrier Repository.
 */
class CarrierRepository {

	/**
	 * @return void
	 */
	public static function register() {
		if ( notification_get_setting( 'carriers/buddypress/enable' ) ) {
			Register::carrier( DocHooksHelper::hook( new Carrier\BuddyPressNotification() ) );
		}
	}

}
