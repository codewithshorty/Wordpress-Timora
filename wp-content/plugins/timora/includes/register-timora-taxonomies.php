<?php

function register_provider_taxonomy()
{
    register_taxonomy(
        "provider_category",
        ["provider"],
        [
            "labels" =>
            [
                "name" => "Provider Categories",
                "singular_name" => "Provider Category"
            ],
            "public" => true,
            "hierarchical" => true,
            "show_admin_column" => true,
            "show_in_rest" => true,
            "rewrite" => [
                "slug" => "provider_category"
            ]
        ]

    );
}
