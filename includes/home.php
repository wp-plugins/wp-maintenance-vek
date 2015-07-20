<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo !empty($this->option['text_title']) ? $this->option['text_title']:' ';?></title>

    <!-- Bootstrap v3.3.4 -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>bootstrap.css' type='text/css' media='' />

    <!-- Font Awesome 4.3.0 -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>font-awesome.min.css' type='text/css' media='' />

    <!-- Social Buttons for Bootstrap -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>bootstrap-social.css' type='text/css' media='' />

    <!-- Animate.css -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>animate.css' type='text/css' media='' />

    <!-- Waves v0.7.2 -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>waves.min.css' type='text/css' media='' />

    <!-- WP Maintenance-vek skins -->
    <link rel='stylesheet' href='<?php echo URL_CSS; ?>skins/skins.css' type='text/css' media='' />
</head>
<body class="skins <?php echo $this->option['style_default']; ?>" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><?php echo $this->option['title_page']; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#page-top" class="page-scroll waves-effect waves-light waves-block"><i class="glyphicon glyphicon-home"></i> <?php _e('Главная','lang'); ?></a></li>
                <li><a href="#mail" class="page-scroll waves-effect waves-light waves-block"><i class="glyphicon glyphicon-envelope"></i> <?php _e('Контакты','lang'); ?></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header Section -->
