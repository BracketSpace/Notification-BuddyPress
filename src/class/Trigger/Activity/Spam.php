<?php
/**
 * Activity marked as spam trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity marked as spam trigger class
 */
class Spam extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/marked_as_spam',
			'name' => __( 'Activity marked as spam', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_action_spam_activity', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $activity_id Activity ID that was marked as spam.
	 * @param int $user_id     User ID associated with activity.
	 * @return mixed
	 */
	public function action( $activity_id, $user_id ) {

	}
}
