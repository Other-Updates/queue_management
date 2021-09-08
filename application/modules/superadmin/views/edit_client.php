
<style type="text/css">
    #profile {
        height:50px;
        width: 50px;
        border: 1px solid #d8d8d8;
        margin-left: 10px;
        margin-top: 11px;
    }
    #logo{
        height:50px;
        width: 50px;
        border: 1px solid #d8d8d8;
        margin-left: 10px;
        margin-top: 11px;
    }
</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit Client</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <?php echo form_open_multipart('superadmin/client/edit/' . $client[0]['id'], 'name="add_client" id="add_client" method="post" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <legend class="text-bold">Client Information</legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Client ID:</strong></label><span class="req">*</span>
                                <input type="text" name="client[user_id]" id="user_id" class="form-control required" value="<?php echo $client[0]['user_id']; ?>" readonly="readonly" placeholder="Enter User ID">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Username:</strong></label><span class="req">*</span>
                                <input type="text" name="client[username]" id="username" class="form-control required"  value="<?php echo $client[0]['username']; ?>"  placeholder="Enter Username" maxlength="50">
                                <input type="hidden" name="current_username" id="current_username" value="<?php echo $client[0]['username']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Mobile Number:</strong></label><span class="req">*</span>
                                <input type="text" name="client[mobile_number]" id="mobile" class="form-control required" value="<?php echo $client[0]['mobile_number']; ?>" placeholder="Enter Mobile Number" maxlength="10">
                                <input type="hidden" name="current_mobile_number" id="current_mobile_number" value="<?php echo $client[0]['mobile_number']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mobile2"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Company Name:</strong></label>
                                <input type="text" name="client[company_name]" class="form-control" value="<?php echo $client[0]['company_name']; ?>" placeholder="Enter Company Name" maxlength="150">
                                <div class="form-control-feedback">
                                    <i class="icon-address-location3"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="client[status]" class="form-control required">
                                    <option value="1" <?php echo ($client[0]['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($client[0]['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                                <span class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>First Name:</strong></label><span class="req">*</span>
                                <input type="text" name="client[firstname]" id="firstname" class="form-control required" value="<?php echo $client[0]['firstname']; ?>" placeholder="Enter First Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Password:</strong></label><span class="req" style="font-size: 12px;"> (Leave as empty, if you do not change password)</span>
                                <input type="password" name="client[password]" id="password" class="form-control" placeholder="Enter Password">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Email Address:</strong></label><span class="req">*</span>
                                <input type="text" name="client[email_address]" id="email" value="<?php echo $client[0]['email_address']; ?>"class="form-control required" placeholder="Enter Email Address" maxlength="100">
                                <input type="hidden" name="current_email_address" id="current_email_address" value="<?php echo $client[0]['email_address']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Address:</strong></label>
                                <input type="text" name="client[address]" class="form-control" placeholder="Enter Address"  value="<?php echo $client[0]['address']; ?>" maxlength="150">
                                <div class="form-control-feedback">
                                    <i class="icon-address-location3"></i>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Last Name:</strong></label><span class="req">*</span>
                                <input type="text" name="client[lastname]" id="lastname" class="form-control required" value="<?php echo $client[0]['lastname']; ?>" placeholder="Enter Last Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>

                            <!--                            <div class="form-group has-feedback has-feedback-right">
                                                            <label><strong>DOB:</strong></label><span class="req">*</span>
                                                            <input type="text" name="client[dob]" id="dob" class="form-control required datepicker"value="<?php echo ($client[0]['dob'] != '0000-00-00') ? date('d/m/Y', strtotime($client[0]['dob'])) : ''; ?>" placeholder="Select Date of Birth">
                                                            <span class="error_msg"></span>
                                                            <div class="form-control-feedback">
                                                                <i class="icon-calendar3"></i>
                                                            </div>
                                                        </div>-->
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Expire Date:</strong></label><span class="req">*</span>
                                <input type="text" name="client[expire_date]" id="expire_date" value="<?php echo ($client[0]['expire_date'] != '0000-00-00') ? date('d/m/Y', strtotime($client[0]['expire_date'])) : ''; ?>" class="form-control required " placeholder="Select Expire Date">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-calendar3"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <?php
                                $image_name = !empty($client[0]['profile_image']) ? pathinfo($client[0]['profile_image'], PATHINFO_FILENAME) : '';
                                $image_ext = !empty($client[0]['profile_image']) ? pathinfo($client[0]['profile_image'], PATHINFO_EXTENSION) : '';
                                $exists = file_exists(FCPATH . 'attachments/profile_image/' . $image_name . '.' . $image_ext);
                                if (!empty($client[0]['profile_image']) && $exists) {
                                    $image_path = base_url() . 'attachments/profile_image/' . $image_name . '.' . $image_ext;
                                } else {
                                    $image_path = base_url() . 'themes/queue/service/images/default_image.png';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label><strong>Profile Picture:</strong></label> <span class="req">(Min. resolution 150x150)</span>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control" placeholder="Choose Profile Picture">
                                        <div class="form-control-feedback">
                                            <i class="icon-file-picture"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:void(0);"><img src="<?php echo $image_path; ?>" id="profile" class="imagePreview"></a>
                                    </div>
                                </div>
                                <span class="error_msg"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <?php
                                $image_name = !empty($client[0]['company_logo']) ? pathinfo($client[0]['company_logo'], PATHINFO_FILENAME) : '';
                                $image_ext = !empty($client[0]['company_logo']) ? pathinfo($client[0]['company_logo'], PATHINFO_EXTENSION) : '';
                                $exists = file_exists(FCPATH . 'attachments/logo/' . $image_name . '.' . $image_ext);
                                if (!empty($client[0]['company_logo']) && $exists) {
                                    $logo_path = base_url() . 'attachments/logo/' . $image_name . '.' . $image_ext;
                                } else {
                                    $logo_path = base_url() . 'themes/queue/service/images/default_image.png';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label><strong>Company Logo:</strong></label><span class="req">(Min. resolution 275x96)</span>
                                        <input type="file" name="company_logo" id="company_logo" class="form-control" placeholder="Choose Company Logo Picture">
                                        <div class="form-control-feedback">
                                            <i class="icon-file-picture"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:void(0);"><img src="<?php echo $logo_path; ?>" id="logo" class="logoPreview"></a>
                                    </div>
                                </div>
                                <span class="error_msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('superadmin/client'); ?>'" style="float:left;" title="Cancel"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;" title="Submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<!-- /form horizontal -->

<script type="text/javascript">
    $('#expire_date').datepicker({
        minDate: new Date(),
        dateFormat: 'dd/mm/yy'

    });
    $(document).ready(function () {
        $('#profile_image').on('change', function () {
            var files = this.files;
            if (files && files[0]) {
                readImage(files[0], '#profile_image');

            } else {
                default_src = $('.imagePreview').attr('default_src');
                $('.imagePreview').attr('src', default_src);

            }

        });
        $('#company_logo').on('change', function () {
            var files = this.files;
            if (files && files[0]) {
                logoImage(files[0], '#company_logo');

            } else {
                default_src = $('.logoPreview').attr('default_src');
                $('.logoPreview').attr('src', default_src);

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



        $('#password, #retype_password').on('keyup blur', function () {
            password = $.trim($('#password').val());
            retype_password = $.trim($('#retype_password').val());
            this_val = $.trim($(this).val());
            this_length = this_val.length;
            if ($.trim($(this).val()) == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

            } else if (this_length <= 5 || this_length >= 12) {
                $(this).closest('div.form-group').find('.error_msg').text('Password should be between 6-12 characters').slideDown('500').css('display', 'inline-block');
            } else if (password != '' && retype_password != '' && password != retype_password) {
                $(this).closest('div.form-group').find('.error_msg').text('Password and Retype Password should be same').slideDown('500').css('display', 'inline-block');
            } else {
                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

            }

        });
        $('#expire_date').on('change', function () {
            var expire_date = $('#expire_date').val();
            if (expire_date == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
            } else {
                $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

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
                    url: '<?php echo base_url(); ?>superadmin/client/is_user_name_available/',
                    success: function (data) {
                        if (data != 0) {
                            $('#username').closest('div.form-group').find('.error_msg').text('This Username is already taken').slideDown('500').css('display', 'inline-block');
                        } else {
                            $('#username').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                        }

                    }
                });
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
                    url: '<?php echo base_url(); ?>superadmin/client/is_email_address_available/',
                    success: function (data) {
                        if (data != 0) {
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
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
            } else if (!is_valid) {
                $(this).closest('div.form-group').find('.error_msg').text('Enter Valid Mobile Number').slideDown('500').css('display', 'inline-block');

            } else {
                $.ajax({
                    type: 'POST',
                    data: {mobile: $.trim($('#mobile').val())},
                    url: '<?php echo base_url(); ?>superadmin/client/is_mobile_number_available/',
                    success: function (data) {

                        if (data != 0) {

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
            password = $.trim($('#password').val());
            $('.required').each(function () {
                this_val = $.trim($(this).val());
                this_id = $(this).attr('id');
                this_length = this_val.length;
                if (this_val == '') {
                    $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                    m++;
                } else if (this_id == 'password' && password != '' && (this_length <= 5 || this_length >= 12)) {
                    $(this).closest('div.form-group').find('.error_msg').text('Password should be between 6-12 characters').slideDown('500').css('display', 'inline-block');
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
                        data: {username: $.trim($('#username').val()), id: $('#eve_user_id').val()},
                        url: '<?php echo base_url(); ?>superadmin/client/is_user_name_available/',
                        success: function (data) {
                            if (data == 1) {
                                $('#username').closest('div.form-group').find('.error_msg').text('This Username is already taken').slideDown('500').css('display', 'inline-block');
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
                        data: {email: $.trim($('#email').val()), id: $('#eve_user_id').val()},
                        url: '<?php echo base_url(); ?>superadmin/client/is_email_address_available/',
                        success: function (data) {
                            if (data == 1) {
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
                        data: {mobile: $.trim($('#mobile').val()), id: $('#eve_user_id').val()},
                        url: '<?php echo base_url(); ?>superadmin/client/is_mobile_number_available/',
                        success: function (data) {
                            if (data == 1) {
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
            default_src = $('.imagePreview').attr('default_src');
            $('.imagePreview').attr('src', default_src);
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
                        default_src = $('.imagePreview').attr('default_src');
                        $('.imagePreview').attr('src', default_src);
                        error = 0;

                    } else {

                        $('.imagePreview').attr('src', _file.target.result);

                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }
                }
            }
        }

        return error;

    }
    function logoImage(file, element) {
        error = 1;
        file_name = file.name;
        var exts = ['jpg', 'jpeg', 'png'];
        var get_ext = file_name.split('.');
        get_ext = get_ext.reverse();
        if ($.inArray(get_ext[0].toLowerCase(), exts) == -1) {
            $(element).val('');
            $(element).closest('div.form-group').find('.error_msg').text('File format not allowed').slideDown('500').css('display', 'inline-block');
            default_src = $('.logoPreview').attr('default_src');
            $('.logoPreview').attr('src', default_src);
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
                    if (width < 275 || height < 96) {
                        $(element).closest('div.form-group').find('.error_msg').text('Width and Height must be in 275 X 96 px').slideDown('500').css('display', 'inline-block');
                        $(element).val('');
                        default_src = $('.logoPreview').attr('default_src');
                        $('.logoPreview').attr('src', default_src);
                        error = 0;

                    } else {

                        $('.logoPreview').attr('src', _file.target.result);

                        $(element).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                    }
                }
            }
        }

        return error;

    }
    var today = new Date();
    from_year = today.getFullYear() - 40;
    $('#dob').pickadate({
        min: [from_year, 0, 1],
        max: [today.getFullYear(), today.getMonth(), today.getDate()],
        format: 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
        selectYears: true,
        selectMonths: true

    });

</script>