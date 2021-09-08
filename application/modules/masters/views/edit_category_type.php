<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<style>
    .btn-group {
        position: relative;
        display: flex;
        vertical-align: middle;
    }
    .open > .dropdown-menu {
        display: block;
        width: 100%;
    }
    .multiselect-container > li > a > label {
        margin: 0;
        height: 100%;
        cursor: pointer;
        padding: 8px 12px;
        padding-left: 40px;
        margin-left: 19px;
    }
    .multiselect-container > li > a > label input[type="checkbox"] {
        width:18px;
        height:18px;
    }
    .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
        color: #fff;
        text-decoration: none;
        outline: 0;
        background-color: #0b6d9a;
    }
    .multiselect.btn-default, .multiselect.btn-default.disabled {
        background-color: #fff;
        border-color: #b8c4d0;
        border-radius: 8px;
    }
</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit Category Type</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('masters/category_type/edit/' . $category[0]['id'], 'name="edit_category_type" id="edit_category_type" class="form-horizontal"'); ?>
        <input type="hidden" name="id" id="category_type_id" value="<?php echo $category[0]['id']; ?>" />
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Category Name:</strong></label><span class="req">*</span>
                                <input type="text" name="category[category_type]" id="category_type" class="form-control input-sm required" value="<?php echo ucfirst($category[0]['category_type']); ?>" placeholder="Enter Category Type Name" maxlength="50" >
                                <input type="hidden" name="current_category_type" id="current_category_type"  value="<?php echo ucfirst($category[0]['category_type']); ?>" >
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-stack2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Prefix</strong></label><span class="req">*</span>
                                <input type="text" name="category[prefix]" id="prefix" class="form-control input-sm required" value="<?php echo $category[0]['prefix']; ?>" placeholder="Enter Prefix Name" maxlength="50">
                                <span class="error_msg"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-pencil7"></i>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="counter_id" id="multiple_counter_id" value=""/>
                        <div class="col-md-3">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Counter Name:</strong></label><span class="req">*
                                    <div class="">
                                        <select name="category[counter_id]" id="counter_id" class="form-control  required" style="width:100%;">
                                            <?php
                                            if (!empty($counter)) {
                                                foreach ($counter as $type) {
                                                    $counter_id = [];
                                                    if ($category[0]['counter_id'] != "") {
                                                        $counter_id = explode(',', $category[0]['counter_id']);
                                                    }
                                                    ?>
                                                    <option value="<?php echo $type['id']; ?>"  <?php echo (in_array($type['id'], $counter_id)) ? 'selected' : ''; ?>><?php echo ucfirst($type['counter_name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <span class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback">
                                <label><strong>Status:</strong></label>
                                <select name="category[status]" class="form-control input-sm">
                                    <option value="1" <?php echo ($category[0]['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($category[0]['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
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
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('masters/category_type'); ?>'"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
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
    $('#category_type').on('keyup blur', function () {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
        } else {
            $('#category_type').closest('div.form-group').find('.error_msg').text('').slideUp('500');
        }

    });
    $('#prefix').on('keyup blur', function () {
        this_val = $.trim($(this).val());
        if ($.trim($(this).val()) == '') {
            $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');

        } else {
            $('#prefix').closest('div.form-group').find('.error_msg').text('').slideUp('500');
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
        $('.multi_select').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            nonSelectedText: 'Select Counter Name',
            enableCaseInsensitiveFiltering: true,
            templates: {
                filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text"></li>'
            },
            onSelectAll: function () {
                $.uniform.update();
            }
        });
        $('#category_type').on('keyup blur', function () {
            if ($.trim($(this).val()) != '') {
                current_category_type = $('#current_category_type').val();
                new_category_type = $('#category_type').val();
                if (current_category_type != new_category_type) {
                    $.ajax({
                        type: 'POST',
                        data: {category_type: $.trim($('#category_type').val()), id: $('#category_type_id').val()},
                        url: '<?php echo base_url(); ?>masters/category_type/is_category_type_available/',
                        success: function (data) {
                            if (data == 'yes') {
                                $('#category_type').closest('div.form-group').find('.error_msg').text('Category name already exists').slideDown('500').css('display', 'inline-block');
                            } else {
                                $('#category_type').closest('div.form-group').find('.error_msg').text('').slideUp('500');

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

                } else {
                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');

                }

            });

            if (m == 0) {
                current_category_type = $('#current_category_type').val();
                new_category_type = $('#category_type').val();
                if (current_category_type != new_category_type) {
                    $.ajax({
                        type: 'POST',
                        async: false,
                        data: {category_type: $.trim($('#category_type').val()), id: $('#category_type_id').val()},
                        url: '<?php echo base_url(); ?>masters/category_type/is_category_type_available/',
                        success: function (data) {
                            if (data == 'yes') {
                                $('#category_type').closest('div.form-group').find('.error_msg').text('Category name already exists').slideDown('500').css('display', 'inline-block');
                                m++;

                            } else {

                                $('#category_type').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                            }
                        }
                    });
                }

            }
            if (m > 0)
                return false;
            else
                $('#multiple_counter_id').val($('#counter_id').val());

        });

    });

</script>