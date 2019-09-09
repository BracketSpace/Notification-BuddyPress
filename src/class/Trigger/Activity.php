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

		// Activity author user.
		$this->add_merge_tag( new MergeTag\User\UserID( [
			'slug'          => 'activity_author_ID',
			'name'          => __( 'Activity author ID', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLogin( [
			'slug'          => 'activity_author_login',
			'name'          => __( 'Activity author login', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserEmail( [
			'slug'          => 'activity_author_email',
			'name'          => __( 'Activity author email', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserDisplayName( [
			'slug'          => 'activity_author_display_name',
			'name'          => __( 'Activity author display name', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserFirstName( [
			'slug'          => 'activity_author_first_name',
			'name'          => __( 'Activity author first name', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( [
			'slug'          => 'activity_author_last_name',
			'name'          => __( 'Activity author last name', 'notification' ),
			'property_name' => 'activity_author_object',
			'group'         => __( 'Activity author', 'notification' ),
		] ) );
	}
}
