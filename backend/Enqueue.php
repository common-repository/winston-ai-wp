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

namespace Winston_AI\Backend;

use Inpsyde\Assets\Asset;
use Inpsyde\Assets\AssetManager;
use Inpsyde\Assets\Script;
use Inpsyde\Assets\Style;
use Winston_AI\Engine\Base;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        if (!parent::initialize()) {
            return;
        }

        \add_action(AssetManager::ACTION_SETUP, array($this, 'enqueue_assets'));
    }

    /**
     * Enqueue assets with Inpyside library https://inpsyde.github.io/assets
     *
     * @param \Inpsyde\Assets\AssetManager $asset_manager The class.
     * @return void
     */
    public function enqueue_assets(AssetManager $asset_manager)
    {
        // Load admin style sheet and JavaScript.
        $assets = $this->enqueue_admin_styles();

        if (!empty($assets)) {
            foreach ($assets as $asset) {
                $asset_manager->register($asset);
            }
        }

        $assets = $this->enqueue_admin_scripts();

        if (!empty($assets)) {
            foreach ($assets as $asset) {
                $asset_manager->register($asset);
            }
        }
    }

    /**
     * Register and enqueue admin-specific style sheet.
     *
     * @since 1.0.0
     * @return array
     */
    public function enqueue_admin_styles()
    {
        $admin_page = \get_current_screen();
        $styles     = array();

        if (!\is_null($admin_page) && 'toplevel_page_winston-ai-wp' === $admin_page->id) {
            $styles[0] = new Style(WINAI_TEXTDOMAIN . '-settings-style', \plugins_url('assets/build/plugin-settings.css', WINAI_PLUGIN_ABSOLUTE));
            $styles[0]->forLocation(Asset::BACKEND)->withVersion(WINAI_VERSION);

            // Enqueue DM Sans font
            $styles[1] = new Style(WINAI_TEXTDOMAIN . '-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&display=swap');
            $styles[1]->forLocation(Asset::BACKEND)->withVersion(WINAI_VERSION);
        }

        $styles[2] = new Style(WINAI_TEXTDOMAIN . '-admin-style', \plugins_url('assets/build/plugin-admin.css', WINAI_PLUGIN_ABSOLUTE));
        $styles[2]->forLocation(Asset::BACKEND)->withVersion(WINAI_VERSION);
        $styles[2]->withDependencies('dashicons');



        return $styles;
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @since 1.0.0
     * @return array
     */
    public function enqueue_admin_scripts()
    {
        $admin_page = \get_current_screen();
        $scripts    = array();

        if (!\is_null($admin_page) && 'toplevel_page_winston-ai-wp' === $admin_page->id) {
            $scripts[1] = new Script(WINAI_TEXTDOMAIN . '-settings-script', \plugins_url('assets/build/plugin-settings.js', WINAI_PLUGIN_ABSOLUTE));
            $scripts[1]->forLocation(Asset::BACKEND)->withVersion(WINAI_VERSION);
            $scripts[1]->withDependencies('jquery-ui-tabs');
            $scripts[1]->canEnqueue(
                function () {
                    return \current_user_can('manage_options');
                }
            );
            $is_connected = get_option('winston_api_token') ? 'true' : 'false';
            // Localize your script
            $scripts[1]->withLocalize(
                'myData', // Name of the object that will contain your data in JS.
                [
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('winston-ai-nonce'),
                    'is_connected' => $is_connected
                ]
            );

            // Add the Tawk.to script using appendInlineScript
            $tawk_script = "
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement('script'),
                    s0 = document.getElementsByTagName('script')[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/639bd2adb0d6371309d4ac15/1gkcatt42';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        ";
            $scripts[1]->appendInlineScript($tawk_script);
        }

        $scripts[2] = new Script(WINAI_TEXTDOMAIN . '-settings-admin', \plugins_url('assets/build/plugin-admin.js', WINAI_PLUGIN_ABSOLUTE));
        $scripts[2]->forLocation(Asset::BACKEND)->withVersion(WINAI_VERSION);
        $scripts[2]->dependencies();

        return $scripts;
    }
}
