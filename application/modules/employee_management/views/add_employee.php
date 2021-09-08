<?php $theme_path = $this->config->item('theme_locations') . 'event'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Add New Employee</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('employee_management/employee/add', 'name="add_employee" id="add_employee" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <legend class="text-bold">Employee Information</legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Employee ID:</strong></label>
                                <input type="text" name="employee[emp_id]" id="user_id" class="form-control input-sm " value="<?php echo $emp_id; ?>" readonly="readonly" placeholder="Enter EMP ID" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Employee Name:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[emp_name]" class="form-control input-sm required" id="emp_name" placeholder="Enter Employee Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Username:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[username]" id="username" class="form-control input-sm required" placeholder="Enter Username" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin-top:7px;">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Email Address:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[email_address]" id="email" class="form-control input-sm required" placeholder="Enter Email Address" maxlength="100">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Password:</strong></label><span class="req">*</span>
                                <input type="password" name="employee[password]" id="password" class="form-control input-sm required" minlength="6" placeholder="Enter Password">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Retype Password:</strong></label><span class="req">*</span>
                                <input type="password" name="retype_password" id="retype_password" minlength="6" class="form-control input-sm required" placeholder="Retype Password"  onChange="checkPasswordMatch();">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                                <div style="color:red;" class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top:7px;">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Mobile Number:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[mobile_number]" id="mobile" class="form-control input-sm required" placeholder="Enter Mobile Number" maxlength="10">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mobile2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Status:</strong></label>
                                <select name="employee[status]" class="form-control input-sm ">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="error_msg"></span>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('employee_management/employee'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                    <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<?php echo form_close(); ?>
<script type="text/javascript">



//    function checkPasswordMatch() {
//        var password = $("#password").val();
//        var confirmPassword = $("#retype_password").val();
//
//        if (confirmPassword != "" && password != confirmPassword)
//            $("#divCheckPasswordMatch").html("Password and retype password should be same ");
//        else
//            $("#divCheckPasswordMatch").html("");
//    }

    $('#emp_name').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            $('#emp_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');

        }

    });
    $('#username').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');

        }

    });
    $('#username').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');

        }

    });

    $('#username').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            $.ajax({
                type: 'POST',
                data: {username: $.trim($('#username').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_user_name_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#username').closest('div.form-group').find('.error_msg').text('This User Name is already taken').slideDown('500').css('display', 'inline-block');

                    } else {

                        $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });

        }

    });



    $('#password').on('keyup blur', function () {

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            if ($.trim($('#password').val()) != '' && $.trim($('#retype_password').val()) != '' && $('#password').val() != $('#retype_password').val()) {

                $('#retype_password').closest('div.form-group').find('.error_msg').text('Password and Retype Password should be same').slideDown('500').css('display', 'inline-block');

            } else {

                $('#password').closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        }

    });



    $('#retype_password').on('keyup blur', function () {

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {

            if ($.trim($('#password').val()) != '' && $.trim($('#retype_password').val()) != '' && $('#password').val() != $('#retype_password').val()) {

                $('#retype_password').closest('div.form-group').find('.error_msg').text('Password and Retype Password should be same').slideDown('500').css('display', 'inline-block');

            } else {

                $('#retype_password').closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        }

    });



    $('#email').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        emailRegexStr = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        is_valid = emailRegexStr.test(this_val);

        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else if (!is_valid) {

            $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Email Address').slideDown('500').css('display', 'inline-block');

        } else {

            $.ajax({
                type: 'POST',
                data: {email: $.trim($('#email').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_email_address_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#email').closest('div.form-group').find('.error_msg').text('This Email Address is already taken').slideDown('500').css('display', 'inline-block');

                    } else {

                        $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });

        }

    });



    $('#mobile').on('keyup blur', function () {

        this_val = $.trim($(this).val());

        pattern_phone = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

        is_valid = pattern_phone.test(this_val);

        if ($.trim($(this).val()) == '') {

            s

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else if (!is_valid) {

            $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Mobile Number').slideDown('500').css('display', 'inline-block');

        } else {

            $.ajax({
                type: 'POST',
                data: {mobile: $.trim($('#mobile').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_mobile_number_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#mobile').closest('div.form-group').find('.error_msg').text('This Mobile Number is already taken').slideDown('500').css('display', 'inline-block');

                    } else {

                        $('#mobile').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });

        }

    });



    $('.submit').click(function () {

        m = 0;
        $('.required').each(function () {
            this_val = $.trim($(this).val());
            this_id = $(this).attr('id');

            if (this_val == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                m++;
            } else if (this_id == 'email') {

                emailRegexStr = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                is_valid = emailRegexStr.test(this_val);

                if (!is_valid) {

                    $(this).closest('div.form-group').find('.error_msg').text('Enter valid Email Address').slideDown('500').css('display', 'inline-block');

                    m++;

                } else {

                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                }

            } else if (this_id == 'mobile') {

                pattern_phone = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

                is_valid = pattern_phone.test(this_val);

                if (!is_valid) {

                    $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Mobile Number').slideDown('500').css('display', 'inline-block');

                    m++;

                } else {

                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                }

            } else {

                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });



        if (m == 0) {



            $.ajax({
                type: 'POST',
                async: false,
                data: {username: $.trim($('#username').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_user_name_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#username').closest('div.form-group').find('.error_msg').text('This User Name is already taken').slideDown('500').css('display', 'inline-block');

                        m++;

                    } else {

                        $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });



            $.ajax({
                type: 'POST',
                async: false,
                data: {email: $.trim($('#email').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_email_address_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#email').closest('div.form-group').find('.error_msg').text('This Email Address is already taken').slideDown('500').css('display', 'inline-block');

                        m++;

                    } else {

                        $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });



            $.ajax({
                type: 'POST',
                async: false,
                data: {mobile: $.trim($('#mobile').val())},
                url: '<?php echo base_url(); ?>employee_management/employee/is_mobile_number_available/',
                success: function (data) {

                    if (data == 'yes') {

                        $('#mobile').closest('div.form-group').find('.error_msg').text('This Mobile Number is already taken').slideDown('500').css('display', 'inline-block');

                        m++;

                    } else {

                        $('#mobile').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }

                }

            });

        }

        if (m > 0)
            return false;

    });


</script>