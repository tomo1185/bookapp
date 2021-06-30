/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./public/assets/build/js/mypage/book/form/batch-change-volumes.js":
/*!*************************************************************************!*\
  !*** ./public/assets/build/js/mypage/book/form/batch-change-volumes.js ***!
  \*************************************************************************/
/***/ (() => {

/*---------------------------------
  書籍の全巻数を入力後、反映ボタンを押すまで、
  一括変更ボタンと送信ボタンが押せなくなる
 ----------------------------------*/
jQuery(function () {
  function some_handler() {
    // 送信ボタン
    $(":submit").prop("disabled", true); //  一括変更ボタン

    $("#batch_change_button").prop("disabled", true);
  } // キーボードを押し終わった後にイベント発生


  $('#number_of_volumes').keyup(some_handler); // 入力値が変更された時にイベント発生

  $('#number_of_volumes').change(some_handler);
});
/*---------------------------------
 書籍の全巻数を入力後に反映ボタンを押すと、
 各巻数の読書の読書状況を入力するフォームを出す
----------------------------------*/

jQuery(function () {
  function push_refrect_button() {
    var num_of_val = $('#number_of_volumes').val(); // 書籍の巻数が変更されたら以前の出力フォームを消す

    if (!$('#vol1').length) {
      $("#input_progress").empty();
    } // 書籍の巻数が1巻以上valmax巻未満の場合巻ごとの入力フォームを出力する


    var valmax = 500;

    if (num_of_val > 0 && num_of_val <= valmax) {
      // 送信ボタンと一括変更ボタンが押せるようになる
      $(":submit").prop("disabled", false);
      $("#batch_change_button").prop("disabled", false); // 全巻数を増やした時、読書状況のドロップダウンボタンを追加

      for (var i = 1; i <= num_of_val; i++) {
        if (!$('#vol' + i).length) {
          $('#input_progress').append('<div id="vol' + i + '" class="ml-1"><p>' + i + '巻:<select name="read_state[' + i + ']"><option value="未読">未読</option><option value="既読">既読</option></select></p></div>');
        }
      } // 全巻数を減らした時、読書状況のドロップダウンボタンを減らす


      for (var j = valmax; j > num_of_val; j--) {
        if ($('#vol' + j).length) {
          $('#vol' + j).remove();
        }
      } // 一括変更ボタンの最小値と最大値の初期値を設定


      $('#batch_change_min').val(1);
      $('#batch_change_max').val(num_of_val);
    } else {
      $("#input_progress").empty();

      if (num_of_val > valmax) {
        $('#input_progress').append('<p>' + valmax + '巻以内で入力してください。</p>');
      } else {
        $('#input_progress').append('<p>全巻数を入力後、「反映する」ボタンを押してください。</p>');
      }
    }
  } // 反映ボタンを押したらイベント発生


  $('#refrect_button').click(push_refrect_button);
});
/*---------------------------------
一括変更ボタンを押したときの変更処理
----------------------------------*/

jQuery(function () {
  function batch_change() {
    // 1. 変数の定義
    var min_val = Number($('#batch_change_min').val()); // 一括変更時の小さい数字

    var max_val = Number($('#batch_change_max').val()); // 一括変更時の大きい数字

    var num_of_val = Number($('#number_of_volumes').val()); // 全巻数

    var common = [min_val, max_val, num_of_val]; //上記変数を共通チェック処理で使用

    var valmax = 500; // 入力数値の上限値

    var change_flg = 1; //値の一括変更フラグ 1:変更する 0:変更しない

    var change_val = $("#batch_change_select").val(); // 2. 値のチェック処理(共通)

    for (var j = 0; j < 3; j++) {
      if (common[j] < 1 || valmax < common[j] || common[j] == "") {
        alert("入力値が不正です。1 ~ 全巻数までの数値を入力してください。");
        change_flg = 0;
        break;
      }
    }

    console.log("change_flg=" + change_flg);
    console.log("min_val=" + min_val);
    console.log("max_val=" + max_val);
    console.log("num_of_val=" + num_of_val);

    if (change_flg == 1) {
      if (min_val > max_val || max_val > num_of_val) {
        alert("入力値が不正です。値を確認してください。");
        change_flg = 0;
      }
    } // 3. 一括変更処理


    if (change_flg == 1) {
      for (var k = min_val; k <= max_val; k++) {
        var change_target = $('select[name="read_state[' + k + ']"]');
        change_target.children().remove();

        if (change_val == "既読") {
          change_target.append('<option value="未読">未読</option><option value="既読" selected>既読</option></select></p></div>');
        }

        if (change_val == "未読") {
          change_target.append('<option value="未読" selected>未読</option><option value="既読">既読</option></select></p></div>');
        }
      }

      alert(min_val + '巻から' + max_val + '巻まで' + change_val + 'に一括変更しました。');
    }
  }

  $('#batch_change_button').click(batch_change);
});

/***/ }),

/***/ "./public/assets/build/js/mypage/book/form/favorite-add-check.js":
/*!***********************************************************************!*\
  !*** ./public/assets/build/js/mypage/book/form/favorite-add-check.js ***!
  \***********************************************************************/
/***/ (() => {

/*---------------------------------
 お気に入り追加チェック判定の処理
----------------------------------*/
var favorite = $('input[name="favorite"]');
favorite.change(function () {
  if (favorite.prop('checked')) {
    favorite.next('label').text("登録する");
    favorite.val("1");
  } else {
    favorite.next('label').text("登録しない");
    favorite.val("0");
  }
});

/***/ }),

/***/ "./public/assets/build/js/mypage/bootstrap-form-validation.js":
/*!********************************************************************!*\
  !*** ./public/assets/build/js/mypage/bootstrap-form-validation.js ***!
  \********************************************************************/
/***/ (() => {

(function () {
  'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

  var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add('was-validated');
    }, false);
  });
})();

/***/ }),

/***/ "./resources/assets/sass/toppage.scss":
/*!********************************************!*\
  !*** ./resources/assets/sass/toppage.scss ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/sass/mypage/common.scss":
/*!**************************************************!*\
  !*** ./resources/assets/sass/mypage/common.scss ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/sass/mypage/home.scss":
/*!************************************************!*\
  !*** ./resources/assets/sass/mypage/home.scss ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/sass/mypage/book_register.scss":
/*!*********************************************************!*\
  !*** ./resources/assets/sass/mypage/book_register.scss ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/sass/mypage/title_search.scss":
/*!********************************************************!*\
  !*** ./resources/assets/sass/mypage/title_search.scss ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/sass/mypage/profile_settings.scss":
/*!************************************************************!*\
  !*** ./resources/assets/sass/mypage/profile_settings.scss ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/bookform": 0,
/******/ 			"assets/build/css/mypage/profile_settings": 0,
/******/ 			"assets/build/css/mypage/title_search": 0,
/******/ 			"assets/build/css/mypage/book_register": 0,
/******/ 			"assets/build/css/mypage/home": 0,
/******/ 			"assets/build/css/mypage/common": 0,
/******/ 			"assets/build/css/toppage": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./public/assets/build/js/mypage/book/form/batch-change-volumes.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./public/assets/build/js/mypage/book/form/favorite-add-check.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./public/assets/build/js/mypage/bootstrap-form-validation.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/mypage/common.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/mypage/home.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/mypage/book_register.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/mypage/title_search.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/mypage/profile_settings.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/build/css/mypage/profile_settings","assets/build/css/mypage/title_search","assets/build/css/mypage/book_register","assets/build/css/mypage/home","assets/build/css/mypage/common","assets/build/css/toppage"], () => (__webpack_require__("./resources/assets/sass/toppage.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;