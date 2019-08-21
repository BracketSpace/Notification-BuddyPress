<?php
/**
 * Unban group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Unban group member trigger class
 */
class UnbanMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/unban_member',
			'name' => __( 'Unban group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_unban_member', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being unbanned from.
	 * @param int $user_id  ID of the user being unbanned.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		// action returns only group_id, user_id missing.
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
	}
}
