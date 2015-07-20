<?php
/**
 * WP Maintenance-vek
 * Plugin Name: WP Maintenance-vek
 * Plugin URI: http://isvek.ru/plug-ins/wp-maintenance-vek/
 * Description: The plug includes a maintenance page with a countdown timer and c Advanced Settings.
 * Version: 0.2
 * Author: Vek
 * Author URI: http://isvek.ru/vek
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class WP_Maintenance_vek{

	public $wp_plugin_name = 'WP Maintenance-vek';
	public $wp_plugin_url= 'http://isvek.ru/plug-ins/wp-maintenance-vek/';
    public $wp_plugin_author = 'vek';
    public $wp_plugin_version = '0.2';
    public $ver = '0.2';
    public $option;

	public function __construct(){
		$this->option = get_option('db_vek');

        add_action('plugins_loaded',array(&$this,'constants'),       1);
        add_action('plugins_loaded',array($this,'langss'),           2);
		add_action('admin_menu',array(&$this,'add_plugin_menu'));

        //Подключение ajax формы сохранения и сброса настроек
		add_action('wp_ajax_Wp_save_update',array($this,'update_db'));//Сохраняет настройки
		add_action('wp_ajax_Wp_default_reset',array($this,'resets_db'));//Сбрасывает настройки
        add_action('wp_ajax_Wp_subscriber_email_csv',array($this,'subscriber_email_csv'));
        add_action('wp_ajax_Wp_subscriber_email_csv_del',array($this,'subscriber_email_csv_del'));

        //Включаем или выключаем страницу технического обслуживания
		if($this->option["on"]=='1'){
            add_action('plugins_loaded',array($this,'wp_vek_logout'), 3);
            add_action('plugins_loaded',array($this,'view_html'),     4);

            add_action('wp_ajax_login',array($this,'login'));
            add_action('wp_ajax_nopriv_login',array($this,'login'));

            add_action('wp_ajax_mail_form',array($this,'mail_form'));
            add_action('wp_ajax_nopriv_mail_form',array($this,'mail_form'));

            add_action('wp_ajax_subscriber_email',array($this,'subscriber_email'));
            add_action('wp_ajax_nopriv_subscriber_email',array($this,'subscriber_email'));
        }
	}

    public function constants(){
        define('PLUGIN_DIR',plugin_dir_path(__FILE__));
        define('PLUGIN_URL',plugin_dir_url(__FILE__));
        define('URL_CSS',PLUGIN_URL.'assets/css/');
        define('URL_JS',PLUGIN_URL.'assets/js/');
        define('URL_IMG',PLUGIN_URL.'assets/img/');
        define('URL_ADMIN',PLUGIN_DIR.'includes/');
    }

    /**
     * Lang
     * @author vek
     * @since 0.2
     */
    public function langss() {
        load_plugin_textdomain( 'lang', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * Подключение css стилей
     * @author vek
     * @since 0.1
     */
	public function admin_styles(){
        wp_register_style('bootstrap',URL_CSS.'bootstrap.min.css');
        wp_enqueue_style('bootstrap');

        wp_register_style('font-awesome.css',URL_CSS.'font-awesome.css');
        wp_enqueue_style('font-awesome.css');

        wp_register_style('datetimepicker-master-css',URL_CSS.'datetimepicker-master/jquery.datetimepicker.css');
        wp_enqueue_style('datetimepicker-master-css');

        wp_register_style('style-admin',URL_CSS.'admin/style-admin.css');
        wp_enqueue_style('style-admin');
	}

    /**
     * Подключение js скриптов
     * @author vek
     * @since 0.1
     */
    public function admin_scripts(){
        wp_enqueue_script('jquery');

        wp_register_script('bootstrap.js',URL_JS.'bootstrap.min.js', array('jquery'));
        wp_enqueue_script('bootstrap.js');

        wp_register_script('ion.rangeSlider',URL_JS.'ion.rangeSlider/ion.rangeSlider.min.js', array('jquery'));
        wp_enqueue_script('ion.rangeSlider');

        wp_register_script('jquery.noty.packaged',URL_JS.'jquery.noty/jquery.noty.packaged.js', array('jquery'));
        wp_enqueue_script('jquery.noty.packaged');

        wp_register_script('datetimepicker-master',URL_JS.'datetimepicker-master/jquery.datetimepicker.js', array('jquery'));
        wp_enqueue_script('datetimepicker-master');
    }

    /**
     * Функция подключения сохранения настроек js
     * @author vek
     * @since 0.1
     */
    public function save_js(){
        wp_register_script("admin_save",URL_JS.'save.js',array('jquery'));
        wp_localize_script('admin_save','admin_save', array( 'ajaxurl' => admin_url('admin-ajax.php')));
        wp_enqueue_script('admin_save');
    }

    /**
     * Страница настроек админа
     * @author vek
     * @since 0.1
     */
    public function page_setting(){
        if (current_user_can('administrator')){
            if(file_exists(URL_ADMIN.'admin.php')){
                require_once(URL_ADMIN.'admin.php');
            }
        }
    }

    /**
     * Подключение страници настроек админа
     * @author vek
     * @since 0.1
     */
	public function add_plugin_menu(){
        if (function_exists('add_menu_page')){
            $admin_menu = add_menu_page(
                $this->wp_plugin_name,     //заголовок страницы
                $this->wp_plugin_name,     //название пункта меню
                'administrator',              //уровень доступа пользователя administrator
                'vek',                     //url страници
                array (&$this, 'page_setting')
            );
            add_action("admin_print_scripts-{$admin_menu}",array($this,'admin_scripts'));
            add_action("admin_print_scripts-{$admin_menu}",array($this,'save_js'));
            add_action("admin_print_styles-{$admin_menu}",array($this,'admin_styles'));
		}
	}

    /**
     * Функция сохранения настроек,проверка прав администратора и проверка кода
     * @author vek
     * @since 0.1
     */
	public function update_db(){
        if (isset($_POST['action'])){
            if (current_user_can('administrator')){
                if (!empty($_POST) && check_admin_referer('security', 'vekltd')) {
                    global $wp_roles;
                    $this->option['on']                 = esc_attr($_POST['on']);
                    $this->option['date_on_off']        = esc_attr($_POST['date_on_off']);
                    $this->option['mail_on_off']        = esc_attr($_POST['mail_on_off']);
                    $this->option['subscriber_on_off']  = esc_attr($_POST['subscriber_on_off']);
                    $this->option['text_title']         = esc_attr($_POST['text_title']);
                    $this->option['title_page']         = esc_attr($_POST['title_page']);
                    $this->option['editpost']           = wp_kses_post($_POST['editpost']);
                    $this->option['date']               = esc_attr($_POST['date']);
                    $this->option['default_animated']   = esc_attr($_POST['default_animated']);
                    $this->option['time_end']           = esc_attr($_POST['time_end']);
                    $this->option['copy']               = esc_attr($_POST['copy']);
                    $this->option['Rang']               = esc_attr($_POST['Rang']);
                    $this->option['google_analytics'  ] = esc_attr($_POST['google_analytics']);
                    $this->option['style_default']      = esc_attr($_POST['style_default']);
                    $this->option['soc']['facebook']    = esc_attr($_POST['facebook']);
                    $this->option['soc']['google']      = esc_attr($_POST['google']);
                    $this->option['soc']['twiter']      = esc_attr($_POST['twiter']);
                    $this->option['soc']['vk']          = esc_attr($_POST['vk']);

                    foreach ($wp_roles->roles as $names => $names_roles) {
                        $this->option['roles'][$names]  = esc_attr($_POST['roles_' . $names . '']);
                    }
                    update_option('db_vek', $this->option);
                    $mess = array('mess'=>__('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Настройки сохранены.</div>','lang'));
                }
            }else{
                $mess = array('mess'=>__('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Настройки не сохранены.</div>','lang'));
            }
            wp_send_json($mess);
        }
    }

    /**
     * Функция настроек по умолчанию
     * @author vek
     * @since 0.1
     */
	public function default_db(){
		$default = array(
        'on'                  => '0',
		'text_title'          => __('Заголовок проекта','lang'),
		'title_page'          => __('Название проекта','lang'),
		'editpost'            => __('В настоящее время мы работаем над сайтом.','lang'),
		'date'                => current_time('mysql'),
        'name_animated'       => array('bounceInDown','bounceIn','flipInX','flipInY','zoomInUp'),
        'default_animated'    => 'flipInY',
		'copy'                => 'isvek.ru',
		'Rang'                => '0',
		'style'               => array('pink','indigo','blue','teal','green','lime','amber','blue-grey'),
		'style_default'       => 'blue-grey',
        'cvs'                 => array(),
		'google_analytics'    => '',
		'time_end'            => __('Время вышло','lang'),
		'roles'               => array(),
		'soc'                 => array('facebook'     => '',
		                               'google'       => '',
		                               'twiter'       => '',
		                               'vk'           => '')
		);
		return $default;
	}

    /**
     * Функция восстановление настроек по умолчанию настроек
     * @author vek
     * @since 0.1
     */
	public function resets_db(){
        if (isset($_POST['action'])){
            if (current_user_can('administrator')){
                if (!empty($_POST) && check_admin_referer('resets_security','resets_vekltd')){
                    $db_subscriber = array('subscriber_email'=>array());
                    update_option('db_vek_subscriber_email',$db_subscriber);
                    update_option('db_vek', $this->default_db());
                    $mess = __('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Настройки сброшены.</div>','lang');
                }
            }else{
                $mess = __('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Настройки не сброшены.</div>','lang');
            }
            wp_send_json($mess);
        }
	}

    /**
     * Функция вывода главной страници
     * @author vek
     * @since 0.1
     */
    public function view_html(){
        $current_user  = wp_get_current_user();
        $current_user_role= current($current_user->roles);
        $roles = $this->option['roles'];

        //Какие то настройки
        if ((!current_user_can('administrator') && empty($roles[$current_user_role])) && !strstr($_SERVER['PHP_SELF'], 'wp-admin/admin-ajax.php') || !is_user_logged_in() && !strstr($_SERVER['PHP_SELF'], 'wp-admin/admin-ajax.php')){
            ob_start();
            header("Content-Type: text/html; charset=utf-8");
            if(file_exists(URL_ADMIN.'home.php')) {
                require_once(URL_ADMIN."home.php");
            }
            ob_flush();
            die();
        }
    }

    /**
     * Функция отправки емейла
     * @author vek
     * @since 0.1
     */
    public function mail_form(){
        if(isset($_POST['action'])){
            if (empty($_POST) || !wp_verify_nonce($_POST['vekltd_mail'],'vekltd_mail')){
                $error[] = false;
                $mess = array('loggedin' => '0','message'=>__('Проверка форрмы нахуй'));
            }else{
                $name = sanitize_text_field($_POST["name"]);
                $email = sanitize_text_field($_POST["email"]);
                $message = sanitize_text_field(stripslashes($_POST["message"]));
                if (!$name or !is_email($email) or !$message) {
                    if (!$name){
                        $name = true;
                        $name_names = __(' Имя ','lang');
                    }else{
                        $name = false;
                    }
                    if (!is_email($email)){
                        $email = true;
                        $name_names .= ' E-mail ';
                    }else{
                        $email = false;
                    }
                    if (!$message){
                        $message = true;
                        $name_names .= __(' Cообщение ','lang');
                    }else{
                        $message = false;
                    }
                    $error[] = false;
                    $mess = array('loggedin' => false,'message'=>__("Заполните поле : ","lang").$name_names.'.','meeserror'=> array('name_mail' =>$name,'email_mail' => $email,'message_mail' => $message));
                    wp_send_json($mess);
                }
                if(!empty($error)){
                    $mess = array('loggedin' => false, 'message' => __('ошибка формы!'));
                }else{
                    $admin_email = get_option('admin_email');
                    $headers[] = 'From: '.$name.' <'.$email.'>\r\n';
                    $message_vek = "<b>Имя :</b><br>$name<br><b>email :</b><br>$email<br><b>Сообщение :</b><br>$message";
                    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
                    wp_mail($admin_email, 'Обратная связь', $message_vek, $headers);
                    $mess = array('loggedin' => true, 'message' => __('Успешная Проверка формы'),'meeserror'=> array('name_mail' =>$name,'email_mail' => $email,'message_mail' => $message));
                }
            }
            wp_send_json($mess);
        }
    }

    /**
     * Функция выхода пользователя
     * @author vek
     * @since 0.1
     */
    public function wp_vek_logout(){
        if(isset($_GET['vekltd_logout'])){
            if( wp_verify_nonce( $_GET['_wpnonce'], 'vekltd_logout' )){
                wp_destroy_current_session();
                wp_clear_auth_cookie();
                wp_redirect($_SERVER['HTTP_REFERER']);
                die();
            }else{
                wp_redirect(home_url('/'));
            }
        }
    }

    /**
     * Функция авторизации
     * @author vek
     * @since 0.1
     */
    public function login(){
        if(isset($_POST['action'])){
            if(!is_user_logged_in()){
                if (empty($_POST) || !wp_verify_nonce($_POST['vekltd_vekltd'],'vekltd_vekltd')){
                    $mess = array('loggedin'=>false, 'message'=>__('Ошибка формы авторизации.','lang'));
                }else{
                    if(!is_user_logged_in()){
                        $login = array();
                        $login['user_login'] = esc_attr($_POST['login']);
                        $login['user_password'] = esc_attr($_POST['password']);
                        $login['remember'] = esc_attr($_POST['remember']);
                        $login_signon = wp_signon($login, false);
                        if (is_wp_error($login_signon)) {
                            $mess = array('loggedin' => false, 'message' => __('Неверное имя пользователя или пароль.','lang'));
                        } else {
                            $mess = array('loggedin' => true, 'message' => __('Успешно','lang'));
                        }
                    }
                }
            }else{
                $mess = array('loggedin' => true, 'message' => __('Успешно','lang'));
            }
            wp_send_json($mess);
        }
    }

    /**
     * Функция
     * @author vek
     * @since 0.1
     */
    public function subscriber_email_views(){
        global $wpdb;
        if (current_user_can('administrator')) {
            $db_mails = $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}db_vek_subscriber_email'");
            if ($db_mails == "{$wpdb->prefix}db_vek_subscriber_email") {
                $subscriber_email = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}db_vek_subscriber_email", OBJECT));
                if ($subscriber_email > 0) {
                    if ($subscriber_email > 0) {
                        $mess = $subscriber_email.' '.__('Подписчик','lang');
                    }
                    if ($subscriber_email > 1) {
                        $mess = $subscriber_email.' '.__('Подписчикa','lang');
                    }
                    if ($subscriber_email > 4) {
                        $mess = $subscriber_email.' '.__('Подписчиков','lang');
                    }
                    echo $mess;
                    echo ' <a href="javascript:void(0);" id="csv" class="btn btn-warning btn-sm"> '.__('Экспорт в CSV','lang').'</a> ';
                    echo ' <a id="del_csv" class="btn btn-danger btn-sm">'.__('Удалить всех подписчиков','lang').'</a> ';
                } else {
                    echo $mess = $subscriber_email.' '.__('Подписчиков','lang');;
                }
            } else {
                _e('Таблица db_vek_subscriber_email в базе данных не существует попробуйте, Деактивировать плагин, а затем Активировать.','lang');
            }
        }
    }

    /**
     * Функция сохранения email db
     * @author vek
     * @since 0.1
     */
    public function subscriber_email(){
        global $wpdb;
        if(isset($_POST['action'])){
            if(!isset($_POST['subscriber_email']) || !wp_verify_nonce($_POST['subscriber_email'],'subscriber_email')){
                $mess = array('mess' => __('Ошибка формы ["subscriber_email"]','lang'),'success'=> false);
            }else{
                $db_mails=$wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}db_vek_subscriber_email'");
                if ($db_mails == "{$wpdb->prefix}db_vek_subscriber_email"){
                    $email = sanitize_text_field($_POST['email']);
                    if(strlen($email) <= 50){
                        if(!is_email($email)){
                            $mess = array('mess' => __('Неправильный E-mail адрес.','lang'),'success'=> false);
                        }else{
                            $db_mail = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$wpdb->prefix}db_vek_subscriber_email WHERE email = %s", $email), ARRAY_A);
                            if(empty($db_mail)){
                                $wpdb->insert($wpdb->prefix.'db_vek_subscriber_email', array('email' => $email,'dates' => date('Y-m-d H:i:s')), array('%s', '%s'));
                                $mess = array('mess' => __('Вы подписались.','lang'),'success'=> true);
                            }else{
                                $mess = array('mess' => __('Вы подписаны.','lang'),'success'=> false);
                            }
                        }
                    }else{
                        $mess = array('mess' => __('Превышен максимальное значение символов.','lang'),'success'=> false);
                    }
                }else{
                    $mess = array('mess' => __('Ошибка базы mysql.','lang'),'success'=> false);
                }

            }
            wp_send_json($mess);
        }
    }

    /**
     * Функция экспорт email в cvs
     * @author vek
     * @since 0.1
     */
    public function subscriber_email_csv_del(){
        global $wpdb;
        if (current_user_can('administrator')){
            $wpdb->get_row("TRUNCATE TABLE {$wpdb->prefix}db_vek_subscriber_email",OBJECT);
        }
    }
    /**
     * Функция экспорт email в cvs
     * @author vek
     * @since 0.1
     */
    public function subscriber_email_csv(){
        global $wpdb;
        if (current_user_can('administrator')) {
            $subscriber_email = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}db_vek_subscriber_email", OBJECT));
            $db_mail = $wpdb->get_results("SELECT id, email, dates FROM {$wpdb->prefix}db_vek_subscriber_email ORDER BY id ASC", ARRAY_A);

            $filename = 'subscriber_email_users_' . $subscriber_email . '_date_' . date('Y-m-d_H-i') . '.csv';

            header("Content-type: text/csv charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename");
            header("Pragma: no-cache");
            header("Expires: 0");

            $csv = fopen('php://output', 'w');

            fputcsv($csv, array("id;email;dates"));
            foreach ($db_mail as $names) {
                fputcsv($csv, array("{$names['id']};{$names['email']};", $names['dates']));
            }

            fclose($csv);
        }
    }

    /**
     * Функция при активировании плагина
     * @author vek
     * @since 0.1
     */
	public function Plugin_activation(){
        global $wpdb;
        if (current_user_can('administrator')){
            $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}db_vek_subscriber_email (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `email` varchar(50) NOT NULL,
                    `dates` datetime NOT NULL,
                    PRIMARY KEY (`id`)
                  ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            $db = self::default_db();
            add_option('db_vek',$db);
        }
	}

    public function Plugin_deactivation(){

    }

    /**
     * Функция при удалении плагина
     * @author vek
     * @since 0.1
     */
	public function Plugin_uninstall(){
        global $wpdb;
        if (current_user_can('administrator')){
            $wpdb->get_row("DROP TABLE {$wpdb->prefix}db_vek_subscriber_email");
            delete_option('db_vek');
        }
	}
}
$WP_Maintenance_vek = new WP_Maintenance_vek();
register_deactivation_hook(__FILE__,array('WP_Maintenance_vek','Plugin_deactivation'));
register_activation_hook(__FILE__,array('WP_Maintenance_vek','Plugin_activation'));
register_uninstall_hook(__FILE__,array('WP_Maintenance_vek','Plugin_uninstall'));
