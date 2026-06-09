<?php get_header() ?>
<?php if (have_posts()):

    while (have_posts()):
        the_post();
        the_content();
    endwhile;


endif; ?>

<div class="bg-red-500 text-white p-10">
    TEST TAILWIND
</div>
<?php get_footer() ?>