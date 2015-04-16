/**
 * Created by Олег on 06.04.2015.
 */
jQuery(document).ready(function($){
    $("#subscriber_email").submit(function(e){
        $('.subscriber_email_result').show().text('Проверка email');
        var error = false;
        if ($('input[name="email"]').val() == ''){
            var err = 'Заполните email';
            error = true;
        }
        $('.subscriber_email_result').removeClass('label label-danger').addClass('label label-info').text(err);
        if (!error){
            var data = $('#subscriber_email').serialize();
            $.ajax({
                url: subscriber.ajaxurl,
                data: data,
                method: 'post',
                dataType: 'json',
                success: function(data){
                    $('.subscriber_email_result').text(data.mess);
                    if (data.success == true){
                        $('.subscriber_email_result').removeClass('label label-info').removeClass('label label-danger').addClass('label label-success').text(data.mess);
                    }else{
                        $('.subscriber_email_result').removeClass('label label-info').addClass('label label-danger').text(data.mess);
                    }
                }
            })
        }
        return false;
    });
});