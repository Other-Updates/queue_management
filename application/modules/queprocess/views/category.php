<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/category.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweet.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweetalert.min.js"></script>


<div class="bgimage">
    <div id="slideshow">
        <div style="width:100% !important">
            <img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/background.jpg" ?>" class="img-responsive" width="100%" height="100%"/>
        </div>
        <div>
            <img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/admincounter.jpg" ?>" class="img-responsive" width="100%" height="100%"/>
        </div>
        <div>
            <img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/counterscreen.jpg" ?>" class="img-responsive" width="100%" height="100%"/>
        </div>
    </div>
            <!--<img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/counterscreen.jpg" ?>"width="100%" height="100%"/>-->

</div>
<div class="heading">
    <div class="topheading">
        <h1> QUEUING EAZY</h1>
    </div>
    <div class="col-lg-12">
        <div class="col-md-6">
            <?php
            if (!empty($category)) {
                $count = 0;
                foreach ($category as $key => $list) {
                    $inc = $key + 1;

                    if ($inc <= 5) {
                        if ($inc % 2) {
                            ?>

                            <div class="contentshape shapecenter">
                                <div class="row ">
                                    <?php if ($list['sub_category'] != '') { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/subcategory/<?php echo $list['id']; ?>"</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/token_generate/<?php echo $list['id']; ?>"</a>
                                    <?php } ?>

                                    <div class="col-xs-1">
                                        <div class='shapeone_length_circle<?php echo $inc; ?>'>
                                        </div>

                                    </div>
                                    <div class="col-xs-1" id="cattype">
                                        <div class='shapeone_length<?php echo $inc; ?> shapetext' >                                                                                                                                                                                                                                                                                                                                                                                                            <!--<h3  onclick="delete_members(<?php echo $list['id']; ?>)"><?php echo ucfirst($list['category_type']); ?></h3>-->
                                            <h3><?php echo ucfirst($list['category_type']); ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <div class='shapeone<?php echo $inc; ?>'>
                                            <i class="fa fa-medkit shapefont"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="contentshape shapecenter shaperight">
                                <div class="row ">
                                    <?php if ($list['sub_category'] != '') { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/subcategory/<?php echo $list['id']; ?>"</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/token_generate/<?php echo $list['id']; ?>"</a>
                                    <?php } ?>
                                    <div class="col-xs-1">
                                        <div class='shapeone<?php echo $inc; ?>'>
                                        </div>
                                    </div>
                                    <div class="col-xs-1" id="cattype">
                                        <div class='shapeone_length<?php echo $inc; ?> shapetext'>
                                            <h3><?php echo ucfirst($list['category_type']); ?></h3>
                                        </div>

                                    </div>
                                    <div class="col-xs-1">
                                        <div class='shapeone_length_circle<?php echo $inc; ?>'>
                                            <i class="fa fa-user-md shapefont"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            if (!empty($category)) {
                $count = 0;
                foreach ($category as $key => $list) {
                    $inc_key = $key + 1;
                    $inc = $inc_key - 5;
                    if ($inc_key > 5 && $inc_key <= 10) {
                        if ($key % 2) {
                            ?>

                            <div class="contentshape shapecenter">
                                <div class="row ">
                                    <?php if ($list['sub_category'] != '') { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/subcategory/<?php echo $list['id']; ?>"</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/token_generate/<?php echo $list['id']; ?>"</a>
                                    <?php } ?>

                                    <div class="col-xs-1">
                                        <div class='shapeone_length_circle<?php echo $inc; ?>'>
                                        </div>

                                    </div>
                                    <div class="col-xs-1" id="cattype">
                                        <div class='shapeone_length<?php echo $inc; ?> shapetext' >                                                                                                                                                                                                                                                                                                                                                                                                            <!--<h3  onclick="delete_members(<?php echo $list['id']; ?>)"><?php echo ucfirst($list['category_type']); ?></h3>-->
                                            <h3><?php echo ucfirst($list['category_type']); ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <div class='shapeone<?php echo $inc; ?>'>
                                            <i class="fa fa-medkit shapefont"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="contentshape shapecenter shaperight">
                                <div class="row ">
                                    <?php if ($list['sub_category'] != '') { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/subcategory/<?php echo $list['id']; ?>"</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>queprocess/token_generate/<?php echo $list['id']; ?>"</a>
                                    <?php } ?>
                                    <div class="col-xs-1">
                                        <div class='shapeone<?php echo $inc; ?>'>
                                        </div>
                                    </div>
                                    <div class="col-xs-1" id="cattype">
                                        <div class='shapeone_length<?php echo $inc; ?> shapetext'>
                                            <h3><?php echo ucfirst($list['category_type']); ?></h3>
                                        </div>

                                    </div>
                                    <div class="col-xs-1">
                                        <div class='shapeone_length_circle<?php echo $inc; ?>'>
                                            <i class="fa fa-user-md shapefont"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>

</div>
<span class="hold_token_msg" style="color:red;font-size:20px;"></span>
<div class="fotter">
    <div class="bottom">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xs-4 adjust">
                    <a style="color: white;"> <h4 class="fottext">WHAT WE CAN CHOOSE TO DO?</h4></a>
                </div>
                <div class="col-xs-1 adjust1">
                    <a> <button type="button" class="btn btn-rounded btn-warning btn-md bnradius "  data-toggle="modal" data-target="#myModal" value="Hold">Hold</button></a>
                </div>
                <div class="col-xs-1 adjust1">
                    <a><button type="button" class="btn btn-rounded btn-danger btn-md bnradius" data-toggle="modal" data-target="#myModalmissed" value="Missed">Missed</button></a>
                </div>
                <div class="col-xs-1 adjust1">
                    <a href="<?php echo base_url(); ?>queprocess/get_feedback/"> <button id="feed_back" type="button" class="btn btn-rounded btn-info btn-md bnradius" value="Feed Back">Feedback</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal" id="myModal" style="margin-top: 130px;" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Please Enter your Token Number</h4>
                <button type="button" class="close" style="margin-top: -23px" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control input-sm tokennum"  id="hold_token"  />
                    </div>
                </div>
            </div>
            <span style="color:red; margin-left: 10px;" id="search_modal_error"></span>
            <div class="modal-footer">
                <button type="button" class="btn btn-success go" >Go</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModalmissed" style="margin-top: 130px;" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Please Enter your Token Number</h4>
                <button type="button" class="close" style="margin-top: -23px" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control input-sm missednum"  id="hold_token"  />
                    </div>
                </div>
            </div>
            <span style="color:red;margin-left: 10px;" id="missed_modal_error"></span>
            <div class="modal-footer">
                <button type="button" class="btn btn-success sub" >Go</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="feed_back_result"></div>
<link href="<?php echo $theme_path; ?>/css/toastr.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/toastr.min.js"></script>
<script>
    $('#myModal,#myModalmissed').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
    });

    $(".go").click(function (e) {
        e.preventDefault();
        var tokennum = $("input.tokennum").val();

        $('#search_modal_error').empty();
        if (tokennum == "")
        {
            $('#search_modal_error').append('This field is required');
            setTimeout(function () {
                $('#search_modal_error').html('');
            }, 3000);
            return false;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>counter/counter/reassign_token/" + tokennum,
            type: "POST",
            data: {tokennum: tokennum, status: "Hold"},
            success: function (data) {
                if (data != 0) {
                    $("#myModal").modal("toggle");
//                    swal({
//                        position: 'top-end',
//                        type: 'success',
//                        title: 'Your Token Reassigned Successfully!',
//                        timer: 1000
//                    });
                    swal("Success", 'Your Token Reassigned Successfully!', "success");
                } else if (data == 0) {
                    $('#search_modal_error').append('Please enter the correct token number');
                    setTimeout(function () {
                        $('#search_modal_error').html('');
                    }, 3000);
                }
            }
        });
    });

    $(".sub").click(function (e) {

        e.preventDefault();

        var tokennum = $("input.missednum").val();
        $('#missed_modal_error').empty();
        if (tokennum == "")
        {
            $("#missed_modal_error").append('This field is required');
            setTimeout(function () {
                $('#missed_modal_error').html('');
            }, 3000);

            return false;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>counter/counter/reassign_token/" + tokennum,
            type: "POST",
            data: {tokennum: tokennum, status: "Missed"},
            success: function (data) {
                if (data != 0) {
                    $("#myModalmissed").modal("toggle");
                    swal("Success", 'Your Token Reassigned Successfully!', "success");

                } else if (data == 0) {
                    //swal("Your token number not exists!", 'Please enter the correct token number', "warning");
                    $('#missed_modal_error').append('Please enter the correct token number');
                    setTimeout(function () {
                        $('#missed_modal_error').html('');
                    }, 3000);
                }
            }
        });
    });

    $("#slideshow > div:gt(0)").hide();
    setInterval(function () {
        $('#slideshow > div:first')
                .fadeOut(1500)
                .next()
                .fadeIn(1500)
                .end()
                .appendTo('#slideshow');

    }, 3000);
</script>

