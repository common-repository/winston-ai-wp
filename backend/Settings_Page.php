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

use Winston_AI\Engine\Base;

/**
 * Create the settings page in the backend
 */
class Settings_Page extends Base
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

        // Add the options page and menu item.
        \add_action('admin_menu', array($this, 'add_plugin_admin_menu'));

        $realpath        = (string) \realpath(__DIR__);
        $plugin_basename = \plugin_basename(\plugin_dir_path($realpath) . WINAI_TEXTDOMAIN . '.php');
        \add_filter('plugin_action_links_' . $plugin_basename, array($this, 'add_action_links'));
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since 1.0.0
     * @return void
     */
    public function add_plugin_admin_menu()
    {
        /*
		 * Add a settings page for this plugin to the Settings menu
		 *
		 * @TODO:
		 *
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities

		add_options_page( __( 'Page Title', WINAI_TEXTDOMAIN ), WINAI_NAME, 'manage_options', WINAI_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ) );
		 *
		 */
        /*
		 * Add a settings page for this plugin to the main menu
		 *
		 */
        \add_menu_page(\__('Winston AI Settings', 'winston-ai-wp'), WINAI_NAME, 'manage_options', 'winston-ai-wp', array($this, 'display_plugin_admin_page'), '', 50);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since 1.0.0
     * @return void
     */
    public function display_plugin_admin_page()
    {
        include_once WINAI_PLUGIN_ROOT . 'backend/views/admin.php';
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since 1.0.0
     * @param array $links Array of links.
     * @return array
     */
    public function add_action_links(array $links)
    {
        return \array_merge(
            array(
                'settings' => '<a href="' . \admin_url('options-general.php?page=' . WINAI_TEXTDOMAIN) . '">' . \__('Settings', 'winston-ai-wp') . '</a>',
            ),
            $links
        );
    }
}
