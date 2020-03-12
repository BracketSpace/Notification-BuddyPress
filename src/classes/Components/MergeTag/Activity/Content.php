<?php
/**
 * Activity content merge tag
 *
 * Requirements:
 * - `activity` property with BP_Activity_Activity object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\MergeTag\Activity;

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
			'group'       => __( 'Activity' ),
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
