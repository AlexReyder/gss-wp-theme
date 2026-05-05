import "@scss/app.scss";
import { initMobileMenu } from "./modules/mobile-menu";
import { initSmoothScroll } from "./modules/smooth-scroll";

document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initSmoothScroll();
});
