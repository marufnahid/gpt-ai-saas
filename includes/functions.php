<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once WPAISAAS_PLUGIN_DIR_PATH . 'vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

/**
 * Display the navigation items based on the user's role
 *
 * @return string
 */
function wpaisaas_display_navigation_based_on_role()
{
    global $wp;
    $current_page_url = home_url($wp->request);

    $navigation_items = array(
        'dashboard' => 'Dashboard',
        'conversation' => 'Conversation',
        'hashtag' => 'Hashtag Generation',
        'code' => 'Code Generation',
        'image' => 'Image Generation (Pro)',
        'music' => 'Music Generation (Pro)',
    );

    if (!is_user_logged_in()) {
        echo '<ul class="navbar-nav special-nav">';
        foreach ($navigation_items as $page_slug => $nav_text) {
            echo '<li class="nav-item">';
            if (rtrim(wpaisaas_get_page_link($page_slug), '/') !== $current_page_url) {
                echo '<a class="nav-link" href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '">';
            } else {
                echo '<a class="nav-link active" href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '">';
            }
            echo '<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">';

            echo match ($page_slug) {
                'dashboard' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/dashboard.svg" alt="Conversation Icon" width="20" height="20">',
                'conversation' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/conversation.svg" alt="Conversation Icon" width="20" height="20">',
                'hashtag' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/hashtag.svg" alt="Hashtag Icon" width="20" height="20">',
                'code' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/code.svg" alt="Code Icon" width="20" height="20">',
                'image' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/image.svg" alt="Image Icon" width="20" height="20">',
                'music' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/music.svg" alt="Music Icon" width="20" height="20">',
                default => '<i class="fas fa-tachometer-alt text-dark"></i>',
            };
            echo '</div>';
            echo '<span class="nav-link-text ms-1">' . esc_html($nav_text) . '</span>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        $current_user = wp_get_current_user();
        $user_role = $current_user->roles[0];

        $option = wpaisaas_get_option('pricing_table');

        $features = array();

        if (!empty($option)) {
            // Define which features correspond to each role
            $features_by_role = array(
                'subscriber' => array(),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_free'])) => esc_html($option['plan_title_free']),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_pro'])) => esc_html($option['plan_title_pro']),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_enterprise'])) => esc_html($option['plan_title_enterprise']),
            );
            // Get the features for the user's role
            $features = $features_by_role[$user_role] ?? array();
        }

        echo '<ul class="navbar-nav special-nav">';
        foreach ($navigation_items as $page_slug => $nav_text) {
            if ($page_slug === 'dashboard' || $user_role === 'super_admin' || $user_role === 'administrator' || $user_role === 'editor' || array_key_exists($page_slug, $features['enabled'])) {
                echo '<li class="nav-item">';
                if (rtrim(wpaisaas_get_page_link($page_slug), '/') !== $current_page_url) {
                    echo '<a class="nav-link" href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '">';
                } else {
                    echo '<a class="nav-link active" href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '">';
                }
                echo '<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">';

                echo match ($page_slug) {
                    'dashboard' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/dashboard.svg" alt="Conversation Icon" width="20" height="20">',
                    'conversation' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/conversation.svg" alt="Conversation Icon" width="20" height="20">',
                    'hashtag' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/hashtag.svg" alt="Hashtag Icon" width="20" height="20">',
                    'code' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/code.svg" alt="Code Icon" width="20" height="20">',
                    'image' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/image.svg" alt="Image Icon" width="20" height="20">',
                    'music' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/music.svg" alt="Music Icon" width="20" height="20">',
                    default => '<i class="fas fa-tachometer-alt text-dark"></i>',
                };
                echo '</div>';
                echo '<span class="nav-link-text ms-1">' . esc_html($nav_text) . '</span>';
                echo '</a>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }
}

/**
 * Display the features based on the user's role
 *
 * @return string
 */
function wpaisaas_display_features_based_on_role()
{
    $navigation_items = array(
        'dashboard' => 'Dashboard',
        'conversation' => 'Conversation',
        'hashtag' => 'Hashtag Generation',
        'code' => 'Code Generation',
        'image' => 'Image Generation (Pro)',
        'music' => 'Music Generation (Pro)',
    );

    if (!is_user_logged_in()) {
        echo '<div class="row">';
        foreach ($navigation_items as $page_slug => $nav_text) {
            echo '<div class="col-md-12 mb-4">';
            echo '<div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">';
            echo match ($page_slug) {
                'dashboard' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/dashboard.svg" alt="Conversation Icon" width="20" height="20">',
                'conversation' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/conversation.svg" alt="Conversation Icon" width="20" height="20">',
                'hashtag' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/hashtag.svg" alt="Hashtag Icon" width="20" height="20">',
                'code' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/code.svg" alt="Code Icon" width="20" height="20">',
                'image' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/image.svg" alt="Image Icon" width="20" height="20">',
                'music' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/music.svg" alt="Music Icon" width="20" height="20">',
                default => '<i class="fas fa-tachometer-alt text-dark"></i>',
            };
            echo '<h6 class="mb-0 ml-2">' . esc_html(ucwords($nav_text)) . '</h6>';
            echo '<a href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '" class="ms-auto text-dark cursor-pointer"><i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i></a>';
            echo '</div></div>';
        }
        echo '</div>';
    } else {

        $current_user = wp_get_current_user();
        $user_role = $current_user->roles[0]; // Get the first user role

        $option = wpaisaas_get_option('pricing_table');

        $features = array();
        if (!empty($option)) {
            // Define which features correspond to each role
            $features_by_role = array(
                'subscriber' => array(),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_free'])) => esc_html($option['plan_title_free']),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_pro'])) => esc_html($option['plan_title_pro']),
                'wpaisaas_' . strtolower(esc_html($option['plan_title_enterprise'])) => esc_html($option['plan_title_enterprise']),
            );
            $features = $features_by_role[$user_role] ?? array();
        }
        // Define the navigation items and their associated features

        echo '<div class="row">';
        foreach ($navigation_items as $page_slug => $nav_text) {
            if ($page_slug === 'dashboard' || $user_role === 'super_admin' || $user_role === 'administrator' || $user_role === 'editor' || array_key_exists($page_slug, $features['enabled'])) {
                echo '<div class="col-md-12 mb-4">';
                echo '<div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">';
                echo match ($page_slug) {
                    'dashboard' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/dashboard.svg" alt="Conversation Icon" width="20" height="20">',
                    'conversation' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/conversation.svg" alt="Conversation Icon" width="20" height="20">',
                    'hashtag' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/hashtag.svg" alt="Hashtag Icon" width="20" height="20">',
                    'code' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/code.svg" alt="Code Icon" width="20" height="20">',
                    'image' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/image.svg" alt="Image Icon" width="20" height="20">',
                    'music' => '<img src="' . esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/img/logos/music.svg" alt="Music Icon" width="20" height="20">',
                    default => '<i class="fas fa-tachometer-alt text-dark"></i>',
                };
                echo '<h6 class="mb-0 ml-2">' . esc_html(ucwords($nav_text)) . '</h6>';
                echo '<a href="' . esc_url(wpaisaas_get_page_link($page_slug)) . '" class="ms-auto text-dark cursor-pointer"><i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i></a>';
                echo '</div></div>';
            }
        }
        echo '</div>';
    }
}

