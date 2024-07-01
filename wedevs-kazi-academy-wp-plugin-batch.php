<?php
/**
 * Plugin Name: weDevs Kazi Academy WP Plugin Batch
 * Description: This is the plugin for learning purpose.
*/

class weDevs_Academy_WP_Plugin {

	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->require_classes();
	}

	private function require_classes() {
		require_once __DIR__ . '/includes/admin-menu.php';

		new weDevs_Academy_WP_Plugin_Admin_Menu();
	}
}

weDevs_Academy_WP_Plugin::get_instance();
