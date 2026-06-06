<?php
function register_timora_blocks()
{
    $blocks = [
        ["blockName" => "hero-banner"]
    ];

    foreach ($blocks as $block) {
        register_block_type(TIMORA_DIR . "/build/" . $block["blockName"]);
    }
};
