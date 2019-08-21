<?php
/**
 * Membership requested trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Membership requested trigger class
 */
class MembershipRequested extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/membership_requested',
			'name' => __( 'Membership requested', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_membership_requested', 100, 4 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int   $user_id  ID of the user requesting membership.
	 * @param array $admins              Array of group admins.
	 * @param int   $group_id            ID of the group being requested to.
	 * @param int   $membership_id ID of the membership.
	 * @return mixed
	 */
	public function action( $user_id, $admins, $group_id, $membership_id ) {
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
		$this->banned_user = $user_id;
	}
}
