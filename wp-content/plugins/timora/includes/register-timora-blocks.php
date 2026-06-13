<?php

function timora_register_assets()
{
    wp_register_style(
        'timora-tailwind',
        plugin_dir_url(__DIR__) . 'src/styles/tailwind-output.css',
        [],
        filemtime(TIMORA_DIR . '/src/styles/tailwind-output.css')
    );
}
add_action('init', 'timora_register_assets');


function register_timora_blocks()
{
    $blocks = [
        ["name" => "hero-banner"]
    ];

    foreach ($blocks as $block) {
        register_block_type(TIMORA_DIR . "build/blocks/" . $block["name"],     [
            'style' => 'timora-tailwind',
            'editor_style' => 'timora-tailwind',
        ]);
    }
}
