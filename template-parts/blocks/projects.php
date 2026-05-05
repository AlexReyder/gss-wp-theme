<?php

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('gss_projects_title', 'option');
$text = get_field('gss_projects_text', 'option');
$gallery = get_field('gss_projects_gallery', 'option');

if (!$title) {
    $title = 'Опыт реализации объектов различной сложности';
}

if (!$text) {
    $text = 'Выполняем работы по строительству и монтажу инженерных систем на объектах различного назначения — от локальных участков до протяжённых сетей.';
}

if (!is_array($gallery) || empty($gallery)) {
    $gallery = [];

    for ($i = 1; $i <= 21; $i++) {
        $gallery[] = [
            'url' => '/images/projects/' . $i . '.jpg',
            'alt' => '',
            'sizes' => [
                'large' => '/images/projects/' . $i . '.jpg',
            ],
        ];
    }
}

$block_id = 'gss-projects-' . ($block['id'] ?? uniqid());
?>

<section id="<?php echo esc_attr($block_id); ?>" class="gss-projects">
    <div class="gss-projects__container">
        <header class="gss-projects__header">
            <h2 class="gss-projects__title">
                <?php echo esc_html($title); ?>
            </h2>

            <?php if ($text) : ?>
                <p class="gss-projects__text">
                    <?php echo wp_kses_post($text); ?>
                </p>
            <?php endif; ?>
        </header>

        <div class="gss-projects__grid" data-projects-gallery>
            <?php foreach ($gallery as $index => $image) : ?>
                <?php
                $image_url = $image['sizes']['large'] ?? $image['url'] ?? '';
                $full_url = $image['url'] ?? $image_url;
                $alt = $image['alt'] ?? '';

                if (!$image_url) {
                    continue;
                }
                ?>

                <a
                    class="gss-projects__item"
                    href="<?php echo esc_url($full_url); ?>"
                    data-projects-lightbox
                    data-projects-index="<?php echo esc_attr((string) $index); ?>"
                    aria-label="<?php echo esc_attr('Открыть изображение проекта ' . ($index + 1)); ?>"
                >
                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($alt); ?>"
                        loading="lazy"
                    >
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>