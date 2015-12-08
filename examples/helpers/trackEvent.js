export default function trackEvent (label) {
  // only track impressions once
  if (!this.impressionTracked && this.isShown && label == 'Impression') {
    this.impressionTracked = true;
  } else if(this.isShown && label == 'Impression') {
    return;
  }

  // check for the Google Analytics global var
  if (typeof(ga) == 'undefined') return;

  ga('send', 'event', 'SP Hello Bar', label, {
    'nonInteraction': true
  });
}
