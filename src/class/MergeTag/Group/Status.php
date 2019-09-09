<?php
/**
 * Group status merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Group status merge tag class
 */
class Status extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_status',
			'name'        => __( 'Group Status' ),
			'group'       => __( 'Group' ),
			'description' => __( 'Public / Private / Hidden' ),
			'example'     => true,
			'resolver'    => function() {
				return ucfirst( $this->trigger->buddy_group->status );
			},
		) );

	}

	/**
	 * Checks the requirements
	 *
	 * @return boolean
	 */
	public function check_requirements() {
		return isset( $this->trigger->buddy_group );
	}
}
