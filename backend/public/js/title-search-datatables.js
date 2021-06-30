/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************************!*\
  !*** ./public/assets/build/js/mypage/book/title-search-datatables.js ***!
  \***********************************************************************/
jQuery(function () {
  function DataTableRead() {
    $('#myTable').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
      },
      "order": [[2, "asc"]],
      'autoWidth': false,
      'columnDefs': [{
        targets: 0,
        width: "10%"
      }, {
        targets: 1,
        width: "30%"
      }, {
        targets: 2,
        width: "50%"
      }, {
        targets: 3,
        width: "10%"
      } // { 'visible': false, 'targets': [2,4] },
      ]
    });
  }

  $(document).ready(DataTableRead);
});
/******/ })()
;