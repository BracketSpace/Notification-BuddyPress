<?php
/**
 * Favorite trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;

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

	}
}
