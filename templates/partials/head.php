<?php
/**
 * The template for the head section
 *
 * @package WP_Ai_SaaS
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    // Get the URL of the favicon or touch icon from the current theme
    $favicon_url = get_site_icon_url();
    if (!$favicon_url) {
        $favicon_url = get_theme_file_uri('favicon.png');
    }
    ?>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url($favicon_url); ?>">
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_url); ?>">
    <title>
        <?php bloginfo('name'); ?> <?php wp_title('|', true, 'left'); ?>
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/css/nucleo-icons.css'; ?>" rel="stylesheet"/>
    <link href="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/css/nucleo-svg.css'; ?>" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/css/toastify.min.css'; ?>">
    <!-- CSS Files -->
    <?php wp_head(); ?>
    <link id="pagestyle" href="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . 'assets/css/dashboard.css'; ?>" rel="stylesheet"/>
</head>
