<?php
/*
 * Retrieve these settings on front end in either of these ways:
 *   $my_setting = cmb2_get_option( WINAI_TEXTDOMAIN . '-settings', 'some_setting', 'default' );
 *   $my_settings = get_option( WINAI_TEXTDOMAIN . '-settings', 'default too' );
 * CMB2 Snippet: https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 */
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>

<?php
$cmb = new_cmb2_box(
    array(
        'id'         => WINAI_TEXTDOMAIN . '_options',
        'hookup'     => false,
        'show_on'    => array('key' => 'options-page', 'value' => array(WINAI_TEXTDOMAIN)),
        'show_names' => true,
    )
);

$cmb->add_field(
    array(
        'name' => __('Display badge', 'winston-ai-wp'),
        'desc' => __('Display badge if website has passed certification.', 'winston-ai-wp'),
        'id' => '_winston_display_badge',
        'type' => 'checkbox',
        'before_row' => 'winai_cmb_before_row_cb',
    )
);

$cmb->add_field(
    array(
        'name' => __('Badge style', 'winston-ai-wp'),
        'id' => '_winston_badge_style',
        'type' => 'select',
        'show_option_none' => false,
        'options' => array(
            'light' => __('Light', 'winston-ai-wp'),
            'dark' => __('Dark', 'winston-ai-wp'),
        ),
    )
);
$cmb->add_field(
    array(
        'name' => __('Badge location', 'winston-ai-wp'),
        'id' => '_winston_badge_location',
        'type' => 'select',
        'show_option_none' => false,
        'options' => array(
            'below_post' => __('Below blog posts', 'winston-ai-wp'),
            'before_post' => __('Before blog posts', 'winston-ai-wp'),
            'none' => __('None', 'winston-ai-wp'),
        ),
        'after_row' => 'winai_cmb_after_row_cb',
    )
);

function winai_cmb_before_row_cb($field_args, $field)
{ ?>
    <div class="mb-5">
        <a class="!mb-2 w-full button-primary !flex !justify-center items-center" href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certification/'); ?>" target="_blank">
            <span><?php esc_html_e('Certification dashboard', 'winston-ai-wp'); ?></span>
            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"></path>
            </svg>

        </a>
        <a class="!mb-2 w-full button-primary !flex !justify-center items-center" href="<?php echo esc_url(WINAI_PLATFORM_URL . '/websites/' . get_option('winston_website_id') . '/'); ?>" target="_blank">
            <?php esc_html_e('Website dashboard', 'winston-ai-wp'); ?>
            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"></path>
            </svg>
        </a>
    </div>
<?php
}

function winai_cmb_after_row_cb($field_args, $field)
{ ?>
    <div class="cmb-row cmb-type-select cmb2-id--winston-badge-location" data-fieldtype="select">
        <div class="cmb-th">
            <label><?php esc_html_e('Custom Badge location', 'winston-ai-wp'); ?></label>
        </div>
        <div class="cmb-td">
            <?php esc_html_e('Add the following shortcode (with style "light" or "dark"):', 'winston-ai-wp'); ?> <code>[humn1_badge style="light"]</code>
        </div>
    </div>
<?php
}

cmb2_metabox_form(WINAI_TEXTDOMAIN . '_options', WINAI_TEXTDOMAIN . '-settings');
?>