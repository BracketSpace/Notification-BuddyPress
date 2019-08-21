<?php
/**
 * Send group invites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Send group invites trigger class
 */
class SendInvites extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/send_invites',
			'name' => __( 'Invites sent to group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_send_invites', 11, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int   $group_id       ID of the group who's being invited to.
   * @param array $invited_users  Array of users being invited to the group.
   * @param int   $inviting_user  ID of the inviting user.
	 * @return mixed
	 */
	public function action( $group_id, $invited_users, $inviting_user ) {
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
		$this->invited_users = $invited_users;
		$this->inviting_user = $inviting_user;
	}
}
