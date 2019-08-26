<?php
/**
 * Friendship requested trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Friendship requested trigger class
 */
class Requested extends FriendshipTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/friendship/requested',
			'name' => __( 'Friendship requested', 'notification-buddypress' ),
		) );

		$this->add_action( 'friends_friendship_requested', 10, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group Newly created group ID.
	 * @return mixed
	 */
	public function action( $friendship_id, $friendship_initiatior_user_id, $friendship_friend_user_id ) {
		$this->friendship_id                    = $friendship_id;
		$this->friendship_initiator_user_object = get_user_by( 'id', $friendship_initiatior_user_id );
		$this->friendship_friend_user_object    = get_user_by( 'id', $friendship_friend_user_id );
	}
}