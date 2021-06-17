    
    <table class="table table-bordered table-hover">

        <thead>

            <tr>

                <th> All</th>
                <th>Sl. No.</th>
                <th>Documents</th>

            </tr>

        </thead>

        <tbody> 

            <?php 
            
            if($doc_dtls) {
                
                foreach($doc_dtls as $d_list) {

            ?>

                    <tr>
                        
                        <td><input type="checkbox" class="form-check-input checkbox" name="status[]" <?php echo ($d_list->status == 1)? 'checked':''; ?>></td>
                        <td><input type="hidden" class="sl_no" name="sl_no[]" value='{"sl_no":"<?php echo $d_list->sl_no; ?>", "value":"<?php echo $d_list->status; ?>"}'><?php echo $d_list->sl_no; ?></td>
                        <td><?php echo $d_list->documents; ?></td>
                        
                    </tr>

            <?php            
                }
            }

            else {

                echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

            }

            ?>
        
        </tbody>

        <tfoot>

            <tr>
            
                <th>All</th>
                <th>Sl. No.</th>
                <th>Documents</th>

            </tr>
        
        </tfoot>

    </table>