const leadFormMessages = {
  success: {
    text: "Спасибо! Заявка отправлена. Мы свяжемся с вами в ближайшее время.",
    type: "success",
  },
  invalid: {
    text: "Проверьте имя, телефон и согласие на обработку персональных данных.",
    type: "error",
  },
  throttled: {
    text: "Заявка уже была отправлена. Попробуйте повторить чуть позже.",
    type: "error",
  },
  error: {
    text: "Не удалось отправить заявку. Попробуйте повторить позже.",
    type: "error",
  },
};

function getAjaxUrl(form) {
  const actionUrl = form.getAttribute("action") || "";

  if (actionUrl.includes("admin-post.php")) {
    return actionUrl.replace("admin-post.php", "admin-ajax.php");
  }

  return "/wp-admin/admin-ajax.php";
}

function setMessage(messageElement, status, fallbackText = "") {
  if (!messageElement) {
    return;
  }

  const message = leadFormMessages[status] || leadFormMessages.error;

  messageElement.textContent = fallbackText || message.text;
  messageElement.hidden = false;
  messageElement.classList.remove(
    "gss-cta__notice--success",
    "gss-cta__notice--error",
  );
  messageElement.classList.add(`gss-cta__notice--${message.type}`);
}

function clearMessage(messageElement) {
  if (!messageElement) {
    return;
  }

  messageElement.textContent = "";
  messageElement.hidden = true;
  messageElement.classList.remove(
    "gss-cta__notice--success",
    "gss-cta__notice--error",
  );
}

export function initLeadForms() {
  const forms = document.querySelectorAll("[data-gss-lead-form]");

  if (!forms.length) {
    return;
  }

  const params = new URLSearchParams(window.location.search);
  const status = params.get("gss_lead_status");
  const initialMessage = status ? leadFormMessages[status] : null;

  forms.forEach((form) => {
    const pageUrlInput = form.querySelector('input[name="page_url"]');
    const redirectToInput = form.querySelector('input[name="redirect_to"]');
    const messageElement = form.querySelector("[data-gss-lead-message]");
    const submitButton = form.querySelector('[type="submit"]');

    if (pageUrlInput) {
      pageUrlInput.value = window.location.href;
    }

    if (redirectToInput) {
      redirectToInput.value = window.location.href;
    }

    if (initialMessage && messageElement) {
      setMessage(messageElement, status);
    }

    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      clearMessage(messageElement);

      if (!form.checkValidity()) {
        setMessage(messageElement, "invalid");
        form.reportValidity();
        return;
      }

      const formData = new FormData(form);
      const ajaxUrl = getAjaxUrl(form);

      form.classList.add("is-loading");

      if (submitButton) {
        submitButton.disabled = true;
      }

      try {
        const response = await fetch(ajaxUrl, {
          method: "POST",
          body: formData,
          credentials: "same-origin",
          headers: {
            Accept: "application/json",
          },
        });

        const result = await response.json();
        const statusFromServer = result?.data?.status || "error";
        const messageFromServer = result?.data?.message || "";

        if (!response.ok || result.success !== true) {
          setMessage(messageElement, statusFromServer, messageFromServer);
          return;
        }

        setMessage(messageElement, "success", messageFromServer);
        form.reset();

        if (pageUrlInput) {
          pageUrlInput.value = window.location.href;
        }

        if (redirectToInput) {
          redirectToInput.value = window.location.href;
        }
      } catch (error) {
        setMessage(messageElement, "error");
      } finally {
        form.classList.remove("is-loading");

        if (submitButton) {
          submitButton.disabled = false;
        }
      }
    });
  });
}
