<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Category List
            <?php if ($this->user_auth->is_action_allowed('masters', 'sub_category', 'add')): ?>
                <a href="<?php echo base_url(); ?>masters/subcategory/add"><span class="label bg-success">Add New</span></a>
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
                <th>Category Name</th>
                <th>Sub Category</th>
                <th>Status</th>
                <?php if ($this->user_auth->is_action_allowed('masters', 'sub_category', 'edit') || $this->user_auth->is_action_allowed('masters', 'sub_category', 'delete')): ?>
                    <th class="text-center">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($token)) {
                $s = 1; 
                foreach ($token as $list) {
                    ?>
                    <tr class="delete<?php echo $list['id']; ?>">
                        <td><?php echo $s; ?></td>
                        <td><?php echo ucfirst($list['category_type']); ?></td>
                        <td><?php echo ucfirst($list['sub_category']); ?></td>
                        <td class="statustable"><span class="label label-<?php echo ($list['status'] == 1) ? 'success' : 'default'; ?>"><?php echo ($list['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                        <?php if ($this->user_auth->is_action_allowed('masters', 'sub_category', 'edit') || $this->user_auth->is_action_allowed('service_management', 'manage_category', 'delete')): ?>
                            <td class="text-center">

                                <?php if ($this->user_auth->is_action_allowed('masters', 'sub_category', 'edit')): ?>
                                    <a href="<?php echo base_url(); ?>masters/subcategory/edit/<?php echo $list['id']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <?php endif; ?>
                                <?php if ($this->user_auth->is_action_allowed('masters', 'sub_category', 'delete')): ?>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs " onclick="delete_category(<?php echo $list['id']; ?>,<?php echo $list['category_id']; ?>)" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                        </td>
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
    $(document).ready(function () {
        $('th.sorting_disabled').css('width', '135px');
    });

    function delete_category(id,catid) {

      
        $.confirm({
            title: 'Delete',
            text: 'Are you sure to Delete?',
            confirm: function (button) {
                $.ajax({
                    url: '<?php echo base_url(); ?>masters/subcategory/delete/' + id,
                    method: "POST",
                    data: {id: id,catid:catid},
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