/**
 * Redirect users to the profile page after login
 * if they have one of the specified roles
 * @return void
 */
function wpaisaas_redirect_to_profile_page()
{
    // Check if user is logged in
    if (is_user_logged_in()) {
        // Get current user object
        $current_user = wp_get_current_user();
        $prefix = "wpaisaas_";
        $option = wpaisaas_get_option('pricing_table');

        // Check if user has one of the specified roles
        if (!empty($option)) {
            $allowed_roles = array('subscriber', $prefix . strtolower(esc_html($option['plan_title_free'])), $prefix . strtolower(esc_html($option['plan_title_pro'])), $prefix . strtolower(esc_html($option['plan_title_enterprise'])));
            $user_roles = $current_user->roles;

            $intersect_roles = array_intersect($user_roles, $allowed_roles);

            // If user has one of the allowed roles, redirect to custom profile page
            if (!empty($intersect_roles)) {
                wp_redirect(esc_url(wpaisaas_get_page_link('profile'))); // Redirect to profile page
                exit;
            }
        }
    }
}

add_action('load-profile.php', 'wpaisaas_redirect_to_profile_page');

function wpaisaas_get_user_ip_address()
{
    // Check if the IP address is set by the server
    if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return '';
}

if (!function_exists('csf_add_my_custom_css')) {
    function csf_add_my_custom_css()
    {
        wp_enqueue_style('csf-custom-css', get_template_directory_uri() . '/includes/framework/assets/css/custom.css', array(), '1.0.0', 'all');

    }
    add_action('csf/enqueue', 'csf_add_my_custom_css');
}

/**
 * @param $template_name
 * @return false|string|void
 */
