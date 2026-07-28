import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { Panel, PanelBody, PanelRow, ColorPicker, ColorPalette } from "@wordpress/components";
export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps();

    return <div {...blockProps}>
        <>

            <div className="container m-auto" >
                <div className="p-10 border-2 border-dashed rounded-2xl bg-slate-700 text-white text-6xl text-center font-extrabold uppercase"
                >Providers Dynamic Blok</div>
            </div >
        </>



    </div >


}