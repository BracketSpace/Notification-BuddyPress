<?php
/**
 * Group forum enabled merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Group forum enabled merge tag class
 */
class ForumEnabled extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_forum_enabled',
			'name'        => __( 'Group Forum Enabled' ),
			'description' => 123,
			'example'     => true,
			'resolver'    => function() {
				return ( $this->trigger->buddy_group->enable_forum === '1' ) ? __( 'Enabled' ) : __( 'Disabled' );
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