<style type="text/css">
    table { border:1px solid #000 !important; border-collapse:collapse; width:100%; }
    table th,td { border:1px solid #000 !important; text-align:center; }
    table th { font-size: 12px; }
    table td {font-size: 11px; padding: 3px 2px; }
    .statuspdf { border:0 !important; }
    .statuspdf tr td { border:0 !important; }
    .statuspdf { text-decoration:none !important; color:black !important;}
    .clrcmd .badge {
        height: auto;
        width: auto;
        border-radius: 0%;
        display: inline-block;
        padding:3px;
    }
</style>
<table width="100%" class="table statuspdf">
    <tr>
        <td>
            <p>Success <span class="badge " style="background-color: #4CAF50;" id="c_success"><?php echo $report_data['counts_data']['success']; ?></span></p>
        </td>
        <td>
            <p>Hold <span class="badge" style="background-color: skyblue;" id="c_hold"><?php echo $report_data['counts_data']['Hold']; ?></span></p>
        </td>
        <td>
            <p>Hold Reassign <span class="badge" style="background-color: skyblue;" id="hold_reassign"><?php echo $report_data['counts_data']['Hold_reassign']; ?></span></p>
        </td>
        <td>
            <p>Missed <span class="badge" style="background-color: #F44336;" id="c_missed"><?php echo $report_data['counts_data']['Missed']; ?></span></p>
        </td>
        <td>
            <p>Missed Reassign <span class="badge" style="background-color: #F44336;" id="missed_reassign"><?php echo $report_data['counts_data']['Missed_reassign']; ?></span></p>
        </td>
        <td>
            <p>Transfer <span class="badge" style="background-color: orange" id="c_transfer"><?php echo $report_data['counts_data']['Transfer']; ?></span></p>
        </td>
        <td>
            <p>Token Number <span class="badge" style="background-color: #4CAF50;" id="c_tkn_number"><?php echo $report_data['counts_data']['tkn_number']; ?></span></p>
        </td>
        <td>
            <p>Processing time <span class="badge" style="background-color: #4CAF50;" id="c_p_time"><?php echo $report_data['counts_data']['processing_time']; ?></span></p>
        </td>
    </tr>
</table>
<table width="100%">
    <thead>
        <tr><th colspan="11">Token Report</th></tr>
        <tr>
            <th>S.No</th>
            <th>Counter</th>
            <th>Employee</th>
            <th>Token Number</th>
            <th>Date</th>
            <th>Queue Start Time</th>
            <th>Queue Time Taken</th>
            <th>Start time</th>
            <th>End Time</th>
            <th>Processing Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>

        <?php
        if ($report_data['counts'] > 0) {

            foreach ($report_data['result_data'] as $key => $result) {
                ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $result->counter_name; ?></td>
                    <td><?php echo $result->emp_name; ?></td>
                    <td><?php echo $result->token_number; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($result->created_date)); ?></td>
                    <td><?php echo $result->que_start_time; ?></td>
                    <td><?php echo $result->que_total_waiting_time; ?></td>
                    <td><?php echo $result->tkn_intime; ?></td>
                    <td><?php echo $result->tkn_outtime; ?></td>
                    <td><?php echo $result->processing_time; ?></td>
                    <td><?php echo $result->token_status; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

    <tfoot>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $report_data['counts_data']['q_waiting_time']; ?></td>
            <td></td>
            <td></td>
            <td><?php echo $report_data['counts_data']['processing_time']; ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>