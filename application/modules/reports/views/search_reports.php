<?php
if (!empty($result)) {
    $i = 1;
    foreach ($result as $details) {
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo ucfirst($details['counter_name']); ?></td>
            <td><?php echo ucfirst($details['emp_name']); ?></td>
            <td><?php echo ucfirst($details['token_number']); ?></td>
            <td><?php echo ($details['token_status'] != '') ? ucfirst($details['token_status']) : '-' ?></td>
            <td width="10%"><?= ($details['created_date'] != '1970-01-01') ? date('d-M-Y H:i', strtotime($details['created_date'])) : ''; ?></td>
            <td><?php echo $details['processing_time']; ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="6"><?php echo "No data found"; ?></td>
    </tr>
<?php }
?>



