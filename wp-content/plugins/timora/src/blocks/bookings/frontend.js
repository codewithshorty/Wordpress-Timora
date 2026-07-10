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
        }

        console.log(formData);

        try {
            const response = await apiFetch({
                path: "/timora/bookings",
                method: "POST",
                data: formData
            })

            form.reset();
            messageContainer.className = "rounded-lg px-2 py-4 text-center font-semibold bg-green-100 text-green-700";

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

    async function loadAvailableSlots(date) {

        if (!date) {
            return;
        }

        try {
            const response = await apiFetch({
                path: `/timora/free-slots/?date=${date}`,
                method: "GET"
            });

            console.log(response.slots);

            timeSelected.innerHTML = "";

            const firstOption = document.createElement("option");
            firstOption.innerText = "Select booking time";
            firstOption.value = "";

            timeSelected.appendChild(firstOption);

            response.slots.forEach(slot => {
                const optionSlot = document.createElement("option");

                optionSlot.value = slot;
                optionSlot.textContent = slot

                timeSelected.appendChild(optionSlot);
            });
        } catch (error) {
            console.error(error);
        }
    }

    dateSelected.addEventListener("change", () => {
        loadAvailableSlots(dateSelected.value);
    })

})

