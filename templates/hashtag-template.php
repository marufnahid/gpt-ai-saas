<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/head.php'; ?>
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
                            <p class="text-white"><?php esc_html_e('Chat with AI and generate the new aspect of work. ', 'wpaisaas');?></p>
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
        }else {
        ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="mb-3">
                                <?php wp_nonce_field('hashtag_nonce_action', 'hashtag_nonce'); ?>
                                <label for="lanugageSoftware"
                                       class="form-label"><?php esc_html_e('Language', 'wpaisaas'); ?></label>
                                <select name="lanugageSoftware" id="lanugageSoftware">
                                    <option value="<?php esc_attr_e('English', 'wpaisaas'); ?>" selected><?php esc_html_e('English', 'wpaisaas'); ?></option>
                                    <option value="<?php esc_attr_e('French', 'wpaisaas'); ?>"><?php esc_html_e('French', 'wpaisaas'); ?></option>
                                    <option value="<?php esc_attr_e('Spanish', 'wpaisaas'); ?>"><?php esc_html_e('Spanish', 'wpaisaas'); ?></option>
                                    <option value="<?php esc_attr_e('Italian', 'wpaisaas'); ?>"><?php esc_html_e('Italian', 'wpaisaas'); ?></option>
                                    <option value="<?php esc_attr_e('German', 'wpaisaas'); ?>"><?php esc_html_e('German', 'wpaisaas'); ?></option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keywords"
                                       class="form-label"><?php esc_html_e('Keywords', 'wpaisaas'); ?></label>
                                <input type="text" class="form-control" id="keywords" placeholder="<?php esc_html_e('Write keywords for hashtags..', 'wpaisaas'); ?>"/>
                            </div>
                            <label for="textareaPrompt"
                                   class="form-label"><?php esc_html_e('Description of your Hashtags', 'wpaisaas'); ?></label>
                            <div class="mb-3 input-group">
                                <textarea type="text" id="textareaPrompt" class="form-control"
                                          placeholder="<?php esc_html_e('I am on the beach with a dog...', 'wpaisaas'); ?>"
                                          aria-label="<?php esc_html_e('I am on the beach with a dog...', 'wpaisaas'); ?>"
                                          aria-describedby="button-addon2"></textarea>
                                <button class="btn btn-outline-primary mb-0" type="button"
                                        id="conversationSubmit"><?php esc_html_e('Submit', 'wpaisaas'); ?>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="chatOutput"><?php esc_html_e('Output Response', 'wpaisaas'); ?></label>
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control" id="chatOutput"
                                          placeholder="<?php esc_html_e('I am GPT, I will give any kind of questions answer.', 'wpaisaas'); ?>"
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

<!--   Core JS Files   -->
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/core/popper.min.js" ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/core/bootstrap.min.js" ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/plugins/perfect-scrollbar.min.js" ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/plugins/smooth-scrollbar.min.js" ?>"></script>
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/toastify.min.js"; ?>"></script>
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("chatOutput");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        document.execCommand("copy");
    }
    jQuery(document).ready(function($) {
        $('#conversationSubmit').on('click', function() {
            var inputText = $('#textareaPrompt').val();
            var keywords = $('#keywords').val();
            var language = $('#lanugageSoftware').val();
            var nonce = $('#hashtag_nonce').val();

            if (inputText === '' || keywords === ''){
                Toastify({
                    text: "Description and keywords are important!",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #cb0c9f2e, ##cb0c9f)",
                    }
                }).showToast();
                return;
            }

            $('#conversationSubmit').prop('disabled', true);
            $("#chatOutput").val('AI is thinking...');

            // Send the input text to the backend using AJAX
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'hashtag_api_request',
                    input_text: inputText,
                    keywords: keywords,
                    language: language,
                    nonce: nonce
                },
                success: function(response) {
                    var data = JSON.parse(response.data);
                    if (data.object === 'chat.completion') {
                        if (data.choices && data.choices.length > 0) {
                            var messageContent = data.choices[0].message.content;
                            $('#chatOutput').val(messageContent);
                        } else {
                            console.error('No message content found in the response (chat.completion)');
                        }
                    } else if (data.object === 'text_completion') {
                        if (data.choices && data.choices.length > 0) {
                            var messageContent = data.choices[0].text;
                            $('#chatOutput').val(messageContent);
                        } else {
                            console.error('No message content found in the response (text_completion)');
                        }
                    } else {
                        $('#conversationSubmit').prop('disabled', false);
                        $('#chatOutput').val(data.error.message);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                },
                complete: function () {
                    $('#conversationSubmit').prop('disabled', false);
                }
            });
        });
    });
</script>

<?php include_once WPAISAAS_PLUGIN_DIR_PATH . 'templates/partials/footer.php'; ?>
