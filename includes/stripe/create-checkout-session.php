<?php
if (!defined('ABSPATH')) {
    exit;
}

$payment_settings = wpaisaas_get_option('payment_settings');
if (!empty($payment_settings)) {
    $secret_key = esc_html($payment_settings['stripe_secret_key']) ?? '';
    \Stripe\Stripe::setApiKey($secret_key);
}

add_action('admin_post_success_plan_action', 'wpaisaas_success_plan_action');
add_action('admin_post_nopriv_success_plan_action', 'wpaisaas_success_plan_action');

function wpaisaas_success_plan_action()
{
    $YOUR_DOMAIN = wpaisaas_get_page_link('profile');
    $session_id = isset($_POST['session_id']) ? sanitize_text_field($_POST['session_id']) : '';
    $plan = isset($_POST['plan']) ? sanitize_text_field($_POST['plan']) : '';
    $price_id = isset($_POST['price_id']) ? sanitize_text_field($_POST['price_id']) : '';
    $option = wpaisaas_get_option('pricing_table');
    $prefix = 'wpaisaas_';

    if (!empty($option)) {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'free_success_nonce_action')) {
            // Nonce is not valid, display error or redirect
            wp_die('Security check failed. Please try again.');
        }

        if (empty($session_id) || empty($plan) || empty($price_id)) {
            wp_die('Invalid request.');
        }

        // Update user role based on the selected plan
        $user_id = get_current_user_id();
        $user = get_user_by('ID', $user_id);
        if (!in_array('administrator', $user->roles)) {
            if ($plan === $option['plan_title_free'] || $plan === $option['plan_title_pro'] || $plan === $option['plan_title_enterprise']) {
                $user->set_role($prefix . strtolower($plan));
            }
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
            $return_url = $YOUR_DOMAIN;

            // Authenticate your user.
            $session = \Stripe\BillingPortal\Session::create([
                'customer' => $checkout_session->customer,
                'return_url' => $return_url,
            ]);

            // Redirect the user to the billing portal URL
            wp_redirect($session->url);
            exit;
        } catch (Error $e) {
            http_response_code(500);
            echo wp_json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }

}


add_action('admin_post_enterprise_plan_action', 'wpaisaas_enterprise_plan_action');
add_action('admin_post_nopriv_enterprise_plan_action', 'wpaisaas_enterprise_plan_action');
function wpaisaas_enterprise_plan_action()
{
    $YOUR_DOMAIN = home_url('/');

    if (!isset($_POST['enterprise_plan_nonce']) || !wp_verify_nonce($_POST['enterprise_plan_nonce'], 'enterprise_nonce_action')) {
        // Nonce is not valid, display error or redirect
        wp_die('Security check failed. Please try again.');
    }
    $payment_settings = wpaisaas_get_option('payment_settings');
    $option = wpaisaas_get_option('pricing_table');

    if (!empty($payment_settings) && !empty($option)) {
        $enterprise_price_id = $payment_settings['stripe_price_id_enterprise'];

        if (!isset($enterprise_price_id)) {
            wp_die('Enterprise plan is not available.');
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price' => $enterprise_price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => WPAISAAS_PLUGIN_DIR_URL . 'includes/stripe/success.php?session_id={CHECKOUT_SESSION_ID}&plan= ' . $option['plan_title_enterprise'] . '&price_id=' . $enterprise_price_id . '&admin_url=' . admin_url('admin-post.php') . '&nonce=' . wp_create_nonce('free_success_nonce_action'),
                'cancel_url' => $YOUR_DOMAIN . 'includes/stripe/cancel.php',
            ]);

            wp_redirect($checkout_session['url']);
            exit();
        } catch (Error $e) {
            http_response_code(500);
            echo wp_json_encode(['error' => $e->getMessage()]);
        }
    }

}

add_action('admin_post_pro_plan_action', 'wpaisaas_pro_plan_action');
add_action('admin_post_nopriv_pro_plan_action', 'wpaisaas_pro_plan_action');
function wpaisaas_pro_plan_action()
{
    $YOUR_DOMAIN = home_url('/');

    if (!isset($_POST['pro_plan_nonce']) || !wp_verify_nonce($_POST['pro_plan_nonce'], 'pro_nonce_action')) {
        // Nonce is not valid, display error or redirect
        wp_die('Security check failed. Please try again.');
    }
    $payment_settings = wpaisaas_get_option('payment_settings');
    $option = wpaisaas_get_option('pricing_table');

    if (!empty($payment_settings) && !empty($option)) {
        $pro_price_id = $payment_settings['stripe_price_id_pro'];

        if (!isset($pro_price_id)) {
            wp_die('Enterprise plan is not available.');
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price' => esc_html($pro_price_id),
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => WPAISAAS_PLUGIN_DIR_URL . 'includes/stripe/success.php?session_id={CHECKOUT_SESSION_ID}&plan= ' . esc_html($option['plan_title_pro']) . '&price_id=' . esc_html($pro_price_id) . '&admin_url=' . esc_url(admin_url('admin-post.php')) . '&nonce=' . wp_create_nonce('free_success_nonce_action'),
                'cancel_url' => $YOUR_DOMAIN . 'includes/stripe/cancel.php',
            ]);

            wp_redirect($checkout_session['url']);
            exit();
        } catch (Error $e) {
            http_response_code(500);
            echo wp_json_encode(['error' => $e->getMessage()]);
        }
    }

}


add_action('admin_post_free_plan_action', 'wpaisaas_free_plan_action');
add_action('admin_post_nopriv_free_plan_action', 'wpaisaas_free_plan_action');
function wpaisaas_free_plan_action()
{
    $YOUR_DOMAIN = home_url('/');

    if (!isset($_POST['free_plan_nonce']) || !wp_verify_nonce($_POST['free_plan_nonce'], 'free_nonce_action')) {
        // Nonce is not valid, display error or redirect
        wp_die('Security check failed. Please try again.');
    }
    $payment_settings = wpaisaas_get_option('payment_settings');
    $option = wpaisaas_get_option('pricing_table');

    if (!empty($payment_settings) && !empty($option)){
        $free_price_id = $payment_settings['stripe_price_id_free'];

        if (!isset($free_price_id)) {
            wp_die('Enterprise plan is not available.');
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price' => esc_html($free_price_id),
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => WPAISAAS_PLUGIN_DIR_URL . 'includes/stripe/success.php?session_id={CHECKOUT_SESSION_ID}&plan= ' . esc_html($option['plan_title_free']) . '&price_id=' . esc_html($free_price_id) . '&admin_url=' . esc_url(admin_url('admin-post.php')) . '&nonce=' . wp_create_nonce('free_success_nonce_action'),
                'cancel_url' => $YOUR_DOMAIN . 'includes/stripe/cancel.php',
            ]);

            wp_redirect($checkout_session['url']);
            exit();
        } catch (Error $e) {
            http_response_code(500);
            echo wp_json_encode(['error' => $e->getMessage()]);
        }
    }

}