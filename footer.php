<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="gss-footer">
    <div class="gss-footer__container">
        <a
            class="gss-footer__link"
            href="https://gilikh.ru"
            target="_blank"
            rel="noopener noreferrer"
        >
            Сайт создан gilikh.ru
        </a>

        <button
            class="gss-footer__link gss-footer__button"
            type="button"
            data-gss-popup-open="cookies"
            aria-haspopup="dialog"
            aria-controls="gss-popup-cookies"
        >
            Политика использования файлов cookie
        </button>

        <button
            class="gss-footer__link gss-footer__button"
            type="button"
            data-gss-popup-open="privacy"
            aria-haspopup="dialog"
            aria-controls="gss-popup-privacy"
        >
            Политика обработки персональных данных
        </button>
    </div>
</footer>

<div class="gss-popup" id="gss-popup-cookies" data-gss-popup="cookies" hidden>
    <div class="gss-popup__overlay" data-gss-popup-close></div>

    <div
        class="gss-popup__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gss-popup-cookies-title"
        tabindex="-1"
    >
        <button class="gss-popup__close" type="button" data-gss-popup-close aria-label="Закрыть popup">
            ×
        </button>

        <h2 class="gss-popup__title" id="gss-popup-cookies-title">
            Политика использования файлов cookie
        </h2>

        <div class="gss-popup__content">
            <p>
                На сайте используются файлы cookie для корректной работы сайта,
                анализа посещаемости и улучшения пользовательского опыта.
            </p>

            <p>
                Продолжая использовать сайт, пользователь соглашается с использованием
                файлов cookie.
            </p>
        </div>
    </div>
</div>

<div class="gss-popup" id="gss-popup-privacy" data-gss-popup="privacy" hidden>
    <div class="gss-popup__overlay" data-gss-popup-close></div>

    <div
        class="gss-popup__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gss-popup-privacy-title"
        tabindex="-1"
    >
        <button class="gss-popup__close" type="button" data-gss-popup-close aria-label="Закрыть popup">
            ×
        </button>

        <h2 class="gss-popup__title" id="gss-popup-privacy-title">
            Политика обработки персональных данных
        </h2>

        <div class="gss-popup__content">
            <p>
                Оставляя данные на сайте, пользователь соглашается на обработку
                персональных данных в целях обратной связи, обработки входящих заявок
                и предоставления информации об услугах компании.
            </p>

            <p>
                Персональные данные не передаются третьим лицам, за исключением случаев,
                предусмотренных законодательством РФ.
            </p>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>