<?php
/**
 * Runtime
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress;

use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\Requirements\Requirements;
use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\DocHooks\HookTrait;
use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\DocHooks\Helper as DocHooksHelper;
use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\Filesystem\Filesystem;
use BracketSpace\Notification\BuddyPress\Vendor\Micropackage\Internationalization\Internationalization;

/**
 * Runtime class
 */
class Runtime {

	use HookTrait;

	/**
	 * Main plugin file path
	 *
	 * @var string
	 */
	protected $plugin_file;

	/**
	 * Flag for unmet requirements
	 *
	 * @var bool
	 */
	protected $requirements_unmet;

	/**
	 * Components
	 *
	 * @var array
	 */
	protected $components = [];

	/**
	 * Class constructor
	 *
	 * @since 1.2.0
	 * @param string $plugin_file plugin main file full path.
	 */
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
	}

	/**
	 * Loads needed files
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function init() {

		// Plugin has been already initialized.
		if ( did_action( 'notification/buddypress/init' ) || $this->requirements_unmet ) {
			return;
		}

		// Requirements check.
		$requirements = new Requirements( __( 'Notification : BuddyPress', 'notification-buddypress' ), [
			'php'          => '7.0',
			'wp'           => '5.3',
			'notification' => '7.0.0',
			'plugins'      => [
				[
					'file'    => 'buddypress/bp-loader.php',
					'name'    => 'BuddyPress',
					'version' => '5.1',
				],
			],
		] );

		$requirements->register_checker( __NAMESPACE__ . '\\Requirements\\BasePlugin' );

		if ( ! $requirements->satisfied() ) {
			$requirements->print_notice();
			$this->requirements_unmet = true;
			return;
		}

		$this->filesystems();
		$this->singletons();
		$this->actions();

		do_action( 'notification/buddypress/init' );

	}

	/**
	 * Registers all the hooks with DocHooks
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function register_hooks() {

		$this->add_hooks( $this );

		foreach ( $this->components as $component ) {
			if ( is_object( $component ) ) {
				$this->add_hooks( $component );
			}
		}

	}

	/**
	 * Sets up the plugin filesystems
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function filesystems() {

		$root = new Filesystem( dirname( $this->plugin_file ) );

		$this->filesystems = [
			'root'     => $root,
			'includes' => new Filesystem( $root->path( 'src/includes' ) ),
		];

	}

	/**
	 * Gets filesystem
	 *
	 * @since  1.2.0
	 * @param  string $name Filesystem name.
	 * @return Filesystem|null
	 */
	public function get_filesystem( $name ) {
		return $this->filesystems[ $name ];
	}

	/**
	 * Adds runtime component
	 *
	 * @since  1.2.0
	 * @throws \Exception When component is already registered.
	 * @param  string $name      Component name.
	 * @param  mixed  $component Component.
	 * @return $this
	 */
	public function add_component( $name, $component ) {

		if ( isset( $this->components[ $name ] ) ) {
			throw new \Exception( sprintf( 'Component %s is already added.', $name ) );
		}

		$this->components[ $name ] = $component;

		return $this;

	}

	/**
	 * Gets runtime component
	 *
	 * @since  1.2.0
	 * @param  string $name Component name.
	 * @return mixed        Component or null
	 */
	public function component( $name ) {
		return isset( $this->components[ $name ] ) ? $this->components[ $name ] : null;
	}

	/**
	 * Gets runtime components
	 *
	 * @since  1.2.0
	 * @return array
	 */
	public function components() {
		return $this->components;
	}

	/**
	 * Creates needed classes
	 * Singletons are used for a sake of performance
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function singletons() {

		$this->add_component( 'admin_settings', new Admin\Settings() );
		$this->add_component( 'frontend_handler', new Frontend\NotificationHandler() );

	}

	/**
	 * All WordPress actions this plugin utilizes
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function actions() {

		$this->register_hooks();

		notification_register_settings( [ $this->component( 'admin_settings' ), 'register_trigger_settings' ], 20 );

		// DocHooks compatibility.
		if ( ! DocHooksHelper::is_enabled() && $this->get_filesystem( 'includes' )->exists( 'hooks.php' ) ) {
			include_once $this->get_filesystem( 'includes' )->path( 'hooks.php' );
		}

	}

	/**
	 * Loads elements
	 *
	 * @action notification/elements
	 *
	 * @since  1.2.0
	 * @return void
	 */
	public function elements() {
		array_map( [ $this, 'load_element' ], [
			'triggers',
			'recipients',
			'carriers',
		] );
	}

	/**
	 * Loads element
	 *
	 * @since  1.2.0
	 * @param  string $element element file slug.
	 * @return void
	 */
	public function load_element( $element ) {
		if ( apply_filters( 'notification/buddypress/load/element/' . $element, true ) ) {
			$path = sprintf( 'elements/%s.php', $element );
			if ( $this->get_filesystem( 'includes' )->exists( $path ) ) {
				require_once $this->get_filesystem( 'includes' )->path( $path );
			}
		}
	}

}
