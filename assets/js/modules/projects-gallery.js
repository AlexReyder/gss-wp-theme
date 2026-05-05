export function initProjectsGallery() {
  const links = Array.from(
    document.querySelectorAll("[data-projects-lightbox]"),
  );

  if (!links.length) {
    return;
  }

  let currentIndex = 0;

  const lightbox = document.createElement("div");
  lightbox.className = "gss-projects-lightbox";
  lightbox.setAttribute("role", "dialog");
  lightbox.setAttribute("aria-modal", "true");
  lightbox.setAttribute("aria-label", "Галерея проектов");

  lightbox.innerHTML = `
    <button class="gss-projects-lightbox__button gss-projects-lightbox__close" type="button" aria-label="Закрыть">×</button>
    <button class="gss-projects-lightbox__button gss-projects-lightbox__prev" type="button" aria-label="Предыдущее изображение">‹</button>
    <img class="gss-projects-lightbox__image" src="" alt="">
    <button class="gss-projects-lightbox__button gss-projects-lightbox__next" type="button" aria-label="Следующее изображение">›</button>
    <div class="gss-projects-lightbox__counter" aria-live="polite"></div>
  `;

  document.body.appendChild(lightbox);

  const image = lightbox.querySelector(".gss-projects-lightbox__image");
  const closeButton = lightbox.querySelector(".gss-projects-lightbox__close");
  const prevButton = lightbox.querySelector(".gss-projects-lightbox__prev");
  const nextButton = lightbox.querySelector(".gss-projects-lightbox__next");
  const counter = lightbox.querySelector(".gss-projects-lightbox__counter");

  const render = () => {
    const link = links[currentIndex];
    const img = link.querySelector("img");

    image.src = link.href;
    image.alt = img?.alt || "";
    counter.textContent = `${currentIndex + 1} / ${links.length}`;
  };

  const open = (index) => {
    currentIndex = index;
    render();

    lightbox.classList.add("is-open");
    document.body.classList.add("gss-projects-lightbox-open");
    closeButton.focus();
  };

  const close = () => {
    lightbox.classList.remove("is-open");
    document.body.classList.remove("gss-projects-lightbox-open");
    image.src = "";
  };

  const prev = () => {
    currentIndex = currentIndex === 0 ? links.length - 1 : currentIndex - 1;
    render();
  };

  const next = () => {
    currentIndex = currentIndex === links.length - 1 ? 0 : currentIndex + 1;
    render();
  };

  links.forEach((link, index) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      open(index);
    });
  });

  closeButton.addEventListener("click", close);
  prevButton.addEventListener("click", prev);
  nextButton.addEventListener("click", next);

  lightbox.addEventListener("click", (event) => {
    if (event.target === lightbox) {
      close();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (!lightbox.classList.contains("is-open")) {
      return;
    }

    if (event.key === "Escape") {
      close();
    }

    if (event.key === "ArrowLeft") {
      prev();
    }

    if (event.key === "ArrowRight") {
      next();
    }
  });
}