function wpaisaas_get_page_link($template_name)
{
    $_template_name = $template_name . "-template.php";
    $page = get_posts(array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => $_template_name,
        'posts_per_page' => 1,
    ));

    $page_url = "";
    if ($page) {
        $page_url = get_permalink($page[0]->ID);
    }
    return $page_url;
}

/**
 * Get the option value from the database
 * @param string $option
 * @param null $default
 * @return mixed|null
 */
if (!function_exists('wpaisaas_get_option')) {
    function wpaisaas_get_option($option = '', $default = null)
    {
        $options = get_option('wpaisaas_'); // Attention: Set your unique id of the framework
        return (isset($options[$option])) ? $options[$option] : $default;
    }
}

/**
 * Maximum token calculation
 * @param $command
 * @param string $selected_model
 * @return int
 */
function wpaisaas_get_max_token($command, $selected_model = '')
{
    // Skip calculation for specific model
    if ($selected_model === 'gpt-3.5-turbo-16k') {
        return wpaisaas_get_option('wpwand_max_token', 3600);
    }

    $total_word = str_word_count($command);
    $total_token = $total_word * 1.2;
    $max_token = wpaisaas_get_option('wpwand_max_token', 3600);

    $sum_of_tokens = $total_token + $max_token;
    $excess = $sum_of_tokens - 4000;

    if ($excess > 0) {
        // Subtract the excess from max_token
        $max_token -= $excess;
    }
    // Return the adjusted max_token value
    return $max_token;
}

/**
 * @param $prompt
 * @param $number_of_result
 * @param $args
 * @return bool|string
 * @throws Exception
 */
function wpaisaas_prompt($prompt, $number_of_result = 1, $args = [])
{
    $selected_model = $args['model'] ?? esc_html(wpaisaas_get_option('chat_model', 'gpt-3.5-turbo-0125'));
    $biz_details = !empty($args['biz_details']) ? "Write this based on our business details, which this: " . $args['biz_details'] : "Write this based on our business details, which this: " . esc_html(wpaisaas_get_option('biz_details', ''));
    $targated_customer = !empty($args['targated_customer']) ? "Write this focusing the benefits of our targeted customer, which this:" . $args['targated_customer'] : "Write this focusing the benefits of our targeted customer, which this:" . esc_html(wpaisaas_get_option('target_audience', ''));
    // $ai_character = isset($args['ai_character']) && !empty($args['ai_character']) ?  $args['ai_character'] : '';
    $language = !empty($args['language']) ? $args['language'] : esc_html(wpaisaas_get_option('language', 'English'));
    $davinci_command = !empty($args['custom_command']) ? $prompt . $args['custom_command'] . "You must write in " . $language . $biz_details . $targated_customer : " $prompt . 'You must write in' . $language.  $biz_details . $targated_customer";
    $temperature = $args['temperature'] ?? esc_html(wpaisaas_get_option('temperature', 1.0));
    $max_tokens = $args['max_tokens'] ?? esc_html(wpaisaas_get_max_token($davinci_command, $selected_model));
    $frequency_penalty = $args['frequency_penalty'] ?? esc_html(wpaisaas_get_option('frequency_penalty', 0));
    $presence_penalty = $args['presence_penalty'] ?? esc_html(wpaisaas_get_option('presence_penalty', 0));

    $api_key = wpaisaas_get_option('openai_api_key');
    $openAI = new OpenAi(esc_html($api_key));

    if ('gpt-3.5-turbo' == $selected_model || 'gpt-3.5-turbo-16k' == $selected_model || 'gpt-3.5-turbo-0125' == $selected_model || 'gpt-4' == $selected_model) {
        $complete = $openAI->chat([
            'model' => $selected_model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "$prompt You must write in $language . $biz_details . $targated_customer"
                ]
            ],
            'n' => max($number_of_result, 1),
            'temperature' => (int)$temperature,
            'max_tokens' => (int)$max_tokens,
            'frequency_penalty' => (int)$frequency_penalty,
            'presence_penalty' => (int)$presence_penalty,
        ]);
    } else {
        $complete = $openAI->completion([
            'n' => max($number_of_result, 1),
            'model' => $selected_model, // $selected_model,
            'prompt' => $davinci_command,
            'temperature' => (int)$temperature,
            'max_tokens' => (int)$max_tokens,
            'frequency_penalty' => (int)$frequency_penalty,
            'presence_penalty' => (int)$presence_penalty,
        ]);
    }
    return $complete;
}

/**
 * chat api request
 * @return void
 * @throws Exception
 */
