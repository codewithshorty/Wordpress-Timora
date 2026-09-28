<?php

function timora_add_testimonial_metaboxes()
{
    add_meta_box(
        "timora_testimonial_details",
        "Testimonial Details",
        "timora_testimonial_details_metabox_render_html",
        "testimonial",
        "normal",
        "high"
    );
}

function timora_testimonial_details_metabox_render_html($post)
{
    wp_nonce_field(
        "timora_testimonial_details",
        "timora_testimonial_details_nonce"
    );

    $testimonial_provider_selected = get_post_meta(
        $post->ID,
        "testimonial_provider",
        true);
    
    $providers = get_posts([
        "post_type" => "provider",
        "posts_per_page" => -1,
        "orderby" => "title",
        "order" => "ASC"
    ]);

    $testimonial_rating = get_post_meta(
        $post->ID,
        "testimonial_rating",
        true);

        ?>
        <p>
            <label for="testimonial_provider">Provider</label>
            <select name="testimonial_provider" id="testimonial_provider" style="width: 100%; margin-top: 5px;
            ">
                <option value="">Select Provider</option>
                <?php
                
                foreach($providers as $provider) {
                    ?>
                    <option value="<?php echo $provider->ID; ?>" <?php selected($testimonial_provider_selected, $provider->ID); ?>>
                        <?php echo $provider->post_title; ?>
                    </option>
                    <?php
                }
                ?>
                </select>
        </p>
        <p>
            <label for="testimonial_rating">Rating</label>
            <input type="radio" name="testimonial_rating" id="testimonial_rating" value="1" <?php checked($testimonial_rating, 1); ?>>
            <label for="testimonial_rating_1">1</label>
            
            <input type="radio" name="testimonial_rating" id="testimonial_rating" value="2" <?php checked($testimonial_rating, 2); ?>>
            <label for="testimonial_rating_2">2</label>

            <input type="radio" name="testimonial_rating" id="testimonial_rating" value="3" <?php checked($testimonial_rating, 3); ?>>
            <label for="testimonial_rating_3">3</label>

            <input type="radio" name="testimonial_rating" id="testimonial_rating" value="4" <?php checked($testimonial_rating, 4); ?>>
            <label for="testimonial_rating_4">4</label>

            <input type="radio" name="testimonial_rating" id="testimonial_rating" value="5" <?php checked($testimonial_rating, 5); ?>>
            <label for="testimonial_rating_5">5</label>
        </p>
        <?php
}

function save_timora_testimonial_meta($post_id){
    if(!isset($_POST["timora_testimonial_details_nonce"])){
        return;
    }

    if(!wp_verify_nonce($_POST["timora_testimonial_details_nonce"], "timora_testimonial_details")){
        return;
    }

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){
        return;
    }
    
    if(!current_user_can("edit_post", $post_id)){
        return;
    }

if($_POST["testimonial_provider"]){
    $provider_id = absint($_POST["testimonial_provider"]);
    if($provider_id > 0){
        update_post_meta(
            $post_id,
            "testimonial_provider",
            $provider_id
            );
    }else{
        delete_post_meta(
            $post_id,
            "testimonial_provider",
            );
    }
}

if($_POST["testimonial_rating"]){
    $rating = absint($_POST["testimonial_rating"]);
        if($rating >=1 && $rating <=5){
            update_post_meta(
                $post_id,
                "testimonial_rating",
            $rating);
        }else{
            delete_post_meta(
                $post_id,
                "testimonial_rating",
                );
        }
    }
}