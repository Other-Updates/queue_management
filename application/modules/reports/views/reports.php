<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.css">
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
	.outline_points { border: 1px solid #efefef;
    padding: 3px;}
    .balence_points {margin-top:15px; }

</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Queue Reports
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-left:0px; margin-right:0px; margin-bottom:32px;">
        <form id="form-filter" class="form-horizontal">
            <div class="col-md-2">
                <label><strong>Counter Name:</strong></label>
                <select name="counter_name" id="counter_name" class="form-control input-sm required">
                    <option value="">Select Counter Name</option>

                    <?php
                    if (!empty($counter)) {
                        foreach ($counter as $type) {
                            ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo ucfirst($type['counter_name']); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label><strong>Employee Name:</strong></label>
                <select name="emp_name" id="emp_name" class="form-control input-sm required">
                    <option value="">Select Employee Name</option>
                    <?php
                    if (!empty($emp)) {
                        foreach ($emp as $type) {
                            ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo ucfirst($type['emp_name']); ?></option>
                            <?php
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="col-md-2">
                <label><strong>Status:</strong></label>
                <select name="status" id="status" class="form-control input-sm required">
                    <option value="">Select Token Status</option>
                    <option value="Success">Success</option>
                    <option value="Hold">Hold</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Missed">Missed</option>
                    <option value="Missed-Reassign">Missed-Reassign</option>
                    <option value="Hold-Reassign">Hold-Reassign</option>
                </select>
            </div>
            <div class="col-md-2">
                <label><strong>From Date:</strong></label><input type="text" name="from_date" id="from_date"  value="<?php echo date('d/m/Y'); ?>"  class="form-control input-sm required datepicker from_date" value="" placeholder="Select From Date">
            </div>
            <div class="col-md-2">
                <label><strong>To Date:</strong></label><input type="text" name="to_date" id="to_date"  value="<?php echo date('d/m/Y'); ?>" class="form-control input-sm required datepicker to_date" value="" placeholder="Select To Date">
            </div>
            <div class="col-md-2">
                <label><strong>Token Number:</strong></label>
                <select name="tkn_number" id="tkn_number" class="form-control input-sm">
                    <option value="">Select Token Number</option>
                    <?php
                    if (!empty($tkn_num)) {
                        foreach ($tkn_num as $tkn_number) {
                            ?>
                            <option value="<?php echo $tkn_number['token_number']; ?>"><?php echo $tkn_number['token_number']; ?></option>
                            <?php
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="col-md-6" style="margin-top:25px;">
                <a id='search' class="btn btn-success" title="Search"><i class=" icon-search4"></i>Search</a>&nbsp;
                <button type="button" class="btn btn-danger cancel" id="clear"><i class="icon-rotate-cw2"></i> Reset</button>

                <button type="button" class=" btn btn-success " data-toggle="dropdown">
                    <span class="icon-printer"></span> Export
                </button>
                <ul class="dropdown-menu ddadjust" role="menu">
                    <li><a href="javascript:" class="export_excel">Excel</a></li>
                    <li ><a href="javascript:" class="export_pdf">PDF</a></li>
                </ul>

            </div>

        </form>
    </div>
    <div id="date_err" style="color:red; margin-left: 550px;margin-top: 1px;"></div>
	<div class="row">
    <div class="container col-md-12 clrcmd">
        <div class="col-md-2 outline_points">
            <a href="javascript:">Success <span class="badge " style="background-color: #4CAF50;" id="c_success">0</span></a>
        </div>
        <div class="col-md-2 outline_points">
            <a  href="javascript:">Hold <span class="badge" style="background-color: skyblue;" id="c_hold">0</span></a>
        </div>
        <div class="col-md-2 outline_points">
            <a  href="javascript:">Hold Reassign<span class="badge" style="background-color: skyblue;" id="r_hold">0</span></a>
        </div>
        <div class="col-md-2 outline_points">
            <a  href="javascript:">Missed <span class="badge" style="background-color: #F44336;" id="c_missed">0</span></a>
        </div>
        <div class="col-md-2 outline_points">
            <a  href="javascript:">Missed Reassign<span class="badge" style="background-color: #F44336;" id="r_missed">0</span></a>
        </div>
        <div class="col-md-2 outline_points">
            <a  href="javascript:">Transfer <span class="badge" style="background-color: orange" id="c_transfer">0</span></a>
        </div>
        


    </div>
	</div>
	<div class="row balence_points">
	<div class="container col-md-12 clrcmd ">
	<div class="col-md-2 outline_points">
            <a  href="javascript:">Token Number <span class="badge" style="background-color: #4CAF50;" id="c_tkn_number">0</span></a>
        </div>

        <div class="col-md-2 outline_points">
            <a  href="javascript:">Processing time <span class="badge" style="background-color: #4CAF50;" id="c_p_time">0</span></a>
        </div>
	</div>
	</div>

    <div class="container col-md-12 clrcmd" style="margin-top:10px;">
        <div class="col-md-2">
            <a href="javascript:"><b>T-No : </b>Token Number </a>
        </div>
        <div class="col-md-2">
            <a  href="javascript:"><b>Q-S Time :</b> Queue Start Time </a>
        </div>
        <div class="col-md-2">
            <a  href="javascript:"><b>Q-T Taken :</b> Queue Time Taken </a>
        </div>
        <div class="col-md-2">
            <a  href="javascript:"><b>S-Time :</b> Start Time </a>
        </div>
        <div class="col-md-2">
            <a  href="javascript:"><b>E-Time :</b> End Time</a>
        </div>

        <div class="col-md-2">
            <a  href="javascript:"><b>P-Time : </b>Processing time </a>
        </div>


    </div>

    <style>
        .badge {
            height: auto;
            width: auto;

            border-radius: 50%;
            display: inline-block;
        }
    </style>

    <br/><br/>
    <table id="reportTable" class="table table-bordered table-striped table-hover responsive dataTable no-footer dtr-inline " width="100%"style="border-top: 1px solid #ccc;     border-bottom: 1px solid #ccc;">

        <thead>
            <tr>
                <th>S.No</th>
                <th>Counter</th>
                <th>Employee</th>
                <th>T-No</th>
                <th width="15% !important;">Date</th>
                <th>Q-S Time</th>
                <th>Q-T Taken</th>
                <th>S-Time</th>
                <th>E-Time</th>
                <th>P-Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="display_info">
        </tbody>
        <tfoot align="right">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>


            </tr>
        </tfoot>

    </table>
</div>
<div id="export_excel"></div>
<script>


    $("#to_date").on("change", function () {
        var to_date = this.value;
        var from_date = $('#from_date').val();
        get_token_number(from_date, to_date);
    });

    $("#from_date").on("change", function () {
        var from_date = (this.value);
        var to_date = ($('#to_date').val());
        get_token_number(from_date, to_date);

    });



    function get_token_number(from_date, to_date) {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'reports/get_tkn_number_bydate'; ?>',
            data: {'from_date': from_date, 'to_date': to_date},
            success: function (result) {

                $('#tkn_number').empty();
                var option_text = '';
                option_text += '<option>Select Token Number</option>';
                if (result != 1) {
                    var data = JSON.parse(result);
                    $.each(data, function (key, value) {

                        if (value.token_number != "")
                            option_text += '<option>' + value.token_number + '</option>'
                    });

                    $('#tkn_number').html(option_text);
                } else {
                    $('#tkn_number').html(option_text);
                }

            }
        });
    }

    $(document).ready(function () {
        var table;
        table = $('#reportTable').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": '<?php echo base_url() . 'reports/reports_ajaxList'; ?>',
                "type": "POST",
                "data": function (data) {

                    data.from_date = $("input.from_date").val();
                    data.to_date = $("input.to_date").val();
                    data.counter_id = $("#counter_name").val();
                    data.emp_id = $("#emp_name").val();
                    data.status = $("#status").val();
                    data.tkn_number = $("#tkn_number").val();
                }
            },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                //   console.log(data);
                var time = "00:00:00";
                var wait_time = "00:00:00";

                if (data != '') {
                    var time = data[0][11]['processing_time'];
                    var wait_time = data[0][11]['q_waiting_time'];
                    var success = data[0][11]['success'];
                    var Hold = data[0][11]['Hold'];
                    var r_hold = data[0][11]['Hold_reassign'];
                    var Missed = data[0][11]['Missed'];
                    var r_missed = data[0][11]['Missed_reassign'];
                    var Transfer = data[0][11]['Transfer'];
                    var tkn_number = data[0][11]['tkn_number'];
                }

                $('#c_success').text(success);
                $('#c_hold').text(Hold);
                $('#r_hold').text(r_hold);
                $('#r_missed').text(r_missed);
                $('#c_missed').text(Missed);
                $('#c_transfer').text(Transfer);
                $('#c_tkn_number').text(tkn_number);
                $('#c_p_time').text(time);
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                var cols = [6, 9, 10];
                for (x in cols) {
                    total = api.column(cols[11]).data().reduce(function (a, b) {
                        return intVal(a);
                    }, 0);

                    // Total over this page
                    pageTotal = api.column(cols[11], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a);
                    }, 0);

                    // Update footer
                    if (x == 0)
                        $(api.column(cols[x]).footer()).html(wait_time);
                    if (x == 1)
                        $(api.column(cols[x]).footer()).html(time);
                }


            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 10], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2}
            ],
        });

        $('#search').click(function () { //button filter event click
            table.ajax.reload();  //just reload table
        });
        $('#clear').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload();  //just reload table
        });
    });



    $(document).on('click', '.export_excel', function () {
        fnExcelReport2();
    });
    function fnExcelReport2()
    {
        var tab_text = "<table id='custom_export' border='5px'><tr width='100px' bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('reportTable'); // id of table
        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }
        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        $('#export_excel').show();
        $('#export_excel').html('').html(tab_text);
        $('#export_excel').hide();
        $("#custom_export").table2excel({
            exclude: ".noExl",
            name: "Sales Report",
            filename: "Sales Report",
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });
    }


    $('#counter_name').on('change', function () {
        $('#emp_name').empty();
        var counter_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>reports/get_emp_name_by_counter_id/' + counter_id,
            type: 'POST',
            data: {counter_id: counter_id},
            success: function (data) {
                result = JSON.parse(data);
                if (result != null && result.length > 0) {
                    option_text = '<option value="">Select Employee Name</option>';
//                    option_text = "<option value='" + value.emp_name + "'>" + value.emp_name + "</option>";
                    $.each(result, function (key, value) {
                        selected = (value.emp_id != '') ? 'selected="selected"' : '';
                        option_text += '<option value="' + value.emp_id + '" ' + selected + '>' + value.emp_name + '</option>';
//                        option_text += '<option value="' + value.id + '">' + value.emp_name + '</option>';
                    });
                    $('#emp_name').html(option_text);

                }
            }
        });
    });

    $('body').addClass('sidebar-xs');
    $('.export_pdf').click(function () {
        var BASE_URL = '<?php echo base_url(); ?>';
        var counter_name = $('#counter_name').val();
        var emp_name = $('#emp_name').val();
        var status = $('#status').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var tkn_number = $('#tkn_number').val();

        window.location = (BASE_URL + 'reports/reports/report_pdf?counter_id=' + counter_name + '&emp_id=' + emp_name + '&status=' + status + '&from_date=' + from_date + '&to_date=' + to_date + '&tkn_number=' + tkn_number);

    });

</script>
