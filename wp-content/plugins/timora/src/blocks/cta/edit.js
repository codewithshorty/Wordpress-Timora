import { useBlockProps, RichText, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components"


export default function Edit({ attributes, setAttributes }) {
    const { ctaTitle, ctaDesc, ctaBtn1Text, ctaBtn1URL, ctaBtn2Text, ctaBtn2URL } = attributes;

    const blockProps = useBlockProps();


    return (
        <>
            <InspectorControls title="Call To Action Settings">
                <PanelBody title="Call To Action 1" initialOpen={true}>
                    <TextControl
                        label="Button Text"
                        value={ctaBtn1Text}
                        onChange={(newValue) => setAttributes({ ctaBtn1Text: newValue })}
                    />

                    <TextControl
                        label="Button URL"
                        value={ctaBtn1URL}
                        onChange={(newValue) => setAttributes({ ctaBtn1URL: newValue })}
                    />
                </PanelBody>

                <PanelBody title="Call To Action 2" initialOpen={true}>
                    <TextControl
                        label="Button Text"
                        value={ctaBtn2Text}
                        onChange={(newValue) => setAttributes({ ctaBtn2Text: newValue })}
                    />

                    <TextControl
                        label="Button URL"
                        value={ctaBtn2URL}
                        onChange={(newValue) => setAttributes({ ctaBtn2URL: newValue })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <section id="cta" className="py-16 pattern-soft">
                    <div className="max-w-7xl mx-auto px-6">
                        <div className="max-w-3xl mx-auto bg-white rounded-2xl p-8 md:p-10 ring-1 ring-[#4e148c]/15 shadow-card text-center">

                            <RichText
                                tagName="h3"
                                className="font-display text-2xl md:text-3xl font-extrabold text-[#4e148c]"
                                value={ctaTitle}
                                onChange={(newValue) => setAttributes({ ctaTitle: newValue })}
                            />

                            <RichText
                                tagName="p"
                                className="mt-3 text-[#2c0735]/80"
                                value={ctaDesc}
                                onChange={(newValue) => setAttributes({ ctaDesc: newValue })}
                            />
                            <div className="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                                <a href={ctaBtn1URL} className="inline-flex items-center gap-2 rounded-xl bg-[#613dc1] px-5 py-3 text-white hover:bg-[#4e148c] transition-colors shadow-soft focus-ring" style={{ cursor: "default" }}>
                                    <i className="bi bi-calendar-check"></i>
                                    {ctaBtn1Text}
                                </a>
                                <a href={ctaBtn2URL} className="inline-flex items-center gap-2 rounded-xl bg-[#858ae3] px-5 py-3 text-white hover:bg-[#613dc1] transition-colors shadow-soft focus-ring" style={{ cursor: "default" }}>
                                    <i className="bi bi-briefcase"></i>
                                    {ctaBtn2Text}
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </>


    )





}