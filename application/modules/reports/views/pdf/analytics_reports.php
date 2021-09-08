<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/charts/morris.js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/charts/raphael/raphael.min.js"></script>

<style>
    .search{
        margin-top:0px;

    }
    .cntr {
        text-align:center;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #333 !important;
        border: 1px solid #2893c3;
        border-radius: 50px;
        color: white !important;
        width: 35px;
        height: 35px;
        background-color: #2893c3;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #2893c3));
        background: -webkit-linear-gradient(top, #2893c3 0%, #2893c3 100%);
        background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: linear-gradient(to bottom, #2893c3 0%, #2893c3 100%);
    }
    #reportTable_info {
        margin-left:13px;
    }
    #reportTable_paginate {
        margin-right:3px;
    }
    .clrcmd a {
        color:black;
    }
    .clrcmd .badge {
        height: auto;
        width: auto;
        border-radius: 0%;
        display: inline-block;
    }

    .export_pdf {

    }

    .ddadjust {
        margin-left:177px;
    }
    div#reportTable_length select {
        width: 47%;
        height: 28px;
        margin-top: 2px;
    }
    table tr td:nth-child(4) { text-align:center;}
    table tr td:nth-child(5) { text-align:center;}
    table tr td:nth-child(6) { text-align:center;}
    table tr td:nth-child(7) { text-align:center;}
    table tr td:nth-child(8) { text-align:center;}
    table tr td:nth-child(9) { text-align:center;}
    table tr td:nth-child(10) { text-align:center;}
    table tr td:nth-child(11) { text-align:center;}

    .badge {
        height: auto;
        width: auto;
        border-radius: 50%;
        display: inline-block;
    }
    .card {
        margin-bottom: 1.25rem;
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: .1875rem;
    }
    .panel {
        margin-bottom: 20px;
        border-color:#f4f7fe !important;
        color: #333333;
    }
    .panel {
        margin-bottom: 20px;
        background-color:#f4f7fe !important;
        border: 1px solid transparent;
        border-radius: 3px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    }
    .highcharts-subtitle tspan {
        font-size:25px !important;
    }
    .highcharts-title  tspan {
        font-size:25px !important;
    }
    .graphtopbottom {
        margin-top: 25px;
        margin-bottom: 8px;
    }
