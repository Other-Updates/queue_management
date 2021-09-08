<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/colors.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/bootstrap-toggle.min.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/plugins/datatable/jquery.dataTables.min.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/employeescreen.css" rel="stylesheet" type="text/css">
<style>
    #Queue_Process_processing {
        display: none !important;
    }
</style>
<div class="bgimage">
    <img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/admincounter.jpg" ?>"width="100%" height="100%"/>
</div>
<input type="hidden" id="counterId" name="counterId" value="<?php echo $counter_details[0]['id']; ?>" />
<div class="admincounter">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xs-4">
                <div class="currentdt">
                    <div class="logo">
                        <img src="<?php echo base_url() . "/themes/queue/service/images/logo1.png" ?>" width="150px"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <?php if ($assign_counter[0]['counter_id'] == 'hold') { ?>
                    <div class="currentdt">
                        <h1 class="counter" style="color:white; font-weight:bold; font-size:26px;"><?php echo 'Hold'; ?></h1>
                    </div>
                <?php } elseif ($assign_counter[0]['counter_id'] == 'idle') { ?>
                    <div class="currentdt">
                        <h1 class="counter" style="color:white; font-weight:bold; font-size:26px;"><?php echo 'IDLE'; ?></h1>
                    </div>
                <?php } else {
                    ?>
                    <div class="currentdt">
                        <h1 class="counter" style="color:white; font-weight:bold; font-size:26px;"><?php echo ucfirst($counter_details[0]['counter_space_name']) . " " . "-" . " "; ?><?php echo $emp_status == '1' ? 'Active' : 'Hold'; ?></h1>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xs-2" style="margin-top: 26px;" title="Employee Status">
                <?php if ($assign_counter[0]['counter_id'] != 'idle') { ?>
                    <?php if ($emp_status == '1') { ?>
                        <input type="checkbox"  class= "drophold" id='emp_status' style="width: 67px;height: 34px;background-color:none; border-color: #ddd ;"  onchange="emp_status(<?php echo $emp_id; ?>)" checked data-toggle="toggle" >
                    <?php } else { ?>
                        <input type="checkbox"  class= "drophold" id='emp_status' style="width: 67px;height: 34px;" onchange="emp_status(<?php echo $emp_id; ?>)" unchecked data-toggle="toggle" >
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col-xs-1" style="margin-top: 8px ;">
                <div class="currentdte">
                    <div class="">
                        <h6 class="username"><?php echo ucfirst($username); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="currentdte" style="margin-top: 38px ;">
                    <a href="<?php echo base_url() ?>users/logout"<i class="icon-switch2" title="logout"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-xs-9">
            <div class="admincounttable greyrow table-wrapper-scroll-y">

                <table id="Queue_Process" class="table  table-bordered table-striped table-hover responsive dataTable no-footer dtr-inline " width="100%"style="border-top: 1px solid #ccc;     border-bottom: 1px solid #ccc;">
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $emp_id; ?>" class="hiddens employee_id">
                    <input type="hidden" name="progress_tkn_count" id="progress_tkn_count" value="0">
                    <thead>
                        <tr class="counterheading">
                            <th>S.No</th>
                            <th>TOKEN NUMBER</th>
                            <th>STATUS</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>
                    <tbody id="display_info" >
                    </tbody>
                    <tfoot align="right">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
        <?php if ($emp_status == '1') { ?>
            <div class="col-xs-3" id="counter_tkn_updates">
                <div class="currentdt">
                    <h1>TOKEN NUMBER</h1>
                    <input type="hidden" id="current_token_num" value="<?php echo $status[0]['token_number']; ?>"/>
                    <input type="text" class="form-control admintokentext" id="tokentext" value="<?php echo $emp_status == '1' ? $status[0]['token_number'] : ''; ?>" readonly/>
                </div>
                <div class="col-xs-12">
                    <div class="token_error">
                        <span id="token_error"></span>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="currentdt">
                        <div class="row">
                            <?php echo form_open_multipart('counter/update_status/' . $status[0]['id'] . "/" . $emp_id, 'name = "counter_status" id = "counter_status" class = "form-horizontal token_form"'); ?>
                            <div class="row checkadjust">
                                <?php if ($counter_details[0]['success_end_point'] == 1) { ?>
                                    <div class="col-xs-6">
                                        <label class="checkbox-inline admincheckbox">
                                            <input type="checkbox" name="status[token_status]" class="countercheck " id="success" value="Success">Success
                                        </label>
                                    </div>

                                    <div class="col-xs-6">
                                        <label class="checkbox-inline admincheckboxhold">
                                            <input type="checkbox" name="status[token_status]" class="countercheck"  id="hold" value="Hold">Hold
                                        </label> &nbsp;
                                    </div>
                                    <div class="col-xs-6 empbtn">
                                        <label class="checkbox-inline trans admincheckboxtrans">
                                            <input type="checkbox" name="status[token_status]" class="countercheck"  id="transfer" value="Transfer">Transfer
                                        </label>
                                    </div>
                                    <div class="col-xs-6 empbtn">
                                        <label class="checkbox-inline admincheckboxmissed">
                                            <input type="checkbox"  name="status[token_status]" class="countercheck" id="missed" value="Missed">Missed
                                        </label><br/>
                                    </div>
                                <?php } else { ?>



                                    <div class="col-xs-12">
                                        <label class="checkbox-inline admincheckboxhold">
                                            <input type="checkbox" name="status[token_status]" class="countercheck"  id="hold" value="Hold">Hold
                                        </label> &nbsp;
                                    </div>
                                    <div class="col-xs-12 empbtn">
                                        <label class="checkbox-inline trans admincheckboxtrans">
                                            <input type="checkbox" name="status[token_status]" class="countercheck"  id="transfer" value="Transfer">Transfer
                                        </label>
                                    </div>
                                    <div class="col-xs-12 empbtn">
                                        <label class="checkbox-inline admincheckboxmissed">
                                            <input type="checkbox"  name="status[token_status]" class="countercheck" id="missed" value="Missed">Missed
                                        </label><br/>
                                    </div>


                                <?php } ?>
                                <div class="col-xs-12">
                                    <div class="checkbox_error">
                                        <span id="checkbox_error"></span>
                                    </div>
                                </div>
                                <div class="col-xs-6 empbtn" style="display:none;" id="holdremarks">
                                    <label class="checkbox-inline remarks">
                                        <input type="text" name="status[hold]" class="form-control holdremarks remarkssize"  id="statushold"  placeholder="Please enter remarks"/>
                                    </label><br/>
                                </div>
                                <div class="col-xs-6 empbtn" style="display:none;" id="transferremarks">
                                    <label class="checkbox-inline ">
                                        <select name="status[remarks]"  id="statustransfer" class="form-control input-sm transferremarks remarkssize" >
                                            <option value="">Select Counter Name</option>
                                            <?php
                                            if (!empty($get_assign_employee_counter)) {
                                                foreach ($get_assign_employee_counter as $type) {
                                                    if ($counter_name != $type['counter_name']) {
                                                        ?>

                                                        <option value="<?php echo $type['counter_name']; ?>" ><?php echo ucfirst($type['counter_name']); ?></option>

                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>

                                        </select>
                                    </label><br/>
                                </div>
                                <div class="col-xs-12">
                                    <div class="transfer_error">
                                        <span id="transfer_error"></span>
                                    </div>
                                </div>
                                <label class="adminbtn">
                                    <input type="button"  class="btn btn-success submit form-control sizebtn token_form_button" style="font-size:23px;height:50px;" value="Submit">
                                    <button type="button"  style="font-size:23px;height:50px;margin-top: 10px;width: 106%;margin-left:-9px;" class="btn btn-danger" id='cancel'> Cancel</button>
                                </label>
                                <input type="hidden" name="status[token_number]" id="current_tkn" class="" value="<?php echo $status[0]['token_number']; ?>">
                                <!--<input type="hidden" name="status[remarks]"  class="hidden">-->
                                <span class="error_msg"></span>
                                <input type="hidden" name="status[edit_in_time]"  id="edit_in_time" class="" value="">

                                <input type="hidden" name=""  id="employee_edit_form" class="" value="1">
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<script>

    $(document).ready(function () {
        var table;
        table = $('#Queue_Process').DataTable({
            "lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "searching": false,
            "paging": false,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": '<?php echo base_url() . 'counter/counter_ajax'; ?>',
                "type": "POST",
                "data": function (data) {
                    data.employee_id = $("input.employee_id").val();
                }
            },
            "footerCallback": function (row, data, start, end, display) {

                if (data != '') {
                    var progress_tkn = data[0][4];
                    var progress_tkn_number = data[0][5];
                    var progress_tkn_id = data[0][6];
                    var emp_form = $('#employee_edit_form').val();

                    if (progress_tkn != 0 && emp_form != 0) {
                        $('#progress_tkn_count').val(progress_tkn);
                        $('#tokentext').val(progress_tkn_number);
                        $('#current_tkn').val(progress_tkn_number);
                        $('#current_token_num').val(progress_tkn_number);
                        var base_url = "<?php echo base_url('/'); ?>";
                        var update = base_url + "counter/update_status/" + progress_tkn_id + "/" + $('#employee_id').val();
                        $('#counter_status').attr('action', update);
                        $('#Queue_Process').append('<style type="text/css">#display_info tr:first-child{background-color:#ccc;font-weight: bold;}</style>');
                        $('#employee_edit_form').val(1);
                    }

                    var emp_form = $('#employee_edit_form').val();

                    if (progress_tkn == 0 && emp_form != 0) {

                        $('#tokentext').val('');
                        $('#current_tkn').val('');
                        $('#current_token_num').val('');
                        $('#progress_tkn_count').val(progress_tkn);
                        $('#Queue_Process style').remove();
                        $('input[type = "checkbox"]').not(this).prop('checked', false);
                        $('#statushold').val('');
                    }

                }

            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 3], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2}
            ],
        });



    });


    $(window).bind("load", function () {
        setInterval(function () {
            table = $('#Queue_Process').DataTable();
            var progress_tkn = $('#progress_tkn_count').val();

            table.ajax.reload();

        }, 5000);
    });


    $(document).on('click', 'input[type = "checkbox"]', function () {
        $('input[type = "checkbox"]').not(this).prop('checked', false);

    });

    $("#hold").click(function () {
        var hold = $('#hold').is(':selected');

        if ($(this).is(":checked")) {
            $("#holdremarks").show();
        }
        if (hold == false) {
            $('#statushold').val("");
        } else {
            $("#holdremarks").hide();

        }
    });
    $("#transfer").click(function () {
        var transfer = $('#transfer').is(':selected');
        var trans_check = $(this).is(":checked");

        if (trans_check == true) {

            $("#transferremarks").show();
        } else {

            $("#transferremarks").hide();
        }

        if (transfer == false) {
            $('#statustransfer').val("");
        }
    });
    $("#success,#missed,#transfer").click(function () {
        if ($(this).is(":checked")) {
            $("#holdremarks").hide();

        }
    });
    $("#success,#missed").click(function () {
        $('#transfer_error').empty();
    });
    $("#success,#missed,#hold").click(function () {
        if ($(this).is(":checked")) {
            $("#transferremarks").hide();
        }

    });
    $(".token_form_button").click(function () {

        var token_number = $('#current_token_num').val();
        var checkbox = $(".countercheck").is(":checked");
        m = 0;


        if (token_number == "")
        {
            m = 1;
            $('#token_error').empty();
            $('#token_error').append('Currently no token was available');
            setTimeout(function () {
                $('#token_error').html('');
            }, 3000);
            return false;
        }
        if (checkbox == false)
        {
            m = 1;
            $('#checkbox_error').empty();
            $('#checkbox_error').append('Checkbox field is required');
            setTimeout(function () {
                $('#checkbox_error').html('');
            }, 3000);
            return false;
        }

        if ($(".countercheck").is(":checked"))
        {
            var status = $('input[name="status[token_status]"]:checked').val();
            if (status == "Transfer")
            {
                var transfer = $('#statustransfer').val();
                if (transfer == "")
                {
                    m = 1;
                    $('#transfer_error').empty();
                    $("#transfer_error").append('Please select counter name ');
                    setTimeout(function () {
                        $('#transfer_error').html('');
                    }, 3000);
                    return false;
                } else {
                    var base_url = "<?php echo base_url('/'); ?>";
                    var counter_url = base_url + "counter/check_counter_active/";
                    var counter_name = $('#statustransfer').val();
                    $.ajax({
                        type: "POST",
                        url: counter_url,
                        data: {counter_name: counter_name},
                        success: function (data) {
                            if (data == 0) {
                                m = 1;
                                $('#transfer_error').empty();
                                $("#transfer_error").append('' + counter_name + '  ' + "Not Active" + '');
                                setTimeout(function () {
                                    $('#transfer_error').html('');
                                }, 3000);
                                return false;
                            } else {
                                form_submit();
                            }
                        }
                    });
                }
            }
            if (status == "Hold")
            {
                var hold = $('#statushold').val();
                if (hold == "")
                {
                    m = 1;
                    $('#transfer_error').empty();
                    $("#transfer_error").append('Remarks field is required');
                    setTimeout(function () {
                        $('#transfer_error').html('');
                    }, 3000);
                    return false;
                } else {
                    form_submit();
                }
            }

            if (status == "Missed" || status == "Success") {
                if (m == 0)
                    form_submit();
            }


        }

    });

    $('#cancel').on('click', function () {
        $('#tokentext').val('');
        $('input[type = "checkbox"]').not(this).prop('checked', false);
        $('#statushold').val('');
        $('#statustransfer').val('');
        $('#employee_edit_form').val(1);
        table = $('#Queue_Process').DataTable();
        var progress_tkn = $('#progress_tkn_count').val();
        table.ajax.reload();
    });



    function form_submit() {
        $('.token_form_button').val("Please Wait...")
                .attr('disabled', 'disabled');
        var que_data = $("#counter_status").serializeArray();
        var que_url = $('#counter_status').attr('action');
        $.ajax({
            type: "POST",
            url: que_url,
            data: que_data,
            success: function (value) {
                $('#employee_edit_form').val(1);
                if (value == 1) {
                    $('.token_form_button').val("Submit").attr('disabled', false);
                    table = $('#Queue_Process').DataTable();
                    table.ajax.reload();
                    $('input[type = "checkbox"]').not(this).prop('checked', false);
                    $('#statushold').val('');
                    $('#statustransfer').val('');

                }
            }
        });
    }
    function update(id) {

        $('#employee_edit_form').val('0');
        $('input[type = "checkbox"]').not(this).prop('checked', false);

        var token_id = $('.token_num' + id).text();
        var emp = $("#employee_id").val();
        var in_time = "<?php echo date('H:i:s'); ?>";
        var tkn_status = $('.tkn_status' + id).text();
        var remarks = $('.remar' + id).text();
        var status = "";
        if (tkn_status == "Success")
            var status = "success";
        else if (tkn_status == "Missed")
            var status = "missed";
        else if (tkn_status == "Hold")
            var status = "hold";

        if (status)
        {
            $('#' + status).prop('checked', true);

        }
        var hold = $('#hold').is(':checked');

        if (hold == true) {
            $("#holdremarks").show();
            $('#statushold').val(remarks);
        } else {
            $("#holdremarks").hide();
        }

        var transfer = $('#transfer').is(':checked');
        if (transfer == true) {
            $("#transferremarks").show();
            $('#statustransfer').val(remarks);
        } else {
            $("#transferremarks").hide();
        }
        $('#tokentext').val('');
        $('#current_token_num').val('');
        $('#counter_status').attr('action', '');
        $('#edit_in_time').val('');
        $('#current_token_num').val(token_id);
        $('#tokentext').val(token_id);
        $('#edit_in_time').val(in_time);
        $('#current_tkn').val(token_id);


        var base_url = "<?php echo base_url('/'); ?>";
        var update = base_url + "counter/edit_update_status/" + id + "/" + emp;


        $('#counter_status').attr('action', update);

    }

    function emp_status(emp_id) {
        var isChecked = document.getElementById('emp_status').checked;
        var emp_status = isChecked ? 1 : 0;
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + ' ' + time;

        if (emp_status == '0') {
            var base_url = "<?php echo base_url('/'); ?>";
            $.ajax({
                type: "POST",
                data: {idle_start: dateTime, emp_id: emp_id},
                url: "<?php echo base_url(); ?>counter/counter/insert_emp_idle_start_time/",
                success: function (data) {
                    console.log('success');
                }
            });
        }

        if (emp_status == '1') {
            var base_url = "<?php echo base_url('/'); ?>";
            $.ajax({
                type: "POST",
                data: {idle_end: dateTime, emp_id: emp_id},
                url: "<?php echo base_url(); ?>counter/counter/update_emp_idle_end_time/",
                success: function (data) {
                    console.log('success');
                }
            });
        }
        var counterId = $('#counterId').val();

        $.ajax({
            type: "POST",
            data: {emp_id: emp_id, emp_status: emp_status, counterId: counterId},
            url: "<?php echo base_url(); ?>counter/counter/update_emp_status/",
            success: function (data) {
                table = $('#Queue_Process').DataTable();
                table.ajax.reload();

                if (emp_status == 1)
                    $('#counter_tkn_updates').show();
                else
                    $('#counter_tkn_updates').hide();
            }
        });
    }

</script>




