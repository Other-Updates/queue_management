<?php $theme_path = $this->config->item('theme_locations') . 'queue'; ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Advertisement List
            <?php //if ($this->user_auth->is_action_allowed('masters', 'advertisement', 'add')): ?>
            <a href="<?php echo base_url(); ?>masters/advertisement/add"><span class="label bg-success">Add New</span></a>
            <?php //endif; ?>
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
                <th>Advertisement Name</th>
                <th>Position</th>
                <th>Type</th>
                <th>Total Duration</th>
                <th>Total Sort Order</th>
                <th>Created Date</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
               
            </tr>
        </thead>
        <tbody>
           <?php
            if (!empty($add_data)) {
                $s = 1;
                foreach ($add_data as $list) {
                    ?>
                <tr class="delete<?php echo $list['id']; ?>">
                <td><?php echo $s; ?></td>
                <td><?php echo $list['name'];?></td>
                 <td><?php 
                    if($list['position']==1)
                        $position="Left Position";
                    elseif($list['position']==2)
                        $position="Bottom Position";
                    else
                        $position=" ";

                    echo $position;

                ?></td>
                <td><?php 
                    if($list['type']==1)
                        $type="Images";
                    elseif($list['type']==2)
                        $type="Videos";
                    elseif($list['type']==3)
                        $type="Content";
                    else
                        $type=" ";

                    echo $type;

                ?></td>
                <td align="center"><?php echo $list['total_duration'];?></td>
                <td align="center"><?php echo $list['total_sort_order'];?></td>
                <td align="center"><?php echo date('M-d-Y',strtotime($list['total_duration']));?></td>
                <td class="statustable"><span class="label label-<?php echo ($list['status'] == 1) ? 'success' : 'default'; ?>"><?php echo ($list['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                <td class="text-center">


                    <a href="<?php echo base_url(); ?>masters/advertisement/edit/<?php echo $list['id']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>


                    <a href="javascript:void(0);" class="btn btn-danger btn-xs " onclick="delete_add(<?php echo $list['id']; ?>)"  data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>


                     <a href="<?php echo base_url(); ?>masters/advertisement/view/<?php echo $list['id']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>

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

        $('body').addClass('sidebar-xs');
        $('th.sorting_disabled').css('width', '135px');
    });

    function delete_add(id) {
        $.confirm({
            title: 'Delete',
            text: 'Are you sure to Delete?',
            confirm: function (button) {
                $.ajax({
                    url: '<?php echo base_url(); ?>masters/advertisement/delete/' + id,
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