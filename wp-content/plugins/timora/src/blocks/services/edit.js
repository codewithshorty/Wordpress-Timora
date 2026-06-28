import { useBlockProps, MediaUploadCheck, MediaUpload, RichText, InspectorControls } from "@wordpress/block-editor";
import { Button, TextControl, TextareaControl, Panel, PanelBody, ColorPicker, ColorPalette } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import metadata from "./block.json";

export default function Edit({ attributes, setAttributes }) {

    const { services, servicesSpan, servicesTitle, themeColor, textColor } = attributes;
    const blockProps = useBlockProps();

    const addService = () => {
        const newServices = [...services, { "name": "", "desc": "" }];
        setAttributes({ services: newServices });
    }

    const updateService = (index, field, newValue) => {

        const newServices = [...services];
        newServices[index][field] = newValue;
        setAttributes({ services: newServices });
    }

    const deleteService = (indexSearch) => {
        const newServices = services.filter((_, index) => index !== indexSearch);
        setAttributes({ services: newServices });
    }

    return (
        <>
            <InspectorControls>
                <PanelBody title="Theme Colors" initialOpen={true}>
                    <ColorPicker
                        color={themeColor}
                        onChange={(newThemeColor) => setAttributes({ themeColor: newThemeColor })}
                    />
                </PanelBody>

                <PanelBody title="Text Color" initialOpen={true}>
                    <ColorPalette
                        colors={
                            [
                                { name: 'white', color: '#fff' },
                                { name: 'black', color: '#000' },
                            ]}
                        value={textColor}
                        onChange={(newTextColor) => setAttributes({ textColor: newTextColor })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <section id="services">
                    <div className="flex flex-col space-y-28 justify-center items-center">

                        <h2 className="text-6xl text-center font-extrabold uppercase mb-8">

                            <RichText
                                tagName="span"
                                value={servicesTitle}
                                onChange={(newServicesTitle) =>
                                    setAttributes({
                                        servicesTitle: newServicesTitle
                                    })
                                }
                                placeholder={__("Services Title", metadata.name)}
                            />

                            <br />

                            <span className="italic font-bold">
                                <RichText
                                    tagName="span"
                                    value={servicesSpan}
                                    onChange={(newServicesSpan) =>
                                        setAttributes({
                                            servicesSpan: newServicesSpan
                                        })
                                    }
                                    placeholder={__("Services Span", metadata.name)}
                                />
                            </span>

                        </h2>

                    </div>


                    {services.map((service, index) => (
                        <div
                            key={index}
                            className="group service flex items-center border-b-2 rounded-2xl text-black bg-white transition-all duration-500 w-full h-72"
                            style={{
                                "--hover-bg-color": themeColor,
                                "--hover-text-color": textColor
                            }}
                        >
                            <div className="flex justify-between p-8 w-[65%]">

                                <div className="flex justify-start space-x-4 w-[50%]">
                                    <p className="text-5xl font-light">
                                        {String(index + 1).padStart(2, "0")}
                                    </p>

                                    <RichText
                                        tagName="h3"
                                        className="text-5xl font-bold"
                                        value={service.name}
                                        onChange={(newServiceName) =>
                                            updateService(index, "name", newServiceName)
                                        }
                                        placeholder={__("Service name", metadata.name)}
                                    />
                                </div>

                                <div className="flex justify-end w-[50%]">
                                    <RichText
                                        tagName="p"
                                        className="text-lg font-semibold"
                                        value={service.desc}
                                        onChange={(newServiceDesc) =>
                                            updateService(index, "desc", newServiceDesc)
                                        }
                                        placeholder={__("Service description", metadata.name)}
                                    />
                                </div>

                            </div>

                            <div className="flex items-center justify-between p-8 w-[35%]">

                                <div className="flex flex-col gap-4">

                                    <MediaUploadCheck>
                                        <MediaUpload
                                            onSelect={(media) =>
                                                updateService(index, "imageSrc", media.url)
                                            }
                                            allowedTypes={["image"]}
                                            render={({ open }) => (
                                                <Button
                                                    variant="primary"
                                                    onClick={open}
                                                >
                                                    {service.imageSrc
                                                        ? "Update Image"
                                                        : "Add Image"}
                                                </Button>
                                            )}
                                        />
                                    </MediaUploadCheck>

                                    {service.imageSrc && (
                                        <img
                                            src={service.imageSrc}
                                            alt={service.name}
                                            className="rounded-2xl scale-50 transition-transform duration-500 group-hover:rotate-8 group-hover:scale-100"
                                        />
                                    )}

                                    <Button
                                        isDestructive
                                        variant="secondary"
                                        onClick={() => deleteService(index)}
                                    >
                                        Remove Service
                                    </Button>

                                </div>

                                <button
                                    type="button"
                                    className="circleButton rounded-full p-4 border-2 font-extrabold text-black transition-all duration-500 cursor-pointer"
                                    style={{
                                        backgroundColor: themeColor,
                                        color: textColor,
                                    }}
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        strokeWidth="1.5"
                                        stroke="currentColor"
                                        className="size-8"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18"
                                        />
                                    </svg>
                                </button>

                            </div>
                        </div>
                    ))}
                    <br />
                    <Button variant="secondary" onClick={addService} >
                        Add New Service
                    </Button>

                </section>
            </div>
        </>



    );
}