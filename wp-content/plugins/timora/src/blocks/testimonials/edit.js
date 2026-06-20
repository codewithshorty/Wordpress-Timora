import { useBlockProps } from "@wordpress/block-editor"
import { useState, useEffect } from "@wordpress/element";

import apiFetch from "@wordpress/api-fetch";

export default function Edit() {
    const [testimonials, setTestimonials] = useState();
    const blockProps =
        useEffect(() => {
            apiFetch({ path: "/timora/testimonials" }).then((data) => setTestimonials(data));
        }, []);
    if (!testimonials) {
        return <p>Loading Testimonials...</p>
    }
    console.log(testimonials);

    return (
        <div {...blockProps}>
            <div className="flex flex-row space-x-2 w-full">
                {testimonials.map((testimonial) => (
                    <div key={testimonial.id} className="p-4 rounded-lg text-center text-white bg-blue-700 justify-center items-center">
                        {testimonial.title}
                        <img className="mt-4 rounded-lg" src={testimonial.image} />

                    </div>

                )
                )}
            </div>
        </div>
    );

}