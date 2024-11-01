<?php

/**
 * Winston_AI
 *
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * @package   Winston_AI
 * @author    Winston AI <support@gowinston.ai>
 * @copyright 2023 Winston AI inc.
 * @license   GPL 2.0+
 * @link      http:/gowinston.ai
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Loop for uninstall
 *
 * @return void
 */
function winai_uninstall_multisite()
{
    if (is_multisite()) {
        /** @var array<\WP_Site> $blogs */
        $blogs = get_sites();

        if (!empty($blogs)) {
            foreach ($blogs as $blog) {
                switch_to_blog((int) $blog->blog_id);
                winai_uninstall();
                restore_current_blog();
            }

            return;
        }
    }

    winai_uninstall();
}

/**
 * What happen on uninstall?
 *
 * @global WP_Roles $wp_roles
 * @return void
 */
function winai_uninstall()
{ // phpcs:ignore

    // Delete stored options
    delete_option('winston_api_token');
    delete_option('winston_website_id');
    delete_option('winston_is_premium');
    delete_option('winston_cert_one');
    delete_option('winston_cert_two');
}

winai_uninstall_multisite();
