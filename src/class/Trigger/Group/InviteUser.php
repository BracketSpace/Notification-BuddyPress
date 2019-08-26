<?php
/**
 * Invite user to group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Invite user to group trigger class
 */
class InviteUser extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/invite_user',
			'name' => __( 'Invite user to group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_invite_user', 100, 2 );
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
		$this->invited_user_object = get_user_by( 'id', $user_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		// Invited user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'invited_user_ID',
			'name'          => __( 'Invited user ID', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'invited_user_login',
			'name'          => __( 'Invited user login', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'invited_user_email',
			'name'          => __( 'Invited user email', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'invited_user_display_name',
			'name'          => __( 'Invited user display name', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'invited_user_first_name',
			'name'          => __( 'Invited user first name', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'invited_user_last_name',
			'name'          => __( 'Invited user last name', 'notification' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );
	}
}
