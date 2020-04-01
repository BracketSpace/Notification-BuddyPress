<?php
/**
 * Friendship accepted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Friendship as FriendshipTrigger;
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
	 * @param int $friendship_id                ID of the pending friendship object.
	 * @param int $friendship_initiator_user_id ID of the friendship initiator.
	 * @param int $friendship_friend_user_id    ID of the user requested friendship with.
	 * @return mixed
	 */
	public function action( $friendship_id, $friendship_initiator_user_id, $friendship_friend_user_id ) {

		$this->friendship_id                    = $friendship_id;
		$this->friendship_initiator_user_object = get_user_by( 'id', $friendship_initiator_user_id );
		$this->friendship_friend_user_object    = get_user_by( 'id', $friendship_friend_user_id );

		$this->friendship_acceptance_datetime = $this->cache( 'friendship_acceptance_datetime', time() );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'friendship_acceptance_datetime',
			'name'  => __( 'Friendship acceptance date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
