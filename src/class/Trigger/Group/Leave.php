<?php
/**
 * Leave group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Leave group trigger class
 */
class Leave extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/leave',
			'name' => __( 'Leave group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_leave_group', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being invited to.
	 * @param int $user_id  ID of the user being invited.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id            = $group_id;
		$this->buddy_group         = groups_get_group( $group_id );
		$this->leaving_user_object = get_user_by( 'id', $user_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		// Leaving user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'leaving_user_ID',
			'name'          => __( 'Leaving user ID', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'leaving_user_login',
			'name'          => __( 'Leaving user login', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'leaving_user_email',
			'name'          => __( 'Leaving user email', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'leaving_user_display_name',
			'name'          => __( 'Leaving user display name', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'leaving_user_first_name',
			'name'          => __( 'Leaving user first name', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'leaving_user_last_name',
			'name'          => __( 'Leaving user last name', 'notification' ),
			'property_name' => 'leaving_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );
	}
}