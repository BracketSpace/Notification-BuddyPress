<?php
/**
 * Add to favorites fail trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Favorite;

use BracketSpace\Notification\BuddyPress\Trigger\Favorite as FavoriteTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Add to favorites fail trigger class
 */
class Fail extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/favorite/fail',
			'name' => __( 'Add to favorites fail', 'notification-buddypress' ),
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
	public function action( $activity_id, $user_id ) {
		$this->activity_id = $activity_id;
		$this->activity    = new \BP_Activity_Activity( $this->activity_id );
		$this->user_object = get_user_by( 'id', $user_id );
	}
}
