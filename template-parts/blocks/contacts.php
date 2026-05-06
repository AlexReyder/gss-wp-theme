<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('gss_contacts_option')) {
    function gss_contacts_option(string $name, mixed $default = ''): mixed
    {
        if (!function_exists('get_field')) {
            return $default;
        }

        $value = get_field($name, 'option');

        if ($value === null || $value === false || $value === '') {
            return $default;
        }

        return $value;
    }
}

$theme_uri = get_template_directory_uri();

$company_title = gss_contacts_option('gss_contacts_company_title', 'ООО “ГАРАНТСТРОЙСЕТЬ”');
$company_logo = gss_contacts_option('gss_contacts_company_logo', null);
$requisites_pdf = gss_contacts_option('gss_contacts_requisites_pdf', null);

$registration_items = gss_contacts_option('gss_contacts_registration_items', [
    [
        'label' => 'ИНН',
        'value' => '7813679783',
    ],
    [
        'label' => 'КПП',
        'value' => '781301001',
    ],
    [
        'label' => 'ОГРН',
        'value' => '1247800045734',
    ],
    [
        'label' => 'ОКПО',
        'value' => '56783273',
    ],
]);

$bank_items = gss_contacts_option('gss_contacts_bank_items', [
    [
        'label' => 'Р/с',
        'value' => '40702810055000126575',
    ],
    [
        'label' => 'Банк',
        'value' => 'СЕВЕРО-ЗАПАДНЫЙ БАНК ПАО СБЕРБАНК',
    ],
    [
        'label' => 'БИК',
        'value' => '044030653',
    ],
    [
        'label' => 'К/с',
        'value' => '30101810500000000653',
    ],
]);

$contacts_title = gss_contacts_option('gss_contacts_section_title', 'КОНТАКТЫ');
$phone = gss_contacts_option('gss_contacts_phone', '+7 (921) 903-07-86');
$phone_url = gss_contacts_option('gss_contacts_phone_url', 'tel:+79219030786');
$email = gss_contacts_option('gss_contacts_email', 'garantstroyset@mail.ru');
$working_hours = gss_contacts_option('gss_contacts_working_hours', 'с 9:00 до 18:00');

$messengers = gss_contacts_option('gss_contacts_messengers', [
    [
        'label' => 'VK',
        'url' => '#',
        'icon' => null,
    ],
    [
        'label' => 'Telegram',
        'url' => '#',
        'icon' => null,
    ],
    [
        'label' => 'Messenger',
        'url' => '#',
        'icon' => null,
    ],
]);

$sro_title = gss_contacts_option('gss_contacts_sro_title', 'СРО');
$sro_image = gss_contacts_option('gss_contacts_sro_image', null);
$sro_text = gss_contacts_option(
    'gss_contacts_sro_text',
    'Компания состоит в саморегулируемой организации. Все работы выполняются в соответствии с требованиями законодательства РФ и отраслевых стандартов.'
);

$pdf_url = is_array($requisites_pdf) && !empty($requisites_pdf['url'])
    ? $requisites_pdf['url']
    : '#';

$logo_url = is_array($company_logo) && !empty($company_logo['url'])
    ? $company_logo['url']
    : $theme_uri . '/images/contacts/logo-placeholder.svg';

$logo_alt = is_array($company_logo) && !empty($company_logo['alt'])
    ? $company_logo['alt']
    : $company_title;

$sro_image_url = is_array($sro_image) && !empty($sro_image['url'])
    ? $sro_image['url']
    : $theme_uri . '/images/contacts/sro-placeholder.jpg';

$sro_image_alt = is_array($sro_image) && !empty($sro_image['alt'])
    ? $sro_image['alt']
    : $sro_title;

