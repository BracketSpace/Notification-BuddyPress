<?php
/**
 * Group slug merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Group;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Group slug merge tag class
 */
class Slug extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'group_slug',
			'name'        => __( 'Group Slug' ),
			'group'       => __( 'Group' ),
			'description' => 'my-super-example-group',
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->buddy_group->slug;
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
