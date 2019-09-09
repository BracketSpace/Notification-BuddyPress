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

		$this->add_action( 'bp_activity_before_delete', 10, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array $activities Array of activities.
   * @param array $r          Array of parsed arguments.
	 * @return mixed
	 */
	public function action( $activities, $r ) {
		if ( ( 'activity' !== $activities[0]['component'] ) && ( 'activity_update' !== $activities[0]['type'] ) ) {
			return false;
		}

		$this->activity              = new BP_Activity_Activity( $activities[0]['id'] );
		$this->activity_author_object = get_user_by( 'id', $activities[0]['user_id'] );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'activty_delettion_datetime',
			'name'  => __( 'Activity deletion date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );
	}
}
