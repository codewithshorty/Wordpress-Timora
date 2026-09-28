<?php
function timora_add_team_members_metabox()
{

    add_meta_box(
        "timora_team_member_metabox",
        "Team Members Details",
        "timora_team_member_metabox_render_html",
        "team_member",
        "normal",
        "high"
    );
};

function timora_team_member_metabox_render_html($post)
{
    wp_nonce_field(
        "timora_team_member_metabox",
        "timora_team_member_metabox_nonce"
    );

    $provider_selected = get_post_meta(
        $post->ID,
        "provider_team_member",
        true
    );

    $providers = get_posts([
        "post_type" => "provider",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "orderby" => "title",
        "order" => "ASC"
    ]);

    $position = get_post_meta(
        $post->ID,
        "team_member_position",
        true
    );

?>

    <p>
        <label for="provider_team_member">
            Providers
        </label>
        <select name="provider_team_member" id="provider_team_member" style="width: 100%; margin-top:5px;">
            <option value="">Select Provider</option>
            <?php foreach ($providers as $provider) : ?>
                <option value="<?php echo esc_attr($provider->ID) ?>"
                    <?php selected($provider_selected, $provider->ID) ?>>
                    <?php echo esc_html($provider->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="team_member_position">Position</label>
        <input type="text"
            name="team_member_position"
            id="team_member_position"
            value="<?php echo esc_attr($position) ?>"
            style="width:100%;margin-top:5px;">
    </p>
<?php
}

function save_timora_team_member_meta($post_id)
{
    if (!isset($_POST["timora_team_member_metabox_nonce"])) {
        return;
    }

    if (!wp_verify_nonce($_POST["timora_team_member_metabox_nonce"], "timora_team_member_metabox")) {
        return;
    }

    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST["provider_team_member"])) {
        update_post_meta(
            $post_id,
            "provider_team_member",
            sanitize_text_field($_POST["provider_team_member"])
        );
    }

    if (isset($_POST["team_member_position"])) {
        update_post_meta(
            $post_id,
            "team_member_position",
            sanitize_text_field($_POST["team_member_position"])
        );
    }
    
}
