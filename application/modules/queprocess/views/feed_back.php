<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweet.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweetalert.min.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/css/toastr.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/feedback.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/toastr.min.js"></script>

<div class="feedbg">

    <img src="<?php echo base_url() . "themes/queue/service/images/queue_background/fd.jpg" ?>"width="100%" height="100%"/>

</div><br/>

<div class="feedcontent">
    <h1 class="company"></h1>
    <div class="feedbox">
        <div class="col-xs-12 feedhead">FEEDBACK</div>
        <div class="feedtext ">
            <div class="col-xs-12">
                <?php //echo form_open_multipart('queprocess/get_comments/', 'name="feed_back_form" id="feed_back_form" class="form-horizontal"'); ?>
                <br/>
                <div class="row feedbacksize">
                    <div class="col-xs-3">
                        Rating :
                    </div>
                    <div class="col-xs-8 star">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            ?>
                            <span class="star_rating rating<?php echo $i; ?>" name="feed_back[rate_star]"  id="rate_star" value="<?php echo $i; ?>" onclick="ratestar(<?php echo $i; ?>)" >&#x2605;</span>
                            <?php
                        }
                        ?>
                        <input type="hidden" name="feed_back[rate_value]" id="rate_value" value="0">
                    </div>
                </div>
                <div class="row feedbacksize" style="margin-top:10px;">
                    <div class="col-xs-3">
                        Remarks:
                    </div>

                    <div class="col-xs-8 col-md-8">
                        <div class="form-group">
                            <label for="feedback_comments">Write Your Comments</label><span style="color:#F00; font-style:oblique;">*</span>
                            <textarea class="form-control rounded-0 areaheight" name="feed_back[comments]" id="feedback_comments" rows="5" required=""></textarea>
                            <p id="error_msg"></p>
                        </div>
                        
                        <div class="col-md-3 col-xs-4" style="margin-left:-10px;">
                            <button type="submit" id="submit_form" name="submit" class="btn btn-success form-control">Submit</button>
                        </div>

                        <div class="col-md-3 col-xs-4">
                            <a href="<?php echo base_url(); ?>queprocess"><button type="button" class="btn btn-danger form-control">Cancel</button></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
                <?php //echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<style>


</style>
<script>
    $('#submit_form').click(function () {
        m = 0;
        var rate_value = $('#rate_value').val();
        var comments = $('#feedback_comments').val();
        $('#error_msg').empty();
        if (comments == '') {
           
            $("#error_msg").text("please enter your feedback");

            setTimeout(function () {
                $('#error_msg').html('');
            }, 2000);
            m++;
        } else {
            $.ajax({
                type: 'POST',
                data: {ratings: rate_value, comments: comments},
                url: '<?php echo base_url(); ?>queprocess/get_comments/',
                success: function (response) {
                    if (response != '') {
                        swal({
                            position: 'top-end',
                            type: 'success',
                            title: "Thanks!!!",
                            text: "Thanks For your feedback.",
                            timer: 1000,
                        }).then(function () {
                            window.location = '<?php echo base_url(); ?>queprocess';
                        });
                    }

                }
            });
        }

        if (m > 0)
            return false;
    });
    function remove_rating(rateid) {
        for (i = 5; i > rateid; i--) {
            var rateclass = '.rating' + i;
            $('' + rateclass + '').removeClass('checked');
        }
    }

    function add_rating(rateid) {
        for (i = 1; i <= rateid; i++) {
            var rateclass = '.rating' + i;
            $('' + rateclass + '').addClass('checked');

        }
    }

    function ratestar(rateid) {
        var rateclass = '.rating' + rateid;
        if ($('' + rateclass + '').hasClass('checked')) {
            remove_rating(rateid);

        } else {
            add_rating(rateid);
        }
        $('#rate_value').val(rateid);

    }

</script>

