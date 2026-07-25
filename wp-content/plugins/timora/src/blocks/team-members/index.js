import { registerBlockType } from "@wordpress/blocks";
import metadata from "./block.json";
import Edit from "./edit.js";
import Save from "./save.js";

registerBlockType(metadata.name, {
    ...metadata,

    edit: Edit,
    save: Save
})