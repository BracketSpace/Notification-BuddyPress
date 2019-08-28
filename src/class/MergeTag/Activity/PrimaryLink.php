<?php
/**
 * Activity primary link merge tag
 *
 * Requirements:
 * - `activity` property with BP_Activity_Activity object.
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\MergeTag\Activity;

use BracketSpace\Notification\Defaults\MergeTag\UrlTag;


/**
 * Activity primary link merge tag class
 */
class PrimaryLink extends UrlTag {

	/**
	 * Merge tag constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct( array(
			'slug'        => 'activity_primary_link',
			'name'        => __( 'Activity primary link' ),
			'group'       => __( 'Activity' ),
			'description' => 'My Super News is awesome!',
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->activity->primary_link;
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
