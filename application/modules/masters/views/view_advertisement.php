<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">View Advertisement</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <fieldset class="content-group">
            <div class="form-group">
                <table class="table table-borderless" style="margin-bottom:15px;">
                    <tbody>
                        <tr>
                            <td width="10%"><b>Advertisement Name:</b></td>
                            <td width="10%"><?php echo ucfirst($add[0]['name']) ?></td>
                            <td width="10%"><b>Position:</b></td>
                            <?php if ($add[0]['position'] == 1) { ?>
                                <td width="10%">Left Position</td><?php } else { ?>
                                <td width="10%">Bottom Position</td>
                            <?php } ?>
                        
                            <td width="10%"><b>Type:</b></td>
                            <?php if ($add[0]['type'] == 1) { ?>
                                <td width="10%">Images</td><?php } else if ($add[0]['type'] == 3) { ?>
                                <td width="10%">Content</td>
                            <?php } else if ($add[0]['type'] == 2) { ?>
                                <td width="10%">Videos</td>
                            <?php } ?>
                            <td width="10%"><b>Total Duration:</b></td>
                            <td width="10%"><?php echo $add[0]['total_duration'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <table class="table table-striped table-bordered responsive" id="add_data_table">
            <thead id="add_header">
            <td width="2%" class="first_td1">S.No</td>
            <?php if ($add[0]['type'] == 1) { ?>
                <td width="5%" class="first_td1 " >Images</td>
            <?php } else { ?>
                <td width="25%" class="first_td1" >Content</td>
            <?php } ?>
            <td width="25%" class="first_td1">Duration</td>
            <td width="25%" class="first_td1">Sort Order</td>
            <?php if ($add[0]['type'] == 1) { ?>
                <td width="25%" class="first_td1 add_direction_datatype">Direction</td>
            <?php } ?>
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

                                        <div class="col-md-4">
                                            <img src="<?php echo $image_path ?>"  class="img_src" width="50px" height="50px"/>
                                        </div>

                                </td>
                            <?php } ?>
                            <?php if ($add[0]['type'] == 2) { ?>
                                <td>
                                    <div class="col-md-6 form-group">
                                        <input type="file" name="add_data[]" class="add_data_contents required" id="add_data" onchange="loadImageFileAsURL(<?php echo $s; ?>)"/>
                                        <span class="error_msg file_error"></span></div>
                                    <div class="col-md-4">
                                        <video width="100px" height="100px" controls><source  src="<?php echo base_url() ?>'themes/queue/service/images/Addvertisement/Wildlife.wmv" class="img_src" type="video/x-ms-wmv"></video>
                                    </div>
                                </td>
                            <?php } ?>
                            <?php if ($add[0]['type'] == 3) { ?>
                                <td>
                                    <?php echo $val['add_data']; ?>
                                </td>
                            <?php } ?>
                            <td><?php echo $val['time_duration']; ?></td>
                            <td><?php echo $val['sort_order']; ?></td>
                            <?php if ($add[0]['type'] == 1 && $add_details[0]['add_direction'] == 1) { ?>
                                <td>Vertical Direction</td>
                            <?php } elseif ($add[0]['type'] == 1 && $add_details[0]['add_direction'] == 2) { ?>
                                <td>Horizontal Direction</td>
                            <?php } ?>

                        </tr>
                        <?php
                        $s++;
                    }
                }
                ?>

            </tbody>
        </table>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
                <div class="text-left">
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?php echo base_url('masters/advertisement'); ?>'"><i class="icon-arrow-left13 position-left"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>