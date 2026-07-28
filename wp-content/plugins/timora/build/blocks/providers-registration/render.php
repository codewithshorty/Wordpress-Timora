<?php

$provider_categories = get_terms([
    "taxonomy" => "provider_category",
    "hide_empty" => false
]);

?>

<section id="contact" class="py-20 bg-[#f9fbff]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">
            <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-[#4e148c]">Register as a provider</h2>
            <p class="mt-3 text-[#2c0735]/80">Grow your business with Timora and start accepting online appointments in minutes.<br /> Join our network of trusted providers today.
            </p>
        </div>

        <div class="mt-10 grid lg:grid-cols-2 gap-8">
            <div class="rounded-2xl ring-1 ring-[#4e148c]/15 bg-white p-6 shadow-soft">
                <div class="flex justify-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-[#4e148c]/40 flex items-center justify-center text-white font-bold">
                        Logo
                    </div>
                </div>
                <form id="registerProviderForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#2c0735]">Business name *</label>
                        <input id="businessName" type="text" required="" class="mt-1 w-full rounded-xl border border-[#4e148c]/25 px-3 py-2 text-sm focus-ring" placeholder="Business name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#2c0735]">Owner full name *</label>
                        <input type="text" id="ownerName" required="" class="mt-1 w-full rounded-xl border border-[#4e148c]/25 px-3 py-2 text-sm focus-ring" placeholder="Owner's full name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#2c0735]">Email *</label>
                        <input id="email" type="email" id="ownerEmail" required="" class="mt-1 w-full rounded-xl border border-[#4e148c]/25 px-3 py-2 text-sm focus-ring" placeholder="you@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#2c0735]">Password *</label>
                        <input id="password" type="password" id="ownerPassword" required="" class="mt-1 w-full rounded-xl border border-[#4e148c]/25 px-3 py-2 text-sm focus-ring" placeholder="Create a password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#2c0735]">Industry *</label>
                        <select id="industry" required="" class="mt-1 w-full rounded-xl border border-[#4e148c]/25 px-3 py-2 text-sm focus-ring">
                            <option value="">Select industry</option>
                            <?php
                            foreach ($provider_categories as $category) :

                            ?>
                                <option value="<?php echo esc_html($category->term_id) ?>">
                                    <?php echo esc_html($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button id="register_provider" class="inline-flex items-center gap-2 rounded-xl bg-[#613dc1] px-5 py-3 text-white hover:bg-[#4e148c] transition-colors shadow-soft focus-ring" type="submit">
                        <i class="bi bi-envelope-paper-heart"></i>
                        Register as a provider
                    </button>
                    <p id="contactStatus" class="text-sm text-[#2c0735]/80"></p>
                </form>
                <div id="formProviderMessage"></div>
            </div>
            <div class="space-y-4">
                <img src="https://media.clicksites.ai/clicksites/uploads/7934/a_clean_abstract_map_illustra_c873839049feb0a3e94f3c18597606e2.png" class="w-full h-64 md:h-80 object-cover rounded-2xl ring-1 ring-[#4e148c]/15 shadow-soft" alt="Abstract map with a location pin">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="rounded-xl bg-white ring-1 ring-[#4e148c]/15 p-4">
                        <div class="flex items-center gap-3">
                            <span class="h-10 w-10 rounded-lg bg-[#858ae3]/15 text-[#858ae3] flex items-center justify-center"><i class="bi bi-telephone"></i></span>
                            <div>
                                <div class="text-sm font-medium">Phone</div>
                                <a href="tel:+15551234567" class="text-sm text-[#613dc1] hover:text-[#4e148c] transition-colors" style="cursor: default;">+1 (555) 123‑4567</a>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white ring-1 ring-[#4e148c]/15 p-4">
                        <div class="flex items-center gap-3">
                            <span class="h-10 w-10 rounded-lg bg-[#858ae3]/15 text-[#858ae3] flex items-center justify-center"><i class="bi bi-envelope"></i></span>
                            <div>
                                <div class="text-sm font-medium">Email</div>
                                <a href="mailto:support@twilightbooking.com" class="text-sm text-[#613dc1] hover:text-[#4e148c] transition-colors" style="cursor: default;">support@twilightbooking.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white ring-1 ring-[#4e148c]/15 p-4 sm:col-span-2">
                        <div class="flex items-center gap-3">
                            <span class="h-10 w-10 rounded-lg bg-[#858ae3]/15 text-[#858ae3] flex items-center justify-center"><i class="bi bi-clock"></i></span>
                            <div>
                                <div class="text-sm font-medium">Support hours</div>
                                <div class="text-sm text-[#2c0735]/80">Mon–Fri 8:00–18:00 (UTC), 24/7 priority for Business</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>