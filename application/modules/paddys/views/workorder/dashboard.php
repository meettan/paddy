    <div class="wraper">      
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <h1><strong>Work order</strong></h1>
            </div>
        </div>
        <div class="col-lg-12 container contant-wraper">    
            <h3>
                <small><a href="<?php echo site_url("paddys/transactions/f_workorder_add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                        <th>Sl. No.</th>
                        <th>Scoiety</th>
                        <th>Mill </th>
                        <th>Transaction Date </th>
                        <th>Order No</th>
                        <th>Quantity(Quintal)</th>
                        <th>Created By</th>
                        <th>Approved By</th>
                        <th>Option</th>

                    </tr>

                </thead>
                <tbody> 

                    <?php 
                    
                    if($work_orders) {

                        $i = 1;

                      foreach($work_orders as $work_order) {

                    ?>

                        <tr>

                            <td ><?php echo $i++; ?></td>
                            <td ><?php echo $work_order->soc_name; ?></td>
                            <td><?php echo $work_order->mill_name; ?></td>
                            <td><?php echo date('d/m/Y',strtotime($work_order->trans_dt)); ?></td>
                            <td><?php echo $work_order->pre_order_no; ?><?php echo $work_order->order_no; ?></td>
                            <td><?php echo $work_order->paddy_qty; ?></td>
                            <td><?php echo $work_order->created_by; ?></td>
                            <td><?php echo $work_order->approved_by; ?></td>
                            <td><a href="<?php echo site_url("paddys/transactions/f_workorder_edit");?>?order_no=<?php echo $work_order->order_no; ?>/<?php echo $work_order->branch_id;?>/<?php echo $work_order->kms_year;?>" 
                                            data-toggle="tooltip" data-placement="bottom" title="Edit" >
                                            <i class="fa fa-edit fa-2x" style="color: #007bff"></i></a>
                                           
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php  if($work_order->approval_status !="A") {?>
                                   <button type="button" class="delete"
                                        id="<?php echo $work_order->order_no; ?>"
                                        data-toggle="tooltip" data-placement="bottom" title="Delete">

                                        <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                    </button> 
                                    <button class="btn btn-danger" disabled="">Unpproved</button>
                                            <?php }else{  ?>
                                                   <a href="<?php echo site_url("paddys/transactions/f_workorder_print");?>?order_no=<?php echo $work_order->order_no;?>" 
                                            data-toggle="tooltip" data-placement="bottom" title="Print" >
                                            <i class="fa fa-print fa-2x" style="color: #007bff"></i></a>  
                            <button class="btn btn-success" disabled="">Approved</button>
                            
                            

                                                    <?php  } ?> 

                                </td>
                        </tr>                    
                                            <?php
                                       }
                                           }

                                            ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th>Sl. No.</th>
                        <th>Scoiety</th>
                        <th>Mill </th>
                        <th>Transaction Date </th>
                        <th>Order No</th>
                        <th>Quantity</th>
                        <th>Created By</th>
                        <th>Approved By</th>
                        <th>Option</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddys/transactions/f_workorder_delete?sl_no="+id+"');?>";

            }
            
        });

    });

</script>

<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

    <?php if($this->session->flashdata('msg')){ ?>

    $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

    });

    <?php } ?>
</script>
