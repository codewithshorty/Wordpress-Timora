import { useBlockProps, RichText } from "@wordpress/block-editor";

export default function Save({ attributes }) {

    const { services, servicesSpan, servicesTitle, themeColor, textColor } = attributes;


    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps}>
            <section id="services">
                <div className="container mx-auto py-10 text-black">
                    <div className="flex flex-col space-y-28 justify-center items-center">

                        <h2 className="text-6xl text-center font-extrabold uppercase mb-8"
                            style={{
                                color: themeColor
                            }}
                        >
                            <RichText.Content
                                tagName="span"
                                value={servicesTitle}

                            />
                            <br />
                            <span className="italic font-bold">
                                <RichText.Content
                                    tagName="span"
                                    value={servicesSpan}
                                />
                            </span>
                        </h2>

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

                                        <RichText.Content
                                            tagName="h3"
                                            className="text-5xl font-bold"
                                            value={service.name}
                                        />
                                    </div>

                                    <div className="flex justify-end w-[50%]">
                                        <RichText.Content
                                            tagName="p"
                                            className="text-lg font-semibold"
                                            value={service.desc}
                                        />
                                    </div>
                                </div>

                                <div className="flex items-center justify-between p-8 w-[35%]">

                                    {service.imageSrc && (
                                        <img
                                            src={service.imageSrc}
                                            alt={service.name}
                                            className="rounded-2xl scale-50 transition-transform duration-500 group-hover:rotate-8 group-hover:scale-100 "
                                        />

                                    )}

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
                                            className="size-8 transition-transform duration-500 group-hover:rotate-2"
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

                    </div>
                </div>
            </section>
        </div>
    );
}