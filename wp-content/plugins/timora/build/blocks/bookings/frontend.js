/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/api-fetch"
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
(module) {

module.exports = window["wp"]["apiFetch"];

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*****************************************!*\
  !*** ./src/blocks/bookings/frontend.js ***!
  \*****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);

document.addEventListener("DOMContentLoaded", () => {
  // Submit POST Data
  const form = document.querySelector("#timora-booking-form");
  const formBox = document.querySelector("#booking");
  const messageContainer = document.querySelector("#message-text");
  if (!form) {
    return;
  }
  form.addEventListener("submit", async e => {
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
    };
    console.log(formData);
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
        path: "/timora/bookings",
        method: "POST",
        data: formData
      });
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
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
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
      const services = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
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
      services.forEach(service => {
        const option = document.createElement("option");
        option.value = service.id;
        option.textContent = `${service.title} | ${service.duration} MIN | ${service.price} EUROS`;
        serviceSelected.appendChild(option);
        console.log(service.id);
      });
    } catch (error) {
      console.error(error);
    }
  }
  loadServices();
  dateSelected.addEventListener("change", refreshSlots);
  serviceSelected.addEventListener("change", refreshSlots);
});
})();

/******/ })()
;
//# sourceMappingURL=frontend.js.map