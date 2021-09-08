<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Add New Counter</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('masters/counter/add', 'name="add_counter" id="add_counter" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Counter Name:</strong></label><span class="req">*</span>
                                <input type="text" name="counter[counter_name]" id="counter_name" class="form-control input-sm required" placeholder="Enter Counter Name" maxlength="100">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-stack2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="counter[status]" class="form-control input-sm">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                       
                         <div class="col-md-3">
                            <div class="form-group has-feedback">
                                <label><strong>Enable Success Status ? </strong><span class="req" style="font-size: 12px;">(If you uncheck this, success status not enable for this counter)</span></label><br/>
                                <input type="checkbox" name="counter[success_end_point]" value="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('masters/counter'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /form horizontal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#counter_name').on('keyup blur', function () {
            if ($.trim($(this).val()) == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    data: {counter_name: $.trim($('#counter_name').val())},
                    url: '<?php echo base_url(); ?>masters/counter/is_counter_name_available/',
                    success: function (data) {
                        if (data == 'yes') {
                            $('#counter_name').closest('div.form-group').find('.error_msg').text('This Counter Name Already Exists').slideDown('500').css('display', 'inline-block');
                        } else {
                            $('#counter_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
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
                } else {
                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                }
            });
            if (m == 0) {
                $.ajax({
                    type: 'POST',
                    async: false,
                    data: {counter_name: $.trim($('#counter_name').val())},
                    url: '<?php echo base_url(); ?>masters/counter/is_counter_name_available/',
                    success: function (data) {

                        if (data == 'yes') {
                            $('#counter_name').closest('div.form-group').find('.error_msg').text('This Counter Name Already Exists').slideDown('500').css('display', 'inline-block');
                            m++;
                        } else {
                            $('#counter_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                        }
                    }
                });
            }
            if (m > 0)
                return false;
        });
    });
</script>