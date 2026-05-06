export function initFooterPopups() {
  const openButtons = document.querySelectorAll("[data-gss-popup-open]");
  const popups = document.querySelectorAll("[data-gss-popup]");

  if (!openButtons.length || !popups.length) {
    return;
  }

  let activePopup = null;
  let lastActiveElement = null;

  const openPopup = (name) => {
    const popup = document.querySelector(`[data-gss-popup="${name}"]`);

    if (!popup) {
      return;
    }

    lastActiveElement = document.activeElement;
    activePopup = popup;

    popup.hidden = false;
    document.documentElement.classList.add("gss-popup-is-open");

    const dialog = popup.querySelector(".gss-popup__dialog");

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
    button.addEventListener("click", () => {
      openPopup(button.dataset.gssPopupOpen);
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
