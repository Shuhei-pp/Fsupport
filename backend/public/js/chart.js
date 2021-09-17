/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/chart.js ***!
  \*******************************/
window.onload = function () {
  var labels = ['January', 'February', 'March', 'April', 'May', 'June'];
  var data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45]
    }]
  };
  var config = {
    type: 'line',
    data: data,
    options: {}
  };
  console.log(66);
  var myChart = new Chart(document.getElementById('myChart'), config);
};
/******/ })()
;