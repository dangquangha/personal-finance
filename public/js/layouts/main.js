/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/layouts/main.js ***!
  \**************************************/
var MAIN = {
  init: function init() {
    this.activeMenu();
  },
  activeMenu: function activeMenu() {
    var currentUrl = window.location.href;
    var urlParts = currentUrl.split("/");
    var menu = urlParts[3];
    $(".nav-item .nav-link[data-menu=\"".concat(menu, "\"]")).addClass('active');
  }
};
$(document).ready(function () {
  MAIN.init();
});
/******/ })()
;