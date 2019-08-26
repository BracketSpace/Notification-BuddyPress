<?php
/**
 * Uninvite user to group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Uninvite user to group trigger class
 */
class UninviteUser extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/uninvite_user',
			'name' => __( 'Uninvite user to group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_uninvite_user', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being uninvited to.
	 * @param int $user_id  ID of the user being uninvited.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id       = $group_id;
		$this->buddy_group    = groups_get_group( $group_id );
		$this->uninvited_user = $user_id;
	}
}
