<?php
/**
 * Premote group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Premote group member trigger class
 */
class PremoteMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/premote_member',
			'name' => __( 'Premote group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_promote_member', 1000, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int    $group_id ID of the group being promoted in.
	 * @param int    $user_id  ID of the user being promoted.
	 * @param string $status   New status being promoted to.
	 * @return mixed
	 */
	public function action( $group_id, $user_id, $status ) {
		$this->group_id = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
		$this->promoted_user = $user_id;
		$this->promotion_status = $status;
	}
}
