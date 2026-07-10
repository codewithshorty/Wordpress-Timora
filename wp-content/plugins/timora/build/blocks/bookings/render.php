<?php


?>
<section id="booking" class="py-24 bg-gray-100">
    <div class="container mx-auto px-6">

        <div class="max-w-3xl mx-auto bg-black rounded-3xl shadow-2xl shadow-black/60 p-10 lg:p-14">

            <div class="mb-10 text-center">
                <h2 class="text-4xl font-bold text-white">
                    Book Your Appointment
                </h2>

                <p class="text-gray-400 mt-3">
                    Fill out the form below and we'll confirm your reservation shortly.
                </p>
            </div>

            <form id="timora-booking-form" class="space-y-8">

                <!-- Name & Surname -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Name
                        </label>

                        <input
                            type="text"
                            id="booking-name"
                            placeholder="John"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black placeholder-gray-400 outline-none border border-transparent focus:border-white transition duration-300">
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Surname
                        </label>

                        <input
                            type="text"
                            id="booking-surname"
                            placeholder="Doe"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black placeholder-gray-400 outline-none border border-transparent focus:border-white transition duration-300">
                    </div>

                </div>

                <!-- Phone & Email -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Phone
                        </label>

                        <input
                            type="tel"
                            id="booking-phone"
                            placeholder="+381 60 123 4567"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black placeholder-gray-400 outline-none border border-transparent focus:border-white transition duration-300">
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            id="booking-email"
                            placeholder="john@example.com"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black placeholder-gray-400 outline-none border border-transparent focus:border-white transition duration-300">
                    </div>

                </div>

                <!-- Calendar & Time -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Calendar
                        </label>

                        <input
                            type="date"
                            id="booking-date"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black outline-none border border-transparent focus:border-white transition duration-300">
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-2">
                            Time
                        </label>

                        <select
                            id="booking-time"
                            class="w-full rounded-xl bg-white px-5 py-4 text-black outline-none border border-transparent focus:border-white transition duration-300">
                            <option value="">
                                Select booking time
                            </option>
                        </select>
                    </div>

                </div>

                <!-- Notes -->
                <div>

                    <label class="block text-white font-semibold mb-2">
                        Notes
                    </label>

                    <textarea
                        id="booking-notes"
                        rows="5"
                        placeholder="Write additional information..."
                        class="w-full rounded-xl bg-white px-5 py-4 text-black placeholder-gray-400 outline-none border border-transparent resize-none focus:border-white transition duration-300"></textarea>

                </div>

                <!-- Button -->
                <div class="pt-4">

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-white text-black font-bold uppercase tracking-widest py-5 hover:-translate-y-1 hover:shadow-xl hover:shadow-white/30 transition-all duration-300">
                        Book
                    </button>

                </div>

            </form>

            <div id="message-text" class="hidden"></div>
        </div>

    </div>
</section>