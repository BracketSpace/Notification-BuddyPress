<?php
/**
 * Activity deleted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\MergeTag\Activity as ActivityMergeTag;


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

		$this->add_action( 'bp_activity_delete', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array $deleted_activity Array of deleted activity.
	 * @return mixed
	 */
	public function action( $deleted_activity ) {

		$this->activity             = new \BP_Activity_Activity( $deleted_activity['id'] );
		$this->activity_user_object = get_user_by( 'id', $deleted_activity['user_id'] );

		$this->activty_deleted_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'activty_deleted_datetime',
			'name'  => __( 'Activity deleted date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

	}

}
