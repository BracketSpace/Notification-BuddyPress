<?php
/**
 * Settings
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Admin;

use BracketSpace\Notification\Utils\Settings\CoreFields;

/**
 * Settings class
 */
class Settings {

	/**
	 * Registers trigger settings
	 *
	 * @since  2.0.0
	 * @param  object $settings Settings API object.
	 * @return void
	 */
	public function register_trigger_settings( $settings ) {
		$triggers = $settings->add_section( __( 'Triggers', 'notification-buddypress' ), 'triggers' );

		$triggers->add_group( __( 'BuddyPress', 'notification-buddypress' ), 'buddypress' )
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

	/**
	 * Registers carrier settings
	 *
	 * @since  2.0.0
	 * @param  object $settings Settings API object.
	 * @return void
	 */
	public function register_carrier_settings( $settings ) {
		$carriers = $settings->add_section( __( 'Carriers', 'notification-buddypress' ), 'carriers' );

		$carriers->add_group( __( 'BuddyPress', 'notification-buddypress' ), 'buddypress' )
			->add_field( [
				'name'     => __( 'Enable', 'notification-buddypress' ),
				'slug'     => 'enable',
				'default'  => 'true',
				'addons'   => [
					'label' => __( 'Enable BuddyPress Carrier', 'notification-buddypress' ),
				],
				'render'   => [ new CoreFields\Checkbox(), 'input' ],
				'sanitize' => [ new CoreFields\Checkbox(), 'sanitize' ],
			] );
	}

}
