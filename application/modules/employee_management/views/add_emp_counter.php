
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Assign Employee Counter</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('employee_management/emp_counter/add', 'name="add_counter" id="add_counter" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Employee Name:</strong></label><span class="req">*</span>
                                <select name="emp_counter[emp_id]" id="emp_id" class="form-control input-sm required">
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
                                <span class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Counter Name:</strong></label><span class="req">*</span>
                                <select name="emp_counter[counter_id]" id="counter_id" class="form-control input-sm required">
                                    <option value="">Select Counter Name</option>
                                    <option value="idle">Idle</option>
                                    <option value="hold">Hold</option>
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
                                <span class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="emp_counter[status]" class="form-control input-sm">
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
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('employee_management/emp_counter'); ?>'" style="float:left;"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                <button type="submit" class="btn btn-success submit" style="float:right;">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /form horizontal -->
<script type="text/javascript">
    $('#emp_id').on('change', function () {
        var emp_id = $('#emp_id').is(':selected');
        if (emp_id != false) {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#emp_id').closest('div.form-group').find('.error_msg').text('').slideUp('500');
        }

    });
    $('#counter_id').on('change', function () {
        var counter_id = $('#counter_id').is(':selected');
        if (counter_id != false) {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#counter_id').closest('div.form-group').find('.error_msg').text('').slideUp('500');
        }

    });
    $(document).ready(function () {
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

            if (m > 0)
                return false;
        });
    });
</script>