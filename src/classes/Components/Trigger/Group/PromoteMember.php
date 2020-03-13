<?php
/**
 * Promote group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Components\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Promote group member trigger class
 */
class PromoteMember extends GroupTrigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( array(
			'slug' => 'buddypress/group/promote_member',
			'name' => __( 'Promote group member', 'notification-buddypress' ),
		) );

		$this->add_action( 'groups_promote_member', 1000, 3 );

	}

	/**
	 * Hooks to the action.
	 *
	 * @param int    $group_id ID of the group being promoted in.
	 * @param int    $user_id  ID of the user being promoted.
	 * @param string $status   New status being promoted to.
	 * @return mixed
	 */
	public function action( $group_id, $user_id, $status ) {

		$this->group_id             = $group_id;
		$this->buddy_group          = groups_get_group( $group_id );
		$this->promoted_user_object = get_user_by( 'id', $user_id );

		switch ( $status ) {
			case 'mod':
				$this->promotion_status = __( 'Moderator', 'notification-buddypress' );
				break;

			case 'admin':
				$this->promotion_status = __( 'Administrator', 'notification-buddypress' );
				break;

			default:
				$this->promotion_status = __( 'Undefined', 'notification-buddypress' );
				break;
		}

		$this->promotion_datetime = current_time( 'timestamp' );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		parent::merge_tags();

		// Promoted user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'promoted_user_ID',
			'name'          => __( 'Promoted user ID', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'promoted_user_login',
			'name'          => __( 'Promoted user login', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'promoted_user_email',
			'name'          => __( 'Promoted user email', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'promoted_user_display_name',
			'name'          => __( 'Promoted user display name', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'promoted_user_first_name',
			'name'          => __( 'Promoted user first name', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'promoted_user_last_name',
			'name'          => __( 'Promoted user last name', 'notification-buddypress' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\StringTag( [
			'slug'        => 'promoted_user_status',
			'name'        => __( 'Promoted user status in group', 'notification-buddypress' ),
			'description' => __( 'Either Moderator or Administrator', 'notification-buddypress' ),
			'group'       => __( 'User', 'notification-buddypress' ),
			'resolver'    => function( $trigger ) {
				return $trigger->promotion_status;
			},
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'promotion_datetime',
			'name'  => __( 'Promotion date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification-buddypress' ),
		) ) );

	}

}
