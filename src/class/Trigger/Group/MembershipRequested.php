<?php
/**
 * Membership requested trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\MergeTag\Group as GroupMergeTag;


/**
 * Membership requested trigger class
 */
class MembershipRequested extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/membership_requested',
			'name' => __( 'Membership requested', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_membership_requested', 100, 4 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int   $user_id  ID of the user requesting membership.
	 * @param array $admins              Array of group admins.
	 * @param int   $group_id            ID of the group being requested to.
	 * @param int   $membership_id ID of the membership.
	 * @return mixed
	 */
	public function action( $user_id, $admins, $group_id, $membership_id ) {
		$this->group_id               = $group_id;
		$this->buddy_group            = groups_get_group( $group_id );
		$this->requesting_user_object = get_user_by( 'id', $user_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		$this->add_merge_tag( new GroupMergeTag\MembershipRequestsLink() );

		// Requesting user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'requesting_user_ID',
			'name'          => __( 'Requesting user ID', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'requesting_user_login',
			'name'          => __( 'Requesting user login', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'requesting_user_email',
			'name'          => __( 'Requesting user email', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'requesting_user_display_name',
			'name'          => __( 'Requesting user display name', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'requesting_user_first_name',
			'name'          => __( 'Requesting user first name', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'requesting_user_last_name',
			'name'          => __( 'Requesting user last name', 'notification' ),
			'property_name' => 'requesting_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'membership_request_datetime',
			'name'  => __( 'Membership requested date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );
	}
}
