<?php
/**
 * Remove group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Remove group member trigger class
 */
class RemoveMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/remove_member',
			'name' => __( 'Remove group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_remove_member', 100, 2 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being removed from.
	 * @param int $user_id  ID of the user being removed.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {

		$this->group_id     = $group_id;
		$this->buddy_group  = groups_get_group( $group_id );
		$this->removed_user = $user_id;

		$this->removal_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		// Removed user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'removed_user_ID',
			'name'          => __( 'Removed user ID', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'removed_user_login',
			'name'          => __( 'Removed user login', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'removed_user_email',
			'name'          => __( 'Removed user email', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'removed_user_display_name',
			'name'          => __( 'Removed user display name', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'removed_user_first_name',
			'name'          => __( 'Removed user first name', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'removed_user_last_name',
			'name'          => __( 'Removed user last name', 'notification' ),
			'property_name' => 'removed_user',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'removal_datetime',
			'name'  => __( 'Member removal date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

	}

}
