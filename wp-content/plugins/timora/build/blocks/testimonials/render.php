<?php

$testimonials = get_posts([
    "post_type" => "testimonial",
    "posts_per_page" => -1,
    "post_status" => "publish"
]);
?>

<h2 class="text-center text-blue-700 text-6xl font-bold">Testimonials</h2>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php foreach ($testimonials as $testimonial) : ?>
            <div class="swiper-slide ">
                <div class="container mx-auto py-10 text-black w-[60%] ">
                    <div
                        class="flex justify-between w-full p-8 rounded-2xl text-blue-700 bg-white border-b-2 shadow-lg shadow-blue-700">
                        <div class="w-[50%] flex flex-col justify-end space-y-8">
                            <p class="font-extrabold text-3xl">
                                <?php echo wp_kses_post(wp_strip_all_tags($testimonial->post_content)) ?>
                            </p>
                            <p class="font-medium tracking-wider text-lg">
                                <?php echo esc_html(wp_strip_all_tags($testimonial->post_title)) ?>
                            </p>
                        </div>
                        <div class="w-[50%] flex justify-end relative">
                            <?php echo get_the_post_thumbnail($testimonial->ID, "large", [
                                'class' => 'rounded-2xl w-[300px] h-[300px] object-cover z-20'

                            ]) ?>
                            <div
                                class="rounded-2xl w-[300px] h-[300px] absolute top-1.5 -right-1.5 z-10 bg-blue-700"></div>
                        </div>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>


</div>