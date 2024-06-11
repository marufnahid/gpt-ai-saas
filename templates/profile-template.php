<?php
/**
 * Template for code conversation
 *
 * @link
 * @since      1.0.0
 * @package    GPT_AI_SAAS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$user = wp_get_current_user();
include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/head.php';
?>

    <body class="g-sidenav-show  bg-gray-100">
<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/sidebar-left.php'; ?>
    <!-- Main content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/navbar-top.php'; ?>
        <!-- End Navbar -->
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url( <?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/img/curved-images/curved0.jpg" ?>); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img alt="<?php echo esc_html($user->display_name); ?>"
                                 src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" class="avatar avatar-96 photo"
                                 height="96" width="96" loading="lazy" decoding="async">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?php echo esc_html($user->display_name); ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <?php echo esc_html(wpaisaas_get_role_name()); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (is_user_logged_in()) {
            ?>
            <div class="container-fluid py-4 mb-5">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0"><?php esc_html_e('Platform Settings', 'gpt-ai-saas'); ?></h6>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4"><?php esc_html_e('Current Plan', 'gpt-ai-saas'); ?></h6>
                                <p>
	                                <?php
	                                $current_plan = wpaisaas_get_role_name();
	                                echo esc_html__( 'Your current plan is:', 'gpt-ai-saas' ). ' '. esc_html( $current_plan );
	                                ?>
                                </p>
                                <?php
                                if (!empty($user->roles)) {
                                    if ($user->roles[0] == 'subscriber') {
                                        printf(
                                            '<a class="btn bg-gradient-primary mt-3 w-100" href="%s">%s</a>',
                                            esc_url(wpaisaas_get_page_link('pricing')),
                                            esc_html__('Upgrade to pro', 'gpt-ai-saas')
                                        );
                                    } else {
                                        printf(
                                            '<a class="btn bg-gradient-primary mt-3 w-100" href="%s">%s</a>',
                                            esc_url(wpaisaas_get_page_link('pricing')),
                                            esc_html__('Review your plan!!!', 'gpt-ai-saas')
                                        );
                                    }
                                }
                                ?>
                                <hr class="horizontal"/>
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder"><?php esc_html_e('Account', 'gpt-ai-saas'); ?></h6>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                            <input class="form-check-input ms-auto" type="checkbox"
                                                   id="flexSwitchCheckDefault"
                                                   checked>
                                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                   for="flexSwitchCheckDefault"><?php esc_html_e('Email me when new update is released.', 'gpt-ai-saas'); ?></label>
                                        </div>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0"><?php esc_html_e('Profile Information', 'gpt-ai-saas'); ?></h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="javascript:">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Edit Profile"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                class="text-dark"><?php esc_html_e('Full Name:', 'gpt-ai-saas'); ?></strong><?php echo esc_html($user->display_name); ?>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark"><?php esc_html_e('Email:', 'gpt-ai-saas'); ?></strong><?php echo esc_html($user->user_email); ?>
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark"><?php esc_html_e('Registered:', 'gpt-ai-saas'); ?></strong><?php echo esc_html($user->user_registered); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </main>
<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/footer.php'; ?>