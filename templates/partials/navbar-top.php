<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
     navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 " id="navbar">
            <ul class="navbar-nav ms-auto justify-content-between"> <!-- Changed justify-content-end to ms-auto -->
                <li class="nav-item d-flex align-items-center">
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wp_logout_url( wp_login_url() ) ); ?>" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-sign-out me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?php esc_html_e('Logout', 'gpt-ai-saas'); ?></span>
                        </a>
                        <a href="<?php echo esc_url(wpaisaas_get_page_link('profile')); ?>" class="nav-link text-body font-weight-bold px-2">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?php esc_html_e('Profile', 'gpt-ai-saas'); ?></span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?php esc_html_e('Sign In', 'gpt-ai-saas'); ?></span>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
