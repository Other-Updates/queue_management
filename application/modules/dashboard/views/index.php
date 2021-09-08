<!DOCTYPE html>
<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $theme_path; ?>/css/jquery.orgchart.css">
<script src="<?php echo $theme_path; ?>/js/jquery.orgchart.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.mockjax.min.js"></script>
<style>
    body {
        margin:0px;
        padding:0px;
        overflow:hidden !important;
    }
    .backimage {
        position:absolute;
        height:100% !important;
        bottom:0px;
        left:0px;
        top:0px;
    }
    .contentone {
        position: relative;

    }
    .displayheading {
        color:#0b6d9a;
        margin:0px;
        font-weight:bold;

    }
    .box {
        background-color: white;
        width: 100% !important;
        margin-left: 1px;
        border: 5px solid #2893c3;
    }
    .counterheading {
        background-color: #0b6d9a !important; text-align:center; color:white; font-wight:bold; font-size:20px;
    }
    .countertable tr td {
        text-align:center;
        font-weight:bold;
        font-size:20px;
    }
    .advertisebottom {
        background-color:#0b6d9a; color:white; font-wight:bold; font-size:20px;  width:100%; height:50px;left:0px; right:0px; bottom:0px;position:absolute;

        left: 0px;
        right: 0px;
        margin-bottom: 0px;
        position:fixed;
        width:100% !important;
    }
    .advertise {
        vertical-align:middle;
        margin-top:17px;
    }
    .bgimage {
        position:absolute;
        width:100%;
        bottom:0px;
    }
    #slideshow {
        margin: 0px auto;
        position: relative;
        /*width: 100%;*/
        height:auto;
        margin-left:0px;
        height: 100%;
        box-shadow: 0 0 20px rgba(0,0,0,0.4);

    }

    #slideshow > div {
        position: absolute;
        width:100%;
        height:100%;
        padding-right:0px !important;
    }
    .footer {
        position: absolute;
        bottom: 50px !important;
    }
    .page-header-default {
        background-color: #fff;
        margin-bottom: 20px;
        -webkit-box-shadow: 0 1px 0 0 #ddd;
        box-shadow: 0 1px 0 0 #ddd;
        display: none !important;
    }
    .content {
        padding: 0 0px 0px 11px;
    }
    .addimage {
        margin-right:0px !important;
    }

    .panel {
        margin-bottom: 30px;
    }
    .panel-default {
        border-color: #ddd;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }
    .dashboard-stats .sparkline {
        position: absolute;
        left: 30px;
        top: 20px;
        opacity: 0;
    }
    .dashboard-stats.panel {
        position: relative;
        cursor: pointer;
        padding: 0px 0px 10px 106px !important;
    }
    .dashboard-stats.rounded i.fa.stats-icon, .dashboard-stats.rounded.panel {
        border-radius: 70px;
    }
    .dashboard-stats i.fa.stats-icon {
        width: 80px;
        padding: 20px;
        font-size: 40px;
        position: absolute;
        margin-left: 10px;
        left: 0px;
        top: 10px;
        text-align: center;
        z-index: 1;
        color: #fff;
        height: 80px;
    }
    .bg-danger {
        background-color: #E9573F;
    }
    .bg-danger1 {
        background-color: #0b819a;
    }
    .bg-danger2 {
        background-color: #0b9a64;
    }
    .bg-danger3 {
        background-color: #da791a;
    }
    #chart-container {
        position: relative;
        display: inline-block;
        top: 10px;
        left: 10px;
        height: 100%;
        width: calc(100% - 24px);
        border: 2px dashed #aaa;
        border-radius: 5px;
        overflow: auto;
        text-align: center;
    }
    .bggreen_red_color {
        background-color:green;
        color:white;
    }
