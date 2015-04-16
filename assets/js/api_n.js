/*!
 * wp_Maintenance_vek clock v0.1 (http://isvek.ru)
 * Copyright 2015 isvek.ru
 * Licensed /
 */
jQuery(document).ready(function($){
    var date_end = new Date(vek_veks.times_v).getTime();
    var days,hours,minutes,seconds;
    var timer = document.getElementById('timer_end');

    setInterval(function () {
        var current_date = new Date().getTime();
        var seconds_left = (date_end - current_date) / 1000;
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;
        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;
        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);

        //Меняем окончания днейе,часов,минут,секунд
        var days_names = String(days);
        var days_names = days_names.charAt(days_names.length-1);
        var days_names = parseInt(days_names, 10);
        if(days_names == 1){ var _days = "День";}
        else if((days_names > 1) && (days_names < 5)){ var _days = "Дня";}
        else{ var _days = "Дней";}

        var hours_names = String(hours);
        var hours_names = hours_names.charAt(hours_names.length-1);
        var hours_names = parseInt(hours_names, 10);
        if(hours_names == 1){ var _hours = "Час";}
        else if((hours_names > 1) && (hours_names < 5)){ var _hours = "Часа";}
        else{ var _hours = "Часов";}

        var minutes_names = String(minutes);
        var minutes_names = minutes_names.charAt(minutes_names.length-1);
        var minutes_names = parseInt(minutes_names, 10);
        if(minutes_names == 1){ var _minutes = "Минута";}
        else if((minutes_names > 1) && (minutes_names < 5)){ var _minutes = "Минуты";}
        else{ var _minutes = "Минут";}

        var seconds_names = String(seconds);
        var seconds_names = seconds_names.charAt(seconds_names.length-1);
        var seconds_names = parseInt(seconds_names, 10);
        if(seconds_names == 1){ var _seconds = "Секунда";}
        else if((seconds_names > 1) && (seconds_names < 5)){ var _seconds = "Секунды";}
        else{ var _seconds = "Секунд";}

        function deg(deg){
            return (Math.PI/180)*deg - (Math.PI/180)*90
        }
        var setting = {
            days_css : {
                internal_BG        : '#E0E0E0',  //Внешняя заливка
                internal_lineWidth : 2,          //max 10px
                outside_BG         : '#4CDC7C',  //Внутренняя заливка
                outside_lineWidth  : 6,          //max 10px
                shadowColor        : '#A6A19F',
                shadowBlur         : 0,
                onestrokeStyle     : '',
                onestrokelineWidth : 0
            },
            hours_css : {
                internal_BG        : '#E0E0E0',  //Внешняя заливка
                internal_lineWidth : 2,          //max 10px
                outside_BG         : '#4CDC7C',  //Внутренняя заливка
                outside_lineWidth  : 6,          //max 10px
                shadowColor        : '#A6A19F',
                shadowBlur         : 0,
                onestrokeStyle     : '',
                onestrokelineWidth : 0
            },
            minutes_css : {
                internal_BG        : '#E0E0E0',  //Внешняя заливка
                internal_lineWidth : 2,          //max 10px
                outside_BG         : '#4CDC7C',  //Внутренняя заливка
                outside_lineWidth  : 6,          //max 10px
                shadowColor        : '#A6A19F',
                shadowBlur         : 0,
                onestrokeStyle     : '',
                onestrokelineWidth : 0
            },
            seconds_css : {
                internal_BG        : '#E0E0E0',  //Внешняя заливка
                internal_lineWidth : 2,          //max 10px
                outside_BG         : '#E6E6E6',  //Внутренняя заливка
                outside_lineWidth  : 6,          //max 10px
                shadowColor        : '#A6A19F',
                shadowBlur         : 0,
                onestrokeStyle     : '',
                onestrokelineWidth : 0
            }
        };
        //Круги в canvas
        var clock = {
            set: {
                days: function(){
                    var cdays = $("#canvas_days").get(0);
                    var ctx = cdays.getContext("2d");
                    ctx.clearRect(0, 0, cdays.width, cdays.height);

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(360));
                    ctx.lineWidth = setting.days_css.internal_lineWidth;
                    ctx.strokeStyle = setting.days_css.internal_BG;
                    ctx.lineCap = "round";
                    //ctx.fillStyle = "rgba(255,255,255, 0.10";
                    // ctx.fill("evenodd");
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(days));
                    ctx.lineWidth = setting.days_css.onestrokelineWidth;
                    ctx.strokeStyle = setting.days_css.onestrokeStyle;
                    ctx.lineCap = "round";
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.strokeStyle = setting.days_css.outside_BG;
                    if(days==0){
                        ctx.arc(75,75,70, deg(0), deg(0));
                    }else{
                        ctx.arc(75,75,70, deg(0), deg(days));
                    }
                    ctx.lineWidth =setting.days_css.outside_lineWidth;
                    ctx.stroke();

                    ctx.shadowBlur    = setting.days_css.shadowBlur;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 0;
                    ctx.shadowColor   = setting.days_css.shadowColor;
                },
                //Круг часов
                hours: function(){
                    var cHr = $("#canvas_hours").get(0);
                    var ctx = cHr.getContext("2d");
                    ctx.clearRect(0, 0, cHr.width, cHr.height);

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(360));
                    ctx.lineWidth = setting.hours_css.internal_lineWidth;
                    ctx.strokeStyle = setting.hours_css.internal_BG;
                    ctx.lineCap = "round";
                    //ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    // ctx.fill("evenodd");
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(15*hours));
                    ctx.lineWidth = setting.hours_css.onestrokelineWidth;
                    ctx.strokeStyle = setting.hours_css.onestrokeStyle;
                    ctx.lineCap = "round";
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.strokeStyle = setting.hours_css.outside_BG;
                    ctx.arc(75,75,70, deg(0), deg(15*hours));
                    ctx.lineWidth = setting.hours_css.outside_lineWidth;
                    ctx.stroke();

                    ctx.shadowBlur    = setting.hours_css.shadowBlur;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 0;
                    ctx.shadowColor   = setting.hours_css.shadowColor;
                },
                //Круг минуты
                minutes : function(){
                    var cMin = $("#canvas_minutes").get(0);
                    var ctx = cMin.getContext("2d");
                    ctx.clearRect(0, 0, cMin.width, cMin.height);

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(360));
                    ctx.lineWidth = setting.minutes_css.internal_lineWidth;
                    ctx.strokeStyle = setting.minutes_css.internal_BG;
                    ctx.lineCap = "round";
                    //ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    // ctx.fill("evenodd");
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(6*minutes));
                    ctx.lineWidth = setting.minutes_css.onestrokelineWidth;
                    ctx.strokeStyle = setting.minutes_css.onestrokeStyle;
                    ctx.lineCap = "round";
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.strokeStyle = setting.minutes_css.outside_BG;
                    ctx.arc(75,75,70, deg(0), deg(6*minutes));
                    ctx.lineWidth = setting.minutes_css.outside_lineWidth;
                    ctx.stroke();

                    ctx.shadowBlur    = setting.minutes_css.shadowBlur;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 0;
                    ctx.shadowColor   = setting.minutes_css.shadowColor;
                },
                //Круг секунды
                seconds: function(){
                    var cSec = $("#canvas_seconds").get(0);
                    var ctx = cSec.getContext("2d");
                    ctx.clearRect(0, 0, cSec.width, cSec.height);

                    ctx.beginPath();
                    //ctx.moveTo(75,75);
                    //ctx.lineTo(75,75);
                    ctx.arc(75,75,70, deg(0), deg(360));
                    ctx.lineWidth = setting.seconds_css.internal_lineWidth;
                    ctx.strokeStyle = setting.seconds_css.internal_BG; //setting.seconds_css.internal_BG
                    ctx.lineCap = "round";
                    //ctx.font="50px Trebuchet MS, Arial, Helvetica, sans-serif";
                    //ctx.textAlign="center";
                    //ctx.fillText(seconds,75,92);
                    //ctx.font="11px Verdana";
                    //ctx.textAlign="center";
                    //ctx.fillText(_seconds,75,110);
                    //ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    // ctx.fill("evenodd");
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.arc(75,75,70, deg(0), deg(6*seconds));
                    ctx.lineWidth = setting.seconds_css.onestrokelineWidth;
                    ctx.strokeStyle = setting.seconds_css.onestrokeStyle;
                    ctx.lineCap = "round";
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.strokeStyle = setting.seconds_css.outside_BG;
                    ctx.arc(75,75,70, deg(0), deg(6*seconds));
                    ctx.lineWidth = setting.seconds_css.outside_lineWidth;
                    ctx.stroke();

                    ctx.shadowBlur    = setting.seconds_css.shadowBlur;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 0;
                    ctx.shadowColor   = setting.seconds_css.shadowColor;
                }
            }
        };

        if(seconds_left>=0){
            $('.timers').show();
            $('.type_days').text(_days);        // Название день,дня,дней
            $('.val_days').text(days);          // Вывод дня

            $('.type_hours').text(_hours);      // Название час,чоса,часов
            $('.val_hours').text(hours);        // Вывод час

            $('.type_minutes').text(_minutes);  // Название минута,минуты,минут
            $('.val_minutes').text(minutes);    // Вывод минут

            $('.type_seconds').text(_seconds);  // Название секунда,секунды,секунд
            $('.val_seconds').text(seconds);    // Вывод секунд
            // Выводим круги
            if(seconds == 0)
                $('#canvas_seconds').addClass('flipInY animated');

            clock.set.seconds();
            clock.set.minutes();
            clock.set.hours();
            clock.set.days();
        }else{
            //Скрывает все круги
            $('.timers').addClass('fadeOutUp animated').hide();
            $('#timer_end').addClass('fadeIn animated');
            timer.innerHTML = vek_veks.end_text; //Выводим сообщение время вышло
            }
    },10);
});

