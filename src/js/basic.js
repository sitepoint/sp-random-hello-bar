import SpHelloBar        from "./SpHelloBar";
import getRandomHelloBar from "./helpers/getRandomHelloBar";

import "../css/basic.css";

(function(window, $, _) {

  const sph = new SpHelloBar({
    throttle: _.throttle
  });

  getRandomHelloBar($, () => sph.init());

})(window, jQuery, _);
