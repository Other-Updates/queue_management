<?php
$theme_path = $this->config->item('theme_locations') . 'queue';
$filter = $this->session_view->get_session('dashboard', 'index');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/service/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<style>
    .bg-info {
        background-color: #00BCD4;
        border-color: #00BCD4;
        color: #fff;
    }
    thead{
        background-color: #00bcd4;
        color:white;
    }
</style>
<div class="form-group dash-icons">
    <div class="form-group dash-icons">
        <div class="col-lg-12" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn bg-orange-400  btn-block hvr-ripple-out" type="button" >
                        <i class="icon-people"></i> <h3 class ="no-margin"><?php echo count($clients != 0) ? count($clients) : '0' ?></h3> <span>Total Clients</span>
                    </button>
                </div>

            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Recent Client Details
                                <?php if (!empty($recent_clients)) { ?>
                                    <a href="<?php echo base_url(); ?>superadmin/client/"><span class="label bg-success">VIEW MORE</span></a>
                                <?php } ?>
                            </h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Client ID</th>
                                    <th>Client Name</th>
                                    <th>Username</th>
                                    <th>Mobile Number</th>
                                    <th>Expire Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($recent_clients)) {
                                    $i = 1;
                                    foreach ($recent_clients as $list) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td class="tbl_aln_center"><?php echo $list['user_id']; ?></td>
                                            <td class="tbl_aln_left"><?php echo $list['firstname'] . " " . $list['lastname'] ?></td>
                                            <td class="tbl_aln_left"><?php echo $list['username']; ?></td>
                                            <td align="center" class="tbl_aln_center"><?php echo $list['mobile_number']; ?></td>
                                            <td align="center" class="tbl_aln_center"><?php echo (!empty($list['expire_date'])) ? date('d-M-Y', strtotime($list['expire_date'])) : ''; ?></td>
                                            <?php
                                            if ($list['status'] == '1') {
                                                $status = '<span class = "label label-success">Active</span>';
                                            } else {
                                                $status = '<span class = "label label-default">Inactive</span>';
                                            }
                                            ?>
                                            <td align="center"><?php echo $status; ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr><td class="text-center" colspan="6"><?php echo $language['no_result_found'] ?>!</td></tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>








