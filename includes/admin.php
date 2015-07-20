<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo _e('Плагин','lang'); ?> : <?php echo $this->wp_plugin_name; ?><small> <?php _e('Версия','lang'); echo ' '.$this->wp_plugin_version; ?> </small><?php if(WP_DEBUG == 'true')  echo '<small style="color:red;">WP_DEBUG Включен Возможны ошибки в плагине</small>';?></h5>
                </div>
                <div class="ibox-content">
                    <form id="form" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Включение плагина','lang'); ?></label>
                            <div class="col-sm-9">
                                <?php
                                $checked_on_1 =($this->option['on'] >= 1) ? 'checked="checked"':'';
                                $active_on_1 = ($this->option['on'] >= 1) ? 'active':'';

                                $checked_on_0 =($this->option['on'] >= 1) ? '':'checked="checked"';
                                $active_on_0 = ($this->option['on'] >= 1) ? '':'active';
                                ?>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default btn-xs <?php echo $active_on_1;?>"><input type="radio" name="on" id="optionsRadios2" value="1" <?= $checked_on_1?>><?php _e('Включить','lang'); ?></label>
                                    <label class="btn btn-default btn-xs <?php echo $active_on_0;?>"><input type="radio" name="on" id="optionsRadios1" value="0" <?=$checked_on_0?>><?php _e('Выключить','lang'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Открыть сайта для ролей','lang'); ?></label>
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
                            <label class="col-sm-3 control-label"><?php _e('Заголовок страници','lang'); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="text_title" name="text_title" value="<?php echo $this->option['text_title']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Название страници','lang'); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="title_page" name="title_page" value="<?php echo $this->option['title_page']?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Текст Страници','lang'); ?></label>
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
                            <label class="col-sm-3 control-label"><?php _e('Стиль шаблона','lang'); ?></label>
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
                                        _e('ошибка db','lang');
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Подписчики','lang'); ?></label>
                            <div class="col-sm-9">
                                <div class="form-control" style="border: none"> <?php $this->subscriber_email_views();?></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Таймер','lang'); ?></label>
                            <div class="col-sm-9">
                                <div class="col-xs-11 col-xs-offset-1">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php _e('Дата и время','lang'); ?></label>
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
                                        <label class="col-sm-3 control-label"><?php _e('Анимация часов','lang'); ?></label>
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
                                        <label class="col-sm-3 control-label"><?php _e('Если вышло время','lang'); ?></label>
                                        <div class="col-sm-9">
                                            <input  type="text" class="form-control"  name="time_end" value="<?php echo $this->option['time_end']?>"/>
                                        </div>
                                    </div>
                                </div>
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
                            <label class="col-sm-3 control-label"><?php _e('Обратная связь mail','lang'); ?></label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php _e('Ваша почта','lang'); ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" id="" name="" class="form-control input-sm" placeholder="<?php echo $admin_email = get_option('admin_email'); ?>" value="<?php echo $admin_email = get_option('admin_email'); ?>" disabled="disabled"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php _e('Социальные сети','lang'); ?></label>
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
                                <input type="submit" value="<?php _e('Сохранить','lang'); ?>" id="fat-btn" class="btn btn-xs btn-success btn-block" data-loading-text="<?php _e('Сохранить','lang'); ?>" >
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
                                <input type="submit" id="_reset-btn" value="<?php _e('Сбросить','lang'); ?>" data-loading-text="<?php _e('Сбросить','lang'); ?>" class="btn btn-xs btn-info btn-block">
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
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><?php _e('Поддержите проект','lang'); ?></div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body text-center">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
                            </form>
                        </div>
                    </div>
                    </div>
                <div class="panel-footer">
                    <a href="http://isvek.ru/wp-maintenance-vek" target="_blank" title="isvek.ru">isvek.ru</a>
                </div>
            </div>
        </div>
    </div>
</div>

