/*!
 * WP_Maintenance_vek Countdown Timer v0.2 (http://isvek.ru/wp-maintenance-vek)
 * Copyright 2015 isvek.ru
 */

jQuery(document).ready(function($) {
    var date_end = new Date(countdowntimer.date_timer).getTime();
    var days,hours,minutes,seconds;
    var timer = document.getElementById('timer');

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
        if(days_names == 1){ var _days = countdowntimer.langtimeD;}
        else if((days_names > 1) && (days_names < 5)){ var _days = countdowntimer.langtimeD1;}
        else{ var _days = countdowntimer.langtimeD2;}

        var hours_names = String(hours);
        var hours_names = hours_names.charAt(hours_names.length-1);
        var hours_names = parseInt(hours_names, 10);
        if(hours_names == 1){ var _hours = countdowntimer.langtimeH;}
        else if((hours_names > 1) && (hours_names < 5)){ var _hours = countdowntimer.langtimeH1;}
        else{ var _hours = countdowntimer.langtimeH2;}

        var minutes_names = String(minutes);
        var minutes_names = minutes_names.charAt(minutes_names.length-1);
        var minutes_names = parseInt(minutes_names, 10);
        if(minutes_names == 1){ var _minutes = countdowntimer.langtimeM;}
        else if((minutes_names > 1) && (minutes_names < 5)){ var _minutes = countdowntimer.langtimeM1;}
        else{ var _minutes = countdowntimer.langtimeM2;}

        var seconds_names = String(seconds);
        var seconds_names = seconds_names.charAt(seconds_names.length-1);
        var seconds_names = parseInt(seconds_names, 10);
        if(seconds_names == 1){ var _seconds = countdowntimer.langtimeS;}
        else if((seconds_names > 1) && (seconds_names < 5)){ var _seconds = countdowntimer.langtimeS1;}
        else{ var _seconds = countdowntimer.langtimeS2;}

        function deg(deg){
            return (Math.PI/180)*deg - (Math.PI/180)*90
        }

            var setting = {
                days_css : {
                    internal_BG        : 'rgba(255,255,255, 0.10)',
                    internal_lineWidth : 2,
                    outside_BG         : 'rgba(255,255,255, 0.9)',
                    outside_lineWidth  : 8,
                    shadowColor        : 'rgba(0,0,0, 0.36)',
                    shadowBlur         : 2,
                    onestrokeStyle     : 'rgba(0,0,0, 0.36)',
                    onestrokelineWidth : 2
                },
                hours_css : {
                    internal_BG        : 'rgba(255,255,255, 0.10)',
                    internal_lineWidth : 2,
                    outside_BG         : 'rgba(255,255,255, 0.9)',
                    outside_lineWidth  : 8,
                    shadowColor        : 'rgba(0,0,0, 0.36)',
                    shadowBlur         : 2,
                    onestrokeStyle     : 'rgba(0,0,0, 0.36)',
                    onestrokelineWidth : 2
                },
                minutes_css : {
                    internal_BG        : 'rgba(255,255,255, 0.10)',
                    internal_lineWidth : 2,
                    outside_BG         : 'rgba(255,255,255, 0.9)',
                    outside_lineWidth  : 8,
                    shadowColor        : 'rgba(0,0,0, 0.36)',
                    shadowBlur         : 2,
                    onestrokeStyle     : 'rgba(0,0,0, 0.36)',
                    onestrokelineWidth : 2
                },
                seconds_css : {
                    internal_BG        : 'rgba(255,255,255, 0.10)',
                    internal_lineWidth : 2,
                    outside_BG         : 'rgba(255,255,255, 0.9)',
                    outside_lineWidth  : 8,
                    shadowColor        : 'rgba(0,0,0, 0.36)',
                    shadowBlur         : 2,
                    onestrokeStyle     : 'rgba(0,0,0, 0.36)',
                    onestrokelineWidth : 2
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
                    ctx.font="50px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillStyle="white";
                    ctx.fillText(days,75,92);
                    ctx.font="400 11px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillText(_days,75,110);
                    ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    ctx.fill("evenodd");
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
                    ctx.font="50px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillStyle="white";
                    ctx.fillText(hours,75,92);
                    ctx.font="400 11px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillText(_hours,75,110);
                    ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    ctx.fill("evenodd");
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
                    ctx.font="50px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillStyle="white";
                    ctx.fillText(minutes,75,92);
                    ctx.font="400 11px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillText(_minutes,75,110);
                    ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    ctx.fill("evenodd");
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
                    ctx.font="50px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillStyle="white";
                    ctx.fillText(seconds,75,92);
                    ctx.font="400 11px 'Roboto Mono', Roboto, sans-serif";
                    ctx.textAlign="center";
                    ctx.fillText(_seconds,75,110);
                    ctx.fillStyle = "rgba(255,255,255, 0.10)";
                    ctx.fill("evenodd");
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
                    //var dataURL =  cSec.toDataURL('image/png');
                    //$('vek').html(dataURL);
                }
            }
        };

        if(seconds_left >= 0){
            // Выводим круги
            clock.set.days();
            clock.set.hours();
            clock.set.minutes();
            clock.set.seconds();
            if(seconds < 1) {
                $('#canvas_seconds').addClass('flipInY animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass('flipInY' + ' animated');
                });
            }
            $('.ttv').html(minutes);

        }else{
            //Скрывает все круги
            $('.timers').addClass('fadeOutUp animated').hide();
            $('#timer_end').addClass('animated fadeIn');
            timer.innerHTML = countdowntimer.end_text; //Выводим сообщение время вышло
            }
    },10);
});

