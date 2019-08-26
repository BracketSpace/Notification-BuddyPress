<?php
/**
 * Activity added trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity added trigger class
 */
class Added extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/added',
			'name' => __( 'Activity added', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_add', 10, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array $r           Array of parsed arguments for the activity item being added.
	 * @param int   $activity_id The id of the activity item being added.
	 * @return mixed
	 */
	public function action( $r, $activity_id ) {
		print_r( $r );
	}
}
