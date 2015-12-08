/*
  Example
  - only fetch and init the hello bar if the .enableSpHelloBar class is present
*/

import SpHelloBar        from "./SpHelloBar";
import getRandomHelloBar from "./helpers/getRandomHelloBar";

import "../css/basic.css";

(function(window, $, _) {

  if (!document.getElementsByClassName('enableSpHelloBar').length) return;

  const sph = new SpHelloBar({
    throttle: _.throttle
  });

  getRandomHelloBar($, () => sph.init());

})(window, jQuery, _);
