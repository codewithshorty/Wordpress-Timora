<?php

function register_timora_blocks()
{
    $blocks = [
        ["name" => "hero-banner"]
    ];

    foreach ($blocks as $block) {
        register_block_type(TIMORA_DIR . "build/blocks/" . $block["name"]);
    }
}
