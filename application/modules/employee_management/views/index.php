<?php $theme_path = $this->config->item('theme_locations') . 'event'; ?>

<style>
    .ui-dialog {
        z-index: 999;
    }
</style>

<div class="panel panel-flat">

    <div class="panel-heading">

        <h5 class="panel-title">Manage Employee

            <?php if ($this->user_auth->is_action_allowed('employee_management', 'employee', 'add')) : ?>

                <a href="<?php echo base_url(); ?>employee_management/employee/add"><span class="label bg-success">Add New</span></a>

            <?php endif; ?>

        </h5>

        <div class="heading-elements">

            <ul class="icons-list">

                <li><a data-action="collapse"></a></li>

            </ul>

        </div>

    </div>

    <table class="table datatable-basic table-bordered table-striped table-hover">

        <thead>

            <tr>

                <th>S.No</th>

                <th>Emp Id</th>

                <th>Employee Name</th>

                <th>Username</th>

                <th>Number</th>

                <th>Email Address</th>

                <th>Counter Name</th>

                <th>Current Status</th>

                <th>Status</th>

                <?php if ($this->user_auth->is_action_allowed('employee_management', 'employee', 'edit') || $this->user_auth->is_action_allowed('users', 'users', 'delete')) : ?>

                    <th class="text-center">Actions</th>

                <?php endif; ?>

            </tr>

        </thead>

        <tbody>

            <?php

            if (!empty($employee)) {

                $s = 1;

                foreach ($employee as $list) {

            ?>

                    <tr class="delete<?php echo $list['id']; ?>">

                        <td><?php echo $s; ?></td>

                        <td><?php echo $list['emp_id']; ?></td>

                        <td><?php echo ucfirst($list['emp_name']); ?></td>

                        <td><?php echo ucfirst($list['username']); ?></td>

                        <td><?php echo $list['mobile_number']; ?></td>

                        <td><?php echo $list['email_address']; ?></td>

                        <td><?php echo ucfirst($list['counter_name']); ?></td>
                        <td><?php echo ucfirst($list['emp_status']); ?></td>

                        <td class="statustable"><span class="label label-<?php echo ($list['status'] == 1) ? 'success' : 'default'; ?>"><?php echo ($list['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>

                        <?php if ($this->user_auth->is_action_allowed('employee_management', 'employee', 'edit') || $this->user_auth->is_action_allowed('users', 'users', 'delete')) : ?>

                            <td class="text-center">

                                <?php if ($this->user_auth->is_action_allowed('employee_management', 'employee', 'edit')) : ?>

                                    <a href="<?php echo base_url(); ?>employee_management/employee/edit/<?php echo $list['id']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>

                                <?php endif; ?>

                                <?php if ($this->user_auth->is_action_allowed('employee_management', 'employee', 'delete')) : ?>

                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs delete_user" onclick="delete_employee(<?php echo $list['id']; ?>)" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>

                                <?php endif; ?>

                            </td>

                        <?php endif; ?>

                    </tr>

            <?php

                    $s++;
                }
            }

            ?>

        </tbody>

    </table>

</div>



<script type="text/javascript">
    $(document).ready(function() {

        $('th.sorting_disabled').css('width', '135px');

    });



    function delete_employee(id) {

        $.confirm({

            title: 'Delete',

            text: 'Are you sure to Delete?',

            confirm: function(button) {

                $.ajax({

                    url: '<?php echo base_url(); ?>employee_management/employee/delete',

                    method: "POST",

                    data: {
                        id: id
                    },

                    success: function(data) {



                        if (data == '1') {

                            $('.delete' + id + '').remove();



                        }

                    }

                });

            },

            cancel: function(button) {

            },

            confirmButton: 'Yes',

            cancelButton: 'No'

        });

    }
</script>