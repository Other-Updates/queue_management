<?php $theme_path = $this->config->item('theme_locations') . 'event'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Manage Counter
            <?php if ($this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'add')): ?>
                <a href="<?php echo base_url(); ?>employee_management/emp_counter/add/" title="Add New"><span class="label bg-success">Add New</span></a>
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
                <th>Employee Name</th>
                <th>Counter Name</th>
                <th>Status</th>
                <?php if ($this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'edit') || $this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'delete')): ?>
                    <th class="text-center">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody id="display_info">
            <?php
            if (!empty($counter)) {
                $i = 1;
                foreach ($counter as $counters) {
                    ?>
                    <tr class="delete<?php echo $counters['id']; ?>">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ucfirst($counters['emp_name']); ?></td>
                        <?php if ($counters['counter_id'] == 'idle') { ?>
                            <td><a class="btn btn-danger btn-xs " style="width: 57px;"><?php echo ucfirst($counters['counter_id']); ?></a></td>
                        <?php } elseif ($counters['counter_id'] == 'hold') { ?>
                            <td><a class="btn btn-danger btn-xs" style="width: 57px;" ><?php echo ucfirst($counters['counter_id']); ?></a></td>
                        <?php } else { ?><td><?php echo ucfirst($counters['counter_name']); ?></td><?php } ?>
                        <td class="statustable"><span class="label label-<?php echo ($counters['status'] == 1) ? 'success' : 'default'; ?>"><?php echo ($counters['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                        <?php if ($this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'edit') || $this->user_auth->is_action_allowed('masters', 'street', 'delete')): ?>
                            <td class="text-center">
                                <?php if ($this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'edit')): ?>
                                    <a href="<?php echo base_url(); ?>employee_management/emp_counter/edit/<?php echo $counters['id']; ?>" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <?php endif; ?>
                                <?php if ($this->user_auth->is_action_allowed('employee_management', 'counter_employee', 'delete')): ?>
                                    <a href="javascript:void(0);"  class="btn btn-danger btn-xs delete_counter" onclick="delete_counter(<?php echo $counters['id']; ?>)" street_id="<?php echo $counters['id']; ?>" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                    <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('th.sorting_disabled').css('width', '135px');
    });

    function delete_counter(id) {
        $.confirm({
            title: 'Delete',
            text: 'Are you sure to Delete?',
            confirm: function (button) {
                $.ajax({
                    url: "<?php echo base_url(); ?>employee_management/emp_counter/delete/" + id,
                    method: "POST",
                    data: {id: id},
                    success: function (data) {
                        if (data == '1') {
                            $('.delete' + id + '').remove();

                        }
                    }
                });
            },
            cancel: function (button) {
            },
            confirmButton: 'Yes',
            cancelButton: 'No'
        });
    }
</script>
