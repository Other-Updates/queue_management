<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Add User Type</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('users/user_types/add', 'name="add_user_type" id="add_user_type" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>User Type Name:</strong></label><span class="req">*</span>
                                <input type="text" name="user_type[user_type_name]" id="user_type_name" class="form-control input-sm required" placeholder="Enter User Type Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="user_type[status]" class="form-control input-sm">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('users/user_types'); ?>'"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <button type="submit" name="submit" class="btn btn-primary submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /form horizontal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#user_type_name').on('keyup blur', function () {
            if ($.trim($(this).val()) != '') {
                $.ajax({
                    type: 'POST',
                    data: {user_type_name: $.trim($('#user_type_name').val())},
                    url: '<?php echo base_url(); ?>users/user_types/is_user_type_available/',
                    success: function (data) {
                        if (data == 1) {
                            $('#user_type_name').closest('div.form-group').find('.error_msg').text('This User Type Name is already available').slideDown('500').css('display', 'inline-block');
                        } else {
                            $('#user_type_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
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
                this_ele = $(this);
                if (this_val == '') {
                    $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                    m++;
                } else if (this_ele.hasClass('number')) {
                    numberRegexStr = /^\d+$/;
                    is_number_valid = numberRegexStr.test(this_val);
                    if (!is_number_valid) {
                        $(this).closest('div.form-group').find('.error_msg').text('Enter valid Input').slideDown('500').css('display', 'inline-block');
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
                    data: {user_type_name: $.trim($('#user_type_name').val())},
                    url: '<?php echo base_url(); ?>users/user_types/is_user_type_available/',
                    success: function (data) {
                        if (data == 1) {
                            $('#user_type_name').closest('div.form-group').find('.error_msg').text('This User Type Name is already available').slideDown('500').css('display', 'inline-block');
                            m++;
                        } else {
                            $('#user_type_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                        }
                    }
                });
            }
            if (m > 0)
                return false;
        });
    });
</script>