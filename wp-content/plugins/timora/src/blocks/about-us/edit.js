import { useBlockProps, RichText, InspectorControls, MediaUploadCheck, MediaUpload } from "@wordpress/block-editor";
import { Button } from "@wordpress/components"
import { __ } from "@wordpress/i18n"
import { ArrowRight, CirclePlay, Star, Users, ShieldCheck, Smartphone, Globe } from "lucide-react";

export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps();
    const { introTitle, introDescription, introImageURL, introFeature1, introFeature2, introFeature3 } = attributes;

    return (
        <div {...blockProps}>
            <section id="about" className="py-20 bg-white">
                <div className="max-w-7xl mx-auto px-6">
                    <div className="max-w-4xl">
                        <RichText
                            tagName="h2"
                            value={introTitle}
                            onChange={(newValue) => setAttributes({ introTitle: newValue })}
                            placeholder={__('Intro Title')}
                            className="font-display text-3xl sm:text-4xl font-extrabold text-[#4e148c]"
                        />
                        <RichText
                            tagName="p"
                            value={introDescription}
                            onChange={(newValue) => setAttributes({ introDescription: newValue })}
                            placeholder={__('Intro Title')}
                            className="mt-5 text-[#2c0735]/80"
                        />

                        <div className="mt-6 flex flex-wrap items-center gap-4">
                            <span className="inline-flex items-center gap-2 rounded-full bg-[#97dffc]/50 text-[#2c0735] px-3 py-1 text-sm ring-1 ring-[#97dffc]">
                                <Star
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600" /> 4.9 avg rating
                            </span>
                            <span className="inline-flex items-center gap-2 rounded-full bg-[#97dffc]/30 text-[#2c0735] px-3 py-1 text-sm ring-1 ring-[#97dffc]/60">
                                <Users
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600" /> 12k+ bookings/month
                            </span>
                            <a href="#features" className="ml-auto inline-flex items-center gap-2 text-[#613dc1] hover:text-[#4e148c] transition-colors focus-ring" style={{ cursor: "default" }}>
                                Learn more <ArrowRight
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600"
                                />
                            </a>
                            <a href="#booking" className="inline-flex items-center gap-2 text-[#858ae3] hover:text-[#613dc1] transition-colors focus-ring" style={{ cursor: "default" }}>
                                Watch demo <CirclePlay
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600" />
                            </a>
                        </div>
                    </div>
                    <div className="mt-10">
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) =>
                                    setAttributes({ introImageURL: media.url })
                                }

                                allowedTypes={["image"]}
                                value={introImageURL}
                                render={({ open }) => (
                                    <Button onClick={open}
                                        variant="primary"
                                    >{introImageURL === "https://placehold.co/600x400" ? "Add Intro Image" : "Upload Intro Image"}</Button>
                                )}

                            />
                        </MediaUploadCheck>
                    </div>
                    <div className="mt-10 grid md:grid-cols-2 gap-8 items-center">

                        {introImageURL &&
                            <img src={introImageURL} className="w-full h-64 sm:h-72 md:h-80 object-cover rounded-2xl ring-1 ring-[#4e148c]/20 shadow-card" alt="Booking dashboard illustration on devices" />
                        }

                        <div className="space-y-4">
                            <div className="flex items-center gap-3">
                                <ShieldCheck
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600"
                                />
                                <RichText
                                    tagName="p"
                                    value={introFeature1}
                                    onChange={(newValue) => setAttributes({ introFeature1: newValue })}
                                    placeholder={__('Intro Feature 1')}
                                    className="text-[#2c0735]/80"
                                />
                            </div>
                            <div className="flex items-center gap-3">
                                <Smartphone
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600"
                                />
                                <RichText
                                    tagName="p"
                                    value={introFeature2}
                                    onChange={(newValue) => setAttributes({ introFeature2: newValue })}
                                    placeholder={__('Intro Feature 2')}
                                    className="text-[#2c0735]/80"
                                />
                            </div>
                            <div className="flex items-center gap-3">
                                <Globe
                                    size={24}
                                    strokeWidth={2}
                                    className="text-purple-600" />
                                <RichText
                                    tagName="p"
                                    value={introFeature3}
                                    onChange={(newValue) => setAttributes({ introFeature3: newValue })}
                                    placeholder={__('Intro Feature 3')}
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