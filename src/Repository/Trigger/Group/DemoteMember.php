<?php
/**
 * Demote group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Demote group member trigger class
 */
class DemoteMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/demote_member',
			'name' => __( 'Demote group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_demote_member', 10, 2 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $group_id ID of the group being demoted from.
	 * @param int $user_id  ID of the user being demoted.
	 * @return mixed
	 */
	public function context( $group_id, $user_id ) {

		$this->group_id     = $group_id;
		$this->buddy_group  = groups_get_group( $group_id );
		$this->demoted_user = get_user_by( 'id', $user_id );

		$this->demotion_datetime = $this->cache( 'demotion_datetime', time() );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		// Demoted user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'demoted_user_ID',
			'name'          => __( 'Demoted user ID', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'demoted_user_login',
			'name'          => __( 'Demoted user login', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'demoted_user_email',
			'name'          => __( 'Demoted user email', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'demoted_user_display_name',
			'name'          => __( 'Demoted user display name', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'demoted_user_first_name',
			'name'          => __( 'Demoted user first name', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'demoted_user_last_name',
			'name'          => __( 'Demoted user last name', 'notification-buddypress' ),
			'property_name' => 'demoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'demotion_datetime',
			'name'  => __( 'Demotion date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
