<?php
/**
 * Este plugin tem como finalidade exibir os repositórios do GitHub por pesquisa,
 * e também suas issues.  
 *
 * @wordpress-plugin
 * Plugin Name:       WP Repositories
 * Description:       Listando os repositórios e suas issues.
 * Version:           1.0.0
 * Author:            José Roberto
 * Author URI:        https://www.linkedin.com/in/joserobertotoko/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'WP_REPOSITORIES_VERSION', '1.0.0' );
define( 'WP_REPOSITORIES_TOKEN', 'YOUR TOKEN' );

/**
 * Loads and registers dependencies.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dependency-loader.php';

/**
 * The primary class for the plugin
 */
require_once plugin_dir_path( __FILE__ ) . 'class-wp-repositories.php';

/**
 * The code that runs during plugin activation.
 */
function wpr_activate_plugin() {
	copy_files_theme();
	$plugin = new WP_REPOSITORIES();
	$plugin->create_admin_pages();
}

/**
 * The code that runs during plugin deactivation.
 */
function wpr_deactivate_plugin() {
	delete_files_theme();
	$plugin = new WP_REPOSITORIES();
	$plugin->delete_admin_pages();
}

/**
 * Copy files to template in activate theme 
 */
function copy_files_theme(){
	mkdir(get_template_directory() . '/templates', 0700);
	copy( plugin_dir_path( __FILE__ ) . '/templates/page-filter.php' , get_template_directory() . '/page-filter.php');
	copy( plugin_dir_path( __FILE__ ) . '/templates/page-repository.php' , get_template_directory() . '/page-repository.php');
	copy( plugin_dir_path( __FILE__ ) . '/templates/page-stargazers.php' , get_template_directory() . '/page-stargazers.php');
	copy( plugin_dir_path( __FILE__ ) . '/templates/content-filter.php' , get_template_directory() . '/templates/content-filter.php');
	copy( plugin_dir_path( __FILE__ ) . '/templates/content-repository.php' , get_template_directory() . '/templates/content-repository.php');
	copy( plugin_dir_path( __FILE__ ) . '/templates/content-stargazers.php' , get_template_directory() . '/templates/content-stargazers.php');
}

/**
 * Delete files to template in activate theme 
 */
function delete_files_theme(){
	unlink(get_template_directory() . '/page-filter.php');
	unlink(get_template_directory() . '/page-repository.php');
	unlink(get_template_directory() . '/page-stargazers.php');
	unlink(get_template_directory() . '/templates/content-filter.php');
	unlink(get_template_directory() . '/templates/content-repository.php');
	unlink(get_template_directory() . '/templates/content-stargazers.php');
	rmdir(get_template_directory()  . '/templates');
}

/**
 * Get JSON API GitHub
 */
function get_git_api($user,$type = false, $slug=false){
	
	switch ($type) {
		case 1:
			$curl_url = 'https://api.github.com/users/' . $user . '/repos';
			break;
		case 2:
			$curl_url = 'https://api.github.com/repos/' . $user . '/' . $slug . '/stargazers';
			break;
		default:
			$curl_url = 'https://api.github.com/users/' . $user;
			break;
	}
	
	$curl_token_auth = 'Authorization: token ' . WP_REPOSITORIES_TOKEN;
	$ch = curl_init($curl_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App', $curl_token_auth));
	$output = curl_exec($ch);
	curl_close($ch);
	
	$output = json_decode($output);

	return $output;
}

/**
 * Get JSON User
 */
function get_user_repositories($user){
	$user_data = get_git_api($user);
	$user_repo = get_git_api($user,true);
	
	$output["user"] = $user_data;
	$output["repos"] = $user_repo;
	
	return $output;
}

/**
 * Get JSON Stargazer repository 
 */
function get_repository_stargazers($user,$slug){
	$output = get_git_api($user,2, $slug);
	return $output;
}

register_activation_hook( __FILE__, 'wpr_activate_plugin' );
register_deactivation_hook( __FILE__, 'wpr_deactivate_plugin' );

/**
 * Instantiates the main class and initializes the plugin.
 */
function wp_repositories_start() {
	$plugin = new WP_REPOSITORIES();
	$plugin->initialize();
}


wp_repositories_start();


