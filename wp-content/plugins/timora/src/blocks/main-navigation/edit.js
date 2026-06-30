import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from "@wordpress/block-editor";
import { Button, PanelBody, Panel, TextControl, ColorPicker, ColorPalette } from "@wordpress/components";

export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps();
    const { menuItems, logo, sideButtonText, sideButtonURL, themeColor, menuTextColor } = attributes;

    const addMenuItem = () => {
        const newItems = [...menuItems, { "name": "new page", "url": "#" }];
        setAttributes({ menuItems: newItems })
    }

    const updateMenuItem = (index, field, newValue) => {
        const newItems = [...menuItems];
        newItems[index][field] = newValue;
        setAttributes({ menuItems: newItems });
    }

    const removeMenuItem = (index) => {
        const filteredItems = menuItems.filter((_, i) => i !== index);
        setAttributes({ menuItems: filteredItems });
    }

    return (
        <>
            <InspectorControls>
                <Panel header="Navigational Menu Item Settings">
                    {menuItems.map((item, index) => (
                        <>
                            <PanelBody
                                title="Menu Item Text"
                                initialOpen={true}
                                title={`Menu Item NO: ${index + 1}`}
                            >
                                <TextControl
                                    __next40pxDefaultSize
                                    label="Text"
                                    value={item.name}
                                    onChange={(newValue) => updateMenuItem(index, "name", newValue)}
                                />
                                <TextControl
                                    __next40pxDefaultSize
                                    label="URL"
                                    value={item.url}
                                    onChange={(newValue) => updateMenuItem(index, "url", newValue)}
                                />
                                <Button
                                    isDestructive
                                    variant="secondary"
                                    onClick={() => removeMenuItem(index)}
                                >
                                    Remove Menu Item
                                </Button>
                            </PanelBody>

                        </>
                    ))}
                    <PanelBody
                        title="CTA Button Navigation"
                        initialOpen={true}>
                        <TextControl
                            __next40pxDefaultSize
                            label="Text"
                            value={sideButtonText}
                            onChange={(newValue) => setAttributes({ sideButtonText: newValue })}
                        />
                        <TextControl
                            __next40pxDefaultSize
                            label="URL"
                            value={sideButtonURL}
                            onChange={(newValue) => setAttributes({ sideButtonURL: newValue })}
                        />
                    </PanelBody>
                    <PanelBody title="Theme Color">
                        <ColorPicker
                            color={themeColor}
                            onChange={(newValue) => setAttributes({ themeColor: newValue })}
                            enableAlpha
                            defaultValue="#000"
                        />

                    </PanelBody>
                    <PanelBody title="Text Color">
                        <ColorPalette
                            colors={[
                                { name: 'black', color: '#000' },
                                { name: 'white', color: '#fff' },
                            ]}
                            value={menuTextColor}
                            onChange={(newValue) => setAttributes({ menuTextColor: newValue })}
                        />
                    </PanelBody>


                </Panel>
            </InspectorControls>
            <div {...blockProps}
            >
                <div className="mx-auto">
                    <div className="flex flex-wrap space-x-1 items-center justify-between gap-1 mt-3 border-2 border-dashed border-gray-800">
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) =>
                                    setAttributes({ logo: media.url })
                                }
                                allowedTypes={["image"]}
                                value={logo}
                                render={({ open }) => (
                                    <Button
                                        onClick={open}
                                        variant="secondary"
                                        size="small"
                                    >
                                        {logo !== "" ? "Update Logo Image" : "Add Image Logo"}

                                    </Button>
                                )}
                            />
                        </MediaUploadCheck>
                        <div className="w-24 h-12">
                            <img src={logo} alt="" />
                        </div>
                        {menuItems.map((item, index) => (
                            <div className="px-2 py-1 bg-black text-white" key={index} >
                                <span>{index + 1}</span>   <a href={item.url}> {item.name}</a>
                            </div>
                        ))}
                        <a href={sideButtonURL}
                            className="px-6 py-3 rounded-2xl hover:underline-offset-4 text-decoration-none"
                            style={{
                                background: themeColor,
                                color: menuTextColor
                            }}
                        >{sideButtonText}</a>
                    </div>
                </div>
                <Button
                    variant="primary"
                    onClick={addMenuItem}
                >
                    Add new Menu item
                </Button>
            </div >
        </>

    )


}