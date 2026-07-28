import apiFetch from "@wordpress/api-fetch";
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#registerProviderForm");
    const formProviderMessage = document.querySelector("#formProviderMessage");

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        console.log("clicked");
        const registerProviderButton = document.querySelector("#register_provider");

        registerProviderButton.textContent = "Registering...";
        registerProviderButton.disabled = true;

        const data = {
            businessName: document.querySelector("#businessName").value,
            ownerName: document.querySelector("#ownerName").value,
            email: document.querySelector("#email").value,
            password: document.querySelector("#password").value,
            industry: document.querySelector("#industry").value,
            // phone: document.querySelector("#phone").value,
            // website: document.querySelector("#website").value,
            // city: document.querySelector("#city").value,
            // description: document.querySelector("#description").value,
        };

        console.log(data);
        try {
            const response = await apiFetch({
                path: "/timora/provider-register",
                method: "POST",
                data: data
            });

            form.reset();

            formProviderMessage.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-green-100 text-green-700 block"

            formProviderMessage.textContent = response.message;


        } catch (error) {
            console.error(error)

            formProviderMessage.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-red-100 text-red-700 block";

            formProviderMessage.textContent = error.message;
        } finally {
            registerProviderButton.textContent = "Register as a provider";
            registerProviderButton.disabled = false;
        };
    })
});

