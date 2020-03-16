<?php
/**
 * Ban group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Ban group member trigger class
 */
class BanMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/ban_member',
			'name' => __( 'Ban group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_ban_member', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being banned from.
	 * @param int $user_id  ID of the user being banned.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {

		$this->group_id           = $group_id;
		$this->buddy_group        = groups_get_group( $group_id );
		$this->banned_user_object = get_user_by( 'id', $user_id );

		$this->ban_datetime = $this->cache( 'ban_datetime', time() );

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
			'slug'          => 'banned_user_ID',
			'name'          => __( 'Banned user ID', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'banned_user_login',
			'name'          => __( 'Banned user login', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'banned_user_email',
			'name'          => __( 'Banned user email', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'banned_user_display_name',
			'name'          => __( 'Banned user display name', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'banned_user_first_name',
			'name'          => __( 'Banned user first name', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'banned_user_last_name',
			'name'          => __( 'Banned user last name', 'notification-buddypress' ),
			'property_name' => 'banned_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'ban_datetime',
			'name'  => __( 'Ban date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
