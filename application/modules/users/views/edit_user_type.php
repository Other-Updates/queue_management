<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit User Type</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('users/user_types/edit/' . $user_type[0]['id'], 'name="edit_country" id="edit_country" class="form-horizontal"'); ?>
        <input type="hidden" name="country_id" id="country_id" value="<?php echo $user_type[0]['id']; ?>">
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>User Type Name:</strong></label><span class="req">*</span>
                                <input type="text" name="user_type[user_type_name]" id="user_type_name" class="form-control input-sm required" value="<?php echo ucfirst($user_type[0]['user_type_name']); ?>" placeholder="Enter Members Type Name" maxlength="50">
                                <input type="hidden" name="current_user_type_name" id="current_user_type_name" value="<?php echo ucfirst($user_type[0]['user_type_name']); ?>">
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
                                    <option value="1" <?php echo ($user_type[0]['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($user_type[0]['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('users/user_types'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
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
                current_user_type_name = $('#current_user_type_name').val();
                new_user_type_name = $('#user_type_name').val();
                if (new_user_type_name != current_user_type_name) {
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
                current_user_type_name = $('#current_user_type_name').val();
                new_user_type_name = $('#user_type_name').val();
                if (new_user_type_name != current_user_type_name) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {user_type_name: $.trim($('#user_type_name').val()), id: $('#user_type_id').val()},
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
            }
            if (m > 0)
                return false;
        });
    });
</script>