<section id="header" class="header-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text-name text-center"><?php echo $this->option['editpost']; ?></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="fadeInLeft animated text-name-end"><i class="glyphicon glyphicon-time"></i> <?php _e('Осталось времени до запуска.','lang'); ?></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="row">
                        <div class="fadeIn animated t-hr"></div>
                        <div class="timers">
                            <div class="timer-days <?php echo $this->option['default_animated']; ?> col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <canvas id="canvas_days" width="150" height="150"> </canvas>
                            </div>
                            <div class="timer-hours <?php echo $this->option['default_animated']; ?> col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <canvas id="canvas_hours" width="150" height="150"> </canvas>
                            </div>
                            <div class="timer-minutes <?php echo $this->option['default_animated']; ?> col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <canvas id="canvas_minutes" width="150" height="150"> </canvas>
                            </div>
                            <div class="timer-seconds <?php echo $this->option['default_animated']; ?> col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <canvas id="canvas_seconds" width="150" height="150"> </canvas>
                            </div>
                        </div>
                        <div id="timer" class="animated fadeIn"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                    <div class="login-panel panel panel-default">
                        <?php if(!is_user_logged_in()){?>
                            <div class="panel-heading">
                                <div class="panel-title text-center"><?php _e('Авторизация','lang'); ?></div>
                            </div>
                            <div class="panel-body">
                                <div class="login_result"></div>
                                <form id="login">
                                    <div class="form-group has-feedback logins">
                                        <input type="text" name="login" placeholder="<?php _e('Логин','lang'); ?>" class="form-control input-sm">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback password">
                                        <input type="password" name="password" placeholder="<?php _e('Пароль','lang'); ?>" class="form-control input-sm">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <?php wp_nonce_field('vekltd_vekltd','vekltd_vekltd'); ?>
                                    <label>
                                        <input type="checkbox" name="remember" value="true"> <?php _e('Запомнить меня','lang'); ?>
                                    </label>
                                    <input type="hidden" name="action" value="login">
                                    <button type="submit" id="send_login" name="login" class="btn btn-info pull-right waves-effect waves-light"><?php _e('Вход','lang'); ?></button>
                                </form>
                            </div>
                        <?php }else{ ?>
                            <div class="panel-heading">
                                <div class="panel-title text-center"><?php _e('Добро пожаловать','lang'); ?>, <b><?php echo $current_user->user_login; ?></b>.</div>
                            </div>
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $current_user->first_name.' '.$current_user->last_name;?></h4>
                                        <small><?php echo $current_user->user_email; ?></small><br>
                                        <code><small><?php echo $current_user->user_login; ?>, <?php _e('Для вас сайт заблокирован.','lang'); ?></small></code>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <a href="<?php echo wp_nonce_url('/?vekltd_logout','vekltd_logout'); ?>" class="list-group-item"><?php _e('Выход','lang'); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="mail-subscriber">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                        <form id="subscriber_email">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="text" name="email" value="" class="form-control input-lg" placeholder="example@example.com" maxlength="51">
                                    <span class="input-group-btn">
                                        <?php wp_nonce_field('subscriber_email','subscriber_email'); ?>
                                        <input type="hidden" name="action" value="subscriber_email">
                                        <button type="submit" class="btn btn-warning btn-lg waves-effect waves-light"><?php _e('Подписаться','lang'); ?></button>
                                    </span>
                                </div>
                                <div class="subscriber_email_result"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="soc">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="socc">
                            <?php echo !empty($this->option['soc']['facebook']) ? '<a href="'.$this->option['soc']['facebook'].'" class="btn btn-social-icon btn-facebook" TARGET="_blank"><i class="fa fa-facebook"></i></a>':'';?>
                            <?php echo !empty($this->option['soc']['google']) ? '<a href="'.$this->option['soc']['google'].'" class="btn btn-social-icon btn-google-plus" TARGET="_blank"><i class="fa fa-google-plus"></i></a>':'';?>
                            <?php echo !empty($this->option['soc']['twiter']) ? '<a href="'.$this->option['soc']['twiter'].'" class="btn btn-social-icon btn-twitter" TARGET="_blank"><i class="fa fa-twitter"></i></a>':'';?>
                            <?php echo !empty($this->option['soc']['vk']) ? '<a href="'.$this->option['soc']['vk'].'" class="btn btn-social-icon btn-vk" TARGET="_blank"><i class="fa fa-vk"></i></a>':'';?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Mail Section -->
<section id="mail" class="mail-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="mail">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h1><i class="glyphicon glyphicon-envelope mess"></i> <?php _e('Обратная связь','lang'); ?></h1></div>
                        <div class="panel-body">
                            <div id="result_mail"></div>
                            <form id="form_mail" role="form">
                                <div class="mail_pl_name form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="inputSuccess2"><?php _e('Ваше имя','lang'); ?></label>
                                    <input type="text" name="name" size="32" maxlength="36" placeholder="<?php _e('Ваше имя','lang'); ?>" val="" class="form-control">
                                    <i class="form-control-feedback fa fa-user"></i>
                                </div>
                                <div class="form-group mail_pl_email has-feedback has-feedback-left">
                                    <label class="control-label" for="inputSuccess2"><?php _e('Ваш email','lang'); ?></label>
                                    <input type="text" name="email" size="32" maxlength="36" placeholder="<?php _e('Ваш email','lang'); ?>" val="" class="form-control">
                                    <i class="form-control-feedback fa fa-envelope"></i>
                                </div>
                                <div class="form-group mail_pl_message has-feedback has-feedback-left">
                                    <label class="control-label" for="inputSuccess2"><?php _e('Сообщение','lang'); ?></label>
                                    <textarea cols="15" rows="5"  name="message"  maxlength="300" placeholder="<?php _e('Сообщение...','lang'); ?>" val="" class="form-control input-sm"></textarea>
                                    <i class="form-control-feedback fa fa-file-text"></i>
                                </div>
                                <input type="hidden" name="action" value="mail_form">
                                <div class="form-group">
                                    <?php wp_nonce_field('vekltd_mail','vekltd_mail'); ?>
                                    <button type="submit" class="btn btn-success pull-right waves-effect waves-light" id="send" ><?php _e('Отправить','lang'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery v1.11.2 -->
<script type='text/javascript' src='<?php echo includes_url();?>js/jquery/jquery.js'></script>

<!-- Bootstrap v3.3.4 -->
<script type='text/javascript' src='<?php echo URL_JS;?>bootstrap.min.js'></script>

<!-- Waves v0.7.2 -->
<script type='text/javascript' src='<?php echo URL_JS;?>waves.min.js'></script>
<script type="text/javascript">
    (function(){
        Waves.init();
    })();
</script>

<!-- jQuery Easing v1.3 -->
<script type='text/javascript' src='<?php echo URL_JS;?>jquery.easing.min.js'></script>
<script type='text/javascript' src='<?php echo URL_JS;?>scrolling-nav.js'></script>

<!-- WP Maintenance-vek Login v0.2 -->
<script type='text/javascript'>
    var login = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>","redirecturl":"<?php echo $_SERVER['REQUEST_URI']; ?>","langcheck":"<?php _e('Проверка формы.','lang'); ?>","langFilloutthefield":"<?php _e('Заполните поля Логин | Пароль.','lang'); ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>login.js'></script>

<!-- WP Maintenance-vek Mail v0.2 -->
<script type='text/javascript'>
    var mail = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>","langcheck":"<?php _e('Проверка формы.','lang')?>","langsend":"<?php _e('Письмо отправлено.','lang'); ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>mail.js'></script>

<!-- WP Maintenance-vek Subscriber v0.2 -->
<script type='text/javascript'>
    var subscriber = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>","langcheck":"<?php _e('Проверка E-mail.','lang'); ?>","langFilloutthefield":"<?php _e('Заполните поле E-mail.','lang'); ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>subscriber.js'></script>

<!-- WP Maintenance-vek Countdown Timer v0.2 -->
<script type='text/javascript'>
    var countdowntimer = {
        "themes_style":"<?php echo $this->option['style_default'];?>",
        "date_timer":"<?php echo str_replace('-','/',$this->option['date']);?>",
        "end_text":"<?php echo $this->option['time_end'];?>",
        "langtimeD":"<?php _e('ДЕНЬ','lang'); ?>",
        "langtimeD1":"<?php _e('ДНЯ','lang'); ?>",
        "langtimeD2":"<?php _e('ДНЕЙ','lang'); ?>",
        "langtimeH":"<?php _e('ЧАС','lang'); ?>",
        "langtimeH1":"<?php _e('ЧАСА','lang'); ?>",
        "langtimeH2":"<?php _e('ЧАСОВ','lang'); ?>",
        "langtimeM":"<?php _e('МИНУТА','lang'); ?>",
        "langtimeM1":"<?php _e('МИНУТЫ','lang'); ?>",
        "langtimeM2":"<?php _e('МИНУТ','lang'); ?>",
        "langtimeS":"<?php _e('СЕКУНДА','lang'); ?>",
        "langtimeS1":"<?php _e('СЕКУНДЫ','lang'); ?>",
        "langtimeS2":"<?php _e('СЕКУНД','lang'); ?>"};
</script>
<script type='text/javascript' src='<?php echo URL_JS;?>api.js'></script>
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
</body>
</html>