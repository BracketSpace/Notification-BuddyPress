<?php
/**
 * Group description merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Group description merge tag class
 */
class Description extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_description',
			'name'        => __( 'Group description' ),
			'group'       => __( 'Group' ),
			'description' => 'My Super Example Group is awesome!',
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->buddy_group->description;
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
