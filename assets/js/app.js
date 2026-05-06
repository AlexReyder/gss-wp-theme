import "@scss/app.scss";
import { initMobileMenu } from "./modules/mobile-menu";
import { initSmoothScroll } from "./modules/smooth-scroll";
import { initProjectsGallery } from "./modules/projects-gallery";
import { initLeadForms } from "./modules/lead-form";
import { initFooterPopups } from "./modules/footer-popups";

document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initSmoothScroll();
  initProjectsGallery();
  initLeadForms();
  initFooterPopups();
});
