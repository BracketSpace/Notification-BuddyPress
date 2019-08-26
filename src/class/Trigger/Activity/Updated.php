<?php
/**
 * Activity updated trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity updated trigger class
 */
class Updated extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/updated',
			'name' => __( 'Activity updated', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_posted_update', 10, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param string $content     Content of the activity post update.
	 * @param int    $user_id     ID of the user posting the activity update.
	 * @param int    $activity_id ID of the activity item being updated.
	 * @return mixed
	 */
	public function action( $content, $user_id, $activity_id ) {

	}
}
