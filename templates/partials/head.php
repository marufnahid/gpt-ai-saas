<?php
/**
 * The template for the head section
 *
 * @package WP_Ai_SaaS
 */
if ( ! defined( 'ABSPATH' ) ) exit;
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
    <?php wp_head(); ?>
</head>
