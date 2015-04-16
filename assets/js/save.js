jQuery(document).ready(function($){
    $("#csv").click(function(){
        window.location.href = admin_save.ajaxurl+'?action=Wp_subscriber_email_csv';
    });

    $("#del_csv").click(function(e){
        e.preventDefault();
        $.ajax({
            url: admin_save.ajaxurl,
            method: "GET",
            data:{action:'Wp_subscriber_email_csv_del'},
            success: function(data) {
                var n = noty({
                    text        : '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Все подписчики удалены</div>',
                    type        : 'success',
                    maxVisible  : 8,
                    timeout     : 7000,
                    speed       : 4000,
                    layout      : 'topRight',
                    theme       : 'defaultTheme',
                    closable    : true,
                    closeOnSelfClick : true
                });
                setTimeout(function(){
                    location.reload();
                },1000)
            }
        });
        return false;
    });

    $("#form").mousedown(function(){
        tinyMCE.triggerSave();
    }).submit(function(e){
        e.preventDefault();
        var dataForm = $('#form').serialize();
        tinyMCE.triggerSave();
        $.ajax({
            action: 'Wp_save_update',
            url: admin_save.ajaxurl,
            method: "POST",
            data: dataForm,
            dataType: 'json',
            success: function(data) {
                var n = noty({
                    text        : data.mess,
                    type        : 'success',
                    maxVisible  : 8,
                    timeout     : 7000,
                    speed       : 4000,
                    layout      : 'topRight',
                    theme       : 'defaultTheme',
                    closable    : true,
                    closeOnSelfClick : true
                });
            }
        });
        return false;
    });

    $("#_reset").submit(function(e){
        e.preventDefault();
        var resetForm = $('#_reset').serialize();
        $.ajax({
            url: admin_save.ajaxurl,
            method: "POST",
            dataType: 'json',
            data: resetForm,
            success: function(data) {
                var n = noty({
                    text        : data,
                    type        : 'success',
                    maxVisible  : 8,
                    timeout     : 7000,
                    speed       : 4000,
                    layout      : 'topRight',
                    theme       : 'defaultTheme',
                    closable    : true,
                    closeOnSelfClick : true
                });
            }
        });
        return false;
    });
});