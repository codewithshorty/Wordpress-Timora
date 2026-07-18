import apiFetch from "@wordpress/api-fetch";

document.addEventListener("DOMContentLoaded", () => {
    // Submit POST Data
    const form = document.querySelector("#timora-booking-form");
    const formBox = document.querySelector("#booking");
    const messageContainer = document.querySelector("#message-text");

    if (!form) {
        return;
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();


        const submitBtn = form.querySelector("button[type='submit']");
        submitBtn.textContent = "Booking...";
        submitBtn.disabled = true;

        const formData = {
            name: document.querySelector("#booking-name").value,
            surname: document.querySelector("#booking-surname").value,
            phone: document.querySelector("#booking-phone").value,
            email: document.querySelector("#booking-email").value,
            date: document.querySelector("#booking-date").value,
            time: document.querySelector("#booking-time").value,
            notes: document.querySelector("#booking-notes").value,
            service: document.querySelector("#booking-service").value
        }

        console.log(formData);

        try {
            const response = await apiFetch({
                path: "/timora/bookings",
                method: "POST",
                data: formData
            })

            form.reset();
            messageContainer.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-green-100 text-green-700 block";

            messageContainer.textContent = response.message;

            console.log(response);
        } catch (error) {
            messageContainer.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-red-100 text-red-700 block";
            messageContainer.textContent = error.message;



            console.error(error);
        } finally {
            submitBtn.textContent = "Book";
            submitBtn.disabled = false;
        }



    });

    // Selecting available slots


    const dateSelected = document.querySelector("#booking-date");
    const timeSelected = document.querySelector("#booking-time");
    const serviceSelected = document.querySelector("#booking-service");
    console.log(serviceSelected);

    async function loadAvailableSlots(date, service) {

        if (!date || !service) {
            return;
        }

        try {

            const response = await apiFetch({
                path: `/timora/free-slots/?date=${date}&service=${service}`,
                method: "GET"
            });

            timeSelected.innerHTML = "";

            const firstOption = document.createElement("option");
            firstOption.value = "";
            firstOption.textContent = "Select booking time";

            timeSelected.appendChild(firstOption);

            response.slots.forEach(slot => {

                const option = document.createElement("option");

                option.value = slot;
                option.textContent = slot;

                timeSelected.appendChild(option);

            });

        } catch (error) {
            console.error(error);
        }
    }

    function refreshSlots() {

        const date = dateSelected.value;
        const service = serviceSelected.value;

        if (!date || !service) {
            return;
        }

        loadAvailableSlots(date, service);

    }


    async function loadServices() {
        console.log("services loading...");
        try {
            const services = await apiFetch({
                "path": "/timora/services",
                "method": "GET"
            });

            console.log(services);
            console.log(Array.isArray(services));



            serviceSelected.innerHTML = "";
            const firstOptionService = document.createElement("option");
            firstOptionService.value = "";
            firstOptionService.textContent = "Pick type of service";
            serviceSelected.appendChild(firstOptionService);

            services.forEach((service) => {
                const option = document.createElement("option");
                option.value = service.id;
                option.textContent = `${service.title} | ${service.duration} MIN | ${service.price} EUROS`;

                serviceSelected.appendChild(option);

                console.log(service.id)

            });

        } catch (error) {
            console.error(error);
        }

    }

    loadServices();

    dateSelected.addEventListener("change", refreshSlots);
    serviceSelected.addEventListener("change", refreshSlots);

});