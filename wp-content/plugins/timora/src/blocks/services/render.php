<?php

$services = get_posts([
    "post_type"      => "service",
    "posts_per_page" => -1,
    "post_status"    => "publish",
    "order" => "ASC"
]);

$servicesTitle = $attributes["servicesTitle"] ?? "";
$servicesSpan = $attributes["servicesSpan"] ?? "";
$themeColor = $attributes["themeColor"] ?? "#000";
$textColor  = $attributes["textColor"] ?? "#fff";

?>

<section id="services">

    <div class="container mx-auto py-10 text-black">

        <div class="flex flex-col space-y-28 justify-center items-center">

            <h2
                class="text-6xl text-center font-extrabold uppercase mb-8"
                style="color: <?php echo esc_attr($themeColor); ?>">

                <?php echo wp_kses_post($servicesTitle); ?>

                <br>

                <span class="italic font-bold">
                    <?php echo wp_kses_post($servicesSpan); ?>
                </span>

            </h2>

            <?php foreach ($services as $index => $service) : ?>

                <?php

                $duration = get_post_meta(
                    $service->ID,
                    "duration",
                    true
                );

                $price = get_post_meta(
                    $service->ID,
                    "price",
                    true
                );

                ?>

                <div
                    class="group service flex items-center border-b-2 rounded-2xl text-black bg-white transition-all duration-500 w-full h-72"
                    style="
                        --hover-bg-color: <?php echo esc_attr($themeColor); ?>;
                        --hover-text-color: <?php echo esc_attr($textColor); ?>;
                    ">

                    <!-- LEFT SIDE -->

                    <div class="flex justify-between p-8 w-[65%]">

                        <div class="flex justify-start space-x-4 w-[60%]">

                            <p class="text-5xl font-light">
                                <?php echo str_pad($index + 1, 2, "0", STR_PAD_LEFT); ?>
                            </p>

                            <div class="flex space-y-3">

                                <!-- Service title -->

                                <h3 class="text-5xl font-bold">
                                    <?php echo esc_html($service->post_title); ?>
                                </h3>

                                <!-- Duration + Price -->

                                <div class="flex gap-3">

                                    <div
                                        class="flex justify-center items-center rounded-full text-sm font-semibold ms-8">

                                        ⏱ <?php echo esc_html($duration); ?>

                                    </div>

                                    <div
                                        class="flex justify-center items-center rounded-full text-sm font-semibold">

                                        💰 <?php echo esc_html($price); ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Description -->

                        <div class="flex justify-end items-center w-[40%]">

                            <p class="text-lg font-semibold">

                                <?php
                                echo wp_kses_post(
                                    wpautop($service->post_content)
                                );
                                ?>

                            </p>

                        </div>

                    </div>

                    <!-- IMAGE -->

                    <div class="flex items-center justify-between p-8 w-[35%]">

                        <?php

                        echo get_the_post_thumbnail(
                            $service->ID,
                            "large",
                            [
                                "class" => "rounded-2xl scale-50 transition-transform duration-500 group-hover:rotate-8 group-hover:scale-100"
                            ]
                        );

                        ?>

                        <button
                            type="button"
                            class="circleButton rounded-full p-4 border-2 font-extrabold transition-all duration-500 cursor-pointer"
                            style="
                                background-color: <?php echo esc_attr($themeColor); ?>;
                                color: <?php echo esc_attr($textColor); ?>;
                            ">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-8 transition-transform duration-500 group-hover:rotate-2">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />

                            </svg>

                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>