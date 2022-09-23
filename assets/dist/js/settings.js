$(function () {
    $('.smtp-options, .php-email-sender-warning').hide();
    
    $('#mail_transport_type').change(function () {
        var mailTransportType = $('#mail_transport_type').val();
        if (mailTransportType == 'smtp'){
            $('.smtp-options').show();
            $('.php-email-sender-warning').hide();
        }
        else {
            $('.smtp-options').hide();
            $('.php-email-sender-warning').show();
        }
    });
    
    var mailTransportType = $('#mail_transport_type').val();
    if (mailTransportType == 'smtp'){
        $('.smtp-options').show();
        $('.php-email-sender-warning').hide();
    }
    else {
        $('.smtp-options').hide();    
        $('.php-email-sender-warning').show();
    }

    // //TIME LIMIT FOR ACCOUNT ACTIVATION
    // var timeLimitForActivation = $('#time_limit_for_activation').val();
    // var timeLimitActivation = document.querySelector('.time_limit_activation');
    
    // $('#time_limit_for_activation').change(function() {
    //     timeLimitActivation.classList.toggle('d-none');
    // })
    
    // // HANYA BERLAKU JIKA MEMAINKAN D-NONE PADA DIV
    // if(timeLimitForActivation == 0)
    // timeLimitActivation.classList.toggle('d-none');
    // else
    // timeLimitActivation.classList.toggle('d-none');
    
    
    // //TIME LIMIT FOR RESET PASSWORD
    // var timeLimitForResetPassword = $('#time_limit_for_reset_password').val();
    // var timeLimitResetPassword = document.querySelector('.time_limit_reset_password');

    // $('#time_limit_for_reset_password').change(function() {
    //     timeLimitResetPassword.classList.toggle('d-none');
    // }) 
    
    // // HANYA BERLAKU JIKA MEMAINKAN D-NONE PADA DIV
    // if(timeLimitForResetPassword == 0)
    //     timeLimitResetPassword.classList.toggle('d-none');
    // else
    //     timeLimitResetPassword.classList.toggle('d-none');


    // TIME LIMIT FOR ACTIVATION
    $('#time_limit_for_activation').change(function () {
        var timeLimitForActivation = $('#time_limit_for_activation').val();
        if (timeLimitForActivation == 1)
            $('.time_limit_activation').show();
        else
            $('.time_limit_activation').hide();
    });
    
    var timeLimitForActivation = $('#time_limit_for_activation').val();
    if (timeLimitForActivation == 1)
            $('.time_limit_activation').show();
        else
            $('.time_limit_activation').hide();



    // TIME LIMIT FOR RESET PASSWORD  
    $('#time_limit_for_reset_password').change(function () {
        var timeLimitForResetPassword = $('#time_limit_for_reset_password').val();
        if (timeLimitForResetPassword == 1)
            $('.time_limit_reset_password').show();
        else
            $('.time_limit_reset_password').hide();
    });
    
    var timeLimitForResetPassword = $('#time_limit_for_reset_password').val();
    if (timeLimitForResetPassword == 1)
            $('.time_limit_reset_password').show();
        else
            $('.time_limit_reset_password').hide();

    var url = location.href;
    $('.nav-tabs>.nav-item').on('click', function () {
        var tab = $(this).data('tab');

        var href = new URL(url);
        href.searchParams.set('tab', tab); //Ubah params tab sesuai dengan tab yang diklik
        var newUrl = href.toString();
        ChangeUrl('', newUrl); // Ganti URL tanpa reload halaman
    })

    const ChangeUrl = (page, url) => { // ARROW FUNCTION
        if (typeof (history.pushState) != "undefined") {
            var obj = { Page: page, Url: url };
            history.pushState(obj, obj.Page, obj.Url);
        } else
            alert("Browser does not support HTML5.");
    }
})