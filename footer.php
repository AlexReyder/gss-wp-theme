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
<div class="gss-lead-popup" id="gss-popup-lead" data-gss-popup="lead" hidden>
    <div class="gss-lead-popup__overlay" data-gss-popup-close></div>

    <div
        class="gss-lead-popup__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gss-lead-popup-title"
        tabindex="-1"
    >
        <button
            class="gss-lead-popup__close"
            type="button"
            data-gss-popup-close
            aria-label="Закрыть popup"
        >
            <span></span>
            <span></span>
        </button>

        <div class="gss-lead-popup__media" aria-hidden="true">
            <div class="gss-lead-popup__media-pattern"></div>
            <img
                class="gss-lead-popup__person"
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/person.png'); ?>"
                alt=""
            >
        </div>

        <div class="gss-lead-popup__content">
            <div class="gss-lead-popup__intro">
                <h2 class="gss-lead-popup__title" id="gss-lead-popup-title">
                    Получите расчет стоимости работ
                </h2>

                <p class="gss-lead-popup__subtitle">
                    Оставьте заявку — мы:
                </p>

                <ul class="gss-lead-popup__benefits">
                    <li class="gss-lead-popup__benefit">
                        <span class="gss-lead-popup__benefit-icon" aria-hidden="true">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/icon-1.png'); ?>" alt="">
                        </span>
                        <span class="gss-lead-popup__benefit-text">
                            Подберем техническое решение под ваш объект
                        </span>
                    </li>

                    <li class="gss-lead-popup__benefit">
                        <span class="gss-lead-popup__benefit-icon" aria-hidden="true">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/icon-2.png'); ?>" alt="">
                        </span>
                        <span class="gss-lead-popup__benefit-text">
                            Рассчитаем стоимость и сроки выполнения
                        </span>
                    </li>

                    <li class="gss-lead-popup__benefit">
                        <span class="gss-lead-popup__benefit-icon" aria-hidden="true">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/icon-3.png'); ?>" alt="">
                        </span>
                        <span class="gss-lead-popup__benefit-text">
                            Проконсультируем по реализации проекта
                        </span>
                    </li>
                </ul>
            </div>

            <div class="gss-lead-popup__form-block">
                <h3 class="gss-lead-popup__form-title">
                    Заполните форму:
                </h3>

                <form
                    class="gss-lead-popup__form"
                    id="gss-lead-popup-form"
                    action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                    method="post"
                    data-gss-lead-form
                >
                    <input type="hidden" name="action" value="gss_submit_lead">
                    <input type="hidden" name="form_source" value="Popup">
                    <input type="hidden" name="page_url" value="">
                    <input type="hidden" name="redirect_to" value="">

                    <label class="gss-lead-popup__honeypot" aria-hidden="true">
                        <span>Компания</span>
                        <input type="text" name="company" tabindex="-1" autocomplete="off">
                    </label>

                    <div class="gss-lead-popup__notice" data-gss-lead-message hidden></div>

                    <div class="gss-lead-popup__fields">
                        <label class="gss-lead-popup__field">
                            <span class="screen-reader-text">Ваше имя</span>
                            <span class="gss-lead-popup__field-icon" aria-hidden="true">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/name.svg'); ?>" alt="">
                            </span>
                            <input
                                class="gss-lead-popup__input"
                                type="text"
                                name="name"
                                placeholder="Ваше имя"
                                autocomplete="name"
                                required
                            >
                        </label>

                        <label class="gss-lead-popup__field">
                            <span class="screen-reader-text">Телефон</span>
                            <span class="gss-lead-popup__field-icon" aria-hidden="true">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta/phone.svg'); ?>" alt="">
                            </span>
                            <input
                                class="gss-lead-popup__input"
                                type="tel"
                                name="phone"
                                placeholder="+7(__)___-__-__"
                                inputmode="tel"
                                autocomplete="tel"
                                required
                            >
                        </label>
                    </div>

                    <button class="gss-lead-popup__submit" type="submit">
                        Получить расчет
                    </button>

                    <label class="gss-lead-popup__agreement">
                        <input
                            class="gss-lead-popup__checkbox"
                            type="checkbox"
                            name="agreement"
                            value="1"
                            required
                        >
                        <span class="gss-lead-popup__agreement-text">
                            <span>Я согласен на обработку</span>
                            <a
                                class="gss-lead-popup__agreement-link"
                                href="#"
                                data-gss-popup-open="privacy"
                            >
                                персональных данных
                            </a>
                        </span>
                    </label>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="gss-cookie-banner" data-gss-cookie-banner hidden>
    <div class="gss-cookie-banner__inner">
        <span class="gss-cookie-banner__icon" aria-hidden="true">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/common/cookie.png'); ?>" alt="">
        </span>

        <p class="gss-cookie-banner__text">
            Мы используем файлы cookie для корректной работы сайта и анализа трафика.
            Продолжая пользоваться сайтом, вы соглашаетесь с их использованием и обработкой персональных данных.
        </p>

        <button
            class="gss-cookie-banner__button"
            type="button"
            data-gss-cookie-accept
        >
            Принять
        </button>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>