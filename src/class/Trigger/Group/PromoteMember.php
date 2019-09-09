<?php
/**
 * Promote group member trigger
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Trigger\Group as GroupTrigger;
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
		$this->promotion_status     = $status;
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
			'name'          => __( 'Promoted user ID', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'promoted_user_login',
			'name'          => __( 'Promoted user login', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'promoted_user_email',
			'name'          => __( 'Promoted user email', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'promoted_user_display_name',
			'name'          => __( 'Promoted user display name', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'promoted_user_first_name',
			'name'          => __( 'Promoted user first name', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'promoted_user_last_name',
			'name'          => __( 'Promoted user last name', 'notification' ),
			'property_name' => 'promoted_user_object',
			'group'         => __( 'User', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug'  => 'promotion_datetime',
			'name'  => __( 'Promotion date and time', 'notification-buddypress' ),
			'group' => __( 'Date', 'notification' ),
		) ) );

		$this->add_merge_tag( new MergeTag\StringTag( [
			'slug'  =>  'member_status',
			'name'  => __( 'Member status', 'notification-buddypress' ),
			'resolver' => function() {
				switch( $this->promotion_status ) {
						case 'mod':
							return __( 'Moderator', 'notification-buddypress' );
							break;

						case 'admin':
							return __( 'Administrator', 'notification-buddypress' );
							break;

						default:
							return '';
				}
			}
		] ) );
	}
}
