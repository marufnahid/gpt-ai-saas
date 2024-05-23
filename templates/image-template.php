<?php
include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/head.php';
?>

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
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                         style="background-image: url('<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/img/ivancik.jpg" ?>');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="text-white font-weight-bolder mb-4 pt-2"><?php esc_html_e('Explore the power of AI', 'wpaisaas');?></h5>
                            <p class="text-white"><?php esc_html_e('Chat with AI and generate the new aspect of work.', 'wpaisaas'); ?></p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                               href="javascript:;">
                                <?php esc_html_e('Start Now', 'wpaisaas');?>
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (!is_user_logged_in()) {
            ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-center"><?php esc_html_e('Please login to start the conversation', 'wpaisaas');?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
        ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="input-group mb-3">
                                <textarea type="text" id="textareaPrompt" class="form-control" placeholder="<?php esc_attr_e('Enter your questions...', 'wpaisaas');?>" aria-label="<?php esc_attr_e('Enter your questions...', 'wpaisaas');?>" aria-describedby="button-addon2"></textarea>
                                <button class="btn btn-outline-primary mb-0" type="button" id="conversationSubmit"><?php esc_html_e('Submit', 'wpaisaas');?></button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control" id="chatOutput" style="height: 400px"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</main>

<!--   Core JS Files   -->
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/core/popper.min.js"; ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/core/bootstrap.min.js"; ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/plugins/perfect-scrollbar.min.js"; ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/plugins/smooth-scrollbar.min.js"; ?>"></script>

<script>

</script>

<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/footer.php'; ?>