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
include(TIMORA_DIR . "includes/register-timora-provider-metaboxes.php");
include(TIMORA_DIR . "includes/register-timora-team-member-metabox.php");
include(TIMORA_DIR . "includes/register-timora-testimonial-metaboxes.php");

include(TIMORA_DIR . "includes/register-timora-routes.php");
include(TIMORA_DIR . "includes/database.php");
include(TIMORA_DIR . "includes/register-timora-taxonomies.php");

// include(TIMORA_DIR . "includes/register-timora-provider-role.php");
// include(TIMORA_DIR . "includes/timora-filter-provider-posts.php");
// include(TIMORA_DIR . "includes/timora-provider-dashboard.php");
// include(TIMORA_DIR . "includes/timora-provider-dashboard-setup.php");
// include(TIMORA_DIR . "includes/timora-provider-login-redirect.php");




// HOOKS
add_action("init", "register_timora_blocks");

add_action("init", "register_testimonial_post_type");

add_action("init", "register_service_post_type");

add_action("init", "register_team_members_post_type");

add_action("add_meta_boxes", "timora_add_service_metabox");
add_action("add_meta_boxes", "timora_add_provider_metaboxes");
add_action("add_meta_boxes", "timora_add_team_members_metabox");
add_action("add_meta_boxes", "timora_add_testimonial_metaboxes");

add_action("save_post_service", "save_timora_service_meta");
add_action("save_post_provider", "save_timora_provider_meta");
add_action("save_post_team_member", "save_timora_team_member_meta");
add_action("save_post_testimonial", "save_timora_testimonial_meta");

add_action("rest_api_init", 'register_testimonials_route');
register_activation_hook(__FILE__, "create_timora_booking_table");

// register_activation_hook(__FILE__, "register_timora_provider_role");
// add_action("pre_get_posts", "timora_filter_provider_posts");
// add_action("admin_menu", "timora_provider_dashboard");
// add_action("wp_dashboard_setup", "timora_provider_dashboard_setup");
// add_filter(
//     "login_redirect",
//     "timora_provider_login_redirect",
//     10,
//     3
// );

add_action("init", "register_provider_post_type");

add_action("init", "register_provider_taxonomy");
