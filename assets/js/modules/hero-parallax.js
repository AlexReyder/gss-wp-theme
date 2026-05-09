const REDUCED_MOTION_QUERY = "(prefers-reduced-motion: reduce)";
const PARALLAX_QUERY =
  "(min-width: 769px) and (hover: hover) and (pointer: fine)";

const BACKGROUND_MOVE_X = 28;
const BACKGROUND_MOVE_Y = 18;
const CONTENT_MOVE_X = -0.12;
const CONTENT_MOVE_Y = -0.1;
const EASE_FACTOR = 0.075;
const SETTLE_THRESHOLD = 0.08;

function addMediaChangeListener(mediaQueryList, callback) {
  if (typeof mediaQueryList.addEventListener === "function") {
    mediaQueryList.addEventListener("change", callback);
    return;
  }

  mediaQueryList.addListener(callback);
}

export function initHeroParallax() {
  const hero = document.querySelector(".gss-hero");

  if (!hero) {
    return;
  }

  const prefersReducedMotion = window.matchMedia(REDUCED_MOTION_QUERY);
  const canUseParallax = window.matchMedia(PARALLAX_QUERY);

  const resetHeroVars = () => {
    hero.style.setProperty("--gss-hero-parallax-x", "0px");
    hero.style.setProperty("--gss-hero-parallax-y", "0px");
    hero.style.setProperty("--gss-hero-content-x", "0px");
    hero.style.setProperty("--gss-hero-content-y", "0px");
  };

  if (prefersReducedMotion.matches) {
    hero.classList.add("is-ready");
    resetHeroVars();
    return;
  }

  document.documentElement.classList.add("gss-hero-motion-enabled");

  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => {
      hero.classList.add("is-ready");
    });
  });

  let targetX = 0;
  let targetY = 0;
  let currentX = 0;
  let currentY = 0;
  let animationFrame = null;
  let isPointerInside = false;
  let isParallaxEnabled = false;

  const applyHeroVars = () => {
    hero.style.setProperty("--gss-hero-parallax-x", `${currentX.toFixed(2)}px`);
    hero.style.setProperty("--gss-hero-parallax-y", `${currentY.toFixed(2)}px`);
    hero.style.setProperty(
      "--gss-hero-content-x",
      `${(currentX * CONTENT_MOVE_X).toFixed(2)}px`,
    );
    hero.style.setProperty(
      "--gss-hero-content-y",
      `${(currentY * CONTENT_MOVE_Y).toFixed(2)}px`,
    );
  };

  const stopAnimation = () => {
    if (animationFrame === null) {
      return;
    }

    window.cancelAnimationFrame(animationFrame);
    animationFrame = null;
  };

  const tick = () => {
    currentX += (targetX - currentX) * EASE_FACTOR;
    currentY += (targetY - currentY) * EASE_FACTOR;

    applyHeroVars();

    const isReturningToCenter =
      !isPointerInside && targetX === 0 && targetY === 0;

    const isSettled =
      Math.abs(currentX) < SETTLE_THRESHOLD &&
      Math.abs(currentY) < SETTLE_THRESHOLD;

    if (isReturningToCenter && isSettled) {
      currentX = 0;
      currentY = 0;
      applyHeroVars();
      animationFrame = null;
      return;
    }

    animationFrame = window.requestAnimationFrame(tick);
  };

  const startAnimation = () => {
    if (animationFrame !== null) {
      return;
    }

    animationFrame = window.requestAnimationFrame(tick);
  };

  const updateTarget = (event) => {
    if (!isParallaxEnabled) {
      return;
    }

    const rect = hero.getBoundingClientRect();

    if (!rect.width || !rect.height) {
      return;
    }

    const x = (event.clientX - rect.left) / rect.width - 0.5;
    const y = (event.clientY - rect.top) / rect.height - 0.5;

    targetX = x * BACKGROUND_MOVE_X;
    targetY = y * BACKGROUND_MOVE_Y;
    isPointerInside = true;

    startAnimation();
  };

  const resetTarget = () => {
    targetX = 0;
    targetY = 0;
    isPointerInside = false;

    startAnimation();
  };

  const enableParallax = () => {
    if (isParallaxEnabled || prefersReducedMotion.matches) {
      return;
    }

    isParallaxEnabled = true;
    hero.classList.add("is-parallax-enabled");

    hero.addEventListener("pointermove", updateTarget, { passive: true });
    hero.addEventListener("pointerleave", resetTarget);
    window.addEventListener("blur", resetTarget);

    resetHeroVars();
  };

  const disableParallax = () => {
    if (!isParallaxEnabled) {
      resetHeroVars();
      return;
    }

    isParallaxEnabled = false;
    isPointerInside = false;
    targetX = 0;
    targetY = 0;
    currentX = 0;
    currentY = 0;

    stopAnimation();
    resetHeroVars();

    hero.classList.remove("is-parallax-enabled");
    hero.removeEventListener("pointermove", updateTarget);
    hero.removeEventListener("pointerleave", resetTarget);
    window.removeEventListener("blur", resetTarget);
  };

  if (canUseParallax.matches) {
    enableParallax();
  }

  addMediaChangeListener(canUseParallax, (event) => {
    if (event.matches) {
      enableParallax();
      return;
    }

    disableParallax();
  });

  addMediaChangeListener(prefersReducedMotion, (event) => {
    if (event.matches) {
      disableParallax();
      document.documentElement.classList.remove("gss-hero-motion-enabled");
      hero.classList.add("is-ready");
      resetHeroVars();
      return;
    }

    document.documentElement.classList.add("gss-hero-motion-enabled");
    hero.classList.add("is-ready");

    if (canUseParallax.matches) {
      enableParallax();
    }
  });
}
