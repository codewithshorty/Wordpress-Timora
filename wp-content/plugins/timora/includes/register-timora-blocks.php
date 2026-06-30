<?php

function timora_register_assets()
{
    wp_register_style(
        'timora-tailwind',
        plugin_dir_url(__DIR__) . 'src/styles/tailwind-output.css',
        [],
        filemtime(TIMORA_DIR . '/src/styles/tailwind-output.css')
    );

    wp_register_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css'
    );

    wp_register_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js'
    );
}
add_action('init', 'timora_register_assets');




function register_timora_blocks()
{
    $blocks = [
        ["name" => "hero-banner"],
        ["name" => "services"],
        ["name" => "testimonials"],
        ["name" => "main-navigation"]
    ];

    foreach ($blocks as $block) {
        register_block_type(TIMORA_DIR . "build/blocks/" . $block["name"],     [
            'style' => [
                'timora-tailwind',
                'swiper-css'
            ],
            'editor_style' => ['timora-tailwind']
        ]);
    }
}
