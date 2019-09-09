<?php
/**
 * Favorite trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\MergeTag\Activity as ActivityMergeTag;


/**
 * Favorite trigger class
 */
abstract class Favorite extends Abstracts\Trigger {

	/**
	 * Constructor
	 *
	 * @param array $params Trigger configuration params.
	 */
	public function __construct( $params = array() ) {

		if ( ! isset( $params['slug'], $params['name'] ) ) {
			trigger_error( 'Favorite trigger requires slug and name params.', E_USER_ERROR );
		}

		parent::__construct( $params['slug'], $params['name'] );

		$this->set_group( __( 'BuddyPress : Favorite', 'notification-woocommerce' ) );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {
		// User that added activity to favorites.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'favoring_user_ID',
			'name'          => __( 'Favoring user ID', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'favoring_user_login',
			'name'          => __( 'Favoring user login', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'favoring_user_email',
			'name'          => __( 'favoring_user_object', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'favoring_user_display_name',
			'name'          => __( 'Favoring user display name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'favoring_user_first_name',
			'name'          => __( 'Favoring user first name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'favoring_user_last_name',
			'name'          => __( 'Favoring user last name', 'notification' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification' ),
		] ) );

		// Author user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'author_user_ID',
			'name'          => __( 'Author user ID', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'author_user_login',
			'name'          => __( 'Author user login', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'author_user_email',
			'name'          => __( 'Parent comment author user email', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'author_user_display_name',
			'name'          => __( 'Author user display name', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'author_user_first_name',
			'name'          => __( 'Author user first name', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'author_user_last_name',
			'name'          => __( 'Author user last name', 'notification' ),
			'property_name' => 'author_user_object',
			'group'         => __( 'Author', 'notification' ),
		] ) );

		$this->add_merge_tag( new ActivityMergeTag\Content() );
		$this->add_merge_tag( new ActivityMergeTag\PrimaryLink() );
	}
}
