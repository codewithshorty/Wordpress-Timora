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

function save_timora_provider_meta($post_id)
{
    if (!isset($_POST["timora_provider_details_nonce"]) || !wp_verify_nonce($_POST["timora_provider_details_nonce"], "timora_provider_details")) {
        return;
    };

    if (!isset($_POST["timora_provider_location_nonce"]) || !wp_verify_nonce($_POST["timora_provider_location_nonce"], "timora_provider_location")) {
        return;
    };

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
            sanitize_text_field($_POST["email"])
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
}
