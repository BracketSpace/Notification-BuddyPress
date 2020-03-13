<?php
/**
 * Invite user to group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
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

		$this->add_action( 'notification_buddypress_group_invite', 10, 2 );
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

		$this->invitation_datetime = current_time( 'timestamp' );

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
			'name'          => __( 'Invited user ID', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'invited_user_login',
			'name'          => __( 'Invited user login', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'invited_user_email',
			'name'          => __( 'Invited user email', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'invited_user_display_name',
			'name'          => __( 'Invited user display name', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'invited_user_first_name',
			'name'          => __( 'Invited user first name', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'invited_user_last_name',
			'name'          => __( 'Invited user last name', 'notification-buddypress' ),
			'property_name' => 'invited_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'invitation_datetime',
			'name'  => __( 'Invitation date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
