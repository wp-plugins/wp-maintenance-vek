<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo !empty($this->option['text_title']) ? $this->option['text_title']:' ';?></title>
    <link rel='stylesheet' href='<?php echo URL_CSS;?>bootstrap.css' type='text/css' media='' />
    <link rel='stylesheet' href='<?php echo URL_CSS;?>font-awesome.min.css' type='text/css' media='' />
    <link rel='stylesheet' href='<?php echo URL_CSS;?>bootstrap-social.css' type='text/css' media='' />
    <link rel='stylesheet' href='<?php echo URL_CSS;?>animate.css' type='text/css' media='' />
    <link rel='stylesheet' href='<?php echo URL_CSS;?>default.css' type='text/css' media='' />
</head>
<body>
<div class="navbar navbar-vekltd navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo !empty($this->option['title_page']) ? "<a class='navbar-brand' href='../'>{$this->option['title_page']}</a>":""; ?>
        </div>
        <div class="navbar-collapse collapse">
            <?php if(!is_user_logged_in()){?>
                <form class="navbar-form navbar-right" role="form" id="form_aut">
                    <span class="form_aut_result label label-info"></span>
                    <div class="form-group">
                        <div class="input-group input-group-sm login">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
                            <input type="text" class="form-control user_login" name="login" placeholder="Введите Логин">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-sm passw">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control user_password" name="password" placeholder="Введите Пароль">
                        </div>
                    </div>
                    <?php wp_nonce_field('vekltd_vekltd','vekltd_vekltd'); ?>
                    <input type="hidden" name="action" value="login_form">
                    <input type="submit" id="vhod"  name="login_form" value="Вход" data-loading-text="Вход" class="btn btn-default btn-sm"><!--name="login_form"-->
                </form>
            <?php }else{
                global $current_user;
                echo '<div class="navbar-right navbar-brand">';
                echo ' <i class="glyphicon glyphicon-user"></i> '.$current_user->user_login.' ';
                echo '<a href="'.wp_nonce_url('/?vekltd_logout','vekltd_logout').'" title="Выход">Выход</a><br>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<div class="container margin-top">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if($this->option['date_on_off']=='1') {?>
                Дата окончания технических работ  <font color="#767F85"><?php echo str_replace('-','/',$this->option['date'])?></font>
                <br>
            <?php } ?>
            <?php echo !empty($this->option['editpost']) ? $this->option['editpost']:''; ?>
        </div>
        <?php if($this->option['date_on_off']=='1') {?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tt">
                <div id="timer_end" class="text_end"></div>
                <div class="timers">
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="timer_days <?php echo $this->option['default_animated'];?> animated">
                            <div class="timer">
                                <canvas id="canvas_days" width="150" height="150"></canvas>
                                <div class="text">
                                    <p class="val_days"></p>
                                    <p class="type_days"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="timer_hours <?php echo $this->option['default_animated'];?> animated">
                            <div class="timer">
                                <canvas id="canvas_hours" width="150" height="150"></canvas>
                                <div class="text">
                                    <p class="val_hours"></p>
                                    <p class="type_hours"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="timer_minutes <?php echo $this->option['default_animated'];?> animated">
                            <div class="timer">
                                <canvas id="canvas_minutes" width="150" height="150"></canvas>
                                <div class="text">
                                    <p class="val_minutes"></p>
                                    <p class="type_minutes"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="timer_seconds <?php echo $this->option['default_animated'];?> animated">
                            <div class="timer">
                                <canvas id="canvas_seconds" width="150" height="150"></canvas>
                                <div class="text">
                                    <p class="val_seconds"></p>
                                    <p class="type_seconds"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($this->option['Rang']>=1){?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-default"  role="progressbar" aria-valuenow="<?php echo $this->option['Rang'];?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $this->option['Rang'];?>%"><?php echo $this->option['Rang'];?> %</div>
                </div>
            </div>
        <?php } ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form id="subscriber_email">
                <div class="form-group">
                    <div class="input-group input-group-sm">
                        <input type="text" name="email" value="" class="form-control" placeholder="example@example.com" style="border-radius: inherit">
                        <span class="input-group-btn">
                            <?php wp_nonce_field('subscriber_email','subscriber_email'); ?>
                            <input type="hidden" name="action" value="subscriber_email">
                            <input type="submit" class="btn btn-warning btn-sm" value="Подписатся" style="border-radius: inherit">
                        </span>
                    </div>
                    <span class="subscriber_email_result label label-info" style="position: absolute;border-radius: inherit"></span>
                </div>
            </form>
        </div>
        <?php if($this->option["mail_on_off"]=='1'){ ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">
                Обратная связь
            </button>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Обратная связь</h4>
                    </div>
                    <div class="modal-body">
                        <div id="result_mail" class="label label-info">Заполните форму</div>
                        <form id="form_mail" role="form">
                            <div class="mail_pl_name form-group has-feedback has-feedback-left">
                                <label class="control-label" for="inputSuccess2">Ваше имя</label>
                                <input type="text" name="name" size="32" maxlength="36" placeholder="Ваше имя" val="" class="form-control input-sm">
                                <i class="form-control-feedback fa fa-user"></i>
                                <span class="help-block name">Введите Имя</span>
                            </div>
                            <div class="form-group mail_pl_email has-feedback has-feedback-left">
                                <label class="control-label" for="inputSuccess2">Ваш email</label>
                                <input type="text" name="email" size="32" maxlength="36" placeholder="Ваш email" val="" class="form-control input-sm">
                                <i class="form-control-feedback fa fa-envelope"></i>
                                <span class="help-block email">Введите правельно email</span>
                            </div>
                            <div class="form-group mail_pl_message has-feedback has-feedback-left">
                                <label class="control-label" for="inputSuccess2">Сообщение</label>
                                <textarea cols="15" rows="5"  name="message"  maxlength="300" placeholder="Сообщение.." val="" class="form-control input-sm"></textarea>
                                <i class="form-control-feedback fa fa-file-text"></i>
                                <span class="help-block message">Введите текст сообщения</span>
                            </div>
                            <input type="hidden" name="action" value="mail_form">
                            <div class="form-group">
                                <?php wp_nonce_field('vekltd_mail','vekltd_mail'); ?>
                                <input type="submit" class="btn btn-success  pull-right btn-sm" id="send" value="Отправить"/>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="footer">
                <div class="social text-right">
                    <?php echo !empty($this->option['soc']['facebook']) ? '<a href="'.$this->option['soc']['facebook'].'" class="btn btn-social-icon  btn-facebook btn-xs" TARGET="_blank"><i class="fa fa-facebook"></i></a>':'';?>
                    <?php echo !empty($this->option['soc']['google']) ? '<a href="'.$this->option['soc']['google'].'" class="btn btn-social-icon  btn-google-plus btn-xs" TARGET="_blank"><i class="fa fa-google-plus"></i></a>':'';?>
                    <?php echo !empty($this->option['soc']['twiter']) ? '<a href="'.$this->option['soc']['twiter'].'" class="btn btn-social-icon  btn-twitter btn-xs" TARGET="_blank"><i class="fa fa-twitter"></i></a>':'';?>
                    <?php echo !empty($this->option['soc']['vk']) ? '<a href="'.$this->option['soc']['vk'].'" class="btn btn-social-icon  btn-vk btn-xs" TARGET="_blank"><i class="fa fa-vk"></i></a>':'';?>
                </div>
                <div class="copay">
                    <?php echo !empty($this->option['copy']) ? "<a href='../' class='copy'>{$this->option['copy']}</a>":""; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type='text/javascript' src='<?php echo includes_url();?>js/jquery/jquery.js'></script>
<script type='text/javascript' src='<?php echo URL_JS;?>bootstrap.min.js'></script>
<script type='text/javascript'>
    var aut_form = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>","redirecturl":"<?php echo $_SERVER['REQUEST_URI']; ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>aut.js'></script>
<?php if($this->option["mail_on_off"]=='1'){ ?>
    <script type='text/javascript'>
        var mail_form = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>"};
    </script>
    <script type='text/javascript' src='<?php echo URL_JS;?>mail.js'></script>
<?php } ?>
<script type='text/javascript'>
    var subscriber = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>subscriber.js'></script>
<?php if($this->option['date_on_off']=='1') {?>
<script type='text/javascript'>
    var vek_veks = {"times_v":"<?php echo str_replace('-','/',$this->option['date']); ?>","end_text":"<?php echo $this->option['time_end']; ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>api_n.js'></script>
<?php } ?>
<?php if (!empty($this->option['google_analytics'])){ ?>
    <!-- Google Analytics -->
    <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo $this->option['google_analytics']; ?>']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- End Google Analytics -->
<?php } ?>
</html>