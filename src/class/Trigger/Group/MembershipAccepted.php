<?php
/**
 * Membership accepted trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Membership accepted trigger class
 */
class MembershipAccepted extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/membership_accepted',
			'name' => __( 'Membership accepted', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_membership_accepted', 100, 3 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int  $user_id  ID of the user who accepted membership.
	 * @param int  $group_id ID of the group that was accepted membership to.
	 * @param bool $status   If membership was accepted.
	 * @return mixed
	 */
	public function action( $user_id, $group_id, $status ) {

		$this->group_id      = $group_id;
		$this->buddy_group   = groups_get_group( $group_id );
		$this->accepted_user = $user_id;

		$this->membership_accepted_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		// Accepted user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'accepted_user_ID',
			'name'          => __( 'Accepted user ID', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'accepted_user_login',
			'name'          => __( 'Accepted user login', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'accepted_user_email',
			'name'          => __( 'Accepted user email', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'accepted_user_display_name',
			'name'          => __( 'Accepted user display name', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'accepted_user_first_name',
			'name'          => __( 'Accepted user first name', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'accepted_user_last_name',
			'name'          => __( 'Accepted user last name', 'notification' ),
			'property_name' => 'accepted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'membership_accepted_datetime',
			'name'  => __( 'Membership accepted date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

	}

}
