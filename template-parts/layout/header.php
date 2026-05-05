<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="g-container site-header__inner">
        <a class="site-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
            <?php bloginfo('name'); ?>
        </a>

        <nav class="site-header__nav" aria-label="<?php esc_attr_e('Primary menu', 'garantstroyset'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'site-header__menu',
                'fallback_cb' => false,
            ]);
            ?>
        </nav>

        <a class="site-header__phone" href="tel:+79219030786">
            +7 (921) 903-07-86
        </a>

        <button class="site-header__burger" type="button" data-menu-toggle aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="site-header__mobile" data-mobile-menu>
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'site-header__mobile-menu',
            'fallback_cb' => false,
        ]);
        ?>
    </div>
</header>