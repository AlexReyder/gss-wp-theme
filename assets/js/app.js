import "@scss/app.scss";
import { initMobileMenu } from "./modules/mobile-menu";
import { initSmoothScroll } from "./modules/smooth-scroll";
import { initHeroEntrance } from "./modules/hero-entrance";
import { initReveal } from "./modules/reveal";
import { initHeroParallax } from "./modules/hero-parallax";
import { initProjectsGallery } from "./modules/projects-gallery";
import { initLeadForms } from "./modules/lead-form";
import { initFooterPopups } from "./modules/footer-popups";
import { initCookieBanner } from "./modules/cookie-banner";

document.addEventListener("DOMContentLoaded", () => {
  initHeroEntrance();
  initMobileMenu();
  initSmoothScroll();
  initReveal();
  initHeroParallax();
  initProjectsGallery();
  initLeadForms();
  initFooterPopups();
  initCookieBanner();
});
