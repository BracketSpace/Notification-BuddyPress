<?php
/**
 * Activity deleted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity deleted trigger class
 */
class Deleted extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/deleted',
			'name' => __( 'Activity deleted', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_deleted_activities', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array $activity_ids_deleted Array of affected activity item IDs.
	 * @return mixed
	 */
	public function action( $activity_ids_deleted ) {
		$this->deleted_activities = implode( ',', $activity_ids_deleted );
	}
}
