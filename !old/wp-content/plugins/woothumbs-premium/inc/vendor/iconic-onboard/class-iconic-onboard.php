<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( class_exists( 'Iconic_WooThumbs_Onboard' ) ) {
	return;
}

/**
 * Iconic_WooThumbs_Onboard.
 *
 * @class    Iconic_WooThumbs_Onboard
 * @version  1.0.5
 * @category Class
 * @author   Iconic
 */
class Iconic_WooThumbs_Onboard {
	/**
	 * Single instance of the Iconic_WooThumbs_Onboard object.
	 *
	 * @var Iconic_WooThumbs_Onboard
	 */
	public static $single_instance = null;

	/**
	 * @var array
	 */
	protected static $slide_defaults = array(
		"title"   => "",
		"desc"    => "",
		"type"    => "text",
		"default" => "",
		"fields"  => array(),
		"choices" => array(),
	);

	/**
	 * Class args.
	 *
	 * @var array
	 */
	public static $args = array();

	/**
	 * @var string
	 */
	public static $path = null;

	/**
	 * @var string
	 */
	public static $url = null;

	/**
	 * Creates/returns the single instance Iconic_WooThumbs_Onboard object.
	 *
	 * @param array  $args Configuration settings
	 * @param string $args ['plugin_slug']    A unique key for the plugin. Required.
	 * @param string $args ['version']        Plugin version. Required.
	 * @param string $args ['plugin_url']    Plugin URL. Required.
	 * @param string $args ['plugin_path']    Plugin Path. Required.
	 *
	 * @return Iconic_WooThumbs_Onboard
	 */
	public static function run( $args = array() ) {
		if ( null === self::$single_instance ) {
			self::$args            = $args;
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Construct.
	 */
	private function __construct() {
		self::$path = self::$args["plugin_path"] . "/inc/vendor/iconic-onboard/";
		self::$url  = self::$args["plugin_url"] . "/inc/vendor/iconic-onboard/";

		$this->load_classes();

		if ( ! Iconic_WooThumbs_Core_Settings::is_settings_page() ) {
			return;
		}

		$this->enqueue_assets();
		$this->insert_modal_html();
	}

	/**
	 * Enqueue assets.
	 */
	private function enqueue_assets() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * @return null
	 */
	private function insert_modal_html() {
		add_action( 'wpsf_after_settings_' . self::$args['plugin_slug'], array( $this, 'modal_html' ) );
	}

	/**
	 * Load classes
	 *
	 * @return void
	 */
	private function load_classes() {
		require self::$path . "/inc/class-ajax.php";
		require self::$path . "/inc/class-settings.php";

		Iconic_WooThumbs_Onboard_Ajax::run( self::$args );
		Iconic_WooThumbs_Onboard_Settings::run( self::$args );
	}

	/**
	 * Enqueue admin scripts.
	 */
	public function admin_scripts() {
		wp_enqueue_script( 'magnific', self::$url . 'assets/vendor/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), self::$args['version'], true );
		wp_enqueue_style( 'magnific', self::$url . 'assets/vendor/magnific/magnific-popup.css', array(), self::$args['version'] );

		wp_enqueue_script( "jquery-toggle-switch", self::$url . 'assets/vendor/jquery-toggles/jquery.toggleswitch.min.js', array( 'jquery' ), self::$args['version'], true );
		wp_enqueue_style( 'jquery-toggle-switch', self::$url . 'assets/vendor/jquery-toggles/jquery.toggleswitch.min.css', array(), self::$args['version'] );

		wp_enqueue_script( "iconic-onboard-js", self::$url . 'assets/js/main.js', array( 'jquery' ), self::$args['version'], true );
		wp_enqueue_style( "iconic-onboard-css", self::$url . 'assets/css/main.css', array(), self::$args['version'] );

		$localization_data = array(
			"plugin_slug" => self::$args['plugin_slug'],
			"nonce"       => wp_create_nonce( "iconic-onboard" ),
		);
		wp_localize_script( "iconic-onboard-js", "iconic_onboarding_params", $localization_data );
	}

	/**
	 * @return null
	 */
	public function modal_html() {
		$fname        = $this->get_admin_first_name();
		$model_class  = "";
		$args         = apply_filters( "iconic_onboard_args", self::$args );
		$plugin_slug  = $args['plugin_slug'];
		$slides       = $args['slides'];
		$disable_skip = isset( $args['disable_skip'] ) && $args['disable_skip'] ? true : false;
		$dismissed    = get_option( $plugin_slug . "_onboard_dismiss_modal" );
		$saved        = get_option( $plugin_slug . "_onboard_save_modal" );
		$defaults     = self::$slide_defaults;

		// If saved or dismissed. 
		if ( $dismissed || $saved ) {
			$model_class = "iconic-onboard-modal--disable-auto-popup";
		}

		include self::$path . "/templates/admin/popup-slides.php";
	}

	/**
	 * Returns the first name of currently logged in user.
	 *
	 * @return false | string
	 */
	public static function get_admin_first_name() {
		$user = wp_get_current_user();

		if ( ! $user ) {
			return false;
		}
		$fname = get_user_meta( $user->data->ID, "first_name", true );

		if ( empty( $fname ) ) {
			return ucwords( $user->data->display_name );
		} else {
			return ucwords( $fname );
		}
	}
}
