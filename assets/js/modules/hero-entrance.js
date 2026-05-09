const REDUCED_MOTION_QUERY = "(prefers-reduced-motion: reduce)";

export function initHeroEntrance() {
  const hero = document.querySelector(".gss-hero");

  if (!hero) {
    return;
  }

  const prefersReducedMotion = window.matchMedia(REDUCED_MOTION_QUERY);

  if (prefersReducedMotion.matches) {
    hero.classList.add("is-ready");
    return;
  }

  hero.classList.add("is-entrance-enabled");

  window.setTimeout(() => {
    hero.classList.add("is-ready");
  }, 120);
}
