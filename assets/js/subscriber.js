/*!
 * WP_Maintenance_vek Subscriber v0.2 (http://isvek.ru/wp-maintenance-vek)
 * Copyright 2015 isvek.ru
 */
jQuery(document).ready(function($){
    $("#subscriber_email").submit(function(e){
        e.preventDefault();
        $('.subscriber_email_result').show().text(subscriber.langcheck);
        var error = false;
        if ($('input[name="email"]').val() == ''){
            var err = subscriber.langFilloutthefield;
            error = true;
        }
        $('.subscriber_email_result').removeClass('error').addClass('info').text(err); //.removeClass('label label-danger').addClass('label label-info')

        if (!error){
            var data = $('#subscriber_email').serialize();
            $.ajax({
                url: subscriber.ajaxurl,
                data: data,
                method: 'post',
                dataType: 'json',
                beforeSend: function(){
                    $('.loading').show().addClass('loading2');
                    $('.sss').attr('disabled','disabled');
                },
                success: function(data){
                    $('.loading').show().removeClass('loading2');
                    $('.sss').removeAttr('disabled');
                    $('.subscriber_email_result').text(data.mess);
                    if (data.success == true){
                        $('.subscriber_email_result').removeClass('info').removeClass('error').addClass('success').addClass('fadeIn' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(this).removeClass('fadeIn'+' animated');
                        }).text(data.mess);
                    }else{
                        $('.subscriber_email_result').removeClass('info').removeClass('success').addClass('error').addClass('fadeIn' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(this).removeClass('fadeIn'+' animated');
                        }).text(data.mess);
                    }
                }
            });
        }
        return false;
    });
});

