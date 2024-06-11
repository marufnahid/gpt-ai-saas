<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?php //echo esc_url(wpaisaas_get_page_link('profile')); ?>"
           target="_blank">
            <?php
            // Get the custom logo URL
            $custom_logo_id = get_theme_mod('custom_logo');
            $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');

            if (!$custom_logo_url) {
                $site_icon_url = get_site_icon_url();
            }

            // Output the logo or site icon URL
            if ($custom_logo_url) {
                echo '<img src="' . esc_url($custom_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
            } elseif ($site_icon_url) {
                echo '<img src="' . esc_url($site_icon_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
            } else {
                echo '<img src="' . esc_url(get_template_directory_uri() . 'assets/img/logo-color-white.svg') . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
            }
            echo '<span class="ms-1 font-weight-bold">' . esc_html(get_bloginfo('name')) . '</span>';

            ?>

        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <?php wpaisaas_display_navigation_based_on_role(); ?>
    </div>

    <?php
    $user = wp_get_current_user();

    if (!empty($user->roles)) {
        $user_role = $user->roles[0];
        $upgrade_link = wpaisaas_get_page_link('pricing');
        $admin_link = 'https://codecanyon.net/user/themesvro';

        if ($user_role == 'subscriber') {
            // Show upgrade link for subscribers
            echo '<div class="sidenav-footer mx-3 ">';
            printf(
                '<a class="btn bg-gradient-primary mt-3 w-100" href="%s">%s</a>',
                esc_url($upgrade_link),
                esc_html__('Upgrade to pro', 'gpt-ai-saas')
            );
            echo '</div>';
        } elseif (in_array($user_role, ['administrator', 'editor', 'author'])) {
            // Show a different link for admin, editor, and author
            echo '<div class="sidenav-footer mx-3 ">';
            printf(
                '<a class="btn bg-gradient-primary mt-3 w-100" href="%s">%s</a>',
                esc_url($admin_link),
                esc_html__('Buy Now', 'gpt-ai-saas')
            );
            echo '</div>';
        }
    }else {
        echo '<div class="sidenav-footer mx-3 ">';
        printf(
            '<a class="btn bg-gradient-primary mt-3 w-100" href="%s">%s</a>',
            esc_url(wp_login_url()),
            esc_html__('Login', 'gpt-ai-saas')
        );
        echo '</div>';
    }
    ?>

</aside>
