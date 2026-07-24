import { useBlockProps, RichText } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n"
import { ArrowRight, CirclePlay, Star, Users, ShieldCheck, Smartphone, Globe } from "lucide-react";

export default function Save({ attributes }) {

    const blockProps = useBlockProps.save();
    const { introTitle, introDescription, introImageURL, introFeature1, introFeature2, introFeature3 } = attributes;

    return (
        <div {...blockProps}>
            <section id="about" className="py-20 bg-white">
                <div className="max-w-7xl mx-auto px-6">
                    <div className="max-w-4xl">
                        <RichText.Content
                            tagName="h2"
                            value={introTitle}
                            className="font-display text-3xl sm:text-4xl font-extrabold text-[#4e148c]"
                        />
                        <RichText.Content
                            tagName="p"
                            value={introDescription}
                            className="mt-5 text-[#2c0735]/80"
                        />

                        <div className="mt-6 flex flex-wrap items-center gap-4">
                            <span className="inline-flex items-center gap-2 rounded-full bg-[#97dffc]/50 text-[#2c0735] px-3 py-1 text-sm ring-1 ring-[#97dffc]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-star-icon lucide-star"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"
                                    className="text-purple-600"
                                /></svg>

                                4.9 avg rating
                            </span>
                            <span className="inline-flex items-center gap-2 rounded-full bg-[#97dffc]/30 text-[#2c0735] px-3 py-1 text-sm ring-1 ring-[#97dffc]/60">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-users-icon lucide-users text-purple-600"

                                ><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><path d="M16 3.128a4 4 0 0 1 0 7.744" /><path d="M22 21v-2a4 4 0 0 0-3-3.87"

                                    /><circle cx="9" cy="7" r="4" /></svg>

                                12k+ bookings/month
                            </span>
                            <a href="#features" className="ml-auto inline-flex items-center gap-2 text-[#613dc1] hover:text-[#4e148c] transition-colors focus-ring" style={{ cursor: "default" }}>
                                Learn more

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-arrow-right-icon lucide-arrow-right text-purple-600"><path d="M5 12h14"
                                /><path d="m12 5 7 7-7 7" /></svg>
                            </a>
                            <a href="#booking" className="inline-flex items-center gap-2 text-[#858ae3] hover:text-[#613dc1] transition-colors focus-ring" style={{ cursor: "default" }}>
                                Watch demo
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-circle-play-icon lucide-circle-play text-purple-600"><path d="M9 9.003a1 1 0 0 1 1.517-.859l4.997 2.997a1 1 0 0 1 0 1.718l-4.997 2.997A1 1 0 0 1 9 14.996z"
                                /><circle cx="12" cy="12" r="10" /></svg>
                            </a>
                        </div>
                    </div>
                    <div className="mt-10 grid md:grid-cols-2 gap-8 items-center">


                        <img src={introImageURL} className="w-full h-64 sm:h-72 md:h-80 object-cover rounded-2xl ring-1 ring-[#4e148c]/20 shadow-card" alt="Booking dashboard illustration on devices" />


                        <div className="space-y-4">
                            <div className="flex items-center gap-3">
                                {/* <ShieldCheck
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600"
                                /> */}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-shield-check-icon lucide-shield-check text-purple-600"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
                                /><path d="m9 12 2 2 4-4" /></svg>
                                <RichText.Content
                                    tagName="p"
                                    value={introFeature1}
                                    className="text-[#2c0735]/80"
                                />
                            </div>
                            <div className="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-smartphone-icon lucide-smartphone text-purple-600"><rect width="14" height="20" x="5" y="2" rx="2" ry="2" /><path d="M12 18h.01"
                                /></svg>
                                <RichText.Content
                                    tagName="p"
                                    value={introFeature2}
                                    className="text-[#2c0735]/80"
                                />
                            </div>
                            <div className="flex items-center gap-3">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-globe-icon lucide-globe text-purple-600"><circle cx="12" cy="12" r="10" /><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"
                                /><path d="M2 12h20" /></svg>
                                <RichText.Content
                                    tagName="p"
                                    value={introFeature3}

                                    className="text-[#2c0735]/80"
                                />

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    )





}

