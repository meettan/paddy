    
    <table class="table table-bordered table-hover" style="letter-spacing: 0;">

        <thead>

            <tr>

                <th>Transaction Id</th>
                <th>Date</th>
                <th>Beneficiary Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Cheque No</th>
                <th>Address</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody> 

            <?php 
            
            if($farmer_dtls) {
                
                $padyQty = $amount = 0;
                
                foreach($farmer_dtls as $f_list) {
                    $padyQty += $f_list->paddy_qty;
                    $amount  += $f_list->amount;
            ?>

                    <tr>
                        
                        <td><?php echo $f_list->trans_id; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($f_list->trans_dt)); ?></td>
                        <td><?php echo $f_list->beneficiary_name; ?></td>
                        <td><?php echo $f_list->paddy_qty; ?></td>
                        <td><?php echo $f_list->amount; ?></td>
                        <td><?php echo $f_list->cheque_no; ?></td>
                        <td><?php echo $f_list->address; ?></td>
                        <td> <a href="javascript:void(0)" class="status" id="<?php echo $f_list->trans_id; ?>" val="<?php echo $f_list->status; ?>">

                                <span class="badge badge-<?php echo ($f_list->status == 1)? 'success' : 'danger'; ?>"><?php echo ($f_list->status == 1)? 'Paid':'Unpaid'; ?></span> 

                             </a>
                        </td>
                       
                    </tr>

            <?php            
                }

            ?>
                <tr>
                    <td colspan="3" style="text-align: right;"> <b>Total:</b></td>
                    <td><?php echo $padyQty; ?></td>
                    <td><?php echo $amount; ?></td>
                    <td colspan="3"></td>
                </tr>
            <?php
            }

            else {

                echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

            }

            ?>
        
        </tbody>

    </table>

<script>

    $(document).ready( function (){

        $('.status').click(function () {

            var indexNo =   $('.status').index(this),
                transId =   $(this).attr('id'),
                value   =   $(this).attr('val');

            $.get('<?php echo site_url("paddy/updateStatusCheque"); ?>',
                {
                    trans_id: transId,
                    value:    value
                }
            )
            .done(function(data){

                if(value == '1'){
                    
                    $('.badge:eq('+indexNo+')').attr('class', 'badge badge-danger');
                    $('.badge:eq('+indexNo+')').html('Unpaid');
                    $('.status:eq('+indexNo+')').attr('val', data);

                }
                else{
                    
                    $('.badge:eq('+indexNo+')').attr('class', 'badge badge-success');
                    $('.badge:eq('+indexNo+')').html('Paid');
                    $('.status:eq('+indexNo+')').attr('val', data);

                } 
            });
            
        });

    });

</script>