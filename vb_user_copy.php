<?php
/*
	Plugin Name: vB User Copy
	Plugin URI: http://arch-games.com
	Description: Converts vBulletin users to Wordpress users. If you disable this users that have not logged into Wordpress before will be unable to login.
	Author: Arimil
	Version: 0.8
	Author URI: http://arch-games.com
	License: GPL2
*/
if (!function_exists('wp_check_password')){ //required for validation
	function wp_check_password($password, $hash, $user_id = '') {
		global $wp_hasher;

		// If the hash is still md5...
		if ( strlen($hash) <= 32 ) {
			$check = ( $hash == md5($password) );
			if ( $check && $user_id ) {
				// Rehash using new hash.
				wp_set_password($password, $user_id);
				$hash = wp_hash_password($password);
			}
			return apply_filters('check_password', $check, $password, $hash, $user_id);
		}
		// If the stored hash is longer than an MD5, presume the
		// new style phpass portable hash.
		if ( empty($wp_hasher) ) {
			require_once( ABSPATH . 'wp-includes/class-phpass.php');
			// By default, use the portable hash from phpass
			$wp_hasher = new PasswordHash(8, TRUE);
		}

		$check = $wp_hasher->CheckPassword($password, $hash);
		if (!$check){
			global $wpdb;
			$wpuser = get_userdata($user_id);
			$vbuser = $wpdb->get_results("SELECT salt, password FROM ".get_option('vb_dbprfx')."user WHERE username = '$wpuser->user_login';");
			$check = ( $vbuser[0]->password == md5(md5($password).$vbuser[0]->salt) );
			if ( $check && $user_id ){ //make sure they were a vbulletin user
				//Rehash their password
				wp_set_password($password, $user_id);
				$hash = wp_hash_password($password);
			}
		}
		return apply_filters('check_password', $check, $password, $hash, $user_id);
	}
}
add_action('admin_menu', 'vb4_user_options');

function vb4_user_options() {

  add_options_page('vB User Copy', 'vB User Copy', 'import', 'vb4userimport', 'vb4_options_page');

}

function vb4_options_page() {

  if (!current_user_can('import'))  {
    wp_die('You do not have sufficient permissions to access this page.');
  }

  include('vb_user_copy_options.php');

}
?>