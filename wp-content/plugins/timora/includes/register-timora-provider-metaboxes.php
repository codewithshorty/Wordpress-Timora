<?php

function timora_add_provider_metaboxes()
{

    add_meta_box(
        "timora_provider_details",
        "Provider Details",
        "timora_provider_details_metabox_render_html",
        "provider",
        "normal",
        "high"
    );

    add_meta_box(
        "timora_provider_location",
        "Provider Location",
        "timora_provider_location_metabox_render_html",
        "provider",
        "normal",
        "default"
    );

    add_meta_box(
        "timora_provider_working_hours",
        "Provider Working Hours",
        "timora_provider_working_hours_metabox_render_html",
        "provider",
        "advanced",
        "low"
    );
}

function timora_provider_details_metabox_render_html($post)
{

    wp_nonce_field(
        "timora_provider_details",
        "timora_provider_details_nonce"
    );

    $phone = get_post_meta(
        $post->ID,
        "provider_phone",
        true
    );

    $email = get_post_meta(
        $post->ID,
        "provider_email",
        true
    );

    $website = get_post_meta(
        $post->ID,
        "provider_website",
        true
    );

?>

    <p>
        <label for="provider_phone">
            <strong>Phone</strong>
        </label>
        <input
            type="text"
            name="phone"
            id="provider_phone"
            value="<?php echo esc_attr($phone); ?>"
            style="width:100%; margin-top:5px;">
    </p>

    <p>
        <label for="provider_email">
            <strong>
                Email
            </strong>
        </label>

        <input type="email"
            name="email"
            id="provider_email"
            value="<?php echo esc_attr($email); ?>"
            style="width:100%; margin-top:5px;">
    </p>

    <p>
        <label for="provider_website">
            <strong>
                Website
            </strong>
        </label>

        <input type="url"
            name="website"
            id="provider_website"
            value="<?php echo esc_attr($website); ?>"
            placeholder="https://www.website.com"
            style="width:100%; margin-top:5px;">
    </p>

<?php
}

function timora_provider_location_metabox_render_html($post)
{

    wp_nonce_field(
        "timora_provider_location",
        "timora_provider_location_nonce"
    );

    $city = get_post_meta(
        $post->ID,
        "provider_city",
        true
    );

    $address = get_post_meta(
        $post->ID,
        "provider_address",
        true
    );


    $cities_file = TIMORA_DIR . "src/assets/cities.json";
    $cities = json_decode(file_get_contents($cities_file), true);

    if (!$cities) {
        echo "<p>Error: Failed to load cities data.</p>";
        return;
    }

?>

    <p>
        <label for="provider_city">
            <strong>
                City
            </strong>
        </label>

        <select
            style="width:100% ; margin-top:5px;" name="city" id="provider_city">
            <option value="">Select city</option>
            <?php if (is_array($cities)): ?>
                <?php foreach ($cities as $single_city): ?>
                    <option value="<?php echo esc_attr($single_city["city"]) ?>"
                        <?php selected($city, $single_city["city"]) ?>>
                        <?php echo esc_html($single_city["city"]) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>
    </p>

    <p>
        <label for="provider_address">
            <strong>
                Address
            </strong>
        </label>

        <input type="text"
            name="address"
            id="provider_address"
            value="<?php echo esc_attr($address); ?>"
            placeholder="Main street 99"
            style="width:100%; margin-top:5px;">
    </p>

<?php

}
function timora_provider_working_hours_metabox_render_html($post)
{
    wp_nonce_field("timora_provider_working_hours", "timora_provider_working_hours_nonce");

   $monday_time = get_post_meta($post->ID, "provider_monday_time", true);
   $tuesday_time = get_post_meta($post->ID, "provider_tuesday_time", true);
   $wednesday_time = get_post_meta($post->ID, "provider_wednesday_time", true);
   $thursday_time = get_post_meta($post->ID, "provider_thursday_time", true);
   $friday_time = get_post_meta($post->ID, "provider_friday_time", true);
   $saturday_time = get_post_meta($post->ID, "provider_saturday_time", true);
   $sunday_time = get_post_meta($post->ID, "provider_sunday_time", true);

   ?>
   <h4 style="margin-bottom:10px; color: #333;">Important: Enter the working hours in the format "09:00 - 17:00". Leave empty if the provider is closed on that day.</h4>
</h4>
   <p>
    <label for="provider_monday_time">Monday</label>
    <input type="text" name="provider_monday_time" id="provider_monday_time" value="<?php echo esc_attr($monday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_tuesday_time">Tuesday</label>
    <input type="text" name="provider_tuesday_time" id="provider_tuesday_time" value="<?php echo esc_attr($tuesday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_wednesday_time">Wednesday</label>
    <input type="text" name="provider_wednesday_time" id="provider_wednesday_time" value="<?php echo esc_attr($wednesday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_thursday_time">Thursday</label>
    <input type="text" name="provider_thursday_time" id="provider_thursday_time" value="<?php echo esc_attr($thursday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_friday_time">Friday</label>
    <input type="text" name="provider_friday_time" id="provider_friday_time" value="<?php echo esc_attr($friday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_saturday_time">Saturday</label>
    <input type="text" name="provider_saturday_time" id="provider_saturday_time" value="<?php echo esc_attr($saturday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <p>
    <label for="provider_sunday_time">Sunday</label>
    <input type="text" name="provider_sunday_time" id="provider_sunday_time" value="<?php echo esc_attr($sunday_time); ?>" style="width:100%; margin-top:5px;" placeholder="09:00 - 17:00">
   </p>

   <?php



    

}



function save_timora_provider_meta($post_id)
{
    if (!isset($_POST["timora_provider_details_nonce"])) {
        return;
    };

    if (!wp_verify_nonce($_POST["timora_provider_details_nonce"], "timora_provider_details")) {
        return;
    }

    if (!isset($_POST["timora_provider_location_nonce"])) {
        return;
    };

    if (!wp_verify_nonce($_POST["timora_provider_location_nonce"], "timora_provider_location")) {
        return;
    }


    if (!isset($_POST["timora_provider_working_hours_nonce"])) {
        return;
    }

    if (!wp_verify_nonce($_POST["timora_provider_working_hours_nonce"], "timora_provider_working_hours")) {
        return;
    }

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return;
    };

    if (!current_user_can("edit_post", $post_id)) {
        return;
    };
    // $phone,$email, $website,

    if (isset($_POST["phone"])) {
        update_post_meta(
            $post_id,
            "provider_phone",
            sanitize_text_field($_POST["phone"])
        );
    }

    if (isset($_POST["email"])) {
        update_post_meta(
            $post_id,
            "provider_email",
            sanitize_email($_POST["email"])
        );
    }

    if (isset($_POST["website"])) {
        update_post_meta(
            $post_id,
            "provider_website",
            sanitize_text_field($_POST["website"])
        );
    }

    // $city, $address

    if (isset($_POST["city"])) {
        update_post_meta(
            $post_id,
            "provider_city",
            sanitize_text_field($_POST["city"])
        );
    }

    if (isset($_POST["address"])) {
        update_post_meta(
            $post_id,
            "provider_address",
            sanitize_text_field($_POST["address"])
        );
    }



    // $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday
    $days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
    foreach($days as $day){
        $hours = sanitize_text_field($_POST["provider_{$day}_time"] ?? "");
        if($hours){
            update_post_meta(
                $post_id,
                "provider_{$day}_time",
                $hours
            );
        }
    }
}
