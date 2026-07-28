<?php

$providers = get_posts([
    "post_type" => "provider",
    "posts_per_page" => -1,
    "order" => "DESC",
    "post_status" => "publish"
]);

$providers_categories = get_terms([
    "taxonomy" => "provider_category",
    "hide_empty" => false
]);



?>

<section id="partners" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">
            <h2
                class="font-display text-3xl sm:text-4xl font-extrabold text-[#4e148c]">
                Our partners
            </h2>
            <p class="mt-3 text-[#2c0735]/80">
                Browse our trusted partners below to learn more about their services, view detailed profiles, and book your appointment in just a few clicks. Finding the right professional has never been easier.
            </p>
        </div>
        <div class="mt-6">
            <div class="flex flex-wrap items-center gap-3">
                <button data-category="all" class="category inline-flex items-center gap-2 px-4 py-2 bg-white border border-[#4e148c] rounded-full text-[#2c0735] text-sm hover:bg-[#4e148c] hover:text-white">All Providers</button>
                <?php foreach ($providers_categories as $category): ?>
                    <button data-category="<?php echo esc_html($category->slug) ?>" class="category inline-flex items-center gap-2 px-4 py-2 bg-white border border-[#4e148c] rounded-full text-[#2c0735] text-sm hover:bg-[#4e148c] hover:text-white"><?php echo esc_html($category->name) ?></button>

                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php foreach ($providers as $provider):
                $terms = get_the_terms($provider->ID, "provider_category");

                $slugs = [];

                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $slugs[] = $term->slug;
                    }
                }

            ?>
                <!-- Card 1 -->
                <div data-category="<?php echo esc_attr(implode(" ", $slugs)) ?>"
                    class="provider transition-all duration-300 group rounded-2xl bg-white ring-1 ring-[#4e148c]/15 shadow-soft p-6 flex flex-col">
                    <?php echo get_the_post_thumbnail(
                        $provider->ID,

                        "large",
                        [
                            "class" => "group rounded-2xl bg-white ring-1 ring-[#4e148c]/15 shadow-soft p-6 flex flex-col"
                        ]
                    ) ?>

                    <div class="mt-4">
                        <div class="font-display text-[#2c0735] font-bold text-lg">
                            <?php echo esc_html(wp_strip_all_tags($provider->post_title)) ?>
                        </div>
                        <p class="text-sm text-[#2c0735]/80 mt-2">
                            <?php echo wp_kses_post(wp_strip_all_tags($provider->post_content)) ?>
                        </p>
                        <a
                            href="<?php echo esc_url(the_permalink($provider->ID)) ?>"
                            class="mt-3 inline-flex items-center gap-2 rounded-xl bg-[#858ae3] px-4 py-2 text-white hover:bg-[#613dc1] transition-colors"
                            style="cursor: default">Read more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>