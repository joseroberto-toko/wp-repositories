<?php
/**
 * Loads and registers dependencies.
 *
 * @author    José Roberto <joseroberto.toko@gmail.com>
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      https://www.linkedin.com/in/joserobertotoko/
 */

class Dependency_Loader {


	public function enqueue_scripts() {
		wp_enqueue_script(
			'ajax-script',
			plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/frontend.js',
			array( 'jquery' )
		);

		wp_localize_script(
			'ajax-script',
			'wpr',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		);

	}

	public function enqueue_styles() {
		wp_enqueue_style('wpr-style', plugin_dir_url( dirname( __FILE__ ) ) .  'assets/css/frontend.css','all');
	 }


	/**
	 * Registers the callback functions responsible for providing a response
	 * to Ajax requests setup throughout the rest of the plugin.
	 *
	 */
	public function setup_ajax_handlers() {

		add_action(
			'wp_ajax_get_current_user_info',
			array( $this, 'get_current_user_info' )
		);

		add_action(
			'wp_ajax_nopriv_get_current_user_info',
			array( $this, 'get_current_user_info' )
		);

	}
}