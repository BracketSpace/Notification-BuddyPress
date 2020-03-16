<?php
/**
 * Group created trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Group created trigger class
 */
class CreateComplete extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/new',
			'name' => __( 'Group created', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_group_create_complete', 10 );
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

		$this->creation_datetime = $this->cache( 'creation_datetime', time() );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'creation_datetime',
			'name'  => __( 'Creation date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
