<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>

<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Edit Advertisement</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('masters/advertisement/edit/' . $add[0]['id'], 'name="advertisements_edit" id="advertisements_edit" class="form-horizontal"'); ?>
        <fieldset class="content-group">
            <div class="form-group">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-left">
                                <label><strong>Advertisement Name:</strong></label><span class="req">*</span>
                                <input type="text" name="add_name" id="add_name" class="form-control input-sm required" value="<?php echo $add[0]['name'] ?>"autocomplete="off" placeholder="Enter Advertisement Name" maxlength="50">
                                <span class="error_msg add_name_error"></span>
                                <div class="form-control-feedback">
                                    <i class="icon-stack2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback has-feedback-right">
                                <label><strong>Position:</strong></label><span class="req">*</span>
                                <select name="add_position" class="form-control input-sm required" id="add_position" autocomplete="off">
                                    <option value="">Select Position</option>
                                    <option value="1" <?php echo ($add[0]['position'] == 1 ) ? 'selected' : '' ?>>Left Position</option>
                                    <option value="2"<?php echo ($add[0]['position'] == 2) ? 'selected' : ''; ?>>Bottom Position</option>
                                </select>
                                <span class="error_msg"></span>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label><strong>Type:</strong></label>
                                <select name="add_type" class="form-control input-sm required" id="add_type"  autocomplete="off">
                                    <option value="">Select Type</option>
                                    <option value="1" <?php echo ($add[0]['type'] == 1 ) ? 'selected' : '' ?>>Images</option>
                                    <option value="2"<?php echo ($add[0]['type'] == 2) ? 'selected' : ''; ?>>Videos</option>
                                    <option value="3"<?php echo ($add[0]['type'] == 3) ? 'selected' : ''; ?>>Content</option>
                                </select>
                                <span class="error_msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="overall_total_duration" id="overall_total_duration" value=""/>
            </div>
        </fieldset>
        <table class="table table-striped table-bordered responsive" id="add_data_table">
            <thead id="add_header">
            <td width="2%" class="first_td1">S.No</td>
            <td width="5%" class="first_td1 add_title_datatype" >Images</td>
            <td width="5%" class="first_td1">Duration</td>
            <td width="5%" class="first_td1">Sort Order</td>
            <td width="5%" class="first_td1 add_direction_datatype" style="display:none">Direction</td>
            <td width="5%" class="action-btn-align" style="text-align:center;"><a id='add_data' data-type="<?php echo $add[0]['type']; ?>" class="btn btn-success btn-xs form-control pad10"><span class="glyphicon glyphicon-plus"></span> </a></td>
            </thead>
            <tbody id="add_body">

                <?php
                if (isset($add_details) && !empty($add_details)) {
                    $s = 1;
                    foreach ($add_details as $val) {
                        ?>
                        <tr class="row<?php echo $s; ?>">
                            <td class=" s_no"><?php echo $s; ?></td>
                            <?php if ($add[0]['type'] == 1) { ?>
                                <td>
                                    <input type="hidden" name="add_data_value[]" id="add_data_value" value="<?php echo $add_details[0]['add_data']; ?>" />
                                    <?php
                                    $image_name = !empty($add_details[0]['add_data']) ? pathinfo($add_details[0]['add_data'], PATHINFO_FILENAME) : '';
                                    $image_ext = !empty($add_details[0]['add_data']) ? pathinfo($add_details[0]['add_data'], PATHINFO_EXTENSION) : '';

                                    $exists = file_exists(FCPATH . 'attachments/advertisements/images/' . $image_name . '.' . $image_ext);

                                    if (!empty($add_details[0]['add_data']) && $exists) {
                                        $image_path = base_url() . 'attachments/advertisements/images/' . $image_name . '.' . $image_ext;
                                    } else {
                                        $image_path = base_url() . 'themes/queue/service/images/Addvertisement/no_image.jpg';
                                    }
                                    ?>

                                    <div class="col-md-6 form-group">
                                        <input type="file" name="add_data[]"  class="add_data_contents " value="<?php echo $val['add_img']; ?>" id="add_data<?php echo $s; ?>" onchange="loadImageFileAsURL(<?php echo $s; ?>)"/>
                                        <span class="error_msg file_error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php echo $val['add_img']; ?>"  class="img_src" width="50px" height="50px"/>
                                    </div>

                                </td>
                            <?php } ?>
                            <?php if ($add[0]['type'] == 2) { ?>
                                <td>


                                    <?php
                                    //echo "<pre>";print_r($add_details);
                                    $video_name = !empty($add_details[0]['add_data']) ? pathinfo($add_details[0]['add_data'], PATHINFO_FILENAME) : '';
                                    $video_ext = !empty($add_details[0]['add_data']) ? pathinfo($add_details[0]['add_data'], PATHINFO_EXTENSION) : '';

                                    $exists = file_exists(FCPATH . 'attachments/advertisements/videos/' . $video_name . '.' . $video_ext);

                                    if (!empty($add_details[0]['add_data']) && $exists) {
                                        $video_path = base_url() . 'attachments/advertisements/videos/' . $video_name . '.' . $video_ext;
                                    } else {
                                        $video_path = base_url() . 'themes/queue/service/images/Addvertisement/no_image.jpg';
                                    }
                                    ?>
                                    <div class="col-md-6 form-group">
                                        <input type="file" name="add_data[]" class="add_data_contents required" id="add_data<?php echo $s; ?>" onchange="loadImageFileAsURL(<?php echo $s; ?>)" value="<?php echo $val['add_img']; ?>" />
                                        <span class="error_msg file_error"></span></div>

                                    <div class="col-md-4">
                                       <!-- <video width="100px" height="100px" controls><source  src="<?php echo base_url() ?>'themes/queue/service/images/Addvertisement/Wildlife.wmv" class="img_src" type="video/x-ms-wmv"></video>-->
                                        <video class="vdowh videoload"controls autoplay width="100px" height="100px" id="videoload<?php echo $s; ?>">
                                            <source src="<?php echo $val['add_img']; ?>" type="video/mp4" class="videoshow" id="videoshow<?php echo $s; ?>">

                                        </video>
                                    </div>
                                </td>
                            <?php } ?>
        <?php if ($add[0]['type'] == 3) { ?>
                                <td>
                                    <div class="col-md-6 form-group"><textarea name="add_data[]"  class="required" ><?php echo $val['add_data']; ?></textarea>
                                        <span class="error_msg file_error"></span>
                                    </div>
                                </td>
        <?php } ?>
                            <td><div class="col-md-12 form-group"><input type="text" autocomplete="off" name="add_duration[]" id="" onblur="validate_duration(<?php echo $s; ?>)"class="form-control required add_duration timepicker add_duration<?php echo $s; ?>" value="<?php echo $val['time_duration']; ?>" <?php if ($add[0]['type'] == 2) {
            echo "readonly";
        } ?>/>

                                    <span class="error_msg"></span>
                                </div></td>
                            <td><div class="col-md-12 form-group"><input type="text" autocomplete="off" name="add_sort_order[]" id="" onkeyup="invalid_sort_order(<?php echo $s; ?>)" class="form-control add_sort_order required" value="<?php echo $val['sort_order']; ?>"/> <span class="error_msg sort_order_error"></span></div></td>
        <?php if ($add[0]['type'] == 1 || $add[0]['type'] == 2) { ?>
                                <td><div class="col-md-12 form-group"><select name="add_direction[]" autocomplete="off" class="form-control input-sm required" id="add_position">
                                            <option value=" ">Select Direction</option>
                                            <option value="1" <?php echo($add_details[0]['add_direction'] == 1) ? 'selected' : '' ?>>Vertical Direction</option>
                                            <option value="2" <?php echo($add_details[0]['add_direction'] == 2) ? 'selected' : '' ?>>Horizontal Direction</option>
                                        </select> <span class="error_msg"></span></div>
                                </td>
                        <?php } ?>
                            <td width="5%" class="action-btn-align" style="text-align:center;"><a onclick="remove_data(<?php echo $s; ?>)" class="remove_data btn btn-danger btn-xs form-control pad10"><span class="glyphicon glyphicon-minus"></span> </a></td>
                        </tr>
                        <?php
                        $s++;
                    }
                }
                ?>

            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback has-feedback-left">
                    <label><strong>Total Duration:</strong></label><span class="req">*</span>
                    <input style="width:97%;" type="text" name="add_total_duration" id="add_total_duration" class="form-control input-sm required" value="<?php echo $add[0]['total_duration'] ?>" autocomplete="off" placeholder="Total Duration"  readonly/>
                    <span class="error_msg"></span>
                    <div class="form-control-feedback">
                        <i class="icon-add"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback has-feedback-left">
                    <label><strong>Sort Order By:</strong></label><span class="req">*</span>
                    <input type="text" name="total_sort_order" id="total_sort_order" onkeyup="invalid_total_sort_order()" class="form-control input-sm required" autocomplete="off" value="<?php echo $add[0]['total_sort_order'] ?>"/>
                    <span class="error_msg total_sort_order_error"></span>
                    <div class="form-control-feedback">
                        <i class="icon-sort-amount-asc"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('masters/advertisement'); ?>'"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>


