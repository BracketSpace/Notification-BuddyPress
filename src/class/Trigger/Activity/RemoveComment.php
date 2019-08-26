<?php
/**
 * Activity remove comment trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Activity comment_removed trigger class
 */
class RemoveComment extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/comment_removed',
			'name' => __( 'Activity comment removed', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_post_type_remove_comment', 10 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param bool       $deleted                 True if the activity was deleted false otherwise.
	 * @param WP_Comment $comment                 Comment object.
	 * @param object     $activity_post_object    The post type tracking args object.
	 * @param object     $activity_comment_object The post type tracking args object.
	 * @return mixed
	 */
	public function action( $deleted, $comment, $activity_post_object, $activity_comment_object ) {

	}
}
