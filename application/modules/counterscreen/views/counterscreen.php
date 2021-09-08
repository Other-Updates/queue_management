<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>

<title>Counter Screen</title>

<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
<link rel="stylesheet" href="<?php echo $theme_path ?>/service/counter_screen/css/bootstrap.min.css" />
<script src="<?php echo $theme_path ?>/service/counter_screen/js/jquery.min.js"></script>
<script src="<?php echo $theme_path ?>/service/counter_screen/js/popper.min.js"></script>
<script src="<?php echo $theme_path ?>/service/counter_screen/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo $theme_path ?>/service/counter_screen/css/font-awesome.min.css" />

<style>
    .counter-screen-font-name{ font-size:47px !important; }
    .counter-screen-font-number{ font-size:100px !important;}
    .table_height_row { height:92%;}

    .table_height {display:inline-table; height:81%;}

    .counterheading { height:11%;}
    .counterheading th {vertical-align:middle;}
    .onedatares1 {vertical-align:top !important;}
    body {
        margin:0px;
        padding:0px;
        overflow:hidden !important;
    }
    .backimage {
        position:absolute;
        bottom:0px;
        width:100%;
        height:100%;
    }
    .contentone {
        position:relative;
    }
    .displayheading {
        text-align:center;
    }
    .box {
        background-color: white;
        width: 100% !important;
        height: 100%;
        border: 5px solid #2893c3;

    }
    .counterheading {
        background-color: #0b6d9a !important; text-align:center; color:white; font-wight:bold; font-size:20px;
    }
    .countertable tr td {
        text-align:center;
        font-weight:bold;
        vertical-align:middle;
        text-transform:uppercase;
    }
    .countertable tr span  {
        text-transform:uppercase;
    }
    .length_increase{
        text-align:center;
        font-weight:bold;
    }
    .advertisebottom {
        background-color:#0b6d9a; color:white; font-weight:bold; font-size:50px; height:85px;left:0px; right:0px; bottom:0px;position:absolute;
        left: 0px;
        right: 0px;
        margin-bottom: 0px;
        position:fixed;
        width:100%;

    }
    .datetime {
        background-color:#fff; color:black; font-weight:bold; font-size:32px; height:85px;
        bottom:0px;position:absolute;
        left: 80%;
        right: 0px;
        margin-bottom: 0px;
        position:fixed;
        width:20%;
        border: 4px solid #0b6d9a;
        padding:13px;
    }

    .advertise {
        vertical-align:middle;
        margin-top:17px;
        font-size:40px;
    }
    .sidebar{
        display:none;
    }
    .navbar {
        display:none;
    }
    .breadcrumb-line {
        display:none;
    }
    .page-header-default {
        display:none;
    }
    .content {
        padding: 0 0px 0px 0px !important;
    }
    .text-muted {
        display:none;
    }
    .bgimage {
        position:absolute;
        width:100%;
        bottom:0px;
    }
    #slideshow {


        height:;


    }

    table {
        margin-bottom:0px !important;
    }
    .dtime {
        padding:23px;
        background-color:#68b835;
        color:white;
        font-weight:bold; font-size:32px; height:85px;
        bottom:0px;position:absolute;
        right: 0px;
        margin-bottom: 0px;
        position:fixed;

    }
    .bottomtime {
        font-size:32px;
        text-align:center;
    }
    .onedata { font-size:40px !important; }
    .onedatares { font-size:70px !important;}
    .vdowh {
        width:100%;
        height:865px; }

 @media (min-width: 768px) and (max-width: 1024px){
	  .table_height {display:inline-table; height:88%;}
 }

    @media (min-width: 768px) and (max-width: 1366px)	{
        .vdowh { width: 100%; height: 684px;}
		.table_height {display:inline-table; height:84%;}

    }


    @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
		.table_height {display:inline-table; height:86%;}
        .countertable tr td {
            text-align:center;
            font-weight:bold;
            font-size:20px;
            text-transform:uppercase;
        }
        .vdowh {
            width:100%;
            height:713px; }
        .bottomtime {
            font-size:27px;
            text-align:center; }
        .advertisebottom {
            background-color: #0b6d9a;
            color: white;
            font-weight: bold;
            font-size: 45px;
            height: 70px;
            left: 0px;
            right: 0px;
            bottom: 0px;
            position: absolute;
            left: 0px;
            right: 0px;
            margin-bottom: 0px;
            position: fixed;
        }
        .dtime {
            padding: 9px;
            background-color: #68b835;
            color: white;
            font-weight: bold;
            font-size: 35px;
            height: 70px;
            bottom: 0px;
            position: absolute;
            right: 0px;
            margin-bottom: 0px;
            position: fixed;
            padding-left: 33px;
        }

    }
