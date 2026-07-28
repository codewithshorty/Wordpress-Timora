import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from "@wordpress/block-editor";
import { Button, PanelBody, Panel, TextControl, ColorPicker, ColorPalette } from "@wordpress/components";

export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps();

    return (

        <div {...blockProps}
        >
            <div className="container m-auto" >
                <div className="p-10 border-2 border-dashed rounded-2xl bg-[#613DC1] text-white text-6xl text-center font-extrabold uppercase"
                >Providers registration blok</div>
            </div >
        </div >
    )


}