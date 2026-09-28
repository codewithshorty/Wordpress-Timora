<?php

function timora_enqueue_style()
{
    wp_enqueue_script("tailwind-cdn", "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4", [], null, false);
    wp_enqueue_style("timora-style", get_stylesheet_uri());
}

add_action("wp_enqueue_scripts", "timora_enqueue_style");

function timora_enqueue_single_provider_booking(){
    if(!is_singular("provider")){
        return;
    }
    wp_enqueue_script("wp-api-fetch");

    wp_enqueue_script(
        "timora-single-provider-booking",
        get_theme_file_uri("assets/js/single-provider-booking.js"),
        ["wp-api-fetch"],
        "1.0.0",
        true
    );
}

add_action("wp_enqueue_scripts", "timora_enqueue_single_provider_booking");

function adding_timora_theme_support()
{
    add_theme_support("post-thumbnails");
}

add_action("after_setup_theme", "adding_timora_theme_support");
