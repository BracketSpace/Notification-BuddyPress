<?php
/**
 * Membership rejected trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Membership rejected trigger class
 */
class MembershipRejected extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/membership_rejected',
			'name' => __( 'Membership rejected', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_membership_rejected', 100, 3 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int  $user_id  ID of the user who rejected membership.
	 * @param int  $group_id ID of the group that was rejected membership to.
	 * @param bool $status   If membership was rejected.
	 * @return mixed
	 */
	public function action( $user_id, $group_id, $status ) {

		$this->group_id             = $group_id;
		$this->buddy_group          = groups_get_group( $group_id );
		$this->rejected_user_object = get_user_by( 'id', $user_id );
		$this->membership_status    = $status;

		$this->membership_rejection_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		// Rejected user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'rejected_user_ID',
			'name'          => __( 'Rejected user ID', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'rejected_user_login',
			'name'          => __( 'Rejected user login', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'rejected_user_email',
			'name'          => __( 'Rejected user email', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'rejected_user_display_name',
			'name'          => __( 'Rejected user display name', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'rejected_user_first_name',
			'name'          => __( 'Rejected user first name', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'rejected_user_last_name',
			'name'          => __( 'Rejected user last name', 'notification' ),
			'property_name' => 'rejected_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'membership_rejection_datetime',
			'name'  => __( 'Membership rejection date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

	}

}
