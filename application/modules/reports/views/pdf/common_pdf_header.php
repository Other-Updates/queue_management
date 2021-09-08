
<div style="width:100%; border-bottom:1px solid #000; padding-bottom:8px;font-size: 12px;">
    <div style="width:20%;float:left">

        <?php if (isset($logo) && $logo != '') { ?>
            <div class="col-md-2">
                <img style="margin-left:35% !important;" src="<?php echo $logo; ?>" alt="" width="30%">
            </div>
        <?php } else { ?>
            <div class="col-md-2">
                <img style="margin-left:35% !important;" src="<?php echo base_url() . 'themes/queue/service/images/logo.png'; ?>" alt="" width="30%">
            </div>
        <?php } ?>
    </div>
    <div style="width:45%;float:left;">
        <div class="Address">

            <div>
                <p> <b style="font-size:14px;"><?php echo $user_data[0]['company_name']; ?></b><br/>
                    <?php echo $user_data[0]['address']; ?></p>
            </div>
        </div>
    </div>
    <div style="width:35%;float:left; text-align: right;">
        <div><b><?php echo $report_title; ?></b></div>
        <p><?php echo 'Printed on: ' . date('d/m/Y'); ?></p>
    </div>
</div>