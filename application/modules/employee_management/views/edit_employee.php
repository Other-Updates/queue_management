<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit Employee</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('employee_management/employee/edit/' . $employee[0]['id'], 'name="edit_member" id="edit_member" class="form-horizontal"'); ?>
        <input type="hidden" name="user_id" id="user_id_" value="<?php echo $user[0]['id']; ?>">
        <fieldset class="content-group">
            <legend class="text-bold">Employee Information</legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Employee Name:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[emp_name]" class="form-control input-sm required" value="<?php echo $employee[0]['emp_name']; ?>" id="emp_name" placeholder="Enter Employee Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Username:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[username]" id="username" class="form-control input-sm required" value="<?php echo ucfirst($employee[0]['emp_name']); ?>" placeholder="Enter Username" maxlength="50">
                                <input type="hidden" name="current_username" id="current_username" value="<?php echo ucfirst($employee[0]['emp_name']); ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Mobile Number:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[mobile_number]" id="mobile" class="form-control input-sm required" value="<?php echo $employee[0]['mobile_number']; ?>" placeholder="Enter Mobile Number" maxlength="10">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mobile2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:7px;">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Email Address:</strong></label><span class="req">*</span>
                                <input type="text" name="employee[email_address]" id="email" class="form-control input-sm required" value="<?php echo $employee[0]['email_address']; ?>" placeholder="Enter Email Address" maxlength="100">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Password:</strong></label><span class="req" style="font-size: 12px;"> (Leave as empty, if you do not change password)</span>
                                <input type="password" name="employee[password]" id="password" class="form-control input-sm " minlength="6" placeholder="Enter Password">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Retype Password:</strong></label><span class="req">*</span>
                                <input type="password" name="retype_password" id="retype_password" minlength="6" class="form-control input-sm " placeholder="Retype Password" onChange="checkPasswordMatch();">
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
                                <label><strong>Status:</strong></label>
                                <select name="employee[status]" class="form-control input-sm">
                                    <option value="1" <?php echo ($employee[0]['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($employee[0]['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                                <span class="error_msg"></span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('employee_management/employee'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $('#lastname').on('keyup blur', function() {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#lastname').closest('div.form-group').find('.error_msg').text('').slideUp('500');
        }
    });
    $('#firstname').on('keyup blur', function() {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#firstname').closest('div.form-group').find('.error_msg').text('').slideUp('500');
        }

    });
    $('#username').on('keyup blur', function() {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            current_username = ('#current_username').val();
            $.ajax({
                type: 'POST',
                data: {
                    username: $.trim($('#username').val())
                },
                url: '<?php echo base_url(); ?>employee_management/employee/is_user_name_available/',
                success: function(data) {
                    if (data == 'yes') {
                        $('#username').closest('div.form-group').find('.error_msg').text('This User Name is already taken').slideDown('500').css('display', 'inline-block');
                    } else {
                        $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }

                }

            });
        }

    });
    $('#email').on('keyup blur', function() {
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
                data: {
                    email: $.trim($('#email').val())
                },
                url: '<?php echo base_url(); ?>employee_management/employee/is_email_address_available/',
                success: function(data) {

                    if (data == 'yes') {

                        $('#email').closest('div.form-group').find('.error_msg').text('This Email Address is already taken').slideDown('500').css('display', 'inline-block');
                    } else {

                        $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }

                }
            });
        }
    });
    $('#mobile').on('keyup blur', function() {
        this_val = $.trim($(this).val());
        pattern_phone = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
        is_valid = pattern_phone.test(this_val);
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else if (!is_valid) {
            $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Mobile Number').slideDown('500').css('display', 'inline-block');
        }
    });
    $('.submit').click(function() {
        m = 0;
        $('.required').each(function() {
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
            current_username = $('#current_username').val();
            new_username = $('#username').val();
            if (current_username != new_username) {
                $.ajax({
                    type: 'POST',
                    async: false,
                    data: {
                        username: $.trim($('#username').val()),
                        id: $('#user_id').val()
                    },
                    url: '<?php echo base_url(); ?>employee_management/employee/is_user_name_available/',
                    success: function(data) {
                        if (data == 'yes') {
                            $('#username').closest('div.form-group').find('.error_msg').text('This User Name is already taken').slideDown('500').css('display', 'inline-block');
                            m++;

                        } else {

                            $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                        }
                    }
                });
            }

        }

        if (m > 0)
            return false;
    });
</script>