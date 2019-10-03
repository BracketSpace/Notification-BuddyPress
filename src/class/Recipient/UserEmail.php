<?php
/**
 * User Email recipient
 *
 * @package notification-buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Recipient;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\Field;

/**
 * User Email recipient
 */
class UserEmail extends Abstracts\Recipient {

	/**
	 * Recipient constructor
	 *
	 * @since 5.0.0
	 */
	public function __construct() {
		parent::__construct( [
			'slug'          => 'user_email',
			'name'          => __( 'User by email', 'notification-buddypress' ),
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

		$emails = array_map( 'trim', explode( ',', $value ) );
		$ids    = [];

		foreach ( $emails as $email ) {
			$user  = get_user_by( 'email', $email );
			$ids[] = $user->ID;
		}

		return $ids;

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
