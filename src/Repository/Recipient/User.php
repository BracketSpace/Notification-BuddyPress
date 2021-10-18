<?php
/**
 * User recipient
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Repository\Recipient;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\Field;
use BracketSpace\Notification\Queries\UserQueries;

/**
 * User recipient
 */
class User extends Abstracts\Recipient {

	/**
	 * Recipient constructor
	 *
	 * @since 5.0.0
	 */
	public function __construct() {
		parent::__construct( [
			'slug'          => 'user',
			'name'          => __( 'User', 'notification-buddypress' ),
			'default_value' => get_current_user_id(),
		] );
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param  string $value raw value saved by the user.
	 * @return array         array of resolved values
	 */
	public function parse_value( $value = '' ) {
		if ( empty( $value ) ) {
			$value = [ $this->get_default_value() ];
		}

		$user = get_userdata( $value );

		if ( $user ) {
			return [ $user->ID ];
		}

		return [];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return object
	 */
	public function input() {
		$opts = [];

		foreach ( UserQueries::all() as $user ) {
			$opts[ $user['ID'] ] = esc_html( $user['display_name'] ) . ' (' . $user['user_email'] . ')';
		}

		return new Field\SelectField( [
			'label'     => __( 'Recipient', 'notification-buddypress' ), // don't edit this!
			'name'      => 'recipient',                       // don't edit this!
			'css_class' => 'recipient-value',                 // don't edit this!
			'value'     => $this->get_default_value(),
			'pretty'    => true,
			'options'   => $opts,
		] );
	}

}
