<?php $theme_path = $this->config->item('theme_locations') . 'event'; ?>
<style>
    .star {
        text-shadow: 0 0 1px #F48F0A;
        color: orange;
    }
	table tr td:last-child { text-align:center !important; width:16% !important; }
</style>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Manage Feedback
            <?php if ($this->user_auth->is_action_allowed('manage_reports', 'feedback', 'add')): ?>
                                                                                                                    <!--<a href="<?php echo base_url(); ?>masters/counter/add/" title="Add New"><span class="label bg-success">Add New</span></a>-->
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
                <th>Ratings</th>
                <th>Comments</th>
                <th>Date</th>


            </tr>
        </thead>
        <tbody id="display_info">

            <?php
            if (!empty($feedback)) {
                $s = 1;
                foreach ($feedback as $details) {
                    ?>
                    <tr>

                        <td><?php echo $s ?></td>
                        <td class="star"><?php for ($i = 0; $i < $details['ratings']; $i++) { ?>
                                &#x2605
                            <?php } ?></td>
                        <td><?php echo ucfirst($details['comments']); ?></td>
                        <td width="10%"><?= ($details['created_date'] != '1970-01-01') ? date('d-M-Y H:i', strtotime($details['created_date'])) : ''; ?></td>
                    </tr>
                    <?php
                    $s++;
                }
            }
            ?>
        </tbody>
    </table>
</div>

