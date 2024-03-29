<?php
/**
 * Group details updated trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
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
	 * @param int    $group_id Group ID.
	 * @param object $group    Old Group object.
	 * @param bool   $notify   If notify users.
	 * @return mixed
	 */
	public function context( $group_id, $group, $notify ) {

		if ( ! $notify ) {
			return false;
		}

		$this->group_id    = $group_id;
		$this->buddy_group = groups_get_group( $group_id );

		$this->details_update_datetime = $this->cache( 'details_update_datetime', time() );

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
			'name'  => __( 'Details update date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
