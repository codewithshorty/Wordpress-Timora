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
/*!*******************************************************!*\
  !*** ./src/blocks/providers-registration/frontend.js ***!
  \*******************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#registerProviderForm");
  const formProviderMessage = document.querySelector("#formProviderMessage");
  form.addEventListener("submit", async event => {
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
      industry: document.querySelector("#industry").value
      // phone: document.querySelector("#phone").value,
      // website: document.querySelector("#website").value,
      // city: document.querySelector("#city").value,
      // description: document.querySelector("#description").value,
    };
    console.log(data);
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
        path: "/timora/provider-register",
        method: "POST",
        data: data
      });
      form.reset();
      formProviderMessage.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-green-100 text-green-700 block";
      formProviderMessage.textContent = response.message;
    } catch (error) {
      console.error(error);
      formProviderMessage.className = "rounded-lg mt-2 px-2 py-4 text-center font-semibold bg-red-100 text-red-700 block";
      formProviderMessage.textContent = error.message;
    } finally {
      registerProviderButton.textContent = "Register as a provider";
      registerProviderButton.disabled = false;
    }
    ;
  });
});
})();

/******/ })()
;
//# sourceMappingURL=frontend.js.map