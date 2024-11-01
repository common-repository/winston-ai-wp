<?php

/**
 * @package   Winston_AI
 * @author    Winston AI <support@gowinston.ai>
 * @copyright 2024 Winston AI inc.
 * @license   GPL 2.0+
 * @link      http:/gowinston.ai
 *
 * Plugin Name:     AI Website Scanner & Human Certification by Winston AI
 * Plugin URI:      https://gowinston.ai
 * Description:     Helps any Wordpress site build trust with their audience by scanning their website’s entire content to find instances of AI generated content. 
 * Version:         0.0.2
 * Author:          Winston AI
 * Author URI:      http:/gowinston.ai
 * Text Domain:     winston-ai-wp
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.4
 * WordPress-Plugin-Boilerplate-Powered: v3.3.0
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}

// Check if this is a local installation


define('WINAI_VERSION', '0.0.2');
define('WINAI_TEXTDOMAIN', 'winston-ai-wp');
define('WINAI_BADGE_ASSETS', 'https://badges.gowinston.ai');
define('WINAI_PLATFORM_URL', 'https://app.gowinston.ai');
define('WINAI_NAME', 'Winston AI');
define('WINAI_PLUGIN_ROOT', plugin_dir_path(__FILE__));
define('WINAI_PLUGIN_ABSOLUTE', __FILE__);
define('WINAI_MIN_PHP_VERSION', '7.4');
define('WINAI_WP_VERSION', '5.3');
define('WINAI_WP_SUPPORT', null);

add_action(
    'init',
    static function () {
        load_plugin_textdomain(WINAI_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
);

if (version_compare(PHP_VERSION, WINAI_MIN_PHP_VERSION, '<=')) {
    add_action(
        'admin_init',
        static function () {
            deactivate_plugins(plugin_basename(__FILE__));
        }
    );
    add_action(
        'admin_notices',
        static function () {
            echo wp_kses_post(
                sprintf(
                    '<div class="notice notice-error"><p>%s</p></div>',
                    __('"Winston AI" requires PHP 7.4 or newer.', 'winston-ai-wp')
                )
            );
        }
    );

    // Return early to prevent loading the plugin.
    return;
}

$winston_ai_libraries = require WINAI_PLUGIN_ROOT . 'vendor/autoload.php'; //phpcs:ignore

require_once WINAI_PLUGIN_ROOT . 'functions/functions.php';
require_once WINAI_PLUGIN_ROOT . 'functions/debug.php';


$requirements = new \Micropackage\Requirements\Requirements(
    'Winston AI',
    array(
        'php'            => WINAI_MIN_PHP_VERSION,
        'php_extensions' => array('mbstring'),
        'wp'             => WINAI_WP_VERSION,
    )
);

if (!$requirements->satisfied()) {
    $requirements->print_notice();

    return;
}


if (!wp_installing()) {
    register_activation_hook(WINAI_TEXTDOMAIN . '/' . WINAI_TEXTDOMAIN . '.php', array(new \Winston_AI\Backend\ActDeact, 'activate'));
    register_deactivation_hook(WINAI_TEXTDOMAIN . '/' . WINAI_TEXTDOMAIN . '.php', array(new \Winston_AI\Backend\ActDeact, 'deactivate'));
    add_action(
        'plugins_loaded',
        static function () use ($winston_ai_libraries) {
            new \Winston_AI\Engine\Initialize($winston_ai_libraries);
        }
    );
}
