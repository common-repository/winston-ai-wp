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

use Exception;
use Winston_AI\Engine\Base;

/**
 * AJAX as logged user
 */
class Ajax_Admin extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        if (!\apply_filters('winston_ai_winai_ajax_admin_initialize', true)) {
            return;
        }

        // For logged user
        \add_action('wp_ajax_winston_link_website', array($this, 'winston_link_website'));
        \add_action('wp_ajax_winston_verify_website', array($this, 'winston_verify_website'));
        \add_action('wp_ajax_winston_disconnect', array($this, 'winston_disconnect'));
    }

    /**
     * The method to run on ajax
     *
     * @since 1.0.0
     * @return void
     */

    public function winston_link_website()
    {
        // Sanitize and verify the nonce
        if (!isset($_POST['winston_link_website_nonce']) || !wp_verify_nonce(sanitize_text_field($_POST['winston_link_website_nonce']), 'winston_link_website_action')) {
            \wp_send_json_error(array('message' => 'Nonce verification failed.'));
            return;
        }

        $token = isset($_POST['token']) ? sanitize_text_field($_POST['token']) : '';

        if (empty($token) || !ctype_alnum($token)) {
            \wp_send_json_error(array('message' => 'Invalid token.'));
            return;
        }

        $website = get_site_url();
        $name = get_bloginfo('name');

        // Add the website url to the url
        $url = WINAI_PLATFORM_URL . '/api/wordpress/link';

        $bodyData = array(
            'name' => $name,
            'url' => $website,
        );

        $headers = array(
            'Authorization' => 'Bearer ' . esc_attr($token),
            'Content-Type'  => 'application/x-www-form-urlencoded',
        );

        // Check if website url is localhost and set $sslverify to false
        if (strpos($website, 'localhost') !== false) {
            $sslverify = false;
        } else {
            $sslverify = true;
        }

        $response = wp_remote_post($url, array(
            'body'    => http_build_query($bodyData),
            'headers' => $headers,
            'sslverify' => $sslverify,
        ));

        if (is_wp_error($response)) {
            throw new \Exception(esc_html($response->get_error_message()), esc_html($response->get_error_code()));
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $data = json_decode(wp_remote_retrieve_body($response));

        if ($status_code == 401 || $status_code == 302 || $status_code == 403) {
            update_option('winston_api_token', null);
            update_option('winston_website_id', null);
            \wp_send_json_error();
        } else {
            $premium = $data->premium;
            update_option('winston_api_token', $token);
            update_option('winston_website_id', $data->website_id);
            update_option('winston_is_premium', $premium);
            update_option('winston_cert_one', $data->cert_one_status);
            update_option('winston_cert_two', $data->cert_two_status);
            \wp_send_json_success();
        }
    }



    public function winston_verify_website()
    {
        $token = get_option('winston_api_token');
        $id = get_option('winston_website_id');

        if ($token && $id) {
            $website = get_site_url();

            // Add the website url to the url
            $url = WINAI_PLATFORM_URL . '/api/wordpress/verify';

            $bodyData = array(
                'website_id' => $id,
                'url' => $website,
            );

            $headers = array(
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/x-www-form-urlencoded',
            );

            // Check if website url is localhost and set $sslverify to false
            if (strpos($website, 'localhost') !== false) {
                $sslverify = false;
            } else {
                $sslverify = true;
            }

            $response = wp_remote_post($url, array(
                'body'    => http_build_query($bodyData),
                'headers' => $headers,
                'sslverify' => $sslverify,
            ));

            if (is_wp_error($response)) {
                throw new \Exception(esc_html($response->get_error_message()), esc_html($response->get_error_code()));
                error_log($response->get_error_message());
                \wp_send_json_error();
            }

            $status_code = wp_remote_retrieve_response_code($response);
            $result = wp_remote_retrieve_body($response);

            if ($status_code == 200) {
                $data = json_decode($result);
                $premium = $data->premium;
                $cert_one = $data->cert_one_status;
                $cert_two = $data->cert_two_status;
                $is_linked = $data->is_linked;

                update_option('winston_is_premium', $premium);
                update_option('winston_cert_one', $cert_one);
                update_option('winston_cert_two', $cert_two);

                \wp_send_json_success(array(
                    'cert_one' => $cert_one,
                    'cert_two' => $cert_two,
                    'premium' => $premium,
                    'is_linked' => $is_linked,
                ));
            } elseif ($status_code == 403) {
                // Website does not exist and user is verified
                update_option('winston_api_token', null);
                update_option('winston_website_id', null);
                update_option('winston_cert_one', null);
                update_option('winston_cert_two', null);
                \wp_send_json_error();
            } elseif ($status_code == 401) {
                // User is unauthorized
                update_option('winston_api_token', null);
                update_option('winston_website_id', null);
                \wp_send_json_error();
            }
        }
    }


    public function winston_disconnect()
    {
        update_option('winston_api_token', null);
        update_option('winston_website_id', null);
        \wp_send_json_success();
    }
}
