<?php
/**
 * Remove from favorites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Remove from favorites trigger class
 */
class RemoveFromFavorities extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/favorities/remove',
			'name' => __( 'Activity removed from favorites', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_remove_user_favorite', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $activity_id ID of the activity item being favorited.
	 * @param int $user_id     ID of the user doing the favoriting.
	 * @return mixed
	 */
	public function action( $activity_id, $user_id ) {

		$this->activity             = new \BP_Activity_Activity( $activity_id );
		$this->favoring_user_object = get_user_by( 'id', $user_id );
		$this->activity_user_object = get_user_by( 'id', $this->activity->user_id );

		$this->activity_removal_from_favorities_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		parent::favoring_user_merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'activity_removal_from_favorities_datetime',
			'name'  => __( 'Activity removal from favorities date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

	}

}
