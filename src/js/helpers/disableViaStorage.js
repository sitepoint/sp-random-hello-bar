const CAN_LOCAL_STORAGE = !!(window && window.localStorage);
const EXPIRE_DAYS       = 14;
const STORAGE_KEY       = 'SpHelloBarDisabled';

function futureDaysInMs(days = EXPIRE_DAYS) {
  return Date.now() + (1000 * 60 * 60 * 24 * days);
}

export function checkStorage() {
  // hello bar may be disabled for the number of days set in EXPIRE_DAYS when user manually closed the bar
  const expiry = (CAN_LOCAL_STORAGE) ? window.localStorage.getItem(STORAGE_KEY) : null;

  if (expiry !== null) {
    const now = Date.now();
    if(expiry > now) {
      this.isEnabled = false;
    } else {
      window.localStorage.removeItem(STORAGE_KEY);
    }
  }
}

export function disableViaStorage() {
  if (CAN_LOCAL_STORAGE) window.localStorage.setItem(STORAGE_KEY, futureDaysInMs());
}
