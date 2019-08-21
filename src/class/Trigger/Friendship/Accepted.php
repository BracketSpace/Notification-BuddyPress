<?php
/**
 * Friendship accepted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Friendship accepted trigger class
 */
class Accepted extends FriendshipTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/friendship/accepted',
			'name' => __( 'Friendship accepted', 'notification-buddypress' ),
		) );

		$this->add_action( 'friends_friendship_accepted', 10, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group Newly created group ID.
	 * @return mixed
	 */
	public function action( $friendship_id, $friendship_initiatior_user_id, $friendship_friend_user_id ) {
		$this->friendship_id = $friendship_id;
		$this->friendship_initiator_user_id = $friendship_initiatior_user_id;
		$this->friendship_friend_user_id = $friendship_friend_user_id;
	}
}
