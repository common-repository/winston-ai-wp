/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/styles/settings.scss":
/*!*****************************************!*\
  !*** ./assets/src/styles/settings.scss ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

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
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
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
/*!***************************************!*\
  !*** ./assets/src/plugin-settings.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_settings_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/settings.scss */ "./assets/src/styles/settings.scss");


/**
 * Search for an element with the "tabs" id then fire the "tabs" function
 *
 * @param {jQuery} $ The jQuery object to be used in the function body
 */
($ => {
  $(() => {});
  function loadCertificate(cert_one, cert_two) {
    if (cert_two == 'success') {
      $(".icon-success").show();
      $(".text-success-two").show();
      $(".cert-two").show();
    } else if (cert_one == 'success') {
      $(".icon-success").show();
      $(".text-success-one").show();
      $(".cert-one").show();
    } else if (cert_one == 'failed' || cert_two == 'failed') {
      $(".cert-failed").show();
      $(".icon-error").show();
      $(".text-failed").show();
    } else {
      $(".no-score").show();
      $(".icon-warning").show();
    }
  }

  // Verify website
  var isConnected = myData.is_connected;
  if (isConnected === 'true') {
    console.log('Connected');
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: myData.ajaxUrl,
      data: {
        'action': 'winston_verify_website',
        'nonce': myData.nonce
      },
      success: function (response) {
        if (response.success === true && response.data.is_linked === true) {
          $('.connected-icon').show();
          $('.winston-loading-status').hide();
          $('.winston-score-loading').hide();
          $('.assessment-text-loading').hide();
          $('.assessment-icon-loading').hide();
          if (response.data.cert_one || response.data.cert_two) {
            loadCertificate(response.data.cert_one, response.data.cert_two);
          } else {
            $('.winston-score-none').css('display', 'flex');
            $('.no-score').show();
            $(".icon-warning").show();
            $(".assessment-icon-loading").hide();
          }
        } else {
          winston_disconnect();
        }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
        // Handle the error appropriately
      }
    });
  }

  // When we click on button with id "connect-winston" we will fire the function
  $('#submit-token').on('submit', function (e) {
    e.preventDefault();
    $('.connecting-icon').css('display', 'inline');
    $('.connect-text').hide();
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: myData.ajaxUrl,
      data: {
        'action': 'winston_link_website',
        'token': $('#winston-token').val(),
        'winston_link_website_nonce': $('#winston_link_website_nonce').val()
      },
      success: function (response) {
        if (response.success === true) {
          location.reload();
        } else {
          $('.winston-error').fadeIn();
          $('.connecting-icon').hide();
          $('.connect-text').show();
        }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
        $('.connecting-icon').hide();
        $('.connect-text').show();
      }
    });
  });
  function winston_disconnect() {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: myData.ajaxUrl,
      data: {
        'action': 'winston_disconnect'
      },
      success: function (response) {
        if (response.success === true) {
          location.reload();
        }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      }
    });
  }
  // When we click on button with id "winston-disconnect" or class winston-logout we will fire the function
  $('#winston-disconnect, .winston-logout').on('click', function (e) {
    e.preventDefault();
    winston_disconnect();
  });
  $('.winston-status').on('click', function (e) {
    $('.winston-dropdown-menu').toggleClass('show');
  });

  // also toggle if you click outside the element
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.winston-status').length) {
      $('.winston-dropdown-menu').removeClass('show');
    }
  });
})(jQuery);
/******/ })()
;
//# sourceMappingURL=plugin-settings.js.map