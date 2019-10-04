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
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param string $plugin_file Plugin main file full path.
	 */
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
	}

	/**
	 * Loads needed files
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function boot() {

		$this->instances();
		$this->load_functions();
		$this->actions();

	}

	/**
	 * Registers all the hooks with DocHooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_hooks() {

		$this->add_hooks();

		foreach ( get_object_vars( $this ) as $instance ) {
			if ( is_object( $instance ) ) {
				$this->add_hooks( $instance );
			}
		}

	}

	/**
	 * Creates needed class instances
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function instances() {

		$this->files = new Utils\Files( $this->plugin_file );

		$this->settings = new Core\Settings();

	}

	/**
	 * Registers Triggers.
	 *
	 * @action plugins_loaded
	 *
	 * @since  1.0.0
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

			notification_register_trigger( new Trigger\Group\InviteUser() );
			notification_register_trigger( new Trigger\Group\UninviteUser() );
			notification_register_trigger( new Trigger\Group\Join() );
			notification_register_trigger( new Trigger\Group\Leave() );
			notification_register_trigger( new Trigger\Group\RemoveMember() );

			notification_register_trigger( new Trigger\Group\BanMember() );
			notification_register_trigger( new Trigger\Group\UnbanMember() );

			notification_register_trigger( new Trigger\Group\PromoteMember() );
			notification_register_trigger( new Trigger\Group\DemoteMember() );

			notification_register_trigger( new Trigger\Group\MembershipRequested() );
			notification_register_trigger( new Trigger\Group\MembershipAccepted() );
			notification_register_trigger( new Trigger\Group\MembershipRejected() );
		}

	}

	/**
	 * Registers Carriers.
	 *
	 * @action plugins_loaded
	 *
	 * @since  1.1.0
	 * @return void
	 */
	public function register_carriers() {

		notification_register_recipient( 'buddypress-notification', new Recipient\User() );
		notification_register_recipient( 'buddypress-notification', new Recipient\UserID() );
		notification_register_recipient( 'buddypress-notification', new Recipient\UserEmail() );
		notification_register_recipient( 'buddypress-notification', new Recipient\Role() );

		notification_register_carrier( notification_add_doc_hooks( new Carrier\BuddyPressNotification() ) );

	}

	/**
	 * Displays BuddyPress notification.
	 *
	 * @filter bp_notifications_get_notifications_for_user
	 *
	 * @since  1.1.0
	 * @param  array $components Registered components.
	 * @return void
	 */
	public function display_buddypress_notification( $content, $item_id, $secondary_item_id, $total_items, $format = 'string', $component_action_name, $component_name, $id ) {

		if ( 'notification-buddypress' !== $component_name ) {
			return;
		}

		$text = bp_notifications_get_meta( $id, 'notification_content', true );
		$link = bp_notifications_get_meta( $id, 'notification_link', true );

		if ( 'string' === $format ) {
			if ( $link ) {
				$content = '<a href="' . $link . '">' . $text . '</a>';
			} else {
				$content = $text;
			}
		} else {
			$content = [
				'text' => $text,
				'link' => $link,
			];
		}

		return $content;

	}

	/**
	 * All WordPress actions this plugin utilizes
	 * Should register plugin settings as well.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function actions() {

		$this->register_hooks();

		notification_register_settings( [ $this->settings, 'register_settings' ] );

		// DocHooks compatibility.
		$hooks_file = $this->files->file_path( 'inc/hooks.php' );
		if ( ! notification_dochooks_enabled() && file_exists( $hooks_file ) ) {
			include_once $hooks_file;
		}

	}

	/**
	 * Returns new View object
	 *
	 * @since  1.0.0
	 * @return View view object
	 */
	public function view() {
		return new Utils\View( $this->files );
	}

	/**
	 * Loads functions from src/inc/functions directory
	 * All .php files are loaded automatically
	 *
	 * @since  1.0.0
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
