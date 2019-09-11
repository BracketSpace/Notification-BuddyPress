<?php
/**
 * Friendship trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Friendship trigger class
 */
abstract class Friendship extends Abstracts\Trigger {

	/**
	 * Constructor
	 *
	 * @param array $params Trigger configuration params.
	 */
	public function __construct( $params = array() ) {

		if ( ! isset( $params['slug'], $params['name'] ) ) {
			trigger_error( 'Friendship trigger requires slug and name params.', E_USER_ERROR );
		}

		parent::__construct( $params['slug'], $params['name'] );

		$this->set_group( __( 'BuddyPress : Friendship', 'notification-woocommerce' ) );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		// Initiator user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'initiator_user_ID',
			'name'          => __( 'Initiator user ID', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'initiator_user_login',
			'name'          => __( 'Initiator user login', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'initiator_user_email',
			'name'          => __( 'Initiator user email', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'initiator_user_display_name',
			'name'          => __( 'Initiator user display name', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'initiator_user_first_name',
			'name'          => __( 'Initiator user first name', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'initiator_user_last_name',
			'name'          => __( 'Initiator user last name', 'notification' ),
			'property_name' => 'friendship_initiator_user_object',
			'group'         => __( 'Initiator', 'notification' ),
		] ) );

		// Friend user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'friend_user_ID',
			'name'          => __( 'Friend user ID', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'friend_user_login',
			'name'          => __( 'Friend user login', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'friend_user_email',
			'name'          => __( 'Friend user email', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'friend_user_display_name',
			'name'          => __( 'Friend user display name', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'friend_user_first_name',
			'name'          => __( 'Friend user first name', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'friend_user_last_name',
			'name'          => __( 'Friend user last name', 'notification' ),
			'property_name' => 'friendship_friend_user_object',
			'group'         => __( 'Friend', 'notification' ),
		] ) );
	}
}