</style>
</head>
<body>

    <input type="hidden" name="" id="speak_tkn_number" value=""/>
    <select name="voice" id="voice" style="display:none"></select>
    <input type="hidden" name="" id="volume" value="5"/>
    <input type="hidden" name="" id="rate" value="1"/>
    <input type="hidden" name="" id="pitch" value="1"/>


    <div class ="col-lg-12">
        <div class="row table_height_row">
            <div class="col-md-4" style="padding-left:0px; padding-right:0px;">
                <div class="contentone">
                    <div class="box">
                        <center><img src="<?php echo base_url('/') . "themes/queue/service/images/logo.png"; ?>" alt="" style="height:60; width:180px; margin:19px;" ></center>
                        <table cellpadding="0px" cellspacing="0px" class="table table-striped table-bordered countertable table_height" width="100%">




                            <tbody id="">
                                <?php if (!empty($token) && count($token) >= 3) { ?>
                                    <tr class="counterheading">
                                        <td style="text-align:center;">COUNTER NAME</td>
                                        <td style="text-align:center;">TOKEN NUMBER</td>
                                    </tr>
                                    <?php
                                } if (!empty($token) && count($token) == 1) {
                                    $s = 1;
                                    foreach ($token as $list) {
                                        ?>
                                        <tr>
                                            <td class="onedatares1">
                                                <br/><br/><br/>
                                                <span class="counter-screen-font-name"><?php echo (count($token) == 1) ? "TOKEN NUMBER" : ucfirst($list['counter_name']) ?> </span><br/><br/>
                                                <span  class="counter-screen-font-number"><?php echo $list['token_number']; ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                        $s++;
                                    }
                                } elseif (!empty($token) && count($token) == 2) {
                                    $s = 1;
                                    foreach ($token as $list) {
                                        ?>
                                        <tr>
                                            <td class="onedatares2">
                                                <span class="counter-screen-font-name"><?php echo (count($token) == 1) ? "TOKEN NUMBER" : ucfirst($list['counter_name']) ?> </span><br/>
                                                <span class="counter-screen-font-number" ><?php echo $list['token_number']; ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                        $s++;
                                    }
                                } else {
                                    $s = 1;
                                    foreach ($token as $list) {
                                        ?>
                                        <tr>

                                            <td><?php echo ucfirst($list['counter_name']); ?></td>
                                            <td><?php echo $list['token_number']; ?></td>
                                        </tr>
                                        <?php
                                        $s++;
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="padding-left:0px !important; padding-right:0px; border:1px solid balck;">
                <div id="slideshow">

                </div>
                <div id="slideshow1">
                    <?php foreach ($add_vidoes as $listv) { ?>
                        <div class="video_hidden<?php echo $listv['detail_id']; ?>" style="width:100%; height:100%;">
                            <video id="myVideo<?php echo $listv['detail_id']; ?>" class="video_class<?php echo $listv['detail_id']; ?>" autoplay width="auto" height="92%" style="display:none;position: fixed;">
                                <source src="<?php echo $listv['add_data']; ?>" type="video/mp4" /></video>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>

        <input type="hidden" name="content_data" id="content_data" value="" />
        <input type="hidden" name="content_time" id="content_time" value="" />
        <input type="hidden" name="count" id="count" value="0" />
        <input type="hidden" name="content" id="content" value="0" />


        <div class="col-lg-12">
            <div class="content_loading">
                <div class="col-md-12 ">
                    <marquee class="advertisebottom" style="width:70%">

                    </marquee>
                    <div class="dtime" style="width:30%; text-align: center;"><span class="bottomtime"><?php echo date('d.m.Y'); ?></span>    <span class="bottomtime" id='ct' ></span></div>
                </div>
            </div>
        </div>
    </div>


    <button  id="audio_play" style="display:none">Play</button>
    <button  id="audio_pause" style="display:none">Pause</button>
    <button  id="video_id" style="display:none"></button>
    <button  id="speak" onclick="test_speech()" style="display:none"> speak </button>


    <script>
        display_ct();
        // get_video();
        var count = $('#count').val();
        var content = $('#content').val();
        var audioElement = document.createElement('audio');
        var url = "<?php echo base_url('/') . "themes/queue/service/beep-01a.wav"; ?>";
        audioElement.setAttribute('src', url);
        audioElement.addEventListener('ended', function () {
            this.play();
        }, false);
        $('#audio_play').click(function () {
            audioElement.load();
            audioElement.play();
        });
        $('#audio_pause').click(function () {
            audioElement.pause();
        });
        get_advertisement_images(count);
        get_advertisement_content(content);
        var voiceSelect = document.getElementById('voice');
        var volumeInput = document.getElementById('volume');
        var rateInput = document.getElementById('rate');
        var pitchInput = document.getElementById('pitch');
        function loadVoices() {
            var voices = speechSynthesis.getVoices();
            voices.forEach(function (voice, i) {
                var option = document.createElement('option');
                option.value = voice.name;
                option.innerHTML = voice.name;
                voiceSelect.appendChild(option);
            });
        }
        loadVoices();
        window.speechSynthesis.onvoiceschanged = function (e) {
            loadVoices();
        };
        var token_length = "<?php echo count($token); ?>";
        if (token_length > 5) {
            var length = token_length - 5;
            var total_length = 30 - (length * 5);
            var fontsize = total_length + 'px';
            $('.countertable').removeClass("countertable tr td").css("font-size", fontsize).css("text-align", "center").css("font-weight", "bold");
        } else {
            $(".countertable tr td").css("font-size", "30px");
        }
        //my_function();
        $('table').addClass('countertable');
        function speak(text) {
            var msg = new SpeechSynthesisUtterance();
            msg.text = text;
            msg.volume = parseFloat(volumeInput.value);
            msg.rate = parseFloat(rateInput.value);
            msg.pitch = parseFloat(pitchInput.value);
            if (voiceSelect.value) {
                msg.voice = speechSynthesis.getVoices().filter(function (voice) {
                    return voice.name == voiceSelect.value;
                })[0];
            }
            window.speechSynthesis.speak(msg);
        }
        function test_speech() {
            var speak_tkn = $('#speak_tkn_number').val();
            var speak_tkn_id = $('#speak_tkn_number').attr('speak_tkn_id');
            console.log(speak_tkn);
            speak(speak_tkn);
            var base_url = "<?php echo base_url('/'); ?>";
            var voice_msg = base_url + "counterscreen/update_voice_status/" + speak_tkn_id;
            $.ajax({
                type: "POST",
                url: voice_msg,
                data: '1',
                success: function (data) {
                    if (data == 1) {

                        setTimeout(function () {
                            $('#speak_tkn_number').val('');
                            $('#speak_tkn_number').attr('speak_tkn_id', '');
                            speak_tkn_voice();
                            var vidid = $('#video_id').text();
                            var $audio = document.getElementById('' + vidid + '');
                            if ($audio != null)
                                $audio.volume = 1;
                        }, 1000);
                    }
                }
            });
        }
        setInterval(function () {
            my_function();
        }, 5000);

        function my_function() {

            var base_url = "<?php echo base_url('/'); ?>";
            var que_process = base_url + "counterscreen/current_que_process/";
            $.ajax({
                type: "GET",
                url: que_process,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                cache: false,
                success: function (data) {
                    if (data != 0)
                    {

                        $('.countertable tbody').empty();
                        var values = '';
                        if (data.length >= 3) {
                            values += '<tr class="counterheading"><td style="text-align:center;">COUNTER NAME</td><td style="text-align:center; ">TOKEN NUMBER</td></tr>';
                        }
                        $.each(data, function (key, val) {
                            if (val.counter_name != undefined && val.token_number != undefined) {
                                if (data.length < 3) {
                                    if (data.length == 1)
                                        var counter = "TOKEN NUMBER";
                                    else
                                        var counter = val.counter_name;

                                    values += '<tr><td class="onedatares1">';
                                    if (data.length == 1)
                                        values += '<br/><br/><br/>';

                                    values += '<span class="counter-screen-font-name">' + counter + '</span>';
                                    if (data.length == 1)
                                        values += '<br/><br/>';
                                    else
                                        values += '<br/>';

                                    values += '<span class="counter-screen-font-number">' + val.token_number + '</span>';
                                    values += '</td></tr>';

                                } else {
                                    values += '<tr> <td >' + val.counter_name + '</td>';
                                    values += ' <td >' + val.token_number + '</td></tr>';
                                }

                                if (val.voice_msg == 0) {
                                    var speak_tkn = $('#speak_tkn_number').val();
                                    if (speak_tkn == 0 && val.token_number != "-") {
                                        var tokenvoice = "Countername" + " " + val.counter_name + " " + val.token_number_format;
                                        $('#speak_tkn_number').val(tokenvoice);
                                        $('#speak_tkn_number').attr('speak_tkn_id', val.que_detail_id);
                                        speak_tkn_voice();
                                    }
                                }
                            }
                        });
                        $('.countertable tbody').append(values);
                        if (data.length > 5) {
                            var length = data.length - 5;
                            var total_length = 30 - (length * 5);
                            var fontsize = total_length + 'px';
                            $('.countertable tr td').css("font-size", fontsize).css("text-align", "center").css("font-weight", "bold");
                        } else {
                            $(".countertable tr td").css("font-size", "30px");
                        }
                    }
                }

            });
        }


        function speak_tkn_voice() {
            var speak_tkn = $('#speak_tkn_number').val();
            var speak_tkn_id = $('#speak_tkn_number').attr('speak_tkn_id');
            if (speak_tkn.length > 0) {
                var vidid = $('#video_id').text();
                var $audio = document.getElementById('' + vidid + '');
                if ($audio != null)
                    $audio.volume = 0;

                setTimeout(function () {
                    $('#audio_play').trigger('click');
                    console.log('on_audio');
                    setTimeout(function () {
                        console.log('stop_audio');
                        $('#audio_pause').trigger('click');
                    }, 500);


                }, 1000);


                setTimeout(function () {
                    console.log('token_voice');
                    $('#speak').trigger('click');
                }, 2000);

            }
        }

        function get_video() {
            var base_url = "<?php echo base_url('/'); ?>";
            var que_videos = base_url + "counterscreen/get_add_videos/";
            $.ajax({
                type: "Post",
                url: que_videos,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data != 0) {
                        var option_text = '';
                        option_text += '<div class="addimage" style="width:100%; height:100%;">';
                        $.each(data, function (key, val) {
                            var inc_id = key + 1;
                            option_text += '<video id="myVideo' + val.detail_id + '" class="video_class' + val.detail_id + '"  autoplay width="auto" height="92%" style="display:none;position:fixed:">' +
                                    '<source src="' + val.add_data + '" type="video/mp4" /></video>';

                        });
                        option_text += '</div>';
                        console.log(option_text);
                        $('#slideshow').append(option_text);
                    }
                }

            });
        }
        function get_advertisement_images(count) {

            var base_url = "<?php echo base_url('/'); ?>";
            var que_content = base_url + "counterscreen/get_add_image_data/";
            var exists_content = 0;
            $.ajax({
                type: "Post",
                url: que_content,
                dataType: "json",
                data: {type: '1', content_exists: exists_content, count: count},
                cache: false,
                success: function (data) {
                    if (data != 0) {

                        var time_duration = data.time_duration;
                        var add_data = data.add_data;
                        var details_id = data.details_id;
                        var time = get_time();
                        var total_time_run = addTimes(time, time_duration);
                        $('#slideshow').empty();
                        var option_text = '';
                        option_text += '<div class="addimage" style="width:100%; height:100%;">';
                        if (data.type == "Images") {
                            option_text += '<img src="' + add_data + '"width="100%"  height="100%"/></div>';
                            $('#slideshow').append(option_text);
                        }
                        if (data.type == "Videos") {
                            //option_text += '<video id="myVideo" class="video_class' + details_id + '"  autoplay width="auto" height="91%">' +
                            //  '<source src="' + add_data + '" type="video/mp4" /></video></div>';
                        }


                        if (data.type == "Videos") {
                            $('#slideshow').empty();

                            var video_text = $('#slideshow1').find('.video_hidden' + details_id + '').html();
                            if (video_text != undefined) {
                                var option_text = '';
                                option_text += '<div class="addimage" style="width:100%; height:100%;">';
                                option_text += video_text;
                                option_text += '</div>';
                                $('#slideshow').append(option_text);
                                var class_name = ".video_class" + details_id;
                                $('#slideshow').find('' + class_name + '').css('display', 'block');
                                var id = $('#slideshow').find('' + class_name + '').attr('id');
                                document.getElementById('' + id + '').load();
                                var playPromise = document.getElementById('' + id + '').play();
                                $('#video_id').text(id);
                            }

                        }
                        setInterval(function () {

                            var time = get_time();
                            if (time == total_time_run) {
                                if (data.type == "Videos") {
                                    document.getElementById('' + id + '').pause();
                                    $('#video_id').text(id);
                                }

                                var count = $('#count').val();
                                if (data.key != 0)
                                    $('#count').val(parseInt(count) + 1);
                                else
                                    $('#count').val(parseInt(0) + 1);
                                clearInterval();
                                var count = $('#count').val();
                                get_advertisement_images(count);
                            }


                        }, 1000);
                    } else {

                        var datas = $("#default_image_data").find('div').clone();
                        $('#slideshow').append(datas);
                        $("#slideshow > div:gt(0)").hide();
                        setInterval(function () {
                            $('#slideshow > div:first')
                                    .fadeOut(1500)
                                    .next()
                                    .fadeIn(1500)
                                    .end()
                                    .appendTo('#slideshow');
                        }, 3000);
                    }

                }

            });
        }
        function get_advertisement_content(content) {

            var base_url = "<?php echo base_url('/'); ?>";
            var que_content = base_url + "counterscreen/get_add_content_data/";
            var exists_content = 0;
            $.ajax({
                type: "Post",
                url: que_content,
                dataType: "json",
                data: {type: '3', content_exists: exists_content, count: content},
                cache: false,
                success: function (data) {

                    if (data != 0) {
                        $.each(data, function (key, val) {
                            $('.advertisebottom').append(val.add_data);
                        });
                    }
                }

            });
        }
        function get_time() {
            var dt = new Date();
            var hrs = dt.getHours();
            var mins = dt.getMinutes();
            var secs = dt.getSeconds();
            if (hrs.toString().length == 1)
                hrs = "0" + hrs;
            if (mins.toString().length == 1)
                mins = "0" + mins;
            if (secs.toString().length == 1)
                secs = "0" + secs;
            return hrs + ":" + mins + ":" + secs;
        }
        function addTimes(startTime, endTime) {
            var times = [0, 0, 0]
            var max = times.length

            var a = (startTime || '').split(':')
            var b = (endTime || '').split(':')

            // normalize time values
            for (var i = 0; i < max; i++) {
                a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
                b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
            }

            // store time values
            for (var i = 0; i < max; i++) {
                times[i] = a[i] + b[i]
            }

            var hours = times[0]
            var minutes = times[1]
            var seconds = times[2]

            if (seconds >= 60) {
                var m = (seconds / 60) << 0
                minutes += m
                seconds -= 60 * m
            }

            if (minutes >= 60) {
                var h = (minutes / 60) << 0
                hours += h
                minutes -= 60 * h
            }

            return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2)
        }
        function display_c() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct()', refresh)
        }
        function display_ct() {
            var x = new Date();
            var month = x.getMonth() + 1;
            var day = x.getDate();
            var year = x.getFullYear();
            if (month < 10) {
                month = '0' + month;
            }
            if (day < 10) {
                day = '0' + day;
            }
            var x3 = day + '-' + month + '-' + year;
            // time part //
            var hour = x.getHours();
            var minute = x.getMinutes();
            var second = x.getSeconds();
            if (hour < 10) {
                hour = '0' + hour;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (second < 10) {
                second = '0' + second;
            }

            if (hour > 12) {
                second = "PM";
            } else {
                second = "AM";
            }
            hour = hour % 12;
            hour = hour ? hour : 12;
            var x3 = +' ' + hour + ':' + minute + ' ' + second;
            document.getElementById('ct').innerHTML = x3;
            document.getElementById('ct').innerHTML = x3;
            display_c();
        }

    </script>

</body>

