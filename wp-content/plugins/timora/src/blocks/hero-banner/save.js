import { useBlockProps, RichText } from "@wordpress/block-editor";

export default function save({ attributes }) {

    const blockProps = useBlockProps.save({
        className: "w-full",
    });

    const {
        headingText,
        headingDescription,
        heroVideoUrl,
        firstButtonUrl,
        secondButtonUrl,
        firstButtonText,
        secondButtonText,
        textColor,
        heroColor1,
        heroColor2,
        heroColor3,
    } = attributes;

    return (
        <div {...blockProps}>

            <section
                id="hero"
                className="hero-gradient relative overflow-hidden h-screen"
                style={{
                    "--hero-gradient-color1": heroColor1,
                    "--hero-gradient-color2": heroColor2,
                    "--hero-gradient-color3": heroColor3,
                    color: textColor,
                }}
            >
                <div className="absolute inset-0 opacity-20 pointer-events-none">
                    <div className="absolute -top-24 -right-24 w-[36rem] h-[36rem] rounded-full bg-[#97dffc] blur-3xl"></div>

                    <div className="absolute bottom-[-6rem] left-[-6rem] w-[28rem] h-[28rem] rounded-full bg-[#858ae3] blur-3xl opacity-70"></div>
                </div>

                <div className="relative max-w-7xl mx-auto">

                    <div className="grid lg:grid-cols-2 items-center justify-center  gap-12">

                        <div>

                            <div
                                className="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 ring-1 mb-6"
                                style={{
                                    boxShadow: `0 0 0 1px ${textColor}`,
                                }}
                            >
                                <i className="bi bi-stars text-[#97dffc]"></i>

                                <span className="text-sm">
                                    Beauty • Healthcare • Education • Consulting
                                </span>
                            </div>

                            <RichText.Content
                                tagName="h1"
                                className="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight"
                                value={headingText}
                            />

                            <RichText.Content
                                tagName="p"
                                className="mt-5 text-lg/7 max-w-xl"
                                value={headingDescription}
                            />

                            <div className="mt-8 flex flex-col sm:flex-row gap-3">

                                <a
                                    href={firstButtonUrl}
                                    className="inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 font-medium duration-700 transition-all hover:scale-110"
                                    style={{
                                        backgroundColor: heroColor1,
                                        color: heroColor2,
                                        boxShadow: `0 0 0 1px ${textColor}`,
                                    }}
                                >
                                    <i className="bi bi-calendar-plus"></i>
                                    {firstButtonText}
                                </a>

                                <a
                                    href={secondButtonUrl}
                                    className="inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 duration-500 transition-all hover:scale-110"
                                    style={{
                                        backgroundColor: heroColor3,
                                        color: heroColor2,
                                        boxShadow: `0 0 0 1px ${textColor}`,
                                    }}
                                >
                                    <i className="bi bi-briefcase"></i>
                                    {secondButtonText}
                                </a>

                            </div>

                        </div>

                        <div className="relative w-full h-screen flex justify-center items-center">

                            <video
                                className="w-full h-auto object-cover rounded-2xl"
                                src={heroVideoUrl}
                                poster="https://placehold.co/1920x1080"
                                loop
                                autoPlay
                                muted
                                playsInline
                            />

                        </div>

                    </div>

                </div>

            </section >
        </div >
    );
}