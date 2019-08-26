<?php
/**
 * Activity content merge tag
 *
 * Requirements:
 * - `buddy_group` property with BP_Groups_Group group object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Activity;

use BracketSpace\Notification\Defaults\MergeTag\StringTag;


/**
 * Activity content merge tag class
 */
class Content extends StringTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'activity_content',
			'name'        => __( 'Activity content' ),
			'description' => 'My Super News is awesome!',
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->activity->content;
			},
		) );

	}

	/**
	 * Checks the requirements
	 *
	 * @return boolean
	 */
	public function check_requirements() {
		return isset( $this->trigger->activity );
	}
}
