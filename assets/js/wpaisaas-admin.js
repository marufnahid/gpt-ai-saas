// admin-tabs.js
jQuery(document).ready(function($) {
    $('.tab-link').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');

        $('.nav-tabs li').removeClass('active');
        $(this).parent().addClass('active');

        $('.tab-pane').removeClass('active');
        $(target).addClass('active');
    });

    // $('#submit_api_settings').on('click', function(e) {
    //     e.preventDefault();
    //
    //     var data = {
    //         action: 'wpaisaas_save_api_settings',
    //         api_key: $('#api_key').val(),
    //     }
    //
    //     $.post(ajaxurl, data, function(response) {
    //         if(response.success) {
    //             $('#api_key').val('');
    //             $('#api_key').attr('placeholder', 'API Key updated successfully');
    //         }
    //     });
    //
    // });


});
