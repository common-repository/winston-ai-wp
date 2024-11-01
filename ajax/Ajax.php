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

namespace Winston_AI\Ajax;

use Winston_AI\Engine\Base;

/**
 * AJAX in the public
 */
class Ajax extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        if (!\apply_filters('winston_ai_winai_ajax_initialize', true)) {
            return;
        }

        // For not logged user
        \add_action('wp_ajax_nopriv_your_method', array($this, 'your_method'));
    }

    /**
     * The method to run on ajax
     *
     * @since 1.0.0
     * @return void
     */
    public function your_method()
    {
        $return = array(
            'message' => 'Saved',
            'ID'      => 1,
        );

        \wp_send_json_success($return);
        // wp_send_json_error( $return );
    }
}
