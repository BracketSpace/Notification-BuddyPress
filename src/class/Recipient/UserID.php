<?php
/**
 * User ID recipient
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Recipient;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\Field;

/**
 * User ID recipient
 */
class UserID extends Abstracts\Recipient {

	/**
	 * Recipient constructor
	 *
	 * @since 5.0.0
	 */
	public function __construct() {
		parent::__construct( [
			'slug'          => 'user_id',
			'name'          => __( 'User by ID', 'notification-buddypress' ),
			'default_value' => '',
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
			return [];
		}

		return array_map( 'trim', explode( ',', $value ) );

	}

	/**
	 * {@inheritdoc}
	 *
	 * @return object
	 */
	public function input() {

		return new Field\InputField( [
			'label'     => __( 'Recipient', 'notification-buddypress' ),
			'name'      => 'recipient',
			'css_class' => 'recipient-value',
			'value'     => $this->get_default_value(),
		] );

	}

}
