<?php
/**
 * Activity trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\Repository\MergeTag\Activity as ActivityMergeTag;

/**
 * Activity trigger class
 */
abstract class Activity extends Abstracts\Trigger {

	/**
	 * Constructor
	 *
	 * @param array $params Trigger configuration params.
	 */
	public function __construct( $params = array() ) {

		if ( ! isset( $params['slug'], $params['name'] ) ) {
			trigger_error( 'Activity trigger requires slug and name params.', E_USER_ERROR );
		}

		parent::__construct( $params['slug'], $params['name'] );

		$this->set_group( __( 'BuddyPress : Activity', 'notification-buddypress' ) );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		// Activity.
		$this->add_merge_tag( new ActivityMergeTag\PrimaryLink() );
		$this->add_merge_tag( new ActivityMergeTag\Content() );

		// Activity author.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'activity_user_ID',
			'name'          => __( 'Activity user ID', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'activity_user_login',
			'name'          => __( 'Activity user login', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'activity_user_email',
			'name'          => __( 'Activity user email', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'activity_user_display_name',
			'name'          => __( 'Activity user display name', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'activity_user_first_name',
			'name'          => __( 'Activity user first name', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'activity_user_last_name',
			'name'          => __( 'Activity user last name', 'notification-buddypress' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification-buddypress' ),
		] ) );

	}

	/**
	 * Registers favoring user merge tags
	 *
	 * @uses $this->favoring_user_object User object property.
	 * @return void
	 */
	public function favoring_user_merge_tags() {

		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'favoring_user_ID',
			'name'          => __( 'Favoring user ID', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'favoring_user_login',
			'name'          => __( 'Favoring user login', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'favoring_user_email',
			'name'          => __( 'Favoring user email', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'favoring_user_display_name',
			'name'          => __( 'Favoring user display name', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'favoring_user_first_name',
			'name'          => __( 'Favoring user first name', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'favoring_user_last_name',
			'name'          => __( 'Favoring user last name', 'notification-buddypress' ),
			'property_name' => 'favoring_user_object',
			'group'         => __( 'Favoring user', 'notification-buddypress' ),
		] ) );

	}

}
