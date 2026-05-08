<?php
/**
 * Garantstroyset theme functions.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('GARANT_THEME_VERSION', '1.0.0');
define('GARANT_THEME_DIR', get_template_directory());
define('GARANT_THEME_URI', get_template_directory_uri());

require_once GARANT_THEME_DIR . '/inc/core/helpers.php';
require_once GARANT_THEME_DIR . '/inc/core/setup.php';
require_once GARANT_THEME_DIR . '/inc/core/enqueue.php';
require_once GARANT_THEME_DIR . '/inc/core/menus.php';
require_once GARANT_THEME_DIR . '/inc/core/cleanup.php';
require_once GARANT_THEME_DIR . '/inc/core/patterns.php';
require_once GARANT_THEME_DIR . '/inc/core/legal-pages.php';

require_once GARANT_THEME_DIR . '/inc/acf/blocks.php';
require_once GARANT_THEME_DIR . '/inc/acf/fields.php';
require_once GARANT_THEME_DIR . '/inc/acf/options.php';
require_once GARANT_THEME_DIR . '/inc/acf/projects.php';
require_once GARANT_THEME_DIR . '/inc/acf/leads.php';
require_once GARANT_THEME_DIR . '/inc/acf/contacts.php';
require_once GARANT_THEME_DIR . '/inc/acf/header.php';

require_once GARANT_THEME_DIR . '/inc/forms/lead-form-handler.php';