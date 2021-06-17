    
    <table class="table table-bordered table-hover" style="letter-spacing: 0;">

        <thead>

            <tr>
            <th>Sl No</th>
                <th>Name</th>
                <th>Registration No.</th>
                <th>Epic No.</th>
                <th>Mobile No.</th>
                <th>Addhar No</th>
                <th>Account No.</th>
                <th>IFSC</th>
            </tr>

        </thead>

        <tbody> 

            <?php 
            
            if($farmer_dtls) {
                
                $padyQty = $amount = 0;
                  $i=1;
                foreach($farmer_dtls as $f_list) {
                  //  $padyQty += $f_list->quantity;
                //    $amount  += $f_list->amount;
            ?>

                    <tr>
                    <td><?php echo $i++; ?></td>
                        <td><?php echo $f_list->farm_name;?></td>
                       <!-- <td><?php //echo date('d-m-Y', strtotime($f_list->trans_dt)); ?></td> -->
                       
                        <td><?php echo $f_list->reg_no;?></td>
                        <td><?php echo $f_list->epic_no; ?></td>
                        <td><?php echo $f_list->mobile_number; ?></td>
                        <td><?php echo $f_list->addhar_no; ?></td>
                        <td><?php echo $f_list->account_no; ?></td>
                        <td><?php echo $f_list->ifsc_code; ?></td>
                       
                    </tr>

            <?php            
                }

            ?>
                <tr>
                    <td colspan="5" style="text-align: right;"> </td>
                    
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