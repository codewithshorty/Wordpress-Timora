<?php get_header(); ?>
<?php
$provider_id = get_the_ID();
$provider_city = get_post_meta(get_the_ID(), "provider_city", true);
$provider_address = get_post_meta(get_the_ID(), "provider_address", true);
$provider_phone = get_post_meta(get_the_ID(), "provider_phone", true);
$provider_email = get_post_meta(get_the_ID(), "provider_email", true);
$provider_website = get_post_meta(get_the_ID(), "provider_website", true);
$provider_categories = get_the_terms(get_the_ID(), "provider_category");

function get_timora_provider_services($pr_id)

{
    return new WP_Query([
        "post_type" => "service",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "meta_query" => [
            [
                "key" => "provider_service",
                "value" => $pr_id,
                "compare" => "=",
                "type" => "NUMERIC"
            ]

        ]
    ]);
};



$services = get_timora_provider_services($provider_id);

function get_timora_provider_team_members($pr_id)
{
    return new WP_Query([
        "post_type" => "team_member",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "meta_query" => [
            [
                "key" => "provider_team_member",
                "value" => $pr_id,
                "compare" => "=",
                "type" => "NUMERIC"
            ]
        ]
    ]);
}

$team_members = get_timora_provider_team_members($provider_id);


function get_timora_provider_testimonials($pr_id)
{
    return new WP_Query([
        "post_type" => "testimonial",
        "posts_per_page" => -1,
        "post_status" => "publish",
        "meta_query" => [
            [
                "key" => "testimonial_provider",
                "value" => $pr_id,
                "compare" => "=",
                "type" => "NUMERIC"
            ]
        ]
    ]);
}

$testimonials = get_timora_provider_testimonials($provider_id);

?>


