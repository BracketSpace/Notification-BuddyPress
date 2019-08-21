<?php
/**
 * Leave group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Leave group trigger class
 */
class Leave extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/leave',
			'name' => __( 'Leave group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_leave_group', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being invited to.
	 * @param int $user_id  ID of the user being invited.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
		$this->user = $user_id;
	}
}
