export function initMobileMenu() {
  const button = document.querySelector("[data-menu-toggle]");
  const menu = document.querySelector("[data-mobile-menu]");

  if (!button || !menu) {
    return;
  }

  button.addEventListener("click", () => {
    const isOpen = button.getAttribute("aria-expanded") === "true";

    button.setAttribute("aria-expanded", String(!isOpen));
    menu.classList.toggle("is-open", !isOpen);
    document.body.classList.toggle("is-menu-open", !isOpen);
  });
}
