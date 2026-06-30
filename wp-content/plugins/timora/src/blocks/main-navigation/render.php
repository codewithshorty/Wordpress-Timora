<?php

$menuItems = $attributes["menuItems"] ?? [];
$logo = $attributes["logo"] ?? "";
$sideButtonText = $attributes["sideButtonText"] ?? "";
$sideButtonURL = $attributes["sideButtonURL"] ?? "";
$themeColor = $attributes["themeColor"] ?? "";
$menuTextColor = $attributes["menuTextColor"] ?? "";

?>

<header class="timora-navigation">
    <div class="container mx-auto">

        <nav class="flex items-center justify-between py-6">

            <!-- Logo -->

            <div class="w-[180px] flex justify-start">
                <?php if ($logo) : ?>
                    <a href="/">
                        <img
                            src="<?php echo esc_url($logo); ?>"
                            alt="Logo"
                            class="w-full h-auto object-contain">
                    </a>
                <?php endif; ?>
            </div>

            <!-- Navigation -->

            <div class="flex items-center justify-center space-x-10">

                <?php foreach ($menuItems as $item) : ?>

                    <a
                        href="<?php echo esc_url($item["url"]); ?>"
                        class="timora-nav-link uppercase font-bold tracking-wider duration-300 hover:scale-110 text-shadow-lg text-shadow-black"
                        style="color: <?php echo esc_attr($themeColor); ?>;">

                        <?php echo esc_html($item["name"]); ?>
                    </a>

                <?php endforeach; ?>

            </div>

            <!-- CTA -->

            <div class="flex justify-end">

                <a
                    href="<?php echo esc_url($sideButtonURL); ?>"
                    class="timora-side-button px-8 py-4 rounded-2xl text-black uppercase font-bold duration-300 hover:translate-y-2 hover:shadow-lg"
                    style="background-color: <?php echo esc_attr($themeColor); ?>; color:<?php echo esc_attr($menuTextColor) ?>">
                    <?php echo esc_html($sideButtonText); ?>
                </a>

            </div>

        </nav>

    </div>
</header>