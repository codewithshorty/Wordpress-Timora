import { useBlockProps, RichText, MediaUploadCheck, MediaUpload, InspectorControls } from "@wordpress/block-editor";
import { Button, Panel, PanelBody, PanelRow, TextControl, ColorPicker, ColorPalette } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import metadata from "./block.json";
import "./index.css";
export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps({
        className: "w-full"
    });

    const { headingText, headingSpan, headingDescription, heroVideoUrl, firstButtonUrl, secondButtonUrl, firstButtonText, secondButtonText, colorTheme, textColor, heroColor1, heroColor2, heroColor3 } = attributes;

    return (
        <>
            <InspectorControls placeholder={__("Settings", metadata.textdomain)}>

                <Panel header="Hero Banner Settings">
                    <PanelBody title="Text Color" initialOpen={true}>
                        <ColorPalette
                            colors={
                                [
                                    { name: 'white', color: '#fff' },
                                    { name: 'black', color: '#000' },
                                ]}
                            value={textColor}
                            onChange={(newValue) => setAttributes({ textColor: newValue })}
                        />
                    </PanelBody>
                    <PanelBody title="Primary Button Text" initialOpen={true}>
                        <PanelRow>
                            <TextControl
                                __next40pxDefaultSize
                                value={firstButtonText}
                                onChange={(newFirstButtonText) => setAttributes({ firstButtonText: newFirstButtonText })}
                            />
                        </PanelRow>
                    </PanelBody>
                    <PanelBody title="Primary Button URL" initialOpen={true}>
                        <PanelRow><TextControl
                            __next40pxDefaultSize
                            value={firstButtonUrl}
                            onChange={(newFirstButtonUrl) => setAttributes({ firstButtonUrl: newFirstButtonUrl })}
                        /></PanelRow>
                    </PanelBody>
                    <PanelBody title="Secondary Button Text" initialOpen={true}>
                        <PanelRow><TextControl
                            __next40pxDefaultSize
                            value={secondButtonText}
                            onChange={(newSecondButtonText) => setAttributes({ secondButtonText: newSecondButtonText })}
                        /></PanelRow>
                    </PanelBody>
                    <PanelBody title="Secondary Button URL" initialOpen={true}>
                        <PanelRow><TextControl
                            __next40pxDefaultSize
                            value={secondButtonUrl}
                            onChange={(newSecondButtonUrl) => setAttributes({ secondButtonUrl: newSecondButtonUrl })}
                        /></PanelRow>
                    </PanelBody>
                    <PanelBody title="Theme Colors" initialOpen={true}>
                        <ColorPicker
                            color={colorTheme}
                            onChange={(newColorTheme) => setAttributes({ colorTheme: newColorTheme })}
                            enableAlpha
                            defaultValue="#000"
                        />
                    </PanelBody>

                    <PanelBody title="Hero Gradient Color 1" initialOpen={true}>
                        <ColorPicker
                            color={heroColor1}
                            onChange={(newValue) => setAttributes({ heroColor1: newValue })}
                        />
                    </PanelBody>
                    <PanelBody title="Hero Gradient Color 2" initialOpen={true}>
                        <ColorPicker
                            color={heroColor2}
                            onChange={(newValue) => setAttributes({ heroColor2: newValue })}
                        />
                    </PanelBody>
                    <PanelBody title="Hero Gradient Color 3" initialOpen={true}>
                        <ColorPicker
                            color={heroColor3}
                            onChange={(newValue) => setAttributes({ heroColor3: newValue })}
                        />
                    </PanelBody>

                </Panel>
            </InspectorControls>
            <div {...blockProps} >
                <div className="mb-5">
                    <MediaUploadCheck>
                        <MediaUpload
                            render={({ open }) => (<Button onClick={open} variant="primary">Select Video or image</Button>)}
                            onSelect={(media) => setAttributes({ heroVideoUrl: media.url })}
                            allowedTypes={["video", "image"]}
                        />

                    </MediaUploadCheck>
                </div>
                {/* Hero Banner  */}
                <section id="hero" className="hero-gradient relative overflow-hidden h-screen"
                    style={{
                        "--hero-gradient-color1": heroColor1,
                        "--hero-gradient-color2": heroColor2,
                        "--hero-gradient-color3": heroColor3,
                        "color": textColor
                    }}
                >
                    <div className="absolute inset-0 opacity-20 pointer-events-none">
                        <div className="absolute -top-24 -right-24 w-[36rem] h-[36rem] rounded-full bg-[#97dffc] blur-3xl"></div>
                        <div className="absolute bottom-[-6rem] left-[-6rem] w-[28rem] h-[28rem] rounded-full bg-[#858ae3] blur-3xl opacity-70"></div>
                    </div>
                    <div className="relative max-w-7xl mx-auto">
                        <div className="grid lg:grid-cols-2 items-center justify-center gap-12">
                            <div>
                                <div className="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 ring-1 mb-6" style={{
                                    "boxShadow": `0 0 0 1px ${textColor}`
                                }}>
                                    <i className="bi bi-stars text-[#97dffc]"></i>
                                    <span className="text-sm">Beauty • Healthcare • Education • Consulting</span>
                                </div>

                                <RichText
                                    tagName="h1"
                                    className="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight"
                                    placeholder={__("Heading text", metadata.textdomain)}
                                    value={headingText}
                                    onChange={(newHeadingText) => setAttributes({ headingText: newHeadingText })} />

                                <RichText
                                    tagName="p"
                                    className="mt-5 text-lg/7 max-w-xl"
                                    placeholder={__("Heading description", metadata.textdomain)}
                                    value={headingDescription}
                                    onChange={(newHeadingDescription) => setAttributes({ headingDescription: newHeadingDescription })} />

                                <div className="mt-8 flex flex-col sm:flex-row gap-3">
                                    <a className="inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 font-medium duration-700 transition-all hover:scale-110"
                                        style={{
                                            "cursor": "pointer",
                                            "backgroundColor": heroColor1,
                                            "color": heroColor2,
                                            "boxShadow": `0 0 0 1px ${textColor}`
                                        }}
                                        href={firstButtonUrl}>
                                        <i className="bi bi-calendar-plus"></i>
                                        {firstButtonText}
                                    </a>
                                    <a className="inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 duration-500 transition-all hover:scale-110" style={{
                                        "cursor": "pointer",
                                        "backgroundColor": heroColor3,
                                        "color": heroColor2,
                                        "boxShadow": `0 0 0 1px ${textColor}`
                                    }}
                                        href={secondButtonUrl}>
                                        <i className="bi bi-briefcase"></i>
                                        {secondButtonText}
                                    </a>
                                </div>
                            </div>
                            {/* Hero collage  */}
                            <div className="relative w-full h-screen flex justify-center items-center">
                                <video
                                    className="w-full h-auto object-cover rounded-2xl"
                                    src={heroVideoUrl}
                                    poster="https://placehold.co/1920x1080"
                                    loop
                                    autoPlay
                                    muted
                                    playsInline
                                />
                            </div>

                        </div>
                    </div>


                </section>

            </div>
        </>


    );
}