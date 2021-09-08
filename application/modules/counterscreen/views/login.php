<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="icon" type="image/png" href="<?php echo $theme_path ?>/service/images/favicon.png" />
<link href="<?php echo $theme_path; ?>/service/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/sweetalert.css" rel="stylesheet" type="text/css">
<link href="<?php echo $theme_path; ?>/service/css/category.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/libraries/bootstrap.min.js"></script>
<style>
    .bg-info {
        background-color: #00bcd4e0;
    }
	img {position:fixed; width:100%; }
	 .modal-dialog {margin: 0px auto !important; }
	 .qprocess_popup {padding-top:25% !important;}
	 .modal-title {
		margin: 0;
		line-height: 1.5384616;
		font-weight: bold;
		color: white !important;
	}
	.form-group {
		margin-bottom: 0px !important;
	}
</style>
<img src="<?php echo $theme_path; ?>/service/images/login-bg.png"/>
<div>
    <div class="modal-dialog">
        <form name="login_form" class="qprocess_popup" id="login_form" action="<?php echo base_url('counterscreen/login') ?>" method="post">

            <?php if ($this->session->flashdata('flashError')): ?>
                <div class="alert alert-danger no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Error!</span> <?php echo $this->session->flashdata('flashError') ?>
                </div>
            <?php endif ?>
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">Enter Credentials</h6>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Username:</strong></label><span class="req">*</span>
                                    <input type="text" name="username" id="username" class="form-control input-sm required" placeholder="Username" maxlength="20">
                                    <span class="error_msg"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Password:</strong></label><span class="req">*</span>
                                    <input type="password" name="password" id="password" class="form-control input-sm required" placeholder="Password" maxlength="20" onkeypress="return isPhone(event)">
                                    <span class="error_msg"></span>
                                </div>
                            </div>
                        </div>
                        

                    </div>
					<div class="modal-footer">
                    <button type="button" name="cancel" class="btn btn-danger" onclick='window.location.href = "<?php echo base_url() . 'queprocess'; ?>"'>Cancel</button>
                    <button type="submit" id="save" class="btn btn-success submit">Save</button>
                </div>
                </div>
                
            </div>
        </form>
    </div>
</div>

<script>
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
</script>