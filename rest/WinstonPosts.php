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

namespace Winston_AI\Rest;

use Winston_AI\Engine\Base;

/**
 * Example class for REST
 */
class WinstonPosts extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        parent::initialize();

        \add_action('rest_api_init', array($this, 'add_winston_posts_route'));
    }

    /**
     * Examples
     *
     * @since 1.0.0
     *
     *  Make an instance of this class somewhere, then
     *  call this method and test on the command line with
     * `curl http://example.com/wp-json/wp/v2/calc?first=1&second=2`
     * @return void
     */
    public function add_winston_posts_route()
    {
        // Only an example with 2 parameters
        \register_rest_route(
            'wp/v2',
            'winston-ai',
            array(
                'methods' => \WP_REST_Server::READABLE,
                'callback' => array($this, 'get_published_posts'),
                'permission_callback' => array($this, 'check_origin')
            )
        );

        // Route for getting a single post by ID
        \register_rest_route(
            'wp/v2',
            '/winston-ai/post/(?P<id>\d+)', // This captures the numeric ID in the URL
            array(
                'methods' => \WP_REST_Server::READABLE,
                'callback' => array($this, 'get_single_post'),
                'args' => array(
                    'id' => array(
                        'validate_callback' => function ($param, $request, $key) {
                            return is_numeric($param);
                        }
                    ),
                ),
                'permission_callback' => array($this, 'check_origin')
            )
        );
    }

    public function check_origin($request)
    {
        $token = $request->get_header('Authorization'); // Get the token from the request headers
        $stored_token = get_option('winston_website_id'); // Retrieve the stored token from the options table

        if ($token === $stored_token) {
            return true; // Authorized
        } else {
            return new \WP_Error('rest_forbidden', 'You do not have permissions to access this endpoint', array('status' => 403));
        }
    }

    public function get_published_posts(\WP_REST_Request $request)
    {
        // Get page from query parameter (default is 1)
        $page_number = $request->get_param('page');
        if (empty($page_number) || !is_numeric($page_number)) {
            $page_number = 1;
        }

        // Define posts per page
        $posts_per_page = 50;

        $args = array(
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged' => $page_number
        );
        $posts = get_posts($args);
        $posts_data = array();

        foreach ($posts as $post) {
            setup_postdata($post);

            $title = html_entity_decode(get_the_title($post), ENT_QUOTES, 'UTF-8');

            $posts_data[] = array(
                'ID' => $post->ID,
                'title' => $title,
                'date' => $post->post_date,
                'link' => get_permalink($post),
            );
        }

        wp_reset_postdata();

        // Return JSON with JSON_UNESCAPED_UNICODE and JSON_UNESCAPED_SLASHES flags
        return array(
            'site_title' => get_bloginfo('name'), // Add the website title
            'posts' => $posts_data,
        );
    }
    public function get_single_post(\WP_REST_Request $request)
    {
        $post_id = $request->get_param('id'); // Get the post ID from the URL parameter

        $post = get_post($post_id); // Fetch the post by ID

        // Exit if post is not published
        if ($post->post_status !== 'publish') {
            return new \WP_Error('rest_post_not_found', 'Post not found.', array('status' => 404));
        }

        if (empty($post)) {
            return new \WP_Error('rest_post_invalid_id', 'Invalid post ID.', array('status' => 404));
        }
        // Prepare post data
        setup_postdata($post);

        // Strip shortcodes
        $content = strip_shortcodes($post->post_content);
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        // Remove comments
        $content = preg_replace('/<!--(.|\s)*?-->/', '', $content);

        $title = html_entity_decode(get_the_title($post), ENT_QUOTES, 'UTF-8');


        $post_data = array(
            'ID' => $post->ID,
            'title' => $title,
            'content' => $content,
            'date' => $post->post_date,
            'link' => get_permalink($post),
        );

        wp_reset_postdata();

        // Manually encode the response with JSON_UNESCAPED_UNICODE
        $response_data = wp_json_encode($post_data, JSON_UNESCAPED_UNICODE);

        // Create a custom response
        $response = new \WP_REST_Response();
        $response->set_status(200);
        $response->set_headers(array('Content-Type' => 'application/json; charset=utf-8'));
        $response->set_data(json_decode($response_data, true));

        return $response;
    }
}
