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

        <div class="mt-10 overflow-x-auto lg:overflow-visible rounded-2xl ring-1 ring-[#4e148c]/15">
            <table class="w-full border-collapse text-left">
                <thead class="bg-[#4e148c]/5 text-[#2c0735]">
                    <tr>
                        <th class="px-3 py-3 sm:px-4 font-semibold">Provider</th>
                        <th class="hidden lg:table-cell px-4 py-3 font-semibold">City</th>
                        <th class="hidden lg:table-cell px-4 py-3 font-semibold">About</th>
                        <th class="px-3 py-3 sm:px-4 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#4e148c]/10">

                    <?php foreach ($providers as $provider):
                        $terms = get_the_terms($provider->ID, "provider_category");

                        $slugs = [];

                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $slugs[] = $term->slug;
                            }
                        }
                        $city = get_post_meta($provider->ID, 'provider_city', true);

                    ?>
                        <tr
                            class="provider transition-all duration-300 bg-white hover:bg-[#4e148c]/5"
                            data-category="<?php echo esc_attr(implode(' ', $slugs)); ?>">
                            <td class="px-3 py-3 sm:px-4 sm:py-4">
                                <div class="flex items-center gap-3">
                                    <?php
                                    echo get_the_post_thumbnail($provider->ID, 'thumbnail', [
                                        'class' => 'hidden lg:block h-16 w-16 rounded-lg object-cover shrink-0',
                                    ]);
                                    ?>
                                    <span class="font-display font-bold text-[#2c0735] text-sm sm:text-base">
                                        <?php echo esc_html($provider->post_title); ?>
                                    </span>
                                </div>
                            </td>
                            <td class="hidden lg:table-cell px-4 py-4 text-sm text-[#2c0735]/80">
                                <?php echo esc_html($city ?: '—'); ?>
                            </td>
                            <td class="hidden lg:table-cell px-4 py-4 text-sm text-[#2c0735]/80 max-w-xs truncate">
                                <?php echo esc_html(wp_trim_words(wp_strip_all_tags($provider->post_content), 12)); ?>
                            </td>
                            <td class="px-3 py-3 sm:px-4 sm:py-4 text-right whitespace-nowrap">
                                <a
                                    href="<?php echo esc_url(get_permalink($provider->ID)); ?>"
                                    class="inline-flex rounded-xl bg-[#858ae3] px-3 py-2 sm:px-4 text-white text-xs sm:text-sm hover:bg-[#613dc1] transition-colors">
                                    Read more
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>