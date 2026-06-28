import { useBlockProps, RichText } from "@wordpress/block-editor";

export default function save({ attributes }) {

    const {
        headingText, headingSpan, headingDescription, heroVideoUrl, firstButtonUrl, secondButtonUrl, firstButtonText, secondButtonText, colorTheme, button1TextColor
    } = attributes;

    const blockProps = useBlockProps.save();

    return (
        <section
            id="hero-banner"
            {...blockProps}
        >
            <div className="relative w-full h-full">

                {heroVideoUrl && (
                    <video
                        src={heroVideoUrl}
                        poster="https://placehold.co/1920x1080"
                        loop
                        autoPlay
                        muted
                        playsInline
                    />
                )}

                <div
                    className="absolute custom-overlay w-full h-full bg-black/50 top-0 left-0 z-10"
                ></div>

                <div className="absolute w-full h-full top-0 left-0 z-20 text-black">
                    <div className="container h-full mx-auto flex flex-col justify-center space-y-20 items-start">

                        <h1 className="text-white text-7xl">

                            <RichText.Content
                                tagName="span"
                                value={headingText}
                            />

                            <br />

                            <span className="text-gray-100 font-bold">

                                <RichText.Content
                                    tagName="span"
                                    value={headingSpan}
                                />

                            </span>

                        </h1>

                        <div className="w-1/2 text-2xl text-white">

                            <RichText.Content
                                tagName="p"
                                value={headingDescription}
                            />

                        </div>

                        <div className="flex space-x-3">

                            <a
                                className="group px-20 py-5 rounded-2xl text-xl uppercase font-bold hover:bg-black hover:text-white duration-100 hover:translate-y-2 hover:drop-shadow-lg hover:drop-shadow-black"
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
                                            d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5"
                                        />
                                    </svg>
                                </div>
                            </a>

                            <a
                                className="group px-20 py-5 border-2 border-black text-white rounded-2xl text-xl font-bold uppercase hover:text-white hover:border-transparent duration-300 transform-all hover:bg-black hover:translate-y-2 hover:drop-shadow-xl hover:drop-shadow-black"
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
                                            d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0"
                                        />
                                    </svg>

                                </div>
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </section>
    );
}