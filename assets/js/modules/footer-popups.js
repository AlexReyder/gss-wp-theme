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

  const openPopup = (name) => {
    if (!name) {
      return;
    }

    const popup = document.querySelector(`[data-gss-popup="${name}"]`);

    if (!popup) {
      return;
    }

    if (activePopup && activePopup !== popup) {
      activePopup.hidden = true;
    }

    lastActiveElement = document.activeElement;
    activePopup = popup;

    popup.hidden = false;
    document.documentElement.classList.add("gss-popup-is-open");

    const dialog = popup.querySelector('[role="dialog"]');

    if (dialog) {
      dialog.focus();
    }
  };

  const closePopup = () => {
    if (!activePopup) {
      return;
    }

    activePopup.hidden = true;
    activePopup = null;
    document.documentElement.classList.remove("gss-popup-is-open");

    if (lastActiveElement && typeof lastActiveElement.focus === "function") {
      lastActiveElement.focus();
    }

    lastActiveElement = null;
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
