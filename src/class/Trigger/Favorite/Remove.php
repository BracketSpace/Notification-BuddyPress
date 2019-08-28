<?php
/**
 * Remove from favorites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Favorite;

use BracketSpace\Notification\BuddyPress\Trigger\Favorite as FavoriteTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Remove from favorites trigger class
 */
class Remove extends FavoriteTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/favorite/remove',
			'name' => __( 'Remove from favorites', 'notification-buddypress' ),
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
		$this->activity_id          = $activity_id;
		$this->activity             = new \BP_Activity_Activity( $this->activity_id );
		$this->favorite_user_object = get_user_by( 'id', $user_id );
		$this->author_user_object   = get_user_by( 'id', $this->activity->user_id );
	}
}