function wpaisaas_chat_api_request()
{
    if (!isset($_POST['input_text'])) {
        wp_send_json_error('Input text is required');
    }

    $inputText = sanitize_text_field($_POST['input_text']);
    $nonce = sanitize_text_field($_POST['nonce']);
    if (!wp_verify_nonce($nonce, 'conversation_nonce_action')) {
        wp_send_json_error('Invalid nonce');
    }

    $text = wpaisaas_prompt($inputText);

    wp_send_json_success(($text));
}

add_action('wp_ajax_chat_api_request', 'wpaisaas_chat_api_request');
add_action('wp_ajax_nopriv_chat_api_request', 'wpaisaas_chat_api_request');

function wpaisaas_code_api_request()
{
    if (!isset($_POST['input_text'])) {
        wp_send_json_error('Input text is required');
    }

    $inputText = sanitize_text_field($_POST['input_text']);
    $language = sanitize_text_field($_POST['language']);
    $nonce = sanitize_text_field($_POST['nonce']);
    if (!wp_verify_nonce($nonce, 'code_nonce_action')) {
        wp_send_json_error('Invalid nonce');
    }

    $text = wpaisaas_prompt($inputText, 1, array(
        'custom_command' => 'Write code with/for ' . $language . '. You must programming language will be ' . $language,
    ));

    wp_send_json_success($text);
}

add_action('wp_ajax_code_api_request', 'wpaisaas_code_api_request');
add_action('wp_ajax_nopriv_code_api_request', 'wpaisaas_code_api_request');

function wpaisaas_hashtag_api_request()
{
    if (!isset($_POST['input_text'])) {
        wp_send_json_error('Input text is required');
    }

    $inputText = sanitize_text_field($_POST['input_text']);
    $language = sanitize_text_field($_POST['language']);
    $keywords = sanitize_text_field($_POST['keywords']);
    $nonce = sanitize_text_field($_POST['nonce']);
    if (!wp_verify_nonce($nonce, 'hashtag_nonce_action')) {
        wp_send_json_error('Invalid nonce');
    }

    $text = wpaisaas_prompt($inputText, 1, array(
        'custom_command' => "You must generate at least 10 hashtag with latest or tending hashtag . Where language is $language must and  $keywords",
    ));

    wp_send_json_success(($text));
}

add_action('wp_ajax_hashtag_api_request', 'wpaisaas_hashtag_api_request');
add_action('wp_ajax_nopriv_hashtag_api_request', 'wpaisaas_hashtag_api_request');

/**
 * Hide the admin bar based on the user's role
 *
 * @param bool $show
 * @return bool
 */
function wpaisaas_hide_admin_bar_based_on_role($show)
{
    // Get the current user object
    $current_user = wp_get_current_user();
    if (class_exists('CSF')) {
        $option = wpaisaas_get_option('pricing_table');
        if (!empty($option)) {
            if (in_array('wpaisaas_' . strtolower($option['plan_title_free']), $current_user->roles) || in_array('wpaisaas_' . strtolower($option['plan_title_pro']), $current_user->roles) || in_array('wpaisaas_' . strtolower($option['plan_title_enterprise']), $current_user->roles)) {
                // Return false to hide the admin bar
                return false;
            }
        }
    }
    return $show;
}

add_filter('show_admin_bar', 'wpaisaas_hide_admin_bar_based_on_role');

/**
 * For find role Display name by role slug
 * @param $role
 * @return string
 */

function wpaisaas_get_role_name()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $role = $user->roles[0];
        $option = wpaisaas_get_option('pricing_table');
        if (!empty($option)) {
            switch ($role) {
                case 'administrator':
                    return "Administrator";
                case 'editor':
                    return "Editor";
                case 'author':
                    return "Author";
                case 'contributor':
                    return "Contributor";
                case 'wpaisaas_' . strtolower($option['plan_title_free']):
                    return ucwords($option['plan_title_free']);
                case 'wpaisaas_' . strtolower($option['plan_title_pro']):
                    return ucwords($option['plan_title_pro']);
                case 'wpaisaas_' . strtolower($option['plan_title_enterprise']):
                    return ucwords($option['plan_title_enterprise']);
                default:
                    return "Subscriber";
            }
        } else {
            switch ($role) {
                case 'administrator':
                    return "Administrator";
                case 'editor':
                    return "Editor";
                case 'author':
                    return "Author";
                case 'contributor':
                    return "Contributor";
                default:
                    return "Subscriber";
            }
        }
    }else {
        return "Guest";
    }
}