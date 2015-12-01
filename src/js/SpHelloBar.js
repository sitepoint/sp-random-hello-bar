export default function SpHelloBar({
    isEnabled        = true,
    isShown          = false,
    shouldBeShown    = false,
    targetOffset     = 300,
    throttle         = undefined,
    throttleWait     = 500,
    elSelector       = '.SpHelloBar',
    closeBtnSelector = '.SpHelloBar_close',
    linkSelector     = '.SpHelloBar_container',
    showClassName    = 'SpHelloBar u-show',
    hideClassName    = 'SpHelloBar'
  } = {}){
  this.isEnabled        = isEnabled;
  this.isShown          = isShown;
  this.shouldBeShown    = shouldBeShown;
  this.targetOffset     = targetOffset;
  this.throttle         = throttle;
  this.throttleWait     = throttleWait;
  this.elSelector       = elSelector;
  this.closeBtnSelector = closeBtnSelector;
  this.linkSelector     = linkSelector;
  this.showClassName    = showClassName;
  this.hideClassName    = hideClassName;
}

SpHelloBar.prototype = {
  beforeInit() {
    this.checkForThrottle();
    this.checkForEl();
  },

  onInit() {
    this.findCloseBtn();
    this.findLink();
  },

  onScroll() {
    this.checkPosition();
    this.checkForVisChange();
  },

  onToggle() {
    this.isShown = this.shouldBeShown;
    this.toggleClass();
  },

  onClick() {
    // noop by default
  },

  onClose(e) {
    e.preventDefault();
    this.unBindEvents();
    this.shouldBeShown = false;
    this.onToggle();
  },

  init() {
    this.beforeInit();
    if(!this.isEnabled) return;

    this.onInit();

    this.checkPositionThrottled =  this.throttle(
      this.onScroll.bind(this),
      this.throttleWait
    );

    this.bindEvents();
  },

  findCloseBtn() {
    this.$closeBtn = this.$el.querySelector(this.closeBtnSelector);
    this.$closeBtn && this.$closeBtn.addEventListener('click', this.onClose.bind(this));
  },

  findLink() {
    this.$link = this.$el.querySelector(this.linkSelector);
    this.$link && this.$link.addEventListener('click', this.onClick.bind(this));
  },

  bindEvents() {
    window.addEventListener('scroll', this.checkPositionThrottled);
    window.addEventListener('resize', this.checkPositionThrottled);
  },

  unBindEvents() {
    window.removeEventListener('scroll', this.checkPositionThrottled);
    window.removeEventListener('resize', this.checkPositionThrottled);
  },

  toggleClass() {
    this.$el.className = (this.isShown) ? this.showClassName : this.hideClassName ;
  },

  checkForVisChange() {
    if(this.shouldBeShown == this.isShown) return;
    this.onToggle();
  },

  checkPosition() {
    const windowTop = window.pageYOffset || document.documentElement.scrollTop;
    this.shouldBeShown = (windowTop > this.targetOffset);
  },

  checkForThrottle() {
    this.isEnabled = this.isEnabled && !!this.throttle;
    !this.isEnabled && console.log('umm I need a throttle');
  },

  checkForEl() {
    this.$el = document.querySelector(this.elSelector);
    this.isEnabled = this.isEnabled && !!this.$el;
    !this.isEnabled && console.log('umm I need some DOM');
  },

  after (method, fn) {
    const oldMethod = this[method];
    this[method] = function() {
      oldMethod.apply(this, arguments);
      fn.apply(this, arguments);
    }
  }
}
