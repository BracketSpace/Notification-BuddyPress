<?php
/**
 * Uninvite user to group trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Uninvite user to group trigger class
 */
class UninviteUser extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/uninvite_user',
			'name' => __( 'Uninvite user to group', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_uninvite_user', 100, 2 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being uninvited to.
	 * @param int $user_id  ID of the user being uninvited.
	 * @return mixed
	 */
	public function context( $group_id, $user_id ) {

		$this->group_id       = $group_id;
		$this->buddy_group    = groups_get_group( $group_id );
		$this->uninvited_user = get_user_by( 'id', $user_id );

		$this->uninvite_datetime = $this->cache( 'uninvite_datetime', time() );

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
			'slug'          => 'uninvited_user_ID',
			'name'          => __( 'Uninvited user ID', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'uninvited_user_login',
			'name'          => __( 'Uninvited user login', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'uninvited_user_email',
			'name'          => __( 'Uninvited user email', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'uninvited_user_display_name',
			'name'          => __( 'Uninvited user display name', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'uninvited_user_first_name',
			'name'          => __( 'Uninvited user first name', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'uninvited_user_last_name',
			'name'          => __( 'Uninvited user last name', 'notification-buddypress' ),
			'property_name' => 'uninvited_user',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'uninvite_datetime',
			'name'  => __( 'Uninvite date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
