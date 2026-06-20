<?php

function timora_enqueue_style()
{
    wp_enqueue_script("tailwind-cdn", "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4", [], null, false);
    wp_enqueue_style("timora-style", get_stylesheet_uri());
}

add_action("wp_enqueue_scripts", "timora_enqueue_style");

function adding_timora_theme_support()
{
    add_theme_support("post-thumbnails");
}

add_action("after_setup_theme", "adding_timora_theme_support");
