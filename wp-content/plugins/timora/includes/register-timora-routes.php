<?php

use WpOrg\Requests\Capability;

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

    register_rest_route("timora", "/services", [
        "methods" => "GET",
        "callback" => "get_timora_services",
        "permission_callback" => "__return_true"
    ]);

    register_rest_route("timora", "/provider-register", [
        "methods" => "POST",
        "callback" => "post_provider_registrations",
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

function get_timora_services()
{
    $services = get_posts([
        "post_type" => "service",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "order" => "ASC"
    ]);

    $response = [];

    foreach ($services as $service) {
        $response[] = [
            "id" => $service->ID,
            "title" => $service->post_title,
            "duration" => get_post_meta(
                $service->ID,
                "duration",
                true
            ),
            "price" => get_post_meta(
                $service->ID,
                "price",
                true
            )

        ];
    }

    return new WP_REST_Response($response, 200);
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
    $service = absint($params["service"] ?? "");



    if (empty($name)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Name is required"
        ], 400);
    }

    if (empty($surname)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Surname is reqiured"
        ], 400);
    };

    if (strlen($phone) < 8) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Invalid phone number"
        ], 400);
    }

    if (!is_email($email)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Invalid email"
        ], 400);
    };

    if (strtotime($date) < strtotime(date("Y-m-d"))) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Can't pick date in the past"
        ], 400);
    }

    global $wpdb;

    $table_name = $wpdb->prefix . "timora_bookings";

    $reserved_slot = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*)
            FROM $table_name
            WHERE booking_date = %s
            AND booking_time = %s",
            $date,
            $time
        )
    );

    if ($reserved_slot > 0) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Time slot already been taken!"
        ], 409);
    }

    $result = $wpdb->insert(
        $table_name,
        [
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone,
            "email" => $email,
            "booking_date" => $date,
            "booking_time" => $time,
            "notes" => $notes,
            "service_id" => $service
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

function post_provider_registrations(WP_REST_Request $request)
{
    $params = $request->get_json_params();

    $businessName = sanitize_text_field($params["businessName"]) ?? "";
    $ownerName = sanitize_text_field($params["ownerName"]) ?? "";
    $email = sanitize_email($params["email"]) ?? "";
    $password = $params["password"] ?? "";
    $industry = absint($params["industry"]) ?? "";
    // $phone = sanitize_text_field($params["phone"]) ?? "";
    // $website = sanitize_text_field($params["website"]) ?? "";
    // $description = sanitize_textarea_field($params["description"]) ?? "";

    if (empty($businessName)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Business name is required!"
        ], 400);
    }

    if (empty($ownerName)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Owner name is required!"
        ], 400);
    }

    if (!is_email($email)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Email is not valid!"
        ], 400);
    }

    if (email_exists($email)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Email is already existed!"
        ], 409);
    }

    if (strlen($password) < 8) {
        return new WP_REST_Response([
            "status" => false,
            "message" => "Email needs to have not more than 8 characters!"
        ], 400);
    }

    if (empty($password)) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Password is required!"
        ], 400);
    }

    if ($industry === "") {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Industry field must be picked!"
        ], 400);
    }


    $user_id = wp_insert_user([
        "user_login" => $email,
        "user_email" => $email,
        "user_pass" => $password,
        "display_name" => $ownerName,
        "role" => "pending_provider"
    ]);

    if (is_wp_error($user_id)) {
        return new WP_REST_Response([
            "status" => false,
            "message" => $user_id->get_error_message()
        ], 500);
    }

    $provider_id = wp_insert_post(
        [
            "post_type" => "provider",
            "post_title" => $businessName,
            "post_status" => "pending",
        ]
    );

    update_post_meta(
        $provider_id,
        "owner_user",
        $user_id
    );

    update_post_meta(
        $provider_id,
        "owner_name",
        $ownerName
    );

    update_post_meta(
        $provider_id,
        "provider_email",
        $email
    );

    update_post_meta(
        $provider_id,
        "provider_password",
        $password
    );

    wp_set_object_terms(
        $provider_id,
        $industry,
        "provider_category"
    );



    return new WP_REST_Response([
        "success" => true,
        "message" => "You are succesfully become the provider!",
    ], 200);
}


function get_free_timora_bookings_slot(WP_REST_Request $request)
{
    global $wpdb;

    $date = $request->get_param("date");
    $service_id = $request->get_param("service");


    $table_name = $wpdb->prefix . "timora_bookings";

    $date = sanitize_text_field($date);
    $service_id = absint($request->get_param("service"));

    if (!$date || !$service_id) {
        return new WP_REST_Response([
            "success" => false,
            "message" => "Date and service are required"
        ], 400);
    }

    $duration = (int)get_post_meta(
        $service_id,
        "duration",
        true
    );

    $booked_slots = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT booking_time,service_id
            FROM $table_name
            WHERE booking_date = %s",
            $date
        ),
        ARRAY_A
    );

    // Reservation array with booking time and duration
    $reservations = [];

    foreach ($booked_slots as $slot) {
        $reservations[] = [
            "start" => $slot["booking_time"],
            "duration" => (int)get_post_meta(
                $slot["service_id"],
                "duration",
                true
            )
        ];
    }

    $all_slots = [];
    $first_slot = strtotime("09:00");
    $last_slot = strtotime("17:00");

    while ($first_slot <= $last_slot) {
        $all_slots[] = date("H:i", $first_slot);
        $first_slot = strtotime("+{$duration} minutes", $first_slot);
    }

    // Testing of available slots
    $available = [];


    foreach ($all_slots as $slot) {
        // Testing of free timespan initialization
        $free = true;
        $new_start = strtotime($slot);
        $new_end = strtotime("+{$duration} minutes", $new_start);
        foreach ($reservations as $reservation) {
            $reservation_start = strtotime($reservation["start"]);
            $reservation_duration = $reservation["duration"];
            $reservation_end = strtotime("+{$reservation_duration} minutes", $reservation_start);
            if (
                $new_start < $reservation_end && $reservation_start < $new_end
            ) {
                $free = false;
                break;
            }
        }
        if ($free) {
            $available[] = $slot;
        }
    }


    return new WP_REST_Response([
        "success" => true,
        "slots" => $available,
    ]);
};
