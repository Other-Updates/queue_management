<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/service/css/sweetalert.css">
<script type="text/javascript" src="<?php echo $theme_path; ?>/service/js/core/sweetalertnew.min.js"></script>

<style type="text/css">
    select[name="clientTable_length"] {
        padding: 7px;
        border: 1px #ddd solid;
        border-radius: 3px;

    }
    .paginate_button { padding: 4px 12px !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        border:1px solid #dddddd;
    }
    th.sorting_disabled { width: 70px !important; }
    .stats tr td:nth-child(8) {
        text-align:center;
    }
    .scn_img {
        border: 1px solid #b8c4d0;
        width: 100%;
        height: 127px;
    }

    .content-group {
        margin-bottom: -39px !important;

    }
    .show_class {display:none;}
    table tr td:nth-child(5) {text-align:center;}
    table tr td:nth-child(6) {text-align:center;}
    table tr td:nth-child(9) {text-align:center;}

    table tr td:nth-child(7) {text-align:center; width:13% !important;}
    table tr td:nth-child(1) {text-align:center; width:2% !important;}
    .remark_div {
        display:none;

    }

</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Manage Clients
            <a href="<?php echo base_url(); ?>superadmin/client/add" title="Add New"><span class="label bg-success">Add New</span></a>
        </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>

        </div>
    </div>
    <table id="clientTable" class="table table-bordered table-striped table-hover responsive dataTable no-footer dtr-inline stats">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Client ID</th>
                <th >Client Name</th>
                <th>Username</th>
                <th>Expire Date</th>
                <th>Status</th>
                <th  class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>


</div>
<script type="text/javascript">

    function delete_client(id) {
        swal({
            title: "Are you sure?",
            text: "Do You Want to Delete This Data?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false

        },
                function () {
                    $.ajax({
                        url: '<?php echo base_url(); ?>superadmin/client/delete/' + id,
                        method: "POST",
                        data: {id: id},
                        success: function (data) {
                            if (data == 1) {
                                window.location = '<?php echo base_url(); ?>superadmin/client';
                            }
                        }
                    });
                });

    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var table;
        table = $('#clientTable').DataTable({
            'lengthMenu': [[50, 100, 150, -1], [50, 100, 150, 'All']],
            'processing': true, //Feature control the processing indicator.
            'serverSide': true, //Feature control DataTables' server-side processing mode.
            'retrieve': true,
            'order': [], //Initial no order.

            //dom: 'Bfrtip',

            // Load data for the table's content from an Ajax source

            'ajax': {
                'url': '<?php echo base_url() . 'superadmin/client/client_ajaxList'; ?>',
                'type': 'POST',
            },
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false

                },
                {
                    orderable: false,
                    targets: [-1]
                }
            ]
        });
    });

</script>




