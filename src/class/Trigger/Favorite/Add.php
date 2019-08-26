<?php
/**
 * Add to favorites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Favorite;

use BracketSpace\Notification\BuddyPress\Trigger\Favorite as FavoriteTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Add to favorites trigger class
 */
class Add extends FavoriteTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/favorite/add',
			'name' => __( 'Add to favorites', 'notification-buddypress' ),
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
		$this->activity_id = $activity_id;
		$this->activity    = new \BP_Activity_Activity( $this->activity_id );
		$this->user_object = get_user_by( 'id', $user_id );
	}
}