</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Analytics Reports
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>



    <style>
        .clrcmd a {
            color:black;
        }
        .clrcmd .badge {
            height: auto;
            width: auto;
            border-radius: 0%;
            display: inline-block;
        }
    </style>
    <div class="row" style="margin-left:0px; margin-right:0px; margin-bottom:px;">

        <div class="card" style="margin-top: -15px;">
            <div class="col-lg-12 graphtopbottom">

                <div id="counter_status" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-left:0px; margin-right:0px; margin-bottom:px;">
        <div class="card">
            <div class="col-md-12">
                <center><h1>Counter Token Percentage</h1><center>
                        <div id="counter_token_percentage" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
                        </div>
                        </div>
                        <div>
                            <div class="row" style="margin-left:0px; margin-right:0px; margin-bottom:px;">
                                <div class="card">
                                    <div class="col-lg-12 graphtopbottom">
                                        <div id="counter_token_status" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left:0px; margin-right:0px; margin-bottom:px;">
                                <div class="card">
                                    <center><h1>Employee Status In Counter</h1></center>
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-2" style="">
                                            <a href="javascript:">Active <span class="badge " style="background-color: #4CAF50;" id="c_success">0</span></a>
                                        </div>


                                        <div class="col-md-2">
                                            <a  href="javascript:">Deactive <span class="badge" style="background-color: #F44336;" id="c_missed">0</span></a>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div><br>
                                    <div class="col-lg-12">
                                        <div id="counter_emp_status" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/charts/simple-skillbar.js"></script>

                        </div>
                        <style>
                            #counter_token_percentage{
                                min-height: 250px;
                            }
                        </style>
                        <script type="text/javascript" src="<?php echo $theme_path; ?>/service/charts/highcharts.js"></script>
                        <script>

                            $('document').ready(function () {
                                var tkn_status =<?php echo $counter_token_status; ?>

                                counter_token_status(tkn_status);
                                counter_emp_status(tkn_status);
                                counter_token_percentage(tkn_status);
                                var last_week_day =<?php echo $get_last_week_dates; ?>
                                counter_status(tkn_status, last_week_day);


                            });


                            function counter_status(tkn_status, last_week_day) {
                                var counter_tkn_week = [];
                                $.each(tkn_status.counter_tkn_week_data, function (key, value) {
                                    var status_count = value;
                                    var counter_name = tkn_status.counter_list[key];
                                    var newstr = JSON.parse('[' + status_count.join(',') + ']');
                                    counter_tkn_week.push({name: counter_name, data: newstr});

                                });


                                Highcharts.chart('counter_status', {
                                    title: {
                                        text: 'Last Week Counter Taken Time'
                                    },
                                    yAxis: {
                                        min: 0.5, max: 24,
                                        title: {
                                            text: 'Token Time Taken(hrs)'
                                        }
                                    },
                                    legend: {
                                        layout: 'vertical',
                                        align: 'right',
                                        verticalAlign: 'middle'
                                    },
                                    xAxis: {
                                        categories: last_week_day.day,
                                        title: {
                                            text: 'Last Week Days'
                                        }
                                    },
                                    series: counter_tkn_week,
                                    /*[{
                                     name: 'Installation',
                                     data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
                                     }, {
                                     name: 'Manufacturing',
                                     data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
                                     }, {
                                     name: 'Sales & Distribution',
                                     data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
                                     }, {
                                     name: 'Project Development',
                                     data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
                                     }, {
                                     name: 'Other',
                                     data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
                                     }],*/

                                    responsive: {
                                        rules: [{
                                                condition: {
                                                    maxWidth: 500
                                                },
                                                chartOptions: {
                                                    legend: {
                                                        layout: 'horizontal',
                                                        align: 'center',
                                                        verticalAlign: 'bottom'
                                                    }
                                                }
                                            }]
                                    }

                                });
                            }

                            function counter_token_percentage(tkn_status) {

                                var counter_tkn_counts = tkn_status.counter_tkn_counts;
                                var counter_totaltkn_counts = tkn_status.sum_all_tkn;
                                var counter_data_list = [];
                                $.each(tkn_status.counter_list, function (key, value) {
                                    var tkn_count = counter_tkn_counts[key];
                                    var newstr = Math.round((tkn_count / counter_totaltkn_counts) * 100) + '' + '';
                                    counter_data_list.push({label: value, value: tkn_count});

                                });

                                if (counter_totaltkn_counts != 0) {
                                    Morris.Donut({
                                        element: 'counter_token_percentage',
                                        colors: ["#4661EE", "#EC5657", "#1BCDD1", "#8FAABB", "#B08BEB", "#3EA0DD", "#F5A52A", "#23BFAA", "#FAA586", "#EB8CC6"],
                                        data: counter_data_list,
                                        formatter: function (value, data) {
                                            if (value != 0)
                                                var data = Math.round(value / counter_totaltkn_counts * 100) + '%';
                                            else
                                                var data = "0%";

                                            console.log(data);
                                            return data;

                                        }
                                    });
                                }
                            }

                            function counter_emp_status(tkn_status) {

                                var counter_name = tkn_status.counter_list;
                                var curr_tkn = tkn_status.counter_curr_token;
                                var curr_tkn_status = tkn_status.counter_curr_status;
                                var couter_tkn_count = tkn_status.couter_tkn_count;

                                var option_text = '';
                                $.each(counter_name, function (key, value) {
                                    var tkn_number = '-  ' + curr_tkn[key] + '';
                                    if (curr_tkn[key] == null) {
                                        var tkn_number = '';
                                    }

                                    var width = parseInt(couter_tkn_count[key]) + parseInt(20);

                                    if (curr_tkn_status[key] == 1) {

                                        option_text += '<div id="skill' + key + '" class="emp_status" data-width="' + width + '" data-background="green"><span class="title_bg">' + value + '  ' + tkn_number + '</span></div><br>';
                                    } else {
                                        option_text += '<div id="skill' + key + '" class="emp_status" data-width="' + width + '" data-background="red"><span class="title_bg">' + value + '</span></div><br>';
                                    }

                                });
                                $('#counter_emp_status').append(option_text);
                                $('.emp_status').simpleSkillbar({});
                            }

                            function counter_token_status(tkn_status) {
                                var counter_name = [];
                                $.each(tkn_status.counter_list, function (key, value) {
                                    counter_name.push(value);
                                });

                                var counter_data = [];
                                $.each(tkn_status.counter_data, function (key, value) {
                                    var status_count = value.data;
                                    var newstr = JSON.parse('[' + status_count.join(',') + ']');
                                    counter_data.push({name: value.name, data: newstr});

                                });
                                Highcharts.chart('counter_token_status', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Counter Token Status'
                                    },
                                    xAxis: {
                                        categories: counter_name,
                                        title: {
                                            text: 'Counter List'
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Total token status count'
                                        },
                                        stackLabels: {
                                            enabled: true,
                                            style: {
                                                fontWeight: 'bold',
                                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                            }
                                        }
                                    },
                                    legend: {
                                        align: 'right',
                                        x: -30,
                                        verticalAlign: 'top',
                                        y: 25,
                                        floating: true,
                                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                                        borderColor: '#CCC',
                                        borderWidth: 1,
                                        shadow: false
                                    },
                                    tooltip: {
                                        headerFormat: '<b>{point.x}</b><br/>',
                                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                    },
                                    plotOptions: {
                                        column: {
                                            stacking: 'normal',
                                            dataLabels: {
                                                enabled: true,
                                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                            }
                                        }
                                    },
                                    series: [{
                                            "name": "Success",
                                            "data": counter_data[0].data
                                        }, {
                                            "name": "Hold",
                                            "data": counter_data[1].data
                                        }, {
                                            "name": "Missed",
                                            "data": counter_data[2].data
                                        }, {
                                            "name": "Transfer",
                                            "data": counter_data[3].data
                                        }, {
                                            "name": "Hold-Reassign",
                                            "data": counter_data[4].data
                                        }, {
                                            "name": "Missed-Reassign",
                                            "data": counter_data[5].data
                                        }]
                                });
                            }


                        </script>
