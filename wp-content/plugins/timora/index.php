<?php
/*
 * Plugin Name:       Timora 
 * Plugin URI:        https://timora.com
 * Description:       Plugins created by CodeWithShorty for Timora project
 * Version:           1.0
 * Requires at least: 6.9.4
 * Requires PHP:      7.2
 * Author:            Danijel Petrovic
 * Author URI:        https://timora.com
 * Text Domain:       timora
 * Domain Path:       /languages
 */
if (!function_exists("add_action")) {
    echo "You are now allowed to visit this page";
}


// DEFINE

define("TIMORA_DIR", plugin_dir_path(__FILE__));

// INCLUDES
include(TIMORA_DIR . "includes/register-timora-blocks.php");
include(TIMORA_DIR . "includes/register-timora-post-types.php");

include(TIMORA_DIR . "includes/register-timora-service-metabox.php");

include(TIMORA_DIR . "includes/register-timora-routes.php");
include(TIMORA_DIR . "includes/database.php");
include(TIMORA_DIR . "includes/register-timora-taxonomies.php");

// HOOKS
add_action("init", "register_timora_blocks");

add_action("init", "register_testimonial_post_type");

add_action("init", "register_service_post_type");
add_action("add_meta_boxes", "timora_add_service_metabox");
add_action("save_post_service", "save_timora_service_meta");


add_action("rest_api_init", 'register_testimonials_route');
register_activation_hook(__FILE__, "create_timora_booking_table");

add_action("init", "register_provider_post_type");

add_action("init", "register_provider_taxonomy");
