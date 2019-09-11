<?php
/**
 * Hooks compatibilty file.
 *
 * Automatically generated with bin/dump-hooks.php file.
 *
 * @package notification/buddypress
 */

// phpcs:disable
add_action( 'plugins_loaded', [ $this, 'register_triggers' ], 10, 0 );
