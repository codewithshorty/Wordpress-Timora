document.addEventListener("DOMContentLoaded", () => {
    const serviceSelect = document.querySelector("#service-select");
    const providerBookingId = document.querySelector("#provider-booking-id");
    const bookingDate = document.querySelector("#booking-date");
    const bookingTime = document.querySelector("#booking-time");

    if (!providerBookingId || !bookingDate || !bookingTime || !serviceSelect) {
        console.error("Booking elements needs to be added");
        return;
    }


    const apiFetch = window.wp && window.wp.apiFetch;
    if (!apiFetch) {
        console.error("apiFetch needs to be loaded");
        return;
    }

    // console.log(serviceSelect);

    function resetBookingTime() {
        bookingTime.innerHTML = "";
        const placeholder = document.createElement("option");
        placeholder.value = "";
        placeholder.textContent = "Select reservation time";
        bookingTime.appendChild(placeholder);
    }

    function displayPickedDetails() {

        const serviceName = serviceSelect.selectedOptions[0].dataset.title;
        const serviceDuration = serviceSelect.selectedOptions[0].dataset.duration;
        const servicePrice = serviceSelect.selectedOptions[0].dataset.price;


        const displayDuration = document.querySelectorAll(".display-duration");
        const displayPrice = document.querySelectorAll(".display-price");

        const displayService = document.querySelector(".display-service");

        displayService.textContent = serviceName;

        displayDuration.forEach((singleNode) => {
            singleNode.textContent = serviceDuration;
        });

        displayPrice.forEach((singleNode) => {
            singleNode.textContent = servicePrice;
        });
    }

    bookingDate.addEventListener("change", () => {
        const displayDate = document.querySelector(".display-date");
        displayDate.textContent = bookingDate.value;
    });

    bookingTime.addEventListener("change", () => {
        const displayTime = document.querySelector(".display-time");
        displayTime.textContent = bookingTime.value;
    });

    async function loadAvailableSlots(date, service) {

        if (!date || !service) {
            return;
        }
        try {
            const response = await apiFetch({
                path: `/timora/free-slots/?date=${date}&service=${service}&provider=${providerBookingId.value}`,
                method: "GET"
            });

            resetBookingTime();


            const slots = response.slots;

            slots.forEach((slot) => {
                const option = document.createElement("option");
                option.textContent = slot;
                option.value = slot;
                bookingTime.appendChild(option);
            });
        } catch (error) {
            console.error(error);
            resetBookingTime();
        }

    }


    function refreshSlots() {
        const service = serviceSelect.value;
        const date = bookingDate.value;

        if (!service || !date) {
            resetBookingTime();
            return;
        }
        loadAvailableSlots(date, service);
    }

    serviceSelect.addEventListener("change", () => {
        displayPickedDetails();
        resetBookingTime();
        refreshSlots();
    });

    bookingDate.addEventListener("change", () => {
        refreshSlots();
    });




    const bookingForm = document.querySelector("#booking-form");

    bookingForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        console.log("Form submitted");
        const submitButton = document.querySelector("button[type='submit']")
        const bookingFormMessage = document.querySelector("#booking-form-message");
        const data = {
            service: serviceSelect.value,
            date: bookingDate.value,
            time: bookingTime.value,
            provider: providerBookingId.value,
            duration: serviceSelect.selectedOptions[0].dataset.duration,
            price: serviceSelect.selectedOptions[0].dataset.price,
            name: document.querySelector("#booking_name").value,
            surname: document.querySelector("#booking_surname").value,
            phone: document.querySelector("#booking_phone").value,
            email: document.querySelector("#booking_email").value,
            notes: document.querySelector("#booking_notes").value,
        }


        try {
            submitButton.disabled = true;
            submitButton.classList.add("opacity-50");
            submitButton.classList.add("cursor-not-allowed");
            submitButton.textContent = "Submitting...";
            const response = await apiFetch({
                "path": "/timora/bookings/",
                "method": "POST",
                "data": data
            });
            console.log(response);
            bookingFormMessage.innerHTML = `<div class='bg-green-500 text-white px-5 py-3 rounded-md '>${response.message}</div>`;
        } catch (error) {
            console.error(error);
            bookingFormMessage.innerHTML = `<div class='bg-red-500 text-white px-5 py-3 rounded-md '>${error.message}</div>`;
        } finally {
            submitButton.disabled = false;
            submitButton.classList.remove("opacity-50");
            submitButton.classList.remove("cursor-not-allowed");
            submitButton.textContent = "Confirm Appointment";
        }

    });
});


