import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, ColorPicker } from "@wordpress/components";
import { useState, useEffect } from "@wordpress/element";

import apiFetch from "@wordpress/api-fetch";

export default function Edit({ attributes, setAttributes }) {
    const [testimonials, setTestimonials] = useState();

    const { themeColor } = attributes;

    const blockProps = useBlockProps();
    useEffect(() => {
        apiFetch({ path: "/timora/testimonials" }).then((data) => setTestimonials(data));
    }, []);

    return (
        <>
            <InspectorControls>
                <PanelBody title="Pick Color" initialOpen={true}>
                    <ColorPicker
                        color={themeColor}
                        onChange={(newValue) => setAttributes({ themeColor: newValue })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                {!testimonials && <p>Loading Testimonials...</p>}

                {testimonials && (
                    <div className="flex flex-row space-x-2 w-full">
                        {testimonials.map((testimonial) => (
                            <div key={testimonial.id} className="p-4 rounded-lg text-center text-white justify-center items-center"
                                style={{
                                    "backgroundColor": themeColor
                                }}
                            >
                                {testimonial.title}
                                <img className="mt-4 rounded-lg" src={testimonial.image} />

                            </div>

                        )
                        )}
                    </div>
                )}

            </div>
        </>

    );

}