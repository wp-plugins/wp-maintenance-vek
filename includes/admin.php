<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Плагин: <?php echo $this->wp_plugin_name.'<small> Версия '.$this->wp_plugin_version.'</small>'; ?></h5>
                </div>
                <div class="ibox-content">
                    <form id="form" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Включение плагина</label>
                            <div class="col-sm-9">
                                <?php
                                $checked_on_1 =($this->option['on'] >= 1) ? 'checked="checked"':'';
                                $active_on_1 = ($this->option['on'] >= 1) ? 'active':'';

                                $checked_on_0 =($this->option['on'] >= 1) ? '':'checked="checked"';
                                $active_on_0 = ($this->option['on'] >= 1) ? '':'active';
                                ?>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default btn-xs <?php echo $active_on_1;?>"><input type="radio" name="on" id="optionsRadios2" value="1" <?= $checked_on_1?>>Включить</label>
                                    <label class="btn btn-default btn-xs <?php echo $active_on_0;?>"><input type="radio" name="on" id="optionsRadios1" value="0" <?=$checked_on_0?>>Выключить</label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Открыть сайта для ролей</label>
                            <div class="col-sm-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <?php
                                    global $wp_roles;
                                    $vek = $this->option['roles'];
                                    foreach($wp_roles->roles as $names => $name_roles){
                                        if ($names=='administrator')continue;
                                        $active_roles = (!empty($vek[$names])) ? 'active':'';
                                        $checked_roles = (!empty($vek[$names])) ? 'checked="checked"' : '';
                                        echo '<label class="btn btn-default btn-xs '.$active_roles.'"><input type="checkbox" name="roles_'.$names.'" id="'.$names.'" value="'.$names.'" '.$checked_roles.'/>'.$name_roles['name'].'</label>';}
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Заголовок страници</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="text_title" name="text_title" value="<?php echo $this->option['text_title']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Название страници</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="title_page" name="title_page" value="<?php echo $this->option['title_page']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Текст Страници</label>
                            <div class="col-sm-9">
                                <?php
                                $args = array( 'wpautop' => 1,
                                    'media_buttons' => 0,
                                    'textarea_name' => 'editpost', //нужно указывать!
                                    'textarea_rows' => 8,
                                    'tabindex'      => null,
                                    'editor_css'    => '',
                                    'editor_class'  => '',
                                    'teeny'         => 0,
                                    'dfw'           => 0,
                                    'tinymce'       => 1,
                                    'quicktags'     => 1,
                                    'drag_drop_upload' => false
                                );
                                wp_editor( stripslashes($this->option['editpost']), 'editpost', $args );
                                ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Стиль шаблона</label>
                            <div class="col-sm-9">
                                <div class="btn-group" data-toggle="buttons">
                                    <?php
                                    if(!empty($this->option['style'])){
                                        foreach($this->option['style'] as $style => $style_name){
                                            $active_style = ($this->option['style_default'] === $this->option['style'][$style]) ? 'active':'';
                                            $checked_style = ($this->option['style_default'] === $this->option['style'][$style]) ? 'checked="checked"' : '';
                                            echo '<label class="btn btn-default btn-xs '.$active_style.'"><input type="radio" name="style_default" value="'.$this->option['style'][$style].'" '.$checked_style.'/>';
                                            echo $style_name;
                                            echo '</label>';
                                        }
                                    }else{
                                        echo 'ошибка db';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Подписчики</label>
                            <div class="col-sm-9">
                                <div class="form-control" style="border: none"> <?php $this->subscriber_email_views();?></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Таймер</label>
                            <div class="col-sm-9">
                                <?php
                                $checked_date_on_off_1 =($this->option['date_on_off'] >= 1) ? 'checked="checked"':'';
                                $active_date_on_off_1 = ($this->option['date_on_off'] >= 1) ? 'active':'';

                                $checked_date_on_off_0 =($this->option['date_on_off'] >= 1) ? '':'checked="checked"';
                                $active_date_on_off_0 = ($this->option['date_on_off'] >= 1) ? '':'active';
                                ?>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default btn-xs <?php echo $active_date_on_off_1;?>"><input type="radio" name="date_on_off" id="optionsRadios2" value="1" <?= $checked_date_on_off_1?>>Включить</label>
                                    <label class="btn btn-default btn-xs <?php echo $active_date_on_off_0;?>"><input type="radio" name="date_on_off" id="optionsRadios1" value="0" <?=$checked_date_on_off_0?>>Выключить</label>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="col-xs-11 col-xs-offset-1">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Дата и время</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                                <input  type="text" id='date' class="form-control"  style="cursor: pointer;" name="date" value="<?php echo $this->option['date']?>" readonly/> <!--readonly-->
                                            </div>
                                            <script type="text/javascript">
                                                jQuery(document).ready(function($){
                                                    $('#date').datetimepicker({
                                                        minDate:0,
                                                        format:'Y-m-d H:i:s',
                                                        inline:false,
                                                        lang:'ru',
                                                        closeOnWithoutClick :true,
                                                        minTime:0,
                                                        dayOfWeekStart: 1,
                                                        yearStart: 2015,
                                                        yearEnd: 2018,
                                                        mask:true,
                                                        inline:false
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Анимация часов</label>
                                        <div class="col-sm-9">
                                            <div class="btn-group" data-toggle="buttons">
                                                <?php
                                                if(!empty($this->option['name_animated'])){
                                                    foreach($this->option['name_animated'] as $animated => $name_animated){
                                                        $active_name_animated = ($this->option['default_animated'] === $this->option['name_animated'][$animated]) ? 'active':'';
                                                        $checked_name_animated = ($this->option['default_animated'] === $this->option['name_animated'][$animated]) ? 'checked="checked"' : '';
                                                        echo '<label class="btn btn-default btn-xs '.$active_name_animated.'"><input type="radio" name="default_animated" value="'.$this->option['name_animated'][$animated].'" '.$checked_name_animated.'/>';
                                                        echo $name_animated;
                                                        echo '</label>';
                                                    }
                                                }else{
                                                    echo 'ошибка db';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Если вышло время</label>
                                        <div class="col-sm-9">
                                            <input  type="text" class="form-control"  name="time_end" value="<?php echo $this->option['time_end']?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Прогресс бар</label>
                            <div class="col-sm-9">
                                <input type="text" id="range_46"  name="Rang" value="<?php echo $this->option['Rang']?>" style="width: 10%;"/>
                                <script type='text/javascript'>
                                    jQuery(document).ready(function($){
                                        var $range = $("#range_46"),
                                            $result = $("#result_46");

                                        var track = function(data){
                                            $result.html(data.from);
                                        };

                                        $range.ionRangeSlider({
                                            type: "single",
                                            min: 0,
                                            max: 100,
                                            from: <?php echo $this->option['Rang']?>,
                                            step: 1,
                                            postfix:' %',
                                            onStart: track,
                                            onChange: track,
                                            onFinish: track,
                                            onUpdate: track
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Google Analytics</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="google_analytics"  name="google_analytics" placeholder="UA-XXXX-Y" value="<?=$this->option['google_analytics']?>" maxlength="20">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Копирайт сайта</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="copy"  name="copy" value="<?=$this->option['copy']?>"></td>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Обратная связь mail</label>
                            <div class="col-sm-9">
                                <?php
                                $checked_mail_on_off_1 =($this->option['mail_on_off'] >= 1) ? 'checked="checked"':'';
                                $active_mail_on_off_1 = ($this->option['mail_on_off'] >= 1) ? 'active':'';

                                $checked_mail_on_off_0 =($this->option['mail_on_off'] >= 1) ? '':'checked="checked"';
                                $active_mail_on_off_0 = ($this->option['mail_on_off'] >= 1) ? '':'active';

                                ?>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default btn-xs <?php echo $active_mail_on_off_1;?>"><input type="radio" name="mail_on_off" id="optionsRadios2" value="1" <?= $checked_mail_on_off_1?>>Включить</label>
                                    <label class="btn btn-default btn-xs <?php echo $active_mail_on_off_0;?>"><input type="radio" name="mail_on_off" id="optionsRadios1" value="0" <?=$checked_mail_on_off_0?>>Выключить</label>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="col-xs-11 col-xs-offset-1">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ваша почта</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="text" id="" name="" class="form-control input-sm" placeholder="<?php echo $admin_email = get_option('admin_email'); ?>" value="<?php echo $admin_email = get_option('admin_email'); ?>" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Социальные сети</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-facebook"></i>
                                            </span>
                                            <input type="text" id="facebook" name="facebook" class="form-control input-sm" value="<?php echo $this->option['soc']['facebook']?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Google+</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-google-plus-square"></i>
                                            </span>
                                            <input type="text" id="google" name="google" class="form-control input-sm" value="<?php echo $this->option['soc']['google']?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Twiter</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-twitter"></i>
                                            </span>
                                            <input type="text" id="twiter" name="twiter" class="form-control input-sm" value="<?php echo $this->option['soc']['twiter']?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Vk</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-vk"></i>
                                            </span>
                                            <input type="text" id="vk" name="vk" class="form-control input-sm" value="<?php echo $this->option['soc']['vk']?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Оставим блок
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                               test
                            </div>
                        </div>
                        -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <?php wp_nonce_field('security', 'vekltd'); ?>
                                <input type="hidden" name="action" value="Wp_save_update">
                                <input type="submit" value="Сохранить" id="fat-btn" class="btn btn-xs btn-success btn-block" data-loading-text="Сохранить" >
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#fat-btn').click(function(){
                                                var btn=$(this)
                                                btn.button('loading')
                                                setTimeout(function(){
                                                    btn.button('reset')
                                                },500)
                                            }
                                        );
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                    <form  id="_reset" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <?php wp_nonce_field( 'resets_security','resets_vekltd'); ?>
                                <input type="hidden" name="action" value="Wp_default_reset">
                                <input type="submit" id="_reset-btn" value="Сбросить" data-loading-text="Сбросить" class="btn btn-xs btn-info btn-block">
                                <script>
                                    jQuery(document).ready(function($){
                                        $('#_reset-btn').click(function(){
                                            var btn=$(this)
                                            btn.button('loading')
                                            setTimeout(function(){
                                                location.reload();
                                                btn.button('reset')
                                            },1000)
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Поддержите проект <b><?php echo $this->wp_plugin_name; ?></b></div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="<?php echo URL_IMG.'wmlogo_vector_blue.png';?>" width="128" height="auto" alt="webmoney">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading" id="top-aligned-media"><b>WebMoney</b></h4>
                            WMR R648993955789<br>
                            WMZ Z788696544748<br>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="<?php echo URL_IMG.'yandex_money.png';?>" width="128" height="auto" alt="webmoney">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading" id="top-aligned-media"><b>Яндекс деньги</b></h4>
                            410012612465453
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <a href="http://isvek.ru/donate" target="_blank" class="btn btn-danger btn-block">Пожертвовать</a>
                </div>
                <div class="panel-footer">
                    <a href="http://isvek.ru/wp-maintenance-vek" target="_blank" title="isvek.ru">isvek.ru</a>
                </div>
            </div>
        </div>
    </div>
</div>

