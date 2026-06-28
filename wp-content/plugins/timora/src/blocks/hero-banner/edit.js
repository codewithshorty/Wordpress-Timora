import { useBlockProps, RichText, MediaUploadCheck, MediaUpload, InspectorControls } from "@wordpress/block-editor";
import { Button, Panel, PanelBody, PanelRow, TextControl, ColorPicker, ColorPalette } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import metadata from "./block.json";
import "./index.css";
export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps({
        className: "w-full"
    });

    const { headingText, headingSpan, headingDescription, heroVideoUrl, firstButtonUrl, secondButtonUrl, firstButtonText, secondButtonText, colorTheme, button1TextColor } = attributes;

    return (
        <>
            <InspectorControls placeholder={__("Settings", metadata.textdomain)}>
                <Panel header="Hero Banner Settings">
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

                    <PanelBody title="Button Text Color" initialOpen={true}>
                        <ColorPalette
                            colors={
                                [
                                    { name: 'white', color: '#fff' },
                                    { name: 'black', color: '#000' },
                                ]}
                            value={button1TextColor}
                            onChange={(newButton1TextColor) => setAttributes({ button1TextColor: newButton1TextColor })}
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
                <section id="hero-banner"  >
                    <div className="relative w-full h-screen">                    <video
                        className="w-full h-screen object-cover"
                        src={heroVideoUrl}
                        poster="https://placehold.co/1920x1080"
                        loop
                        autoPlay
                        muted
                        playsInline
                    />
                        <div
                            className="absolute custom-overlay w-full h-full bg-black/50 top-0 left-0 z-10"
                        ></div>
                        <div className="absolute w-full h-full top-0 left-0 z-20 text-black">
                            <div
                                className="container h-full mx-auto flex flex-col justify-center space-y-20 items-start"
                            >
                                <RichText
                                    tagName="h1"
                                    className="text-white text-7xl"
                                    placeholder={__("Heading text", metadata.textdomain)}
                                    value={headingText}
                                    onChange={(newHeadingText) => setAttributes({ headingText: newHeadingText })} />
                                <br />
                                <span className="text-gray-100 font-bold"
                                >
                                    <RichText
                                        tagName="span"
                                        placeholder={__("Span heading text", metadata.textdomain)}
                                        value={headingSpan}
                                        onChange={(newHeadingSpan) => setAttributes({ headingSpan: newHeadingSpan })} />
                                </span
                                >
                                <RichText
                                    tagName="p"
                                    className="w-1/2 text-2xl text-white"
                                    placeholder={__("Heading description", metadata.textdomain)}
                                    value={headingDescription}
                                    onChange={(newHeadingDescription) => setAttributes({ headingDescription: newHeadingDescription })} />
                                <div className="flex space-x-3">
                                    <a
                                        className="hero-button-1 group px-20 py-5 rounded-2xl text-xl uppercase font-bold duration-100 hover:translate-y-2 hover:drop-shadow-lg hover:drop-shadow-black"
                                        href={firstButtonUrl}
                                        style={{
                                            backgroundColor: colorTheme,
                                            color: button1TextColor

                                        }}
                                    >
                                        <div className="flex items-center space-x-4">
                                            <p className="inline-block">{firstButtonText}</p>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                strokeWidth="1.5"
                                                stroke="currentColor"
                                                className="size-6 group-hover:animate-ping"
                                            >
                                                <path
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                    d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z"
                                                />
                                            </svg>
                                        </div>
                                    </a>
                                    <a
                                        className="group px-20 py-5 border-2 border-black bg-black/50 text-white rounded-2xl text-xl font-bold uppercase hover:text-white hover:border-transparent duration-300 transform-all hover:bg-black hover:translate-y-2 hover:drop-shadow-xl hover:drop-shadow-black"
                                        href={secondButtonUrl}
                                        style={
                                            {
                                                backgroundColor: `${colorTheme}80`,
                                                color: button1TextColor
                                            }
                                        }

                                    >
                                        <div className="flex items-center justify-between space-x-4">
                                            <p>{secondButtonText}</p>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                strokeWidth="1.5"
                                                stroke="currentColor"
                                                className="size-6 group-hover:animate-ping"
                                            >
                                                <path
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                    d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                />
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </>


    );
}