<?php
/**
 * The primary class for the plugin
 *
 * Stores the plugin version, loads and enqueues dependencies
 * for the plugin.
 *
 *
 * @author    José Roberto
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      https://www.linkedin.com/in/joserobertotoko/
 */

class WP_REPOSITORIES {

	private $version;

	/**
	 * A reference to the Dependency Loader.
	 *
	 * @var       Dependency_Loader
	 */
	private $loader;

	/**
	 * Initializes the properties of the class.
	 */
	public function __construct() {
		$this->version = '1.0.0';
		$this->loader  = new Dependency_Loader();
	}

	/**
	 * Create pages admin on activate plugin
	 */
	public function create_admin_pages() {
		if ( ! get_option( 'wp_repositories' ) ) {
			$new_page_filter_id = wp_insert_post( array(
				'post_title'     => 'Repositórios',
				'post_type'      => 'page',
				'post_name'      => 'repositorios',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '',
				'post_status'    => 'publish',
				'post_author'    => 1,
				'menu_order'     => 0
			) );
			
			if ( $new_page_filter_id && ! is_wp_error( $new_page_filter_id ) ){
				update_post_meta( $new_page_filter_id, '_wp_page_template', 'page-filter.php' );
			}
			
			$new_page_repo_id = wp_insert_post( array(
				'post_title'     => 'Repositório',
				'post_type'      => 'page',
				'post_name'      => 'repositorio',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '',
				'post_status'    => 'publish',
				'post_author'    => 1,
				'menu_order'     => 0
			) );
			
			if ( $new_page_repo_id && ! is_wp_error( $new_page_repo_id ) ){
				update_post_meta( $new_page_repo_id, '_wp_page_template', 'page-repository.php' );
			}

			$new_page_stargazer_id = wp_insert_post( array(
				'post_title'     => 'Stargazers',
				'post_type'      => 'page',
				'post_name'      => 'stargazers',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_content'   => '',
				'post_status'    => 'publish',
				'post_author'    => 1,
				'menu_order'     => 0
			) );
			
			if ( $new_page_stargazer_id && ! is_wp_error( $new_page_stargazer_id ) ){
				update_post_meta( $new_page_stargazer_id, '_wp_page_template', 'page-stargazers.php' );
			}

			update_option( 'wp_repositories', $new_page_id );
		}
	}

	/**
	 * Delete pages admin on desactivation plugin
	 */
	public function delete_admin_pages() {
		if ( get_option( 'wp_repositories' ) ) {
			wp_delete_post(get_option( 'wp_repositories' ), true);
		}
		update_option( 'wp_repositories', false );
	}

	/**
	 * Initializes this plugin and the dependency loader to include
	 * the JavaScript necessary for the plugin to function.
	 */
	public function initialize() {
		$this->loader->enqueue_styles();
		$this->loader->enqueue_scripts();
		$this->loader->setup_ajax_handlers();
	}

	/**
	 * Initializes this plugin and the dependency loader to include
	 * the JavaScript necessary for the plugin to function.
	 */
	public function deactivate() {
		$this->delete_admin_pages();
	}

}

	