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

namespace Winston_AI\Frontend\Extras;

use Winston_AI\Engine\Base;

/**
 * Add custom css class to <body>
 */
class Body_Class extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        parent::initialize();

        \add_filter('body_class', array(self::class, 'add_winai_class'), 10, 1);
    }

    /**
     * Add class in the body on the frontend
     *
     * @param array $classes The array with all the classes of the page.
     * @since 1.0.0
     * @return array
     */
    public static function add_winai_class(array $classes)
    {
        $classes[] = WINAI_TEXTDOMAIN;

        return $classes;
    }
}
