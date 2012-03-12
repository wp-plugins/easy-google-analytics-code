<?php

/*
Plugin Name: Easy Google Analytics Code
Description: This plugin allows you to easily copy and paste your Google Analytics code so you won't have to modify any theme files.
Version: 1.0
Author: Dion Design
Author URI: http://www.diondesign.ca
*/

function dd_easy_anal_install () 
{
	global $wpdb;

	$table_name = $wpdb->prefix . "dd_easy_anal";
	$sql = "
	CREATE TABLE IF NOT EXISTS `$table_name` (
	  `variable` varchar(255) NOT NULL,
	  `value` varchar(255) NOT NULL,
	  PRIMARY KEY (`variable`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	INSERT INTO `$table_name` (`variable`, `value`) VALUES
	('code', '');
	";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

function dd_easy_anal_menu() 
{
	add_submenu_page('options-general.php', 'Easy Google Analytics Code', 'Easy Google Analytics Code', 'manage_options', 'dd_easy_anal_code', 'dd_easy_anal_code');
}

function dd_easy_anal_code() 
{
	global $wpdb;

	if (!current_user_can('manage_options')) 
		wp_die( __('You do not have sufficient permissions to access this page.') );

	include 'enter-code.php';
}

function dd_easy_anal_head() 
{
	global $wpdb;
	
	echo "\n";
	echo "<!-- DionDesign.ca Easy Google Analytics Code -->\n";
	echo stripslashes($wpdb->get_var($wpdb->prepare("select `value` from ".$wpdb->prefix."dd_easy_anal where `variable`='code'")));
	echo "\n\n";
}

register_activation_hook(__FILE__,'dd_easy_anal_install');
add_action('admin_menu', 'dd_easy_anal_menu');
add_action('wp_head', 'dd_easy_anal_head');

?>