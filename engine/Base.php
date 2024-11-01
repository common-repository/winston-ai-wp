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

namespace Winston_AI\Engine;

/**
 * Base skeleton of the plugin
 */
class Base
{

    /**
     * @var array The settings of the plugin.
     */
    public $settings = array();

    /**
     * Initialize the class and get the plugin settings
     *
     * @return bool
     */
    public function initialize()
    {
        $this->settings = \winai_get_settings();

        return true;
    }
}
