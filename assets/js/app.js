import "@scss/app.scss";
import { initMobileMenu } from "./modules/mobile-menu";
import { initSmoothScroll } from "./modules/smooth-scroll";
import { initProjectsGallery } from "./modules/projects-gallery";
import { initLeadForms } from "./modules/lead-form";
import { initFooterPopups } from "./modules/footer-popups";
import { initCookieBanner } from "./modules/cookie-banner";
import { initHeroParallax } from "./modules/hero-parallax";
import { initReveal } from "./modules/reveal";

document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initSmoothScroll();
  initReveal();
  initHeroParallax();
  initProjectsGallery();
  initLeadForms();
  initFooterPopups();
  initCookieBanner();
});