<script type="text/javascript">
                        $(document).ready(function () {
                            var type = $('#add_type').val();
                            if (type == 1 || type == 2) {

                                $('.add_direction_datatype').show();
                            }
                            $('.timepicker').timepicker({
                                timeFormat: "HH:mm:ss"
                            });
                            $('body').addClass('sidebar-xs');
                            $('#add_position').on('change', function () {
                                var position = this.value;
                                var option_text = '';
                                option_text += '<option value="0">Select Type</option>';
                                if (position != '') {
                                    $('#add_type').removeAttr("disabled");
                                    $('#add_type').html('');

                                    if (position == 1) {
                                        option_text += '<option value="1">Images</option>';
                                        option_text += '<option value="2">Videos</option>';
                                    } else {
                                        option_text += '<option value="3">Content</option>';

                                    }
                                    $('#add_type').html(option_text);
                                } else {
                                    $('#add_type').attr("disabled", true);

                                    $('#add_type').html(option_text);
                                }
                                $('#add_body').empty();
                            });

                            $('#add_type').on('change', function () {
                                var type = this.value;

                                if (type != '') {
                                    $('#add_body').empty();
                                    $('#add_data_table').show();

                                    if (type == 1) {
                                        $('#add_header').find('.add_title_datatype').text('Images');
                                        $('#add_data').attr('data-type', 1);
                                    } else if (type == 2) {
                                        $('#add_header').find('.add_title_datatype').text('Video');
                                        $('#add_data').attr('data-type', 2);
                                    } else if (type == 3) {
                                        $('#add_header').find('.add_title_datatype').text('content');
                                        $('#add_data').attr('data-type', 3);
                                    }

                                    if (type == 1 || type == 2) {

                                        $('.add_direction_datatype').show();
                                    } else {
                                        $('.add_direction_datatype').hide();
                                    }
                                }
                            });

                            $('#add_data').on('click', function () {

                                var type = $(this).attr('data-type');

                                BASE_URL = "<?php echo $this->config->item('base_url'); ?>";

                                var content = '';
                                content += '<tr >';
                                content += '<td class="s_no"></td>';
                                if (type == 1) {
                                    content += '<td>' +
                                            '<div class="col-md-6 form-group">' +
                                            '<input type="file" name="add_data[]"  class="add_data_contents required"/>' +
                                            '<span class="error_msg file_error"></span></div> ' +
                                            '<div class="col-md-4">' +
                                            '<img src="' + BASE_URL + 'themes/queue/service/images/Addvertisement/no_image.jpg"  class="img_src" width="50px" height="50px"/>' +
                                            '</div>' +
                                            '</td>';
                                }
                                if (type == 2) {
                                    content += '<td>' +
                                            '<div class="col-md-6 form-group">' +
                                            '<input type="file" name="add_data[]" class="add_data_contents required"/>' +
                                            ' <span class="error_msg file_error"></span></div>' +
                                            '<div class="col-md-4">' +
                                            '<video class="vdowh videoload"controls autoplay width="100px" height="100px" id="" >' +
                                            '<source src="" type="video/mp4" class=" videoshow" id="">' +
                                            '</video>' +
                                            //'<video width="100px" height="100px" controls><source  src="' + BASE_URL + 'themes/queue/service/images/Addvertisement/Wildlife.wmv" class="img_src" type="video/x-ms-wmv"></video>'
                                            '</div>' +
                                            '</td>';
                                }
                                if (type == 3) {
                                    content += '<td>' +
                                            '<div class="col-md-6 form-group">' +
                                            '<textarea name="add_data[]"  class="required"></textarea>' +
                                            '<span class="error_msg file_error"></span></div>' +
                                            '</td>';
                                }
                                content += '<td><div class="col-md-12 form-group"><input type="text" autocomplete="off" name="add_duration[]" id="" class="form-control required add_duration timepicker"/> <span class="error_msg"></span></div></td>';
                                content += '<td><div class="col-md-12 form-group"><input type="text" autocomplete="off" name="add_sort_order[]" id=""  class="form-control add_sort_order required"/> <span class="error_msg sort_order_error"></span></div></td>';
                                if (type == 1 || type == 2) {
                                    content += '<td><div class="col-md-12 form-group"><select name="add_direction[]" autocomplete="off" class="form-control input-sm required" id="add_position">' +
                                            '<option value=" ">Select Direction</option>' +
                                            '<option value="1">Vertical Direction</option>' +
                                            '<option value="2">Horizontal Direction</option>' +
                                            '</select> <span class="error_msg"></span></div></td>';
                                }
                                content += '<td width="5%" class="action-btn-align" style="text-align:center;"><a   onclick="remove_data(0)" class="remove_data btn btn-danger btn-xs form-control pad10"><span class="glyphicon glyphicon-minus"></span> </a></td>';

                                content += '</tr>';

                                $('#add_body').append(content);
                                var i = 1;
                                $('#add_body tr').each(function () {
                                    $(this).closest("tr").addClass('row' + i);
                                    $(this).closest("tr").find('.s_no').html(i);
                                    $(this).closest("tr").find('.remove_data').attr('onclick', 'remove_data(' + i + ')');
                                    $(this).closest("tr").find('.add_sort_order').attr('onkeyup', 'invalid_sort_order(' + i + ')');
                                    $(this).closest("tr").find('.add_duration').attr('onblur', 'validate_duration(' + i + ')');
                                    $(this).closest("tr").find('.add_data_contents').attr('onchange', 'loadImageFileAsURL(' + i + ')');
                                    $(this).closest("tr").find('.add_data_contents').attr('id', 'add_data' + i + '');
                                    $(this).closest("tr").find('.videoload').attr('id', 'videoload' + i + '');
                                    $(this).closest("tr").find('.videoshow').attr('id', 'videoshow' + i + '');
                                    $(this).closest("tr").find('.add_duration').addClass('add_duration' + i + '');

                                    i++;

                                });

                                $('.timepicker').timepicker({
                                    timeFormat: "HH:mm:ss"
                                });

                            });

                            $('.add_sort_order').on('keyup', function () {
                                this_val = $.trim($(this).val());
                                var test_data = /^\d*$/.test(this_val);

                                if ($.trim($(this).val()) == '') {

                                    $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');


                                } else {

                                    $('#subcategory_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');

                                }
                            });


                        });

                        function remove_data(inc_id) {

                            $('.row' + inc_id).remove();
                            var i = 1;
                            $('#add_body tr').each(function () {

                                $(this).closest("tr").find('.s_no').html(i);
                                $(this).closest("tr").addClass('row' + i);
                                $(this).closest("tr").find('.remove_data').attr('onclick', 'remove_data(' + i + ')');
                                $(this).closest("tr").find('.add_sort_order').attr('onkeyup', 'invalid_sort_order(' + i + ')');
                                $(this).closest("tr").find('.add_duration').attr('onblur', 'validate_duration(' + i + ')');
                                $(this).closest("tr").find('.add_data_contents').attr('onchange', 'loadImageFileAsURL(' + i + ')');
                                $(this).closest("tr").find('.add_data_contents').attr('id', 'add_data' + i + '');
                                $(this).closest("tr").find('.videoload').attr('id', 'videoload' + i + '');
                                $(this).closest("tr").find('.videoshow').attr('id', 'videoshow' + i + '');
                                $(this).closest("tr").find('.add_duration').addClass('add_duration' + i + '');
                                i++;

                            });
                        }

                        function invalid_sort_order(inc_id) {

                            var tr_class = ".row" + inc_id;
                            var sort_order = $('' + tr_class + '').find('.add_sort_order').val();
                            var test_sortorder = /^\d*$/.test(sort_order)

                            if (test_sortorder == false) {
                                $('' + tr_class + '').find('.sort_order_error').text('Invalid Sort Order').slideDown('500').css('display', 'inline-block');
                            } else {
                                $('' + tr_class + '').find('.sort_order_error').text('').slideUp('500');
                            }
                        }


                        function invalid_total_sort_order() {

                            var sort_order = $('#total_sort_order').val();
                            var test_sortorder = /^\d*$/.test(sort_order)

                            if (test_sortorder == false) {
                                $('.total_sort_order_error').text('Invalid Sort Order').slideDown('500').css('display', 'inline-block');
                            } else {
                                $('.total_sort_order_error').text('').slideUp('500');
                            }
                        }

                        function validate_duration(inc_id) {

                            var tr_class = ".row" + inc_id;
                            var duration = $('' + tr_class + '').find('.add_duration').val();


                            var total_duration = [];
                            $('.add_duration').each(function () {
                                var add_duration = $(this).closest("tr").find('.add_duration').val();

                                if (add_duration != '')
                                    total_duration.push(add_duration);


                                $.ajax({
                                    type: 'POST',
                                    async: false,
                                    data: {duration: total_duration},
                                    url: '<?php echo base_url(); ?>masters/advertisement/get_multiple_time_sum/',
                                    success: function (data) {

                                        $('#add_total_duration').val(data);
                                        $('#overall_total_duration').val(data);
                                    }
                                });


                            });

                        }
                        function get_time_round(time) {

                            if (time.toString().length == 1)
                                return time = "0" + time;
                            else
                                return time;
                        }
                        function loadImageFileAsURL(inc_id) {

                            var type = $('#add_type').val();

                            var id = "add_data" + inc_id;
                            var tr_class = ".row" + inc_id;
                            var filesSelected = document.getElementById('' + id + '').files;
                            var img = document.getElementById('' + id + '');

                            if (filesSelected.length > 0)
                            {
                                var fileUpload = $('#' + id + '')[0];
                                //Read the contents of Image File.
                                var reader = new FileReader();
                                reader.readAsDataURL(fileUpload.files[0]);
                                reader.onload = function (e) {
                                    //Initiate the JavaScript Image object.
                                    var image = new Image();


                                    //Set the Base64 string return from FileReader as source.
                                    image.src = e.target.result;
                                    if (type == 1) {
                                        image.onload = function () {
                                            //Determine the Height and Width.
                                            var height = this.height;
                                            var width = this.width;

                                            if (type == 2) {


                                            } else {
                                                if (height != 1060 || width != 1300)
                                                {

                                                    $('' + tr_class + '').find('.file_error').text('Width and Height must be in 1300 X 1060 px.').slideDown('500').css('display', 'inline-block');
                                                    $('#' + id + '').val('');
                                                    return false;
                                                } else
                                                {
                                                    $('' + tr_class + '').find('.file_error').text(' ').slideDown('500').css('display', 'inline-block');
                                                    $('' + tr_class + '').find('.img_src').attr('src', e.target.result);
                                                    return true;
                                                }
                                            }



                                        };
                                    } else {

                                        $('' + tr_class + '').find('.img_src').attr('src', e.target.result);
                                        document.getElementById('videoshow' + inc_id + '').src = e.target.result;
                                        document.getElementById('videoload' + inc_id + '').load();



                                        var myVideoPlayer = document.getElementById('videoload' + inc_id + '')
                                        myVideoPlayer.addEventListener('loadedmetadata', function () {
                                            var duration = Math.round(myVideoPlayer.duration);

                                            var duration = moment.duration(duration, "seconds");
                                            var time = "";
                                            var hours = get_time_round(duration.hours());
                                            var minutes = get_time_round(duration.minutes());
                                            var seconds = get_time_round(duration.seconds());

                                            time = hours + ":" + minutes + ":" + seconds;


                                            $('.add_duration' + inc_id + '').val(time);
                                            $('.add_duration' + inc_id + '').attr('readonly', true);

                                        });
                                    }

                                }

                            } else {
                                $('' + tr_class + '').find('.file_error').text('Please Select file').slideDown('500').css('display', 'inline-block');
                            }

                        }


                        $('.submit').click(function () {
                            m = 0;
                            $('.required').each(function () {
                                this_val = $.trim($(this).val());

                                this_id = $(this).attr('id');

                                this_ele = $(this);
                                if (this_val == '') {
                                    console.log(this_id);
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
                                    data: {add_name: $.trim($('#add_name').val())},
                                    url: '<?php echo base_url(); ?>masters/advertisement/is_add_name_exists/',
                                    success: function (data) {
                                        console.log(data);
                                        if (data == 0) {
                                            $('.add_name_error').text('Advertisement name already exists').slideDown('500').css('display', 'inline-block');

                                            m++;
                                        } else {
                                            $('.add_name_error').text('').slideUp('500');

                                        }
                                    }
                                });
                            }

                            if (m > 0)
                                return false;

                        });

</script>