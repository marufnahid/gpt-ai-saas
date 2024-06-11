function copyToClipboard() {
    var copyText = document.getElementById("chatOutput");
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand("copy");
}

jQuery(document).ready(function ($) {

    $('#hashtagSubmit').on('click', function() {
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
                //console.log(response)
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

    $('#conversationSubmit').on('click', function () {
        var inputText = $('#textareaPrompt').val();
        var nonce = $('#conversation_nonce').val();
        if (inputText === '') {
            Toastify({
                text: "Please enter your question!",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #cb0c9f2e, #cb0c9f)",
                }
            }).showToast();
            return;
        }
        $('#conversationSubmit').prop('disabled', true);
        $("#chatOutput").val('AI is thinking...');
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'chat_api_request',
                input_text: inputText,
                nonce: nonce
            },
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response.data);
                if (data.object === 'chat.completion') {
                    if (data.choices && data.choices.length > 0) {
                        var messageContent = data.choices[0].message.content;
                        $('#chatOutput').val(messageContent);
                    } else {
                        Toastify({
                            text: data['error'],
                            className: "alert",
                            style: {
                                background: "linear-gradient(to right, #cb0c9f2e, #cb0c9f)",
                            }
                        }).showToast();
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
            error: function (error) {
                $('#conversationSubmit').prop('disabled', false);
                Toastify({
                    text: error.message,
                    className: "alert",
                    style: {
                        background: "linear-gradient(to right, #cb0c9f2e, #cb0c9f)",
                    }
                }).showToast();
            },
            complete: function () {
                $('#conversationSubmit').prop('disabled', false);
            }
        });

    });


    $('#codeSubmit').on('click', function () {
        var inputText = $('#textareaPrompt').val();
        var language = $('#lanugageSoftware').val();
        var nonce = $('#code_nonce').val();

        if (inputText === '' || language === '') {
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
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'code_api_request',
                input_text: inputText,
                language: language,
                nonce: nonce
            },
            success: function (response) {
                //console.log(response);
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
            error: function (error) {
                Toastify({
                    text: error.message,
                    className: "alert",
                    style: {
                        background: "linear-gradient(to right, #cb0c9f2e, #cb0c9f)",
                    }
                }).showToast();
            },
            complete: function () {
                $('#conversationSubmit').prop('disabled', false);
            }
        });
    });
});