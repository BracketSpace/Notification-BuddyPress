<?php
/**
 * Activity comment trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity comment trigger class
 */
class Comment extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/comment',
			'name' => __( 'Activity comment', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_post_type_comment', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array $activity_array Array with activity data.
	 * @return mixed
	 */
	public function action( $activity_array ) {

	}
}
