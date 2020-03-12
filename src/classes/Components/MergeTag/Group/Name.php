<?php
/**
 * Group name merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Group name merge tag class
 */
class Name extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_name',
			'name'        => __( 'Group name' ),
			'description' => __( 'My Super Example Group' ),
			'group'       => __( 'Group' ),
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->buddy_group->name;
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
