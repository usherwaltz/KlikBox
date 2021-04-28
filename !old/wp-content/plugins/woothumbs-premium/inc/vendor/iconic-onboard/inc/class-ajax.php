<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( class_exists( 'Iconic_WooThumbs_Onboard_Ajax' ) ) {
	return;
}

/**
 * Iconic_WooThumbs_Onboard_Ajax.
 *
 * All ajax methods.
 *
 * @class    Iconic_WooThumbs_Onboard_Ajax
 * @version  1.0.0
 * @category Class
 * @author   Iconic
 */
class Iconic_WooThumbs_Onboard_Ajax {
	/**
	 * @var mixed
	 */
	protected static $plugin_slug;

	/**
	 * Init
	 *
	 * @param $args
	 */
	public static function run( $args ) {
		self::$plugin_slug = $args["plugin_slug"];

		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		$ajax_events = array(
			'dismiss_modal' => false,
			'save_modal'    => false,
		);

		$plugin_slug = self::$plugin_slug;

		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( "wp_ajax_iconic_onboard_{$plugin_slug}_{$ajax_event}", array( __CLASS__, $ajax_event ) );

			if ( $nopriv ) {
				add_action( "wp_ajax_nopriv_iconic_onboard_{$plugin_slug}_{$ajax_event}", array( __CLASS__, $ajax_event ) );
			}
		}
	}

	/**
	 * Save dimiss key in wp_options when user dismiss modal
	 *
	 * @return void
	 */
	public static function dismiss_modal() {
		check_ajax_referer( 'iconic-onboard', 'security' );

		$plugin_slug = filter_input( INPUT_POST, "plugin_slug" );

		if ( $plugin_slug ) {
			update_option( "{$plugin_slug}_onboard_dismiss_modal", "1" );
			wp_send_json_success();
		}
	}

	/**
	 * Runs when modal is saved.
	 *
	 * @return void
	 */
	public static function save_modal() {
		check_ajax_referer( 'iconic-onboard', 'security' );

		$plugin_slug = filter_input( INPUT_POST, "plugin_slug" );

		if ( $plugin_slug ) {
			$fields_str = filter_input( INPUT_POST, "fields" );
			$fields_arr = array();
			parse_str( $fields_str, $fields_arr );

			$result = array(
				"success" => true,
			);

			$result = apply_filters( "iconic_onboard_save_{$plugin_slug}_result", $result, $fields_arr );

			if ( ! empty( $result["success"] ) ) {
				update_option( "{$plugin_slug}_onboard_save_modal", "1" );
			}

			wp_send_json( $result );
		}
	}
}
