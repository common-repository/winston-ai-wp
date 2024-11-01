<?php

/**
 * Winston_AI
 *
 * @package   Winston_AI
 * @author    Winston AI <support@gowinston.ai>
 * @copyright 2023 Winston AI inc.
 * @license   GPL 2.0+
 * @link      http:/gowinston.ai
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

$winai_debug = new WPBP_Debug(__('Winston AI', 'winston-ai-wp'));

/**
 * Log text inside the debugging plugins.
 *
 * @param string $text The text.
 * @return void
 */
function winai_log(string $text)
{
    global $winai_debug;
    $winai_debug->log($text);
}
