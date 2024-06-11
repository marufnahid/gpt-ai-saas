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
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                         style="background-image: url('<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "/assets/img/ivancik.jpg" ?>');">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="text-white font-weight-bolder mb-4 pt-2"><?php esc_html_e('Explore the power of AI', 'gpt-ai-saas'); ?></h5>
                            <p class="text-white"><?php esc_html_e('Chat with AI and generate the new aspect of work.', 'gpt-ai-saas'); ?></p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                               href="javascript:;">
                                <?php esc_html_e('Start Now', 'gpt-ai-saas'); ?>
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
                                <h5 class="text-center"><?php esc_html_e('Please login to start the conversation', 'gpt-ai-saas'); ?></h5>
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
                        <div class="col-md-12 ">
                            <div class="mb-3">
                                <?php wp_nonce_field('code_nonce_action', 'code_nonce'); ?>
                                <label for="lanugageSoftware"
                                       class="form-label"><?php esc_html_e('Language / Software', 'gpt-ai-saas'); ?></label>
                                <input type="text" class="form-control" id="lanugageSoftware"
                                       placeholder="<?php esc_html_e('HTML, C++, JAVA, Excel etc...', 'gpt-ai-saas'); ?>">
                            </div>
                            <label for="textareaPrompt"
                                   class="form-label"><?php esc_html_e('Description of your code.', 'gpt-ai-saas'); ?></label>
                            <div class="mb-3 input-group">
                                <textarea type="text" id="textareaPrompt" class="form-control"
                                          placeholder="<?php esc_html_e('Write a method that add 2 int...', 'gpt-ai-saas'); ?>"
                                          aria-label="<?php esc_html_e('Write a method that add 2 int...', 'gpt-ai-saas'); ?>"
                                          aria-describedby="button-addon2"></textarea>
                                <button class="btn btn-outline-primary mb-0" type="button"
                                        id="codeSubmit"><?php esc_html_e('Submit', 'gpt-ai-saas'); ?>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="chatOutput"><?php esc_html_e('Output Response', 'gpt-ai-saas'); ?></label>
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control" id="chatOutput"
                                          placeholder="<?php esc_html_e('I am GPT, I will give any kind of questions answer.', 'gpt-ai-saas'); ?>"
                                          style="height: 400px"></textarea>
                                <div class="position-absolute top-0 end-0  z-index-999">
                                    <button class="btn btn-primary" id="copyButton" onclick="copyToClipboard()">Copy</button>
                                </div>
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

<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/footer.php'; ?>
