import "@scss/app.scss";
import { initMobileMenu } from "./modules/mobile-menu";
import { initSmoothScroll } from "./modules/smooth-scroll";
import { initProjectsGallery } from "./modules/projects-gallery";
import { initLeadForms } from "./modules/lead-form";

document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initSmoothScroll();
  initProjectsGallery();
  initLeadForms();
  console.log("hi");
});
