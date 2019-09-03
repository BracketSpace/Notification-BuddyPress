<?php
/**
 * Activity trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\MergeTag\Activity as ActivityMergeTag;

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

		$this->set_group( __( 'BuddyPress : Activity', 'notification-woocommerce' ) );

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
			'name'          => __( 'Banned user ID', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'activity_user_login',
			'name'          => __( 'Banned user login', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'activity_user_email',
			'name'          => __( 'Banned user email', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'activity_user_display_name',
			'name'          => __( 'Banned user display name', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'activity_user_first_name',
			'name'          => __( 'Banned user first name', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'activity_user_last_name',
			'name'          => __( 'Banned user last name', 'notification' ),
			'property_name' => 'activity_user_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );
	}
}
