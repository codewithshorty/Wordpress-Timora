import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { Panel, PanelBody, PanelRow, ColorPicker, ColorPalette } from "@wordpress/components";
export default function Edit({ attributes, setAttributes }) {

    const { formBgColor, formTxtColor } = attributes;
    const blockProps = useBlockProps();

    return <div {...blockProps}>
        <>
            <InspectorControls>
                <Panel header="Form Settings">
                    <PanelBody title="Form Background Color" initialOpen={true}>
                        <ColorPicker
                            color={formBgColor}
                            onChange={(newValue) => setAttributes({ formBgColor: newValue })}
                            enableAlpha
                        />
                    </PanelBody>
                    <PanelBody title="Form Text Color" initialOpen={true}>
                        <ColorPalette
                            colors={
                                [
                                    { name: 'black', color: '#000000' },
                                    { name: 'white', color: '#FFFFFF' },
                                ]
                            }
                            value={formTxtColor}
                            onChange={(newVal) => setAttributes({ formTxtColor: newVal })}
                        />
                    </PanelBody>
                </Panel>
            </InspectorControls>
            <div className="container m-auto" >
                <div className="p-10 border-2 border-dashed rounded-2xl bg-slate-700 text-white text-6xl text-center font-extrabold uppercase"
                    style={{
                        "backgroundColor": formBgColor,
                        "color": formTxtColor
                    }}>Booking form block</div>
            </div >
        </>



    </div >


}