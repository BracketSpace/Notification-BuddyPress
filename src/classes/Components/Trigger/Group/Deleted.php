<?php
/**
 * Group created trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\Components\MergeTag\Group as GroupMergeTag;

/**
 * Group created trigger class
 */
class Deleted extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/deleted',
			'name' => __( 'Group deleted', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_before_delete_group', 10 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group Newly created group ID.
	 * @return mixed
	 */
	public function action( $group ) {

		$this->buddy_group = groups_get_group( $group );

		$this->deletion_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'deletion_datetime',
			'name'  => __( 'Deletion date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
