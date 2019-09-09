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
		if ( 'activity_update' !== $r['type'] ) {
			return;
		}

		$this->activity = new \BP_Activity_Activity( $activity_id );
		$this->activity_author_object = get_user_by( 'id', $r['user_id'] );
	}


	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'activty_added_datetime',
			'name'  => __( 'Activity added date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );
	}
}