</style>
<div class="row" style="margin-top:30px;">
    <div class="col-md-6 col-lg-3">
        <div class="panel panel-default clearfix dashboard-stats rounded">
            <span id="dashboard-stats-sparkline1" class="sparkline transit"><canvas width="89" height="60" style="display: inline-block; width: 89px; height: 60px; vertical-align: top;"></canvas></span>
            <i class="fa fa-medkit bg-danger1 transit stats-icon"></i>
            <h3 class="transit"><?php echo $total_token; ?></h3>
            <p class="text-muted transit">Total Token Count</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="panel panel-default clearfix dashboard-stats rounded">
            <span id="dashboard-stats-sparkline1" class="sparkline transit"><canvas width="89" height="60" style="display: inline-block; width: 89px; height: 60px; vertical-align: top;"></canvas></span>
            <i class="fa fa-user-md bg-danger transit stats-icon"></i>
            <h3 class="transit"><?php echo $success_token; ?></h3>
            <p class="text-muted transit">Success Token Count</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="panel panel-default clearfix dashboard-stats rounded">
            <span id="dashboard-stats-sparkline1" class="sparkline transit"><canvas width="89" height="60" style="display: inline-block; width: 89px; height: 60px; vertical-align: top;"></canvas></span>
            <i class="fa fa-plus-square bg-danger2 transit stats-icon"></i>
            <h3 class="transit"><?php echo $hold_token; ?> </h3>
            <p class="text-muted transit">Hold Token Count</p>
        </div>

    </div>
    <div class="col-md-6 col-lg-3">
        <div class="panel panel-default clearfix dashboard-stats rounded">
            <span id="dashboard-stats-sparkline1" class="sparkline transit"><canvas width="89" height="60" style="display: inline-block; width: 89px; height: 60px; vertical-align: top;"></canvas></span>
            <i class="fa fa-wheelchair bg-danger3 transit stats-icon"></i>
            <h3 class="transit"><?php echo $missed_token; ?> </h3>
            <p class="text-muted transit">Missed Token Count</p>
        </div>

    </div>
</div>
<div class="panel panel-flat" style="margin-top: 0px;">
    <div class="panel-heading">
        <h5 class="panel-title">Dashboard
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class ="col-lg-12">
            <?php
            if (isset($token) && !empty($token)) {
                $s = 1;
                foreach ($token as $list) {
                    ?>

                    <div class="col-md-4" style="padding-left:10px; padding-right:10px;">
                        <table cellpadding="0px" cellspacing="0px" class="table  table-bordered countertable table_height bggreen_red_color" width="100%">
                            <tr>
                                <th colspan="2"><?php echo ucfirst($list['counter_name']) ?></th>
                            </tr>
                            <tr>
                                <th>TOKEN NUMBER</th>
                                <td><?php echo $list['token_number']; ?></td>
                            </tr>
                            <tr>
                                <th>QUE-TOKEN COUNT</th>
                                <td><?php echo $list['que_token_count']; ?></td>
                            </tr>

                        </table>
                    </div>

                    <?php
                    $s++;
                }
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakGenerator.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakClient.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakWorker.js"></script>


<script>

    $(document).ready(function () {
        my_function();

    });
    setInterval(function () {
        my_function();

    }, 5000);


    function speak(obj) {
        console.log(1);
        $(obj).articulate('speak');
    }



    function my_function() {

        var base_url = "<?php echo base_url('/'); ?>";
        var que_process = base_url + "counter/current_que_process/";
        $.ajax({
            type: "GET",
            url: que_process,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            cache: false,
            success: function (data) {


                if (data != 0)
                {
                    $('#que_process_token').empty();
                    $.each(data, function (key, val) {

                        values = '';
                        values += ' <td>' + val.counter_name + '</td>';
                        values += ' <td>' + val.token_number + '</td>';

                        $('#que_process_token').append('<tr>' + values + '</tr>');




                    });

                }

            }

        });
    }

    $(function () {

        $.mockjax({
            url: '/orgchart/initdata',
            responseTime: 1000,
            contentType: 'application/json',
            responseText: {
                'name': 'QUEUE - EASY',
                'title': 'Employee Status',
                'children': <?php echo $emp_data; ?>,
            }
        });
        $('#chart-container').orgchart({
            'data': '/orgchart/initdata',
            'nodeContent': 'title'
        });

    });
</script>


