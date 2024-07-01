<?php

class weDevs_Academy_WP_Plugin_Admin_Menu {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Academy WP Plugin',
			'Academy WP Plugin',
			'manage_options',
			'academy_wp_plugin',
			array( $this, 'academy_wp_plugin_callback' )
		);
	}

	public function academy_wp_plugin_callback() {
		$post_args = array(
			'posts_type' => 'post',
		);

		if ( isset( $_GET['customized_category'] ) && $_GET['customized_category'] != '-1' ) {
			$post_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $_GET['customized_category'],
				),
			);
		}


		if ( isset($_GET['filter_by_tag']) && $_GET['filter_by_tag'] != '' ) {
			
			$post_args['tax_query'] = array(
				array(
					'taxonomy'   => 'post_tag',
					'name'      => 'filter_by_category',
					'field' 	=> 'term_id',
					'terms' 	=> $_GET['filter_by_tag'],
				),
			);
		
		}

		$posts = get_posts( $post_args );

		$terms = get_terms( array(
			'taxonomy' => 'category', 
		) );

		include_once __DIR__ . '/templates/academy-wp-plugin-menu.php';
	}
}
