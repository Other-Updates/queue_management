<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweet.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
<link href="<?php echo $theme_path; ?>/service/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/subcategory.css" rel="stylesheet" type="text/css">

<div class="bgimage printPageButton">
    <img src="<?php echo base_url() . "/themes/queue/service/images/queue_background/admincounter.jpg" ?>"width="100%" height="100%"/>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-xs-9">
            <div class="heading">
                <div class="topheading printPageButton">
                    <h1> QUEUING MANAGEMENT SYSTEM - <span id="categoryname"><?php echo strtoupper($subcategory[0]['main_category_name']); ?></span></h1>
                </div>
                <div id="token">
                    <div class="contentshape shapecenter ">
                        <?php
                        //echo "<pre>";print_r($subcategory);
                        if (!empty($subcategory)) {
                            $count = 0;
                            foreach ($subcategory as $key => $list) {
                                $list['class'] = $key + 1;
                                if ($list['class'] % 2) {
                                    ?>
                                    <div class = "row " onclick="create_token(<?php echo $list['category_id']; ?>)">
                                        <div class = "col-xs-1">
                                            <div class = 'shapeone_length_circle<?php echo $list['class']; ?>'>
                                            </div>
                                        </div>
                                        <div class = "col-xs-1">
                                            <div class = "shapeone_length<?php echo $list['class']; ?> shapetext">
                                                <h3><?php echo ucfirst($list['sub_category']);
                                    ?></h3>

                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <div class="shapeone<?php echo $list['class']; ?>">
                                                <i class="fa fa-home fa-lg shapefont"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row "  onclick="create_token(<?php echo $list['category_id']; ?>)">
                                        <div class="col-xs-1">
                                            <div class="shapetwo_length_triangleright">

                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <div class="shapetwo_lengthsub_circle<?php echo $list['class']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <div class="shapetwo_lengthsub<?php echo $list['class']; ?> shapetext">
                                                <h3><?php echo ucfirst($list['sub_category']); ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-xs-1">
                                            <div class="shapetwosub<?php echo $list['class']; ?>">
                                                <i class="fa fa-home fa-lg shapefont"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <input type="hidden" value="<?php echo $counter_id ?>" name="hidden_cid" class="hidden_cid">
                    </div>
                </div>
            </div>
            <span class="hold_token " style="color:red;font-size:25px;"></span>
            <div style="display:none"class="threed printPageButton" id="print_token" >
                <a href="javascript:" ><blink><span class="glyphicon glyphicon-print" ></span>Click me!</blink></a>
            </div>
            <div style="display:none" class="cancelbtn printPageButton">
                <button class="btn btn-lg btn-info form-controller infobtn" onclick="back_to_queprocess()">Cancel</button>
            </div>
        </div>
        <div class="col-xs-3 printPageButton" style="padding-left:0px !important; padding-right:0px; height:100%; ">
            <div id="slideshow">
                <div class="addimage" style="width:100%; height:100%;">
                    <img src="<?php echo base_url() . "/themes/queue/service/images/Addvertisement/add11.jpg" ?>"width="100%"   style="margin-left:0px; bottom:0px;"/>
                </div>
                <div class="addimage" style="width:100%; height:100%;">
                    <img src="<?php echo base_url() . "/themes/queue/service/images/Addvertisement/add12.gif" ?>"width="100%"  style="margin-left:0px; bottom:0px;"/>
                </div>
                <div class="addimage" style="width:100%; height:100%;">
                    <img src="<?php echo base_url() . "/themes/queue/service/images/Addvertisement/add13.jpg" ?>" width="100%"  style="margin-left:0px;"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function back_to_queprocess() {
        var base_url = "<?php echo base_url('/'); ?>";
        window.location.href = base_url + 'queprocess';
    }
    $('#myModal').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select").val('').end();
    });
    function create_token(cat_id) {
        var counter_id = $('input[name=hidden_cid]').val();
        if (counter_id == 0) {
            $(".threed").hide();
            $(".cancelbtn").show();
            $('#categoryname').empty();
            $('#categoryname').append("GENERATE TOKEN");
            $('#token').empty();
            swal("Counter not assigned!Please wait", '', "warning");
        } else {

            $(".threed").show();
            $(".cancelbtn").show();
            $('#categoryname').empty();
            $('#categoryname').append("GENERATE TOKEN");
            $('#token').empty();
            $('#print_token').click(function () {
                var id = cat_id;
                var d = new Date();
                var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
                var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>queprocess/token/" + id,
                    cache: false,
                    success: function (data) {

                        var result = $.parseJSON(data);

                        $('#token').empty();

                        var data = '<div class = "contentshape shapecenter token-color tokenprint">' +
                                '<div class = "row tokenbg">' +
                                '<div class = "col-md-1" id = "cattype">' +
                                '<button class = "btn bg-pinks-400 btn-block hvr-ripple-out " type = "button">' +
                                '<i ></i>' + '<p style="font-size:17px;text-align:center; font-weight:bold; font-size:15px;">' + result.company_name + '</p>' + '' + '<p style="float:;font-size:17px;">' + date + '&nbsp &nbsp &nbsp' + time + '</p>' + '' + '<p style="font-size:17px;text-align:center;">' + ' Your Token Number' + '</p>' + '<h1 style="font-size:35px; font-weight:bold;margin-top:-12px;">' + result.token_number + '</h1>' + '<p style="font-size:17px;text-align:center;">' + 'Your Counter Name' + '</p>' + '<h1 style="font-size:35px; font-weight:bold; margin-top:-3px;">' + result.counter_id + '</h1>' + '<p style="font-size:17px;text-align:center;">' + 'Thank You' + '</p>' + '<p style="font-size:13px;text-align:center;">' + 'Powere by <b>F2F Solutions</b>' + '</p>'



                        '</button></div></div></div>';

                        $('#token').html(data); //as a debugging message.
                        $(".threed").hide();

                        var tkn = "your token number" + result.token_number + "is generated ";

//                        responsiveVoice.speak(tkn);
//
                        //  speak(tkn, {amplitude: 700, speed: 167, wordgap: 1.5});

                        var base_url = "<?php echo base_url('/'); ?>";
                        setTimeout(function () {
                            window.print();
                            $('#token').empty();
                            $(".cancelbtn").hide();
                            window.location.href = base_url + 'queprocess';
                        }, 800);

                    }
                });
            });
        }
    }

</script>

<script>
    $("#slideshow > div:gt(0)").hide();
    setInterval(function () {
        $('#slideshow > div:first')
                .fadeOut(1000)
                .next()
                .fadeIn(1000)
                .end()
                .appendTo('#slideshow');

    }, 3000);

</script>
<!--
<div id="audio"></div>
<div id="player"></div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakGenerator.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakClient.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/speak/speakWorker.js"></script>

-->
