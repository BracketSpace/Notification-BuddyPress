<?php
/**
 * Friendship deleted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Friendship deleted trigger class
 */
class Deleted extends FriendshipTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/friendship/deleted',
			'name' => __( 'Friendship deleted', 'notification-buddypress' ),
		) );

		$this->add_action( 'friends_friendship_post_delete', 10, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group Newly created group ID.
	 * @return mixed
	 */
	public function action( $friendship_initiatior_user_id, $friendship_friend_user_id ) {
		$this->friendship_initiator_user_object = get_user_by( 'id', $friendship_initiatior_user_id );
		$this->friendship_friend_user_object    = get_user_by( 'id', $friendship_friend_user_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();
	}
}