export function initHeroParallax() {
  const hero = document.querySelector(".gss-hero");

  if (!hero) {
    return;
  }

  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  );

  if (prefersReducedMotion.matches) {
    return;
  }

  let targetX = 0;
  let targetY = 0;
  let currentX = 0;
  let currentY = 0;
  let animationFrame = null;

  const setHeroVars = () => {
    currentX += (targetX - currentX) * 0.08;
    currentY += (targetY - currentY) * 0.08;

    hero.style.setProperty("--gss-hero-parallax-x", `${currentX}px`);
    hero.style.setProperty("--gss-hero-parallax-y", `${currentY}px`);
    hero.style.setProperty("--gss-hero-content-x", `${currentX * -0.16}px`);
    hero.style.setProperty("--gss-hero-content-y", `${currentY * -0.12}px`);

    animationFrame = window.requestAnimationFrame(setHeroVars);
  };

  const startAnimation = () => {
    if (animationFrame !== null) {
      return;
    }

    animationFrame = window.requestAnimationFrame(setHeroVars);
  };

  const stopAnimation = () => {
    if (animationFrame === null) {
      return;
    }

    window.cancelAnimationFrame(animationFrame);
    animationFrame = null;
  };

  const updateTarget = (event) => {
    const rect = hero.getBoundingClientRect();
    const x = (event.clientX - rect.left) / rect.width - 0.5;
    const y = (event.clientY - rect.top) / rect.height - 0.5;

    targetX = x * 42;
    targetY = y * 30;

    startAnimation();
  };

  const resetTarget = () => {
    targetX = 0;
    targetY = 0;
  };

  hero.addEventListener("pointermove", updateTarget);
  hero.addEventListener("pointerleave", resetTarget);

  window.addEventListener("blur", resetTarget);

  window.addEventListener("resize", () => {
    if (window.innerWidth <= 768) {
      resetTarget();
    }
  });

  startAnimation();
}
