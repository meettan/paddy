    
    <table class="table table-bordered table-hover" style="letter-spacing: 0;">

        <thead>

            <tr>
            <th>Sl No</th>
                <th>Name </th>
                <th>Date</th>
                <th>Camp No</th>
                <th>Quantity</th>
                <th>Amount</th>

            </tr>

        </thead>

        <tbody> 

            <?php 
            
            if($farmer_dtls) {
                
                $padyQty = $amount = 0;
                  $i=1;
                foreach($farmer_dtls as $f_list) {
                    $padyQty += $f_list->quantity;
                    $amount  += $f_list->amount;
            ?>

                    <tr>
                    <td><?php echo $i++; ?></td>
                        <td><?php echo get_farmer_name($this->session->userdata['loggedin']['kms_id'],$f_list->reg_no); ?></td>
                      
                        <td><?php echo $f_list->trans_dt; ?></td>
                       
                        <td><?php echo $f_list->camp_no; ?></td>
                        <td><?php echo $f_list->quantity; ?></td>
                        <td><?php echo $f_list->amount; ?></td>
                       
                    </tr>

            <?php            
                }

            ?>
                <tr>
                    <td colspan="4" style="text-align: right;"> <b>Total:</b></td>
                    <td><?php echo $padyQty; ?></td>
                    <td><?php echo $amount; ?></td>
                    
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

            $.get('<?php echo site_url("paddy/updateStatus"); ?>',
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