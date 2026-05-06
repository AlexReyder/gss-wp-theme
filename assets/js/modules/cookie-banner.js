const COOKIE_BANNER_STORAGE_KEY = "gss_cookie_banner_accepted";

export function initCookieBanner() {
  const banner = document.querySelector("[data-gss-cookie-banner]");
  const acceptButton = document.querySelector("[data-gss-cookie-accept]");

  if (!banner || !acceptButton) {
    return;
  }

  const isAccepted = () => {
    try {
      return localStorage.getItem(COOKIE_BANNER_STORAGE_KEY) === "1";
    } catch {
      return false;
    }
  };

  const setAccepted = () => {
    try {
      localStorage.setItem(COOKIE_BANNER_STORAGE_KEY, "1");
    } catch {
      // Если localStorage недоступен, просто скрываем плашку в текущей сессии.
    }
  };

  const showBanner = () => {
    banner.hidden = false;

    window.requestAnimationFrame(() => {
      banner.classList.add("is-visible");
    });
  };

  const hideBanner = () => {
    banner.classList.remove("is-visible");
    banner.classList.add("is-hiding");

    window.setTimeout(() => {
      banner.hidden = true;
      banner.classList.remove("is-hiding");
    }, 260);
  };

  if (!isAccepted()) {
    showBanner();
  }

  acceptButton.addEventListener("click", () => {
    setAccepted();
    hideBanner();
  });
}
