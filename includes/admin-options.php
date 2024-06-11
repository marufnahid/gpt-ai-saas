<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add the main menu and submenu
function wpaisaas_admin_menu_settings() {
	$encodedData = "";
	add_menu_page(
		esc_html__( 'GPT AI SaaS', 'gpt-ai-saas' ),
		esc_html__( 'GPT AI SaaS', 'gpt-ai-saas' ),
		'manage_options',
		'wpaisaas_admin_menu',
		'wpaisaas_main_menu_page',
		plugins_url( 'assets/img/logo-20x20.png', dirname( __FILE__ ) ),
		80
	);

	// Submenu
	add_submenu_page(
		'wpaisaas_admin_menu', // Parent slug should match the main menu slug
		esc_html__( 'Settings', 'gpt-ai-saas' ),
		esc_html__( 'Settings', 'gpt-ai-saas' ),
		'manage_options',
		'wpaisaas_admin_menu',
		'wpaisaas_main_menu_page'
	);
}

add_action( 'admin_menu', 'wpaisaas_admin_menu_settings' );

function wpaisaas_main_menu_page() {
	?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header d-flex justify-content-between align-items-center align-self-center">
                        <div class="header-top-left d-flex align-self-center">
                            <img height="48" width="48"
                                 src="<?php echo esc_url( WPAISAAS_PLUGIN_DIR_URL . "assets/img/logo-color-white.svg" ) ?>"
                                 alt="<?php esc_attr_e( 'Logo', 'gpt-ai-saas' ); ?>">
                            <h1>  <?php esc_html_e( 'GPT AI SaaS', 'gpt-ai-saas' ); ?></h1>
                        </div>
                        <div class="header-top-right">
                            <a href="<?php echo esc_url( 'https://codecanyon.net/user/themesvro/portfolio' ); ?>"
                               class="admin-btn btn-primary"><?php esc_html_e( 'Get Pro', 'gpt-ai-saas' ); ?></a>
                        </div>

                    </div>
                    <div class="tab-container">
                        <ul class="nav-tabs">
                            <li class="active"><a href="#tab1"
                                                  class="tab-link"><?php esc_html_e( 'API Settings', 'gpt-ai-saas' ); ?></a>
                            </li>
                            <li><a href="#tab2"
                                   class="tab-link"><?php esc_html_e( 'Chat Settings', 'gpt-ai-saas' ); ?></a></li>
                            <li><a href="#tab3" class="tab-link"><?php esc_html_e( 'AI Models', 'gpt-ai-saas' ); ?></a>
                            </li>
                            <li><a href="#tab4"
                                   class="tab-link"><?php esc_html_e( 'Pro Features', 'gpt-ai-saas' ); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane active">
								<?php settings_errors(); ?>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
									<?php
									wp_nonce_field( 'wpaisaas_options_nonce', 'wpaisaas_wpnonce' );
									do_settings_sections( 'wpaisaas_api-settings' );
									?>
                                    <input type="submit" name="submit_api_settings" class="admin-btn"
                                           value="<?php esc_html_e( 'Save Changes', 'gpt-ai-saas' ); ?>">
                                    <input type="hidden" name="action" value="wpaisaas_save_options">
                                </form>
                            </div>
                            <div id="tab2" class="tab-pane">
								<?php settings_errors(); ?>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
									<?php
									wp_nonce_field( 'wpaisaas_options_nonce', 'wpaisaas_wpnonce' );
									do_settings_sections( 'wpaisaas_chat-settings' );
									?>
                                    <input type="submit" name="submit_chat_settings" class="admin-btn"
                                           value="<?php esc_html_e( 'Save Changes', 'gpt-ai-saas' ); ?>">
                                    <input type="hidden" name="action" value="wpaisaas_save_options">
                                </form>
                            </div>
                            <div id="tab3" class="tab-pane">
								<?php settings_errors(); ?>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
									<?php
									wp_nonce_field( 'wpaisaas_options_nonce', 'wpaisaas_wpnonce' );
									do_settings_sections( 'wpaisaas_ai-model-settings' );
									?>
                                    <input type="submit" name="submit_ai_model_settings" class="admin-btn"
                                           value="<?php esc_html_e( 'Save Changes', 'gpt-ai-saas' ); ?>">
                                    <input type="hidden" name="action" value="wpaisaas_save_options">
                                </form>
                            </div>
                            <div id="tab4" class="tab-pane">
								<?php settings_errors(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
}

function wpaisaas_admin_option_settings() {
	// Register API settings
	register_setting( 'wpaisaas_api_settings_group', 'wpaisaas_api_settings' );

	add_settings_section(
		'wpaisaas_api_settings_section',
		esc_html__( 'API Settings', 'gpt-ai-saas' ),
		'wpaisaas_api_settings_section_callback',
		'wpaisaas_api-settings'
	);

	add_settings_field(
		'wpaisaas_openai_api_key',
		esc_html__( 'OpenAI API Key', 'gpt-ai-saas' ),
		'wpaisaas_openai_api_key_callback',
		'wpaisaas_api-settings',
		'wpaisaas_api_settings_section'
	);

	// Register Chat settings
	register_setting( 'wpaisaas_chat_settings_group', 'wpaisaas_chat_settings');

	add_settings_section(
		'wpaisaas_chat_settings_section',
		esc_html__( 'Chat Settings', 'gpt-ai-saas' ),
		'wpaisaas_chat_settings_section_callback',
		'wpaisaas_chat-settings'
	);

	add_settings_field(
		'wpaisaas_business_details',
		esc_html__( 'Business Details', 'gpt-ai-saas' ),
		'wpaisaas_business_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_target_audience',
		esc_html__( 'Target Audience', 'gpt-ai-saas' ),
		'wpaisaas_target_audience_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_language',
		esc_html__( 'Language', 'gpt-ai-saas' ),
		'wpaisaas_language_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_temperature',
		esc_html__( 'Temperature', 'gpt-ai-saas' ),
		'wpaisaas_temperature_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_max_tokens',
		esc_html__( 'Max Tokens', 'gpt-ai-saas' ),
		'wpaisaas_max_tokens_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_frequency_penalty',
		esc_html__( 'Frequency Penalty', 'gpt-ai-saas' ),
		'wpaisaas_frequency_penalty_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);
	add_settings_field(
		'wpaisaas_presence_penalty',
		esc_html__( 'Presence Penalty', 'gpt-ai-saas' ),
		'wpaisaas_presence_penalty_callback',
		'wpaisaas_chat-settings',
		'wpaisaas_chat_settings_section'
	);

	register_setting( 'wpaisaas_ai_model_settings_group', 'wpaisaas_ai_model_settings' );

	add_settings_section(
		'wpaisaas_ai_models_settings_section',
		esc_html__( 'AI Models', 'gpt-ai-saas' ),
		'wpaisaas_ai_model_section_callback',
		'wpaisaas_ai-model-settings'
	);

	add_settings_field(
		'wpaisaas_chat_model',
		esc_html__( 'Chat Model', 'gpt-ai-saas' ),
		'wpaisaas_chat_model_callback',
		'wpaisaas_ai-model-settings',
		'wpaisaas_ai_models_settings_section'
	);
}

add_action( 'admin_init', 'wpaisaas_admin_option_settings' );

// Callbacks for API Settings section
function wpaisaas_api_settings_section_callback() {
	echo '<p>' . esc_html__( 'Enter your API settings below.', 'gpt-ai-saas' ) . '</p>';
}

function wpaisaas_openai_api_key_callback() {
	$options = get_option( 'wpaisaas_api_settings' );
	?>
    <input type="text" name="wpaisaas_api_settings[openai_api_key]"
           value="<?php echo isset( $options['openai_api_key'] ) ? esc_attr( $options['openai_api_key'] ) : ''; ?>"/>
    <span class="description"><?php esc_html_e( 'You will find your API key on this link.', 'gpt-ai-saas' ); ?> <a
                href="<?php echo esc_url( 'https://platform.openai.com/api-keys' ); ?>"
                target="_blank"><?php esc_html_e( 'Click here', 'gpt-ai-saas' ); ?></a></span>
	<?php
}

// Callbacks for Chat Settings section
function wpaisaas_chat_settings_section_callback() {
	echo '<p>' . esc_html__( 'Enter your Chat settings below.', 'gpt-ai-saas' ) . '</p>';
}

function wpaisaas_business_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['business_details'] ?? '';
	echo '<input type="text" name="wpaisaas_chat_settings[business_details]" placeholder="' . esc_attr__( 'Software Company', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter your business details here.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_target_audience_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['target_audience'] ?? '';
	echo '<input type="text" name="wpaisaas_chat_settings[target_audience]" placeholder="' . esc_attr__( 'Developers', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter your target audience here.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_language_callback() {
	$options           = get_option( 'wpaisaas_chat_settings' );
	$selected_language = $options['language'] ?? '';

	$languages = [
		'Afrikaans'             => 'Afrikaans',
		'Arabic'                => 'Arabic',
		'Bulgarian'             => 'Bulgarian',
		'Bengali'               => 'Bengali',
		'Catalan'               => 'Catalan',
		'Czech'                 => 'Czech',
		'Welsh'                 => 'Welsh',
		'Danish'                => 'Danish',
		'German'                => 'German',
		'Greek'                 => 'Greek',
		'English'               => 'English',
		'Spanish'               => 'Spanish',
		'Estonian'              => 'Estonian',
		'Persian'               => 'Persian',
		'Finnish'               => 'Finnish',
		'French'                => 'French',
		'Gujarati'              => 'Gujarati',
		'Hebrew'                => 'Hebrew',
		'Hindi'                 => 'Hindi',
		'Croatian'              => 'Croatian',
		'Hungarian'             => 'Hungarian',
		'Indonesian'            => 'Indonesian',
		'Italian'               => 'Italian',
		'Japanese'              => 'Japanese',
		'Kannada'               => 'Kannada',
		'Korean'                => 'Korean',
		'Lithuanian'            => 'Lithuanian',
		'Latvian'               => 'Latvian',
		'Malayalam'             => 'Malayalam',
		'Marathi'               => 'Marathi',
		'Malay'                 => 'Malay',
		'Dutch'                 => 'Dutch',
		'Norwegian'             => 'Norwegian',
		'Polish'                => 'Polish',
		'Portuguese'            => 'Portuguese',
		'Romanian'              => 'Romanian',
		'Russian'               => 'Russian',
		'Slovak'                => 'Slovak',
		'Slovenian'             => 'Slovenian',
		'Serbian'               => 'Serbian',
		'Swedish'               => 'Swedish',
		'Tamil'                 => 'Tamil',
		'Telugu'                => 'Telugu',
		'Thai'                  => 'Thai',
		'Turkish'               => 'Turkish',
		'Ukrainian'             => 'Ukrainian',
		'Urdu'                  => 'Urdu',
		'Vietnamese'            => 'Vietnamese',
		'Chinese (Simplified)'  => 'Chinese (Simplified)',
		'Chinese (Traditional)' => 'Chinese (Traditional)',
	];

	echo '<select name="wpaisaas_chat_settings[language]" class="regular-text code">';
	foreach ( $languages as $lang_code => $lang_name ) {
		$selected = selected( $selected_language, $lang_code, false );
		echo '<option value="' . esc_attr( $lang_code ) . '"' . esc_attr( $selected ) . '>' . esc_html( $lang_name ) . '</option>';
	}
	echo '</select>';
	echo '<span class="description d-block mt-5">' . esc_html__( 'Select the language for the AI model.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_temperature_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['temperature'] ?? '';
	echo '<input type="text" name="wpaisaas_chat_settings[temperature]" placeholder="' . esc_attr__( '0.8', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter the temperature here.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_max_tokens_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['max_tokens'] ?? '';
	echo '<input type="number" name="wpaisaas_chat_settings[max_tokens]" placeholder="' . esc_attr__( '1000', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter the max tokens here.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_frequency_penalty_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['frequency_penalty'] ?? '';
	echo '<input type="text" name="wpaisaas_chat_settings[frequency_penalty]" placeholder="' . esc_attr__( '0', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter the frequency penalty here.', 'gpt-ai-saas' ) . '</span>';
}

function wpaisaas_presence_penalty_callback() {
	$options = get_option( 'wpaisaas_chat_settings' );
	$value   = $options['presence_penalty'] ?? '';
	echo '<input type="text" name="wpaisaas_chat_settings[presence_penalty]" placeholder="' . esc_attr__( '0', 'gpt-ai-saas' ) . '" value="' . esc_attr( $value ) . '" size="64" class="regular-text code"><br>';
	echo '<span class="description">' . esc_html__( 'Enter the presence penalty here.', 'gpt-ai-saas' ) . '</span>';
}

// Callbacks for AI Models section
function wpaisaas_ai_model_section_callback() {
	echo '<p>' . esc_html__( 'Select your preferred AI model below.', 'gpt-ai-saas' ) . '</p>';
}

function wpaisaas_chat_model_callback() {
	$options        = get_option( 'wpaisaas_ai_model_settings' );
	$selected_model = $options['model'] ?? '';
	$models         = [
		'davinci-002'            => esc_html__( 'Davinci-002', 'gpt-ai-saas' ),
		'babbage-002'            => esc_html__( 'Babbage-002', 'gpt-ai-saas' ),
		'gpt-3.5-turbo'          => esc_html__( 'GPT-3.5 Turbo', 'gpt-ai-saas' ),
		'gpt-3.5-turbo-0125'     => esc_html__( 'GPT-3.5 Turbo 0.125', 'gpt-ai-saas' ),
		'gpt-3.5-turbo-instruct' => esc_html__( 'GPT-3.5 Turbo Instruct', 'gpt-ai-saas' ),
		'gpt-4'                  => esc_html__( 'GPT-4', 'gpt-ai-saas' ),
		'gpt-4-32k'              => esc_html__( 'GPT-4 32k', 'gpt-ai-saas' ),
	];

	echo '<select name="wpaisaas_ai_model_settings[model]" class="regular-text code">';
	foreach ( $models as $model_code => $model_name ) {
		$selected = selected( $selected_model, $model_code, false );
		echo '<option value="' . esc_attr( $model_code ) . '"' . esc_attr( $selected ) . '>' . esc_html( $model_name ) . '</option>';
	}
	echo '</select>';
	echo '<span class="description d-block mt-5">' . esc_html__( 'Select the model for the AI chat.', 'gpt-ai-saas' ) . '</span>';
}

// Save the options
function wpaisaas_save_options() {

	// Check the nonce for security
	if ( ! isset( $_POST['wpaisaas_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wpaisaas_wpnonce'] ) ), 'wpaisaas_options_nonce' ) ) {
		wp_die( esc_html__( 'Nonce verification failed', 'gpt-ai-saas' ) );
	}

	if ( isset( $_POST['wpaisaas_api_settings'] ) && is_array( $_POST['wpaisaas_api_settings'] ) ) {
		$api_settings = array_map( 'sanitize_text_field', $_POST['wpaisaas_api_settings'] );
	} else {
		$api_settings = array();
	}

	// Sanitize Chat settings
	if ( isset( $_POST['wpaisaas_chat_settings'] ) ) {
		$chat_settings = array_map( 'sanitize_text_field', $_POST['wpaisaas_chat_settings'] );
	} else {
		$chat_settings = '';
	}

	// Sanitize AI Model settings
	if ( isset( $_POST['wpaisaas_ai_model_settings'] ) ) {
		$ai_model_settings = array_map( 'sanitize_text_field', $_POST['wpaisaas_ai_model_settings'] );
	} else {
		$ai_model_settings = '';
	}

	// Save API settings
	if ( ! empty( $api_settings ) ) {
		update_option( 'wpaisaas_api_settings', $api_settings );
	}

	// Save Chat settings
	if ( ! empty( $chat_settings ) ) {
		update_option( 'wpaisaas_chat_settings', $chat_settings );
	}

	// Save AI Model settings
	if ( ! empty( $ai_model_settings ) ) {
		update_option( 'wpaisaas_ai_model_settings', $ai_model_settings );
	}

	// Redirect back to the settings page with a success message
	wp_redirect( add_query_arg( 'settings-updated', 'true', wp_get_referer() ) );
	exit;
}

add_action( 'admin_post_wpaisaas_save_options', 'wpaisaas_save_options' );
