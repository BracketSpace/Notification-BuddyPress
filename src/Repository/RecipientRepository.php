<?php
/**
 * Register Recipients.
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository;

use BracketSpace\Notification\Register;

/**
 * Recipient Repository.
 */
class RecipientRepository {

	/**
	 * @return void
	 */
	public static function register() {
		Register::recipient( 'buddypress-notification', new Recipient\User() );
		Register::recipient( 'buddypress-notification', new Recipient\UserID() );
		Register::recipient( 'buddypress-notification', new Recipient\UserEmail() );
		Register::recipient( 'buddypress-notification', new Recipient\Role() );
	}

}
