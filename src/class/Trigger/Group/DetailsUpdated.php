<?php
/**
 * Group details updated trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Group details updated trigger class
 */
class DetailsUpdated extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/details_updated',
			'name' => __( 'Group details updated', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_details_updated', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group Newly created group ID.
	 * @return mixed
	 */
	public function action( $group ) {
		$this->group_id    = $group;
		$this->buddy_group = groups_get_group( $group );
	}
}