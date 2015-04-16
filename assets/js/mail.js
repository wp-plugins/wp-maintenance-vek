jQuery(document).ready(function($){
    $("#form_mail").submit(function(e){
        $('#result_mail').removeClass('label label-danger');
        $('#result_mail').show().text('Проверка формы').addClass('label label-info');

        //$('#ressssss').removeClass('alert alert-danger');
        var data = $('#form_mail').serialize();
        $.ajax({
            url: mail_form.ajaxurl,
            data: data,
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('#result_mail').removeClass('label label-info');
                $('#result_mail').text(data.message).addClass('label label-danger');
                if(data.meeserror.name_mail == true){
                    $('.mail_pl_name').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_name_1').removeClass("glyphicon-ok");
                    $('.mail_pl_name_1').addClass("glyphicon-remove");
                    $('.name').show();
                }else{
                    $('.mail_pl_name_1').removeClass("glyphicon-remove");
                    $('.mail_pl_name_1').addClass("glyphicon-ok");
                    $('.mail_pl_name').removeClass("has-error");
                    $('.mail_pl_name').addClass("has-success");
                    $('.name').hide();
                }
                if(data.meeserror.email_mail == true ){
                    $('.mail_pl_email').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_email_1').removeClass("glyphicon-ok");
                    $('.mail_pl_email_1').addClass("glyphicon-remove");
                    $('.email').show();
                }else {
                    $('.mail_pl_email_1').removeClass("glyphicon-remove");
                    $('.mail_pl_email_1').addClass("glyphicon-ok");
                    $('.mail_pl_email').removeClass("has-error");
                    $('.mail_pl_email').addClass("has-success");
                    $('.email').hide();
                }
                if(data.meeserror.message_mail == true){
                    $('.mail_pl_message').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_message_1').removeClass("glyphicon-ok");
                    $('.mail_pl_message_1').addClass("glyphicon-remove");
                    $('.message').show();
                }else{
                    $('.mail_pl_message_1').removeClass("glyphicon-remove");
                    $('.mail_pl_message_1').addClass("glyphicon-ok");
                    $('.mail_pl_message').removeClass("has-error");
                    $('.mail_pl_message').addClass("has-success");
                    $('.message').hide();
                }
                if(data.loggedin == true){
                    $('#result_mail').removeClass('label label-danger');
                    $('#result_mail').addClass('label label-success');
                    setTimeout(function(){
                        $('#result_mail').removeClass('label label-success');
                        $('#result_mail').text('Отправляю письмо').addClass('label label-info');
                        setTimeout(function(){
                            $('#result_mail').removeClass('label label-info');
                            $('#result_mail').text('Письмо отправленно!').addClass('label label-success');
                            $('#form_mail').addClass('fadeOut animated');
                            setTimeout(function(){
                                $('#form_mail').removeClass('fadeOut animated').hide();
                            },1000);
                        },2000)
                    },2000)
                }
            }
        });
        return false;
    });
});