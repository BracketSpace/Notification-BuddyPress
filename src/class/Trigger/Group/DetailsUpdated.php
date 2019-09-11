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

		$this->add_action( 'groups_details_updated', 10, 3 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int             $group_id          ID of the group.
	 * @param BP_Groups_Group $old_group      Group object, before being modified.
	 * @param bool            $notify_members Whether to send an email notification to members about the change.
	 * @return mixed
	 */
	public function action( $group_id, $old_group, $notify_members ) {
		if ( 0 === $notify_members ) {
			return false;
		}

		$this->group_id    = $group_id;
		$this->buddy_group = groups_get_group( $group_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'details_update_datetime',
			'name'  => __( 'Details updated date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );
	}
}
