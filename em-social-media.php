<?php
/*
 * Plugin Name: EM Social Media
 * Plugin URI: 
 * Description: Allows you to add links to your social media pages/profiles via widget or shortcode.
 * Version: 0.1.0
 * Author: Erik Mitchell
 * Author URI: http://erikmitchell.net
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: emsm
 * Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('EMSM_PATH', plugin_dir_path(__FILE__));
define('EMSM_URL', plugin_dir_url(__FILE__));

include_once(EMSM_PATH.'admin/admin.php');
?>
