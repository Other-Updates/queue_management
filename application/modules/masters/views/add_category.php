<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>

<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Add Category</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('masters/subcategory/add', 'name="token" id="token" class="form-horizontal"'); ?>

        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>Category Name:</strong></label><span class="req">*
                                    <select name="category[category_id]" id="category_id" class="form-control input-sm required">
                                        <option value="">Select Category Name</option>
                                        <?php
                                        if (!empty($category)) {
                                            foreach ($category as $type) {
                                                ?>
                                                <option value="<?php echo $type['id']; ?>"><?php echo ucfirst($type['category_type']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="error_msg track_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Sub Category Name:</strong></label><span class="req">*</span>
                                <input type="text" name="category[sub_category]" id="subcategory_name" class="form-control input-sm required" placeholder="Enter User Type Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-stack2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="category[status]" class="form-control input-sm">
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
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('masters/subcategory'); ?>'"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
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
<script type="text/javascript">
    $('#subcategory_name').on('keyup blur', function () {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {

            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');


        } else {

            $('#subcategory_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');

        }
    });

    $('#category_id').on('change', function () {
        var category_id = $('#category_id').is(':selected');
        if (category_id != false) {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#category_id').closest('div.form-group').find('.error_msg').text('').slideUp('500');

        }

    });

    $(document).ready(function () {
        $('#subcategory_name').on('keyup blur', function () {
            if ($.trim($(this).val()) != '') {
                $.ajax({
                    type: 'POST',
                    data: {subcategory_name: $.trim($('#subcategory_name').val()), category_id: $('#category_id').val()},
                    url: '<?php echo base_url(); ?>masters/subcategory/is_sub_category_available/',
                    success: function (data) {

                        if (data == 'yes') {
                            $('#subcategory_name').closest('div.form-group').find('.error_msg').text('Sub-Category name already exists').slideDown('500').css('display', 'inline-block');

                        } else {
                            $('#subcategory_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');

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

                } else {
                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                }

            });
            if (m == 0) {
                $.ajax({
                    type: 'POST',
                    async: false,
                    data: {subcategory_name: $.trim($('#subcategory_name').val()), category_id: $('#category_id').val()},
                    url: '<?php echo base_url(); ?>masters/subcategory/is_sub_category_available/',
                    success: function (data) {
                        if (data == 'yes') {
                            $('#subcategory_name').closest('div.form-group').find('.error_msg').text('Sub-Category name already exists').slideDown('500').css('display', 'inline-block');

                            m++;
                        } else {
                            $('#subcategory_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                        }
                    }
                });
            }
            if (m > 0)
                return false;

        });
    });
</script>