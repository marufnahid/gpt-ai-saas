<?php
if (!defined('ABSPATH')) {
    die;
}

if (class_exists('CSF')) {

    $prefix = 'wpaisaas_';

    $encodedData = "PHN2ZyB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGwtcnVsZT0iZXZlbm9kZCIgaW1hZ2UtcmVuZGVyaW5nPSJvcHRpbWl6ZVF1YWxpdHkiIHRleHQtcmVuZGVyaW5nPSJnZW9tZXRyaWNQcmVjaXNpb24iIHNoYXBlLXJlbmRlcmluZz0iZ2VvbWV0cmljUHJlY2lzaW9uIj4KCiA8Zz4KICA8dGl0bGU+TGF5ZXIgMTwvdGl0bGU+CgogIDxnIGlkPSJzdmdfMTEiPgogICA8cGF0aCB0cmFuc2Zvcm09InJvdGF0ZSgtNiAyNDYgMjM2KSIgaWQ9InN2Z18yIiBkPSJtMzY4LjY4LDIxMC4wMTFhNzEuNDMyLDcxLjQzMiAwIDAgMCAzLjY1NCwtMjIuNTQxYTcxLjM4Myw3MS4zODMgMCAwIDAgLTkuNzgzLC0zNi4wNjRjLTEyLjg3MSwtMjIuNDA0IC0zNi43NDcsLTM2LjIzNiAtNjIuNTg3LC0zNi4yMzZhNzIuMzEsNzIuMzEgMCAwIDAgLTE1LjE0NSwxLjYwNGE3MS4zNjIsNzEuMzYyIDAgMCAwIC01My4zNywtMjMuOTkxbC0wLjQ1MywwbC0wLjE3LDAuMDAxYy0zMS4yOTcsMCAtNTkuMDUyLDIwLjE5NSAtNjguNjczLDQ5Ljk2N2E3MS4zNzIsNzEuMzcyIDAgMCAwIC00Ny43MDksMzQuNjE4YTcyLjIyNCw3Mi4yMjQgMCAwIDAgLTkuNzU1LDM2LjIyNmE3Mi4yMDQsNzIuMjA0IDAgMCAwIDE4LjYyOCw0OC4zOTVhNzEuMzk1LDcxLjM5NSAwIDAgMCAtMy42NTUsMjIuNTQxYTcxLjM4OCw3MS4zODggMCAwIDAgOS43ODMsMzYuMDY0YTcyLjE4Nyw3Mi4xODcgMCAwIDAgNzcuNzI4LDM0LjYzMWE3MS4zNzUsNzEuMzc1IDAgMCAwIDUzLjM3NCwyMy45OTJsMC40NTMsMGwwLjE4NCwtMC4wMDFjMzEuMzE0LDAgNTkuMDYsLTIwLjE5NiA2OC42ODEsLTQ5Ljk5NWE3MS4zODQsNzEuMzg0IDAgMCAwIDQ3LjcxLC0zNC42MTlhNzIuMTA3LDcyLjEwNyAwIDAgMCA5LjczNiwtMzYuMTk0YTcyLjIwMSw3Mi4yMDEgMCAwIDAgLTE4LjYyOCwtNDguMzk0bC0wLjAwMywtMC4wMDR6bS0xMDcuNjYyLDE1MC40ODFsLTAuMDc0LDBhNTMuNTc2LDUzLjU3NiAwIDAgMSAtMzQuMjg3LC0xMi40MjNhNDQuOTI4LDQ0LjkyOCAwIDAgMCAxLjY5NCwtMC45Nmw1Ny4wMzIsLTMyLjk0M2E5LjI3OCw5LjI3OCAwIDAgMCA0LjY4OCwtOC4wNmwwLC04MC40NTlsMjQuMTA2LDEzLjkxOWEwLjg1OSwwLjg1OSAwIDAgMSAwLjQ2OSwwLjY2MWwwLDY2LjU4NmMtMC4wMzMsMjkuNjA0IC0yNC4wMjIsNTMuNjE5IC01My42MjgsNTMuNjc5em0tMTE1LjMyOSwtNDkuMjU3YTUzLjU2Myw1My41NjMgMCAwIDEgLTcuMTk2LC0yNi43OThjMCwtMy4wNjkgMC4yNjgsLTYuMTQ2IDAuNzksLTkuMTdjMC40MjQsMC4yNTQgMS4xNjQsMC43MDYgMS42OTUsMS4wMTFsNTcuMDMyLDMyLjk0M2E5LjI4OSw5LjI4OSAwIDAgMCA5LjM3LC0wLjAwMmw2OS42MywtNDAuMjA1bDAsMjcuODM5bDAuMDAxLDAuMDQ4YTAuODY0LDAuODY0IDAgMCAxIC0wLjM0NSwwLjY5MWwtNTcuNjU0LDMzLjI4OGE1My43OTEsNTMuNzkxIDAgMCAxIC0yNi44MTcsNy4xN2E1My43NDYsNTMuNzQ2IDAgMCAxIC00Ni41MDYsLTI2LjgxOGwwLDAuMDAzem0tMTUuMDA0LC0xMjQuNTA2YTUzLjUsNTMuNSAwIDAgMSAyNy45NDEsLTIzLjUzNGMwLDAuNDkxIC0wLjAyOCwxLjM2MSAtMC4wMjgsMS45NjVsMCw2NS44ODdsLTAuMDAxLDAuMDU0YTkuMjcsOS4yNyAwIDAgMCA0LjY4MSw4LjA1M2w2OS42Myw0MC4xOTlsLTI0LjEwNSwxMy45MTlhMC44NjQsMC44NjQgMCAwIDEgLTAuODEzLDAuMDc0bC01Ny42NiwtMzMuMzE2YTUzLjc0Niw1My43NDYgMCAwIDEgLTI2LjgwNSwtNDYuNWE1My43ODcsNTMuNzg3IDAgMCAxIDcuMTYzLC0yNi43OThsLTAuMDAzLC0wLjAwM3ptMTk4LjA1NSw0Ni4wODlsLTY5LjYzLC00MC4yMDRsMjQuMTA2LC0xMy45MTRhMC44NjMsMC44NjMgMCAwIDEgMC44MTMsLTAuMDc0bDU3LjY1OSwzMy4yODhhNTMuNzEsNTMuNzEgMCAwIDEgMjYuODM1LDQ2LjQ5MWMwLDIyLjQ4OSAtMTQuMDMzLDQyLjYxMiAtMzUuMTMzLDUwLjM3OWwwLC02Ny44NTdjMC4wMDMsLTAuMDI1IDAuMDAzLC0wLjA1MSAwLjAwMywtMC4wNzZhOS4yNjUsOS4yNjUgMCAwIDAgLTQuNjUzLC04LjAzM3ptMjMuOTkzLC0zNi4xMTFhODEuOTE5LDgxLjkxOSAwIDAgMCAtMS42OTQsLTEuMDFsLTU3LjAzMiwtMzIuOTQ0YTkuMzEsOS4zMSAwIDAgMCAtNC42ODQsLTEuMjY2YTkuMzEsOS4zMSAwIDAgMCAtNC42ODQsMS4yNjZsLTY5LjYzMSw0MC4yMDVsMCwtMjcuODM5bC0wLjAwMSwtMC4wNDhjMCwtMC4yNzIgMC4xMjksLTAuNTI4IDAuMzQ2LC0wLjY5MWw1Ny42NTQsLTMzLjI2YTUzLjY5Niw1My42OTYgMCAwIDEgMjYuODE2LC03LjE3N2MyOS42NDQsMCA1My42ODQsMjQuMDQgNTMuNjg0LDUzLjY4NGE1My45MSw1My45MSAwIDAgMSAtMC43NzQsOS4wNzdsMCwwLjAwM3ptLTE1MC44MzEsNDkuNjE4bC0yNC4xMTEsLTEzLjkxOWEwLjg1OSwwLjg1OSAwIDAgMSAtMC40NjksLTAuNjYxbDAsLTY2LjU4N2MwLjAxMywtMjkuNjI4IDI0LjA1MywtNTMuNjQ4IDUzLjY4NCwtNTMuNjQ4YTUzLjcxOSw1My43MTkgMCAwIDEgMzQuMzQ5LDEyLjQyNmMtMC40MzQsMC4yMzcgLTEuMTkxLDAuNjU1IC0xLjY5NCwwLjk2bC01Ny4wMzIsMzIuOTQzYTkuMjcyLDkuMjcyIDAgMCAwIC00LjY4Nyw4LjA1N2wwLDAuMDUzbC0wLjA0LDgwLjM3NnptMTMuMDk1LC0yOC4yMzNsMzEuMDEyLC0xNy45MTJsMzEuMDEyLDE3LjlsMCwzNS44MTJsLTMxLjAxMiwxNy45MDFsLTMxLjAxMiwtMTcuOTAxbDAsLTM1Ljh6IiBmaWxsLXJ1bGU9Im5vbnplcm8iIGZpbGw9IiMwMDAwMDAiLz4KICAgPHJlY3QgdHJhbnNmb3JtPSJyb3RhdGUoLTQ3IDM4NS4zOTkgMzYwLjEwOCkiIHN0cm9rZT0ibnVsbCIgcng9IjEwIiBpZD0ic3ZnXzYiIGhlaWdodD0iMTUwIiB3aWR0aD0iMjEuMjk2MTMiIHk9IjI4NS4xMDgyOSIgeD0iMzc0Ljc1MDk0IiBmaWxsPSIjMDAwMDAwIi8+CiAgPC9nPgogPC9nPgo8L3N2Zz4=";

    $license_type = get_option('wpaisaas_license_type') !== null ? get_option('wpaisaas_license_type') : 'free';

    CSF::createOptions($prefix, array(
        'menu_title' => esc_html__('GPT AI SaaS', 'wpaisaas'),
        'menu_slug' => 'wpaisaas',
        'menu_icon' => 'data:image/svg+xml;base64,' . $encodedData,
        'framework_title' => esc_html__('GPT AI SaaS Settings', 'wpaisaas'),
        'theme' => 'light',
        'footer_text' => sprintf(
            'You are using the %1$s version. Update your license <a href="%2$s">here</a>.',
            esc_html($license_type),
            esc_url(admin_url('admin.php?page=wpaisaas#tab=pro-settings'))
        ),
        'footer_credit' => sprintf(
            'Thanks for using WP AI SaaS. Powered by <a href="%s" target="_blank">WPGPT</a>',
            esc_url('https://github.com/marufnahid')
        ),
    ));

    CSF::createSection($prefix, array(
        'title' => esc_html__('API Settings', 'wpaisaas'),
        'fields' => array(
            array(
                'id' => 'openai_api_key',
                'type' => 'text',
                'title' => esc_html__('OpenAI API Key', 'wpaisaas'),
                'desc' => sprintf(
                    'Get your API key from OpenAI. <a href="%1$s">Here</a>.',
                    esc_url('https://platform.openai.com/account/api-keys')),
                'help' => esc_html__('This is required for the AI models to work.', 'wpaisaas'),
            ),
            array(
                'id' => 'ocr_api_key',
                'type' => 'text',
                'title' => esc_html__('OCR API Key', 'wpaisaas'),
                'desc' => sprintf(
                    'Get your API key from OCR Space. <a href="%1$s">Here</a>.',
                    esc_url('https://ocr.space/ocrapi')),
                'help' => esc_html__('This is required for the OCR feature to work.', 'wpaisaas'),
            ),
        )
    ));

    CSF::createSection($prefix, array(
        'title' => esc_html__('Chat API Settings', 'wpaisaas'),
        'fields' => array(
            array(
                'id' => 'biz_details',
                'type' => 'text',
                'title' => esc_html__('Business Details', 'wpaisaas'),
                'desc' => esc_html__('Enter your business details here.', 'wpaisaas'),
                'placeholder' => esc_html__('Software Company, Real Estate Company', 'wpaisaas'),
            ),
            array(
                'id' => 'target_audience',
                'type' => 'text',
                'title' => esc_html__('Target Audience', 'wpaisaas'),
                'desc' => esc_html__('Enter your target audience here.', 'wpaisaas'),
                'placeholder' => esc_html__('Developers, Real Estate Agents', 'wpaisaas'),
            ),
            array(
                'id' => 'language',
                'type' => 'select',
                'title' => esc_html__('Language', 'wpaisaas'),
                'placeholder' => esc_html__('Select a language', 'wpaisaas'),
                'desc' => esc_html__('Select the language for the AI model.', 'wpaisaas'),
                'options' => array(
                    'Afrikaans' => esc_html__('Afrikaans', 'wpaisaas'),
                    'Arabic' => esc_html__('Arabic', 'wpaisaas'),
                    'Armenian' => esc_html__('Armenian', 'wpaisaas'),
                    'Bosnian' => esc_html__('Bosnian', 'wpaisaas'),
                    'Bulgarian' => esc_html__('Bulgarian', 'wpaisaas'),
                    'Chinese (Simplified)' => esc_html__('Chinese (Simplified)', 'wpaisaas'),
                    'Chinese (Traditional)' => esc_html__('Chinese (Traditional)', 'wpaisaas'),
                    'Croatian' => esc_html__('Croatian', 'wpaisaas'),
                    'Czech' => esc_html__('Czech', 'wpaisaas'),
                    'Danish' => esc_html__('Danish', 'wpaisaas'),
                    'Dutch' => esc_html__('Dutch', 'wpaisaas'),
                    'English' => esc_html__('English', 'wpaisaas'),
                    'Estonian' => esc_html__('Estonian', 'wpaisaas'),
                    'Filipino' => esc_html__('Filipino', 'wpaisaas'),
                    'Finnish' => esc_html__('Finnish', 'wpaisaas'),
                    'French' => esc_html__('French', 'wpaisaas'),
                    'German' => esc_html__('German', 'wpaisaas'),
                    'Greek' => esc_html__('Greek', 'wpaisaas'),
                    'Hebrew' => esc_html__('Hebrew', 'wpaisaas'),
                    'Hindi' => esc_html__('Hindi', 'wpaisaas'),
                    'Hungarian' => esc_html__('Hungarian', 'wpaisaas'),
                    'Indonesian' => esc_html__('Indonesian', 'wpaisaas'),
                    'Italian' => esc_html__('Italian', 'wpaisaas'),
                    'Japanese' => esc_html__('Japanese', 'wpaisaas'),
                    'Korean' => esc_html__('Korean', 'wpaisaas'),
                    'Latvian' => esc_html__('Latvian', 'wpaisaas'),
                    'Lithuanian' => esc_html__('Lithuanian', 'wpaisaas'),
                    'Malay' => esc_html__('Malay', 'wpaisaas'),
                    'Norwegian' => esc_html__('Norwegian', 'wpaisaas'),
                    'Persian' => esc_html__('Persian', 'wpaisaas'),
                    'Polish' => esc_html__('Polish', 'wpaisaas'),
                    'Portuguese' => esc_html__('Portuguese', 'wpaisaas'),
                    'Romanian' => esc_html__('Romanian', 'wpaisaas'),
                    'Russian' => esc_html__('Russian', 'wpaisaas'),
                    'Serbian' => esc_html__('Serbian', 'wpaisaas'),
                    'Slovak' => esc_html__('Slovak', 'wpaisaas'),
                    'Slovenian' => esc_html__('Slovenian', 'wpaisaas'),
                    'Spanish' => esc_html__('Spanish', 'wpaisaas'),
                    'Swedish' => esc_html__('Swedish', 'wpaisaas'),
                    'Thai' => esc_html__('Thai', 'wpaisaas'),
                    'Turkish' => esc_html__('Turkish', 'wpaisaas'),
                    'Ukrainian' => esc_html__('Ukrainian', 'wpaisaas'),
                    'Vietnamese' => esc_html__('Vietnamese', 'wpaisaas'),
                ),
                'default' => 'English'
            ),

            array(
                'id' => 'temperature',
                'type' => 'number',
                'title' => esc_html__('Temperature', 'wpaisaas'),
                'desc' => esc_html__('The higher the temperature, the more creative the AI will be. From 0 to 1', 'wpaisaas'),
                'default' => '1.0'
            ),
            array(
                'id' => 'max_tokens',
                'type' => 'number',
                'title' => esc_html__('Max Tokens', 'wpaisaas'),
                'desc' => esc_html__('The maximum number of tokens to generate. From 1 to 2048', 'wpaisaas'),
                'default' => '150'
            ),
            array(
                'id' => 'frequency_penalty',
                'type' => 'number',
                'title' => esc_html__('Frequency Penalty', 'wpaisaas'),
                'desc' => esc_html__('The higher the penalty, the less repetitive the AI will be. From 0 to 1', 'wpaisaas'),
                'default' => 0
            ),
            array(
                'id' => 'presence_penalty',
                'type' => 'number',
                'title' => esc_html__('Presence Penalty', 'wpaisaas'),
                'desc' => esc_html__('The higher the penalty, the less repetitive the AI will be. From 0 to 1', 'wpaisaas'),
                'default' => 0.6
            ),
        )
    ));

    CSF::createSection($prefix, array(
        'title' => esc_html__('AI Models', 'wpaisaas'),
        'desc' => esc_html__('Select the AI models you want to use.', 'wpaisaas'),
        'fields' => array(

            array(
                'id' => 'chat_model',
                'type' => 'select',
                'title' => esc_html__('Chat Model', 'wpaisaas'),
                'desc' => esc_html__('Select the AI model for chat.', 'wpaisaas'),
                'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                'options' => array(
                    'davinci-002' => esc_html__('davinci-002', 'wpaisaas'),
                    'babbage-002' => esc_html__('babbage-002', 'wpaisaas'),
                    'gpt-3.5-turbo' => esc_html__('gpt-3.5-turbo', 'wpaisaas'),
                    'gpt-3.5-turbo-0125' => esc_html__('gpt-3.5-turbo-0125', 'wpaisaas'),
                    'gpt-3.5-turbo-instruct' => esc_html__('gpt-3.5-turbo-instruct', 'wpaisaas'),
                    'gpt-3.5-turbo-16k' => esc_html__('gpt-3.5-turbo-16k', 'wpaisaas'),
                    'gpt-4' => esc_html__('gpt-4', 'wpaisaas'),
                ),
                'default' => 'gpt-3.5-turbo-0125'
            ),
            array(
                'id' => 'image_model',
                'type' => 'select',
                'title' => esc_html__('Image Model', 'wpaisaas'),
                'desc' => esc_html__('Select the AI model for image.', 'wpaisaas'),
                'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                'options' => array(
                    'dall-e-2' => esc_html__('dall-e-2', 'wpaisaas'),
                    'dall-e-3' => esc_html__('dall-e-3', 'wpaisaas'),
                ),
                'default' => 'dall-e-3'
            ),
            array(
                'id' => 'vision_model',
                'type' => 'select',
                'title' => esc_html__('Vision Model', 'wpaisaas'),
                'desc' => esc_html__('Select the AI model for vision.', 'wpaisaas'),
                'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                'options' => array(
                    'gpt-4-vision-preview' => esc_html__('gpt-4-vision-preview', 'wpaisaas'),
                ),
                'default' => 'gpt-4-vision-preview'
            ),
            array(
                'id' => 'tts_model',
                'type' => 'select',
                'title' => esc_html__('Text to Speech Model', 'wpaisaas'),
                'desc' => esc_html__('Select the AI model for text to speech.', 'wpaisaas'),
                'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                'options' => array(
                    'tts-1' => esc_html__('tts-1', 'wpaisaas'),
                    'tts-1-hd' => esc_html__('tts-1-hd', 'wpaisaas'),
                ),
                'default' => 'tts-1'
            ),
            array(
                'id' => 'stt_model',
                'type' => 'select',
                'title' => esc_html__('Speech to Text Model', 'wpaisaas'),
                'desc' => esc_html__('Select the AI model for speech to text.', 'wpaisaas'),
                'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                'options' => array(
                    'whisper-1' => esc_html__('whisper-1', 'wpaisaas'),
                ),
                'default' => 'whisper-1'
            ),
        )
    ));

    if (!empty($license_type) && 'pro' === $license_type) {
        CSF::createSection($prefix, array(
            'title' => esc_html__('Pricing Settings', 'wpaisaas'),
            'fields' => array(
                array(
                    'id' => 'pricing_table',
                    'type' => 'tabbed',
                    'title' => esc_html__('Pricing Table', 'wpaisaas'),
                    'tabs' => array(
                        array(
                            'title' => esc_html__('Basic', 'wpaisaas'),
                            'fields' => array(
                                array(
                                    'id' => 'plan_title_free',
                                    'type' => 'text',
                                    'title' => esc_html__('Plan Title', 'wpaisaas'),
                                    'desc' => esc_html__('Enter the title for the plan.', 'wpaisaas'),
                                ),
                                array(
                                    'id' => 'free_plan_price',
                                    'type' => 'text',
                                    'title' => esc_html__('Price', 'wpaisaas'),
                                    'desc' => esc_html__('Enter the price for the plan.', 'wpaisaas'),
                                ),
                                array(
                                    'id' => 'free_plan_price_period',
                                    'type' => 'select',
                                    'title' => esc_html__('Period', 'wpaisaas'),
                                    'desc' => esc_html__('Select the period for the plan.', 'wpaisaas'),
                                    'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                                    'options' => array(
                                        'monthly' => esc_html__('Monthly', 'wpaisaas'),
                                        'half_yearly' => esc_html__('Half Yearly', 'wpaisaas'),
                                        'yearly' => esc_html__('Yearly', 'wpaisaas'),
                                    ),
                                    'default' => 'monthly'
                                ),

                                array(
                                    'id' => 'free_sorter',
                                    'type' => 'sorter',
                                    'title' => esc_html__('Features', 'wpaisaas'),
                                    'desc' => esc_html__('Select the features for the plan.', 'wpaisaas'),
                                    'default' => array(
                                        'enabled' => array(
                                            'conversation' => esc_html__('Conversation', 'wpaisaas'),
                                        ),
                                        'disabled' => array(
                                            'hashtag' => esc_html__('Hashtag Generation', 'wpaisaas'),
                                            'code' => esc_html__('Code Generation', 'wpaisaas'),
                                            'image' => esc_html__('Image Generation', 'wpaisaas'),
                                            'music' => esc_html__('Music Generation', 'wpaisaas'),
                                            'voice' => esc_html__('Voice Generation', 'wpaisaas'),
                                            'ocr' => esc_html__('OCR', 'wpaisaas'),
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 'btn_title_free',
                                    'type' => 'text',
                                    'title' => esc_html__('Button Title', 'wpaisaas'),
                                    'desc' => esc_html__('Enter the title for the button.', 'wpaisaas'),
                                ),
                            )
                        ),
                        array(
                            'title' => esc_html__('Pro', 'wpaisaas'),
                            'fields' => array(
                                array(
                                    'id' => 'plan_title_pro',
                                    'type' => 'text',
                                    'title' => esc_html__('Plan Title', 'wpaisaas'),
                                    'desc' => esc_html__('Enter the title for the plan.', 'wpaisaas'
                                    ),
                                    array(
                                        'id' => 'pro_plan_price',
                                        'type' => 'text',
                                        'title' => esc_html__('Price', 'wpaisaas'),
                                        'desc' => esc_html__('Enter the price for the plan.', 'wpaisaas'),
                                    ),
                                    array(
                                        'id' => 'pro_plan_price_period',
                                        'type' => 'select',
                                        'title' => esc_html__('Period', 'wpaisaas'),
                                        'desc' => esc_html__('Select the period for the plan.', 'wpaisaas'),
                                        'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                                        'options' => array(
                                            'monthly' => esc_html__('Monthly', 'wpaisaas'),
                                            'half_yearly' => esc_html__('Half Yearly', 'wpaisaas'),
                                            'yearly' => esc_html__('Yearly', 'wpaisaas'),
                                        ),
                                        'default' => 'monthly'
                                    ),
                                    array(
                                        'id' => 'pro_sorter',
                                        'type' => 'sorter',
                                        'title' => esc_html__('Features', 'wpaisaas'),
                                        'desc' => esc_html__('Select the features for the plan.', 'wpaisaas'),
                                        'default' => array(
                                            'enabled' => array(
                                                'conversation' => esc_html__('Conversation', 'wpaisaas'),
                                                'hashtag' => esc_html__('Hashtag Generation', 'wpaisaas'),
                                                'code' => esc_html__('Code Generation', 'wpaisaas'),
                                            ),
                                            'disabled' => array(
                                                'image' => esc_html__('Image Generation', 'wpaisaas'),
                                                'music' => esc_html__('Music Generation', 'wpaisaas'),
                                                'voice' => esc_html__('Voice Generation', 'wpaisaas'),
                                                'ocr' => esc_html__('OCR', 'wpaisaas'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'id' => 'btn_title_pro',
                                        'type' => 'text',
                                        'title' => esc_html__('Button Title', 'wpaisaas'),
                                        'desc' => esc_html__('Enter the title for the button.', 'wpaisaas'),
                                    ),
                                )
                            ),
                        ),
                        array(
                            'title' => esc_html__('Enterprise', 'wpaisaas'),
                            'fields' => array(
                                array(
                                    'id' => 'plan_title_enterprise',
                                    'type' => 'text',
                                    'title' => esc_html__('Plan Title', 'wpaisaas'),
                                    'desc' => esc_html__('Enter the title for the plan.', 'wpaisaas'
                                    ),
                                    array(
                                        'id' => 'enterprise_plan_price',
                                        'type' => 'text',
                                        'title' => esc_html__('Price', 'wpaisaas'),
                                        'desc' => esc_html__('Enter the price for the plan.', 'wpaisaas'),
                                    ),
                                    array(
                                        'id' => 'enterprise_plan_price_period',
                                        'type' => 'select',
                                        'title' => esc_html__('Period', 'wpaisaas'),
                                        'desc' => esc_html__('Select the period for the plan.', 'wpaisaas'),
                                        'placeholder' => esc_html__('Select an option', 'wpaisaas'),
                                        'options' => array(
                                            'monthly' => esc_html__('Monthly', 'wpaisaas'),
                                            'half_yearly' => esc_html__('Half Yearly', 'wpaisaas'),
                                            'yearly' => esc_html__('Yearly', 'wpaisaas'),
                                        ),
                                        'default' => 'monthly'
                                    ),
                                    array(
                                        'id' => 'enterprise_sorter',
                                        'type' => 'sorter',
                                        'title' => esc_html__('Features', 'wpaisaas'),
                                        'desc' => esc_html__('Select the features for the plan.', 'wpaisaas'),
                                        'default' => array(
                                            'enabled' => array(
                                                'conversation' => esc_html__('Conversation', 'wpaisaas'),
                                                'hashtag' => esc_html__('Hashtag Generation', 'wpaisaas'),
                                                'code' => esc_html__('Code Generation', 'wpaisaas'),
                                                'image' => esc_html__('Image Generation', 'wpaisaas'),
                                                'music' => esc_html__('Music Generation', 'wpaisaas'),
                                                'voice' => esc_html__('Voice Generation', 'wpaisaas'),
                                                'ocr' => esc_html__('OCR', 'wpaisaas'),
                                            ),
                                            'disabled' => array(),
                                        ),
                                    ),
                                    array(
                                        'id' => 'btn_title_enterprise',
                                        'type' => 'text',
                                        'title' => esc_html__('Button Title', 'wpaisaas'),
                                        'desc' => esc_html__('Enter the title for the button.', 'wpaisaas'
                                        ),
                                    )
                                ),
                            ),
                            'default' => array(
                                'plan_title_enterprise' => esc_html__('Enterprise', 'wpaisaas'),
                                'plan_title_pro' => esc_html__('Pro', 'wpaisaas'),
                                'plan_title_free' => esc_html__('Free', 'wpaisaas'),
                                'btn_title_enterprise' => esc_html__('Contact Us', 'wpaisaas'),
                                'btn_title_pro' => esc_html__('Get Started', 'wpaisaas'),
                                'btn_title_free' => esc_html__('Sign Up For Free', 'wpaisaas'),
                            )
                        ),
                    ),
                ),
            ),
        ));

        CSF::createSection($prefix, array(
            'title' => esc_html__('Payment Settings', 'wpaisaas'),
            'fields' => array(
                array(
                    'id' => 'payment_settings',
                    'type' => 'tabbed',
                    'title' => esc_html__('Payments Settings', 'wpaisaas'),
                    'tabs' => array(
                        array(
                            'title' => esc_html__('Stripe', 'wpaisaas'),
                            'fields' => array(
                                array(
                                    'id' => 'stripe_publishable_key',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Publishable Key', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your Publishable API key from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/apikeys')),
                                ),
                                array(
                                    'id' => 'stripe_secret_key',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Secret Key', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your Secret API key from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/apikeys')),
                                ),
                                array(
                                    'id' => 'stripe_webhook_secret',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Webhook Secret', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your Webhook API key from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/apikeys')),
                                ),
                                array(
                                    'id' => 'stripe_price_id_free',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Price ID Free', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your price ID from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/prices')),
                                ),
                                array(
                                    'id' => 'stripe_price_id_pro',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Price ID Pro', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your price ID from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/prices')),
                                ),
                                array(
                                    'id' => 'stripe_price_id_enterprise',
                                    'type' => 'text',
                                    'title' => esc_html__('Stripe Price ID Enterprise', 'wpaisaas'),
                                    'desc' => sprintf(
                                        'Get your price ID from Stripe. <a href="%1$s">Here</a>.',
                                        esc_url('https://dashboard.stripe.com/prices')),
                                ),
                            )
                        ),
                    ),
                ),
            ),
        ));
    }

    CSF::createSection($prefix, array(
        'title' => esc_html__('Pro Settings', 'wpaisaas'),
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => sprintf(
                    'You are using the %1$s version. Visit our pro features <a href="%2$s" target="_blank">here</a>.',
                    esc_html($license_type),
                    esc_url('https://gptaisaas.rf.gd/general-generator')
                ),
            ),
            array(
                'type' => 'content',
                'content' => '
                <ul class="list-group">
                    <li class="list-group-item">1. 47+ AI generator templates with prompt engineering</li>
                    <li class="list-group-item">2. CKEditor integration</li>
                    <li class="list-group-item">3. Image Generation</li>
                    <li class="list-group-item">4. Support for multiple AI models</li>
                    <li class="list-group-item">5. Subscription-based pricing</li>
                    <li class="list-group-item">6. Custom AI training</li>
                    <li class="list-group-item">7. Less cost</li>
                    <li class="list-group-item">8. Stripe Payment</li>
                    <li class="list-group-item">9. More features</li>
                </ul>
            ',
            ),
            array(
                'type' => 'heading',
                'content' => sprintf(
                    'You can reveal the ChatGPT Power. <a href="%2$s" target="_blank">Buy Now</a>.',
                    esc_html($license_type),
                    esc_url('https://codecanyon.net/user/themesvro/portfolio')
                ),
            ),
        ),
    ));

}





