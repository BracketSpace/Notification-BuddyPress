<?php
/**
 * Runtime
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress;

use BracketSpace\Notification\Utils;

/**
 * Runtime class
 */
class Runtime extends Utils\DocHooks {

	/**
	 * Plugin file path
	 *
	 * @var string
	 */
	protected $plugin_file;

	/**
	 * Class constructor
	 *
	 * @since [Next]
	 * @param string $plugin_file Plugin main file full path.
	 */
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
		$this->add_hooks();
	}

	/**
	 * Loads needed files
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function boot() {

		$this->instances();
		$this->load_functions();

	}

	/**
	 * Creates needed class instances
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function instances() {

		$this->files = new Utils\Files( $this->plugin_file );

		$i18n = $this->add_hooks( new Utils\Internationalization( $this->files, 'notification-buddypress' ) );

		$settings = $this->add_hooks( new Core\Settings() );

		notification_register_settings( [ $settings, 'register_settings' ] );

	}

	/**
	 * Registers Triggers.
	 *
	 * @action plugins_loaded
	 *
	 * @since  1.1.0
	 * @return void
	 */
	public function register_triggers() {

		// Activity.
		if ( notification_get_setting( 'triggers/buddypress/activity_enable' ) ) {
			notification_register_trigger( new Trigger\Activity\Added() );
			notification_register_trigger( new Trigger\Activity\Deleted() );
			notification_register_trigger( new Trigger\Activity\AddToFavorities() );
			notification_register_trigger( new Trigger\Activity\AddToFavoritiesFail() );
			notification_register_trigger( new Trigger\Activity\RemoveFromFavorities() );
		}

		// Friendship.
		if ( notification_get_setting( 'triggers/buddypress/friendship_enable' ) ) {
			notification_register_trigger( new Trigger\Friendship\Accepted() );
			notification_register_trigger( new Trigger\Friendship\Requested() );
			notification_register_trigger( new Trigger\Friendship\Deleted() );
		}

		// Group.
		if ( notification_get_setting( 'triggers/buddypress/group_enable' ) ) {
			notification_register_trigger( new Trigger\Group\CreateComplete() );
			notification_register_trigger( new Trigger\Group\DetailsUpdated() );
			notification_register_trigger( new Trigger\Group\SettingsUpdated() );
			notification_register_trigger( new Trigger\Group\Deleted() );

			notification_register_trigger( new Trigger\Group\SendInvites() );
			notification_register_trigger( new Trigger\Group\UninviteUser() );

			notification_register_trigger( new Trigger\Group\BanMember() );
			notification_register_trigger( new Trigger\Group\UnbanMember() );

			notification_register_trigger( new Trigger\Group\PremoteMember() );
			notification_register_trigger( new Trigger\Group\DemoteMember() );

			notification_register_trigger( new Trigger\Group\MembershipRequested() );
			notification_register_trigger( new Trigger\Group\MembershipAccepted() );
			notification_register_trigger( new Trigger\Group\MembershipRejected() );
		}
	}


	/**
	 * Creates instances when Notification plugin is fully loaded
	 * Useful when you are depending on registered Carriers or Triggers
	 *
	 * @action notification/boot
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function late_instances() {

	}

	/**
	 * Returns new View object
	 *
	 * @since  [Next]
	 * @return View view object
	 */
	public function view() {
		return new Utils\View( $this->files );
	}

	/**
	 * Loads functions from src/inc/functions directory
	 * All .php files are loaded automatically
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function load_functions() {

		$function_files = glob( $this->files->dir_path( 'src/inc/functions/' ) . '*.php' );

		if ( empty( $function_files ) ) {
			return;
		}

		foreach ( $function_files as $file ) {
			require_once $file;
		}

	}

}
