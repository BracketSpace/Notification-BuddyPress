<?php
/**
 * Add to favorites fail trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Add to favorites fail trigger class
 */
class AddToFavoritiesFail extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/favorities/fail',
			'name' => __( 'Activity failed to add to favorites', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_add_user_favorite_fail', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $activity_id ID of the activity item being favorited.
	 * @param int $user_id     ID of the user doing the favoriting.
	 * @return mixed
	 */
	public function context( $activity_id, $user_id ) {

		$this->activity             = new \BP_Activity_Activity( $activity_id );
		$this->favoring_user_object = get_user_by( 'id', $user_id );
		$this->activity_user_object = get_user_by( 'id', $this->activity->user_id );

		$this->activity_favorited_fail_datetime = $this->cache( 'activity_favorited_fail_datetime', time() );

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
			'slug'  => 'activity_favorited_fail_datetime',
			'name'  => __( 'Activity favorited fail date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
