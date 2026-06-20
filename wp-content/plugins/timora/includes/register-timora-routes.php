<?php

function register_testimonials_route()
{
    register_rest_route("timora", "/testimonials", [
        "methods" => "GET",
        "callback" => "get_timora_testimonials"
    ]);
};

function get_timora_testimonials()
{
    $testimonials = get_posts([
        "post_type" => "testimonial",
        "posts_per_page" => -1
    ]);

    return array_map(function ($testimonial) {
        return [
            "id" => $testimonial->ID,
            "title" => $testimonial->post_title,
            "image" => get_the_post_thumbnail_url($testimonial->ID, "small")
        ];
    }, $testimonials);
}
