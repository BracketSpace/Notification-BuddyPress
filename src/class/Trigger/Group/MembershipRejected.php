<?php
/**
 * Membership rejected trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Membership rejected trigger class
 */
class MembershipRejected extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/membership_rejected',
			'name' => __( 'Membership rejected', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_membership_rejected', 100, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int  $user_id  ID of the user who rejected membership.
	 * @param int  $group_id ID of the group that was rejected membership to.
	 * @param bool $status   If membership was rejected.
	 * @return mixed
	 */
	public function action( $user_id, $group_id, $status ) {
		$this->group_id          = $group_id;
		$this->buddy_group       = groups_get_group( $group_id );
		$this->banned_user       = $user_id;
		$this->membership_status = $status;
	}
}
