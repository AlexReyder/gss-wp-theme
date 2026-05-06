<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('gss_get_legal_page_data')) {
    function gss_get_legal_page_data(string $slug, string $fallback_title): array
    {
        $page = get_page_by_path($slug, OBJECT, 'page');

        if (!$page instanceof WP_Post) {
            return [
                'title' => $fallback_title,
                'content' => '<p>Контент документа пока не добавлен.</p>',
            ];
        }

        return [
            'title' => get_the_title($page),
            'content' => apply_filters('the_content', $page->post_content),
        ];
    }
}

$cookie_policy = gss_get_legal_page_data(
    'politika-cookie',
    'Политика использования файлов cookie'
);

$privacy_policy = gss_get_legal_page_data(
    'politika-personalnyh-dannyh',
    'Политика обработки персональных данных'
);
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

<div class="gss-policy-popup" id="gss-popup-cookies" data-gss-popup="cookies" hidden>
    <div class="gss-policy-popup__overlay" data-gss-popup-close></div>

    <div
        class="gss-policy-popup__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gss-popup-cookies-title"
        tabindex="-1"
    >
        <button
            class="gss-policy-popup__close"
            type="button"
            data-gss-popup-close
            aria-label="Закрыть popup"
        >
            <span></span>
            <span></span>
        </button>

        <div class="gss-policy-popup__content" id="gss-popup-cookies-title">
            <?php echo wp_kses_post($cookie_policy['content']); ?>
        </div>
    </div>
</div>

<div class="gss-policy-popup" id="gss-popup-privacy" data-gss-popup="privacy" hidden>
    <div class="gss-policy-popup__overlay" data-gss-popup-close></div>

    <div
        class="gss-policy-popup__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gss-popup-privacy-title"
        tabindex="-1"
    >
        <button
            class="gss-policy-popup__close"
            type="button"
            data-gss-popup-close
            aria-label="Закрыть popup"
        >
            <span></span>
            <span></span>
        </button>

        <div class="gss-policy-popup__content" id="gss-popup-privacy-title">
            <?php echo wp_kses_post($privacy_policy['content']); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>