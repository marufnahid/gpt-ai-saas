<?php

if (!defined('ABSPATH')) {
    exit;
}

$payment_settings = wpaisaas_get_option('payment_settings') !== null ? wpaisaas_get_option('payment_settings') : '';
$secret_key = esc_html($payment_settings['stripe_secret_key']) ?? '';
\Stripe\Stripe::setApiKey($secret_key);
// Replace this endpoint secret with your endpoint's unique secret
// If you are testing with the CLI, find the secret by running 'stripe listen'
// If you are using an endpoint defined with the API or dashboard, look in your webhook settings
// at https://dashboard.stripe.com/webhooks
$endpoint_secret = esc_html($payment_settings['stripe_webhook_secret']);

$payload = @file_get_contents('php://input');
$event = null;
try {
    $event = \Stripe\Event::constructFrom(
        json_decode($payload, true)
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    echo '⚠️  Webhook error while parsing basic request.';
    http_response_code(400);
    exit();
}
// Handle the event
switch ($event->type) {
    case 'customer.subscription.trial_will_end':
        $subscription = $event->data->object; // contains a \Stripe\Subscription
        // Then define and call a method to handle the trial ending.
        // handleTrialWillEnd($subscription);
        break;
    case 'customer.subscription.created':
        $subscription = $event->data->object; // contains a \Stripe\Subscription
        // Then define and call a method to handle the subscription being created.
        // handleSubscriptionCreated($subscription);
        break;
    case 'customer.subscription.deleted':
        $subscription = $event->data->object; // contains a \Stripe\Subscription
        // Then define and call a method to handle the subscription being deleted.
        // handleSubscriptionDeleted($subscription);
        break;
    case 'customer.subscription.updated':
        $subscription = $event->data->object; // contains a \Stripe\Subscription
        // Then define and call a method to handle the subscription being updated.
        // handleSubscriptionUpdated($subscription);
        break;
    default:
        // Unexpected event type
        echo 'Received unknown event type';
}