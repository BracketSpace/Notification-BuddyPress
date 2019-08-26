<?php
/**
 * Join group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Join group trigger class
 */
class Join extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/join',
			'name' => __( 'Join group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_join_group', 100, 2 );
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being invited to.
	 * @param int $user_id  ID of the user being invited.
	 * @return mixed
	 */
	public function action( $group_id, $user_id ) {
		$this->group_id           = $group_id;
		$this->buddy_group        = groups_get_group( $group_id );
		$this->joined_user_object = get_user_by( 'id', $user_id );
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		parent::merge_tags();

		// Joining user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'joined_user_ID',
			'name'          => __( 'Joined user ID', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'joined_user_login',
			'name'          => __( 'Joined user login', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'joined_user_email',
			'name'          => __( 'Joined user email', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'joined_user_display_name',
			'name'          => __( 'Joined user display name', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'joined_user_first_name',
			'name'          => __( 'Joined user first name', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'joined_user_last_name',
			'name'          => __( 'Joined user last name', 'notification' ),
			'property_name' => 'joined_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );
	}
}