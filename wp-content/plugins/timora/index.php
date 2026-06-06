<?php
/*
* Plugin Name: Timora 
* Plugin URI: https://timora.com
* Description: Plugins created by CodeWithShorty for Timora project
* Version: 1.0
* Requires at least: 6.9.4
* Requires PHP: 7.2
* Author: Danijel Petrovic
* Author URI: https://timora.com
* Text Domain: timora
* Domain Path: /languages
*/

if (!function_exists("add_action")) {
    echo "You are not allowed to visit this page!";
    exit;
}

// Setup

define("TIMORA_DIR", plugin_dir_path(__FILE__));

// Include
include(TIMORA_DIR . "/includes/register-blocks.php");

// Hooks
add_action("init", "register_timora_blocks");
