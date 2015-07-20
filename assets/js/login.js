/*!
 * WP_Maintenance_vek Login v0.2 (http://isvek.ru/wp-maintenance-vek)
 * Copyright 2015 isvek.ru
 */
jQuery(document).ready(function($){
    $("#login").submit(function(e){
        $('.login_result').show().removeClass('alert alert-danger').addClass('alert alert-info').text(login.langcheck);
        var error = false;
        if ($('input[name="login"]').val() == '' || $('input[name="password"]').val() == ''){
            $('.logins').addClass('has-error');
            $('.password').addClass('has-error');
            $('.login_result').addClass('alert alert-info').text(login.langFilloutthefield);
            error = true;
        }
        if (!error){
            var dataForm = $('#login').serialize();
            $.ajax({
                url: login.ajaxurl,
                data: dataForm,
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('.login_result').text(data.message);
                    if (data.loggedin == true){
                        $('.logins').addClass('has-success');
                        $('.password').addClass('has-success');
                        $('.login_result').removeClass('alert alert-info').removeClass('alert alert-danger').addClass('alert alert-success').text(data.message);
                        $('.logins').addClass('shake fadeout');
                        $('.password').addClass('shake fadeout');
                        document.location.href = login.redirecturl;
                    }else{
                        $('.logins').addClass('has-error');
                        $('.password').addClass('has-error');
                        $('.login_result').removeClass('alert alert-info').addClass('alert alert-danger').text(data.message);
                        $('.logins, .password').removeClass('shake'+' animated').addClass('shake' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $(this).removeClass('shake'+' animated');
                        });
                    }
                }
            });
        }
        return false;
    });
});
