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

namespace Winston_AI\Integrations;

use Winston_AI\Engine\Base;

/**
 * All the CMB related code.
 */
class CMB extends Base
{

    /**
     * Initialize class.
     *
     * @since 1.0.0
     * @return void|bool
     */
    public function initialize()
    {
        parent::initialize();

        require_once WINAI_PLUGIN_ROOT . 'vendor/cmb2/init.php';
        require_once WINAI_PLUGIN_ROOT . 'vendor/cmb2-grid/Cmb2GridPluginLoad.php';
    }
}
