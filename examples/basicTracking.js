/*
  Example
  - track hello bar impressions and clicks
*/

import SpHelloBar        from "./SpHelloBar";
import getRandomHelloBar from "./helpers/getRandomHelloBar";
import trackEvent        from './helpers/trackEvent';

import "../css/basic.css";

(function(window, $, _) {

  const sph = new SpHelloBar({
    throttle: _.throttle
  });

  // extend SpHelloBar
  sph.after('onClick', function() {
    trackEvent.call(sph, 'Click');
  });
  sph.after('onToggle', function() {
    trackEvent.call(sph, 'Impression');
  });

  getRandomHelloBar($, () => sph.init());

})(window, jQuery, _);
