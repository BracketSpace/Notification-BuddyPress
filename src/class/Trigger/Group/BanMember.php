<?php
/**
 * Ban group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Ban group member trigger class
 */
class BanMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/ban_member',
			'name' => __( 'Ban group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_ban_member', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being banned from.
	 * @param int $user_id  ID of the user being banned.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
		$this->banned_user = $user_id;
	}
}
