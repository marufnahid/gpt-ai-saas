<?php
/**
 * Plugin Name:       GPT AI SaaS
 * Plugin URI:        https://github.com/marufnahid/gpt-ai-saas
 * Description:       GPT AI SaaS revolutionizes content creation for WordPress websites by integrating cutting-edge AI models like GPT-3 and GPT-4. With this powerful plugin, generating text, content, images, and performing OCR tasks becomes faster upto 20x and more affordable (upto 50x) than ever before.
 * Version:           1.0.0
 * Author:            marufnahid
 * Author URI:        https://github.com/marufnahid
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpaisaas
 * Domain Path:       /languages
 * Requires PHP:      7.4
 * Requires at least: 5.6
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Define constant for the template file names.
if (!defined('WPAISAAS_PLUGIN_DIR_URL')) {
    define('WPAISAAS_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}
if (!defined('WPAISAAS_PLUGIN_DIR_PATH')) {
    define('WPAISAAS_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

// Load the settings library.
if (file_exists(WPAISAAS_PLUGIN_DIR_PATH . 'includes/framework/codestar-framework.php')) {
    require_once WPAISAAS_PLUGIN_DIR_PATH . 'includes/framework/codestar-framework.php';
    require_once WPAISAAS_PLUGIN_DIR_PATH . 'includes/options.php';
}
if (file_exists(WPAISAAS_PLUGIN_DIR_PATH . 'includes/functions.php')) {
    require_once WPAISAAS_PLUGIN_DIR_PATH . 'includes/functions.php';
    require_once WPAISAAS_PLUGIN_DIR_PATH . 'includes/stripe/create-checkout-session.php';
}
/**
 * Get the full path of the template file location.
 *
 * @param string $template_file_name The name of the template file.
 * @return string
 * @since 1.0.0
 */
function wpaisaas_get_template_file($template_file_name)
{
    return WPAISAAS_PLUGIN_DIR_PATH . "/templates/" . $template_file_name;
}

/**
 * Enqueue scripts and styles.
 *
 * @return void
 * @since 1.0.0
 */
