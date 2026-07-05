<?php

function register_testimonials_route()
{
    register_rest_route("timora", "/testimonials", [
        "methods" => "GET",
        "callback" => "get_timora_testimonials"
    ]);

    register_rest_route("timora", "/bookings", [
        "methods" => "POST",
        "callback" => "post_timora_bookings",
        "permission_callback" => "__return_true"
    ]);

    register_rest_route("timora", "/free-slots", [
        "methods" => "GET",
        "callback" => "get_free_timora_bookings_slot",
        "permission_callback" => "__return_true"
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


function post_timora_bookings(WP_REST_Request $request)
{
    $params = $request->get_json_params();

    $name = sanitize_text_field($params["name"] ?? "");
    $surname = sanitize_text_field($params["surname"] ?? "");
    $phone = sanitize_text_field($params["phone"] ?? "");
    $email = sanitize_email($params["email"] ?? "");
    $date = sanitize_text_field($params["date"] ?? "");
    $time = sanitize_text_field($params["time"] ?? "");
    $notes = sanitize_textarea_field($params["notes"] ?? "");

    global $wpdb;

    $table_name = $wpdb->prefix . "timora_bookings";

    $result = $wpdb->insert(
        $table_name,
        [
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone,
            "email" => $email,
            "booking_date" => $date,
            "booking_time" => $time,
            "notes" => $notes
        ]
    );

    if (!$result) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "There is a problem with database!"
        ], 500);
    }

    return new WP_REST_Response([
        "success" => true,
        "message" => "Booking has been created successfully!",
    ], 200);
}




function get_free_timora_bookings_slot(WP_REST_Request $request)
{
    global $wpdb;

    $date = $request->get_param("date");

    $table_name = $wpdb->prefix . "timora_bookings";

    $date = sanitize_text_field($date);

    if (!$date) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Date is required"
        ], 400);
    }

    $booked_slots = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT booking_time
            FROM $table_name
            WHERE booking_date = %s",
            $date
        )
    );

    $all_slots = [];
    $first_slot = strtotime("09:00");
    $last_slot = strtotime("17:00");

    while ($first_slot <= $last_slot) {
        $all_slots[] = date("H:i", $first_slot);
        $first_slot = strtotime("+30 minutes", $first_slot);
    }

    $all_available_slots = array_values(array_diff($all_slots, $booked_slots));

    return new WP_REST_Response([
        "success" => true,
        "slots" => $all_available_slots
    ]);
};
