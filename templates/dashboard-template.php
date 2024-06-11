<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/head.php'; ?>

<body class="g-sidenav-show  bg-gray-100">
<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/sidebar-left.php'; ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/navbar-top.php'; ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card h-100 p-3 text-center">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/img/ivancik.jpg"?>');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="text-white font-weight-bolder mb-4 pt-2"><?php esc_html_e('Explore the power of AI', 'gpt-ai-saas');?></h5>
                            <p class="text-white"><?php esc_html_e('Chat with AI and generate the new aspect of work.', 'gpt-ai-saas');?></p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                                <?php esc_html_e('Start Now', 'gpt-ai-saas');?>
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card-body p-3">
                    <?php wpaisaas_display_features_based_on_role(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/config-ui.php'; ?>

<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/footer.php'; ?>