$block_id = 'gss-contacts-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="gss-contacts">
    <div class="gss-contacts__container">
        <div class="gss-contacts__company">
            <h2 class="gss-contacts__company-title">
                <?php echo esc_html($company_title); ?>
            </h2>

            <?php if (is_array($registration_items) && !empty($registration_items)) : ?>
                <div class="gss-contacts__group">
                    <h3 class="gss-contacts__group-title">Регистрационные данные</h3>

                    <dl class="gss-contacts__list">
                        <?php foreach ($registration_items as $item) : ?>
                            <?php
                            $label = $item['label'] ?? '';
                            $value = $item['value'] ?? '';

                            if ($label === '' || $value === '') {
                                continue;
                            }
                            ?>

                            <div class="gss-contacts__row">
                                <dt class="gss-contacts__label"><?php echo esc_html($label); ?></dt>
                                <dd class="gss-contacts__value"><?php echo esc_html($value); ?></dd>
                            </div>
                        <?php endforeach; ?>
                    </dl>
                </div>
            <?php endif; ?>

            <?php if (is_array($bank_items) && !empty($bank_items)) : ?>
                <div class="gss-contacts__group gss-contacts__group--bank">
                    <h3 class="gss-contacts__group-title">Банковские реквизиты</h3>

                    <dl class="gss-contacts__list">
                        <?php foreach ($bank_items as $item) : ?>
                            <?php
                            $label = $item['label'] ?? '';
                            $value = $item['value'] ?? '';

                            if ($label === '' || $value === '') {
                                continue;
                            }
                            ?>

                            <div class="gss-contacts__row">
                                <dt class="gss-contacts__label"><?php echo esc_html($label); ?></dt>
                                <dd class="gss-contacts__value"><?php echo esc_html($value); ?></dd>
                            </div>
                        <?php endforeach; ?>
                    </dl>
                </div>
            <?php endif; ?>

            <a
                class="gss-contacts__download"
                href="<?php echo esc_url($pdf_url); ?>"
                <?php if ($pdf_url !== '#') : ?>
                    download
                <?php else : ?>
                    aria-disabled="true"
                <?php endif; ?>
            >
                Скачать PDF
            </a>
        </div>

        <div class="gss-contacts__info">
            <h2 class="gss-contacts__title">
                <?php echo esc_html($contacts_title); ?>
            </h2>

            <div class="gss-contacts__top">
                <div class="gss-contacts__contact-block">
                    <h3 class="gss-contacts__small-title">Телефон</h3>

                    <?php if ($phone) : ?>
                        <a class="gss-contacts__phone" href="<?php echo esc_url($phone_url); ?>">
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="gss-contacts__contact-block">
                    <h3 class="gss-contacts__small-title">Email</h3>

                    <?php if ($email) : ?>
                        <a class="gss-contacts__email" href="mailto:<?php echo esc_attr($email); ?>">
                            <?php echo esc_html($email); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="gss-contacts__middle">
                <div class="gss-contacts__work">
                    <h3 class="gss-contacts__small-title">Режим работы</h3>

                    <?php if ($working_hours) : ?>
                        <p class="gss-contacts__work-time">
                            <?php echo esc_html($working_hours); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (is_array($messengers) && !empty($messengers)) : ?>
                    <ul class="gss-contacts__socials" aria-label="Социальные сети и мессенджеры">
                        <?php foreach ($messengers as $index => $messenger) : ?>
                            <?php
                            $label = $messenger['label'] ?? '';
                            $url = $messenger['url'] ?? '#';
                            $icon = $messenger['icon'] ?? null;

                            $icon_url = is_array($icon) && !empty($icon['url'])
                                ? $icon['url']
                                : $theme_uri . '/images/contacts/social-' . ($index + 1) . '.svg';

                            if ($label === '') {
                                $label = 'Ссылка';
                            }
                            ?>

                            <li class="gss-contacts__social-item">
                                <a
                                    class="gss-contacts__social-link"
                                    href="<?php echo esc_url($url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="<?php echo esc_attr($label); ?>"
                                >
                                    <img src="<?php echo esc_url($icon_url); ?>" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="gss-contacts__sro">
                <?php if ($sro_title) : ?>
                    <h3 class="gss-contacts__sro-title">
                        <?php echo esc_html($sro_title); ?>
                    </h3>
                <?php endif; ?>

                <div class="gss-contacts__sro-content">
                    <div class="gss-contacts__sro-image">
                        <img src="<?php echo esc_url($sro_image_url); ?>" alt="<?php echo esc_attr($sro_image_alt); ?>">
                    </div>

                    <?php if ($sro_text) : ?>
                        <p class="gss-contacts__sro-text">
                            <?php echo wp_kses_post($sro_text); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="gss-contacts__logo">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
            </div>
        </div>
    </div>
</section>