<main>

    <!-- Header / Navigation -->
    <header class="w-full sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                <!-- Brand / Logo -->
                <a href="#" class="flex items-center space-x-2">
                    <span class="text-2xl font-extrabold tracking-tight" style="color:#4E148C;">Timora</span>
                    <span class="text-sm text-gray-500 hidden sm:inline">Provider Profile</span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-6 text-sm">
                    <a href="#" class="text-gray-700 hover:text-indigo-700">Home</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-700">Providers</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-700">Services</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-700">About</a>
                </nav>

                <!-- CTA Button -->
                <div class="hidden md:flex">
                    <button class="px-4 py-2 rounded-md bg-violet-600 text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500" style="background: #613DC1; color:white;">
                        Book Appointment
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100" aria-label="Open menu">
                    <span class="sr-only">Open menu</span>
                    <i class="bi bi-list" style="font-size:1.4rem;"></i>
                </button>
            </div>
        </div>

        <!-- Mobile menu (collapsible) -->
        <div id="mobile-menu" class="md:hidden hidden border-t border-gray-200 bg-white">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Home</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Providers</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">Services</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-50">About</a>
        </div>
    </header>

    <!-- Hero Section (image-focused) -->
    <section aria-label="Provider hero" class="w-full">
        <!-- Background image (generated) -->
        <div data-gen-prompt="A panoramic, premium hair studio interior with clean lines, soft natural lighting, light wood accents, modern styling chairs, and a calm, welcoming atmosphere. Shot in 21:9 aspect ratio, minimal decor, high-end salon vibe."
            data-gen-aspect="21:9"
            class="w-full h-72 md:h-96 bg-cover bg-center"
            style="background-image: url('data:image/svg+xml;utf8,\
<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22800%22 height=%22800%22 style=" background-image: url('https://media.clicksites.ai/clicksites/uploads/7934/a_panoramic_premium_hair_stud_fabde99238988c76aacdac96ed30c0a0.png'); background-size: cover; background-position: center;">
        </div>

        <!-- Overlaying info strip (overlaps hero) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 md:-mt-20 mb-12">
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8 card-glass border">
                <!-- Provider Logo / Avatar -->

                <?php the_post_thumbnail() ?>

                <!-- Provider details -->
                <div class="flex-1">
                    <div class="flex items-center gap-2 text-gray-800">
                        <span class="text-2xl font-display font-semibold" style="color:#4E148C;"><?php the_title(); ?></span>
                        <span class="inline-flex items-center text-xs px-2 py-1 rounded-full bg-soft-periwinkle/20 text-soft-periwinkle border border-soft-periwinkle" aria-label="Verified">
                            <!-- verification badge -->
                            <i class="bi bi-patch-check-fill" style="font-size:12px;"></i>
                            <span class="ml-1">Verified</span>
                        </span>
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <span class="font-semibold" style="color:#4E148C;">
                            <?php
                            if ($provider_categories) {
                                foreach ($provider_categories as $category) {
                                    echo $category->name . " * ";
                                }
                            } else {
                                echo "There are no available categories";
                            }
                            ?>
                        </span>
                    </div>
                    <p class="mt-3 text-gray-700 max-w-prose" aria-label="Provider description">
                        <?php the_content(); ?>
                    </p>
                    <!-- CTA buttons -->
                    <div class="mt-4 flex flex-wrap gap-3">
                        <button class="px-4 py-2 rounded-md hover:bg-blue-500" style="background:#613DC1; color:white; border:0;">
                            Book Appointment
                        </button>
                        <button class="px-4 py-2 rounded-md border" style="border-color:#CED4F4; color:#4E148C; background:white;">
                            Contact Provider
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- 3. Provider Information / Contact -->
        <section aria-label="Provider contact" class="py-8 bg-white border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Phone -->
                <div class="flex items-start gap-3 p-4 border rounded-md hover:shadow-sm bg-white">
                    <span class="p-2 rounded-full bg-frozen-lake/20 text-frozen-lake">
                        <i class="bi bi-telephone" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-medium">Phone</div>
                        <div class="text-sm font-bold" aria-label="Provider phone"><?php echo $provider_phone ?></div>
                    </div>
                </div>
                <!-- Email -->
                <div class="flex items-start gap-3 p-4 border rounded-md hover:shadow-sm bg-white">
                    <span class="p-2 rounded-full bg-frozen-lake/20 text-frozen-lake">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-medium">Email</div>
                        <div class="text-sm font-bold" aria-label="Provider email"><?php echo $provider_email ?></div>
                    </div>
                </div>
                <!-- Website -->
                <div class="flex items-start gap-3 p-4 border rounded-md hover:shadow-sm bg-white">
                    <span class="p-2 rounded-full bg-frozen-lake/20 text-frozen-lake">
                        <i class="bi bi-globe" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-medium">Website</div>
                        <div class="text-sm font-bold" aria-label="Provider website"><a href="{{provider_website}}" class="text-soft-periwinkle hover:text-indigo"><?php echo $provider_website ?></a></div>
                    </div>
                </div>
                <!-- Address -->
                <div class="flex items-start gap-3 p-4 border rounded-md hover:shadow-sm bg-white">
                    <span class="p-2 rounded-full bg-frozen-lake/20 text-frozen-lake">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-medium">Address</div>
                        <div class="text-sm font-bold" aria-label="Provider address"><?php echo $provider_address ?></div>
                    </div>
                </div>
                <!-- City -->
                <div class="flex items-start gap-3 p-4 border rounded-md hover:shadow-sm bg-white">
                    <span class="p-2 rounded-full bg-frozen-lake/20 text-frozen-lake">
                        <i class="bi bi-buildings" aria-hidden="true"></i>
                    </span>
                    <div>
                        <div class="text-sm font-medium">City</div>
                        <div class="text-sm font-bold" aria-label="Provider city"><?php echo $provider_city ?></div>
                    </div>
                </div>
                <!-- Spacer / Note -->
                <div class="p-4 rounded-md bg-white border-dashed border rounded-md">
                    <div class="text-sm text-gray-600">
                        This section is designed to be easily replaced with dynamic data in WordPress.
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Gallery Section -->
        <section aria-label="Gallery" class="py-12 bg-white border-t border-gray-200" id="gallery">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-semibold" style="color:#4E148C;">Gallery</h3>
                    <p class="text-sm text-gray-600">A glimpse into the provider's space and work.</p>
                </div>
                <button class="px-4 py-2 rounded-md text-sm text-soft-periwinkle border border-soft-periwinkle hover:bg-soft-periwinkle/20">View Gallery</button>
            </div>

            <!-- Gallery grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <!-- 6 images with varied sizes -->
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/interior_shot_of_a_premium_hai_5e7f7da3e1295cd168768f6ea0637da2.png" alt="Gallery image 1" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22480%22%3E%3Cdefs%3E%3CradialGradient id=%22g%22 cx=%2250%25%22 cy=%2250%25%22 r=%2250%25%22%3E%3Cstop stop-color=%2397DFFC/%3E%3Cstop offset=%221%22 stop-color=%23858AE3/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect width=%22320%22 height=%22480%22 fill=%22url(%23g)%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" style="aspect-ratio: 4/3;" />
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/close_up_of_styling_tools_in_a_7b61c13129e3195e162371d3f1d69332.png" alt="Gallery image 2" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22480%22%3E%3Crect width=%22320%22 height=%22480%22 fill=%22%236e8fe3%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" />
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/wide_shot_of_a_calming_recepti_737746d48dfaeabb31c675811a17caa3.png" alt="Gallery image 3" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22640%22 height=%22800%22%3E%3Crect width=%22640%22 height=%22800%22 fill=%22%23f0f4ff%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" style="grid-column: span 2 / span 2;" />
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/close_up_of_cosmetic_product_d_37f941e2ab5c734b97d924088a4a79a9.png" alt="Gallery image 4" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22320%22%3E%3Crect width=%22320%22 height=%22320%22 fill=%22%2377d1ff%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" />
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/action_shot_of_a_stylist_cutti_2a416479eadd7d790fabea0c4a5b11c3.png" alt="Gallery image 5" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22534%22%3E%3Crect width=%22400%22 height=%22534%22 fill=%22%23d9e3f7%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" />
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/detail_shot_of_salon_chair_and_be113e6490e92be8d549e54f24e61837.png" alt="Gallery image 6" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22640%22 height=%28480%22%3E%3Crect width=%22640%22 height=%28480%22 fill=%22%23e4e9f7%22/%3E%3C/svg%3E" class="w-full h-full object-cover rounded-md cursor-pointer" />
            </div>
        </section>

        <!-- Lightbox (Gallery Preview) -->
        <div id="lightbox" aria-label="Gallery preview" role="dialog">
            <img src="" alt="Preview" />
        </div>

        <!-- 6. Services Section -->
        <section aria-label="Services" class="py-12 bg-white border-t border-gray-200" id="services">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-semibold" style="color:#4E148C;">Services</h3>
                    <p class="text-sm text-gray-600">Choose a service and find an available appointment.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if ($services->have_posts()) : ?>
                    <?php while ($services->have_posts()):
                        $services->the_post();
                        $service_id = get_the_ID();
                        $service_price = get_post_meta($service_id, "price", true);
                        $service_duration = get_post_meta($service_id, "duration", true);
                        $service_provider = get_post_meta($service_id, "provider_service", true);

                    ?>

                        <article class="border rounded-md p-4 hover:shadow-md transition-shadow duration-200" data-service-id="haircut" tabindex="0">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold" style="color:#4E148C;"><?php the_title(); ?></h4>
                                    <p class="text-sm text-gray-600 mt-1"><?php the_content(); ?></p>
                                </div>
                                <span class="text-sm text-gray-600"><span><?php echo esc_html($service_price) ?></span> RSD</span>
                            </div>
                            <div class="mt-2 text-sm text-gray-600">
                                Duration: <?php echo esc_html($service_duration) ?>
                            </div>
                            <!-- <button class="mt-3 w-full px-4 py-2 rounded-md border" style="border-color:#dbe2ff; background:white; color:#4E148C;">
                                Book
                            </button> -->
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>

                <?php else: ?>
                    <p>Services are not available for this provider.</p>
                <?php endif; ?>
                <!-- 
                <article class="border rounded-md p-4 hover:shadow-md transition-shadow duration-200" data-service-id="haircut-beard" tabindex="0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-lg font-semibold" style="color:#4E148C;">Haircut + Beard</h4>
                            <p class="text-sm text-gray-600 mt-1">Complete grooming for a refined look.</p>
                        </div>
                        <span class="text-sm text-gray-600">RSD 1,200</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Duration: 45 min
                    </div>
                    <button class="mt-3 w-full px-4 py-2 rounded-md bg-frozen-lake/20 text-slate-800 border border-frozen-lake hover:bg-frozen-lake/40" data-selected="false">
                        Book
                    </button>
                </article>

                <article class="border rounded-md p-4 hover:shadow-md transition-shadow duration-200" data-service-id="color" tabindex="0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-lg font-semibold" style="color:#4E148C;">Hair Coloring</h4>
                            <p class="text-sm text-gray-600 mt-1">Premium color services for a fresh look.</p>
                        </div>
                        <span class="text-sm text-gray-600">RSD 2,500</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Duration: 90 min
                    </div>
                    <button class="mt-3 w-full px-4 py-2 rounded-md border" style="border-color:#dbe2ff; background:white; color:#4E148C;">
                        Book
                    </button>
                </article> -->
            </div>
        </section>

        <!-- 7. Team Section (if multiple staff) -->
        <section aria-label="Meet the Team" class="py-12 bg-white border-t border-gray-200" id="team">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-semibold" style="color:#4E148C;">Meet the Team</h3>
                    <p class="text-sm text-gray-600">Our professionals at a glance.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if ($team_members->have_posts()): ?>
                    <?php while ($team_members->have_posts()) :
                        $team_members->the_post();
                        $position = get_post_meta(get_the_ID(), "team_member_position", true);
                    ?>
                        <article class="border rounded-md p-4 flex flex-col items-start">
                            <?php echo get_the_post_thumbnail(
                                get_the_ID(),
                                "small",
                                [
                                    "class" => "w-24 h-24 rounded-full mb-3"
                                ]
                            ); ?>
                            <!-- <img src="https://media.clicksites.ai/clicksites/uploads/7934/professional_portrait_of_a_hai_61f86e47c09943b879205de7fc1b3771.png" alt="Team member 1" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22320%22%3E%3Crect width=%22320%22 height=%22320%22 fill=%22%2377d1ff%22/%3E%3C/svg%3E" class="w-24 h-24 rounded-full mb-3" style="object-fit:cover;"> -->
                            <div class="font-semibold"><?php the_title(); ?></div>
                            <div class="text-sm text-gray-600 mb-2"><?php echo esc_html($position) ?></div>

                            <p class="text-sm text-gray-600 mb-2"><?php the_content() ?></p>
                            <!-- <a href="#" class="text-soft-periwinkle hover:text-indigo">Book with Alexandra</a> -->
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <p>Team Members not available at this moment.</p>
                <?php endif; ?>
                <!-- <article class="border rounded-md p-4 flex flex-col items-start">
                    <img src="https://media.clicksites.ai/clicksites/uploads/7934/portrait_of_a_beauty_specialis_f6277ef251f5dcbbc0eac68011f398c2.png" alt="Team member 2" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22320%22%3E%3Crect width=%22320%22 height=%22320%22 fill=%22%2385a8ff%22/%3E%3C/svg%3E" class="w-24 h-24 rounded-full mb-3" style="object-fit:cover;">
                    <div class="font-semibold">Mina Jovic</div>
                    <div class="text-sm text-gray-600 mb-2">Color Specialist</div>
                    <p class="text-sm text-gray-600 mb-2">Expert in color correction and vivid hues.</p>
                    <a href="#" class="text-soft-periwinkle hover:text-indigo">Book with Mina</a>
                </article>

                <article class="border rounded-md p-4 flex flex-col items-start">
                    <img src="https://media.clicksites.ai/clicksites/uploads/7934/well_dressed_medical_aesthetic_e3859297b2840044b45ddccc9db5c50d.png" alt="Team member 3" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22320%22%3E%3Crect width=%22320%22 height=%22320%22 fill=%22%23ffcccb%22/%3E%3C/svg%3E" class="w-24 h-24 rounded-full mb-3" style="object-fit:cover;">
                    <div class="font-semibold">Luka Petrov</div>
                    <div class="text-sm text-gray-600 mb-2">Barber & Grooming</div>
                    <p class="text-sm text-gray-600 mb-2">Precision cuts with a modern edge.</p>
                    <a href="#" class="text-soft-periwinkle hover:text-indigo">Book with Luka</a>
                </article> -->
            </div>
        </section>

        <!-- 8. Testimonials Section (short, impactful) -->
        <section aria-label="Top testimonials" class="py-12 bg-frozen-lake-soft border-t border-gray-200" id="testimonials">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-2xl font-semibold" style="color:#4E148C;">What clients say</h3>
                <p class="text-sm text-gray-600 mt-2 mb-6">A quick glance at feedback from our visitors.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <?php if ($testimonials->have_posts()): ?>
                    <?php while ($testimonials->have_posts()): ?>
                        <?php
                        $testimonials->the_post();
                        $testimonial_rating = get_post_meta(get_the_ID(), "testimonial_rating", true);
                        ?>
                        <blockquote class="p-4 border rounded-md bg-white shadow-sm">
                            <p class="text-gray-700"><?php the_content(); ?></p>
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-2">
                                    <?php
                                    echo get_the_post_thumbnail(
                                        get_the_ID(),
                                        "small",
                                        [
                                            "class" => "w-8 h-8 rounded-full"
                                        ]
                                    );
                                    ?>
                                    <!-- <img src="https://media.clicksites.ai/clicksites/uploads/7934/avatar_of_a_happy_client_f4c3ae73c5295d0dfc56d417fa821fa8.png" alt="Reviewer 1" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2230%22 height=%2230%22%3E%3Ccircle cx=%2250%25%22 cy=%2250%25%22 r=%2240%22 fill=%22%2377d1ff%22/%3E%3C/svg%3E" class="w-8 h-8 rounded-full" /> -->
                                    <strong class="text-sm"><?php the_title(); ?></strong>
                                </div>
                                <!-- <span class="text-sm text-yellow-500">★★★★★</span> -->
                                <span class="text-sm text-yellow-500"><?php echo esc_html($testimonial_rating); ?></span>

                            </div>
                            <!-- <div class="text-xs text-gray-500 mt-1">September 2026</div> -->
                            <div class="text-xs text-gray-500 mt-1"><?php echo get_the_date(); ?></div>

                        </blockquote>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <!-- Testimonial 2 -->
                <!-- <blockquote class="p-4 border rounded-md bg-white shadow-sm">
                    <p class="text-gray-700">“Professional and calming atmosphere. Highly recommended.”</p>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center gap-2">
                            <img src="https://media.clicksites.ai/clicksites/uploads/7934/avatar_of_a_satisfied_client_5c94bfb3fa2fdcccd5f20f627e433087.png" alt="Reviewer 2" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2230%22 height=%2230%22%3E%3Ccircle cx=%2250%25%22 cy=%2250%25%22 r=%2240%22 fill=%22%2385a8ff%22/%3E%3C/svg%3E" class="w-8 h-8 rounded-full" />
                            <strong class="text-sm">Jelena Kovačević</strong>
                        </div>
                        <span class="text-sm text-yellow-500">★★★★★</span>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">August 2026</div>
                </blockquote> -->

                <!-- Testimonial 3 -->
                <!-- <blockquote class="p-4 border rounded-md bg-white shadow-sm">
                    <p class="text-gray-700">“Fantastic color work and care for detail.”</p>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center gap-2">
                            <img src="https://media.clicksites.ai/clicksites/uploads/7934/avatar_of_a_salon_client_35f5ca002b1064bc067ff87f36079e51.png" alt="Reviewer 3" src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2230%22 height=%2230%22%3E%3Ccircle cx=%2250%25%22 cy=%2250%25%22 r=%2240%22 fill=%22%23ffd6a5%22/%3E%3C/svg%3E" class="w-8 h-8 rounded-full" />
                            <strong class="text-sm">Ana Milenković</strong>
                        </div>
                        <span class="text-sm text-yellow-500">★★★★★</span>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">June 2026</div>
                </blockquote> -->
            </div>
        </section>

        <!-- 9. Working Hours Section -->
        <section aria-label="Working hours" class="py-12 bg-white border-t border-gray-200" id="hours">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-semibold" style="color:#4E148C;">Working Hours</h3>
                <p class="text-sm text-gray-600 mt-2">Appointment availability may vary depending on service duration and existing bookings.</p>

                <table class="w-full mt-4 text-sm text-left">
                    <thead class="text-xs uppercase text-gray-500">
                        <tr>
                            <th class="py-2">Day</th>
                            <th class="py-2">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">Monday</td>
                            <td class="py-2">09:00 – 17:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Tuesday</td>
                            <td class="py-2">09:00 – 17:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Wednesday</td>
                            <td class="py-2">09:00 – 17:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Thursday</td>
                            <td class="py-2">09:00 – 17:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Friday</td>
                            <td class="py-2">09:00 – 17:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Saturday</td>
                            <td class="py-2">09:00 – 14:00</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2" style="color:#2C0735;">Sunday</td>
                            <td class="py-2" style="color:#2C0735;">Closed</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- 10. Booking Calendar Section -->
        <section aria-label="Booking calendar" class="py-12 bg-white border-t border-gray-200" id="booking">
            <form id="booking-form">
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold" style="color:#4E148C;">Book an Appointment</h3>
                    <p class="text-sm text-gray-600">Choose a service, date and available time.</p>
                </div>

                <!-- Step 1: Select Service -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <input type="hidden" id="provider-booking-id" value="<?php echo esc_attr(get_the_ID()) ?>">
                    <div>
                        <label for="service-select" class="block text-sm font-medium text-gray-700 mb-1">Step 1 — Select Service</label>
                        <?php if ($services->have_posts()): ?>
                            <select id="service-select"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Select type of service</option>
                                <?php while ($services->have_posts()):
                                    $services->the_post();
                                    $service_duration = get_post_meta(get_the_ID(), "duration", true);
                                    $service_price = get_post_meta(get_the_ID(), "price", true);
                                ?>
                                    <option value="<?php echo get_the_ID() ?>"
                                        data-duration="<?php echo esc_attr($service_duration) ?>"
                                        data-price="<?php echo esc_attr($service_price) ?>"
                                        data-title="<?php echo esc_attr(get_the_title()) ?>">
                                        <?php the_title(); ?>
                                    </option>

                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </select>
                        <?php endif; ?>

                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Selected Service Details</label>
                        <div class="py-2 px-3 rounded-md border border-gray-300 bg-white text-sm text-gray-700" id="service-details">
                            Duration: <span class="display-duration font-bold"></span> • Price: <span class="display-price font-bold"></span> RSD
                        </div>
                    </div>
                </div>

                <!-- Step 2: Select Date (simple calendar grid) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Step 2 — Select Date</label>
                        <div class="flex items-center justify-between mb-2">
                            <!-- <button class="px-2 py-1 rounded border text-sm" id="prev-month">‹</button>
                            <div class="text-sm font-medium" id="month-label">November 2026</div>
                            <button class="px-2 py-1 rounded border text-sm" id="next-month">›</button> -->
                            <input
                                type="date"
                                id="booking-date"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <!-- <div class="grid grid-cols-7 gap-2 text-xs text-center">
                            <span class="text-gray-500">Mon</span><span class="text-gray-500">Tue</span><span class="text-gray-500">Wed</span><span class="text-gray-500">Thu</span><span class="text-gray-500">Fri</span><span class="text-gray-500">Sat</span><span class="text-gray-500">Sun</span>
                            <button class="p-2 rounded-md text-sm" aria-label="date-1" data-date="2026-11-01">1</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-2" data-date="2026-11-02">2</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-3" data-date="2026-11-03" disabled>3</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-4" data-date="2026-11-04">4</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-5" data-date="2026-11-05" style="opacity:.5" disabled>5</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-6" data-date="2026-11-06">6</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-7" data-date="2026-11-07">7</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-8" data-date="2026-11-08">8</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-9" data-date="2026-11-09" disabled>9</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-10" data-date="2026-11-10">10</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-11" data-date="2026-11-11">11</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-12" data-date="2026-11-12" disabled>12</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-13" data-date="2026-11-13">13</button>
                            <button class="p-2 rounded-md text-sm" aria-label="date-14" data-date="2026-11-14">14</button>
                        </div> -->
                    </div>

                    <!-- Step 3: Time slots (static demo) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Step 3 — Available Time Slots</label>

                        <select
                            id="booking-time"
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <!-- <option value="">
                                Select booking time
                            </option> -->
                        </select>
                        <!-- <div class="border rounded-md p-3 bg-white">
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="09:00" data-time="09:00">09:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="09:30" data-time="09:30">09:30</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="10:00" data-time="10:00">10:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="10:30" data-time="10:30">10:30</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="11:00" data-time="11:00">11:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="11:30" data-time="11:30">11:30</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="12:00" data-time="12:00" disabled>12:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="12:30" data-time="12:30">12:30</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="13:00" data-time="13:00">13:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="13:30" data-time="13:30">13:30</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="14:00" data-time="14:00">14:00</button>
                            <button class="slot p-2 rounded-md text-sm bg-frozen-lake/20 hover:bg-frozen-lake/40" aria-label="14:30" data-time="14:30">14:30</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Selected time slots are for demonstration purposes and do not connect to real bookings.</p>
                    </div> -->
                    </div>
                </div>

                <!-- Step 4: Customer Information -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="booking_name" class="block text-sm font-medium text-gray-700 mb-1">First name</label>
                        <input id="booking_name" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" type="text" placeholder="Jane" />
                    </div>
                    <div>
                        <label for="booking_surname" class="block text-sm font-medium text-gray-700 mb-1">Last name</label>
                        <input id="booking_surname" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" type="text" placeholder="Doe" />
                    </div>
                    <div>
                        <label for="booking_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input id="booking_phone" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" type="tel" placeholder="+381 63 123 456" />
                    </div>
                    <div>
                        <label for="booking_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="booking_email" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" type="email" placeholder="you@example.com" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="booking_notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea id="booking_notes" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm" rows="3" placeholder="Additional details for the provider"></textarea>
                    </div>
                    <!-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmation method</label>
                        <select id="booking_confirmation_method" class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 text-sm">
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div> -->
                </div>

                <!-- Step 5: Confirmation -->
                <div class="mt-6 border-t pt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white border rounded-md p-4">
                        <div class="text-sm text-gray-700">Summary</div>
                        <div class="mt-2 text-sm" id="summary">
                            Service: <span class="display-service"></span> • Date: <span class="display-date"></span> • Time: <span class="display-time"></span> • Duration: <span class="display-duration font-bold"></span> • Price: <span class="display-price font-bold"></span> RSD
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <div id="booking-form-message" class="m-auto"></div>
                        <button type="submit" class="px-5 py-3 rounded-md bg-indigo-400 text-white hover:bg-indigo-600 hover:cursor-pointer transition-all duration-300">
                            Confirm Appointment
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <!-- 11. Reviews Section (detailed) -->
        <section aria-label="Reviews" class="py-12 bg-white border-t border-gray-200" id="reviews">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-4xl font-bold" style="color:#4E148C;">4.8</span>
                        <span class="text-sm text-gray-600">Average rating</span>
                    </div>
                    <div class="text-sm text-gray-600">Based on 128 reviews</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Breakdown -->
                    <div class="p-4 border rounded-md bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm">5 stars</span>
                            <span class="text-sm text-gray-600">80</span>
                        </div>
                        <div class="h-2 bg-frozen-lake rounded-full">
                            <!-- decorative bar -->
                            <span class="block h-2 rounded-full" style="width:80%; background:#4E148C;"></span>
                        </div>
                    </div>
                    <div class="p-4 border rounded-md bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm">4 stars</span>
                            <span class="text-sm text-gray-600">40</span>
                        </div>
                        <div class="h-2 bg-frozen-lake rounded-full">
                            <span class="block h-2 rounded-full" style="width:40%; background:#97DFFC;"></span>
                        </div>
                    </div>
                    <div class="p-4 border rounded-md bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm">3 stars</span>
                            <span class="text-sm text-gray-600">8</span>
                        </div>
                        <div class="h-2 bg-frozen-lake rounded-full">
                            <span class="block h-2 rounded-full" style="width:8%; background:#cbd5e1;"></span>
                        </div>
                    </div>

                    <!-- Individual reviews -->
                    <div class="md:col-span-1 bg-white border rounded-md p-4">
                        <p class="text-sm text-gray-700">“Very professional and welcoming.”</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-600">Maja B.</span>
                            <span class="text-xs text-yellow-500">★★★★★</span>
                        </div>
                    </div>
                    <div class="md:col-span-1 bg-white border rounded-md p-4">
                        <p class="text-sm text-gray-700">“Excellent color work and attention to detail.”</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-600">Ivan R.</span>
                            <span class="text-xs text-yellow-500">★★★★★</span>
                        </div>
                    </div>
                    <div class="md:col-span-1 bg-white border rounded-md p-4">
                        <p class="text-sm text-gray-700">“Relaxing atmosphere and great results.”</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-600">Ana P.</span>
                            <span class="text-xs text-yellow-500">★★★★★</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 12. FAQ Section -->
        <section aria-label="FAQ" class="py-12 bg-white border-t border-gray-200" id="faq">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-semibold" style="color:#4E148C;">FAQ</h3>

                <div class="mt-4 disclosed" id="faq-accordion">
                    <details class="border rounded-md mb-3 p-3 bg-white">
                        <summary class="text-sm font-medium" style="color:#4E148C;">How do I cancel or reschedule an appointment?</summary>
                        <p class="text-sm text-gray-700 mt-2">You can cancel or reschedule up to 24 hours before your appointment through your booking page.</p>
                    </details>
                    <details class="border rounded-md mb-3 p-3 bg-white">
                        <summary class="text-sm font-medium" style="color:#4E148C;">What payment methods are accepted?</summary>
                        <p class="text-sm text-gray-700 mt-2">We accept credit/debit cards and Timora wallet for online bookings.</p>
                    </details>
                    <details class="border rounded-md mb-3 p-3 bg-white">
                        <summary class="text-sm font-medium" style="color:#4E148C;">Do I need to arrive early?</summary>
                        <p class="text-sm text-gray-700 mt-2">We recommend arriving 5–10 minutes early to complete check-in and prep for your service.</p>
                    </details>
                    <details class="border rounded-md mb-3 p-3 bg-white">
                        <summary class="text-sm font-medium" style="color:#4E148C;">What is the cancellation policy?</summary>
                        <p class="text-sm text-gray-700 mt-2">Cancellations made more than 24 hours before the booked time incur no fee; late cancellations may be charged a small fee depending on service duration.</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- 13. Location Section -->
        <section aria-label="Location" class="py-12 bg-white border-t border-gray-200" id="location">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                <div>
                    <h3 class="text-2xl font-semibold" style="color:#4E148C;">Location</h3>
                    <p class="text-sm text-gray-600 mt-2">{{provider_city}}</p>
                    <p class="text-sm text-gray-600">{{provider_address}}</p>
                    <button class="mt-3 px-4 py-2 rounded-md" style="background:#4E148C; color:white; border:0;">
                        Get Directions
                    </button>
                </div>
                <div class="border rounded-md h-64 bg-gray-100" aria-label="Map placeholder" style="min-height: 240px;">
                    <!-- Map placeholder -->
                    <div class="w-full h-full bg-cover" style="background-image: url('data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22800%22 height=%22800%22%3E%3Crect width=%22800%22 height=%22800%22 fill=%22%2397DFFC%22/%3E%3C/svg%3E');"></div>
                </div>
            </div>
        </section>

        <!-- 14. Contact / Social CTA Section -->
        <section aria-label="Final call to action" class="py-12 bg-white border-t border-gray-200" id="cta">
            <div class="flex flex-col items-center text-center">
                <h3 class="text-2xl font-semibold" style="color:#4E148C;">Ready to book your appointment?</h3>
                <p class="text-sm text-gray-600 mt-2">Choose a service and find your preferred time.</p>
                <button class="mt-4 px-6 py-3 rounded-md" style="background:#613DC1; color:white; border:0;">
                    Book Appointment
                </button>

                <div class="flex items-center gap-4 mt-6">
                    <a href="#" class="text-soft-periwinkle hover:text-indigo" aria-label="Instagram"><i class="bi bi-instagram" style="font-size: 1.4rem;"></i></a>
                    <a href="#" class="text-soft-periwinkle hover:text-indigo" aria-label="Facebook"><i class="bi bi-facebook" style="font-size: 1.4rem;"></i></a>
                    <a href="#" class="text-soft-periwinkle hover:text-indigo" aria-label="TikTok"><i class="bi bi-tiktok" style="font-size: 1.4rem;"></i></a>
                </div>
            </div>
        </section>

    </main>

</main>

<?php get_footer(); ?>