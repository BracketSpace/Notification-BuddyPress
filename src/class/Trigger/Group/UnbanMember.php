<?php
/**
 * Unban group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Unban group member trigger class
 */
class UnbanMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/unban_member',
			'name' => __( 'Unban group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_unban_member', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being unbanned from.
	 * @param int $user_id  ID of the user being unbanned.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id             = $group_id;
		$this->buddy_group          = groups_get_group( $group_id );
		$this->unbanned_user_object = get_user_by( 'id', $user_id );
	}


	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		// Banned user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'unbanned_user_ID',
			'name'          => __( 'Unbanned user ID', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'unbanned_user_login',
			'name'          => __( 'Unbanned user login', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'unbanned_user_email',
			'name'          => __( 'Unbanned user email', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'unbanned_user_display_name',
			'name'          => __( 'Unbanned user display name', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'unbanned_user_first_name',
			'name'          => __( 'Unbanned user first name', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'unbanned_user_last_name',
			'name'          => __( 'Unbanned user last name', 'notification' ),
			'property_name' => 'unbanned_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'unban_datetime',
			'name'  => __( 'Unban date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );
	}
}
