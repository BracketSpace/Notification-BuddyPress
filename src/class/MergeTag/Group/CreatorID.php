<?php
/**
 * Group Creator ID merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\IntegerTag;


/**
 * Group creator ID merge tag class
 */
class CreatorID extends IntegerTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_creator_ID',
			'name'        => __( 'Group Creator ID' ),
			'group'       => __( 'Group' ),
			'description' => 123,
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->buddy_group->creator_id;
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
