<?php
/**
 * Remove from favorites trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Remove from favorites trigger class
 */
class RemoveFromFavorities extends ActivityTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/activity/favorities/remove',
			'name' => __( 'Activity removed from favorites', 'notification-buddypress' ),
		) );

		$this->add_action( 'bp_activity_remove_user_favorite', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $activity_id ID of the activity item being favorited.
	 * @param int $user_id     ID of the user doing the favoriting.
	 * @return mixed
	 */
	public function action( $activity_id, $user_id ) {

		$this->activity             = new \BP_Activity_Activity( $activity_id );
		$this->favoring_user_object = get_user_by( 'id', $user_id );
		$this->activity_user_object = get_user_by( 'id', $this->activity->user_id );

		$this->activity_removal_from_favorities_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'activity_removal_from_favorities_datetime',
			'name'  => __( 'Activity removal from favorities date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

		// User that added activity to favorites.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'favoring_user_ID',
			'name'          => __( 'User user ID', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'favoring_user_login',
			'name'          => __( 'User user login', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'favoring_user_email',
			'name'          => __( 'favoring_user_object', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'favoring_user_display_name',
			'name'          => __( 'User user display name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'favoring_user_first_name',
			'name'          => __( 'User user first name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'favoring_user_last_name',
			'name'          => __( 'User user last name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

	}

}
