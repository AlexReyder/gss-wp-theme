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

export function initLeadForms() {
  const forms = document.querySelectorAll("[data-gss-lead-form]");

  if (!forms.length) {
    return;
  }

  const params = new URLSearchParams(window.location.search);
  const status = params.get("gss_lead_status");
  const message = status ? leadFormMessages[status] : null;

  forms.forEach((form) => {
    const pageUrlInput = form.querySelector('input[name="page_url"]');
    const redirectToInput = form.querySelector('input[name="redirect_to"]');
    const messageElement = form.querySelector("[data-gss-lead-message]");

    if (pageUrlInput) {
      pageUrlInput.value = window.location.href;
    }

    if (redirectToInput) {
      redirectToInput.value = window.location.href;
    }

    if (!message || !messageElement) {
      return;
    }

    messageElement.textContent = message.text;
    messageElement.hidden = false;
    messageElement.classList.remove(
      "gss-cta__notice--success",
      "gss-cta__notice--error",
    );
    messageElement.classList.add(`gss-cta__notice--${message.type}`);
  });
}
