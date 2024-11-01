<?php

/**
 * Winston_AI Plugin
 *
 * @package   Winston_AI
 * @author    Winston AI <support@gowinston.ai>
 * @copyright 2023 Winston AI Inc.
 * @license   GPL 2.0+
 * @link      http://gowinston.ai
 */

/**
 * Retrieves plugin settings in a filterable manner.
 *
 * @since 1.0.0
 * @return array Plugin settings array.
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

function winai_get_settings()
{
    return apply_filters('winai_get_settings', get_option(WINAI_TEXTDOMAIN . '-settings', []));
}

/**
 * Retrieves badge display settings.
 *
 * @since 1.0.0
 * @return array Badge display settings array.
 */
function winai_get_display_badge_settings()
{
    $settings_key = WINAI_TEXTDOMAIN . '-settings';
    $defaults = array(
        'display_badge' => false,
        'badge_style' => 'light',
        'badge_location' => 'below_posts',
    );

    $badge_settings = array(
        'display_badge' => cmb2_get_option($settings_key, '_winston_display_badge', $defaults['display_badge']),
        'badge_style' => cmb2_get_option($settings_key, '_winston_badge_style', $defaults['badge_style']),
        'badge_location' => cmb2_get_option($settings_key, '_winston_badge_location', $defaults['badge_location']),
    );

    return $badge_settings;
}

/**
 * Appends Winston AI badge based on settings.
 *
 * @param string $content The content of the post.
 * @return string Modified content with or without the Winston badge.
 */
function winai_append_badge($content)
{
    // Check if we are on a single post page
    if (!is_single() || get_post_type() !== 'post') {
        return $content; // Exit if not a single post
    }
    $badge_settings = winai_get_display_badge_settings();
    $site_id = get_option('winston_website_id');
    $winston_cert_one = get_option('winston_cert_one');
    $winston_cert_two = get_option('winston_cert_two');

    if (!$badge_settings['display_badge']) {
        return $content; // Exit if badge not to be displayed.
    }

    // Check if the site has a cert one or cert two that has 'success', if not return
    if ($winston_cert_one !== 'success' && $winston_cert_two !== 'success') {
        return $content;
    }


    $badge_html = sprintf('<div class="winston-badge-%s"></div>', esc_attr($badge_settings['badge_style']));

    if ('before_post' === $badge_settings['badge_location']) {
        $content = $badge_html . $content;
    } else {
        $content .= $badge_html;
    }

    // Enqueue external script if badge is displayed.
    wp_enqueue_script('winston-ai-badge-script', WINAI_BADGE_ASSETS . '/' . $site_id . '.js', array(), WINAI_VERSION, true);

    return $content;
}
add_filter('the_content', 'winai_append_badge');

function winai_badge_shortcode($atts)
{
    // Extract the shortcode attributes
    $atts = shortcode_atts(array(
        'style' => 'light',
    ), $atts, 'humn1_badge');

    $badge_settings = winai_get_display_badge_settings();
    $site_id = get_option('winston_website_id');
    $winston_cert_one = get_option('winston_cert_one');
    $winston_cert_two = get_option('winston_cert_two');

    if (!$badge_settings['display_badge']) {
        return ''; // Exit if badge not to be displayed
    }

    // Check if the site has a cert one or cert two that has 'success', if not return
    if ($winston_cert_one !== 'success' && $winston_cert_two !== 'success') {
        return ''; // Exit if no successful certificates
    }

    // Set the badge style from the shortcode attribute
    $badge_style = esc_attr($atts['style']);

    $badge_html = sprintf('<div class="winston-badge-%s"></div>', $badge_style);

    // Enqueue external script if badge is displayed
    wp_enqueue_script('winston-ai-badge-script', WINAI_BADGE_ASSETS . '/' . $site_id . '.js', array(), WINAI_VERSION, true);

    return $badge_html;
}
add_shortcode('humn1_badge', 'winai_badge_shortcode');
