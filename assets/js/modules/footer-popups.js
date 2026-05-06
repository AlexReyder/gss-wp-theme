const POPUP_ANIMATION_DURATION = 260;

export function initFooterPopups() {
  const triggers = [
    ...document.querySelectorAll("[data-gss-popup-open]"),
    ...document.querySelectorAll(".gss-hero__button"),
    ...document.querySelectorAll(".gss-service-card__button a"),
  ];

  const openButtons = [...new Set(triggers)];
  const popups = document.querySelectorAll("[data-gss-popup]");

  if (!openButtons.length || !popups.length) {
    return;
  }

  let activePopup = null;
  let lastActiveElement = null;
  let closeTimer = null;

  const getPopupName = (trigger) => {
    if (trigger.dataset.gssPopupOpen) {
      return trigger.dataset.gssPopupOpen;
    }

    if (
      trigger.matches(".gss-hero__button") ||
      trigger.matches(".gss-service-card__button a")
    ) {
      return "lead";
    }

    return "";
  };

  const finishClosePopup = (popup, shouldRestoreFocus = true) => {
    popup.hidden = true;
    popup.classList.remove("is-open", "is-closing");

    if (activePopup === popup) {
      activePopup = null;
    }

    if (!activePopup) {
      document.documentElement.classList.remove("gss-popup-is-open");
    }

    if (
      shouldRestoreFocus &&
      lastActiveElement &&
      typeof lastActiveElement.focus === "function"
    ) {
      lastActiveElement.focus();
    }

    if (shouldRestoreFocus) {
      lastActiveElement = null;
    }
  };

  const openPopup = (name) => {
    if (!name) {
      return;
    }

    const popup = document.querySelector(`[data-gss-popup="${name}"]`);

    if (!popup) {
      return;
    }

    if (closeTimer) {
      window.clearTimeout(closeTimer);
      closeTimer = null;
    }

    if (activePopup && activePopup !== popup) {
      finishClosePopup(activePopup, false);
    }

    lastActiveElement = document.activeElement;
    activePopup = popup;

    popup.hidden = false;
    popup.classList.remove("is-closing");

    document.documentElement.classList.add("gss-popup-is-open");

    window.requestAnimationFrame(() => {
      popup.classList.add("is-open");

      const dialog = popup.querySelector('[role="dialog"]');

      if (dialog) {
        dialog.focus();
      }
    });
  };

  const closePopup = () => {
    if (!activePopup) {
      return;
    }

    const popup = activePopup;

    popup.classList.remove("is-open");
    popup.classList.add("is-closing");

    closeTimer = window.setTimeout(() => {
      finishClosePopup(popup, true);
      closeTimer = null;
    }, POPUP_ANIMATION_DURATION);

    activePopup = null;
  };

  openButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      const popupName = getPopupName(button);

      if (!popupName) {
        return;
      }

      event.preventDefault();
      openPopup(popupName);
    });
  });

  popups.forEach((popup) => {
    popup.addEventListener("click", (event) => {
      const closeTarget = event.target.closest("[data-gss-popup-close]");

      if (closeTarget) {
        closePopup();
      }
    });
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && activePopup) {
      closePopup();
    }
  });
}
