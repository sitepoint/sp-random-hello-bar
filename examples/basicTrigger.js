/*
  Example
  - if an element with the data-hellobar attribute set to trigger is present in the page override the targetOffset value
  - for instance you may add this attribute to an element the end of your page
*/

import SpHelloBar        from "./SpHelloBar";
import getRandomHelloBar from "./helpers/getRandomHelloBar";

import "../css/basic.css";

(function(window, $, _) {

  let targetOffset = 300;
  if(document.querySelector('[data-hellobar="trigger"]')) targetOffset = document.querySelector('[data-hellobar="trigger"]').offsetTop;

  const sph = new SpHelloBar({
    targetOffset,
    throttle: _.throttle
  });

  getRandomHelloBar($, () => sph.init());

})(window, jQuery, _);
