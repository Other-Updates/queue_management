
<style>
    .thumb-rounded, .thumb-rounded img, .thumb-rounded .caption-overflow {
        border-radius: 14% !important;
    }
</style>

<!-- Form horizontal -->

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">My Profile</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="panel-body">
            <?php echo form_open_multipart('superadmin/my_profile/' . $super_admin[0]['id'], 'name="my_profile" id="my_profile" class="form-horizontal"'); ?>

            <fieldset class="content-group">
                <legend class="text-bold">Super Admin Information</legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>First Name:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[firstname]" id="firstname" class="form-control required" value="<?php echo $super_admin[0]['firstname']; ?>" placeholder="Enter First Name">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>Super Admin ID:</strong></label>
                                    <input type="text" name="super_admin[super_admin_id]" id="super_admin_id" class="form-control " value="<?php echo $super_admin[0]['super_admin_id']; ?>" readonly="readonly" placeholder="Enter Super Admin Id">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>


                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>Username:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[username]" id="username" class="form-control required" value="<?php echo $super_admin[0]['username']; ?>" readonly="readonly" placeholder="Enter Username">
                                    <input type="hidden" name="current_username" id="current_username" value="<?php echo $super_admin[0]['username']; ?>">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback has-feedback-right">
                                    <label><strong>Mobile Number:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[mobile_number]" id="mobile" class="form-control required" value="<?php echo $super_admin[0]['mobile_number']; ?>" placeholder="Enter Mobile Number" maxlength="10">
                                    <input type="hidden" name="current_mobile_number" id="current_mobile_number" value="<?php echo $super_admin[0]['mobile_number']; ?>">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-mobile2"></i>
                                    </div>
                                </div>
                                <!--                                <div class="form-group has-feedback">
                                                                    <label><strong>User Type:</strong></label>
                                                                    <div><span class="badge badge-primary" style="font-size: 12px;"><?php echo ucfirst($super_admin[0]['user_type_name']); ?></span></div>
                                                                </div>-->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>Last Name:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[lastname]" id="lastname" class="form-control required" value="<?php echo $super_admin[0]['lastname']; ?>" placeholder="Enter Last Name">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback has-feedback-right">
                                    <label><strong>DOB:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[dob]" id="dob" class="form-control required datepicker" value="<?php echo date('d/m/Y', strtotime($super_admin[0]['dob'])); ?>" placeholder="Select Date of Birth">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-calendar3"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback has-feedback-right">
                                    <label><strong>Email Address:</strong></label><span class="req">*</span>
                                    <input type="text" name="super_admin[email_address]" id="email" class="form-control required" value="<?php echo $super_admin[0]['email_address']; ?>" placeholder="Enter Email Address">
                                    <input type="hidden" name="current_email_address" id="current_email_address" value="<?php echo $super_admin[0]['email_address']; ?>">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-mail5"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label><strong>Address:</strong></label><span class="req">*</span>
                                    <div>
                                        <input type="text" name="super_admin[address]" id="address" class="form-control required" value="<?php echo $super_admin[0]['address']; ?>" placeholder="Enter Address">
                                    </div>
                                    <span class="error_msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="thumb thumb-rounded thumb-slide" style="width:56%;">
                                        <?php
                                        $image_name = !empty($super_admin[0]['profile_image']) ? pathinfo($super_admin[0]['profile_image'], PATHINFO_FILENAME) : '';
                                        $image_ext = !empty($super_admin[0]['profile_image']) ? pathinfo($super_admin[0]['profile_image'], PATHINFO_EXTENSION) : '';
                                        $exists = file_exists(FCPATH . 'attachments/profile_image/' . $image_name . '.' . $image_ext);
                                        if (!empty($super_admin[0]['profile_image']) && $exists) {
                                            $image_path = base_url() . 'attachments/profile_image/' . $image_name . '.' . $image_ext;
                                        } else {

                                            $image_path = base_url() . 'themes/event/assets/images/default_profile_image.png';
                                        }
                                        ?>
                                        <a href="javascript:void(0);"><img src="<?php echo $image_path; ?>" id="profile" class="imagePreview"></a>
                                    </div>
                                    <div class="caption text-center">
                                        <h6 class="text-semibold no-margin"><?php echo ucfirst($super_admin[0]['firstname']) . ' ' . ucfirst($super_admin[0]['lastname']); ?> <small class="display-block"><?php echo!empty($super_admin[0]['user_type_name']) ? ucfirst($user[0]['user_type_name']) : ''; ?></small></h6>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label><strong>Profile Picture:</strong></label><small class="req"> (Minimum resolution is 150x150)</small>
                                    <input type="file" name="profile_image" id="profile_image" class="form-control input-sm" placeholder="Choose Profile Picture">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-file-picture"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <legend class="text-bold">Reset Password</legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>Password:</strong></label><span class="req" style="font-size: 12px;"> (Leave as empty, if you do not change password)</span>
                                    <input type="password" name="super_admin[password]" id="password" class="form-control" placeholder="Enter Password">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label><strong>Retype Password:</strong></label>
                                    <input type="password" name="retype_password" id="retype_password" class="form-control" placeholder="Retype Password">
                                    <span class="error_msg"></span>
                                    <div class="form-control-feedback">
                                        <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url(); ?>superadmin/dashboard'" style="float:left;" title="Cancel"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                    <button type="submit" class="btn btn-success submit" style="float:right;" title="Submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#profile_image').on('change', function () {
            var files = this.files;
            if (files && files[0]) {
                readImage(files[0], '#profile_image');

            } else {
                default_src = $('#imagePreview').attr('default_src');
                $('#imagePreview').attr('src', default_src);

            }

        });

        $('#firstname, #lastname').on('keyup blur', function () {
            this_val = $.trim($(this).val());
            if ($.trim($(this).val()) == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

            } else {

                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }
        });

        $('#dob').on('change', function () {
            var dob = $('#dob').val();
            if (dob == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

            } else {
                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });
        $('#email').on('keyup blur', function () {
            current_email_address = $('#current_email_address').val();
            new_email_address = $('#email').val();
            this_val = $.trim($(this).val());
            emailRegexStr = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            is_valid = emailRegexStr.test(this_val);
            if ($.trim($(this).val()) == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

            } else if (!is_valid) {
                $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Email Address').slideDown('500').css('display', 'inline-block');
            } else if (current_email_address != new_email_address) {
                $.ajax({
                    type: 'POST',
                    data: {email: $.trim($('#email').val())},
                    url: '<?php echo base_url(); ?>superadmin/is_email_address_available/',
                    success: function (data) {
                        if (data == 'yes') {
                            $('#email').closest('div.form-group').find('.error_msg').text('This Email Address is already taken').slideDown('500').css('display', 'inline-block');

                        } else {
                            $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                        }
                    }
                });

            } else {

                $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });

        $('#mobile').on('keyup blur', function () {
            current_mobile_number = $('#current_mobile_number').val();
            new_mobile_number = $('#mobile').val();
            this_val = $.trim($(this).val());
            pattern_phone = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
            is_valid = pattern_phone.test(this_val);
            if ($.trim($(this).val()) == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
            } else if (!is_valid) {
                $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Mobile Number').slideDown('500').css('display', 'inline-block');
            } else if (current_mobile_number != new_mobile_number) {
                $.ajax({
                    type: 'POST',
                    data: {mobile: $.trim($('#mobile').val())},
                    url: '<?php echo base_url(); ?>superadmin/is_mobile_number_available/',
                    success: function (data) {
                        if (data == 'yes') {
                            $('#mobile').closest('div.form-group').find('.error_msg').text('This Mobile Number is already taken').slideDown('500').css('display', 'inline-block');
                        } else {
                            $('#mobile').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                        }
                    }
                });
            } else {
                $('#mobile').closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });

        $('#password, #retype_password').on('keyup blur', function () {
            password = $.trim($('#password').val());
            retype_password = $.trim($('#retype_password').val());
            this_val = $.trim($(this).val());
            this_length = this_val.length;
            if (this_length <= 5 || this_length >= 12) {
                $(this).closest('div.form-group').find('.error_msg').text('Password should be between 6-12 characters').slideDown('500').css('display', 'inline-block');

            } else if (password != '' && retype_password != '' && password != retype_password) {
                $(this).closest('div.form-group').find('.error_msg').text('Password and Retype Password should be same').slideDown('500').css('display', 'inline-block');

            } else {

                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });
        $('.submit').click(function () {
            m = 0;

            $('.required').each(function () {
                this_val = $.trim($(this).val());
                this_id = $(this).attr('id');
                this_length = this_val.length;
                if (this_val == '') {
                    $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                    m++;
                } else if (this_id == 'email') {
                    emailRegexStr = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                    is_valid = emailRegexStr.test(this_val);
                    if (!is_valid) {
                        $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Email Address').slideDown('500').css('display', 'inline-block');
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
                } else if (this_id == 'password' || this_id == 'retype_password') {
                    if (this_length <= 5 && this_length >= 16) {
                        $(this).closest('div.form-group').find('.error_msg').text('Password(s) should be between 6-15 characters').slideDown('500').css('display', 'inline-block');
                        m++;
                    } else if ($.trim($('#password').val()) != '' && $.trim($('#retype_password').val()) != '' && $('#password').val() != $('#retype_password').val()) {
                        $('#retype_password').closest('div.form-group').find('.error_msg').text('Password and Retype Password should be same').slideDown('500').css('display', 'inline-block');
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
                username = $('#username').val();
                if (current_username != username) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {username: $.trim($('#username').val())},
                        url: '<?php echo base_url(); ?>superadmin/is_user_name_available/',
                        success: function (data) {
                            if (data != 0) {
                                $('#username').closest('div.form-group').find('.error_msg').text('This User Name is already taken').slideDown('500').css('display', 'inline-block');
                                m++;
                            } else {
                                $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                            }
                        }
                    });
                }
                current_email_address = $('#current_email_address').val();
                new_email_address = $('#email').val();
                if (current_email_address != new_email_address) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {email: $.trim($('#email').val())},
                        url: '<?php echo base_url(); ?>superadmin/is_email_address_available/',
                        success: function (data) {
                            if (data != 0) {
                                $('#email').closest('div.form-group').find('.error_msg').text('This Email Address is already taken').slideDown('500').css('display', 'inline-block');
                                m++;
                            } else {
                                $('#email').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                            }
                        }
                    });
                }
                current_mobile_number = $('#current_mobile_number').val();
                new_mobile_number = $('#mobile').val();
                if (current_mobile_number != new_mobile_number) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {mobile: $.trim($('#mobile').val())},
                        url: '<?php echo base_url(); ?>superadmin/is_mobile_number_available/',
                        success: function (data) {

                            if (data != 0) {
                                $('#mobile').closest('div.form-group').find('.error_msg').text('This Mobile Number is already taken').slideDown('500').css('display', 'inline-block');
                                m++;

                            } else {
                                $('#mobile').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                            }
                        }
                    });
                }
            }
            if (m > 0)
                return false;
        });

    });

    function readImage(file, element) {
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('#imagePreview').attr('default_src');
            $('#imagePreview').attr('src', default_src);
            error = 0;

        } else {
            var reader = new FileReader();
            var image = new Image();
            reader.readAsDataURL(file);
            reader.onload = function (_file) {
                image.src = _file.target.result;
                image.onload = function () {
                    width = this.width;
                    height = this.height;
                    if (width < 150 || height < 150) {
                        $(element).closest('div.form-group').find('.error_msg').text('Image resolution should be higher than 150x150').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        default_src = $('#imagePreview').attr('default_src');
                        $('#imagePreview').attr('src', default_src);
                        error = 0;
                    } else {
                        $('#imagePreview').attr('src', _file.target.result);
                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            }
        }
        return error;

    }

</script>