import { useBlockProps } from "@wordpress/block-editor";


export default function Edit() {

    const blockProps = useBlockProps();

    return (
        <>
            <div {...blockProps} >
                <section id="team" className="py-20 bg-white">
                    <div className="max-w-7xl mx-auto px-6">
                        <div className="max-w-3xl">
                            <h2 className="font-display text-3xl sm:text-4xl font-extrabold text-[#4e148c]">Meet the team</h2>
                            <p className="mt-3 text-[#2c0735]/80">A small group of designers, engineers, and advocates building human‑centered scheduling.</p>
                        </div>
                        <div className="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            {/* Member 1  */}
                            <div className="rounded-2xl ring-1 ring-[#97dffc] bg-white shadow-soft p-5">
                                <img src="assets/images/professional_headshot_of_a_pro_e74e54645284e7fd221e70d178036bea.png" className="w-full aspect-square object-cover rounded-xl ring-1 ring-[#4e148c]/15" alt="Headshot of product designer" />
                                <div className="mt-4">
                                    <h3 className="font-display font-bold text-[#2c0735]">Ava Kim</h3>
                                    <p className="text-sm text-[#2c0735]/70">Head of Product Design</p>
                                    <p className="mt-2 text-sm text-[#2c0735]/80">Leads research‑driven design for accessible, delightful booking flows.</p>
                                    <div className="mt-3">
                                        <a href="#" className="inline-flex items-center gap-2 text-[#858ae3] hover:text-[#613dc1] transition-colors focus-ring" style={{ cursor: "default" }}><i className="bi bi-linkedin"></i> LinkedIn</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section >
            </div >
        </>


    );
}