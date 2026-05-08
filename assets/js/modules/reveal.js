const REVEAL_SELECTORS = [
  ".gss-about__title",
  ".gss-about-feature",
  ".gss-about-highlight",
  ".gss-about-advantage",
  ".gss-service-card",
  ".gss-projects__header",
  ".gss-projects__item",
  ".gss-cta__card",
  ".gss-contacts__company",
  ".gss-contacts__info",
  "[data-gss-reveal]",
];

const STAGGER_GROUPS = [
  {
    container: ".gss-about__features",
    item: ".gss-about-feature",
  },
  {
    container: ".gss-about__advantages",
    item: ".gss-about-advantage",
  },
  {
    container: ".gss-services__grid",
    item: ".gss-service-card",
  },
  {
    container: ".gss-projects__grid",
    item: ".gss-projects__item",
  },
  {
    container: "[data-gss-reveal-stagger]",
    item: ":scope > *",
  },
];

const STAGGER_DELAY = 70;
const MAX_STAGGER_DELAY = 420;

function isEditorContext() {
  return (
    document.body?.classList.contains("wp-admin") ||
    document.body?.classList.contains("block-editor-page") ||
    Boolean(document.querySelector(".editor-styles-wrapper"))
  );
}

function getRevealElements() {
  const elements = new Set();

  document.querySelectorAll(REVEAL_SELECTORS.join(",")).forEach((element) => {
    elements.add(element);
  });

  STAGGER_GROUPS.forEach(({ container, item }) => {
    document.querySelectorAll(container).forEach((group) => {
      group.querySelectorAll(item).forEach((element, index) => {
        const delay = Math.min(index * STAGGER_DELAY, MAX_STAGGER_DELAY);

        element.style.setProperty("--gss-reveal-delay", `${delay}ms`);
        elements.add(element);
      });
    });
  });

  return Array.from(elements);
}

export function initReveal() {
  if (isEditorContext()) {
    return;
  }

  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  );

  if (prefersReducedMotion.matches) {
    return;
  }

  const elements = getRevealElements();

  if (!elements.length) {
    return;
  }

  document.documentElement.classList.add("gss-reveal-enabled");

  elements.forEach((element) => {
    element.classList.add("gss-reveal");
  });

  if (!("IntersectionObserver" in window)) {
    elements.forEach((element) => {
      element.classList.add("is-visible");
    });

    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    },
    {
      root: null,
      rootMargin: "0px 0px -12% 0px",
      threshold: 0.12,
    },
  );

  elements.forEach((element) => {
    observer.observe(element);
  });
}
