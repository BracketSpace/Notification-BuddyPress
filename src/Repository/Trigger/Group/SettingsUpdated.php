<?php
/**
 * Group settings updated trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Group settings updated trigger class
 */
class SettingsUpdated extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/settings_updated',
			'name' => __( 'Group settings updated', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_settings_updated', 10 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id Newly created group ID.
	 * @return mixed
	 */
	public function context( $group_id ) {

		$this->group_id    = $group_id;
		$this->buddy_group = groups_get_group( $this->group_id );

		$this->settings_update_datetime = $this->cache( 'settings_update_datetime', time() );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'settings_update_datetime',
			'name'  => __( 'Settings update date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
