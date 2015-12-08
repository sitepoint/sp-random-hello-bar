import SpHelloBar                          from "./SpHelloBar";
import { checkStorage, disableViaStorage } from "./helpers/disableViaStorage";
import getRandomHelloBar                   from "./helpers/getRandomHelloBar";

(function(window, $, _) {

  const sph = new SpHelloBar({
    throttle: _.throttle
  });

  // extend SpHelloBar
  sph.after("beforeInit", function() {
    checkStorage.call(sph);
  });
  sph.after("onClose", function() {
    disableViaStorage.call(sph);
  });

  getRandomHelloBar($, () => sph.init());

})(window, jQuery, _);
