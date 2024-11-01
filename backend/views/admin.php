<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Winston_AI
 * @author    Winston AI <support@gowinston.ai>
 * @copyright 2023 Winston AI inc.
 * @license   GPL 2.0+
 * @link      http:/gowinston.ai
 */
if (! defined('ABSPATH')) exit; // Exit if accessed directly
$isPremium = get_option('winston_is_premium');
?>

<div id="winston-signup">
    <header class="py-6 bg-white shadow-sm">
        <div class="winston-ai-container flex items-center justify-between m-auto">
            <img src="<?php echo esc_url(plugins_url('../../assets/images/winston-ai-logo.svg', __FILE__)); ?>" alt="Winston AI logo" width="160" />
            <div>
                <?php if (get_option('winston_api_token') && get_option('winston_website_id')) { ?>
                    <div class="winston-dropdown">
                        <button class="winston-status connected">
                            <span><?php esc_html_e('Connected', 'winston-ai-wp'); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" class="connected-icon">
                                <path d="m414-280 226-226-58-58-169 169-84-84-57 57 142 142ZM260-160q-91 0-155.5-63T40-377q0-78 47-139t123-78q25-92 100-149t170-57q117 0 198.5 81.5T760-520q69 8 114.5 59.5T920-340q0 75-52.5 127.5T740-160H260Zm0-80h480q42 0 71-29t29-71q0-42-29-71t-71-29h-60v-80q0-83-58.5-141.5T480-720q-83 0-141.5 58.5T280-520h-20q-58 0-99 41t-41 99q0 58 41 99t99 41Zm220-240Z" />
                            </svg>
                            <img width="24" src="<?php echo esc_url(plugins_url('../../assets/images/spinner.gif', __FILE__)); ?>" alt="Loading..." class="winston-loading-status" />

                            <div class="winston-button-arrow"></div>
                        </button>
                        <ul class="winston-dropdown-menu w-full">
                            <li>
                                <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certification/'); ?>" target="_blank">
                                    <?php esc_html_e('Certification dashboard', 'winston-ai-wp'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/websites/' . get_option('winston_website_id') . '/'); ?>" target="_blank">
                                    <?php esc_html_e('Website dashboard', 'winston-ai-wp'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="winston-logout">
                                    <?php esc_html_e('Disconnect', 'winston-ai-wp'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <button class="winston-status not-connected">
                        <span><?php esc_html_e('Not connected', 'winston-ai-wp'); ?></span>
                        <svg height="24" viewBox="0 -960 960 960" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m770-302-60-62q40-11 65-42.5t25-73.5q0-50-35-85t-85-35h-160v-80h160q83 0 141.5 58.5t58.5 141.5q0 57-29.5 105t-80.5 73zm-136-138-80-80h86v80zm158 384-736-736 56-56 736 736zm-352-224h-160q-83 0-141.5-58.5t-58.5-141.5q0-69 42-123t108-71l74 74h-24q-50 0-85 35t-35 85q0 50 35 85t85 35h160zm-120-160v-80h65l79 80z" />
                        </svg>
                    </button>
                <?php } ?>
            </div>
        </div>
    </header>

    <?php if (!get_option('winston_api_token') && !get_option('winston_website_id')) { ?>
        <div class="winston-ai-container gap-8 p-8 m-auto mt-6 md:flex flex-row border border-slate-200 bg-white shadow-sm transition-all sm:rounded-lg">
            <div class="md:w-2/3">
                <h1 class="font-bold text-3xl mb-4"><?php esc_html_e('Connect your website to Winston AI', 'winston-ai-wp'); ?></h1>
                <p class="mb-4 text-[19px]">
                    <?php esc_html_e('The only complete solution to help website get clarity on their content\'s AI detection scores and leader in online integrity management.', 'winston-ai-wp'); ?>
                </p>
                <div class="flex py-3 items-center">
                    <span class="dashicon dashicons dashicons-yes-alt text-primary-500"></span>
                    <p class="text-base ml-3 m-0">
                        <?php esc_html_e('Get a clear view of each article\'s AI detection score.', 'winston-ai-wp'); ?>
                    </p>
                </div>
                <div class="flex py-3 items-center">
                    <span class="dashicon dashicons dashicons-yes-alt text-primary-500"></span>
                    <p class="text-base ml-3 m-0">
                        <?php esc_html_e('Improve the content that sounds synthetic.', 'winston-ai-wp'); ?>
                    </p>
                </div>
                <div class="flex py-3 items-center">
                    <span class="dashicon dashicons dashicons-yes-alt text-primary-500"></span>
                    <p class="text-base ml-3 m-0">
                        <?php esc_html_e('Get a HUMN-1 certification, showcase your audience and Search Engines that your content is authentic, original and human.', 'winston-ai-wp'); ?>
                    </p>
                </div>
            </div>
            <div class="md:w-1/3 p-6 flex flex-col border border-slate-200 bg-slate-100 shadow-sm transition-all sm:rounded-lg md:mt-0 mt-6">
                <h2 class="text-xl font-semibold mb-2"><?php esc_html_e('New users', 'winston-ai-wp'); ?></h2>
                <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/integrations/wordpress-plugin'); ?>" target="_blank" class="text-center py-3 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase
				tracking-widest hover:bg-gray-700 hover:text-white active:bg-gray-900 focus:outline-none  disabled:opacity-25 transition ease-in-out duration-300 w-full">
                    <?php esc_html_e('Sign up for your free token', 'winston-ai-wp'); ?>
                </a>
                <h2 class="text-xl font-semibold mt-4 mb-2"><?php esc_html_e('Existing users', 'winston-ai-wp'); ?></h2>
                <form id="submit-token">
                    <?php wp_nonce_field('winston_link_website_action', 'winston_link_website_nonce'); ?>
                    <label for="winston-token"><?php esc_html_e('Your token', 'winston-ai-wp'); ?></label>
                    <input type="password" name="winston-token" id="winston-token" required class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full h-10 mb-3">
                    <button type="submit" class="text-center py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase
				tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-300 bg-primary-200 w-full">
                        <span class="connect-text">
                            <?php esc_html_e('Connect', 'winston-ai-wp'); ?>
                        </span>
                        <svg class="animate-spin connecting-icon h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                    <div class="winston-error mt-3"><?php esc_html_e('There was an issue connecting to the Winston AI service. Please verify your
					API key.', 'winston-ai-wp'); ?>
                    </div>
                    <div class="mt-3">
                        <?php
                        printf(
                            /* translators: 1: Terms of Service link, 2: Privacy Policy link */
                            esc_html__('By signing up, you agree to our %1$s and %2$s.', 'winston-ai-wp'),
                            '<a href="' . esc_url('https://gowinston.ai/terms-conditions/') . '" target="_blank" class="underline">' . esc_html__(
                                'Terms & Conditions',
                                'winston-ai-wp'
                            ) . '</a>',
                            '<a href="' . esc_url('https://gowinston.ai/privacy-policy/') . '" target="_blank" class="underline">' . esc_html__(
                                'Privacy Policy',
                                'winston-ai-wp'
                            ) . '</a>'
                        );
                        ?>
                    </div>
                </form>
            </div>
        </div>
</div>
<?php } else { ?>
    <div class="flex flex-col lg:flex-row mt-4 gap-4 md:my-4 winston-ai-container m-auto">
        <div class="w-full lg:w-1/3 flex flex-col items-center border-x border-t border-slate-200 bg-white shadow-sm transition-all sm:rounded-lg">
            <div class="w-full flex items-center border-b-2 border-b-gray-100 px-4 py-2">
                <div>
                    <h2 class="text-[16px] font-semibold leading-normal">
                        <?php esc_html_e('HUMN Certification', 'winston-ai-wp'); ?>
                    </h2>
                </div>
            </div>
            <div class="p-2 w-full">
                <div class="winston-score-loading my-4 !font-bold w-48 h-48 m-auto animate-pulse">
                </div>
                <div class="winston-score-none hidden my-4 !font-bold w-48 h-48 m-auto">?</div>
                <div class="cert-one my-4 !font-bold w-48 m-auto hidden">
                    <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certificate/' . get_option('winston_website_id')); ?>" target="_blank">
                        <img src="<?php echo esc_url(plugins_url('../../assets/images/humn-1-badge.svg', __FILE__)); ?>" class="w-full" alt="HUMN-1 certification" />
                    </a>
                </div>
                <div class="cert-two my-4 !font-bold w-48 m-auto hidden">
                    <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certificate/' . get_option('winston_website_id')); ?>" target="_blank">
                        <img src="<?php echo esc_url(plugins_url('../../assets/images/humn-1-plus-badge.svg', __FILE__)); ?>" class="w-full" alt="HUMN-1+ certification" />
                    </a>
                </div>
                <div class="cert-failed my-4 !font-bold w-48 m-auto hidden">
                    <div class="border-red-500 border-[12px] rounded-full w-48 h-48 flex items-center justify-center">
                        <div class="uppercase text-lg text-red-700 font-bold">
                            <?php esc_html_e('Audit failed', 'winston-ai-wp'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full border-t border-b-gray-100 px-4 py-6 xl:flex">
                <div class="hidden xl:block">
                    <div class="assessment-icon-loading animate-pulse mr-4 h-8 w-8 "></div>
                    <svg class="mr-4 h-8 w-8 text-center text-orange-500 icon-warning hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
                        </path>
                    </svg>
                    <svg class="mr-4 h-8 w-8 text-center text-red-500 icon-error hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
                        </path>
                    </svg>

                    <svg class="mr-4 h-8 w-8 text-center text-green-500 icon-success hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </div>
                <div class="w-full">
                    <p class="text-sm assessment-text-loading flex flex-col w-full gap-2">
                        <span class="h-3 bg-[#efebe9] animate-pulse w-full rounded-lg"></span>
                        <span class="h-3 bg-[#efebe9] animate-pulse w-full rounded-lg"></span>
                        <span class="h-3 bg-[#efebe9] animate-pulse w-full rounded-lg"></span>
                        <span class="h-3 bg-[#efebe9] animate-pulse w-full rounded-lg"></span>
                    </p>
                    <div class="text-sm hidden no-score">
                        <p>
                            <?php esc_html_e('The website has not been audited. Once you audit your website, your certification level will appear here.', 'winston-ai-wp'); ?>
                        </p>
                    </div>
                    <p class="text-sm hidden text-failed">
                        <?php
                        printf(
                            wp_kses(
                                /* translators: %s is the URL to the certification dashboard. */
                                __('Your website has failed the audit. Please visit your <a href="%s" target="_blank" class="underline">certification dashboard</a> for more details.', 'winston-ai-wp'),
                                array(
                                    'a' => array(
                                        'href' => array(),
                                        'target' => array(),
                                        'class' => array(),
                                    ),
                                )
                            ),
                            esc_url(WINAI_PLATFORM_URL . '/certification/')
                        );
                        ?>

                    </p>
                    <div class="text-success-one hidden">
                        <p class="text-sm mb-5">
                            <?php
                            printf(
                                wp_kses(
                                    sprintf(
                                        /* translators: 1: Certification level, 2: URL to the certification dashboard. */
                                        __('Your website has passed the audit. You have achieved the <strong>%1$s</strong> certification. Please visit your <a href="%2$s" target="_blank" class="underline">certification dashboard</a> for more details.', 'winston-ai-wp'),
                                        esc_html('HUMN-1'),
                                        esc_url(WINAI_PLATFORM_URL . '/certification/')
                                    ),
                                    array(
                                        'strong' => array(),
                                        'a' => array(
                                            'href' => array(),
                                            'target' => array(),
                                            'class' => array(),
                                        ),
                                    )
                                )
                            );
                            ?>
                        </p>
                        <p>
                            <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certificate/' . get_option('winston_website_id')); ?>" target="_blank" class="px-4 py-2 bg-primary-500 text-white rounded-[8px] hover:bg-black hover:text-white">
                                <?php esc_html_e('View certificate', 'winston-ai-wp'); ?>
                            </a>
                        </p>

                    </div>
                    <div class="hidden text-success-two">
                        <p class="text-sm mb-5">
                            <?php
                            printf(
                                wp_kses(
                                    sprintf(
                                        /* translators: %s is the URL to the certification dashboard. */
                                        __('Your website has passed the audit. You have achieved the <strong>%1$s</strong> certification. Please visit your <a href="%2$s" target="_blank" class="underline">certification dashboard</a> for more details. <br />', 'winston-ai-wp'),
                                        esc_html('HUMN-1+'),
                                        esc_url(WINAI_PLATFORM_URL . '/certification/')
                                    ),
                                    array(
                                        'strong' => array(),
                                        'a' => array(
                                            'href' => array(),
                                            'target' => array(),
                                            'class' => array(),
                                        ),
                                        'br' => array(),
                                    )
                                )
                            );
                            ?>

                        </p>
                        <p>
                            <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/certificate/' . get_option('winston_website_id')); ?>" target="_blank" class="px-4 py-2 bg-primary-500 text-white rounded-[8px] hover:bg-black hover:text-white">
                                <?php esc_html_e('View certificate', 'winston-ai-wp'); ?>
                            </a>
                        </p>
                    </div>
                </div>

            </div>
            <div class="mt-2 text-center w-full hidden no-score p-4">
                <a href=" <?php echo esc_url(WINAI_PLATFORM_URL . '/certification/'); ?>" target="_blank" class="button-primary w-full !bg-primary-400">
                    <?php esc_html_e('Get certified now', 'winston-ai-wp'); ?>
                </a>
            </div>
        </div>
        <div class="w-full lg:w-1/3 flex flex-col items-center border-x border-t border-slate-200 bg-white shadow-sm transition-all
		sm:rounded-lg">
            <div class="flex w-full items-center justify-between border-b-2 border-b-gray-100 px-4 py-2">
                <h2 class="text-[16px] font-semibold leading-normal">
                    <?php esc_html_e('Settings', 'winston-ai-wp'); ?>
                </h2>
            </div>
            <div class="p-4 h-full">

                <?php require_once plugin_dir_path(__FILE__) . 'settings.php'; ?>
            </div>
        </div>
        <?php if (!$isPremium) { ?>
            <div class="w-full lg:w-1/3 p-8 text-white flex flex-col items-center border-x border-t border-slate-200 bg-primary-600
		shadow-sm transition-all sm:rounded-lg">

                <div class="w-full">
                    <h2 class="text-white font-bold text-xl"><?php esc_html_e('Upgrade your account', 'winston-ai-wp'); ?>
                    </h2>
                </div>
                <div class="w-full grow flex flex-col justify-evenly my-6">
                    <div class="px-2 py-1 flex items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-white rounded-full border border-slate-200 mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                            </svg>
                        </div>
                        <p class="font-semibold text-[16px]">
                            <?php esc_html_e('Get more AI detection credits.', 'winston-ai-wp'); ?></p>
                    </div>
                    <div class="px-2 py-1 flex border-slate-200 ">
                        <div class="h-8 w-8 flex justify-center items-center bg-white rounded-full border border-slate-200 mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>

                        </div>
                        <p class="font-semibold text-[16px]">
                            <?php esc_html_e('Access our advanced plagiarism detection tool.', 'winston-ai-wp'); ?>
                        </p>
                    </div>
                    <div class="px-2 py-1 flex border-slate-200 items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-white rounded-full border border-slate-200 mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>

                        </div>
                        <p class="font-semibold text-[16px]"><?php esc_html_e('Add team members.', 'winston-ai-wp'); ?></p>
                    </div>
                    <div class="px-2 py-1 flex  items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-white rounded-full border border-slate-200 mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>

                        </div>
                        <p class="font-semibold text-[16px]"><?php esc_html_e('Priority support.', 'winston-ai-wp'); ?></p>
                    </div>
                </div>
                <div class=" w-full">
                    <a href="<?php echo esc_url(WINAI_PLATFORM_URL . '/plans-certification'); ?>" target="_blank" class="text-center w-full py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase
				tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-300 bg-primary-200 block">
                        <?php esc_html_e('Upgrade now', 'winston-ai-wp'); ?>
                    </a>
                </div>
            </div>
        <?php } else { ?>

            <div class="w-full lg:w-1/3 flex flex-col items-center border-x border-t border-slate-200 bg-white shadow-sm transition-all sm:rounded-lg">
                <div class="flex w-full items-center justify-between border-b-2 border-b-gray-100 px-4 py-2">
                    <div>
                        <h2 class="text-[16px] font-semibold leading-normal">
                            <?php esc_html_e('Need help?', 'winston-ai-wp'); ?>
                        </h2>
                    </div>

                </div>

                <div class="w-full grow  border-b-gray-100 px-4 py-6 flex flex-col gap-4">
                    <?php if (WINAI_WP_SUPPORT) { ?>
                        <div class="flex border-slate-200 items-center">
                            <div class="h-8 w-8 flex justify-center items-center bg-primary-500 rounded-full mr-3 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-[16px]">
                                <a href="<?php echo esc_url(WINAI_WP_SUPPORT); ?>" class="hover:text-gray-400" target="_blank">
                                    <?php esc_html_e('Wordpress.org support forum', 'winston-ai-wp'); ?>
                                </a>
                            </p>
                        </div>
                    <?php } ?>
                    <div class="flex border-slate-200 items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-primary-500 rounded-full mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>


                        </div>
                        <p class="font-semibold text-[16px]">
                            <a href="https://winston-ai.tawk.help/" target="_blank" class="hover:text-gray-400">
                                <?php esc_html_e('Visit our help center', 'winston-ai-wp'); ?>
                            </a>
                        </p>
                    </div>
                    <div class="flex border-slate-200 items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-primary-500 rounded-full mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>


                        </div>
                        <p class="font-semibold text-[16px]">
                            <a href="javascript:void(Tawk_API.toggle())" class="hover:text-gray-400">
                                <?php esc_html_e('Chat with us', 'winston-ai-wp'); ?>
                            </a>
                        </p>
                    </div>
                    <div class="flex items-center">
                        <div class="h-8 w-8 flex justify-center items-center bg-primary-500 rounded-full mr-3 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>


                        </div>
                        <p class="font-semibold text-[16px]">
                            <a href="https://gowinston.ai/contact-us/" target="_blank" class="hover:text-gray-400">
                                <?php esc_html_e('Send us a message', 'winston-ai-wp'); ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>


        <?php } ?>

    </div>
<?php } ?>