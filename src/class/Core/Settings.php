<?php
/**
 * Settings class
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Core;

use BracketSpace\Notification\Utils\Settings\CoreFields;

/**
 * Settings class
 */
class Settings {

	/**
	 * Registers settings
	 *
	 * @param object $settings Settings API object.
	 * @return void
	 */
	public function register_settings( $settings ) {

		$carriers = $settings->add_section( __( 'Carriers', 'notification-buddypress' ), 'notifications' );

		$carriers->add_group( __( 'BuddyPress', 'notification-buddypress' ), 'buddypress' )
			->add_field( [
				'name'     => __( 'Activity Triggers', 'notification-buddypress' ),
				'slug'     => 'activity_enable',
				'default'  => true,
				'addons'   => [
					'label' => __( 'Enable activity triggers', 'notification-buddypress' ),
				],
				'render'   => [ new CoreFields\Checkbox(), 'input' ],
				'sanitize' => [ new CoreFields\Checkbox(), 'sanitize' ],
			] )
			->add_field( [
				'name'     => __( 'Favorite Triggers', 'notification-buddypress' ),
				'slug'     => 'favorite_enable',
				'default'  => true,
				'addons'   => [
					'label' => __( 'Enable favorite triggers', 'notification-buddypress' ),
				],
				'render'   => [ new CoreFields\Checkbox(), 'input' ],
				'sanitize' => [ new CoreFields\Checkbox(), 'sanitize' ],
			] )
			->add_field( [
				'name'     => __( 'Friendship Triggers', 'notification-buddypress' ),
				'slug'     => 'friendship_enable',
				'default'  => true,
				'addons'   => [
					'label' => __( 'Enable friendship triggers', 'notification-buddypress' ),
				],
				'render'   => [ new CoreFields\Checkbox(), 'input' ],
				'sanitize' => [ new CoreFields\Checkbox(), 'sanitize' ],
			] )
			->add_field( [
				'name'     => __( 'Group Triggers', 'notification-buddypress' ),
				'slug'     => 'group_enable',
				'default'  => true,
				'addons'   => [
					'label' => __( 'Enable group triggers', 'notification-buddypress' ),
				],
				'render'   => [ new CoreFields\Checkbox(), 'input' ],
				'sanitize' => [ new CoreFields\Checkbox(), 'sanitize' ],
			] );
	}
}
