/*!
 * WP_Maintenance_vek Mail v0.2 (http://isvek.ru/wp-maintenance-vek)
 * Copyright 2015 isvek.ru
 */
jQuery(document).ready(function($){
    $("#form_mail").submit(function(e){
        $('#result_mail').removeClass('alert alert-danger');
        $('#result_mail').show().text(mail.langcheck).addClass('alert alert-info');

        var data = $('#form_mail').serialize();
        $.ajax({
            url: mail.ajaxurl,
            data: data,
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#result_mail').removeClass('alert alert-info');
                $('#result_mail').text(data.message).addClass('alert alert-danger');
                if (data.meeserror.name_mail == true) {
                    $('.mail_pl_name').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_name_1').removeClass("glyphicon-ok");
                    $('.mail_pl_name_1').addClass("glyphicon-remove");
                    $('.name').show();
                } else {
                    $('.mail_pl_name_1').removeClass("glyphicon-remove");
                    $('.mail_pl_name_1').addClass("glyphicon-ok");
                    $('.mail_pl_name').removeClass("has-error");
                    $('.name').hide();
                }
                if (data.meeserror.email_mail == true) {
                    $('.mail_pl_email').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_email_1').removeClass("glyphicon-ok");
                    $('.mail_pl_email_1').addClass("glyphicon-remove");
                    $('.email').show();
                } else {
                    $('.mail_pl_email_1').removeClass("glyphicon-remove");
                    $('.mail_pl_email_1').addClass("glyphicon-ok");
                    $('.mail_pl_email').removeClass("has-error");
                    $('.email').hide();
                }
                if (data.meeserror.message_mail == true) {
                    $('.mail_pl_message').addClass("has-error"); //css({"border":"1px solid #E08787"}); has-success
                    $('.mail_pl_message_1').removeClass("glyphicon-ok");
                    $('.mail_pl_message_1').addClass("glyphicon-remove");
                    $('.message').show();
                } else {
                    $('.mail_pl_message_1').removeClass("glyphicon-remove");
                    $('.mail_pl_message_1').addClass("glyphicon-ok");
                    $('.mail_pl_message').removeClass("has-error");
                    $('.message').hide();
                }
                if (data.loggedin == true) {
                    $('#result_mail').removeClass('alert alert-danger');
                    $('#result_mail').addClass('alert alert-success');
                    $('#result_mail').removeClass('alert alert-success');
                    $('#result_mail').text(mail.langsend).addClass('alert alert-success');
                    $('.mess').addClass('flash animated');
                    $('#form_mail').hide();
                }
            }
        });
        return false;
    });
});