function wpaisaas_load_scripts()
{
    wp_enqueue_style('wpaisaas-style', WPAISAAS_PLUGIN_DIR_URL . 'assets/css/wpaisaas.css', array(), '1.0.0', 'all');
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
    wp_enqueue_script('wpaisaas-script', WPAISAAS_PLUGIN_DIR_URL . 'assets/js/wpaisaas.js', array('jquery'), null, true);

    // Localize the script with the AJAX URL
    wp_localize_script('wpaisaas-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'wpaisaas_load_scripts', 9999);


function wpaisaas_admin_scripts()
{
    wp_enqueue_style('wpaisaas-style', WPAISAAS_PLUGIN_DIR_URL . 'assets/css/wpaisaas-admin.css', array(), '1.0.0', 'all');
}

add_action('admin_enqueue_scripts', 'wpaisaas_admin_scripts');

/**
 * Get list of special pages conditional check
 *
 * @return array
 * @since 1.0.0
 */
function wpaisaas_conditional_check_list()
{
    return array(
        'is_home' => __('Blog', 'wpaisaas'),
        'is_archive' => __('Archive', 'wpaisaas'),
        'is_search' => __('Search', 'wpaisaas'),
    );
}

/**
 * Check if the current page needs to apply a custom template.
 *
 * @param string $template_file_name The name of the template file.
 * @return bool
 * @since 1.0.0
 */
function wpaisaas_is_apply_template($template_file_name)
{
    global $post;

    $template_file_path = wpaisaas_get_template_file($template_file_name);

    if (!file_exists($template_file_path)) {
        return false;
    }

    if (is_page()) {
        return is_page_template($template_file_name);
    } elseif (is_singular()) {
        return get_option('wpaisaas_enable_post_type__' . get_post_type($post));
    } else {
        $is_apply = false;

        foreach (array_keys(wpaisaas_conditional_check_list()) as $conditional) {
            if (function_exists($conditional) && call_user_func($conditional) && get_option('wpaisaas_enable_special_page__' . $conditional)) {
                $is_apply = true;
                break;
            }
        }

        return $is_apply;
    }
}

/**
 * Filters list of page templates for a theme.
 *
 * @param array $templates Array of page templates. Keys are filenames, values are translated names.
 * @return array
 * @since 1.0.0
 */
function wpaisaas_theme_page_templates($templates)
{
    if (!is_array($templates)) {
        $templates = array();
    }

    $license_type = get_option('wpaisaas_license_type') !== null ? get_option('wpaisaas_license_type') : 'free';
    $license_status = get_option('wpaisaas_license_status') !== null ? get_option('wpaisaas_license_status') : 'active';

    $additional_templates = array();
    if ($license_type == 'free' && $license_status == 'active') {
        $additional_templates = array(
            'dashboard-template.php' => __('AI Dashboard Page', 'wpaisaas'),
            'conversation-template.php' => __('AI Conversation Page', 'wpaisaas'),
            'hashtag-template.php' => __('AI Hashtag Page', 'wpaisaas'),
            'code-template.php' => __('AI Code Page', 'wpaisaas'),
            'profile-template.php' => __('AI Profile Page', 'wpaisaas'),
        );
    } elseif ($license_type == 'pro' && $license_status == 'active') {
        $additional_templates = array(
            'dashboard-template.php' => __('AI Dashboard Page', 'wpaisaas'),
            'conversation-template.php' => __('AI Conversation Page', 'wpaisaas'),
            'music-template.php' => __('AI Music Page', 'wpaisaas'),
            'hashtag-template.php' => __('AI Hashtag Page', 'wpaisaas'),
            'code-template.php' => __('AI Code Page', 'wpaisaas'),
            'image-template.php' => __('AI Image Page', 'wpaisaas'),
            'profile-template.php' => __('AI Profile Page', 'wpaisaas'),
        );
    }

    return array_merge($templates, $additional_templates);
}

/**
 * Filters the path of the current template before including it.
 * @param string $template The path of the template to include.
 * @return string
 * @since 1.0.0
 */
function wpaisaas_template_include($template)
{
    $license_type = get_option('wpaisaas_license_type') !== null ? get_option('wpaisaas_license_type') : 'free';
    $license_status = get_option('wpaisaas_license_status') !== null ? get_option('wpaisaas_license_status') : 'active';
    $template_files = array();
    if ($license_type == 'free' && $license_status == 'active') {
        $template_files = array(
            'dashboard-template.php',
            'conversation-template.php',
            'profile-template.php',
            'hashtag-template.php',
            'code-template.php',
        );
    } elseif ($license_type == 'pro' && $license_status == 'active') {
        $template_files = array(
            'dashboard-template.php',
            'conversation-template.php',
            'music-template.php',
            'hashtag-template.php',
            'code-template.php',
            'image-template.php',
            'profile-template.php',
        );
    }

    foreach ($template_files as $template_file) {
        if (wpaisaas_is_apply_template($template_file)) {
            return wpaisaas_get_template_file($template_file);
        }
    }

    return $template;
}

/**
 * Show compatibility notice to admin.
 *
 * @return void
 */
function wpaisaas_admin_notices()
{
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php esc_html_e('WordPress AI SaaS plugin only works for WordPress version 5.6.0 or later.', 'wpaisaas'); ?></p>
    </div>
    <?php
}

function wpaisaas_activation_function()
{
    // Check if this is the first time plugin activation
    if (!get_option('wpaisaas_version')) {
        // First time activation, set default options
        update_option('wpaisaas_version', '1.0.0');
        update_option('wpaisaas_license_type', 'free');
        update_option('wpaisaas_license_email', '');
        update_option('wpaisaas_license_key', '');
        update_option('wpaisaas_license_status', 'active');
    } else {
        // Plugin is already activated, check if any necessary updates needed
        $current_version = get_option('wpaisaas_version');
        $current_license_type = get_option('wpaisaas_license_type');
        $current_license_status = get_option('wpaisaas_license_status');

        // Perform necessary checks and updates here based on the current state
        if ($current_version !== '1.0.0') {
            // Perform updates for version 1.0.0
            // Add your update code here
        }

        // Check if license type needs to be changed
        if ($current_license_type === 'pro' && $current_license_status !== 'active') {
            // If the current license type is pro but not active, revert to free
            update_option('wpaisaas_license_type', 'free');
            update_option('wpaisaas_license_email', '');
            update_option('wpaisaas_license_key', '');
            update_option('wpaisaas_license_status', 'inactive');
        }
    }
}

register_activation_hook(__FILE__, 'wpaisaas_activation_function');

/**
 * The admin settings callback.
 *
 * @return void
 */
function wpaisaas_admin_setting()
{
    $prefix = "wpaisaas_";

    if (class_exists('CSF')) {
        $option = wpaisaas_get_option('pricing_table');
        if (!empty($option)) {
            add_role($prefix . strtolower(esc_html($option['plan_title_free'])), ucwords(esc_html($option['plan_title_free'])), array(
                'read' => true,
            ));
            add_role($prefix . strtolower(esc_html($option['plan_title_pro'])), ucwords(esc_html($option['plan_title_pro'])), array(
                'read' => true,
            ));
            add_role($prefix . strtolower(esc_html($option['plan_title_enterprise'])), ucwords(esc_html($option['plan_title_enterprise'])), array(
                'read' => true,
            ));
        }
    }

    // Check version compatibility. Bail early if minimum version requirements not met.
    if (version_compare(floatval(get_bloginfo('version')), '5.6.0', '<')) {
        add_action('admin_notices', 'wpaisaas_admin_notices');
        return;
    }

    // Hooked into theme_page_templates to modify list of page templates for a theme.
    add_filter('theme_page_templates', 'wpaisaas_theme_page_templates', 999);

    // Hooked into template_include to modify the path of the current template before including it.
    add_filter('template_include', 'wpaisaas_template_include', 999);

    // Hooked into body_class to modify the CSS classes.
    add_filter('body_class', 'wpaisaas_filter_body_class', 999);

    // Hooked into post_class to modify the CSS classes.
    add_filter('post_class', 'wpaisaas_filter_post_class', 999);
}

add_action('init', 'wpaisaas_admin_setting');
/**
 * Filters body tag element classes when page using the wpaisaas template.
 *
 * @param array $classes Raw body classes data passed to the filter.
 * @return array
 * @since 1.0.0
 */
function wpaisaas_filter_body_class($classes)
{
    // Add your body class filter logic here.
    return $classes;
}

/**
 * Filters post content wrapper CSS classes when page using the blanked template.
 *
 * @param array $classes Raw post classes data passed to the filter.
 * @return array
 * @since 1.0.0
 */
function wpaisaas_filter_post_class($classes)
{
    // Add your post class filter logic here.
    return $classes;
}

/**
 * Plugin bootstrap function
 *
 * @return void
 * @since  1.0.0
 */
function wpaisaas_bootstrap()
{
    // Load plugin textdomain.
    load_plugin_textdomain('wpaisaas', false, basename(plugin_dir_path(__FILE__)) . '/languages');
}

add_action('plugins_loaded', 'wpaisaas_bootstrap');
