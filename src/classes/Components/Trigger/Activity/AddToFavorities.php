<?php
/**
 * Add to favorites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Add to favorites trigger class
 */
class AddToFavorities extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/favorities/add',
			'name' => __( 'Activity added to favorites', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_add_user_favorite', 100, 2 );
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

		$this->activity_favorited_datetime = $this->cache( 'activity_favorited_datetime', time() );

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
			'slug'  => 'activity_favorited_datetime',
			'name'  => __( 'Activity favorited date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
