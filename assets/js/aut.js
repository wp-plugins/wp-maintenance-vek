jQuery(document).ready(function($){
    $("#form_aut").submit(function(e){
        $('.form_aut_result').show().text('Проверка формы');
        var error = false;
        if ($('.user_login').val() == '' || $('.user_password').val() == ''){
            var err = 'Заполните Логин/Пароль';
            $('.user_login').addClass('err');
            $('.user_password').addClass('err');
            error = true;
        }
        $('.form_aut_result').removeClass('label label-danger').addClass('label label-info').text(err);
        if (!error){
            var dataForm = $('#form_aut').serialize();
            $.ajax({
                url: aut_form.ajaxurl,
                data: dataForm,
                method: 'post',
                dataType: 'json',
                success: function(data,statusText,answer,response) {
                    $('.form_aut_result').text(data.message);
                    if (data.loggedin == true){
                        $('.form_aut_result').removeClass('label label-info').removeClass('label label-danger').addClass('label label-success').text(data.message);
                        $('.login').addClass('shake fadeout');
                        $('.passw').addClass('shake fadeout');
                        setTimeout(function(){document.location.href = aut_form.redirecturl},1500);
                    }else{
                        $('.form_aut_result').removeClass('label label-info').addClass('label label-danger').text(data.message);
                        $('.login,.passw').removeClass('shake'+' animated').addClass('shake' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $(this).removeClass('shake'+' animated');
                        });
                        $('.user_login,.user_password').addClass('err');
                    }
                }
            });
        }
        return false;
    });
});
