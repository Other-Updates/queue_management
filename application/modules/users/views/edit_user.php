<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<style>

    #profile {

        height:50px;

        width: 50px;

        border: 1px solid black;

        margin-left: 10px;

        margin-top: 16px;

        transition: transform .2s;

    }
    #profile:hover {
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Safari 3-8 */
        transform: scale(1.5);
        height:75px;

        width:75px;
    }


</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit User</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('users/edit/' . $user[0]['id'], 'name="edit_user" id="edit_user" class="form-horizontal"'); ?>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user[0]['id']; ?>">
        <fieldset class="content-group">
            <legend class="text-bold">User Information</legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>User ID:</strong></label><span class="req">*</span>
                                <input type="text" name="user[user_id]" id="user_id" class="form-control input-sm required" value="<?php echo $user[0]['user_id']; ?>" readonly="readonly" placeholder="Enter User ID" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Username:</strong></label><span class="req">*</span>
                                <input type="text" name="user[username]" id="username" class="form-control input-sm required" value="<?php echo $user[0]['username']; ?>" placeholder="Enter Username" maxlength="50">
                                <input type="hidden" name="current_username" id="current_username" value="<?php echo $user[0]['username']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>DOB:</strong></label>
                                <input type="text" name="user[dob]" id="dob" class="form-control input-sm datepicker" value="<?php echo (!empty($user[0]['dob'])) ? date('d/m/Y', strtotime($user[0]['dob'])) : ''; ?>" placeholder="Select Date of Birth">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-calendar3"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">

                                <?php
                                $image_name = !empty($user[0]['profile_image']) ? pathinfo($user[0]['profile_image'], PATHINFO_FILENAME) : '';

                                $image_ext = !empty($user[0]['profile_image']) ? pathinfo($user[0]['profile_image'], PATHINFO_EXTENSION) : '';

                                $exists = file_exists(FCPATH . 'attachments/profile_image/' . $image_name . $image_ext);

                                if (!empty($user[0]['profile_image']))
                                    $image_path = base_url() . 'attachments/profile_image/' . $image_name . '.' . $image_ext;
                                ?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <label><strong>Profile Picture:</strong></label> <span class="req">(Min. resolution 150x150)</span>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control input-sm" placeholder="Choose Profile Picture">
                                        <div class="form-control-feedback">
                                            <i class="icon-file-picture"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <a href="javascript:void(0);"><img id="profile" class="imagePreview" src="<?php echo $image_path; ?>"></a>

                                        <!--<a href="javascript:void(0);"><img id="imagePreview"  style="width: 58px; height: 58px; border: 2px #ccc solid;" alt="User profile picture" default_src="<?php echo base_url(); ?>attachments/profile_image/default_profile_image.png"></a>-->

                                    </div>
                                </div>
                                <span class="error_msg"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>First Name:</strong></label><span class="req">*</span>
                                <input type="text" name="user[firstname]" class="form-control input-sm required" value="<?php echo $user[0]['firstname']; ?>" placeholder="Enter First Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Password:</strong></label><span class="req" style="font-size: 12px;"> (Leave as empty, if you do not change password)</span>
                                <input type="password" name="user[password]" id="password" class="form-control input-sm" placeholder="Enter Password">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Mobile Number:</strong></label><span class="req">*</span>
                                <input type="text" name="user[mobile_number]" id="mobile" class="form-control input-sm required" value="<?php echo $user[0]['mobile_number']; ?>" placeholder="Enter Mobile Number" maxlength="10">
                                <input type="hidden" name="current_mobile_number" id="current_mobile_number" value="<?php echo $user[0]['mobile_number']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mobile2"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Address:</strong></label>
                                <input type="text" name="user[address]" class="form-control input-sm" value="<?php echo $user[0]['address']; ?>" placeholder="Enter Address" maxlength="150">
                                <div class="form-control-feedback">
                                    <i class="icon-location3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Last Name:</strong></label><span class="req">*</span>
                                <input type="text" name="user[lastname]" class="form-control input-sm required" value="<?php echo $user[0]['lastname']; ?>" placeholder="Enter Last Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Retype Password:</strong></label>
                                <input type="password" name="retype_password" id="retype_password" class="form-control input-sm" placeholder="Retype Password">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Email Address:</strong></label><span class="req">*</span>
                                <input type="text" name="user[email_address]" id="email" class="form-control input-sm required" value="<?php echo $user[0]['email_address']; ?>" placeholder="Enter Email Address" maxlength="100">
                                <input type="hidden" name="current_email_address" id="current_email_address" value="<?php echo $user[0]['email_address']; ?>">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label><span class="req">*</span>
                                <select name="user[status]" class="form-control input-sm">
                                    <option value="1" <?php echo ($user[0]['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($user[0]['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                                <span class="error_msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <legend class="text-bold">User Role Information</legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>User Type:</strong></label><span class="req">*</span>
                                <select name="user[user_type_id]" id="user_type" class="form-control input-sm required">
                                    <option value="">Select User Type</option>
                                    <?php
                                    if (!empty($user_types)) {
                                        foreach ($user_types as $type) {
                                            ?>
                                            <option value="<?php echo $type['id']; ?>" <?php echo ($type['id'] == $user[0]['user_type_id']) ? 'selected' : ''; ?>><?php echo ucfirst($type['user_type_name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
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
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('users'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /form horizontal -->
<script type="text/javascript">
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

        $('#user_type').on('change', function () {
            user_type = $('#user_type').val();
            if ($.trim($(this).val()) != '' && user_type == 1) {
                $('#shop,#level').attr('disabled', 'disabled');
                $('#shop,#level').removeClass('required');
                $('#shop,#level').val('');
                $('shop_section, #technician_section').hide();
            } else if ($.trim($(this).val()) != '' && user_type == 6) {
                $('#shop_section, #technician_section').show();
                $('#shop,#level').removeAttr('disabled');
                $('#shop,#level').addClass('required');
                $('#shop,#level').val('');
            } else {
                $('#shop_section').show();
                $('#shop').removeAttr('disabled');
                $('#shop').addClass('required');
                $('#shop').val('');
                $('#level').val('');
                $('#level').attr('disabled', 'disabled');
                $('#level').removeClass('required');
                $('#technician_section').hide();
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
                    url: '<?php echo base_url(); ?>users/is_user_name_available/',
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
                    url: '<?php echo base_url(); ?>users/is_email_address_available/',
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
                    url: '<?php echo base_url(); ?>users/is_mobile_number_available/',
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
                current_username = $('#current_username').val();
                new_username = $('#username').val();
                if (current_username != new_username) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {username: $.trim($('#username').val()), id: $('#user_id').val()},
                        url: '<?php echo base_url(); ?>users/is_user_name_available/',
                        success: function (data) {
                            if (data == 'yes') {
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
                        data: {email: $.trim($('#email').val()), id: $('#user_id').val()},
                        url: '<?php echo base_url(); ?>users/is_email_address_available/',
                        success: function (data) {
                            if (data == 'yes') {
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
                        data: {mobile: $.trim($('#mobile').val()), id: $('#user_id').val()},
                        url: '<?php echo base_url(); ?>users/is_mobile_number_available/',
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
            }
            if (m > 0)
                return false;
        });

        $('#country_id').on('change', function () {
            country_id = $(this).val();
            if (country_id != '') {
                $.ajax({
                    type: 'POST',
                    data: {country_id: country_id},
                    url: '<?php echo base_url(); ?>masters/states/get_states_by_country_id/' + country_id,
                    success: function (data) {
                        result = JSON.parse(data);
                        if (result != null && result.length > 0) {
                            option_text = '<option value="">Select State</option>';
                            $.each(result, function (key, value) {
                                option_text += '<option value="' + value.id + '">' + value.state_name + '</option>';
                            });
                            $('#state_id').html(option_text);
                            $('#state_id').removeAttr('disabled');
                            $('#state_id').addClass('required');
                        } else {
                            $('#state_id, #city_id').html('');
                            $('#state_id, #city_id').attr('disabled', 'disabled');
                            $('#state_id, #city_id').removeClass('required');
                        }
                    }
                });
            } else {
                $('#state_id, #city_id').html('');
                $('#state_id, #city_id').attr('disabled', 'disabled');
                $('#state_id, #city_id').removeClass('required');
            }
        });

        $('#state_id').on('change', function () {
            state_id = $(this).val();
            if (state_id != '') {
                $.ajax({
                    type: 'POST',
                    data: {state_id: state_id},
                    url: '<?php echo base_url(); ?>masters/cities/get_cities_by_state_id/' + state_id,
                    success: function (data) {
                        result = JSON.parse(data);
                        if (result != null && result.length > 0) {
                            option_text = '<option value="">Select City</option>';
                            $.each(result, function (key, value) {
                                option_text += '<option value="' + value.id + '">' + value.city_name + '</option>';
                            });
                            $('#city_id').html(option_text);
                            $('#city_id').removeAttr('disabled');
                            $('#city_id').addClass('required');
                        } else {
                            $('#city_id').html('');
                            $('#city_id').attr('disabled', 'disabled');
                            $('#city_id').removeClass('required');
                        }
                    }
                });
            } else {
                $('#city_id').html('');
                $('#city_id').attr('disabled', 'disabled');
                $('#city_id').removeClass('required');
            }
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
                        s
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

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && ((charCode != 46 && charCode != 45 && charCode != 43 && charCode < 48) || charCode > 57)) {
            return false;
        } else {
            return true;
        }
    }
</script>
