<?php $theme_path = $this->config->item('theme_locations') . 'event'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Manage Counter
            <?php if ($this->user_auth->is_action_allowed('masters', 'counter', 'add')): ?>
                <a href="<?php echo base_url(); ?>masters/counter/add/" title="Add New"><span class="label bg-success">Add New</span></a>
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
                <th>Counter Name</th>
                <th>Status</th>
                <?php if ($this->user_auth->is_action_allowed('masters', 'counter', 'edit') || $this->user_auth->is_action_allowed('masters', 'counter', 'delete')): ?>
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
                        <td><?php echo ucfirst($counters['counter_name']); ?></td>
                        <td class="statustable"><span class="label label-<?php echo ($counters['status'] == 1) ? 'success' : 'default'; ?>"><?php echo ($counters['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                        <?php if ($this->user_auth->is_action_allowed('masters', 'counter', 'edit') || $this->user_auth->is_action_allowed('masters', 'street', 'delete')): ?>
                            <td class="text-center">
                                <?php if ($this->user_auth->is_action_allowed('masters', 'counter', 'edit')): ?>
                                    <a href="<?php echo base_url(); ?>masters/counter/edit/<?php echo $counters['id']; ?>" class="btn btn-info btn-xs" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <?php endif; ?>
                                <?php if ($this->user_auth->is_action_allowed('masters', 'counter', 'delete')): ?>
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
                    url: '<?php echo base_url(); ?>masters/counter/delete/' + id,
                    method: 'POST',
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
