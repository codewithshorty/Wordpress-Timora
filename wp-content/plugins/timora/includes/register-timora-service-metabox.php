<?php
function timora_add_service_metabox()
{
    add_meta_box(
        "timora_service_metabox",
        "Service Details",
        "timora_service_metabox_render_html",
        "service",
        "normal",
        "high"
    );
}

function timora_service_metabox_render_html($post)
{

    wp_nonce_field(
        "timora_service_metabox",
        "timora_service_metabox_nonce"
    );

    $duration = get_post_meta(
        $post->ID,
        "duration",
        true
    );

    $price = get_post_meta(
        $post->ID,
        "price",
        true
    );
?>

    <p>
        <label>
            <strong>Duration</strong>
        </label>

        <select
            name="duration"
            style="width:100%;margin-top:5px;">
            <option value="15 minutes"
                <?php selected($duration, "15 minutes"); ?>>
                15 minutes
            </option>

            <option value="30 minutes"
                <?php selected($duration, "30 minutes"); ?>>
                30 minutes
            </option>

            <option value="60 minutes"
                <?php selected($duration, "60 minutes"); ?>>
                60 minutes
            </option>

        </select>
    </p>
    <p>
        <label>
            <strong>Price (€)</strong>
        </label>

        <input
            type="number"
            name="price"
            value="<?php echo esc_attr($price); ?>"
            style="width:100%;margin-top:5px;">
    </p>

<?php
}


function save_timora_service_meta($post_id)
{
    if (!isset($_POST["timora_service_metabox_nonce"])) {
        return;
    }

    if (!wp_verify_nonce($_POST["timora_service_metabox_nonce"], "timora_service_metabox")) {
        return;
    }

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return;
    }

    update_post_meta(
        $post_id,
        "duration",
        sanitize_text_field($_POST["duration"])
    );

    update_post_meta(
        $post_id,
        "price",
        sanitize_text_field($_POST["price"])
    );
}
